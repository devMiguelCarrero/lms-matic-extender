<?php

class lmscx_Async_Lesson
{
  public function init()
  {
    add_action('wp_ajax_lmscx_get_lesson_content', [$this, 'check_course_validation']);
    add_action('wp_ajax_nopriv_lmscx_get_lesson_content', [$this, 'check_course_validation']);
  }

  public function check_course_validation() {
    $lesson = esc_attr($_POST['lesson']);
    echo json_encode( lmscx_Lesson_Helper::instance()->getLessonContent($lesson) );
    exit();
  }

  public static function instance()
  {
    return new lmscx_Async_Lesson();
  }
}

lmscx_Async_Lesson::instance()->init();
