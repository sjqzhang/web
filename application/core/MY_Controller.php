<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once('EX_Controller.php');

class Base_Controller extends EX_Controller {

    public $_url_rewrite = FALSE;

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('PRC');
        $this->load->helper('stringutil');

        $this->load->library('pagination');
        $this->pagination->use_page_numbers = false;

        $this->_config['per_page'] = PAGE_SIZE;


        $this->page_offset = $this->input->get($this->pagination->query_string_segment);

    }

    /**
     * @param $_page
     * @param $_total
     * @return mixed  分页条
     */
    public function getPageBar($_page,$_total){
        $this->_config['total_rows'] = $_total;
        $this->pagination->setBaseURL($_page);
        $this->pagination->initialize($this->_config);
        return $this->pagination->create_links();
    }

    /**结息request
     * @param $param_name_array
     * @return array
     */
    public function parseData($param_name_array){
        $_data = array();
        foreach($param_name_array as $param_name){
            $_data[$param_name] = $this->input->post($param_name);
        }
        return $_data;

    }

	
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */