<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tools extends Base_Controller {
 public function __construct()
    {

        parent::__construct();
		$this->load->library('Phpmailer');
		$this->mail = new PHPMailer(true);
		$config=$this->config->config['email'];

		 $this->mail->Host       =$config['smtp_host'];// "mail.web.com"; // SMTP server
		 $this->mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		 $this->mail->SMTPAuth   = true;                  // enable SMTP authenticatio
		 $this->mail->Port       = $config['smtp_port'];                    // set the SMTP port for the GMAIL server
		 $this->mail->Username   = $config['smtp_user']; // SMTP account username
		 $this->mail->Password   = $config['smtp_pass'];        // SMTP account password
		 $this->mail->SetFrom( $config['smtp_user'], '运维通知');
		 $this->mail->CharSet = "utf-8";

		 		/*
		$this->email->to($this->input->post('to'));
		$this->email->subject($this->input->post('subject'));
		$this->email->message($this->input->post('message'));
		$this->email->send();


*/



    }

	public function send_email(){


		$this->mail->IsSMTP(); // telling the class to use SMTP
		$message= $this->input->post('message');
		$subject=$this->input->post('subject');
		$to= $this->input->post('to');

		try {

          $tos=  preg_split('/\,|\;/',$to);

          foreach($tos as $tt) {
              $this->mail->AddAddress($tt, '');
          }
		 // $this->mail->AddReplyTo('name@yourdomain.com', 'First Last');
		  $this->mail->Subject =$subject;
		 // $this->mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		 // $this->mail->IsHTML(true); //支持html格式内容 
		  $this->mail->MsgHTML($message);
		  $this->mail->Send();
		  //echo "Message Sent OK</p>\n";
		    log_message('info',$to."发送成功");
		} catch (phpmailerException $e) {
          log_message('error',$e->errorMessage());
		  echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			          log_message('error',$e->errorMessage());
		  echo $e->getMessage(); //Boring error messages from anything else!
		}

	}


	function export_data($data = array())
    {
        error_reporting(E_ALL); //开启错误
        set_time_limit(0); //脚本不超时
         
        date_default_timezone_set('Europe/London'); //设置时间
        /** Include path **/
        set_include_path(FCPATH.APPPATH.'/libraries/Classes/');//设置环境变量
        // Create new PHPExcel object
        Include 'PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                             ->setLastModifiedBy("Maarten Balliauw")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Test result file");
        // Add some data
        $letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');                             
        if($data){
             $i = 1;
            foreach ($data as $key => $value) {
               $newobj =  $objPHPExcel->setActiveSheetIndex(0);
                $j = 0;    
                foreach ($value as $k => $val) {
                    
                    $index = $letter[$j]."$i";
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($index, $val);
                    $j++;
                }
                    $i++;
            }
        }                        
        $date = date('Y-m-d',time());            
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($date);
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$date.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }


	function test(){
		$this->export_data(array(
			array('a'=>"abc",'b'=>'bdfasdf'),
			array('a'=>"abc",'b'=>'bdfasdf'),
			array('a'=>"abc",'b'=>'bdfasdf'),
			array('a'=>"abc",'b'=>'bdfasdf'),
			array('a'=>"abc",'b'=>'bdfasdf'),
			
		));
	}






}

?>
