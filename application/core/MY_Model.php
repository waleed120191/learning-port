<?php
class MY_Model extends CI_Model {

    private $data_folder_path = './application/data/';
    
    protected $json_file;
    protected $id_prefix;
    protected $json_decoded_data;
    
    function __construct()
    {
        parent::__construct();
        
        $this->get_json_file_data();
    }
        
    function get_all(){
        return (count($this->json_decoded_data) > 0)?$this->json_decoded_data:FALSE;
    }
    
    function get_by_id($id){
        
        foreach ($this->json_decoded_data as $data) {
            $data_id = $this->id_prefix . '_id';
            if($data->$data_id == $id){
                return $data;
            }
        }
        
        return FALSE;
    }
 
    function get_where($where = []){

        $where_count = count($where);
        $return = [];
        if($where_count < 0){
            return FALSE;
        }
        error_log('$where_count');
        error_log(print_r($where_count,TRUE));
        
        
        error_log('$this->json_decoded_data');
        error_log(print_r($this->json_decoded_data,TRUE));
        
        foreach ($this->json_decoded_data as $data) {
            
            $inner_loop_count = 1;
            foreach ($where as $k => $v) {               
                if(isset($data->$k) AND $data->$k == $v){
                    // all cases passed and this is matched element
                    if($where_count == $inner_loop_count){
                        $return[] = $data;
                    }
                    $inner_loop_count++;
                    continue;
                }else{
                    $inner_loop_count++;
                    break;
                }
            }  
        }
        
        return (count($return) > 0)?$return:FALSE;
    }
    
    function get_json_file_data()
    {
        if(!$this->json_file){
            throw new \Exception("json file name not defined");
        }
        
        $this->json_decoded_data = json_decode(file_get_contents($this->data_folder_path . $this->json_file));
    }
}