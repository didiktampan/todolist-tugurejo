<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bangsal_model extends CI_Model
{

	public function buatID()
	{
		$ex = $this->db->select("MAX(milestoneid) AS id_max ")->from('bangsal');
		// ->like('kode_rs', '0', 'both')->get();
		$id	= "";
		if ($ex->num_rows() > 0) {
			foreach ($ex->result() as $id) {
				$id = str_pad((((int)$id->id_max) + 1), 6, "0", STR_PAD_LEFT);
			}
		} else {
			$id = "000001";
		}
		return $id;
	}

	public function searchBangsal($nama_bangsal, $kode_rs)
	{
		$this->db->select('*');
		$this->db->like('nama_bangsal', $nama_bangsal, 'both');
		if ($kode_rs !== 'all') {
			$this->db->where('kode_rs', $kode_rs);
		}
		$data = $this->db->get('bangsal');
		return $data->result();
	}

	public function getBangsal()
	{
		// $this->db->select('a.MILESTONEID, a.MILESTONENAME')->from('SDP_MILESTONE a');
		// $data = $this->db->where('MILESTONESTS', 0)->get();
		// return $data->result();
		$data = $this->db->select('MILESTONEID, MILESTONENAME')->from('SDP_MILESTONE')->get();
		return $data->result();
	}

	public function updateBangsal($obj, $milestoneid)
	{
		$update = $this->db->where('milestoneid', $milestoneid)->update('SDP_MILESTONE', $obj);
		return $update;
	}
}

/* End of file BangsalModel.php */
