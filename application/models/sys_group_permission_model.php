<?php

class Sys_group_permission_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->_table = 'sys_group_permission';
    }
    public function checkPermission($dir_path,$group_id,$user_id='0'){

		/*
        $query = $this->db->query("SELECT * FROM ".$this->_table." where user_group_id = '$group_id' and
        sys_module_id=(select id from sys_module where  module_resource='$dir_path') LIMIT 1");
		*/

//print($user_id);die;


         $dir_path2='index.php/'.$dir_path;

		 $sql="SELECT * FROM sys_group_user INNER JOIN sys_user ON sys_user.id=sys_group_user.user_id
INNER JOIN sys_group_permission ON sys_group_user.group_id=sys_group_permission.user_group_id
inner join sys_module on sys_group_permission.sys_module_id=sys_module.id
WHERE sys_user.id='$user_id' and ( sys_module.module_resource='$dir_path2' or  sys_module.module_resource='$dir_path')";

        // echo $user_id;die;

        // echo $sql;die;


		
		$query=$this->db->query("SELECT * FROM sys_group_user INNER JOIN sys_user ON sys_user.id=sys_group_user.user_id
INNER JOIN sys_group_permission ON sys_group_user.group_id=sys_group_permission.user_group_id
inner join sys_module on sys_group_permission.sys_module_id=sys_module.id
WHERE sys_user.id='$user_id' and ( sys_module.module_resource='$dir_path2' or  sys_module.module_resource='$dir_path')");



     $num=$query->num_rows();


        if ($num> 0){
            return 1;
        }

        return 0;
		



    }



} 