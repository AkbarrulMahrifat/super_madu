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
		$this->db->select("produk.*, bahan_baku.nama_bahan_baku");
		$this->db->join('bahan_baku', 'produk.bahan_baku_id=bahan_baku.id', 'left');
		return $this->db->get("produk");
	}

	public function get_detail($id)
	{
		$this->db->where("id", $id);
		return $this->db->get("produk");
	}
}
