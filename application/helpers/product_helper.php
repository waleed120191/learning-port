<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('total_items'))
{
    function total_items()
    {
        $CI = &get_instance();
        $CI->load->library('cart');
        return $CI->cart->total_items();
    }   
}

