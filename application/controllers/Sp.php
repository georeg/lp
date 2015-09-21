<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class sp extends CI_Controller 
{
        
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->config->load('email_config',TRUE);
    }
    
    public function lp()
    {
        $this->load->view('sp/index.html');
    }
    
    public function register()
    {
        $res = $this->_validate();
        if ($res) 
            { 
            // IF TRUE GET DATA FROM REGISTER FORM
            $data['name'] = $this->input->post('name');
            $data['name_kana'] = $this->input->post('name_kana');
            $data['birth_year'] = $this->input->post('birth_year');
            $data['birth_month'] = $this->input->post('birth_month');
            $data['birth_date'] = $this->input->post('birth_date');
            $data['gender'] = $this->input->post('gender');
            $data['zip_1'] = $this->input->post('zip_1');
            $data['zip_2'] = $this->input->post('zip_2');
            $data['add_pref_city'] = $this->input->post('add_pref_city');
            $data['add_number'] = $this->input->post('add_number');
            $data['add_detail'] = $this->input->post('add_detail');
            $data['phone_num'] = $this->input->post('phone_num');
            $data['mail'] = $this->input->post('mail');
            
            $data['date_of_birth'] = $data['birth_year'] . '-' . $data['birth_month'] . '-' .$data['birth_date'];
            $data['postal_code'] = $data['zip_1'] . '-' . $data['zip_2'];
            
            //INSERT INTO DATABASE
            $this->load->Model('Logic_user_sp');
            $res = $this->Logic_user_sp->register_user($data);
            
            //SEND EMAIL
            $this->load->library('email');
            $domain = $_SERVER['SERVER_NAME'];
            $to = $this->config->item('email_config');
            
                $this->email->from('jazttijaztti@yahoo.co.jp', 'Your Name');
                $this->email->to($to['to'][$domain]);
                $this->email->cc('f.yuya.yamamoto@gmail.com');
                $this->email->bcc('jazttijaztti@yahoo.co.jp');

                $this->email->subject('Email Test');
                $this->email->message('Testing the email class.');

                $this->email->send();
                
            //TRANSITION TO THANK YOU PAGE
            $this->load->view('sp/thankyou');
            }
        else
            {
            $this->load->view('sp/index.html');
            }
        
    }
    
    public function thankyou()
    {
        $this->load->view('sp/thankyou');
    }
    
    private function _validate() 
        {
        
        $this->load->library('form_validation');
        
        //FORM VALIDATION RULES
        $this->form_validation->set_rules('name', 'お名前', 'required');
        $this->form_validation->set_rules('name_kana', 'カナ', 'required');
        $this->form_validation->set_rules('birth_year', '生年月日（年）', 'required');
        $this->form_validation->set_rules('birth_month', '生年月日（月）', 'required');
        $this->form_validation->set_rules('birth_date', '生年月日（日）', 'required');
        $this->form_validation->set_rules('gender', '性別', 'required');
        $this->form_validation->set_rules('zip_1', '住所・郵便番号', 'required');
        $this->form_validation->set_rules('zip_2', '住所・郵便番号', 'required');
        $this->form_validation->set_rules('add_pref_city', '都道府県・市区町村', 'required');
        $this->form_validation->set_rules('add_number', '町名・番地', 'required');
        // NOT REQUIRED $this->form_validation->set_rules('add_detail', 'add_detail', 'required');
        $this->form_validation->set_rules('phone_num', '電話番号', 'required');
        $this->form_validation->set_rules('mail', 'メールアドレス', 'required');
        
        //SET ERROR MESSAGE
        $this->form_validation->set_message('required', '※%sを入力してください。');
        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
        
            if ($this->form_validation->run() == FALSE)
            {
            return FALSE;
            } else
            {
            return TRUE;
            }
    }
}
?>    