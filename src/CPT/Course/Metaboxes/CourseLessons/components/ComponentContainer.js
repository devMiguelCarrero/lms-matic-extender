import "./ComponentContainer.scss";
import MainContainer from "../../../../../globalComponents/UI/MainContainer";

const ComponentContainer = (props) => {
  return (
    <MainContainer className="lms-course-lessons-container">
      {props.children}
    </MainContainer>
  );
};
export default ComponentContainer;
