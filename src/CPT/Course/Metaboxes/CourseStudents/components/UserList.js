import "./UserList.scss";

import Axios from "axios";
import { useState, forwardRef, useImperativeHandle } from "@wordpress/element";
import {
  textDomain,
  URls,
} from "../../../../../globalComponents/data/pluginData";
import { __ } from "@wordpress/i18n";
import Button from "../../../../../globalComponents/UI/Button";
import { Droppable, Draggable } from "react-beautiful-dnd";
import ReorderArray from "../utilities/ReorderArray";

const UserList = forwardRef((props, ref) => {
  const [users, setUsers] = useState(null);
  const [srcUser, setSrcUser] = useState("");
  const [gettingData, setGettingData] = useState(false);

  const searchUser = async (event) => {
    event.preventDefault();
    setGettingData(true);

    const params = new URLSearchParams();
    params.append("action", "lmsx_search_users_by_string");
    params.append("string", srcUser);

    try {
      const response = await Axios.post(URls.ajax_url, params);
      setUsers(response.data);
    } catch (error) {
      console.log(error.toString());
    }

    setGettingData(false);
  };

  const srcUserHandler = (event) => {
    setSrcUser(event.target.value);
  };

  useImperativeHandle(
    ref,
    () => ({
      getStudentHandler(index) {
        return users[index];
      },
      orderStudentsHandler({ source, destination }) {
        setUsers((prevStudents) => {
          const arrayReordered = ReorderArray(
            prevStudents,
            source.index,
            destination.index
          );
          return arrayReordered;
        });
      }
    }),
    [users, setUsers]
  );

  return (
    <>
      <div className="user-list-userform">
        <form className="user-list-userform__form" onSubmit={searchUser}>
          <h4 className="user-list-userform__title">
            {__("Search for users to add", 'lms-matic-tutoring-management')}
          </h4>
          <div className="user-list-userform__fromgroup">
            <input
              type="search"
              placeholder={__("Type user to search", 'lms-matic-tutoring-management')}
              onChange={srcUserHandler}
              value={srcUser}
            />
            <Button type="submit" disabled={gettingData || srcUser.length <= 0}>
              {gettingData
                ? __("Searching...", 'lms-matic-tutoring-management')
                : __("Search now", 'lms-matic-tutoring-management')}
            </Button>
          </div>
        </form>
      </div>
      <>
        {gettingData ? (
          <p>{__("Searching for users", 'lms-matic-tutoring-management')}</p>
        ) : (
          <>
            {users && (
              <div className="user-list-container">
                {users.length <= 0 ? (
                  <p className="user-list-container__log">
                    {__("There are not users to show", 'lms-matic-tutoring-management')}
                  </p>
                ) : (
                  <Droppable droppableId="searched-users">
                    {(droppableProvided) => (
                      <ul
                        {...droppableProvided.droppableProps}
                        ref={droppableProvided.innerRef}
                        className="user-list-container__list"
                      >
                        {users.map((user, index) => {
                          return (
                            <Draggable
                              key={user.ID}
                              draggableId={`searched-student-${user.ID}`}
                              index={index}
                            >
                              {(draggableProvided) => (
                                <li
                                  {...draggableProvided.draggableProps}
                                  ref={draggableProvided.innerRef}
                                  {...draggableProvided.dragHandleProps}
                                >
                                  {user.data.display_name} (
                                  {user.data.user_email})
                                </li>
                              )}
                            </Draggable>
                          );
                        })}
                      </ul>
                    )}
                  </Droppable>
                )}
              </div>
            )}
          </>
        )}
      </>
    </>
  );
});
export default UserList;
