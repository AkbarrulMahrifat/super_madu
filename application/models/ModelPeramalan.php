<?php


class ModelPeramalan extends CI_Model
{
	public function get_data_penjualan($periode, $produk_id) {
		$this->db->select("sum(jumlah) as jumlah, DATE_FORMAT(tanggal,'%Y-%m') as periode");
		$this->db->from('penjualan_detail');
		$this->db->join('penjualan', 'penjualan_detail.penjualan_id=penjualan.id', 'left');
		$this->db->join('produk', 'penjualan_detail.produk_id=produk.id', 'left');
		$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $periode);
		$this->db->where('produk_id', $produk_id);
		$this->db->group_by('MONTH(tanggal), YEAR(tanggal)');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get();
	}

	public function cek_peramalan($periode, $produk_id) {
		$this->db->select("*");
		$this->db->from('peramalan');
		$this->db->where("periode", $periode);
		$this->db->where('produk_id', $produk_id);
		return $this->db->get();
	}

	public function get_peramalan_per_produk($produk_id) {
		$this->db->select("*");
		$this->db->from('peramalan');
		$this->db->where('produk_id', $produk_id);
		$this->db->order_by('periode', 'ASC');
		return $this->db->get();
	}

	public function insert($data)
	{
		return $this->db->insert('peramalan', $data);
	}

	public function update($data, $id)
	{
		$this->db->where("id", $id);
		return $this->db->update('peramalan', $data);
	}
}
