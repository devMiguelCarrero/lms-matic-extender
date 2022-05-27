import "./style.scss";
import { render } from "@wordpress/element";
import App from "./App";

if (document.getElementById("edit-course-lessons"))
  render(<App />, document.getElementById("edit-course-lessons"));
