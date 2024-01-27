import { useEffect, useState } from '@wordpress/element';
import LogoLoader from '../../../../globalComponents/LogoLoader/LogoLoader';
import Axios from 'axios';
import he from 'he';

import { useCourse } from './shared/hooks/course-hook';
import { CourseContext } from './shared/context/course-context';

import './FrontApp.scss';

import {
  textDomain,
  URls,
  PostInfo,
} from '../../../../globalComponents/data/pluginData';
import LessonList from './scriptcomponents/LessonList';
import CourseContent from './scriptcomponents/CourseContent';
import CourseConstructor from './shared/Class/Course';

const FrontApp = () => {
  const { course, setCourse, selectedLesson, setSelectedLesson } = useCourse();
  const [courseContent, setCourseContent] = useState(null);

  useEffect(async () => {
    const params = new URLSearchParams();
    params.append('action', 'lmscx_check_course_validation');
    params.append('course', PostInfo.current_post);

    try {
      const response = await Axios.post(URls.ajax_url, params);
      const courseResponse = response.data;
      setCourseContent(courseResponse);

      if (courseResponse.valid) {
        const courseData = new CourseConstructor()
          .formatCourse(response.data.content)
          .setFirstLesson();
        setSelectedLesson(courseData.getLesson());
        setCourse(courseData.get());
      }
    } catch (error) {
      console.log(error);
    }
  }, []);

  return (
    <>
      {courseContent && (
        <>
          {courseContent.valid && (
            <CourseContext.Provider
              value={{ course, setCourse, selectedLesson, setSelectedLesson }}
            >
              <div className="border-section">
                {course.length <= 0 && <LogoLoader />}
                {course.length > 0 && (
                  <div className="course-structure">
                    <LessonList />
                    <CourseContent />
                  </div>
                )}
              </div>
            </CourseContext.Provider>
          )}
          {!courseContent.valid && (
            <div
              dangerouslySetInnerHTML={{
                __html: he.decode(courseContent.content),
              }}
            />
          )}
        </>
      )}
      {!courseContent && <LogoLoader />}
    </>
  );
};
export default FrontApp;
