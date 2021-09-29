<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TempatTidur extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'API TEMPAT TIDUR';
    }

    public function createdIdTT()
    {
        $data = $this->tempatTidur->buatID();
        $res = [ 
            'metadata' => [
                'code' => 200,
                'message' =>' success'
            ],
            'response' => $data
        ];
        return APIRESPONSE::response(200, $res);
    }

    public function getListTT()
    {
        $kode_rs = $this->input->get('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $data = $this->tempatTidur->getListTT($kode_rs);
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'daftar TT'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function getTTByKodeBangsal()
    {
        $kode_bangsal = $this->input->get('kode_bangsal');
        $kode_rs = $this->input->get('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $data = $this->tempatTidur->getTTByKodeBangsal($kode_bangsal, $kode_rs);
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'daftar TT pada bangsal'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function availableTtByBangsal()
    {
        $kode_bangsal = $this->input->get('kode_bangsal');
        $kode_rs = $this->input->get('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $data = $this->tempatTidur->availableTtByBangsal($kode_bangsal, $kode_rs);
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'daftar ketersediaan TT'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function availableTtByKamar()
    {
        $kode_bangsal = $this->input->get('kode_bangsal');
        $kode_rs = $this->input->get('kode_rs');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $bangsal = $this->bangsal->getBangsal($kode_rs);
            $tmpBangsal = [];
            foreach ($bangsal as $key => $bangsal) {
                $tmpKamar = [];
                $dataKamar = $this->db->where('kode_bangsal', $bangsal->kode_bangsal)
                    ->group_by('no_kamar')->get('tempat_tidur')->result();
                foreach ($dataKamar as $key => $kamar) {
                    $tmpTt = [];
                    $dataTt = $this->db->select('*')
                        ->where('no_kamar', $kamar->no_kamar)->where('kode_bangsal', $bangsal->kode_bangsal)
                        ->get('tempat_tidur')->result();
                    foreach ($dataTt as $key => $tt) {
                       $tmpTt[] = [
                           'kode_tt' => $tt->kode_tt,
                           'no_kamar' => $tt->no_kamar,
                           'no_tt' => $tt->no_tt,
                           'idpasien' => $tt->idpasien,
                           'no_registrasi' => $tt->no_registrasi,
                           'kode_inden' => $tt->kode_inden
                       ];
                    }
                    $tmpKamar[] = [
                        'nama_bangsal' => $bangsal->nama_bangsal,
                        'no_kamar' => $kamar->no_kamar,
                        'jeniskel_kamar' => $kamar->jeniskel_kamar,
                        'data_tt' => $tmpTt
                    ];
                }
                $tmpBangsal[] = [
                    'kode_rs' => $bangsal->kode_rs,
                    'nama_rs' => $bangsal->nama_rs,
                    'kode_bangsal' => $bangsal->kode_bangsal,
                    'nama_bangsal' => $bangsal->nama_bangsal,
                    'data_kamar' => $tmpKamar
                ];
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

    public function addTT()
    {
        $kode_rs = $this->input->post('kode_rs');
        $username = $this->session->userdata('username') === null ? $this->input->post('username'): $this->session->userdata('username');
        $kode_bangsal = $this->input->post('kode_bangsal');
        $no_kamar = $this->input->post('no_kamar');
        $no_tt = $this->input->post('no_tt');
        $jeniskel_kamar = $this->input->post('jeniskel_kamar');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if(!isset($kode_rs) || $kode_rs === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode rumah sakit tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if(!isset($kode_bangsal) || $kode_bangsal === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode bangsal tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $obj = [
                'kode_tt' => $this->tempatTidur->buatID(),
                'kode_rs' => $kode_rs,
                'kode_bangsal' => $kode_bangsal,
                'no_kamar' => $no_kamar,
                'no_tt' => $no_tt,
                'jeniskel_kamar' => $jeniskel_kamar,
                'userinput' => $username,
                'useredit' => $username
            ];
            $data = SQLBUILDER::manageSql('tempat_tidur', $obj, 'post', '', '');
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

    public function updateTT()
    {
        $kode_tt = $this->input->post('kode_tt');
        $kode_rs = $this->input->post('kode_rs');
        $kode_bangsal = $this->input->post('kode_bangsal');
        $no_kamar = $this->input->post('no_kamar');
        $no_tt = $this->input->post('no_tt');
        $jeniskel_kamar = $this->input->post('jeniskel_kamar');

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if(!isset($kode_rs) || $kode_rs === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode rumah sakit tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if(!isset($kode_bangsal) || $kode_bangsal === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode bangsal tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $obj = [
                'kode_rs' => $kode_rs,
                'kode_bangsal' => $kode_bangsal,
                'no_kamar' => $no_kamar,
                'no_tt' => $no_tt,
                'jeniskel_kamar' => $jeniskel_kamar
            ];
            $data = SQLBUILDER::manageSql('tempat_tidur', $obj, 'update', 'kode_tt', $kode_tt);
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

    public function deleteTT()
    {
        $kode_tt = $this->input->post('kode_tt');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
       
        if(!isset($kode_tt) || $kode_tt === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode TT tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $data = SQLBUILDER::manageSql('tempat_tidur', '', 'delete', 'kode_tt', $kode_tt);
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

/* End of file TempatTidur.php */
