<?php

class lmsx_USER_Model
{

  public function findUsersByString($string)
  {
    $users = new WP_User_Query(array(
      'search'         => '*' . esc_attr($string) . '*',
      'search_columns' => array(
        'user_login',
        'user_nicename',
        'display_name',
        'user_email',
        'user_url',
      ),
    ));
    return $users->get_results();
  }

  public function getUserMeta($user, $meta, $default)
  {
    $result = get_user_meta($user, $meta, true);
    return $result != null ? $result : $default;
  }

  public static function instance()
  {
    return new lmsx_USER_Model();
  }
}
