<?php

class lmscx_Descubre_ajax
{
  public function init()
  {
    add_action('wp_ajax_lmscx_update_post_reviews', [$this, 'update_post_reviews']);
    add_action('wp_ajax_nopriv_lmscx_update_post_reviews', [$this, 'update_post_reviews']);
    add_action('wp_ajax_lmscx_get_post_reviews', [$this, 'get_post_reviews']);
  }

  public function get_post_reviews()
  {
    $descubre = $_POST['current_post'];

    echo json_encode(lmscx_CPTHelper::instance()->getCPTPostMeta($descubre, 'post-reviews', []));
    exit();
  }

  public function update_post_reviews()
  {
    $descubre = $_POST['current_post'];
    $message = $_POST['message'];
    lmscx_Descubre_Helper::instance()->updateDescubreReview($descubre, $message);
    echo json_encode((object)['message' => 'Gracias por tu comentario y por participar en el set DEScubre']);
    exit();
  }

  public static function instance()
  {
    $ajax = new lmscx_Descubre_ajax();
    $ajax->init();
  }
}

add_action('init', ['lmscx_Descubre_ajax', 'instance']);
