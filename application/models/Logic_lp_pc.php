<?php


class Logic_lp_pc Extends CI_Model{

	public function __construct()
	{
		parent::__construct();
     	   	$this->load->database();
   	}

	public function insert_pc($param)
	{
		$data[] = $param['fullname1'].$param['fullname2'];
                $data[] = $param['furigana1'].$param['furigana2'];
                $data[] = $param['year'].$param['month'].$param['day'];
                $data[] = $param['phone_num'];
                $data[] = $param['current_job_type'];
		$data[] = $param['email'];
		$data[] = $param['newsletter'];

		$sql=<<<EOF
			INSERT INTO `user` (`fullname`, `furigana`, `date_of_birth`, `phone_num`, `current_job_type`, `email`, `newletter_flg`) VALUES (?,?,?,?,?,?,?);
EOF;
		$res = $this->db->query($sql,$data);


	}


}




?>
