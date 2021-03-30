<?php


class ModelPenjualan extends CI_Model
{
	public function insert_header($data)
	{
		$this->db->insert('penjualan', $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	public function insert_item($data)
	{
		return $this->db->insert_batch('penjualan_detail', $data);
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete('penjualan');
	}

	public function get_all()
	{
		$this->db->select("penjualan.*, user.nama");
		$this->db->join("user", "penjualan.user_id = user.id");
		return $this->db->get("penjualan");
	}

	public function get_detail($id)
	{
		$this->db->select("penjualan.*, user.nama");
		$this->db->join("user", "penjualan.user_id = user.id");
		$this->db->where("penjualan.id", $id);
		return $this->db->get("penjualan");
	}

	public function get_detail_item($id)
	{
		$this->db->select("penjualan_detail.*, produk.nama_produk");
		$this->db->join("produk", "penjualan_detail.produk_id = produk.id");
		$this->db->where("penjualan_id", $id);
		return $this->db->get("penjualan_detail");
	}
}
