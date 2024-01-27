<?php

class lmscx_Async_Course
{
  public function init()
  {
    add_action('wp_ajax_lmscx_check_course_validation', [$this, 'check_course_validation']);
    add_action('wp_ajax_nopriv_lmscx_check_course_validation', [$this, 'check_course_validation']);
    add_action('wp_ajax_lmscx_get_course_comments_section', [$this, 'get_course_comments_section']);
    add_action('wp_ajax_nopriv_lmscx_get_course_comments_section', [$this, 'get_course_comments_section']);
  }

  public function check_course_validation()
  {
    $course = esc_attr($_POST['course']);
    echo json_encode(lmscx_Course_Helper::instance()->checkCourseValidation($course));
    exit();
  }

  public function get_course_comments_section()
  {
    $course = esc_attr($_POST['course']);
    ob_start();
    comments_template('', true, $course);
    $comments = ob_get_clean();
    echo $comments;
    exit();
  }

  public static function instance()
  {
    return new lmscx_Async_Course();
  }
}

lmscx_Async_Course::instance()->init();
