<?php

class Sys_user_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->_table = 'sys_user';
    }

	public function set_group_user($user_id,$group_ids){
	
	     $this->db->delete('sys_group_user',array('user_id'=>$user_id));

		 foreach($group_ids as $group_id){
		 
			$this->db->insert('sys_group_user',array('user_id'=>$user_id,'group_id'=>$group_id));
		 }
	
	}

} 