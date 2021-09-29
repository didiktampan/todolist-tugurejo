<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{

    public function m_register()
    {

        $data = array(
            // 'nama_user' => $this->input->post('nama_user'),
            'USLOGNM' => $this->input->post('USLOGNM'),
            'USPASS' => $this->input->post('USPASS'),
            // 'id_bagian' => $this->input->post('id_bagian'),
            // 'level' => $this->input->post('level')
        );

        return $this->db->insert('USERLOG_DEV', $data);
    }

    public function m_cek_username()
    {

        return $this->db->get_where('USERLOG_DEV', array('USLOGNM' => $this->input->post('USLOGNM')));
    }
    // public function m_cek_pass()
    // {

    //     return $this->db->get_where('USERLOG_DEV', array('USPASS' => $this->input->post('USPASS')));
    // }
    public function cek_login($USLOGNM)
    {

        $hasil = $this->db->where('USLOGNM', $USLOGNM)->limit(1)->get('USERLOG_DEV');
        if ($hasil->num_rows() > 0) {
            return $hasil->row();
        } else {
            return array();
        }
    }
}

/* End of file ModelName.php */
