<?php

class lmscx_Descubre_Helper
{
  public function updateDescubreReview($descubre, $message) {
    $meta = lmscx_CPTHelper::instance()->getCPTPostMeta($descubre, 'post-reviews', []);
    if(!is_array($meta)) $meta = [];

    $meta[] = $message;
  
    update_post_meta($descubre, 'post-reviews', $meta);
  }

  public static function instance()
  {
    return new lmscx_Descubre_Helper;
  }
}
