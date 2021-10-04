<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'API USER MITIGASI';
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $check = $this->AuthModel->login($username);
        $updUserStatus = ['status_user' => 1];

        if ($check !== null) {
            $hash = password_verify($password, $check->password);
            if ($hash) {
                $status = $check->status_user === 1 ? TRUE : FALSE;
                $obj = array(
                    'kode_rs' => $check->kode_rs,
                    'nama_rs' => $check->nama_rs,
                    'username' => $check->username,
                    'status_log' => TRUE,
                    'status_user' => $status,
                );
                $res = [
                    'metadata' => [
                        'code' => 200,
                        'message' => 'berhasil masuk'
                    ],
                    'response' => $obj
                ];
                $this->session->set_userdata($res);
                SQLBUILDER::manageSql('user_mitigasi', $updUserStatus, 'update', 'username', $username);
            } else {
                $res = [
                    'metadata' => [
                        'code' => 300,
                        'message' => 'password salah'
                    ],
                    'response' => new stdClass()
                ];
            }
        } else {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => 'akun tidak ditemukan'
                ],
                'response' => new stdClass()
            ];
        }

        return APIRESPONSE::response('', $res);
    }

    public function getToken()
    {
        $token = AUTHORIZATION::private_token();
        $res = [
            'metadata' => ['message' => 'username / password salah', 'code' => 401],
            'response' => []
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($username === 'jateng' && $password === 'gayeng') {
                $res = [
                    'metadata' => ['message' => 'Ok', 'code' => 200],
                    'response' => ['token' => $token]
                ];
                return APIRESPONSE::response(200, $res);
            } else {
                $res = [
                    'metadata' => ['message' => 'username / password salah', 'code' => 401],
                    'response' => []
                ];
                return APIRESPONSE::response(401, $res);
            }
        } else {
            $res = [
                'metadata' => ['message' => 'Method Not Allowed', 'code' => 405]
            ];
            return APIRESPONSE::response(405, $res);
        }
        return APIRESPONSE::response(401, $res);
    }

    public function getListUser()
    {
        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('GET', $token);
        if ($validation === true) {
            $data = $this->user->getListUser();
            $res = [
                'metadata' => [
                    'code' => 200,
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
        $kode_rs = $this->input->post('kode_rs');

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if (!isset($username) || $username === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Username tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if (!isset($password) || $password === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Password tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if (!isset($kode_rs) || $kode_rs === '') {
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
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'kode_rs' => $kode_rs,
                'fullname' => $fullname,
                'nik' => $nik
            ];
            $data = SQLBUILDER::manageSql('user_mitigasi', $obj, 'post', '', '');
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

    public function updateUser()
    {
        $username = $this->input->post('username');
        $fullname = $this->input->post('fullname');
        $nik = $this->input->post('nik');
        $password = $this->input->post('password');
        $kode_rs = $this->input->post('kode_rs');

        $token = $this->input->get_request_header('X-token');
        $validation = AUTHORIZATION::implementation('POST', $token);
        if (!isset($username) || $username === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Username tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if (!isset($password) || $password === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Password tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }
        if (!isset($kode_rs) || $kode_rs === '') {
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
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'kode_rs' => $kode_rs,
                'fullname' => $fullname,
                'nik' => $nik
            ];
            $data = SQLBUILDER::manageSql('user_mitigasi', $obj, 'update', 'username', $username);
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
        if (!isset($username) || $username === '') {
            $res = [
                'metadata' => [
                    'code' => 200,
                    'message' => "Username tidak boleh kosong"
                ],
                'response' => false
            ];
            return APIRESPONSE::response('', $res);
        }

        if ($validation === true) {
            $data = SQLBUILDER::manageSql('user_mitigasi', '', 'delete', 'username', $username);
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

/* End of file User.php */
