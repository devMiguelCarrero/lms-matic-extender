import "./LessonList.scss";

import { URls } from "../../../../../globalComponents/data/pluginData";
import {
  useState,
  useEffect,
  useImperativeHandle,
  forwardRef,
} from "@wordpress/element";
import Axios from "axios";
import { Droppable, Draggable } from "react-beautiful-dnd";
import { ItemTypes } from "./Helpers";
import removeItems from "remove-array-items";

const LessonList = forwardRef((props, ref) => {
  const [lessons, setLessons] = useState([]);
  const usedMaterial = props.usedMaterial;

  const reorder = (list, startIndex, endIndex) => {
    const result = [...list];
    const [removed] = result.splice(startIndex, 1);
    result.splice(endIndex, 0, removed);

    return result;
  };

  useEffect(async () => {
    try {
      const response = await Axios.get(`${URls.main_url}wp-json/wp/v2/lesson`);
      setLessons(response.data);
      console.log(response.data);
      props.onLessonsLoad(response.data);
    } catch (error) {
      console.log(error);
    }
  }, [setLessons]);

  useEffect(() => {
    if (usedMaterial) {
      setLessons((prevLessons) => {
        const updatedLessons = prevLessons.filter((lesson) => {
          if (!usedMaterial.includes(lesson.id)) {
            return lesson;
          }
        });
        return updatedLessons;
      });
    }
  }, [setLessons, usedMaterial]);

  useImperativeHandle(
    ref,
    () => ({
      getLessonHandler(index) {
        return lessons[index];
      },
      addLessonHandler(destination, lesson) {
        setLessons((prevLessons) => {
          const updatedLessons = [...prevLessons];
          updatedLessons.splice(destination.index, 0, lesson);
          return updatedLessons;
        });
      },
      orderLessonsHandler({ source, destination }) {
        setLessons((prevLessons) =>
          reorder(prevLessons, source.index, destination.index)
        );
      },
      removeLessonHandler({ source }) {
        setLessons((prevLessons) => {
          const updatedLessons = [...prevLessons];
          removeItems(updatedLessons, source.index, 1);
          return updatedLessons;
        });
      },
    }),
    [lessons, setLessons]
  );

  return (
    <>
      {lessons && usedMaterial ? (
        <Droppable droppableId="lessons">
          {(droppableProvided) => (
            <ul
              {...droppableProvided.droppableProps}
              ref={droppableProvided.innerRef}
              className="courselessons-lesson-list"
            >
              {lessons.map((lesson, index) => {
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
            </ul>
          )}
        </Droppable>
      ) : (
        <p>loading...</p>
      )}
    </>
  );
});
export default LessonList;
