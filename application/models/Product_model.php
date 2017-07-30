<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends MY_Model {

    /**
     * Identity
     *
     * @var string
     * */
    public $identity;
    protected $json_file = 'product.json';
    protected $id_prefix = 'product';

    public function __construct() {
        parent::__construct();
    }

    
}
