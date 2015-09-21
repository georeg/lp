<?php 
class Logic_user_sp extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        parent::__construct();
    }
    
    //ADD NEW USER TO DATABASE
    public function register_user($param)
    {   
        //DATA RETRIEVED FROM CONTROLLER
        $data[] = $param['name'];
        $data[] = $param['name_kana'];
        $data[] = $param['date_of_birth'];
        $data[] = $param['gender'];
        $data[] = $param['postal_code'];
        $data[] = $param['add_pref_city'];
        $data[] = $param['add_number'];
        $data[] = $param['add_detail'];
        $data[] = $param['phone_num'];
        $data[] = $param['mail'];
        
        $sql = <<<EOF
        INSERT INTO `user` (`fullname`,`furigana`,`date_of_birth`,`gender`,`postal_code`,`city`,`street`,`address_detail`,`phone_num`,`email`) VALUES (?,?,?,?,?,?,?,?,?,?);
EOF;
        $res = $this->db->query($sql,$data);
     
    }
}
?>