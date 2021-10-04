<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bangsal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogin') != TRUE) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_bangsal', $data);
        // $this->template->load('layouts/Layouts', 'dashboard/td_Dashboard', $data);
    }

    public function select2RS()
    {
        $projectname = $this->input->get('search');
        $projectid = $this->session->userdata('projectid');
        $data = $this->bangsal->searchBangsal($projectname, $projectid);
        // $result = [];
        // foreach ($data as $key => $value) {
        //     $result[] = ['id' => $value->kode_bangsal, 'text' => $value->nama_bangsal];
        // }
        return APIRESPONSE::response('', $data);
    }

    public function dataBangsal()
    {
        $projectid = $this->input->get('projectid');
        $final = [];
        $result = [];
        $data = $this->bangsal->getBangsal($projectid);
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'milestoneid' => $value->MILESTONEID,
                'milestonename' => $value->MILESTONENAME,
                'projectname' => $value->PROJECTNAME,
                'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
                    id="btn-edit"
                    data-milestoneid="' . $value->MILESTONEID . '"
                    data-milestonename="' . $value->MILESTONENAME . '"
                    data-projectid="' . $value->PROJECTID . '"
                    data-projectname="' . $value->PROJECTNAME . '">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Delete"
                    id="btn-delete"
                    data-milestoneid="' . $value->MILESTONEID . '"
                    data-milestonename="' . $value->MILESTONENAME . '">
                        <i class="fa fa-trash"></i>
                    </button>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
}

/* End of file Bangsal.php */
