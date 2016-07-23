<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('excel_export')){
	/**
		
		$data=array(
			array('name'=>'jqzhang',,'age'=>28),
		);

		$header=array(
		  'name'=>'ÐÕÃû',
		  'age'=>'ÄêÁä'
		);



	**/
	function excel_export($title='',$data = array(),$header=array())
		{
			error_reporting(E_ALL); 
			set_time_limit(0); 
			set_include_path(FCPATH.APPPATH.'/libraries/Classes/');
			if(empty($title)){
				$title=date('Y-m-d');
			}

			Include FCPATH.APPPATH.'libraries/PHPExcel.php';
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
								 ->setLastModifiedBy("Maarten Balliauw")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Test result file");

		    $objPHPExcel->setActiveSheetIndex(0);
			//$objPHPExcel->getActiveSheet();
			for($i=0;$i<26;$i++){
				$objPHPExcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setAutoSize(true);
			}


			
			if(empty($header)){// not set header,autho general 
				$hi=0;
				
				foreach($data[0] as $key=>$val){
					$header[$key]=$hi++;
				}
				foreach($header as $name=>$hi){
					 $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr(65+$hi)."1", $name);
				}
			}  else {
				$i=0;
				foreach($header as $key=>$val){
						$header_tmp[$key]= array($val,$i);
						$i++;
				}
				foreach($header_tmp as $name=>$hi){
					 $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr(65+$header_tmp[$name][1])."1", $header_tmp[$name][0]);
				}
			}
			
			if(isset($header_tmp)){//not set header
				foreach($data as $rowIndex=>$row){
					foreach($row as $key=>$val){
						$index_x=chr(65+$header_tmp[$key][1]);
						$index=$index_x.($rowIndex +2);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($index, $val);
					}
				}
			} else {
				foreach($data as $rowIndex=>$row){
					foreach($row as $key=>$val){
						$index_x=chr(65+$header[$key]);
						$index=$index_x.($rowIndex +2);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($index, $val);
					}
				}
			}

			$objPHPExcel->getActiveSheet()->setTitle($title);
			$objPHPExcel->setActiveSheetIndex(0);
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}

}


if(!function_exists('excel_import')){	
	function excel_import($filename,$header_map=array()){
	   set_include_path(FCPATH.APPPATH.'/libraries/Classes/');
       Include FCPATH.APPPATH.'libraries/PHPExcel.php';
	   $objPHPExcel = PHPExcel_IOFactory::load($filename);
       $rows = $objPHPExcel->getSheet(0)->toArray();
	   $header=array_shift($rows);
	   foreach($rows as $rowIndex=>$row){
				foreach($row as $index=>$item){
					$row[$header[$index]]=$item;
				}
				$rows[$rowIndex]=$row;
	   }
       if(!empty($header_map)){
		  foreach($rows as $rowIndex=> $row){
			 $arr=array();
			 foreach($header_map as $alias=>$name){
				$arr[$name]=$row[$alias];
			 }
			 $rows[$rowIndex]=$arr;

		  }  
	   }
	   return $rows;
	
	}
}


if(!function_exists('excel_header_map')){	
	function excel_header_map($name=''){
		if(empty($name)){
			$name='__grid_opts__';
		}
		$cols= json_decode( $_REQUEST[$name],true);
		$header_map=array();
		foreach($cols as $col){
			if( isset($col['name'])&& preg_match('/^\w+$/', $col['name'])){
				//$header_map[ $col['title']] = $col['name'];
				$header_map[ $col['name']] = $col['title'];
			}
		}
		return $header_map;
	}
	  
}
?>