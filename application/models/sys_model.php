<?php

class Sys_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
//        $this->_table = 'ops_job';
    }

	public function set_group_user($user_id,$group_ids){
	
	     $this->db->delete('sys_group_user',array('user_id'=>$user_id));

		 foreach($group_ids as $group_id){
		 
			$this->db->insert('sys_group_user',array('user_id'=>$user_id,'group_id'=>$group_id));
		 }
	
	}


} 