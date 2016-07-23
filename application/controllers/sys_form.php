
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
//sys_form      
class sys_form extends Base_Controller {
 public function __construct()
    {

        parent::__construct();
        $this->load->model('sys_form_model');
		//$this->project_name=$this->config->item('project_name');

		$this->checkdir();

		
    

    }
    //查询列表
    public function data(){
 
		$this->sys_form_model->data();

    }

    //页面显示
    public function index()
    {
        $this->load->view('sys/sys_form');
    }

    
    //增加
    public function add(){
        $data=$this->req_data($this->sys_form_model->_fields);
		$data['ctrl']= $_POST['ctrl'];
		$data['views']= $_POST['views'];
		$data['js']= $_POST['js'];
		$data['model']= $_POST['model'];
		$this->save_report();
        if($this->sys_form_model->add($data)){
            $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
    //修改
    public function edit(){ 
        $where= $this->req_data(array($this->sys_form_model->_pk));
        $data=$this->req_data($this->sys_form_model->_fields);
		$data['ctrl']= $_POST['ctrl'];
		$data['views']= $_POST['views'];
		$data['js']= $_POST['js'];
		$data['model']= $_POST['model'];
		$this->save_report();
        if($this->sys_form_model->edit($data,$where)) {
          $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
	//删除
    public function del(){ 
        $where= $this->req_data(array($this->sys_form_model->_pk));
        $report= $this->sys_form_model->get_report($where);
		$this->delete_report($report);
         if($this->sys_form_model->del($where)) {
           $this->ajax_success(1);
        }  else {
			$this->ajax_error(0); 
		}   
    }
    
	function write($fn,$content){
		$fp= fopen($fn,'w+');
		fwrite($fp,$content);
		fclose($fp);
	}

	function read($fn){
		$fp= fopen($fn,'r');
		$content='';
		if(filesize($fn)>0){
			$content=fread($fp,filesize($fn));
		}
		fclose($fp);
		return $content;
	}

	function checkdir(){

		$project_name=$this->config->item('project_name');

		$ctrl_path=APPPATH."controllers/$project_name/";
		$js_path=RES_PATH."/$project_name/js/";
		$views_path=APPPATH."views/$project_name/";
		$model_path=APPPATH."models/$project_name/";
	
	  if(!is_dir($ctrl_path)){
		mkdir($ctrl_path);
	  }
	  if(!is_dir($model_path)){
		mkdir($model_path);
	  }
	  if(!is_dir(RES_PATH."/$project_name/")){
		  mkdir(RES_PATH."/$project_name/");
		  if(!is_dir($js_path)){
				mkdir($js_path);
		  }
	  }
	  if(!is_dir($views_path)){
		mkdir($views_path);
	  }
	
	}
	//保存模板
	function save_report(){
		$ctrl= $_POST['ctrl'];
		$views= $_POST['views'];
		$js= $_POST['js'];
		$model= $_POST['model'];
		$file_name= $_POST['file_name'];
		$project_name=$this->config->item('project_name');
		$this->write(APPPATH."controllers/$project_name/".$file_name.'.php',$ctrl);
		$this->write(APPPATH."views/$project_name/".$file_name.'.php',$views);
		$this->write(APPPATH."models/$project_name/".$file_name.'_model.php',$model);
		$this->write(RES_PATH."/$project_name/js/".$file_name.'.js',$js);
	}
	//删除模板
	function delete_report($report){
		$file_name= $report[0]['file_name'];
		$project_name=$this->config->item('project_name');
		
		unlink(APPPATH."controllers/$project_name/".$file_name.'.php');
		unlink(APPPATH."views/$project_name/".$file_name.'.php');
		unlink(APPPATH."models/$project_name/".$file_name.'_model.php');
		unlink(RES_PATH."/$project_name/js/".$file_name.'.js');
	}
    //载入模板
	function load_report(){
	    $file_name=$this->input->post('file_name');
		$project_name=$this->config->item('project_name');
		$ctrl=$this->read(APPPATH."controllers/$project_name/".$file_name.'.php');
		$views=$this->read(APPPATH."views/$project_name/".$file_name.'.php');
		$model=$this->read(APPPATH."models/$project_name/".$file_name.'_model.php');
		$js=$this->read(RES_PATH."/$project_name/js/".$file_name.'.js');
		$data=array('ctrl'=>$ctrl,'views'=>$views,'model'=>$model,'js'=>$js);
		return $this->ajax_success($data);
	}
	/*检查模板*/
	function check_report(){
	     $where=array('file_name'=>$this->input->post('file_name'));
	     $report= $this->sys_form_model->get_report($where);
		 $this->ajax_success(count($report));
	  
	}

}

?>
 