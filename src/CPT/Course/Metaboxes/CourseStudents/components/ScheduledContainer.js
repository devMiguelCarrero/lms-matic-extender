import "./ScheduledContainer.scss";
import { Droppable } from "react-beautiful-dnd";
import {
  useState,
  forwardRef,
  useImperativeHandle,
  useEffect,
} from "@wordpress/element";
import { Draggable } from "react-beautiful-dnd";
import { __ } from "@wordpress/i18n";
import {
  textDomain,
  PostInfo,
  URls,
} from "../../../../../globalComponents/data/pluginData";
import removeItems from "remove-array-items";
import ReorderArray from "../utilities/ReorderArray";
import Axios from "axios";

const ScheduledContainer = forwardRef((props, ref) => {
  const [students, setStudents] = useState(null);

  useEffect(async () => {
    const params = new URLSearchParams();
    params.append("action", "lmsx_get_course_students_by_cpt");
    params.append("course", PostInfo.current_post);

    try {
      const response = await Axios.post(URls.ajax_url, params);
      props.onUpdateStudents(response.data);
      console.log(response.data);
      setStudents(response.data);
    } catch (error) {
      console.log(error);
    }
  }, [setStudents]);

  const deleteScheduled = (index) => {
    setStudents((prevStudents) => {
      const newStudents = [...prevStudents];
      removeItems(newStudents, index, 1);
      props.onUpdateStudents(newStudents);
      return newStudents;
    });
  };

  useImperativeHandle(
    ref,
    () => ({
      getStudentHandler(index) {
        return students[index];
      },
      orderStudentsHandler({ source, destination }) {
        setStudents((prevStudents) => {
          const arrayReordered = ReorderArray(
            prevStudents,
            source.index,
            destination.index
          );
          props.onUpdateStudents(arrayReordered);
          return arrayReordered;
        });
      },
      addStudentHandler(destination, student) {
        setStudents((prevStudents) => {
          const updatedStudents = [...prevStudents];

          if (updatedStudents.findIndex((stud) => stud.ID == student.ID) === -1)
            updatedStudents.splice(destination.index, 0, student);

          props.onUpdateStudents(updatedStudents);
          return updatedStudents;
        });
      },
    }),
    [students, setStudents]
  );

  return (
    <div className="scheduled-users-container">
      {students ? (
        <>
          <Droppable droppableId="scheduled-users">
            {(droppableProvidedd) => (
              <ul
                {...droppableProvidedd.droppableProps}
                ref={droppableProvidedd.innerRef}
                className="scheduled-users-container__list"
              >
                {students.map((student, index) => {
                  return (
                    <Draggable
                      key={student.ID}
                      draggableId={`student-${student.ID}`}
                      index={index}
                    >
                      {(draggableProvided) => (
                        <li
                          {...draggableProvided.draggableProps}
                          ref={draggableProvided.innerRef}
                          {...draggableProvided.dragHandleProps}
                        >
                          {student.data.display_name} ({student.data.user_email}
                          )
                          <button
                            className="delete-user-button"
                            onClick={() => deleteScheduled(index)}
                          >
                            X
                          </button>
                        </li>
                      )}
                    </Draggable>
                  );
                })}
                {droppableProvidedd.placeholder}
              </ul>
            )}
          </Droppable>
          {students.length === 0 && (
            <p className="scheduled-users-container__log">
              {__("Drag here students that you want to schedule", 'lms-matic-tutoring-management')}
            </p>
          )}
        </>
      ) : (
        <p>{__("Loading...", 'lms-matic-tutoring-management')}</p>
      )}
    </div>
  );
});
export default ScheduledContainer;
