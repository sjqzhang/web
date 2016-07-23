<?php
class Sys_Open_model extends MY_Model {
    public function __construct()
    {
        parent::__construct();
        $this->_table = '';
        $this->_pk= 'id' ;
        $this->_fields= array() ;
        
    }


	function get_sys_template_combox(){
		 return  $this->db->select('*')->from('sys_template')->get()->result_array();
	}





	
} 
?>