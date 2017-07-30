<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->model('ion_auth_model');
        $this->_init();
    }

    private function _init() {
        $this->output->set_template('blank');
        $this->load->css('assets/themes/default/css/bootstrap.min.css');
        $this->load->css('assets/themes/default/css/custom.css');
        $this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
        $this->load->js('assets/themes/default/js/auth.js');
    }

    // redirect if needed, otherwise display the user list
    public function index() {

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $default = $this->router->default_controller;
            redirect($default, 'refresh');
        }
    }

    // log the user in
    public function login() {
        $this->data['title'] = 'Login';

        //validate form input
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {

            if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'))) {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', 'Successful login');
                redirect('/', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', 'Login Unsuccessful');
                redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            
            if ($this->ion_auth->logged_in()){
                $default = $this->router->default_controller;
                redirect($default, 'refresh');
            }

            $data['customers'] = $this->ion_auth_model->get_all();
            
            $this->load->view('auth/login',$data);
        }
    }

    // log the user out
    public function logout() {
        // log the user out
        $logout = $this->ion_auth->logout();
        // redirect them to the login page
        $this->session->set_flashdata('message', 'Successful logout');
        redirect('auth/login', 'refresh');
    }

}
