import "./Button.scss";

const LmstButton = (props) => {
  switch (props.tag) {
    case "link":
      return (
        <a
          href={props.href ? props.href : `#`}
          className={`${props.className && props.className} lmst-button`}
        >
          {props.children}
        </a>
      );
      break;

    default:
      return (
        <button
          type={props.type ? props.type : `button`}
          className={`${props.className && props.className} lmst-button`}
          disabled={props.disabled ? props.disabled : false}
        >
          <span className="button-text">{props.children}</span>
        </button>
      );
      break;
  }
};
export default LmstButton;
