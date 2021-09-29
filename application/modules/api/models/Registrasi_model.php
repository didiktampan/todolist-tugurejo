<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_model extends CI_Model {

    public function buatID()
	{
		$awalan 		= "CV" . date('Ymd');
		$QuerySaya 		= $this->db->query(
			"SELECT MAX(no_registrasi) AS id_max 
						  FROM registrasi 
						  WHERE no_registrasi like '%$awalan%';"
		);
		$id_result		= "";
		if ($QuerySaya->num_rows() > 0) {
			foreach ($QuerySaya->result() as $id) {
				$id_tmp 	= str_replace("-", "", substr($id->id_max, -4));
				$id_result 	= $awalan . str_pad((((int) $id_tmp) + 1), 4, "0", STR_PAD_LEFT);
			}
		} else {
			$id_result 		= $awalan . "0001";
		}
		return $id_result;
	}

	public function buatIdInden()
	{
		$awalan 		= "ID" . date('Ymd');
		$QuerySaya 		= $this->db->query(
			"SELECT MAX(kode_inden) AS id_max 
						  FROM registrasi 
						  WHERE kode_inden like '%$awalan%';"
		);
		$id_result		= "";
		if ($QuerySaya->num_rows() > 0) {
			foreach ($QuerySaya->result() as $id) {
				$id_tmp 	= str_replace("-", "", substr($id->id_max, -4));
				$id_result 	= $awalan . str_pad((((int) $id_tmp) + 1), 4, "0", STR_PAD_LEFT);
			}
		} else {
			$id_result 		= $awalan . "0001";
		}
		return $id_result;
	}

    public function saveRegistrasi($master, $registrasi, $tempatTidur, $jurnal_tt)
    {
		$kode_tt = $registrasi['kode_tt'];
        $this->db->trans_begin();
		if($master !== ''){
			$this->db->insert('pasien', $master);
		}
		if($tempatTidur !== ''){
			$updateTT = $this->db->where('kode_tt', $kode_tt)->update('tempat_tidur', $tempatTidur);
		}
		if($jurnal_tt !== ''){
			$jurnal = $this->db->insert('jurnal_tt', $jurnal_tt);
		}
		$registrasiPasien = $this->db->insert('registrasi', $registrasi);
		$data =  $this->db->trans_status() === false ?
	    $this->db->trans_rollback() :
		$this->db->trans_commit();
		return $data;
    }

	public function indenRegistrasi($master, $registrasi)
	{
		$this->db->trans_begin();
		if($master !== ''){
			$this->db->insert('pasien', $master);
		}
		
		$registrasiPasien = $this->db->insert('registrasi', $registrasi);
		$data =  $this->db->trans_status() === false ?
	    $this->db->trans_rollback() :
		$this->db->trans_commit();
		return $data;
	}

	public function getPasien($awal, $akhir, $kode_rs)
	{
		
		$this->db->select('a.*, b.*, c.nama_rs, d.nama_bangsal, e.kode_tt, e.no_tt,
		 e.no_kamar as nokmr')->from('registrasi a')
			->join('pasien b', 'a.idpasien=b.idpasien', 'inner')
			->join('rumah_sakit c', 'a.kode_rs=c.kode_rs', 'inner')
			->join('bangsal d', 'a.kode_bangsal=d.kode_bangsal', 'left')
			->join('tempat_tidur e', 'a.kode_tt=e.kode_tt', 'left');

		if($kode_rs !== 'all'){
			$this->db->where('a.kode_rs', $kode_rs);
		}
		$this->db->where('DATE_FORMAT(a.created_at, "%Y-%m-%d") >=', $awal)
			->where('DATE_FORMAT(a.created_at, "%Y-%m-%d") <=', $akhir)
			->where('a.status_data', 0);
		$data = $this->db->get();
		return $data->result();
	}

	public function getDataPasienByUsername($username, $kode_rs)
	{
		
		$this->db->select('a.*, b.nama, b.jeniskel, b.tgllahir, b.alamat_ktp, b.notelp, 
		c.nama_rs, d.nama_bangsal, e.kode_tt, e.no_tt,
		 e.no_kamar as nokmr')->from('registrasi a')
			->join('pasien b', 'a.idpasien=b.idpasien', 'inner')
			->join('rumah_sakit c', 'a.kode_rs=c.kode_rs', 'inner')
			->join('bangsal d', 'a.kode_bangsal=d.kode_bangsal', 'left')
			->join('tempat_tidur e', 'a.kode_tt=e.kode_tt', 'left');

		if($kode_rs !== 'all'){
			$this->db->where('a.kode_rs', $kode_rs);
		}
		$this->db->where('a.userinput', $username)->where('a.status_data', 0);
		$data = $this->db->get();
		return $data->result();
	}

	public function checkStatusPasien($idpasien)
	{
		$status = ['Daftar', 'Aproval', 'Inap'];
		$data = $this->db->where('idpasien', $idpasien)
			->where('status_data', 0)
			->where_in('status', $status)->get('registrasi');
		return $data;
	}

}

/* End of file RegistrasiModel.php */
