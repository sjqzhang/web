<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


class Rbac
{

    protected $ci;

    function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->model("sys_user_model");
        $this->ci->load->model("sys_group_permission_model");
        $this->ci->load->config("rbac");
    }

    public function aoto_verify()
    {

        //目录
        $directory = substr($this->ci->router->fetch_directory(), 0, -1);
        if ($directory == "") {
            $directory = "";
        } else {
            $directory = $directory . "/";
        }
        //控制器
        $controller = $this->ci->router->fetch_class();
        //方法
        $function = $this->ci->router->fetch_method();

        $dir_path = $directory . $controller . "/" . $function;
        $ot = array('code' => 0,
            'message' => '没有权限，请联系管理员！'
        );

        if (!in_array($directory . $controller, $this->ci->config->item('rbac_notauth_dirc'))) {
            $_user = @$this->ci->session->userdata['admin'];
            if (empty($_user)) {
                $login = site_url("home/login");
                header("Location: $login");
            }
           // if (!MAuth::is_login()) {
          //      $login = site_url("home/login");
          //      header("Location: $login");
          //  }
         //   $_user = MAuth::get_user_info();
            if ($controller != $this->ci->router->default_controller) {
                $ret = $this->ci->sys_group_permission_model->checkPermission($dir_path, $_user['sys_group_id'],$_user['id']);
                if (!$ret) { //区分ajax请求
                    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                        echo json_encode($ot);
                        exit;
                    } else {
                        $error = site_url("home/error");
                        header("Location: $error");
                    }
                }
            }
        }
    }
}
