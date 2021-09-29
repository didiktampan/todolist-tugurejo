<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rumahsakit_model extends CI_Model
{

	public function buatID()
	{
		$ex = $this->db->select("MAX(kode_rs) AS id_max ")->from('rumah_sakit')
			->like('kode_rs', '0', 'both')->get();
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

	public function infoTt($kode_rs)
	{
		$this->db->select('sum(!isnull(b.idpasien)) as terpakai, sum(isnull(b.idpasien)) as kosong, count(b.kode_tt) as total, a.kode_rs,a.nama_rs')
			->from('rumah_sakit a')
			->join('tempat_tidur b', 'a.kode_rs=b.kode_rs', 'left');
		if ($kode_rs !== 'all') {
			$this->db->where('a.kode_rs', $kode_rs);
		}
		$rs = ['all', '000001'];
		$this->db->where_not_in('a.kode_rs', $rs);
		$data = $this->db->group_by('kode_rs')->get();
		return $data->result();
	}
	public function dataRS()
	{
		$hasil = $this->db->query("SELECT * FROM rumah_sakit");
		return $hasil->result();
	}
}

/* End of file RumahSakitModel.php */
