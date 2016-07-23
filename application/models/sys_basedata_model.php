<?php
class sys_basedata_model extends MY_Model {
	public $_debug=false;
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'sys_basedata';
        $this->_pk= 'id' ;
        $this->_fields= array(
		//"id"=>"",
		"name"=>"",
		"pid"=>"",
		"sort"=>0,
		"value"=>"",
		"code"=>"",
		) ;
        $this->_where=array(
				//'id,keyword'=>'li',
				'0'=>'or',
				'sys_basedata.name,keyword'=>'li',
				'1'=>'or',
				//'pid,keyword'=>'li',
				'2'=>'or',
				//'sort,keyword'=>'li',
				'3'=>'or',
				//'value,keyword'=>'li',
				'4'=>'or',
				//'code,keyword'=>'li',
				'5'=>'or',
				);
        
    }

	public function data(){
	
	     $data=$this->req_data(array('keyword'));
		 $where= where($this->sys_basedata_model->_where,$data);
		 //$this->db->select("*")->from("sys_basedata");

		 $this->db->select("sys_basedata.*,wf2.name name2 ")->from('sys_basedata')->join('sys_basedata wf2','sys_basedata.pid=wf2.id','left');
		 if(!empty($where)){
			$this->db->where(preg_replace('/^\s*where/i','', $where),NULL,false);
		 }
		 $this->ajax_page();

	}

	public function get_parent_list(){
		return $this->db->select('id value,name text')->from('sys_basedata')->where(array('pid'=>-1))->get()->result_array();
	}

	public function get_basedata_by_type($type){
		return  $this->db->select("sys_basedata.*")->from('sys_basedata')->join('sys_basedata wf2','sys_basedata.pid=wf2.id','inner')->where(array('wf2.code'=>$type))->get()->result_array();
	}

	public function get_basedata_for_combox($type){
		$data=$this->get_basedata_by_type($type);
		foreach($data as $k=>$row){
			$row['data']=json_encode($row);
			$row['text']=$row['name'];
			$row['value']=$row['id'];
			$data[$k]=$row;
		}
		return $data;
	}

	public function get_basedata_for_combox2($type){
		$data=$this->get_basedata_by_type($type);
		foreach($data as $k=>$row){
			$row['data']=json_encode($row);
			$row['text']=$row['name'];
			$row['value']=$row['id'];
			$data[$k]=$row;
		}
		return $data;
	}


	public function get_basedata_map_js($type){
	   $data=array();
	   $rows=$this->get_basedata_by_type($type);
	   $data['0']='全部';
	   foreach($rows as $row) {
		  $data[$row['id']]=$row['name'];
	   }
	   return '<script> var WF_BASEDATA_MAP='.json_encode($data).';</script>';
	   
	}

	public function get_basedata_for_ztree2($pid=-1){
			return  $this->db->select("sys_basedata.*")->from('sys_basedata')->where(array('pid'=>$pid))->get()->result_array();

	}

	function has_child($id){
		$rs = mysql_query("select count(*) from sys_basedata where pid=$id");
		$row = mysql_fetch_array($rs);
		return $row[0] > 0 ? true : false;
	}


		public function get_basedata_for_ztree($pid=-1){
		  if(	empty($pid)){
			  $pid=-1;
		  }
		$data=$this->get_basedata_for_ztree2($pid);
	
		  foreach($data as $k=>$row){
				$row['value']=$row['id'];
				$row['data']=$row['value'];
				$row['isParent']= $this->has_child($row['id']);
				$data[$k]=$row;
		 }
		
		return $data;
	}


} 
?>