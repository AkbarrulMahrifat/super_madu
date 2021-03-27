<?php


class Notification
{
	function success($message)
	{
		$data = array(
			"type" => "success",
			"class" => "bg-success",
			"icon" => "fas fa-check fa-lg",
			"title" => "Success",
			"message" => $message,
		);
		$this->set($data);
	}

	function error($message)
	{
		$data = array(
			"type" => "error",
			"class" => "bg-danger",
			"icon" => "fas fa-close fa-lg",
			"title" => "Error",
			"message" => $message,
		);
		$this->set($data);
	}

	function set($data)
	{
		$CI =& get_instance();
		$CI->load->library("session");
		$CI->session->set_tempdata($data, NULL, 5);
	}
}
