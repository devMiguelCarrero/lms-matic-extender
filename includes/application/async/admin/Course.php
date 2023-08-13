<?php

class lmscx_admin_Async_Course
{
  public function init()
  {
    add_action('wp_ajax_lmsx_get_course_students_by_cpt', [$this, 'get_course_students_by_cpt']);
  }

  public function get_course_students_by_cpt()
  {
    $course = esc_attr($_POST['course']);
    echo json_encode(lmsx_COURSE_Model::instance()->findScheduledStudents($course));
    exit();
  }

  public static function instance()
  {
    return new lmscx_admin_Async_Course();
  }
}

lmscx_admin_Async_Course::instance()->init();
