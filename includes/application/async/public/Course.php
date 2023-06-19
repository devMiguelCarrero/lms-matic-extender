<?php

class lmscx_Async_Course
{
  public function init()
  {
    add_action('wp_ajax_lmscx_check_course_validation', [$this, 'check_course_validation']);
    add_action('wp_ajax_nopriv_lmscx_check_course_validation', [$this, 'check_course_validation']);
  }

  public function check_course_validation() {
    $course = esc_attr($_POST['course']);
    echo json_encode(lmscx_CPTHelper::instance()->getCPTPostMeta( $course, 'course-lessons', [] ));
    exit();
  }

  public static function instance()
  {
    return new lmscx_Async_Course();
  }
}

lmscx_Async_Course::instance()->init();
