import "./Col.scss";

const Col = (props) => {
  return <div class={`col ${props.className}`}>{props.children}</div>;
};

export default Col;
