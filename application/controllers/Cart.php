<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->model('product_model');
        $this->load->helper('product_helper');
        $this->_init();
        $this->load->library('cart');
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
        $data['cart_contents'] = $this->cart->contents();
        
//        echo '<pre>';
//        print_r($data['cart_contents']);
        
        $data['total_discount'] = $this->calculate_discount();
        $data['total_amount'] = $this->cart->total();
        $data['amount_after_discount'] = $this->cart->total() - $this->calculate_discount();
        $this->load->view('cart/index',$data);
    }

    public function calculate_discount(){
        $user_discount = $this->session->userdata('discount');
        
        $total_discount = 0;
        
        if($user_discount){
            foreach ($user_discount as $k => $v) {
                $params = [
                    'on' => isset($v->on)? $v->on : NULL,
                    'to' => isset($v->to)? $v->to : NULL,
                    'percent' => isset($v->percent)? $v->percent : NULL,
                    'onward' => isset($v->onward)? $v->onward : NULL,
                ];
                $total_discount = $total_discount + $this->calculate_discount_by_type($k,$v->discount_type,$params);
            }
        }
        
        return $total_discount;
    }
    
    public function calculate_discount_by_type($product,$type,$params){
        $row_id = $this->session->userdata($product . '_row_id');
        
        $discount_amount = 0;

        switch($type){
            
            case 'for': 
                $item = $this->cart->get_item($row_id);
                
                $item_qty = $item['qty'];
                $ratio = floor($item_qty /  $params['on']);    
                
                $discount_amount = 0;
                if($ratio > 0){
                    $discount_product_qty = ($params['on'] - $params['to']) * $ratio;
                    $discount_amount = $discount_product_qty * $item['price'];
                }

            break;
        
            case 'drop':
                $item = $this->cart->get_item($row_id);
                
                $item_qty = $item['qty'];
                $ratio = floor($item_qty /  $params['onward']); 
                
                $discount_amount = 0;
                if($ratio > 0){
                    $percent_amount = ($params['percent'] / 100) * $item['price'];
                    $discount_amount = $item['qty'] * $percent_amount;
                }

            break;
        
            default:
                
        }
        
        return $discount_amount;
    }
}
