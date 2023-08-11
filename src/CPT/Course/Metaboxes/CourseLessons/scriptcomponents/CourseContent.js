import {
  useContext,
  useEffect,
  useState,
  useCallback,
} from '@wordpress/element';
import Axios from 'axios';
import he from 'he';

import LogoLoader from '../../../../../globalComponents/LogoLoader/LogoLoader';
import { CourseContext } from '../shared/context/course-context';
import {
  textDomain,
  URls,
  PostInfo,
} from '../../../../../globalComponents/data/pluginData';

import './CourseContent.scss';
import CourseConstructor from '../shared/Class/Course';

const CourseContent = () => {
  const [currentLesson, setCurrentLesson] = useState({});
  const [isLoading, setIsLoading] = useState(true);
  const { course, setCourse, selectedLesson } = useContext(CourseContext);

  useEffect(() => {
    let isCancelled = false;
    const courseConstructor = new CourseConstructor(course, selectedLesson);
    const addLessonContent = async () => {
      setIsLoading(true);
      const params = new URLSearchParams();
      params.append('action', 'lmscx_get_lesson_content');
      params.append('lesson', selectedLesson);

      try {
        const response = await Axios.post(URls.ajax_url, params);
        if (!isCancelled) {
          courseConstructor.loadLesson(response.data);
          setCourse(courseConstructor.get());
        }
      } catch (error) {
        if (!isCancelled) {
          console.log(error);
        }
      }
      setIsLoading(false);
    };
    if (!courseConstructor.isLessonLoaded()) {
      addLessonContent();
    }
    setCurrentLesson(courseConstructor.getCurrentLesson());
    return () => {
      isCancelled = true;
    };
  }, [selectedLesson]);

  return (
    <div className="course-content">
      <>{isLoading && <LogoLoader />}</>
      <>
        {!isLoading && currentLesson && (
          <>
            <div class="lms-section-title-area lms-section-title-area--secondary-color">
              <h2 class="entry-title lms-section-title-area__title assesory-title">
                {currentLesson.title}
              </h2>
            </div>
            <div className="lms-section">
              <div className="compressed-container">
                {
                  <div
                    dangerouslySetInnerHTML={{
                      __html: he.decode(currentLesson.content),
                    }}
                  />
                }
              </div>
            </div>
          </>
        )}
      </>
    </div>
  );
};
export default CourseContent;
