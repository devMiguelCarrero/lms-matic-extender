import { createContext } from '@wordpress/element';

export const CourseContext = createContext({
  course: [],
  setCourse: () => {},
  selectedLesson: 0,
  setSelectedLesson: () => {},
});
