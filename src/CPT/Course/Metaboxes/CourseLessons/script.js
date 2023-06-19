import "./style.scss";
import { render } from "@wordpress/element";
import FrontApp from "./FrontApp";

if (document.getElementById("lms-course-lessons"))
  render(<FrontApp />, document.getElementById("lms-course-lessons"));
