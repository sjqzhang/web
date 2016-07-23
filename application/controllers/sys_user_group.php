<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sys_user_group extends Base_Controller {

    public function __construct()
    {

        parent::__construct();
        $this->load->model('sys_model');

    }

    public function index()
    {

        $this->load->view('sys/sys_user_group');
    }

    public function get_list()
    {
        $_like = array();
        $order_by = array();
        $_where = array();

        $group_name = $this->input->post('group_name');

        if (!empty($group_name)) {
            $_like['group_name'] = $group_name;
        }

        $sort = $this->input->post('sort');
        if (!empty($sort)) {
            $order = explode('.', $sort);
            $order_by = array($order[0] => $order[1]);
        }

        $page_size = $this->input->post('page');
        $limit = $this->input->post('limit');
        $data = $this->sys_model->get_list('sys_user_group', $limit, $_where, $_like, $order_by, $page_size);
        echo json_encode($data);
    }
    public function add()
    {
        $params = $this->input->post(NULL, TRUE);

        foreach ($params as $k => $v) {
            $_data[$k] = $v;
        }
        unset($_data['id']);
        $_result = $this->sys_model->add_entity('sys_user_group', $_data);
        if ($_result) {
            $ot = array('code' => 0,
                'message' => '操作成功!');
        } else {
            $ot = array('code' => 1001,
                'message' => '操作失败!');
        }
        echo json_encode($ot);
    }
    public function edit()
    {
        $params = $this->input->post(NULL, TRUE);

        foreach ($params as $k => $v) {
            $_data[$k] = $v;
        }
        $_result = $this->sys_model->update_entity_byid('sys_user_group', $_data,$_data['id'],'id');
        if ($_result) {
            $ot = array('code' => 0,
                'message' => '操作成功!');
        } else {
            $ot = array('code' => 1001,
                'message' => '操作失败!');
        }
        echo json_encode($ot);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $_result = $this->sys_model->delete_entity_byarr('sys_user_group', 'id', $id);
        if ($_result) {
            $ot = array('code' => 0,
                'message' => '操作成功!');
        } else {
            $ot = array('code' => 1001,
                'message' => '操作失败!');
        }
        echo json_encode($ot);

    }

}

