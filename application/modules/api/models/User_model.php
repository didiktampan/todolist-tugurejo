<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function getListUser()
	{
		$kode_rs = $this->session->userdata('kode_rs');
		$this->db->select('a.username, a.fullname, a.nik, a.kode_rs, b.nama_rs')
		->from('user_mitigasi a')
			->join('rumah_sakit b', 'a.kode_rs=b.kode_rs', 'inner');
		if($kode_rs !== 'all'){
			$this->db->where('a.kode_rs', $kode_rs);
		}
		$data = $this->db->get();
		return $data->result();
	}

}

/* End of file UserModel.php */
