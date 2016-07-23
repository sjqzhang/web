<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('EX_Model.php');

class MY_Model  extends EX_Model {

    public $_table;

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * 分页获取列表
     * @param int $offset
     * @param array $where
     * @param array $like
     * @param array $order_by
     * @param array $cols
     * @param array $join
     * @param int $page_size
     * @return mixed
     */
    public function getListByPage($offset=0,$where=array(),$like=array(),$order_by=array(),$cols=array('*'),$join=array(),$page_size=PAGE_SIZE)
    {
        //var_dump($like);
        $this->db->from($this->_table);
        foreach($join as $_item){

                $this->db->join($_item['table'],$_item['on'],$_item['d']);

        }
        $this->db->where($where);
        if(isset($like)){

            $this->db->like($like);
        }
        $pager['total'] = $this->db->count_all_results();

        $this->db->select($cols)->from($this->_table);
        foreach($join as $_item){

            $this->db->join($_item['table'],$_item['on'],$_item['d']);

        }
        $this->db->where($where);
        if(isset($like)){
            $this->db->like($like);
        }

        foreach($order_by as $_col=>$_value){
            $this->db->order_by($_col,$_value);
        }
        $this->db->limit($page_size,!isset($offset)?0:$offset);
        $pager['list'] = $this->db->get()->result_array();

        return $pager;
    }

    /**
     * 分页获取列表
     * @param int $offset
     * @param array $where
     * @param array $like
     * @param array $order_by
     * @param array $cols
     * @param array $join
     * @param int $page_size
     * @return mixed
     */
    public function get_list_bypage($limit=30,$where=array(),$like=array(),$order_by=array(),$page_size=1,$cols=array('*'),$join=array())
    {
        //var_dump($like);
        $this->db->from($this->_table);
        foreach($join as $_item){

            $this->db->join($_item['table'],$_item['on'],$_item['d']);

        }
        $this->db->where($where);
        if(isset($like)){

            $this->db->like($like);
        }
        $pager['totalCount'] = $this->db->count_all_results();

        $this->db->select($cols)->from($this->_table);
        foreach($join as $_item){

            $this->db->join($_item['table'],$_item['on'],$_item['d']);

        }
        $this->db->where($where);
        if(isset($like)){
            $this->db->like($like);
        }

        foreach($order_by as $_col=>$_value){
            $this->db->order_by($_col,$_value);
        }

        $start=($page_size-1)*$limit;

        $this->db->limit($limit,$start);
        $pager['items'] = $this->db->get()->result_array();

        return $pager;
    }


    public function get_list($table, $limit = 30, $where = array(), $like = array(), $order_by = array(), $page_size = 1, $cols = array('*'), $join = array())
    {
        $this->_table = $table;
        return $this->get_list_bypage($limit, $where, $like, $order_by, $page_size, $cols, $join);
    }

    public function getCount($where=array(),$like=array()){
        $this->db->from($this->_table);
        $this->db->where($where);
        if(isset($like)){

            $this->db->like($like);
        }
        return $this->db->count_all_results();
    }
    public function get_count($table,$where=array(),$like=array()){
        $this->_table = $table;
        return $this->getCount($where,$like);
    }
    /**
     * 获取列表
     * @param array $where
     * @param array $cols
     * @return mixed
     */
    public function getList($where=array(),$cols=array('*'),$order_by=array()){
        $this->db
            ->select($cols)->from($this->_table);
        foreach($order_by as $_col=>$_value){
            $this->db->order_by($_col,$_value);
        }
        return $this->db
            ->where($where)->get()->result_array();
    }
    public function get_data($table,$where=array(),$cols=array('*'),$order_by=array()){
        $this->_table = $table;
        return $this->getList($where,$cols,$order_by);
    }

    /**
     * 获取一条
     * @param $id
     * @param array $cols
     * @param string $pk
     * @return mixed
     */
    public function getEntityByID($id,$cols=array('*'),$pk='id'){
        return $this->getEntity(array($pk=>$id),$cols);
    }


    public function get_entity($table, $where = array(), $cols = array('*'))
    {
        return $this->db
            ->select($cols)->from($table)
            ->where($where)->get()->row_array();
    }


    public function getEntity($where=array(),$cols=array('*')){
        return $this->db
            ->select($cols)->from($this->_table)
            ->where($where)->get()->row_array();
    }
    public function get_entity_byid($table,$id,$pk='id',$cols=array('*')){
        $this->_table = $table;
        return $this->getEntityByID($id,$cols,$pk);
    }
    public function addEntity($data){
        return $this->db->insert($this->_table,$data);
    }

    public function add_entity($table,$data){
        $this->_table = $table;
        return $this->addEntity($data);
    }
    public function delete_entity_byid($table,$id,$pk='id'){
        $this->_table = $table;
        return $this->deleteEntityByID($id,$pk);
    }
    public function delete_entity_byarr($table,$key,$arr){
        $this->_table = $table;
        if(count($arr)==0){
            return false;
        }
        return $this->db->where_in($key,$arr)->delete($this->_table);
    }

    public function deleteEntityByID($id,$pk='id'){
        return $this->deleteEntity(array($pk => $id));
    }

    public function deleteEntity($where){
        if(count($where)==0){
            return false;
        }
        return $this->db->delete($this->_table,$where);
    }
    public function update_entity_byid($table,$data,$id,$pk='id'){
        $this->_table = $table;
        return $this->updateEntityByID($data,$id,$pk);
    }

    public function updateEntityByID($data,$id,$pk='id'){
        return $this->updateEntity($data,array($pk => $id));
    }

    public function updateEntity($data,$where){

        if(count($where)==0){
            return false;
        }

        $this->db->where($where);
        return $this->db->update($this->_table,$data);
    }

    public function getMaxColValue($col_name,$where=array()){
        $_row = $this->db->select_max($col_name)->where($where)->get($this->_table)->row_array();
        if(isset($_row)){
            return $_row[$col_name];
        }
        return 0;
    }

    public function get_list_by_table($table,$where=array()){
        $this->_table = $table;
        $this->db->from($this->_table);
        $this->db->where($where);
        return $this->db->get()->result_array();
    }

    /**记录日志
     * @param $_user
     * @param $_event
     * @param $_ip
     * @param int $_log_type
     * @return mixed
     */
//    public function log($_user,$_event,$_ip,$_log_type=0){
//        $data = array('log_content'=>$_event,'user_id'=>$_user,'log_ip'=>$_ip);
//        $data['log_date'] = date('Y-m-d H:i:s');
//        $data['log_type'] = $_log_type;
//        return $this->db->insert("site_log",$data);
//    }

} 
