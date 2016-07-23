<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Cron extends Base_Controller {
    public function __construct(){
		//set_time_limit(0);
		//error_reporting(0); 
        parent::__construct();

        

    }




    //定时更新统计
    public  function app_code_stat(){
        //echo "xxxxxxxxxxxxxx";
        $this->load->model('report/re_app_code_model');
        //$this->load->helper('date');
        $repair= $this->input->get('repair',true);
   
        if(empty($repair)){
            $repair=false;
        } else {
            $repair=true;
        }
       
        $this->re_app_code_model->set_stat($repair);
        
    }


	function import_excel($filename,$header_map=array()){
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


	function export_excel($title='',$data = array(),$header=array())
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
		if(empty($header)){
			$hi=0;
			foreach($data[0] as $key=>$val){
				$header[$key]=$hi++;
			}
		}  else {
			$i=0;
			foreach($header as $key=>$val){
					$header_tmp[$key]= array($val,$i);
					$i++;
			}
		}
		foreach($header_tmp as $name=>$hi){
		  
		   $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr(65+$header_tmp[$name][1])."1", $header_tmp[$name][0]);
		}
		foreach($data as $rowIndex=>$row){
			foreach($row as $key=>$val){
				$index_x=chr(65+$header_tmp[$key][1]);
				$index=$index_x.($rowIndex +2);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($index, $val);
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


	function test(){
	  $data=	$this->db->query('  SELECT id ,module_name ,module_icon ,module_type from sys_module  ')->result_array();
	 // print_r($data);die;
	 $header=array(
			'id'=>'编号',
		 'module_name'=>'名称',
		 'module_icon'=>'图标',
		 'module_type'=>'类型',
		   
	 );
		$this->export_excel('',$data,$header);
	}


	function test2(){
			$data=array(
			array('name'=>'jqzhang','age'=>28),
				array('name'=>'小张','age'=>29),
		);

		$header=array(
		  'name'=>'姓名',
		  'age'=>'年龄'
		);

		$this->export_excel('',$data,$header);
	
	}


	function import(){
	
	    $header=array(
			'interal_ip'=>'time',


		);
		//$rows= $this->import_excel('C:/Users/user/Downloads/2014-12-09.xlsx');


		 $rows= $this->import_excel('C:/Users/user/Desktop/CMDB.xlsx',$header);
		print_r($rows);

		
		
	}


	function test3(){
	$memcachehost='172.16.132.221';
	$mem = new Memcache;
	$mem->addServer($memcachehost, '11211');
	//$mem->addServer($memcachehost, '11212');
	$mem->set('hx','9enjoy');
	echo $mem->get('hx'); 
	
	}





}

?>
