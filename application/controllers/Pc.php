<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('form_validation');
                $this->load->database();
        }



	public function index()
	{
		$this->load->view('pc/index.html');
	}
	
	private function _validate()
	{
		$this->form_validation->set_rules('fullname1', '姓', 'required');
		$this->form_validation->set_rules('fullname2', '名', 'required');
		$this->form_validation->set_rules('furigana1', 'フリガナ セイ', 'required');	
		$this->form_validation->set_rules('furigana2', 'フリガナ メイ', 'required');	
		$this->form_validation->set_rules('phone_num', '電話番号', 'required');	
		$this->form_validation->set_rules('year', '年', 'required');	
		$this->form_validation->set_rules('month', '月', 'required');	
		$this->form_validation->set_rules('day', '日', 'required');	
		$this->form_validation->set_rules('current_job_type', '現在の職種', 'required');	
		$this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email');	
		$this->form_validation->set_rules('re-email', '半角英数字のみ。入力確認のため、上記と同じメールアドレスをご入力ください', 'required|matches[email]');	
	
		$this->form_validation->set_error_delimiters('<span class="attention">※', '</span>');	
	
		if ($this->form_validation->run() == FALSE)
                {
                        $res = false;
                }else{
                        $res = true;
                }
                return $res;	
	}
	
	public function register()
	{

		$res = $this->_validate();
                if (!$res)
                {
                	$this->index();

		}else{
			$post['fullname1'] = $this->input->post('fullname1');
			$post['fullname2'] = $this->input->post('fullname2');
			$post['furigana1'] = $this->input->post('furigana1');
			$post['furigana2'] = $this->input->post('furigana2');
			$post['year'] 	   = $this->input->post('year');
			$post['month']     = $this->input->post('month');
			$post['day'] 	   = $this->input->post('day');
			$post['phone_num'] = $this->input->post('phone_num');
			$post['current_job_type'] = $this->input->post('current_job_type');
			$post['email'] 	    = $this->input->post('email');
			$post['re-email']   = $this->input->post('re-email');
			$post['newsletter'] = $this->input->post('newsletter');
		
			$this->load->model('Logic_lp_pc');	
			$this->Logic_lp_pc->insert_pc($post);
		
			$this->thanks();
		}	
	}
	
	
	
	public function thanks()
	{
		$this->load->view('pc/thanks.html');
	}
}
