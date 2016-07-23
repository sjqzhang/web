<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sys_module extends Base_Controller {

    public function __construct()
    {

        parent::__construct();
        $this->load->model('sys_module_model');

    }

	public function index()
	{

        $_where = array('module_type'=>'module');
        $_order_by = array('module_order' => 'asc');

        $list = $this->sys_module_model->getList( $_where, array('*'), $_order_by);

        for($i=0;$i<count($list);$i++){

            $page = $this->sys_module_model->getList(array('module_parent_id'=>$list[$i]['id']), array('*'), $_order_by);

            for($j=0;$j<count($page);$j++){
                $action = $this->sys_module_model->getList(array('module_parent_id'=>$page[$j]['id']), array('*'), $_order_by);

                $page[$j]['children'] = $action;
            }

            $list[$i]['children'] = $page;
        }
        $data['list'] = $list;
        $this->load->view('sys/sys_module_list',$data);

    }

    public function add()
    {
        $_module_type = $this->input->get_post('module_type');
		$_module_parent_idd=$this->input->get_post('module_parent_id');
        $_module_parent_id = empty( $_module_parent_idd)?'0':$this->input->get_post('module_parent_id');
        $data['module_type'] = $_module_type;
        $data['parent_id'] = $_module_parent_id;
        if(IS_POST){
            $_data = $this->parseData(array('module_name','module_resource','module_icon'));
            #$_data['id'] = '';
            $_data['module_type'] = $_module_type;
            $_data['module_parent_id'] = $_module_parent_id;
            $_result = $this->sys_module_model->addEntity($_data);
            if ($_result) {
                $ot = array('code' => 0 ,
                    'message' => '操作成功!');
            } else {
                $ot = array('code' => 1001,
                    'message' => '操作失败!');
            }
            echo json_encode($ot);
        }else{
            $this->load->view('sys/sys_module_add',$data);
        }

    }

    public function edit()
    {
        $_id = $this->input->get_post('id');
        $_module_type = $this->input->get_post('module_type');
        $_module_parent_id = $this->input->get_post('module_parent_id');
        $data['module_type'] = $_module_type;
        $data['parent_id'] = $_module_parent_id;
        if(IS_POST){
            $_data = $this->parseData(array('module_name','module_resource','module_icon'));
            $_data['id'] = $_id;
            $_result = $this->sys_module_model->updateEntityByID($_data,$_id);
            if ($_result) {
                $ot = array('code' => 0 ,
                    'message' => '操作成功!');
            } else {
                $ot = array('code' => 1001,
                    'message' => '操作失败!');
            }
            echo json_encode($ot);
        }else{
            $data['entity'] = $this->sys_module_model->getEntityByID($_id);
            $this->load->view('sys/sys_module_edit',$data);
        }
    }

    public function delete()
    {
        $_id = $this->input->get('id');
        echo $this->sys_module_model->deleteEntityByID($_id)?STATUS_SUCCESS:STATUS_ERROR;
    }

    public function sort(){

        $_idlist = array();
        $_idlist = $this->input->get_post('module');

        $_ids = array();
        $_ids = explode('|',$_idlist);

        for ($i=0; $i<count($_ids); $i++)
        {
            $this->sys_module_model->updateEntityByID(array('module_order'=>$i),$_ids[$i]);
        }

        $_idlist = array();
        $_idlist = $this->input->get_post('page');
        $_ids = array();
        $_ids = explode('|',$_idlist);

        for ($i=0; $i<count($_ids); $i++)
        {
            $this->sys_module_model->updateEntityByID(array('module_order'=>$i),$_ids[$i]);
        }

        echo STATUS_SUCCESS;
    }

}

