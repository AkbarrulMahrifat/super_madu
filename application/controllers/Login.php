<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('User');
	}

	public function index()
	{
		if ($this->session->userdata("id") != null) {
			redirect("beranda");
		}
		else {
			$this->load->view('login');
		}
	}

	public function login()
	{
		$u = $this->input->post('username');
		$p = hash('sha512', $this->input->post('password'));

		$b = $this->User->cek_login($u,$p);
		if ($b) {
			if ($this->session->userdata('role') == "admin") {
				$this->notification->success("Login berhasil");
				redirect('Beranda');
			}
		}
		else {
			$this->notification->error("Username atau password salah");
			redirect('/');
		}
	}

	public function logout()
	{
		$this->notification->success("Logout berhasil");
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('foto');
		$this->session->unset_userdata('role');
		$this->session->sess_destroy();
		redirect('/');
	}
}
