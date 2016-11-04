<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Main extends Base_Controller {
 public function __construct()
    {
     parent::__construct();



	    $_gid=array
		(
			"id" => 15,
			"user_name" => 's-jqzhang',
			"password" => '323acd4bf35ae15285fcfb6edd67b0eb',
			"truename" => 's-jqzhang',
			"email" =>'s-jqzhang@web.com',
			"createdate" => '2014-09-11 17:12:19',
			"sys_group_id" => 1,
			"flag_valid" => 1,
		);


	  // $this->session->set_userdata('admin',$_gid);

	  


    }


	    public function index()
    {
        $this->load->model('sys_module_model');

       // $_gid = $this->session->userdata['admin'];
        $this->load->helper('cookie');
        /*
        $data['platform_id']= get_cookie('platform_id');
        if($data['platform_id']){
            $this->load->model('notice/nt_platform_model');
            $platform= $this->nt_platform_model->get_info($data['platform_id']);
            if($platform){
                $platform=$platform[0];
                $data['platform'] = $platform;
            }
            
         
        }
	*/
	   // $_gid = MAuth::get_user_info();

	           $_gid = $this->session->userdata['admin'];
        $data['menu'] = $this->sys_module_model->getMenu($_gid['sys_group_id'],$_gid['id']);
        $this->load->view('main', $data);
    }


/*

    public function index()
    {
        $this->load->model('sys_module_model');

        $_gid = $this->session->userdata['admin'];
		//print_r($_gid);die;
	    // $_gid = MAuth::get_user_info();
       $data['menu'] = $this->sys_module_model->getMenu($_gid['sys_group_id']);
        $this->load->view('main', $data);
    }

	*/

}

