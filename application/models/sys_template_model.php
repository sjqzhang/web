<?php
class sys_template_model extends MY_Model {
	public $_debug=false;
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'sys_template';
        $this->_pk= 'id' ;
        $this->_fields= array(
		//"id"=>"",
		"name"=>"",
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
				'db,keyword'=>'li',
				'2'=>'or',
				'ctrl,keyword'=>'li',
				'3'=>'or',
				'model,keyword'=>'li',
				'4'=>'or',
				'views,keyword'=>'li',
				'5'=>'or',
				'js,keyword'=>'li',
				'6'=>'or',
				);
        
    }

	public function data(){
	
	     $data=$this->req_data(array('keyword'));
		 $where= where($this->sys_template_model->_where,$data);
		 $this->db->select("*")->from("sys_template");
		 if(!empty($where)){
			$this->db->where(preg_replace('/^\s*where/i','', $where),NULL,false);
		 }
		 $this->ajax_page();

	}

	function get_sys_template(){
		 $id=$this->input->post('id');

		 $rows=  $this->db->select('*')->from('sys_template')->where(array('id'=>$id))->get()->result_array();

		 foreach($rows as $i=> $row){
		 
		   $row['ctrl']= preg_replace('/\{\{projectname\}\}/',$this->config->item('project_name'),$row['ctrl']);
		   $row['model']= preg_replace('/\{\{projectname\}\}/',$this->config->item('project_name'),$row['model']);
		   $row['views']= preg_replace('/\{\{projectname\}\}/',$this->config->item('project_name'),$row['views']);
		   $row['js']= preg_replace('/\{\{projectname\}\}/',$this->config->item('project_name'),$row['js']);
		   $rows[$i]=$row;
		 
		 }
		 return $rows;
	}

	function get_sys_template_combox(){
		 return  $this->db->select('id value,name text')->from('sys_template')->get()->result_array();
	}
} 
?>