<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Template extends Base_Controller {



	public function report()
	{

		$this->load->view('wf_node');
	}
    public function tools()
    {

    
    }
    public function t1()
    {

        $this->load->view('build');
    }
    public function t2()
    {

        $this->load->view('build');
    }
    public function t3()
    {

        $this->load->view('build');
    }


}

