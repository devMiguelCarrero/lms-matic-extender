import { render } from "@wordpress/element";
import App from "./App";

if (document.getElementById("edit-course-students")) {
  render(<App />, document.getElementById("edit-course-students"));
}
  
