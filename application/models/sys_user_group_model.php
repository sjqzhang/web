<?php

class Sys_user_group_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->_table = 'sys_user_group';
    }

    public function getSysGroup(){

        return $this->db
            ->select('id,group_name')->from($this->_table)
            ->order_by('id','desc')->get()->result_array();
    }

    public function getSysGroupArray(){
        $_group_list = array();

        $_group = $this->getSysGroup();

        foreach($_group as $item){
            $_group_list[$item['id']] = $item['group_name'];
        }

        return $_group_list;
    }

} 