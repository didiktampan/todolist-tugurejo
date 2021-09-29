<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InfoUmum extends CI_Controller {

    public function index()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_dashboard', $data);
    }

    public function infoTt()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_infoTt', $data);
    }
}

/* End of file InfoUmum.php */
