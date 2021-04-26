<?php


class ModelUser extends CI_Model
{
	public function cek_login($u, $p)
	{
		$this->db->from('user');
		$this->db->where('username',$u);
		$this->db->where('password',$p);
		$a = $this->db->get();
		if($a->num_rows() == 1){
			$data = $a->result_array();
			$this->session->set_userdata('id', $data[0]['id']);
			$this->session->set_userdata('username', $data[0]['username']);
			$this->session->set_userdata('nama', $data[0]['nama']);
			$this->session->set_userdata('foto', $data[0]['foto']);
			$this->session->set_userdata('role', $data[0]['role']);
			return true;
		}
		else{
			return false;
		}
	}

	public function get_all()
	{
		return $this->db->get("user");
	}

	public function get_detail($id)
	{
		$this->db->where("id", $id);
		return $this->db->get("user");
	}

	public function insert($data)
	{
		return $this->db->insert('user', $data);
	}

	public function update($data, $id)
	{
		$this->db->where("id", $id);
		return $this->db->update('user', $data);
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete('user');
	}
}
