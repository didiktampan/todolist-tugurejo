<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi_model extends CI_Model {

    public function totalPasientByMonth($month)
    {
        $data = $this->db->select('r.kode_rs, COUNT(r.idpasien) as total, r.created_at as bulan,
            SUM(CASE WHEN p.jeniskel = "L" THEN 1 ELSE 0 END) as lakilaki,
            SUM(CASE WHEN p.jeniskel = "P" THEN 1 ELSE 0 END) as perempuan ')
            ->from('registrasi r')
            ->join('pasien p', 'r.idpasien=p.idpasien', 'inner')
            ->like('r.created_at', $month, 'both')
            ->group_by('r.kode_rs')->get();
        return $data->result();
    }

}

/* End of file Rekapitulasi_model.php */
