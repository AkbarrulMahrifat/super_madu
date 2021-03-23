<?php


class ModelProduk extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('produk', $data);
	}

	public function update($data, $id)
	{
		$this->db->where("id", $id);
		return $this->db->update('produk', $data);
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete('produk');
	}

	public function get_all()
	{
		return $this->db->get("produk");
	}

	public function get_detail($id)
	{
		$this->db->where("id", $id);
		return $this->db->get("produk");
	}
}
