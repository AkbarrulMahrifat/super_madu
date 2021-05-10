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
		$this->db->order_by("tanggal", "asc");
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

	public function get_peramalan_per_bulan() {
		$this->db->select("produk_id, nama_produk, sum(jumlah) as jumlah, DATE_FORMAT(tanggal,'%Y-%m') as periode");
		$this->db->from('penjualan_detail');
		$this->db->join('penjualan', 'penjualan_detail.penjualan_id=penjualan.id', 'left');
		$this->db->join('produk', 'penjualan_detail.produk_id=produk.id', 'left');
		$this->db->group_by('MONTH(tanggal), YEAR(tanggal)');
		$this->db->group_by('produk_id');
		$this->db->order_by('produk_id', 'ASC');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get();
	}
}
