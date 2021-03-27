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
		$this->db->trans_begin();
		try {
			$config['upload_path'] = './assets/foto_produk/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 2000;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto'))
			{
				$foto = "";
				throw new Exception($this->upload->display_errors());
			}
			else
			{
				$foto = $this->upload->data("file_name");
			}

			$data = array(
				"nama_produk" => $this->input->post("nama_produk"),
				"foto" => $foto,
				"deskripsi" => $this->input->post("deskripsi"),
				"stok" => $this->input->post("stok")
			);
			$this->ModelProduk->insert($data);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil ditambah");
			redirect("produk");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("produk");
		}
	}

	public function update()
	{
		$id = $this->input->post("id");

		$this->db->trans_begin();
		try {
			$config['upload_path'] = './assets/foto_produk/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 2000;
			$this->load->library('upload', $config);
			if ($_FILES['foto']['name'] != "") {
				if (!$this->upload->do_upload('foto'))
				{
					throw new Exception($this->upload->display_errors());
				}
				else
				{
					$foto = $this->upload->data("file_name");
					unlink('./assets/foto_produk/'.$this->input->post("foto_old"));
				}
			} else {
				$foto = $this->input->post("foto_old");
			}


			$data = array(
				"nama_produk" => $this->input->post("nama_produk"),
				"foto" => $foto,
				"deskripsi" => $this->input->post("deskripsi"),
				"stok" => $this->input->post("stok")
			);
			$this->ModelProduk->update($data, $id);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil diubah");
			redirect("produk");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("produk");
		}
	}

	public function delete($id)
	{
		$this->db->trans_begin();
		try {
			$this->ModelProduk->delete($id);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil dihapus");
			redirect("produk");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("produk");
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
