<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


class LogAction{
    var $log_list=array(
        

        'notice/nt_platform/add'=>                '[新增平台]',
        'notice/nt_platform/edit'=>                '[修改平台信息]',
        'notice/nt_platform/del'=>                '[删除平台]',

        'notice/nt_event/accept'=>                '[事件认领]',
        'notice/nt_event/commit'=>                '[事件解决]',
        'notice/nt_event/reroll'=>                '[事件转让]',

        'notice/nt_strategy/add'=>                '[添加策略]',
        'notice/nt_strategy/edit'=>                '[修改策略]',
        'notice/nt_strategy/del'=>                '[删除策略]',


        'notice/nt_service/edit'=>               '[修改告警服务]',
        'notice/nt_service/add'=>                '[增加告警服务]',
        'notice/nt_service/del'=>                '[删除告警服务]',
        'notice/nt_service/change_status'=>      "[切换告警服务状态]",

        'notice/nt_user/add'=>                '[添加联系人]',
        'notice/nt_user/edit'=>                '[修改联系人]',
        'notice/nt_user/del'=>                '[删除联系人]',
        'notice/nt_user/change_status'=>                '[切换联系人激活状态]',

        'notice/nt_groups/add'=>                '[添加联系人组]',
        'notice/nt_groups/edit'=>                '[修改联系人组]',
        'notice/nt_groups/del'=>                '[删除联系人组]',

        'notice/nt_duty_setting/add'=>                '[添加值班组]',
        'notice/nt_duty_setting/edit'=>                '[修改值班组]',
        'notice/nt_duty_setting/del'=>                '[删除值班组]',

        'notice/nt_block/add'=>                '[添加来源屏蔽]',
        'notice/nt_block/edit'=>                '[修改来源屏蔽]',
        'notice/nt_block/del'=>                '[删除来源屏蔽]',


    );                

    function log(){

        $this->ci = & get_instance();

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
        $log_list= $this->log_list;

        if ( array_key_exists($dir_path, $log_list) ) {

            $this->ci->sys_log(0, $log_list[$dir_path] );
        }


    }
}