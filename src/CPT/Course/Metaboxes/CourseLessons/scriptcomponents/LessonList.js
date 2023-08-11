import { useState, useContext } from '@wordpress/element';
import './LessonList.scss';

import { CourseContext } from '../shared/context/course-context';

const LessonList = () => {
  const { course, setCourse, selectedLesson, setSelectedLesson } =
    useContext(CourseContext);

  const OpenSelectedChapter = (index) => {
    setCourse((oldCourseData) => {
      const newCourseData = [...oldCourseData];
      newCourseData[index].selected = !newCourseData[index].selected;
      return newCourseData;
    });
  };

  const SelectedLessonHandler = (lesson) => {
    setSelectedLesson(lesson);
    SelectedChapterHanlder(lesson);
  };

  const SelectedChapterHanlder = (lesson) => {
    setCourse((oldCourseData) => {
      const newCourseData = [...oldCourseData];
      newCourseData[
        newCourseData.findIndex((chapter) => chapter.selected)
      ].selected = false;
      newCourseData[
        newCourseData.findIndex(
          (chapter) =>
            chapter.lessons.findIndex(
              (theLesson) => theLesson.id === lesson
            ) !== -1
        )
      ].selected = true;
      return newCourseData;
    });
  };

  return (
    <>
      {course.length > 0 && (
        <div className="lesson-list">
          <aside className="lesson-list__chapters">
            {course.map((chapter, index) => (
              <div className="lesson-list__chapter">
                <div>
                  <button
                    onClick={OpenSelectedChapter.bind(null, index)}
                    className="lesson-button"
                  >
                    {chapter.title}
                  </button>
                  {chapter.selected && (
                    <div className="lesson-list__lessons">
                      <ul>
                        {chapter.lessons.map((lesson, index) => (
                          <li key={lesson.id}>
                            <label className="lesson-selector">
                              <input
                                className="lesson-selector__input"
                                type="radio"
                                id="lesson-selector"
                                value={lesson.id}
                                checked={lesson.id === selectedLesson}
                                onChange={SelectedLessonHandler.bind(
                                  null,
                                  lesson.id
                                )}
                              />
                              <span className="lesson-selector__content">
                                {lesson.title}
                              </span>
                            </label>
                          </li>
                        ))}
                      </ul>
                    </div>
                  )}
                </div>
              </div>
            ))}
          </aside>
        </div>
      )}
    </>
  );
};
export default LessonList;
