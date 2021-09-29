<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faskes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        echo 'API FASKES';
    }
    
    #MASTER FASKES
    public function getFaskes()
    {
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $field = 'kode_rs, nama_rs';
            $data = SQLBUILDER::getWhere('faskes','*', 'status_data', 0);
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => 'ambil daftar faskes'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function addFaskes(){
        $kode_faskes = $this->input->post('kode_faskes');
        $nama_faskes = $this->input->post('nama_faskes');

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if(!isset($nama_faskes) || $nama_faskes === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Nama faskes tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $obj = [
                'kode_faskes' => $kode_faskes,
                'nama_faskes' => $nama_faskes
            ];
            $check = SQLBUILDER::checkDuplicated('faskes', 'kode_faskes', $kode_faskes);
            if(count($check) > 0){
                $res = [ 
                    'metadata' => [
                        'code' => 200,
                        'message' => "Kode faskes sudah digunakan"
                    ],
                    'response' => false
                ];
                return APIRESPONSE::response('', $res);
            }
            $data = SQLBUILDER::manageSql('faskes', $obj, 'post', '', '');
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

    public function  updateFaskes(){
        $kode_faskes = $this->input->post('kode_faskes');
        $nama_faskes = $this->input->post('nama_faskes');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if(!isset($nama_faskes) || $nama_faskes === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Nama faskes tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if(!isset($kode_faskes) || $kode_faskes === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode faskes tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $obj = [
                'nama_faskes' => $nama_faskes
            ];
            $data = SQLBUILDER::manageSql('faskes', $obj, 'update', 'kode_faskes', $kode_faskes);
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

    public function deleteFaskes()
    {
        $kode_faskes = $this->input->post('kode_faskes');
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
       
        if(!isset($kode_faskes) || $kode_faskes === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode faskes tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $obj = ['status_data' => 1];
            $data = SQLBUILDER::manageSql('faskes', $obj, 'update', 'kode_faskes', $kode_faskes);
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

    #USER FASKES
    public function getListUser()
    {
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if($validation === true){
            $data = $this->user->getListUser();
            $res = [ 
                'metadata' => [
                    'code' => '',
                    'message' => 'ambil daftar pengguna mitigasi'
                ],
                'response' => $data
            ];
        } else {
            $res = $validation;
        }
        return APIRESPONSE::response('', $res);
    }

    public function addUser()
    {
        $username = $this->input->post('username');
        $fullname = $this->input->post('fullname');
        $nik = $this->input->post('nik');
        $password = $this->input->post('password');
        $kode_faskes = $this->input->post('kode_faskes');
        $faskes_bpjs = $this->input->post('faskes_bpjs');

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if(!isset($username) || $username === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Username tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if(!isset($password) || $password === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Password tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if(!isset($kode_faskes) || $kode_faskes === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode Faskes tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $obj = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'kode_faskes' => $kode_faskes,
                'fullname' => $fullname,
                'nik' => $nik,
                'faskes_bpjs' => $faskes_bpjs,
                'compinput' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
                'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR'])
            ];
            $data = SQLBUILDER::manageSql('user_faskes', $obj, 'post', '', '');
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

    public function updateUser(){
        $username = $this->input->post('username');
        $fullname = $this->input->post('fullname');
        $nik = $this->input->post('nik');
        $password = $this->input->post('password');
        $kode_faskes = $this->input->post('kode_faskes');

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if(!isset($username) || $username === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Username tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if(!isset($password) || $password === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Password tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if(!isset($kode_faskes) || $kode_faskes === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Kode Faskes tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if($validation === true){
            $obj = [
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'kode_faskes' => $kode_faskes,
                'fullname' => $fullname,
                'nik' => $nik,
                'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $data = SQLBUILDER::manageSql('user_faskes', $obj, 'update', 'username', $username);
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

    public function deleteUser()
    {
        $username = $this->input->post('username');

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if(!isset($username) || $username === ''){
            $res = [ 
                'metadata' => [
                    'code' => 200,
                    'message' => "Username tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        
        if($validation === true){
            $obj = [
              'status_data' => 1,
              'compedit' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
              'updated_at' => date('Y-m-d H:i:s')
            ];
            $data = SQLBUILDER::manageSql('user_faskes', $obj, 'update', 'username', $username);
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

/* End of file Faskes.php */
