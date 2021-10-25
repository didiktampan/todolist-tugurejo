<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Card_model extends CI_Model
{



    public function getMilestone($id)
    {
        $data = $this->db->query("EXEC SP_SIMADUN_WEB_PROJECT_TCKT @PROJECTID = '$id'");
        return $data->result();
    }

    public function getPic($id_pic)
    {
        $data = $this->db->query("EXEC SP_SIMADUN_WEB_PROJECT_PICDTL @ID_PIC = '$id_pic' ");
        return $data->result();
    }

    public function getCard($id_pic)
    {

        $data = $this->db->query("EXEC SP_SIMADUN_WEB_PROJECT_PICDTL @ID_PIC = '$id_pic'");
        return $data->result();
    }

    public function updateBangsal($obj, $milestoneid)
    {
        $update = $this->db->where('milestoneid', $milestoneid)->update('SDP_MILESTONE', $obj);
        return $update;
    }
}

/* End of file BangsalModel.php */
