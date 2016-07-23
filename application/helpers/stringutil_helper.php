<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_password($plaintext,$salt=''){
    return md5(md5($plaintext.$salt));
}

function get_rnd_id(){
    $m = explode(' ',microtime());
    return base_convert(($m[1].($m[0]*100000000)),10,32);
}

function notBlank($value){
    return isset($value) && $value!='';
}
function print_array($arr){
    foreach($arr as $k => $v){
        echo $k;
    }
}

/**
 * 转化为数组
 * @access public
 *
 * @param  $value
 * @param  $seperator
 */

if( ! function_exists('explode_array')){

    function explode_array($value , $seperator = ','){

        if( empty($value)){
            return FALSE;
        }

        if( is_array ($value) || strpos( $value , $seperator) === FALSE){
            $ret	= (array)$value;
        } else {
            //处理粘帖的批量数据
            //preg_match_all('/[^\s,]+/' , $value , $matches);
            $ret	= explode( $seperator , $value);
        }

        //过滤处理
        foreach( $ret as $k=> $v){
            //去掉空格
            $v = trim($v);
            if( empty($v)){
                unset($ret[$k]);
            } else {
                $v = addslashes($v);
            }
        }
        return $ret;
    }
}

/**
 * 获取对象的public成员数组
 * @param unknown_type $obj
 */
if( ! function_exists('get_object_public_vars')){
    function get_object_public_vars($obj) {
        if( is_null($obj)){
            return null;
        }else if( is_array($obj)){
            $_obj = array();
            foreach($obj as $key => $value){
                $_obj[$key] = get_object_public_vars($value);
            }
            return $_obj;
        } else if( is_object($obj)){
            $ref = new ReflectionObject($obj);
            $pros = $ref->getProperties(ReflectionProperty::IS_PUBLIC);
            $result = array();
            foreach ($pros as $pro) {
                $result[$pro->getName()] = get_object_public_vars($pro->getValue($obj));
            }
            return $result;
        }else {
            return $obj;
        }
    }
}

/**
 * JSON格式化函数
 * @desc  处理日志json格式化
 * @param $obj 任意类型，首次使用json_decode，否则直接输出。
 * @param $l  缩进级别
 * @return 如果不可以解析为object，返回错误，否则开始格式化处理。
 *
 * @author terrydai
 * @date 2012/6/20
 */
if( ! function_exists('format_json')){
    function  format_json( $json , $l = 1 , $once = TRUE){
        static $tab = " ";
        if( TRUE === $once){
            $once = FALSE;
            if(!is_object($json) && !is_array($json)){
                $t = json_decode($json);
                if(!is_object($t) && !is_array($t)){
                    return FALSE;
                }
                $json = $t;
            }
        }

        switch ( gettype($json) ) {
            case 'array':
                if( empty($json)){
                    return "[]";
                }

                //测试是否是自然数组
                $keys = array_keys( $json ) ;
                $ranged_keys = range( 0 , count( $json ) - 1);
                if ( count( array_diff($keys , $ranged_keys)) == 0 && count( array_diff($ranged_keys , $keys)) == 0){
                    foreach( $json as $key => $value){
                        $json[$key] = str_repeat($tab ,  $l) .  format_json(  $value , $l+1 ,  $once);
                    }

                    return "[\n" . implode(",\n", $json) . "\n" . str_repeat($tab ,  $l -1) . "]";
                } else{
                    $oVars =  $json;
                    if( empty($oVars)){
                        return "{}";
                    }
                    foreach( $oVars as $key=> $value){
                        $oVars[$key] = str_repeat($tab ,  $l) . '"' . $key .'":'  .  format_json(  $value , $l+1 ,  $once);
                    }
                    return "{\n" . implode(",\n", $oVars) . "\n" . str_repeat($tab ,  $l -1) . "}";
                }
            case 'object':
                $oVars = get_object_vars($json);
                if( empty($oVars)){
                    return "{}";
                }
                foreach( $oVars as $key=> $value){
                    $oVars[$key] = str_repeat($tab ,  $l) . '"' . $key .'":'  .  format_json(  $value , $l+1 ,  $once);
                }
                return "{\n" . implode(",\n", $oVars) . "\n" . str_repeat($tab ,  $l -1) . "}";
            case 'NULL':
                return 'null';
            case 'boolean':
                return $json ? 'true' : 'false';
            case 'string':
                return '"' . str_replace('"' , '\"' , $json) . '"';
            case 'integer':
            case 'double':
            case 'float':
            default:
                return $json; // Raw Data
        }
    }
}

/**
 * 分割输入
 * @param  mixed $value
 * @param  string $seperator
 */
if( ! function_exists('ctl_array')){
    function ctl_array($value , $seperator = ','){

        if( empty($value)){
            return FALSE;
        }

        if( is_array ($value) || strpos( $value , $seperator) === FALSE){
            $ret	= (array)$value;
        } else {
            //处理粘帖的批量数据
            //preg_match_all('/[^\s,]+/' , $value , $matches);
            $ret	= explode( $seperator , $value);
        }

        //过滤处理
        foreach( $ret as $k=> $v){
            //去掉空格
            $v = trim($v);
            if( empty($v)){
                unset($ret[$k]);
            } else {
                $v = addslashes($v);
            }
        }
        return $ret;
    }
}

/**
 * 获取数组中值
 * @access public
 *
 * @param $array
 * @param  $key
 */

if( ! function_exists(' array_get')){

    function array_get($array , $key  , $default = FALSE){

        //不是数组，或者键值不存在
        if(! is_array($array) || ! isset($array[$key])){
            return $default;
        }

        return $array[$key];
    }
}

/**
 * 数组按照键名排序
 * @access public
 *
 * @param $array
 * @param  $key
 */
if(!function_exists('addEllipsis')){
    function addEllipsis($string, $length, $end='...'){
        return (strlen($string) > $length) ? substr($string, 0, $length) . $end : $string;
    }
}

/**
 * 转换字符串成数组
 * @access	public
 * @param	string
 * @param	string
 * @param	string
 * @return	string
 */
if(!function_exists('multi_explode'))
{
    function multi_explode($pattern, $string, $standardDelimiter = ':')
    {
        $string = preg_replace(array($pattern, "/{$standardDelimiter}+/s"), $standardDelimiter, $string);
        return explode($standardDelimiter, $string);
    }
}

/**
 * 将分隔符为'/,\r\t\n:|\/\s'的字符串，转换成数组
 * @access	public
 * @param	string
 * @return	string
 */
if(!function_exists('multi_str2arr'))
{
    function multi_str2arr($string){
        //分隔符 : , ; \t \n | \ / 空格
        $pattern = "/,|;\t\n\|\\\\\//";
        return multi_explode($pattern, trim($string, $pattern));
    }
}

/**
 * is_ip
 * 判断IP是否符合格式
 * @param string $ip
 * @access private
 * @return void
 */
if(!function_exists('is_ip'))
{
    function is_ip($ip) {
        if(empty($ip)){
            return FALSE;
        }
        $e="([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])";
        $ipseg="([0-9]|[1-2][0-9]|3[0-2])";
        if(preg_match("/^($e\.){3}($e|$e\/$ipseg)$/",$ip)) {
            return TRUE;
        } else{
            return FALSE;
        }
    }
}

/**
 * 判断多维数组是否为空值
 */
if(!function_exists('array_is_null'))
{
    function array_is_null($arr = null){
        if(is_array($arr)){
            foreach($arr as $k=>$v){
                if($v&&!is_array($v)){
                    return false;
                }
                $t = array_is_null($v);
                if(!$t){
                    return false;
                }
            }
            return true;
        }elseif(!$arr){
            return true;
        }else{
            return false;
        }
    }
}

/**
 * array_compare
 * 数组比较函数
 * @param string $ip
 * @access private
 * @return array
 */
if(!function_exists('array_compare'))
{
    function array_compare($array1, $array2) {
        $diff = false;
        // Left-to-right
        foreach ($array1 as $key => $value) {
            if (!array_key_exists($key,$array2)) {
                $diff[0][$key] = $value;
            } elseif (is_array($value)) {
                if (!is_array($array2[$key])) {
                    $diff[0][$key] = $value;
                    $diff[1][$key] = $array2[$key];
                } else {
                    $new = array_compare($value, $array2[$key]);
                    if ($new !== false) {
                        if (isset($new[0])) $diff[0][$key] = $new[0];
                        if (isset($new[1])) $diff[1][$key] = $new[1];
                    }
                }
            } elseif ($array2[$key] !== $value) {
                $diff[0][$key] = $value;
                $diff[1][$key] = $array2[$key];
            }
        }
        // Right-to-left
        foreach ($array2 as $key => $value) {
            if (!array_key_exists($key,$array1)) {
                $diff[1][$key] = $value;
            }
            // No direct comparsion because matching keys were compared in the
            // left-to-right loop earlier, recursively.
        }
        return $diff;
    }
}

/**
 * tksort
 * 数组按照键名排序
 * @access public
 * @param $array
 * @param  $key
 */
if( ! function_exists('tksort')){
    function tksort(&$array){
        ksort($array);
        foreach(array_keys($array) as $k){
            if(gettype($array[$k])=="array"){
                tksort($array[$k]);
            }
        }
    }
}

/**
 * byte_format
 * 字节格式化 把字节数格式为 B K M G T P E Z Y 描述的大小
 * @param int $size 大小
 * @param int $dec 显示类型
 * @return float
 */
if(!function_exists('byte_format'))
{
    /**
     * byte_format
     */
    function byte_format($size,$dec=2){
        $a = array("B", "KB", "MB", "GB", "TB", "PB","EB","ZB","YB");
        $pos = 0;
        while ($size >= 1024)
        {
            $size /= 1024;
            $pos++;
        }
        return round($size,$dec).$a[$pos];
    }
}


if (!function_exists('strip_numeric_array'))
{
    /**
     * 过滤数字数组，将空值去掉
     * @param array $array
     */
    function strip_numeric_array($array)
    {
        foreach ($array as $k=>$v){
            $array[$k]=intval($v);
            if($v==0){
                unset($array[$k]);
            }
        }
        return $array;
    }

}

if (!function_exists('strip_string_array'))
{
    /**
     * 过滤字符数组，将空值去掉
     * @param array $array
     */
    function strip_string_array($array){
        foreach ($array as $k=>$v){
            if(trim($v)==''){
                unset($array[$k]);
            }
        }
        return $array;
    }
}