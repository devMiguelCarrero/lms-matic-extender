<?php

class lmscx_admin_Async_User
{
  public function init()
  {
    add_action('wp_ajax_lmsx_search_users_by_string', [$this, 'search_users_by_string']);
  }

  public function search_users_by_string()
  {
    $string = esc_attr($_POST['string']);
    echo json_encode(lmsx_USER_Model::instance()->findUsersByString($string));
    exit();
  }

  public static function instance()
  {
    return new lmscx_admin_Async_User();
  }
}

lmscx_admin_Async_User::instance()->init();
