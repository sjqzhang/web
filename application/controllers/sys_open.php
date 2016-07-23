<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Sys_Open extends Base_Controller {
    public function __construct(){
		//set_time_limit(0);
		//error_reporting(0); 
        parent::__construct();
	    $this->load->model('sys_open_model','model');

		//$this->load->model('report/re_dba_alarm_model','re_dba_alarm');
      
       // $this->load->model('report/re_dba_db_status_model','re_dba_db_status_model');
        

    }

	function index(){

		print_r("hello world");
	
	}



	function get_sys_template(){
      
        $this->load->model('sys_template_model','sys_template_model');
	
		$this->ajax_success($this->sys_template_model->get_sys_template());
	
	}
  
  	function get_sys_template_combox(){
      
       $this->load->model('sys_template_model','sys_template_model');
	
		$this->ajax_success($this->sys_template_model->get_sys_template_combox());
	
	}



  
  





}

?>
