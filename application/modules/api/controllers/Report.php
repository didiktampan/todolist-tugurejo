<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
        $projectid = $this->input->get('projectid');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if ($validation === true) {
            $data = $this->bangsal->getBangsal($projectid);
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
        $projectid = $this->input->post('projectid');
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
        if (!isset($projectid) || $projectid === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode RS tidak boleh kosong"
                ],
                'response' => false

            ];
            return APIRESPONSE::response('', $res);
        }
        if ($validation === true) {
            $obj = [
                'milestoneid' => $this->bangsal->buatID(),
                // 'milestoneid' => $milestoneid,
                'milestonename' => $milestonename,
                'projectid' => $projectid
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
        // $projectid = $this->input->post('projectid');
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
        // if (!isset($projectid) || $projectid === '') {
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
