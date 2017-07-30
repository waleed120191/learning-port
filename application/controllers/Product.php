<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->model('product_model');
        $this->_init();
        $this->load->library('cart');
        $this->load->helper('product_helper');
    }

    private function _init() {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
        $this->output->set_template('default');
        $this->load->css('assets/themes/default/css/bootstrap.min.css');
        $this->load->css('assets/themes/default/css/custom.css');
        $this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
        $this->load->js('assets/themes/default/js/bootstrap.min.js');
        $this->load->js('assets/themes/default/js/product.js');
    }

    // redirect if needed, otherwise display the user list
    public function index(){
        $data['session'] = $this->session->all_userdata();
        $data['products'] = $this->product_model->get_all();
        $this->load->view('product/index',$data);
    }
    
    // add product to session
    public function add(){
        $response = [];
        $id = $this->input->post('id');
        $product_data = $this->product_model->get_by_id($id);
        $qty = 1;
        
        $data = array(
            'id'      => $id,
            'qty'     => $qty,
            'price'   => $product_data->product_cost,
            'name'    => $product_data->product_name,
        );
        
        $row_id = $this->cart->insert($data);
     
        // rowId & productId relation in session.
        // TODO : Make better structure to store in session.
        
        $this->session->set_userdata($id.'_row_id', $row_id);
        
        
        $response['success'] = 1;

        
        echo json_encode($response);
        die();
    }
    
    public function get_total_products(){
        $count = total_items();
        $response['success'] = 1;
        $response['count'] = $count;
        
        echo json_encode($response);
        die();
    }

}
