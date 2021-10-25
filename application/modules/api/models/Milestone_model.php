<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Milestone_model extends CI_Model
{

    public function buatID()
    {
        $ex = $this->db->select("MAX(milestoneid) AS id_max ")->from('SDP_MILESTONE')
            ->like('projectid', '0', 'both')->get();
        $id    = "";
        if ($ex->num_rows() > 0) {
            foreach ($ex->result() as $id) {
                $id = str_pad((((int)$id->id_max) + 1), 6, "0", STR_PAD_LEFT);
            }
        } else {
            $id = "000001";
        }
        return $id;
    }

    public function searchBangsal($milestonename, $projectid)
    {
        $this->db->select('*');
        $this->db->like('MILESTONENAME', $milestonename, 'both');
        if ($projectid !== '') {
            $this->db->where('projectid', $projectid);
        }
        $data = $this->db->get('SDP_MILESTONE');
        return $data->result();
    }

    public function getMilestone($id)
    {
        $data = $this->db->query("EXEC SP_SIMADUN_WEB_PROJECT_TCKT @PROJECTID = '$id'");
        return $data->result();
    }

    public function updateBangsal($obj, $milestoneid)
    {
        $update = $this->db->where('milestoneid', $milestoneid)->update('SDP_MILESTONE', $obj);
        return $update;
    }
    public function getDataPasien($awal, $akhir)
    {
        // $data = $this->db->get('CORONA_VAKSIN');
        // $kode_faskes = $this->session->userdata('kode_faskes');
        $data = $this->db->select('*, DATE_FORMAT(STARTDATE, "%d-%m-%Y") as tglinputnew')
            ->where('DATE_FORMAT(STARTDATE, "%Y-%m-%d") >=', $awal)->where('DATE_FORMAT(STARTDATE, "%Y-%m-%d") <=', $akhir)
            ->order_by('STARTDATE', 'desc')->get('SP_SIMADUN_WEB_PROJECTLIST');
        return $data->result();
    }
}

/* End of file BangsalModel.php */
