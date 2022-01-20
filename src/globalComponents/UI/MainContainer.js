import "./MainContainer.scss";

const MainContainer = (props) => {
  return (
    <div className={`lms-main-container ${props.className}`}>
      {props.children}
    </div>
  );
};
export default MainContainer;