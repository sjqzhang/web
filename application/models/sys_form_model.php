<?php
class sys_form_model extends MY_Model {
	public $_debug=false;
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'sys_form';
        $this->_pk= 'id' ;
        $this->_fields= array(
		//"id"=>"",
		"name"=>"",
		"file_name"=>"",
		"db"=>"",
			/*
		"ctrl"=>"",
		"model"=>"",
		"views"=>"",
		"js"=>"",
		*/
		) ;
        $this->_where=array(
				'id,keyword'=>'li',
				'0'=>'or',
				'name,keyword'=>'li',
				'1'=>'or',
				'file_name,keyword'=>'li',
				'2'=>'or',
				'db,keyword'=>'li',
				'3'=>'or',
				'ctrl,keyword'=>'li',
				'4'=>'or',
				'model,keyword'=>'li',
				'5'=>'or',
				'views,keyword'=>'li',
				'6'=>'or',
				'js,keyword'=>'li',
				'7'=>'or',
				);
        
    }

	public function data(){
	
	     $data=$this->req_data(array('keyword'));
		 $where= where($this->sys_form_model->_where,$data);
		 $this->db->select("*")->from("sys_form");
		 if(!empty($where)){
			$this->db->where(preg_replace('/^\s*where/i','', $where),NULL,false);
		 }
		 $this->ajax_page();

	}

	public function get_report($where){
		return $this->db->select('*')->from('sys_form')->where($where)->get()->result_array();
		
	}

} 
?>