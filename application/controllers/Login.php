<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();

//		$this->load->model('User');

	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
}
