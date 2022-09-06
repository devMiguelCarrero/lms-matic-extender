<?php

class lmscx_Descubre_Helper
{
  public function updateDescubreReview($descubre, $message)
  {
    $meta = lmscx_CPTHelper::instance()->getCPTPostMeta($descubre, 'post-reviews', []);
    if (!is_array($meta)) $meta = [];

    $meta[] = $message;
    update_post_meta($descubre, 'post-reviews', $meta);
  }

  public function updateDescubreReviewOption($descubre, $option)
  {
    $meta = lmscx_CPTHelper::instance()->getCPTPostMeta($descubre, 'lms-post-options', []);
    if (!is_array($meta)) $meta = [];

    $user_ip = lmscx_IP::instance()->getUserIP();
    $findIp = array_search($user_ip, array_column($meta, 'IP'));

    if ($findIp === false) {
      $meta[] = (object)['option' => $option, 'IP' => lmscx_IP::instance()->getUserIP()];
    } else {
      $meta[$findIp] = (object)['option' => $option, 'IP' => lmscx_IP::instance()->getUserIP()];
    }

    update_post_meta($descubre, 'lms-post-options', $meta);
  }

  public static function instance()
  {
    return new lmscx_Descubre_Helper;
  }
}
