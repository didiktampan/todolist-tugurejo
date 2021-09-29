<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bangsal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'API BANGSAL';
    }

    public function createIdBangsal()
    {
        $data = $this->bangsal->buatID();
        $res = [
            'metadata' => [
                'code' => 200,
                'message' => ' success'
            ],
            'response' => $data
        ];
        return APIRESPONSE::response(200, $res);
    }

    public function getBangsal()
    {
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if ($validation === true) {
            $data = $this->bangsal->getBangsal();
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => 'ambil daftar bangsal'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function addBangsal()
    {
        $milestoneid = $this->input->post('milestoneid');
        $milestonename = $this->input->post('milestonename');
        // $kode_rs = $this->input->post('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if (!isset($milestonename) || $milestonename === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Nama Bangsal tidak boleh kosong"
                ]
            ];
            return APIRESPONSE::response('', $res);
        }
        // if (!isset($kode_rs) || $kode_rs === '') {
        //     $res = [
        //         'metadata' => [
        //             'code' => 200,
        //             'message' => "Kode RS tidak boleh kosong"
        //         ],
        //         'response' => false

        //     ];
        //     return APIRESPONSE::response('', $res);
        // }
        if ($validation === true) {
            $obj = [
                // 'milestoneid' => $this->bangsal->buatID(),
                'milestoneid' => $milestoneid,
                'milestonename' => $milestonename,
                // 'kode_rs' => $kode_rs
            ];
            $data = SQLBUILDER::manageSql('SDP_MILESTONE', $obj, 'post', '', '');
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

    public function  updateBangsal()
    {
        $milestoneid = $this->input->post('milestoneid');
        // $kode_rs = $this->input->post('kode_rs');
        $milestonename = $this->input->post('milestonename');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if (!isset($milestonename) || $milestonename === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Nama Bangsal tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if (!isset($milestoneid) || $milestoneid === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode Bangsal tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        // if (!isset($kode_rs) || $kode_rs === '') {
        //     $res = [
        //         'metadata' => [
        //             'code' => 200,
        //             'message' => "Kode RS tidak boleh kosong"
        //         ],
        //         'response' => false
        //     ];
        //     return APIRESPONSE::response('', $res);
        // }
        if ($validation === true) {
            $obj = [
                'milestonename' => $milestonename
            ];
            $data = $this->bangsal->updateBangsal($obj, $milestoneid);
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

    public function deleteBangsal()
    {
        $milestoneid = $this->input->post('milestoneid');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if (!isset($milestoneid) || $milestoneid === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode Bangsal tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if ($validation === true) {
            $data = SQLBUILDER::manageSql('SDP_MILESTONE', '', 'delete', 'MILESTONEID', $milestoneid);
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

/* End of file Bangsal.php */
