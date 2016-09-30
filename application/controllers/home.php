<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Base_Controller
{

    public function index()
    {
        $this->load->model('sys_module_model');

        $_gid = $this->session->userdata['admin'];

        $data['menu'] = $this->sys_module_model->getMenu($_gid['sys_group_id']);
        print_r($data);
//        $this->load->view('main', $data);
    }

    public function login()
    {

		if($this->config->config['use_ldap']){
		
		
			if (IS_POST) {
				$_username = $this->input->post("user_name");
				$_password = $this->input->post("password");
				$this->load->model("sys_user_model");
				
				$this->load->library('ldap');
				$_username=str_replace(LDAP_EMAIL, '', $_username);
				$ldap_res = $this->ldap->bind($_username,$_password);
				$_admin = $this->sys_user_model->getEntity(array("user_name" => $_username));
				if($ldap_res == 1){
						 if(!empty($_admin)){
								if ($_admin['flag_valid'] == 1) {
									unset($_admin['password']);

									 MAUTH::after_login($_admin,true);
									$this->session->set_userdata(array("admin" => $_admin));
									$ot = array('code' => 0,
										'message' => '登录成功!');
								} else {
									$ot = array('code' => 1001,
										'message' => '账号已停用!');
								}
						 }else{ //添加用户

								$_data = array(
										'user_name'=>$_username,
										'truename'=>$_username,
										'password'=>md5($_password.time()),
										'email'=> $_username.LDAP_EMAIL,
										'createdate'=>date('Y-m-d H:i:s'),
										'sys_group_id'=>'2',//普通用户组 这个>等用户组表调整以后修改
										'flag_valid'=>1
								);
								$this->sys_user_model->addEntity($_data);
								//获取用户 用session保存登录跟上面保持一致
								$_admin = $this->sys_user_model->getEntity(array("user_name" => $_username));
								$this->session->set_userdata(array("admin" => $_admin));
								 unset($_admin['password']);
								MAuth::after_login($_admin,true);
								$ot = array('code' => 0,
									'message' => '登录成功!');
						 }
				}else{
						$ot = array('code' => 1002,
							'message' => '账号或密码错误!');
				}

				echo json_encode($ot);


			} else {
			 $this->load->view('login');
			}

		} else {
			
		
        
			if (IS_POST) {
				$_username = $this->input->post("user_name");
				$_password = $this->input->post("password");
				$_admin = $this->sys_user_model->getEntity(array("user_name" => $_username,'password'=>md5($_password)));
				if (!empty($_admin)) {
					if ($_admin['flag_valid'] == 1) {
						$this->session->set_userdata(array("admin" => $_admin));
						MAUTH::after_login($_admin,true);
						$ot = array('code' => 0,
							'message' => '登录成功!');
					} else {
						$ot = array('code' => 1001,
							'message' => '账号已停用!');
					}
				} else {
					$ot = array('code' => 1002,
						'message' => '账号或密码错误!');
				}
				echo json_encode($ot);
			} else {
				$this->load->view('login');
			}
			
		}

    }


    public function logout()
    {
        MAuth::logout();
        //$_user = $this->session->userdata['admin'];



        //if (!empty($_user)) {

        //    $this->session->unset_userdata('admin');
        //}
        $login = site_url("home/login");
        header("Location: $login");

    }
    public function error()
    {
        $this->load->view('error');

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
