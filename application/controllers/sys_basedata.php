
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
//基础资料      
class sys_basedata extends Base_Controller {
 public function __construct()
    {

        parent::__construct();
        $this->load->model('sys_basedata_model');
    

    }
    //查询列表
    public function data(){
 
		$this->sys_basedata_model->data();

    }

    //页面显示
    public function index()
    {
        $this->load->view('sys/sys_basedata');
    }

	//列表
    public function get_parent_list()
    {
       $this->ajax_success($this->sys_basedata_model->get_parent_list());
    }


	//列表
    public function get_basedata_for_ztree()
    {
      // $this->ajax_success($this->sys_basedata_model->get_basedata_for_ztree());
	  $pid=$this->input->post('id');
	  //echo($pid);// Exibe uma ou mais strings
	  print_r(json_encode($this->sys_basedata_model->get_basedata_for_ztree($pid)));
    }


	

    
    //增加
    public function add(){
        $data=$this->req_data($this->sys_basedata_model->_fields);
		if(empty( $data['pid'])){
			$data['pid']='-1';	
		}
        if($this->sys_basedata_model->add($data)){
            $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
    //修改
    public function edit(){ 
        $where= $this->req_data(array($this->sys_basedata_model->_pk));
        $data=$this->req_data($this->sys_basedata_model->_fields);
        if($this->sys_basedata_model->edit($data,$where)) {
          $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
	//删除
    public function del(){ 
        $where= $this->req_data(array($this->sys_basedata_model->_pk));
         if($this->sys_basedata_model->del($where)) {
           $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }





}

?>
 