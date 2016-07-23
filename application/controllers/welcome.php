<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Base_Controller {




 public function __construct()
    {
     parent::__construct();
	
	
	    $_gid=array
		(
			"id" => 4,
			"user_name" => 's-jqzhang',
			"password" => '323acd4bf35ae15285fcfb6edd67b0eb',
			"truename" => '小张',
			"email" =>'s-jqzhang@web.com',
			"createdate" => '2014-09-11 17:12:19',
			"sys_group_id" => 1,
			"flag_valid" => 1,
		);
		

	   $this->session->set_userdata('admin',$_gid);
	

    }


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/default.php/welcome
	 *	- or -  
	 * 		http://example.com/default.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /default.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->load->view('main');
	}
    public function login()
    {

        $this->load->view('login');
    }
    public function test()
    {

        $ot = array('code' => 0 ,
            'message' => 'error',
            'data' => 'fff');

        //区分ajax请求
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            echo json_encode($ot);
        }else{
            $this->load->view('test.html');
        }

    }

    public function test2()
    {
        $this->load->view('sys/sys_user_list');

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */