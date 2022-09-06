<?php

class lmscx_IP
{
  function __construct()
  {
    $this->user_ip = '';

    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $this->user_ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $this->user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
      $this->user_ip = $_SERVER['REMOTE_ADDR'];
    }
    return $this->user_ip;
  }

  public function getUserIP()
  {
    return $this->user_ip;
  }

  public static function instance()
  {
    return new lmscx_IP;
  }
}
