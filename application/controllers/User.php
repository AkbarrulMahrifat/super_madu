<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelUser');
	}

	public function index()
	{
		$data["user"] = $this->ModelUser->get_all()->result();
		$this->load->view('user', $data);
	}

	public function edit_profile()
	{
		$data["user"] = $this->ModelUser->get_detail($this->session->userdata("id"))->first_row();

		$this->load->view('edit_profile', $data);
	}

	public function get_detail($id)
	{
		$data = array();
		$this->db->trans_begin();
		try {
			$data = $this->ModelUser->get_detail($id)->first_row();
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
			$config['upload_path'] = './assets/foto_user/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 2000;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto'))
			{
				$foto = null;
			}
			else
			{
				$foto = $this->upload->data("file_name");
			}

			$data = array(
				"nama" => $this->input->post("nama"),
				"username" => $this->input->post("username"),
				"password" => hash('sha512', $this->input->post('password')),
				"role" => $this->input->post("role"),
				"foto" => $foto,
			);

			$this->ModelUser->insert($data);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil ditambah");
			redirect("user");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("user");
		}
	}

	public function update()
	{
		$id = $this->input->post("id");

		$this->db->trans_begin();
		try {
			$config['upload_path'] = './assets/foto_user/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 2000;
			$this->load->library('upload', $config);
			if ($_FILES['foto']['name'] != "") {
				if (!$this->upload->do_upload('foto'))
				{
					$foto = "";
				}
				else
				{
					$foto = $this->upload->data("file_name");
					unlink('./assets/foto_user/'.$this->input->post("foto_old"));
				}
			} else {
				$foto = $this->input->post("foto_old");
			}

			$data = array(
				"nama" => $this->input->post("nama"),
				"username" => $this->input->post("username"),
				"role" => $this->input->post("role"),
				"foto" => $foto,
			);
			$this->ModelUser->update($data, $id);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil diubah");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
		}

		$referer = explode("/", str_replace(base_url(),'',$_SERVER['HTTP_REFERER']));
		if (in_array("edit_profile", $referer)) {
			redirect("user/edit_profile");
		} else {
			redirect("user");
		}
	}

	public function change_password()
	{
		$id = $this->input->post("id");

		$this->db->trans_begin();
		try {
			$data = array(
				"password" => hash('sha512', $this->input->post('password')),
			);
			$this->ModelUser->update($data, $id);
			$this->db->trans_commit();
			$this->notification->success("Password berhasil diubah");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
		}

		$referer = explode("/", str_replace(base_url(),'',$_SERVER['HTTP_REFERER']));
		if (in_array("edit_profile", $referer)) {
			redirect("user/edit_profile");
		} else {
			redirect("user");
		}
	}

	public function delete($id)
	{
		$this->db->trans_begin();
		try {
			$this->ModelUser->delete($id);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil dihapus");
			redirect("user");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("user");
		}
	}
}
