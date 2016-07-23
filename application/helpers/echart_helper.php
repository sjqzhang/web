<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('ec_ds_trans')){
	function ec_ds_trans($ds){
	  $data=array();
	  foreach ($ds as $i => $row) {
		foreach ($row as $key => $value) {
		  $data[$key][]=$value;
		}
	  }/*
	  foreach($data as $key=>$values){
		$data[$key]=implode(',',$values);
	  }
	  */
	  return $data;
	}
}


if(!function_exists('ec_ds_conn')){
	function ec_ds_conn($conn){
		$items= explode(';',$conn);
		$conf=array();
		foreach($items as $item){
			$map= explode('=',$item);
			if(count($map)==2){
				$conf[$map[0]]=$map[1];
			}
		}
		return $conf;
	}
}



?>