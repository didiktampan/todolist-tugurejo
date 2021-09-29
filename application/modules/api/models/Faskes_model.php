<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faskes_model extends CI_Model {

    public function dataFaskes()
    {
        $data = $this->db->select('*')->from('user_fakses a')
            ->join('fakses b', 'a.kode_faskes=b.kode_faskes')->get();
        return $data->result();
    }

    public function getListUser($kode_faskes)
	{
		$this->db->select('a.username, a.fullname, a.nik, a.kode_faskes, b.nama_faskes, b.faskes_bpjs')
		->from('user_faskes a')
			->join('faskes b', 'a.kode_faskes=b.kode_faskes', 'inner');
		if($kode_faskes !== 'all'){
			$this->db->where('a.kode_faskes', $kode_faskes);
		}
		$this->db->where('a.status_data', 0);
		$data = $this->db->get();
		return $data->result();
	}

	# pasien
	public function getPasien($awal, $akhir, $kode_faskes)
	{
		
		$this->db->select('a.*, b.*, c.nama_rs, d.nama_bangsal, e.kode_tt, e.no_tt,
		 e.no_kamar as nokmr')->from('registrasi a')
			->join('pasien b', 'a.idpasien=b.idpasien', 'inner')
			->join('rumah_sakit c', 'a.kode_rs=c.kode_rs', 'inner')
			->join('faskes fs', 'a.kode_faskes=fs.kode_faskes', 'inner')
			->join('bangsal d', 'a.kode_bangsal=d.kode_bangsal', 'left')
			->join('tempat_tidur e', 'a.kode_tt=e.kode_tt', 'left');

		if($kode_faskes !== 'all'){
			$this->db->where('a.kode_faskes', $kode_faskes);
		}
		$this->db->where('DATE_FORMAT(a.created_at, "%Y-%m-%d") >=', $awal)
			->where('DATE_FORMAT(a.created_at, "%Y-%m-%d") <=', $akhir)
			->where('a.status_data', 0);
		$data = $this->db->get();
		return $data->result();
	}

}

/* End of file Faskes_model.php */
