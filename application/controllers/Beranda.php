<?php


class Beranda extends CI_Controller
{
	function __construct(){
		parent::__construct();

		$this->load->model('ModelUser');
	}

	public function index()
	{
		$this->load->view('beranda');
	}
}
