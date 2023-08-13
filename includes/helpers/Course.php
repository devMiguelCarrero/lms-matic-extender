<?php

class lmscx_Course_Helper
{
  public function getCourseData($course)
  {
    $courseData = lmscx_CPTHelper::instance()->getCPTPostMeta( $course, 'course-lessons', [] );

    if(count($courseData) > 0) {
      foreach($courseData as $chapter) {
        foreach($chapter->lessons as $lesson) {
          $lesson->title = get_the_title($lesson->id);
        }
      }
    }

    return $courseData;
  }

  public function checkCourseValidation($user, $courseID) {
    
  }

  public static function instance()
  {
    return new lmscx_Course_Helper;
  }
}
