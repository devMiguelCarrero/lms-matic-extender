import { useCallback, useState } from '@wordpress/element';

export const useCourse = () => {
  const [course, setTheCourse] = useState([]);
  const [selectedLesson, setTheSelectedLesson] = useState(0);

  const setCourse = useCallback((theCourse) => {
    setTheCourse(theCourse);
  }, []);

  const setSelectedLesson = useCallback((lesson) => {
    setTheSelectedLesson(lesson);
  }, []);

  return {
    course,
    setCourse,
    selectedLesson,
    setSelectedLesson,
  };
};
