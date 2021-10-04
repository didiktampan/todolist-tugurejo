<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{

    public function login($username, $password)
    {
        $data = $this->db->select('USLOGNM, TIPEUSER, USFULLNM')->from('USERLOG')
            ->where('USLOGNM', $username, 'USPASS', $password)->get();
        return $data->result();
    }
}

/* End of file ModelName.php */
