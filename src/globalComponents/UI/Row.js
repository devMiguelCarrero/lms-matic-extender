import "./Row.scss";
const Row = (props) => {
  return <div className={`lms-row ${props.className}`}>{props.children}</div>;
};
export default Row;
