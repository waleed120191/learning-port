<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_login_user_name'))
{
    function get_login_user_name()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        return $CI->session->userdata('user_name');
    }   
}