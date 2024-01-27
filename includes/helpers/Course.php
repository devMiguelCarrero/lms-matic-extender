<?php

class lmscx_Course_Helper
{
  public function getCourseData($course)
  {
    $courseData = lmscx_CPTHelper::instance()->getCPTPostMeta($course, 'course-lessons', []);

    if (count($courseData) > 0) {
      foreach ($courseData as $chapter) {
        foreach ($chapter->lessons as $lesson) {
          $lesson->title = get_the_title($lesson->id);
        }
      }
    }

    return $courseData;
  }

  public function checkCourseValidation($courseID)
  {
    $log = (object)[
      'valid' => false,
      'message' => esc_attr__('Something happened, please try again', 'lms-matic-extender'),
      'content' => (object)[]
    ];

    if (is_user_logged_in()) {
      $buyedCourses = lmsx_USER_Model::instance()->getUserMeta(get_current_user_id(), 'user-courses', []);
      if (in_array($courseID, $buyedCourses)) {
        $log->valid = true;
      }
    }

    if ($log->valid) {
      $log->content = $this->getCourseData($courseID);
      $log->encounters = lmscx_CPTHelper::instance()->getCPTByMeta('encuentro', 'lms-course-encounters', $courseID);
    } else {
      $content_post = get_post($courseID);
      $content = $content_post->post_content;
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);
      $log->content = $content;
    }

    return $log;
  }

  public static function instance()
  {
    return new lmscx_Course_Helper;
  }
}
