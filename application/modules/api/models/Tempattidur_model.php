<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tempattidur_model extends CI_Model {

    public function buatID() {
		$ex = $this->db->select("MAX(kode_tt) AS id_max ")->from('tempat_tidur')
			->like('kode_rs', '0', 'both')->get();
		$id	= "";
		if ($ex->num_rows()>0){
			foreach($ex->result() as $id){
				$id = str_pad((((int)$id->id_max)+1), 6, "0", STR_PAD_LEFT);
			}
		} else {
			$id = "000001";
		}
		return $id;
	} 

    public function getListTT($kode_rs)
    {
       $this->db->select('a.*, b.nama_rs, c.nama_bangsal, d.nama, e.no_registrasi')
	   	->from('tempat_tidur a')
        ->join('rumah_sakit b', 'a.kode_rs=b.kode_rs', 'inner')
        ->join('bangsal c', 'a.kode_bangsal=c.kode_bangsal', 'inner')
        ->join('pasien d', 'a.idpasien=d.idpasien', 'left')
        ->join('registrasi e', 'a.no_registrasi=e.no_registrasi', 'left');
		if($kode_rs !== 'all'){
			$this->db->where('a.kode_rs', $kode_rs);
		}
		$data = $this->db->order_by('c.nama_bangsal, a.no_kamar, a.no_tt', 'asc')->get();
        return $data->result();
    }

	public function getTTByKodeBangsal($kode_bangsal, $kode_rs)
	{
		$this->db->select('a.*, b.nama_rs, c.nama_bangsal')->from('tempat_tidur a')
			->join('rumah_sakit b', 'a.kode_rs=b.kode_rs', 'inner')
			->join('bangsal c', 'a.kode_bangsal=c.kode_bangsal', 'inner')
			->where('a.kode_bangsal', $kode_bangsal);
		if($kode_rs !== 'all'){
			$this->db->where('a.kode_rs', $kode_rs);
		}
		$data = $this->db->get();
		return $data->result();
	}

	public function availableTt()
	{
		$kode_rs = $this->session->userdata('kode_rs');
		$this->db->select('a.kode_rs, e.nama_rs, a.kode_bangsal, c.nama_bangsal,
		 	a.kode_tt, a.no_kamar, a.no_tt, a.idpasien, b.nama, b.tgllahir, b.alamat_ktp, b.jeniskel, b.notelp,
			a.no_registrasi, d.status, d.status_covid, a.kode_inden, d.tglswab_akhir, d.faskes_asal')
			->from('tempat_tidur a')
				->join('pasien b', 'a.idpasien=b.idpasien', 'left')
				->join('bangsal c', 'a.kode_bangsal=c.kode_bangsal', 'inner')
				->join('registrasi d', 'a.no_registrasi=d.no_registrasi', 'left')
				->join('rumah_sakit e', 'a.kode_rs=e.kode_rs', 'inner');
		if($kode_rs !== 'all'){
			$this->db->where('a.kode_rs', $kode_rs);
		}
		$rs = ['all', '000001'];
		$this->db->where_not_in('a.kode_rs', $rs);
		$data = $this->db->order_by('c.nama_bangsal, a.no_kamar, a.no_tt', 'asc')->get();
		return $data->result();
	}

	public function availableTtByKodeTt($kode_tt)
	{
		$this->db->where('kode_tt', $kode_tt);
		$this->db->where('idpasien', null)->where('no_registrasi', null)->where('kode_inden', null);
		$data = $this->db->get('tempat_tidur');

		return $data->result();
	}

	public function availableTtByBangsal($kode_bangsal, $kode_rs)
	{
		$this->db->select('*')->from('tempat_tidur');
		$this->db->where('kode_bangsal', $kode_bangsal);
		if($kode_rs !== 'all'){
			$this->db->where('kode_rs', $kode_rs);
		}
		$this->db->where('idpasien', null)->where('no_registrasi', null)->where('kode_inden', null);
		$data = $this->db->order_by('no_kamar, no_tt', 'asc')->get();
		return $data->result();
	}

}

/* End of file TempatTidurModel.php */
