<?php


class Beranda extends CI_Controller
{
	function __construct(){
		parent::__construct();

		$this->load->model('ModelUser');
		$this->load->model('ModelProduk');
		$this->load->model('ModelPenjualan');
		$this->load->model('ModelPeramalan');
	}

	public function index()
	{
		$this->load->view('beranda');
	}

	public function about()
	{
		$this->load->view('about');
	}
}
