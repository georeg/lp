<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_agent extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
        	$this->load->library('user_agent');
		$this->load->helper('url');
		$this->load->helper('form');
	}
		
	public function index()
	{
		if ($this->agent->mobile())
		{
			$this->load->view('sp/index.html');
		}else{
			$this->load->view('pc/index.html');			
		}
	}
}
