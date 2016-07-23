
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
//系统日志      
class sys_log extends Base_Controller {
 public function __construct()
    {

        parent::__construct();
        $this->load->model('sys_log_model');
    

    }
    //查询列表
    public function data(){
 
		$this->sys_log_model->data();

    }

	//导出数据
    public function export(){
 
	   $this->sys_log_model->export();     

    }

    //页面显示
    public function index()
    {
        $this->load->view('sys/sys_log');
    }

    
    //增加
    public function add(){
        $data=$this->req_data($this->sys_log_model->_fields);
        if($this->sys_log_model->add($data)){
            $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
    //修改
    public function edit(){ 
        $where= $this->req_data(array($this->sys_log_model->_pk));
        $data=$this->req_data($this->sys_log_model->_fields);
        if($this->sys_log_model->edit($data,$where)) {
          $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
	//删除
    public function del(){ 
        $where= $this->req_data(array($this->sys_log_model->_pk));
         if($this->sys_log_model->del($where)) {
           $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }

}

?>
 