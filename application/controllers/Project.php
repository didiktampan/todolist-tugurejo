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
            if ($value->PROJECTSTS === 'Open') {
                $statusproject = '<span class="badge badge-primary">' . $value->PROJECTSTS . '</span>';
            } else if ($value->PROJECTSTS === 'Selesai') {
                $statusproject = '<span class="badge badge-success">' . $value->PROJECTSTS . '</span>';
            } else {
                $statusproject = '<span class="badge badge-success">' . $value->PROJECTSTS . '</span>';
            }

            if ($value->PROGRESS === '.00') {
                $statust = '<span class="progress-bar progress bg-primary"> ' . $value->PROGRESS . '</span>';
            } else if ($value->PROGRESS === '100.00') {
                $statust = '<span class="progress-bar progress-sm bg-success">' . '</span>';
            } else {
                $statust = '<span class="progress-bar progress-sm bg-primary">' . '</span>';
            }

            $result[] = [
                'nomor' => $nomor,
                'projectid' => $value->PROJECTID,
                'projectname' => $value->PROJECTNAME,
                'pic' => $value->PIC,
                'projectsts' => $statusproject,
                'progress' => $statust,
                'enginer' => $value->ENGINEER,
                'startdate' => $value->STARTDATE,
                'enddate' => $value->ENDDATE,
                'action' => '
                    <a  href="' . base_url('api/Project/detailpinjam/' . $value->PROJECTID . '?pinjam=yes') . '" class="btn btn-primary btn-xs" title="detail pinjam">
                    <i class="fa fa-eye"></i></a>
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Detail"
                    id="btn-detail"
                    data-projectid="' . $value->PROJECTID . '"
                    data-projectname="' . $value->PROJECTNAME . '"
                    data-pic="' . $value->PIC . '"
                    data-enginer="' . $value->ENGINEER . '"
                    data-startdate="' . $value->STARTDATE . '"
                    data-enddate="' . $value->ENDDATE . '">
                <i class="fa fa-book-open"></i>
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
