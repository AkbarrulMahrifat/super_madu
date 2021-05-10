<?php


class ModelBahanBaku extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('bahan_baku', $data);
	}

	public function update($data, $id)
	{
		$this->db->where("id", $id);
		return $this->db->update('bahan_baku', $data);
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete('bahan_baku');
	}

	public function get_all()
	{
		return $this->db->get("bahan_baku");
	}

	public function get_detail($id)
	{
		$this->db->where("id", $id);
		return $this->db->get("bahan_baku");
	}
}
