<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BahanBaku extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelBahanBaku');
	}

	public function index()
	{
		$data["bahan_baku"] = $this->ModelBahanBaku->get_all()->result();
		$this->load->view('bahan_baku', $data);
	}

	public function get_detail($id)
	{
		$data = array();
		$this->db->trans_begin();
		try {
			$data = $this->ModelBahanBaku->get_detail($id)->first_row();
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
		$this->db->trans_begin();
		try {

			$data = array(
				"nama_bahan_baku" => $this->input->post("nama_bahan_baku"),
				"stok" => $this->input->post("stok")
			);
			$this->ModelBahanBaku->insert($data);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil ditambah");
			redirect("bahanbaku");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("bahanbaku");
		}
	}

	public function update()
	{
		$id = $this->input->post("id");

		$this->db->trans_begin();
		try {
			$data = array(
				"nama_bahan_baku" => $this->input->post("nama_bahan_baku"),
				"stok" => $this->input->post("stok")
			);
			$this->ModelBahanBaku->update($data, $id);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil diubah");
			redirect("bahanbaku");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("bahanbaku");
		}
	}

	public function update_stok()
	{
		$id = $this->input->post("id");

		$this->db->trans_begin();
		try {
			$data = array(
				"stok" => $this->input->post("stok")
			);
			$this->ModelBahanBaku->update($data, $id);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil diubah");
			redirect("bahanbaku");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("bahanbaku");
		}
	}

	public function delete($id)
	{
		$this->db->trans_begin();
		try {
			$this->ModelBahanBaku->delete($id);
			$data = $this->ModelBahanBaku->get_detail($id)->first_row();
			unlink('./assets/foto_produk/'.$data->foto);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil dihapus");
			redirect("bahanbaku");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("bahanbaku");
		}
	}

	function upload($file)
	{
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2000;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('profile_pic'))
		{
			$data = $this->upload->display_errors();
//			throw new Exception($data);
		}
		else
		{
			$data = array('image_metadata' => $this->upload->data());
		}
		return $data;
	}
}
