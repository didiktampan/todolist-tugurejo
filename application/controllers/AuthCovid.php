<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';

use \Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
class AuthCovid extends CI_Controller
{


	public function index()
	{

		// if ($this->session->userdata('is_login') == TRUE) {
		// 	redirect('AuthCovid');
		// }

		$this->load->view('V_login');
	}

	public function register()
	{

		if ($this->session->userdata('is_login') == TRUE) {
			redirect('dashboard', 'refresh');
		}

		$this->template->load('layouts/Layouts', 'dashboard/v_user');
	}

	public function register_proses()
	{

		// $this->form_validation->set_rules('nama_user', 'Nama', 'trim|required|min_length[3]|max_length[22]');
		$this->form_validation->set_rules('USLOGNM', 'USLOGNM', 'trim|required|min_length[3]|max_length[45]|is_unique[USERLOG_DEV.USLOGNM]');
		$this->form_validation->set_rules('USPASS', 'USPASS', 'trim|required|min_length[5]|max_length[12]');
		// $this->form_validation->set_rules('id_bagian', 'id_bagian', 'trim|required|min_length[3]|max_length[22]');
		// $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[3]|max_length[22]');

		if ($this->form_validation->run() == TRUE) {

			if ($this->AuthMode->m_register()) {
				$this->session->set_flashdata('pesan', 'Register berhasil, silahkan  Sign In.');
				redirect('User_todolist', 'refresh');
			} else {

				$this->session->set_flashdata('pesan', 'Register user gagal!');
				redirect('/', 'refresh');
			}
		} else {

			$this->template->load('layouts/Layouts', 'dashboard/v_user');
		}
	}

	public function login_proses()
	{
		$this->form_validation->set_rules('USLOGNM', 'USLOGNM', 'trim|required|min_length[3]|max_length[45]');
		$this->form_validation->set_rules('USPASS', 'USPASS', 'trim|required|min_length[5]|max_length[12]');

		if ($this->form_validation->run() == TRUE) {

			if ($this->AuthModel->m_cek_username()->num_rows() == 1) {
				$db = $this->AuthModel->m_cek_username()->row();
				if ($this->input->post('USPASS') == $db->USPASS) {

					$data_login = array(
						'is_login' => TRUE,
						'USLOGNM'  => $db->USLOGNM,
						'USFULLNM'   => $db->USFULLNM,
						'TIPEUSER' => $db->TIPEUSER
					);
					$this->session->set_userdata($data_login);
					redirect('Bangsal');
				} else {
					$this->session->set_flashdata('pesan', 'Login gagal: USPASS salah!');
					redirect('/', 'refresh');
					// echo $this->input->post('USPASS');
				}
				// echo $this->input->post('USLOGNM');
			} else { // jika USLOGNM tidak terdaftar!

				$this->session->set_flashdata('pesan', 'Login gagal: USLOGNM salah!');
				// redirect('/', 'refresh');
				// echo 'berhenti';
			}
		} else {
			// $this->template->load('Layouts/role', 'v_login');
			// echo 'macetdisitu';
			// echo $this->input->post('USLOGNM');

		}
	}


	// public function securepage()
	// {

	//     if ($this->session->userdata('is_login') == FALSE) {
	//         redirect('/', 'refresh');
	//     }

	//     $this->template->load('role', 'user/securepage');
	// }


	// public function logout()
	// {

	//     $this->session->unset_userdata('is_login');
	//     $this->session->unset_userdata('nama_user');
	//     $this->session->unset_userdata('USLOGNM');

	//     session_destroy();
	//     //$this->session->set_flashdata('pesan', 'Sign Out Berhasil!');
	//     redirect('/', 'refresh');
	// }
	public function logout()
	{
		$this->session->sess_destroy();
		echo '<script>
            alert("Sukses! Anda berhasil logout."); 
            window.location.href="' . base_url('index.php/AuthCovid') . '";
            </script>';
	}
}
