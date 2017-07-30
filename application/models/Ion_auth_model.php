<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ion_auth_model extends MY_Model {

    /**
     * Identity
     *
     * @var string
     * */
    public $identity;
    protected $json_file = 'user.json';
    protected $id_prefix = 'user';

    public function __construct() {
        parent::__construct();
        $this->config->load('ion_auth', TRUE);
        $this->load->helper('cookie');
    }

    /**
     * login
     * */
    public function login($identity, $password) {

        if (empty($identity) || empty($password)) {
            return FALSE;
        }

        $user = $this->get_where(['user_email' => $identity, 'user_password' => $password]);
        
        if (isset($user[0])) {
            $this->set_session($user[0]);
            return TRUE;
        }

        return FALSE;
    }

    public function recheck_session() {  
        $identity = $this->config->item('identity', 'ion_auth');
        $user = $this->get_where(['user_email' => $this->session->userdata($identity)]);
        
        if (!$user) {
            $identity = $this->config->item('identity', 'ion_auth');

            if (substr(CI_VERSION, 0, 1) == '2') {
                $this->session->unset_userdata(array($identity => '', 'id' => '', 'user_id' => ''));
            } else {
                $this->session->unset_userdata(array($identity, 'id', 'user_id'));
            }
            return false;
        }

        return (bool) $this->session->userdata($identity);
    }

    /**
     * set_session
     * */
    public function set_session($user) {
        $session_data = array(
            'user_name' => $user->user_name,
            'user_username' => $user->user_username,
            'user_email' => $user->user_email,
            'user_id' => $user->user_id, //everyone likes to overwrite id so we'll use user_id
            'user_type' => $user->user_type,
            'discount' => $user->discount
        );

        $this->session->set_userdata($session_data);
        return TRUE;
    }

}
