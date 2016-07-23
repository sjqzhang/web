<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!defined('PHPSQLPARSE_ROOT')) {
    define('PHPSQLPARSE_ROOT', dirname(__FILE__) . '/');
    require_once(PHPSQLPARSE_ROOT . 'php-sql-parser/PHPSQLParser.php');
    require_once(PHPSQLPARSE_ROOT . 'php-sql-parser/PHPSQLCreator.php');
}
/*require_once('./php-sql-parser/PHPSQLParser.php');
require_once('./php-sql-parser/PHPSQLCreator.php');
*/

class BindSql{
        static $infix =array("=","<>","like",">",">=","<","<=");
        static $conj = array("and","or");
        static $prefix =array("not");
        public function __construct($data=array()){ 
            $unset_keys = array();
            foreach ($data as $key => $value) {
               $data[$key] = mysql_real_escape_string( $value );
               if($value === ""){
                $unset_keys[] = $key;
               }
               if($value == 0){
                continue;
               }
               if(!$value){
                  $unset_keys[] = $key;
               }
            }
         
            foreach ($unset_keys as $key ) {
               unset($data[$key]);
            }

            $this->match_pattern = "/{#\w+}/";
            $this->fields = array_map(function($item){return "{#$item}";}, array_keys($data));
            $this->data = $data;
            $this->parser = new PHPSQLParser();
            $this->creater = new PHPSQLCreator();
        }

        public function bind($sql){
            $ast = $this->parser->parse($sql); //解析出sql的语法数组
          /*  var_dump($ast);die;*/

            $ast = $this->_process($ast); //处理语法数组,去除在data中没有key绑定的语法元素
            $query = $this->creater->create($ast);
            /*echo "<pre>";
            var_dump($ast);*/
            $ast['SELECT'] = array();
            $ast['SELECT'][] = array('base_expr'=>'count(1) as cnt','expr_type'=>'colref','delim'=>false,'sub_tree'=>false);

            $sumrows = $this->creater->create($ast);
            $ret = new stdClass;
            $ret->query = $query;
            $ret->count = $sumrows;



            return $ret; //重新组合成新的sql
        }

        //处理语法树数组
        private function _process($ast){
         // var_dump($ast);die;
            foreach ($ast as $key => $item_list) {
                //遍历到where子节点进入绑定处理
                if($key == "WHERE"){
                  $ast[$key] = $this->_process_where($item_list);
                  continue;
                }
                //处理普通节点,找出子查询,绑定其中where1条件
                $ast[$key] = $this->_process_item_list($item_list);
            }
            if(empty($ast['WHERE']) ){
                    unset($ast['WHERE']);
                  }
            return $ast;

        }

        //处理普通节点元素
        private function _process_item($item){
            //如果他妈的不是子查询,原路返回

            if($item['expr_type'] != 'subquery'){
              return $item;
            }

            //如果他妈的是子查询,就递归调用语法树处理
            $item['sub_tree'] = $this->_process($item['sub_tree']);

            //再他妈的重新生成子树对应的sql
            return $item;
        }

        //由于他妈的节点是个列表,那就遍历这个列表处理之
        private function _process_item_list($item_list){
            foreach ($item_list as &$item) {
               $item=$this->_process_item($item);
            }
            return $item_list;
        }

        private function _process_bracket_expression($item){
           $item['sub_tree'] = $this->_process_where($item['sub_tree']);
           
           return $item;
        }


        //处理where中的节点表达式
        private function _process_item_list_where($item_list){
           foreach ($item_list as $index => &$item) {
               //var_dump($item);
               if($item['expr_type'] == 'operator'){
                   continue;
               }

               //括号内为空
               if($item['expr_type'] == 'bracket_expression'){
                if(empty($item['sub_tree'])){
                  return False;
                }
                   continue;
               }

               //普通节点,嘿嘿嘿
               if ( in_array( $item['expr_type'], array('const','colref','in-list'))  ){

                    //检测其中有无预定义符号
                    if(preg_match($this->match_pattern, $item['base_expr'], $match) ){
                        $key = $match[0];
                        

                        if( !in_array($key, $this->fields)  ){
                          return False;
                        }
                        preg_match("/\w+/", $key,$match);
                        
                        $item['base_expr'] = str_replace($key,$this->data[$match[0]],$item['base_expr']);
                        if(array_key_exists('sub_tree', $item)){
                          $item = $this->_process_bracket_expression($item);
                        }
                    }
                    continue;
               }

           }

           return $item_list;

        }

        private function _process_where($where_list){

            $ret_list= array(); //返回语法树
            $stack = array(); //中间栈

            $plist= array();  //表达式组列表
            $operate = ""; //分词令牌

            //遍历where中的语法元素
            for ($index = 0;$index<count($where_list) ;$index ++ ) {
                $item = $where_list[$index];
                //如果节点带括号
                if($item['expr_type'] == 'bracket_expression'){
                   $item = $this->_process_bracket_expression( $item );

                 }

                //如果是子查询
                if($item['expr_type'] == 'subquery'){
                   $item = $this->_process_item($item);
                }


                //遇到分词节点则开始执行FA乐器
                if( in_array($item['base_expr'],BindSql::$conj)  ){
                  
                   $expre = new stdClass;
                   //保存上一个分词令牌
                  
                   $expre->mlist = $operate != "" ?  array($operate) : array();
                   $expre->mlist = array_merge($expre->mlist,$plist );
                   $stack[] = $expre;
                   //把当前分词令牌绑到下一次,重置遍历寄存器
                   $operate = $item;
                   $plist =array();
                   continue;
                }
                //最后一组节点加入到表达式组列表
                $plist[] = $item;
                if($index == count($where_list) - 1){
                   $expre = new stdClass;
                   //保存上一个分词令牌
                   $expre->mlist = $operate != "" ?  array($operate) : array();
                   $expre->mlist = array_merge($expre->mlist,$plist );
                   $stack[] = $expre;
                }

            }

            //var_dump($stack);
            
            //遍历分组后的
            foreach ($stack as $expre) {
                $ret = $this->_process_item_list_where($expre->mlist);
                //对没有绑定数据的叶子进行剪枝
                if($ret==False){
                    continue;
                }
                $ret_list = array_merge($ret_list,$ret);
            }

            if(count( $ret_list ) > 0){
              if(in_array( $ret_list [0]['base_expr'], BindSql::$conj)){
               array_shift( $ret_list );
              }
           }
           
            //返回处理过的语法树
            return $ret_list;

        }


}


/*echo "<pre>";
$sql = "select * from nt_alarm where id in
      (select receiver from nt_log where event_id = {#event_id} and operator_type in (4000,0) )";
echo $sql;
$data['df'] = 1;
$data['event_id'] = 233;
$data['r'] = 'kj';
$obj = new BindSql($data);
echo "\n\n";
var_dump($data);
var_dump($obj->bind($sql)) ;*/











