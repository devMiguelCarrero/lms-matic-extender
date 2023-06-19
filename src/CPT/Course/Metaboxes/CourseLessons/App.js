import Col from '../../../../globalComponents/UI/Col';
import Row from '../../../../globalComponents/UI/Row';
import { textDomain } from '../../../../globalComponents/data/pluginData';
import { __ } from '@wordpress/i18n';
import ComponentContainer from './components/ComponentContainer';
import LessonList from './components/LessonList';
import CourseStructure from './components/CourseStructure';
import { DragDropContext } from 'react-beautiful-dnd';
import { useState, useRef } from '@wordpress/element';

const App = () => {
  const [meta, setMeta] = useState("");
  const [LessonMeta, setLessonMeta] = useState(null);
  const [usedMaterial, setUsedMaterial] = useState(null);
  const LessonRef = useRef();
  const CourseRef = useRef();

  const setMetaHandler = (event) => {
    setMeta(event.target.value);
  };

  const updateLessonHandler = (lessons) => {
    setLessonMeta(lessons);
  };

  const updateUsedMaterial = (course) => {
    setUsedMaterial(() => {
      const newMaterial = [];
      course.map((chapter) => {
        chapter["lessons"].map((material) => {
          newMaterial.push(material.id);
        });
      });
      return newMaterial;
    });
  };

  const updateCourseHandler = (course) => {
    const updatedCourse = [...course];
    const curatedCourse = updatedCourse.map((chapter) => {
      const curatedLessons = chapter["lessons"].map((lesson) => {
        return { id: lesson.id };
      });
      return { id: chapter.id, title: chapter.title, lessons: curatedLessons };
    });

    setMeta(JSON.stringify(curatedCourse));
  };

  const handleItemsDragged = (result) => {
    const { source, destination } = result;
    if (!destination) {
      return;
    }
    if (
      source.index === destination.index &&
      source.droppableId === destination.droppableId
    ) {
      return;
    }

    if (destination.droppableId === source.droppableId) {
      switch (destination.droppableId) {
        case "lessons":
          LessonRef.current.orderLessonsHandler({ source, destination });
          break;

        default:
          CourseRef.current.orderCourseHandler({ source, destination });
          break;
      }
    } else {
      const sourceItem = () => {
        switch (source.droppableId) {
          case "lessons":
            return LessonRef.current.getLessonHandler(source.index);
            break;

          default:
            return CourseRef.current.getCourseHandler({ source });
            break;
        }
      };

      switch (destination.droppableId) {
        case "lessons":
          LessonRef.current.addLessonHandler(destination, sourceItem());
          break;

        default:
          CourseRef.current.addCourseHandler(destination, sourceItem());
          break;
      }
      switch (source.droppableId) {
        case "lessons":
          LessonRef.current.removeLessonHandler({ source });
          break;

        default:
          CourseRef.current.removeCourseHandler({ source });
          break;
      }
    }
  };

  return (
    <>
      <DragDropContext onDragEnd={handleItemsDragged}>
        <ComponentContainer>
          <Row>
            <Col>
              <h5>{__("Current Lessons", textDomain)}</h5>
              <CourseStructure
                lessonMeta={LessonMeta}
                ref={CourseRef}
                onCourseUpdate={updateCourseHandler}
                onCourseLoad={updateUsedMaterial}
              />
            </Col>
            <Col>
              <h5>{__("To add Lessons", textDomain)}</h5>
              <LessonList
                usedMaterial={usedMaterial}
                onLessonsLoad={updateLessonHandler}
                ref={LessonRef}
              />
            </Col>
          </Row>
        </ComponentContainer>
        <input
          type="hidden"
          id="course-lessons"
          name="course-lessons"
          value={meta}
          onChange={setMetaHandler}
        />
      </DragDropContext>
    </>
  );
};
export default App;
