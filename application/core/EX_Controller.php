<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');





class EX_Controller extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		$this->load->helper('db');
		$this->load->helper('url');

		$url=uri_string();

		if(strpos($url, 'sys_') === 0&&strpos($url, 'sys_log') !== 0){
		
		   $this->sys_log();
			
		}


    }



    function get_ip()
    {
        $CI =& get_instance();
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
         }else {
            $ip=$_SERVER['REMOTE_ADDR'];
         }
        return $ip;
    }


	public function sys_log($error_code='0',$error_message=''){
	

	

	$params=array();
	foreach($_REQUEST as $key=>$val){
		if(count($val)<512) {
			$params[$key]=$val;
		} else {
			$params[$key]='too large';
		}
	 }
	 $data=array();
	 $data['url']=uri_string();
	 $data['params']=json_encode($params);
	 $data['time']=time();
	 $data['query']=$this->db->last_query();
	 $user=MAuth::get_user_info();
	 $data['admin_id']=$user['id'];
	 $data['ip']=$this->get_ip();
	 $data['error_message']=$error_message;
	 $data['error_code']=$error_code;

	 $this->db->insert('sys_log',$data);

	
	}

    public function req_data($map){
        $_data = array();
        $keys=array();
        foreach($map as $key => $value){
            if(!empty($key)&&!is_numeric($key)){
                array_push($keys,$key);
            } else {
                array_push($keys,$value); 
            }
        }
        foreach($keys as $key){
            if(!empty($key)){
                $value= $this->input->post($key,true); 
                if(is_array($value)){
                    $value=join(',',$value);
                }
                if($value!='0'&&empty($value)){
                    $value= isset( $map[$key])? $map[$key]:''; 
                } 
                $_data[$key]=$value; 
            }
           
        }
        return $_data;
    }
    
    public function success($data,$message='success',$code='0'){
        $reply=array('reply'=>$data,'message'=>$message,'code'=>$code);
        return json_encode($reply);
    }
    public function success_ajax($data,$message='success',$code='0'){
       echo  $this->success($data,$message,$code);
       die;
    }
    public function error($data,$message='error',$code='500'){
        $reply=array('reply'=>$data,'message'=>$message,'code'=>$code);
        return json_encode($reply);
    }
    public function error_end($data,$message='error',$code='500'){
        echo  $this->error($data,$message,$code);
        die;
    }
    public function error_ajax($data,$message='error',$code='500'){
       
        echo  $this->error($data,$message,$code);
        die;
    }
	public function ajax_error($data,$message='error',$code='500'){
       
        echo  $this->error($data,$message,$code);
        die;
    }

	public function ajax_success($data,$message='success',$code='500'){
       
        echo  $this->success($data,$message,$code);
        die;
    }

	function query($sql){
		$data=array();
		if(is_string($sql)) {
			$query=$this->db->query($sql);
		} else {
		   $query=$sql;
		}
		if(preg_match('/\s*insert\s+|\s*update\s+|\s*delete\s+|\s*replace\s+/i',$sql)){
			return $this->db->affected_rows();
		}
		foreach ($query->result_array() as $i=> $row){
		   $data[$i]=$row;
		}
		return $data;
	}
	
    
    
    function write($content,$fn='./result.txt'){
		$fp= fopen($fn,'w+');
		fwrite($fp,$content);
		fclose($fp);
	}

    public function async_ctrl($ctrl,$data,$port=80){
       $host= $_SERVER['HTTP_HOST'];
       $script=$_SERVER['SCRIPT_NAME'];
       $data=http_build_query($data);
       $length=strlen($data);
       $fp = fsockopen($host, $port, $errno, $errstr, 30);
        if (!$fp) {
        } else {
$POST = <<<HEADER
POST {$script}/{$ctrl} HTTP/1.1
Accept: text/plain, text/html
Accept-Language: zh-CN,zh;q=0.8
Content-Type: application/x-www-form-urlencoded 
Host: {$host}
Content-Length: {$length}
Pragma: no-cache
Cache-Control: no-cache
Connection: close\r\n
{$data}

HEADER;
            fwrite($fp, $POST);
            fclose($fp);
        }
       
    }


    public function sync_ctrl($ctrl,$data,$port=80){
       $host= $_SERVER['HTTP_HOST'];
       $script=$_SERVER['SCRIPT_NAME'];
       $data=http_build_query($data);
       $length=strlen($data);
       $fp = fsockopen($host, $port, $errno, $errstr, 30);
        if (!$fp) {
        } else {
$POST = <<<HEADER
POST {$script}/{$ctrl} HTTP/1.1
Accept: text/plain, text/html
Accept-Language: zh-CN,zh;q=0.8
Content-Type: application/x-www-form-urlencoded 
Host: {$host}
Content-Length: {$length}
Pragma: no-cache
Cache-Control: no-cache
Connection: close\r\n
{$data}

HEADER;
            fwrite($fp, $POST);
            $body='';
            do{
              $body.= fgets($fp, 4096);  

             } while(!feof($fp));
            fclose($fp);
            $pos= strpos($body, "\r\n\r\n");
            return substr($body, $pos);
        }
       
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
			foreach($header as $key=>$val){
					$header[$val]=$key;
			}
		}
		foreach($header as $name=>$hi){
		
		   $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr(65+$hi)."1", $name);
		}
	
		foreach($data as $rowIndex=>$row){
			foreach($row as $key=>$val){
				$index_x=chr(65+$header[$key]);
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


		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */