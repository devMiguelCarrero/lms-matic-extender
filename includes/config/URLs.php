<?php

class lmscx_URLs
{

    function __construct()
    {
        $this->main_url = LMSCX_SITE_URL;
        $this->ajax_url = admin_url('admin-ajax.php');
    }

    public function get_array()
    {
        $URLs = [
            'main_url' => $this->main_url,
            'ajax_url' => $this->ajax_url
        ];

        if (class_exists('WooCommerce')) {
            $URLs['checkout'] = wc_get_checkout_url();
        }

        return $URLs;
    }

    public static function instance()
    {
        return new lmscx_URLs;
    }
}
