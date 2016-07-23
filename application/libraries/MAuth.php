<?php
/**
 * Created by PhpStorm.
 * User:cluo
 * Date: 10/13/14
 * Time: 11:43 PM
 */


class MAuth{
    public static function is_login(){
        $userInfoJson = get_cookie(COOKIE_KEY);
        if(empty($userInfoJson)) return false;
        $ret = self::_check_smkey($userInfoJson);
        if($ret){
            self::refresh_user_group_team(false);
        }
        return ($ret);
    }

    public static function get_user_info(){
        $userJson = get_cookie(COOKIE_KEY);
        $_user = json_decode($userJson,true);
        return $_user;
    }
    public static function logout(){

        delete_cookie(COOKIE_KEY);
        delete_cookie(SM_KEY);
    }

    public static function after_login($data,$isRememberMe=false){
        $expire = $isRememberMe? 24*3600*7 : 24*3600;
        $host = $_SERVER['HTTP_HOST'];
        $data[$host]['sys_group_id'] = $data['sys_group_id'];
       // $data[$host]['team'] = $data['team'];
        $data[$host]['id'] = $data['id'];
        if(isset($data['password'])){
            unset($data['password']);
        }
        $ci = &get_instance();
        //$ci->load->model('sys_user_group_model','user_group');
        $cookie_domain = $ci->config->item('cookie_domain');
        $group_id_list = explode(',',$data['sys_group_id']);
       // $data[$host]['group_name'] =   $ci->user_group->get_group_name($group_id_list);
        $dataJson = json_encode($data);
        set_cookie(COOKIE_KEY, $dataJson ,$expire,$cookie_domain,'/');
        $smkey = self::_get_smkey_by_source($dataJson);
        //todo加入时间相关参数
        set_cookie(SM_KEY, $smkey, $expire,$cookie_domain,'/'); //私密
    }

    private static function _check_smkey($source){
        $smKey = get_cookie(SM_KEY);
        return (self::_get_smkey_by_source($source) === $smKey);
    }

    private  static function _get_smkey_by_source($source){
        return md5(md5($source).PRIVATE_KEY);
    }

    public static function after_update_user($data,$isRememberMe=false){
        $userInfo = self::get_user_info();
        if(MAuth::get_user_id()==$data['id']){
            $expire = $isRememberMe? 24*3600*7 : 24*3600;
            $data = array_merge($userInfo,$data);
            $host = $_SERVER['HTTP_HOST'];
            $ci = &get_instance();
            //$ci->load->model('sys_user_group_model','user_group');
            $cookie_domain = $ci->config->item('cookie_domain');
            $group_id_list = explode(',',$data['sys_group_id']);
           // $data[$host]['group_name'] =   $ci->user_group->get_group_name($group_id_list);
            $data[$host]['sys_group_id'] = $data['sys_group_id'];
           // $data[$host]['team'] =  isset( $data['team'])?$data['team']:'';
            $data[$host]['id'] = $data['id'];
            if(isset($data['password'])){
                unset($data['password']);
            }
            $dataJson = json_encode($data);
            set_cookie(COOKIE_KEY, $dataJson ,$expire,$cookie_domain,'/');
            $smkey = self::_get_smkey_by_source($dataJson);
            set_cookie(SM_KEY, $smkey, $expire,$cookie_domain,'/'); //私密
        }
    }
    public static function get_user_group_id(){
        $user_info = self::get_user_info();
        $host = $_SERVER['HTTP_HOST'];
        if(isset($user_info[$host])){
            return $user_info[$host]['sys_group_id'];
        }else{
            return false;
        }

    }
    public static function refresh_user_group_team($force_refresh=false,$isRememberMe=true){
        $userInfo = self::get_user_info();
        $host = $_SERVER['HTTP_HOST'];
        $ci = &get_instance();
        $ci->load->model('sys_user_model');
       // $ci->load->model('sys_user_group_model','user_group');
        $cookie_domain = $ci->config->item('cookie_domain');
        $user_name = $userInfo['user_name'];
        $data=$ci->sys_user_model->get_entity('sys_user',array("user_name" => $user_name));
        $is_change_or_empty = (!isset($userInfo[$host]) || ($userInfo[$host]['sys_group_id'] != $data['sys_group_id']));
        if($is_change_or_empty || $force_refresh){
            if($data){
                $expire = $isRememberMe? 24*3600*7 : 24*3600;
                $userInfo[$host]['sys_group_id'] = $data['sys_group_id'];
               // $userInfo[$host]['team'] = $data['team'];
                $userInfo[$host]['id'] = $data['id'];
                $userInfo['id']= $data['id'];
                $userInfo['sys_group_id']= $data['sys_group_id'];
              //  $userInfo['team']= $data['team']
                $group_id_list = explode(',',$data['sys_group_id']);
               // $userInfo[$host]['group_name'] =   $ci->user_group->get_group_name($group_id_list);
                //$userInfo['group_name']=  $userInfo[$host]['group_name'];
                if(isset($userInfo['password'])){
                    unset($userInfo['password']);
                }
                $dataJson = json_encode($userInfo);
                set_cookie(COOKIE_KEY, $dataJson ,$expire,$cookie_domain,'/');
                $smkey = self::_get_smkey_by_source($dataJson);
                set_cookie(SM_KEY, $smkey, $expire,$cookie_domain,'/'); //私密
            }
        }
    }

    public static function get_user_team(){
        $user_info = self::get_user_info();
        $host = $_SERVER['HTTP_HOST'];
        if(isset($user_info[$host])){
            return $user_info[$host]['team'];
        }else{
            return false;
        }

    }

    public static function get_user_id(){
        $user_info = self::get_user_info();
        $host = $_SERVER['HTTP_HOST'];
        if(isset($user_info[$host])){
            return $user_info[$host]['id'];
        }else{
            return false;
        }

    }


}
