<?php

class lmscx_Cart_Helper
{
  public function add_to_cart($product)
  {
    if (class_exists('WooCommerce')) {
      try {
        WC()->cart->add_to_cart($product);
        status_header(200);
        echo json_encode((object)['message' => esc_html__('Producto añadido al carrito', 'lms-matic-extender')]);
        return;
      } catch (Exception $e) {
        status_header(500);
        nocache_headers();
        echo json_encode((object)['message' => $e->getMessage()]);
        return;
      }
    }
  }

  public static function instance()
  {
    return new lmscx_Cart_Helper;
  }
}
