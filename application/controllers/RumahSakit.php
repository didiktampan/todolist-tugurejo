<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RumahSakit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') == FALSE) {
            redirect('signin', 'refresh');
        }
    }


    public function index()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_rumahsakit', $data);
    }

    public function select2RS()
    {
        $projectname = $this->input->get('search');
        $field = 'projectid as id, projectname as text';
        $data = SQLBUILDER::getWhere('SDP_PROJECT', $field, 'projectname', $projectname);
        return APIRESPONSE::response('', $data);
    }

    public function dataRS()
    {
        $field = 'projectid, projectname';
        $final = [];
        $result = [];
        $data = SQLBUILDER::manageSql('SDP_PROJECT', '', 'get', $field, '');
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'projectid' => $value->projectid,
                'projectname' => $value->projectname,
                'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
                    id="btn-edit"
                    data-projectid="' . $value->projectid . '"
                    data-projectname="' . $value->projectname . '">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Delete"
                    id="btn-delete"
                    data-projectid="' . $value->projectid . '"
                    data-projectname="' . $value->projectname . '">
                        <i class="fa fa-trash"></i>
                    </button>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }

    public function infoTt()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_infoTt', $data);
    }

    public function dataInfoTt()
    {
        $kode_rs = $this->input->get('kode_rs');
        $final = [];
        $result = [];
        $data = $this->rumahSakit->infoTt($kode_rs);
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'kode_rs' => $value->kode_rs,
                'nama_rs' => $value->nama_rs,
                'tt_kosong' => $value->kosong,
                'tt_terpakai' => $value->terpakai,
                'total' => $value->total,
                'action' => '<a href="' . base_url('registrasi') . '?kode_rs=' . $value->kode_rs . '" class="btn btn-primary btn-xs">Daftar</a>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }
}

/* End of file RumahSakit.php */
