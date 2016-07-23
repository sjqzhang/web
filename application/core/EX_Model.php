<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class EX_Model  extends CI_Model {
   public function __construct()
    {
        parent::__construct();
		$this->load->helper('db');
		$this->_debug=false;
		
       
    }

	//修改
    public function edit($data,$where){ 
        if($this->db->update($this->_table,$data,$where)) {
           return $this->db->affected_rows();
        } else {
			return 0;
		}    
    }
	//删除
    public function del($where){ 
         if($this->db->delete($this->_table,$where)) {
            return $this->db->affected_rows();
         } else {
			return 0;
		 }    
    }
	//增加
    public function add($data){
        if($this->db->insert($this->_table,$data)){
			return $this->db->affected_rows();
        } else {
			return 0;
		}    
    }
    //取数据
	public function req_data($map){
		return $this->ci()->req_data($map);
	}
    //取框架
	function &ci(){
	   return CI_Controller::get_instance();
	}
    //取结果
	function query($sql){
		$data=array();
		if(is_string($sql)) {
			$query=$this->db->query($sql);
		} else {
		   $query=$sql;
		}
		if(preg_match('/\s*insert\s+|\s*update\s+|\s*delete\s+|\s*replace\s+/i',$sql)){
			return $this->db->affected_rows();
		}
		foreach ($query->result_array() as $i=> $row){
		   $data[$i]=$row;
		}
		return $data;
	}



		//生成分页数据
	function ajax_sql_page($sql='',$where='',$order=''){
		$db=$this->db;
	  	$pager=array();
		$sqls=array();
		$limit='';

		 $offset=$this->ci()->input->post('limit');
		 if($offset){
            $page=$this->ci()->input->post('page');
            if(empty($page)){
               $page=1;
            }
            if(empty($offset)){
                $offset=50;
            }
              $start=($page-1)*$offset;
            $limit="limit $start,$offset";

		}


		if(!empty($order)){
		$order=' order by  '.$order;
		}
		
		$sql0="select * from ($sql) _tt $where  $limit";
        
		$pager['items']=$this->query($sql0);
		$sql1="select count(1) as cnt from ($sql) _tt $where";

		$cnt=$this->query($sql1);

		$pager['totalCount']=$cnt[0]['cnt'];

		print_r(json_encode($pager));die;
		
		return $pager;
		
	}

	//生成分页数据
	function page($_db=''){
		if(empty($_db)){
			$db=$this->db;
		} else {
			$db=$_db;
		}
	  	$pager=array();
		$sqls=array();
        if(!$db->ar_limit){//page
            $offset=$this->ci()->input->post('limit');
            $page=$this->ci()->input->post('page');
            if(empty($page)){
               $page=1;
            }
            if(empty($offset)){
                $offset=20;
            }
              $start=($page-1)*$offset;
             $db->limit($offset,$start);
        } 
		$pager['items']=$db->get()->result_array();
		$sql= $db->last_query();
		$sqls['0']=$sql;
		$sql=preg_replace('/\s+order\s+by[\s\S]+$/i','', $sql);
		$sql=preg_replace('/limit\s+\d+\s*\,\s*\d+|limit\s+\d+$/i','', $sql);
		$sql=preg_replace('/select[\s\S]*?from/i','select count(1) cnt from', $sql);
		$sqls[1]=$sql;
		$cnt= $db->query($sql)->row_array();
		$pager['totalCount']=$cnt['cnt'];
		if($this->_debug){
			$pager['sql']=$sqls;
		}
		return $pager;
		
	}

	function ajax_page($db=''){
		$page=$this->page($db);
		print_r(json_encode($page));die;
	}
	

} 