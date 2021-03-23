<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('ModelProduk');

	}

	public function index()
	{
		$data["produk"] = $this->ModelProduk->get_all()->result();
		$this->load->view('produk', $data);
	}

	public function get_detail($id)
	{
		$data = array();
		$this->db->trans_begin();
		try {
			$data = $this->ModelProduk->get_detail($id)->first_row();
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			echo json_encode($data);
		}
		$this->db->trans_commit();
		echo json_encode($data);
	}

	public function tambah()
	{
		$data = array(
			"nama_produk" => $this->input->post("nama_produk"),
			"deskripsi" => $this->input->post("deskripsi"),
			"stok" => $this->input->post("stok")
		);

		$this->db->trans_begin();
		try {
			$this->ModelProduk->insert($data);
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			throw new \Exception($e);
		}
		$this->db->trans_commit();
		redirect("produk");
	}

	public function update()
	{
		$id = $this->input->post("id");
		$data = array(
			"nama_produk" => $this->input->post("nama_produk"),
			"deskripsi" => $this->input->post("deskripsi"),
			"stok" => $this->input->post("stok")
		);

		$this->db->trans_begin();
		try {
			$this->ModelProduk->update($data, $id);
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			throw new \Exception($e);
		}
		$this->db->trans_commit();
		redirect("produk");
	}

	public function delete($id)
	{
		$this->db->trans_begin();
		try {
			$this->ModelProduk->delete($id);
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			throw new \Exception($e);
		}
		$this->db->trans_commit();
		redirect("produk");
	}
}
