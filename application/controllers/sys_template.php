
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
//sys_template      
class sys_template extends Base_Controller {
 public function __construct()
    {

        parent::__construct();
        $this->load->model('sys_template_model');
    

    }
    //查询列表
    public function data(){
 
		$this->sys_template_model->data();

    }

    //页面显示
    public function index()
    {
        $this->load->view('sys/sys_template');
    }

    
    //增加
    public function add(){
        $data=$this->req_data($this->sys_template_model->_fields);
		$data['ctrl']= $_POST['ctrl'];
		$data['views']= $_POST['views'];
		$data['js']= $_POST['js'];
		$data['model']= $_POST['model'];
        if($this->sys_template_model->add($data)){
            $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
    //修改
    public function edit(){ 
        $where= $this->req_data(array($this->sys_template_model->_pk));
        $data=$this->req_data($this->sys_template_model->_fields);
		$data['ctrl']= $_POST['ctrl'];
		$data['views']= $_POST['views'];
		$data['js']= $_POST['js'];
		$data['model']= $_POST['model'];
        if($this->sys_template_model->edit($data,$where)) {
          $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
	//删除
    public function del(){ 
        $where= $this->req_data(array($this->sys_template_model->_pk));
         if($this->sys_template_model->del($where)) {
           $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }

}

?>
 