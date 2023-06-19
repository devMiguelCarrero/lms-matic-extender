import './CourseStructure.scss';
import {
  useState,
  forwardRef,
  useEffect,
  useImperativeHandle,
} from '@wordpress/element';
import {
  textDomain,
  URls,
  PostInfo,
} from '../../../../../globalComponents/data/pluginData';
import { __ } from '@wordpress/i18n';
import { Droppable, Draggable } from 'react-beautiful-dnd';
import Axios from 'axios';
import removeItems from 'remove-array-items';

const CourseStructure = forwardRef((props, ref) => {
  const [loadedChapters, setLoadedChapters] = useState(null);
  const [chapters, setChapters] = useState([]);
  const LessonMeta = props.lessonMeta;

  const reorder = (list, startIndex, endIndex) => {
    const result = [...list];
    const [removed] = result.splice(startIndex, 1);
    result.splice(endIndex, 0, removed);

    return result;
  };

  useEffect(async () => {
    const params = new URLSearchParams();
    params.append('action', 'lmscx_get_course_lessons');
    params.append('course', PostInfo.current_post);

    try {
      const response = await Axios.post(URls.ajax_url, params);
      console.log(response.data);
      props.onCourseLoad(response.data);
      if (response.data.length === 0) {
        setLoadedChapters([
          {
            id: 'chapter-1',
            lessons: [],
            title: __('Chapter 1', textDomain),
          },
        ]);
      } else {
        setLoadedChapters(response.data);
      }
      props.onCourseUpdate([]);
    } catch (error) {
      console.log(error);
    }
  }, [setChapters]);

  useEffect(() => {
    if (LessonMeta && loadedChapters) {
      setChapters((prevChapters) => {
        const updatedChapters = loadedChapters.map((chapter) => {
          const updatedLessons = chapter['lessons'].map((lesson) => {
            return LessonMeta.find((lessonM) => lessonM.id === lesson.id);
          });
          chapter.lessons = updatedLessons;
          return chapter;
        });
        return updatedChapters;
      });
    }
  }, [LessonMeta, loadedChapters]);

  const chapterAddHandler = () => {
    setChapters((prevChapters) => {
      const updatedChapters = [...prevChapters];
      updatedChapters.push({
        id: `chapter-${chapters.length + 1}`,
        lessons: [],
        title: `Chapter ${chapters.length + 1}`,
      });
      props.onCourseUpdate(updatedChapters);
      return updatedChapters;
    });
  };

  const chapterRemoveHandler = (chapterIndex) => {
    setChapters((prevChapters) => {
      const updatedChapters = [...prevChapters];
      removeItems(updatedChapters, chapterIndex, 1);
      props.onCourseUpdate(updatedChapters);
      return updatedChapters;
    });
  };

  const chapterTitleHandler = (event, index) => {
    setChapters((prevChapters) => {
      const updatedChapters = [...prevChapters];
      updatedChapters[index].title = event.target.value;
      props.onCourseUpdate(updatedChapters);
      return updatedChapters;
    });
  };

  useImperativeHandle(
    ref,
    () => ({
      getCourseHandler({ source }) {
        const chapterIndex = chapters.findIndex(
          (chapter) => chapter.id === source.droppableId
        );
        return chapters[chapterIndex]['lessons'][source.index];
      },
      orderCourseHandler({ source, destination }) {
        const chapterIndex = chapters.findIndex(
          (chapter) => chapter.id === source.droppableId
        );
        setChapters((prevChapters) => {
          const updatedChapters = [...prevChapters];
          updatedChapters[chapterIndex]['lessons'] = reorder(
            prevChapters[chapterIndex]['lessons'],
            source.index,
            destination.index
          );
          props.onCourseUpdate(updatedChapters);
          return updatedChapters;
        });
      },
      addCourseHandler(destination, lesson) {
        if (destination.droppableId.startsWith('chapter-')) {
          const chapterIndex = chapters.findIndex(
            (chapter) => chapter.id === destination.droppableId
          );
          setChapters((prevChapters) => {
            const updatedChapters = [...prevChapters];
            updatedChapters[chapterIndex]['lessons'].splice(
              destination.index,
              0,
              lesson
            );
            props.onCourseUpdate(updatedChapters);
            return updatedChapters;
          });
        }
      },
      removeCourseHandler({ source }) {
        const chapterIndex = chapters.findIndex(
          (chapter) => chapter.id === source.droppableId
        );
        setChapters((prevChapters) => {
          const updatedChapters = [...prevChapters];
          removeItems(
            updatedChapters[chapterIndex]['lessons'],
            source.index,
            1
          );
          props.onCourseUpdate(updatedChapters);
          return updatedChapters;
        });
      },
    }),
    [chapters, setChapters]
  );

  return (
    <>
      {chapters && LessonMeta ? (
        <ul className="courselessons-course-structure">
          {chapters.map((chapter, index) => {
            return (
              <li>
                <div className="courselessons-course-structure__chapter">
                  <div className="chapter-title">
                    <button
                      onClick={() => {
                        chapterRemoveHandler(index);
                      }}
                      className="courselessons-course-structure__chapter-delete"
                    >
                      X
                    </button>
                    <input
                      type="text"
                      value={chapter.title}
                      onChange={(event) => {
                        chapterTitleHandler(event, index);
                      }}
                    />
                  </div>
                  <Droppable droppableId={chapter.id}>
                    {(droppableProvided) => (
                      <ul
                        {...droppableProvided.droppableProps}
                        ref={droppableProvided.innerRef}
                        className="courselessons-course-structure__chapter-lessons"
                      >
                        {chapter.lessons.map((lesson, index) => {
                          return (
                            <Draggable
                              key={lesson.id}
                              draggableId={`lesson-${lesson.id}`}
                              index={index}
                            >
                              {(draggableProvided) => (
                                <li
                                  {...draggableProvided.draggableProps}
                                  ref={draggableProvided.innerRef}
                                  {...draggableProvided.dragHandleProps}
                                >
                                  {lesson.title.rendered}
                                </li>
                              )}
                            </Draggable>
                          );
                        })}
                        {droppableProvided.placeholder}
                      </ul>
                    )}
                  </Droppable>
                </div>
              </li>
            );
          })}
          <li key="0" className="add-new">
            <button
              type="button"
              className="add-new-chapter"
              onClick={chapterAddHandler}
            >
              {__('Add new Chapter', textDomain)}
            </button>
          </li>
        </ul>
      ) : (
        <p>loading...</p>
      )}
    </>
  );
});
export default CourseStructure;
