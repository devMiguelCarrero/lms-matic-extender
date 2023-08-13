import MainContainer from "../../../../globalComponents/UI/MainContainer";
import Col from "../../../../globalComponents/UI/Col";
import Row from "../../../../globalComponents/UI/Row";
import { useState, useRef } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import { textDomain } from "../../../../globalComponents/data/pluginData";
import UserList from "./components/UserList";
import { DragDropContext } from "react-beautiful-dnd";
import ScheduledContainer from "./components/ScheduledContainer";

const ShceduledStudentsApp = () => {
  const [meta, setMeta] = useState("");
  const scheduledStudentsRef = useRef();
  const searchedUsers = useRef();

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
        case "scheduled-users":
          scheduledStudentsRef.current.orderStudentsHandler({
            source,
            destination,
          });
          break;

        case "searched-users":
          searchedUsers.current.orderStudentsHandler({
            source,
            destination,
          });
          break;
      }
    }

    if (destination.droppableId !== source.droppableId) {
      const sourceItem = () => {
        switch (source.droppableId) {
          case "scheduled-users":
            return scheduledStudentsRef.current.getStudentHandler(source.index);
            break;
          case "searched-users":
            return searchedUsers.current.getStudentHandler(source.index);
            break;
        }
      };

      switch (destination.droppableId) {
        case "scheduled-users":
          console.log("scheduled-users");
          scheduledStudentsRef.current.addStudentHandler(
            destination,
            sourceItem()
          );
          break;
      }
    }
  };

  const handleStudentsMeta = (meta) => {
    if (typeof meta !== "object") {
      setMeta(JSON.stringify([]));
      return;
    }
    const sanitizedMeta = meta.map((user) => {
      return user.ID;
    });

    setMeta(JSON.stringify(sanitizedMeta));
  };

  const setMetaHandler = (event) => {
    setMeta(event.target.value);
  };

  return (
    <MainContainer>
      <DragDropContext onDragEnd={handleItemsDragged}>
        <Row>
          <Col>
            <ScheduledContainer
              onUpdateStudents={handleStudentsMeta}
              ref={scheduledStudentsRef}
            />
          </Col>
          <Col>
            <UserList ref={searchedUsers} />
          </Col>
        </Row>
      </DragDropContext>
      <input
        type="hidden"
        id="course-students"
        name="course-students"
        value={meta}
        onChange={setMetaHandler}
      />
    </MainContainer>
  );
};
export default ShceduledStudentsApp;
