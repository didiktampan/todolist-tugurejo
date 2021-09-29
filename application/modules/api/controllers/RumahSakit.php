<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RumahSakit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'API DAFTAR RUMAH SAKIT';
    }

    public function createdIdRS()
    {
        $data = $this->rumahSakit->buatID();
        $res = [
            'metadata' => [
                'code' => 200,
                'message' => ' success'
            ],
            'response' => $data
        ];
        return APIRESPONSE::response(200, $res);
    }

    public function getRS()
    {
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if ($validation === true) {
            $field = 'kode_rs, nama_rs';
            $data = SQLBUILDER::checkDuplicated('rumah_sakit', 'kode_rs !=', 'all');
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => 'ambil daftar rumah sakit'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function getRsByKodeRs()
    {
        $kode_rs = $this->input->get('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if ($validation === true) {
            $field = 'kode_rs, nama_rs';
            $data = SQLBUILDER::getWhere('rumah_sakit', $field, 'kode_rs', $kode_rs);
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => 'ambil daftar rumah sakit'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function infoTt()
    {
        $kode_bangsal = $this->input->get('kode_bangsal');
        $kode_rs = $this->input->get('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if ($validation === true) {
            $bangsal = $this->rumahSakit->infoTt();
            $tmpBangsal = [];
            foreach ($bangsal as $key => $bangsal) {
            }
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => 'daftar ketersediaan TT'
                ],
                'response' => [
                    'dataBangsal' => $tmpBangsal
                ]
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function addRS()
    {
        $nama_rs = $this->input->post('nama_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if (!isset($nama_rs) || $nama_rs === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Nama rumah sakit tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if ($validation === true) {
            $obj = [
                'kode_rs' => $this->rumahSakit->buatID(),
                'nama_rs' => $nama_rs
            ];
            $data = SQLBUILDER::manageSql('rumah_sakit', $obj, 'post', '', '');
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => 'berhasil menambahkan'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function  updateRS()
    {
        $projectid = $this->input->post('projectid');
        $projectname = $this->input->post('projectname');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if (!isset($projectname) || $projectname === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Nama rumah sakit tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if (!isset($projectid) || $projectid === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode rumah sakit tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if ($validation === true) {
            $obj = [
                'projectname' => $projectname
            ];
            $data = SQLBUILDER::manageSql('SDP_PROJECT', $obj, 'update', 'PROJECTID', $projectid);
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => 'berhasil mengubah'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function deleteRS()
    {
        $projectid = $this->input->post('projectid');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);

        if (!isset($projectid) || $projectid === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode rumah sakit tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if ($validation === true) {
            $data = SQLBUILDER::manageSql('SDP_PROJECT', '', 'delete', 'PROJECTID', $projectid);
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => 'berhasil menghapus'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }
}

/* End of file RumahSakit.php */
