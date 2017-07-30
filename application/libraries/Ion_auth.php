<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ion_auth {

    /**
     * __construct
     */
    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->config->load('ion_auth', TRUE);
        $this->CI->load->helper(array('cookie', 'language', 'url'));
        $this->CI->load->library('session');
        $this->CI->load->model('ion_auth_model');
    }

    /**
     * logout
     * */
    public function logout() {
        $identity = $this->CI->config->item('identity', 'ion_auth');

        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->CI->session->unset_userdata(array($identity => '', 'id' => '', 'user_id' => ''));
        } else {
            $this->CI->session->unset_userdata(array($identity, 'id', 'user_id'));
        }

        // Destroy the session
        $this->CI->session->sess_destroy();

        //Recreate the session
        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->CI->session->sess_create();
        } else {
            if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
                session_start();
            }
            $this->CI->session->sess_regenerate(TRUE);
        }

        return TRUE;
    }

    /**
     * logged_in
     * */
    public function logged_in() {

        $recheck = $this->CI->ion_auth_model->recheck_session();
        return $recheck;
    }

    public function login($identity, $password) {
        return $this->CI->ion_auth_model->login($identity, $password);
    }

}
