<?php
class sys_log_model extends MY_Model {
	public $_debug=false;
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'sys_log';
        $this->_pk= 'id' ;
        $this->_fields= array("id"=>0,
		"url"=>"",
		"params"=>"",
		"error_code"=>"",
		"error_message"=>"",
		"ip"=>"",
		"admin_id"=>0,
		"time"=>0,
		"query"=>"",
		) ;
        $this->_where=array(
				'id,keyword'=>'li',
				'0'=>'or',
				'url,keyword'=>'li',
				'1'=>'or',
				'params,keyword'=>'li',
				'2'=>'or',
				'error_code,keyword'=>'li',
				'3'=>'or',
				'error_message,keyword'=>'li',
				'4'=>'or',
				'ip,keyword'=>'li',
				'5'=>'or',
				'admin_id,keyword'=>'li',
				'6'=>'or',
				'time,keyword'=>'li',
				'7'=>'or',
				'query,keyword'=>'li',
				'8'=>'or',
				);
        
    }

	public function data(){
	
	     $data=$this->req_data(array('keyword'));
		 $where= where($this->sys_log_model->_where,$data);
		 $this->db->select("*")->from("sys_log")->order_by('time desc');
		 if(!empty($where)){
			$this->db->where(preg_replace('/^\s*where/i','', $where),NULL,false);
		 }
		 $this->ajax_page();

	}


	  public function export(){
		 $this->load->helper('excel');
		 $data=$this->req_data(array('keyword'));
		 $where= where($this->sys_log_model->_where,$data);
		 $this->db->select("*")->from("sys_log");
		 if(!empty($where)){
			$this->db->where(preg_replace('/^\s*where/i','', $where),NULL,false);
		 }
		 $page= $this->page();
		  excel_export('',$page['items'],excel_header_map());

	}
} 
?>