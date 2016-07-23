<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


class FilterInput{

    //免过滤白名单
    var $log_list=array();


    var $getfilter="'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    var $postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    var $cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";               

    function defense(){

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

        if ( !in_array($dir_path, $log_list) ) {
            $this->filter();
            
        }

    }

    function _filter($value,$filter){
        if(is_array($value)){
            foreach ($value as $key=>$item) {
                $this->_filter($key,$filter);
                $this->_filter($item,$filter);
            }
        }
        if(is_string($value)){
            if (preg_match("/".$filter."/is",$value)){ 
                $this->ci->sys_log(0, "[注入攻击]" );
                echo "你的操作被注入过滤器拦下来了,你的信息已经被记录了,你就准备被嘿嘿嘿吧!";    
                exit();
            }
        }
    }

    function filter(){
        $ci = &get_instance();
        $data= $ci->input->post();
        $this->_filter($data,$this->postfilter);

        $data=$ci->input->get();
        $this->_filter($data,$this->getfilter);

        $data=$ci->input->cookie();
        $this->_filter($data,$this->cookiefilter);

    }

}

