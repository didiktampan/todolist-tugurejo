<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function buatID($sts)
	{
		$awalan 		= $sts. date('Ymd');
		$QuerySaya 		= $this->db->query(
			"SELECT MAX(id_jurnal) AS id_max 
						  FROM jurnal_tt 
						  WHERE id_jurnal like '%$awalan%';"
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

	public function getStatusPulang()
	{
		$sts = ['2', '3', '4', '9'];
		$data = $this->db->select('kode_status, keterangan')->where_in('kode_status', $sts)->get('status')->result();
		return $data;
	}

    public function mutasi($jurnal_tt, $tempat_tidur)
    {
        $empty = [
            'idpasien' => null,
            'no_registrasi' => null,
            'kode_inden' => null
        ];
        $this->db->trans_begin();
        $updateTT = $this->db->where('kode_tt', $jurnal_tt['kodett_lama'])->update('tempat_tidur', $empty);
		$updateTT = $this->db->where('kode_tt', $jurnal_tt['kodett_baru'])->update('tempat_tidur', $tempat_tidur);
		$jurnal = $this->db->insert('jurnal_tt', $jurnal_tt);
		$data =  $this->db->trans_status() === false ?
	    $this->db->trans_rollback() :
		$this->db->trans_commit();
		return $data;
    }

	public function pilihKamar($tempat_tidur, $updateRegistrasi, $no_registrasi, $kode_tt)
    {
        $this->db->trans_begin();
		$updateReg = $this->db->where('no_registrasi', $no_registrasi)->update('registrasi', $updateRegistrasi);
		$updateTT = $this->db->where('kode_tt', $kode_tt)->update('tempat_tidur', $tempat_tidur);
		$data =  $this->db->trans_status() === false ?
	    $this->db->trans_rollback() :
		$this->db->trans_commit();
		return $data;
    }

	public function pulang($updateRegistrasi, $updateTT, $no_registrasi, $kode_tt)
	{
		$this->db->trans_begin();
		$updateReg = $this->db->where('no_registrasi', $no_registrasi)->update('registrasi', $updateRegistrasi);
		$updateTT = $this->db->where('kode_tt', $kode_tt)->update('tempat_tidur', $updateTT);
		$data =  $this->db->trans_status() === false ?
	    $this->db->trans_rollback() :
		$this->db->trans_commit();
		return $data;
	}

}

/* End of file Transaksi_model.php */
