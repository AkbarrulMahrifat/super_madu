<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelProduk');
		$this->load->model('ModelPenjualan');
	}

	public function index()
	{
		$data["penjualan"] = $this->ModelPenjualan->get_all()->result();
		$this->load->view('penjualan', $data);
	}

	public function tambah_penjualan()
	{
		$data["produk"] = $this->ModelProduk->get_all()->result();
		$data["nomor"] = $this->generate_number();
		$this->load->view('tambah_penjualan', $data);
	}

	public function get_detail($id)
	{
		$data = array();
		$this->db->trans_begin();
		try {
			$data = $this->ModelPenjualan->get_detail($id)->first_row();
			$data->item = $this->ModelPenjualan->get_detail_item($id)->result();
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
			$nomor_pesanan = $this->input->post("nomor_pesanan");
			$cek_nomor_pesanan = $this->db->get_where('penjualan', array('nomor_pesanan' => $nomor_pesanan))->num_rows();
			if ($cek_nomor_pesanan > 0) {
				$nomor_pesanan = $this->generate_number();
			}

			$header = array(
				"nomor_pesanan" => $nomor_pesanan,
				"total" => $this->input->post("total"),
				"bayar" => $this->input->post("bayar"),
				"kembali" => $this->input->post("kembali"),
				"user_id" => $this->session->userdata("id"),
				"tanggal" => $this->input->post("tanggal")
			);
			$id = $this->ModelPenjualan->insert_header($header);

			$item = array();
			$produk_id = $this->input->post("produk_id");
			$jumlah = $this->input->post("jumlah");
			$harga = $this->input->post("harga");
			foreach ($produk_id as $key => $i) {
				$item[] = array(
					"penjualan_id" => $id,
					"produk_id" => $i,
					"jumlah" => $jumlah[$key],
					"harga" => $harga[$key],
				);
			}
			$this->ModelPenjualan->insert_item($item);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil ditambah");
			redirect("penjualan");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("penjualan");
		}
	}

	public function delete($id)
	{
		$this->db->trans_begin();
		try {
			$this->ModelProduk->delete($id);
			$this->db->trans_commit();
			$this->notification->success("Data berhasil dihapus");
			redirect("penjualan");
		}
		catch (\Exception $e) {
			$this->db->trans_rollback();
			$this->notification->error($e->getMessage());
			redirect("penjualan");
		}
	}

	function generate_number()
	{
		$last_number = $this->db->order_by("nomor_pesanan", "DESC")->get("penjualan")->first_row();
		if (!$last_number) {
			$number = "1";
		} else {
			$number = intval($last_number->nomor_pesanan) + 1;
		}

		return sprintf("%010d", $number);
	}

	public function get_grafik()
	{
		$penjualan = $this->ModelPenjualan->get_peramalan_per_bulan()->result();

		$data["penjualan"] = array();
		$data["periode"] = array();
		foreach ($penjualan as $key => $p) {
			$data_penjualan[$p->produk_id][] = $p->jumlah;
			$data["penjualan"][$p->produk_id] = array(
				"produk_id" => $p->produk_id,
				"nama_produk" => $p->nama_produk,
				"data_penjualan" => $data_penjualan[$p->produk_id],
			);
			$data["periode"][$p->periode] = date("M Y", strtotime($p->periode));
		}

		$data["penjualan"] = array_values($data["penjualan"]);
		$data["periode"] = array_values($data["periode"]);

		echo json_encode($data);
	}
}
