<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sys_user extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sys_model');
    }
    public function index()
    {
        $data['user_groups'] = query($this,"select * from sys_user_group");
        $this->load->view('sys/sys_user_list',$data);
    }
    public function get_list()
    {
        $_like = array();
        $order_by = array();
        $_where = array();

        $truename = $this->input->post('truename');

        if (!empty($truename)) {
            $_like['truename'] = $truename;
        }

        $sort = $this->input->post('sort');
        if (!empty($sort)) {
            $order = explode('.', $sort);
            $order_by = array($order[0] => $order[1]);
        }

        $page_size = $this->input->post('page');
        $limit = $this->input->post('limit');
        $data = $this->sys_model->get_list('sys_user', $limit, $_where, $_like, $order_by, $page_size,
            array('sys_user.*','group_name'),
            array(
                array(
                    'table'=>'sys_user_group',
                    'on'=>'sys_user_group.id=sys_group_id',
                    'd'=>'left'
                )
            )
        );
        echo json_encode($data);
    }

    public function add()
    {
        $params = $this->input->post(NULL, TRUE);

		if(!isset($params['sys_group_id'])){
		 $ot = array('code' => 1001,
                    'message' => '请选择用户组!');
		  echo json_encode($ot);
			
			return;
		} else {
			$sys_group_ids=explode(",", $params['sys_group_id']);
			$params['sys_group_id']=0;
		}

		unset($params['id']);

        foreach ($params as $k => $v) {
            $_data[$k] = $v;
        }
        $_check = $this->sys_model->get_count('sys_user',array(
            'user_name'=>$this->input->post('user_name')
        ));
        if($_check==0){
            $_data['password'] = get_password($this->input->post('password'));
            $_result = $this->sys_model->add_entity('sys_user', $_data);
			$this->sys_model->set_group_user($this->db->insert_id(),$sys_group_ids);
            if ($_result) {
                $ot = array('code' => 0,
                    'message' => '操作成功!');
            } else {
                $ot = array('code' => 1001,
                    'message' => '操作失败!');
            }
        }else{
            $ot = array('code' => 1002 ,
            'message' => '账户号名已存在，不能重复！');

        }

        echo json_encode($ot);
    }
    public function edit()
    {
        $params = $this->input->post(NULL, TRUE);


		#print_r($params);die;

		$params['sys_group_id']=explode(",", $params['sys_group_id']);

		$this->sys_model->set_group_user($params['id'],$params['sys_group_id']);


		

		#$sys_group_id= $params['sys_group_id'];


		unset($params['sys_group_id']);

        foreach ($params as $k => $v) {
            $_data[$k] = $v;
        }
        $_password = $this->input->post('password');
        if(notBlank($_password)){
            $_data['password'] = get_password($_password);
        }
        $_result = $this->sys_model->update_entity_byid('sys_user', $_data,$_data['id'],'id');
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
        $_arr = $this->input->post('id');
        $arr = explode(',', $_arr);
        $_result = $this->sys_model->delete_entity_byarr('sys_user', 'id', $arr);
        if ($_result) {
            $ot = array('code' => 0,
                'message' => '操作成功!');
        } else {
            $ot = array('code' => 1001,
                'message' => '操作失败!');
        }
        echo json_encode($ot);

    }

    public function get_group()
    {
        $data = $this->sys_model->get_data('sys_user_group' );
        echo json_encode($data);
    }

	public function get_group_user()
    {

		$user_id = $this->input->post('user_id');

        $data = query($this,"select group_id from sys_group_user where user_id='{$user_id}'");
        echo json_encode($data);
    }

}

