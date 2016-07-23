<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sys_group_permission extends Base_Controller {

    public function __construct()
    {

        parent::__construct();
        $this->load->model('sys_group_permission_model');
        $this->load->model('sys_module_model');

    }
    public function config(){

        //$_user = $this->session->userdata['admin'];
        $_group_id=$this->input->get('sys_group_id');
        $data['permission'] =$this->sys_module_model->getPermission($_group_id);
        $data['group_id'] = $_group_id;
        $this->load->view('sys/sys_group_permission_edit',$data);
    }

    public function change(){

        $_group_id = $this->input->get('group_id');
        $_module_id = $this->input->get('module_id');
        $_flag = $this->input->get('flag');

        if($_flag==1){
            $_data = array('user_group_id'=>$_group_id,'sys_module_id'=>$_module_id);
            echo $this->sys_group_permission_model->addEntity($_data)?STATUS_SUCCESS:STATUS_ERROR;
        }else{
            echo $this->sys_group_permission_model->deleteEntity(array('user_group_id'=>$_group_id,'sys_module_id'=>$_module_id))?STATUS_SUCCESS:STATUS_ERROR;
        }

    }

}

