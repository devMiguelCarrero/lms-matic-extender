<?php

class lmscx_Cart_ajax
{
  public function init()
  {
    add_action('wp_ajax_lmscx_add_product_to_cart', [$this, 'add_to_cart']);
    add_action('wp_ajax_nopriv_lmscx_add_product_to_cart', [$this, 'add_to_cart']);
  }

  public function add_to_cart()
  {
    $product_id = $_POST['product'];
    lmscx_Cart_Helper::instance()->add_to_cart($product_id);
    exit();
  }

  public static function instance()
  {
    $ajax = new lmscx_Cart_ajax();
    $ajax->init();
  }
}

add_action('init', ['lmscx_Cart_ajax', 'instance']);
