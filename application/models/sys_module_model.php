<?php

class Sys_module_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->_table = 'sys_module';
    }

    public function getMenu($group_id,$user_id){
    	
    	$_modules = $this->db->select('*')
				->from($this->_table)
				->where('module_type','module')->order_by('module_order','asc')//->group_by('module_name')
                ->get()->result_array();

	
        for($i=0;$i<count($_modules);$i++){

			/*
            $_modules[$i]['page'] = $this->db->select(array($this->_table.'.*'))
                ->from($this->_table)
                ->join('sys_group_permission', 'sys_group_permission.sys_module_id = '.$this->_table.'.id and user_group_id=\''.$group_id.'\'', 'inner')
                ->where(array('module_type'=>'page','module_parent_id'=>$_modules[$i]['id']))
                ->order_by('module_order','asc')
                ->get()->result_array();
				*/
			$_modules[$i]['page']=$this->db->query("SELECT sys_module.* FROM sys_group_user INNER JOIN sys_user ON sys_user.id=sys_group_user.user_id
INNER JOIN sys_group_permission ON sys_group_user.group_id=sys_group_permission.user_group_id
INNER JOIN sys_module ON sys_module.id=sys_group_permission.sys_module_id
WHERE sys_user.id='$user_id' AND sys_module.module_parent_id='{$_modules[$i]['id']}' AND sys_module.module_type='page' group by module_resource ")->result_array();
        }

				
		return $_modules;
    }

    public function get_module_id($group_id){

        $_modules = $this->db->select('*')
            ->from($this->_table)
            ->where('module_type','module')->order_by('module_order','asc')
            ->get()->result_array();

        for($i=0;$i<count($_modules);$i++){

            $_modules[$i]['page'] = $this->db->select(array($this->_table.'.*'))
                ->from($this->_table)
                ->join('sys_group_permission', 'sys_group_permission.sys_module_id = '.$this->_table.'.id and user_group_id=\''.$group_id.'\'', 'inner')
                ->where(array('module_type'=>'page','module_parent_id'=>$_modules[$i]['id']))
                ->order_by('module_order','asc')
                ->get()->result_array();
        }

        return $_modules;
    }

    public function getPermission($group_id){

        $_modules = $this->db->select('*')
            ->from($this->_table)
            ->where('module_type','module')->order_by('module_order','asc')
            ->get()->result_array();

        for($i=0;$i<count($_modules);$i++){

             $page = $this->db->select(array($this->_table.'.*','ifnull(sys_group_permission.id,0) p'))
                ->from($this->_table)
                ->join('sys_group_permission', 'sys_group_permission.sys_module_id = '.$this->_table.'.id and user_group_id=\''.$group_id.'\'', 'left')
                ->where(array('module_type'=>'page','module_parent_id'=>$_modules[$i]['id']))
                ->order_by('module_order','asc')
                ->get()->result_array();
            for($j=0;$j<count($page);$j++){

                $action = $this->db->select(array($this->_table.'.*','ifnull(sys_group_permission.id,0) p'))
                    ->from($this->_table)
                    ->join('sys_group_permission', 'sys_group_permission.sys_module_id = '.$this->_table.'.id and user_group_id=\''.$group_id.'\'', 'left')
                    ->where(array('module_type'=>'action','module_parent_id'=>$page[$j]['id']))
                    ->order_by('module_order','asc')
                    ->get()->result_array();

                $page[$j]['action'] = $action;

            }


            $_modules[$i]['page'] = $page;
        }

        return $_modules;
    }

}