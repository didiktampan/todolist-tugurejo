<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';

use \Firebase\JWT\JWT;


header('Access-Control-Allow-Origin: *');
class Auth extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->userdata('isLogin') != TRUE) {

			$data['token'] = AUTHORIZATION::private_token();
			$this->load->view('V_login', $data);
		} else {
			$data['token'] = AUTHORIZATION::private_token();
			$this->load->view('layouts/Layouts', 'dashboard/V_admin', $data);
		}
	}

	public function signout()
	{
		// $this->session->sess_destroy();
		// redirect('signin');
		$this->session->sess_destroy();
		echo '<script>
            alert("Sukses! Anda berhasil logout."); 
            window.location.href="' . base_url('index.php/Auth') . '";
            </script>';
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->AuthModel->login($username, $password);
		$token = AUTHORIZATION::private_token();
		if ($data) {

			$obj = [
				'username' => $data[0]->USLOGNM,
				'tipe_user' => $data[0]->TIPEUSER,
				'usfullnm' => $data[0]->USFULLNM,
				// 'user_groupid' => $data[0]->USERGROUPID,
				'isLogin' => true
			];

			$this->session->set_userdata($obj);

			$res = [
				'status' => [
					'code' => 200,
					'message' => 'login success'
				],
				'data' => $obj,
				'token' => $token
			];
		} else {
			$res = [
				'status' => [
					'code' => intval($data[0]->kode),
					'message' => $data[0]->message
				],
				'data' => []
			];
		}
		return APIRESPONSE::response('', $res);
	}

	public function user()
	{
		if ($this->session->userdata('STATUS') != TRUE) {
			$data['token'] = AUTHORIZATION::private_token();
			$this->load->view('V_login', $data);
		} else {
			$data['token'] = $token = AUTHORIZATION::private_token();
			$this->template->load('layouts/Layouts', 'dashboard/V_user', $data);
		}
	}

	public function dataUser()
	{
		$final = [];
		$result = [];
		$data = $this->user->getListUser();
		$nomor = 0;
		foreach ($data as $key => $value) {
			$nomor++;
			$result[] = [
				'nomor' => $nomor,
				'username' => $value->username,
				'fullname' => $value->fullname,
				'nama_rs' => $value->nama_rs,
				'nik' => $value->nik,
				'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
                    id="btn-edit"
					data-username="' . $value->username . '"
					data-fullname="' . $value->fullname . '"
					data-nama_rs="' . $value->nama_rs . '"
					data-nik="' . $value->nik . '">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Delete"
                    id="btn-delete"
					data-username="' . $value->username . '">
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
