import "./style.scss";
import { render } from "@wordpress/element";
import App from "./App";

if (document.getElementById("edit-post-reviews"))
  render(<App />, document.getElementById("edit-post-reviews"));
