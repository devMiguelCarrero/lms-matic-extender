import { useEffect, useState } from '@wordpress/element';
import LogoLoader from '../../../../globalComponents/LogoLoader/LogoLoader';
import Axios from 'axios';

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

  useEffect(async () => {
    const params = new URLSearchParams();
    params.append('action', 'lmscx_check_course_validation');
    params.append('course', PostInfo.current_post);

    try {
      const response = await Axios.post(URls.ajax_url, params);
      const courseData = new CourseConstructor()
        .formatCourse(response.data)
        .setFirstLesson();

      setSelectedLesson(courseData.getLesson());
      setCourse(courseData.get());
    } catch (error) {
      console.log(error);
    }
  }, []);

  return (
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
  );
};
export default FrontApp;
