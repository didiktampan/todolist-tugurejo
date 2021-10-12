<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
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
        $this->template->load('layouts/Layouts', 'dashboard/V_project', $data);
        // $this->template->load('layouts/Layouts', 'dashboard/td_Dashboard', $data);
    }

    // public function select2RS()
    // {
    //     $projectname = $this->input->get('search');
    //     $projectid = $this->session->userdata('projectid');
    //     $data = $this->bangsal->searchBangsal($projectname, $projectid);
    //     // $result = [];
    //     // foreach ($data as $key => $value) {
    //     //     $result[] = ['id' => $value->kode_bangsal, 'text' => $value->nama_bangsal];
    //     // }
    //     return APIRESPONSE::response('', $data);
    // }

    public function dataProject()
    {
        // $projectid = $this->input->get('projectid');
        $final = [];
        $result = [];
        $data = $this->project->getProject();
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'projectname' => $value->PROJECTNAME,
                'projectsts' => $value->PROJECTSTS = '<option value="1" ' . ($value == "Open" ? 'selected="selected"' : '') . '>Open</option>', '<option value="1" ' . ($value == "Selesai" ? 'selected="selected"' : '') . '>Selesai</option>',
                'progress' => $value->PROGRESS,
                'enginer' => $value->ENGINEER,
                'action' => '
                <a  href="' . base_url('api/Project/detailpinjam/' . $value->PROJECTID . '?pinjam=yes') . '" class="btn btn-primary btn-sm" title="detail pinjam">
                <i class="fa fa-eye"></i>
                </a>
                    '
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
}

/* End of file Bangsal.php */
