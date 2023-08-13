<?php

class lmsx_COURSE_Model
{

  public function findScheduledStudents($course)
  {
    $meta = lmscx_CPTHelper::instance()->getCPTPostMeta($course, 'course-students', []);

    if (count($meta) == 0) {
      return [];
    }

    $users = new WP_User_Query(array(
      'include' => $meta,
    ));
    return $users->get_results();
  }

  public static function instance()
  {
    return new lmsx_COURSE_Model();
  }
}
