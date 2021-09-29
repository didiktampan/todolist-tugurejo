<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bangsal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if ($this->session->userdata('status_log') != TRUE) {
        //     redirect('signin');
        // }
    }

    public function index()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_bangsal', $data);
    }

    public function select2RS()
    {
        $nama_rs = $this->input->get('search');
        $kode_rs = $this->session->userdata('kode_rs');
        $data = $this->bangsal->searchBangsal($nama_rs, $kode_rs);
        // $result = [];
        // foreach ($data as $key => $value) {
        //     $result[] = ['id' => $value->kode_bangsal, 'text' => $value->nama_bangsal];
        // }
        return APIRESPONSE::response('', $data);
    }

    public function dataBangsal()
    {
        // $kode_rs = $this->input->get('kode_rs');
        $final = [];
        $result = [];
        $data = $this->bangsal->getBangsal();
        $nomor = 0;
        foreach ($data as $key => $value) {
            $nomor++;
            $result[] = [
                'nomor' => $nomor,
                'milestoneid' => $value->MILESTONEID,
                'milestonename' => $value->MILESTONENAME,
                'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
                    id="btn-edit"
                    data-milestoneid="' . $value->MILESTONEID . '"
                    data-milestonename="' . $value->MILESTONENAME . '">
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
