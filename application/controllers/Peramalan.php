<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peramalan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelProduk');
		$this->load->model('ModelPenjualan');
		$this->load->model('ModelPeramalan');
	}

	public function index()
	{
		$data["produk"] = $this->ModelProduk->get_all()->result();
		$this->load->view('peramalan', $data);
	}

	public function perhitungan_metode() {
		$periode_awal = $this->ModelPenjualan->get_all()->first_row();
		$periode_awal = date('Y-m', strtotime($periode_awal->tanggal));
		$periode_peramalan = date('Y-m', strtotime($this->input->get('tanggal_peramalan')));
		$produk_id = $this->input->get('produk_id');
		$produk = $this->ModelProduk->get_detail($produk_id)->first_row();
		$data_alpha = array('0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9');
		$data_periode = $this->get_periode($periode_awal, $periode_peramalan);

		//ambil data aktual
		$data_aktual = array();
		foreach ($data_periode as $key => $periode) {
			$penjualan = $this->ModelPeramalan->get_data_penjualan($periode, $produk_id)->row();
			if (!empty($penjualan)){
				$data_aktual[$key] = (int) $penjualan->jumlah;
			}else{
				$data_aktual[$key] = 0;
			}
		}

		//hitung peramalan
		foreach ($data_alpha as $alpha) {
			$total[$alpha] = 0;
			$mape[$alpha] = 0;
			$count_prediksi = 0;
			foreach ($data_aktual as $key => $aktual) {
				if ($key == 0) {
					$s_aksen_t[$alpha][$key] = $aktual;
					$s_dua_aksen_t[$alpha][$key] = $s_aksen_t[$alpha][$key];
					$a_t[$alpha][$key] = 0;
					$b_t[$alpha][$key] = 0;
					$ftm[$alpha][$key] = 0;
				} elseif ($aktual == 0) {
					$count_prediksi++;
					$aktual = $ftm[$alpha][$key-1];
					$s_aksen_t[$alpha][$key] = ($alpha * $aktual) + ((1 - $alpha) * $s_aksen_t[$alpha][$key-1]);
					$s_dua_aksen_t[$alpha][$key] = ($alpha * $s_aksen_t[$alpha][$key]) + ((1 - $alpha) * $s_dua_aksen_t[$alpha][$key-1]);
					$a_t[$alpha][$key] = (2 * $s_aksen_t[$alpha][$key]) - ($s_dua_aksen_t[$alpha][$key]);
					$b_t[$alpha][$key] = $alpha / (1 - $alpha) * ($s_aksen_t[$alpha][$key] - $s_dua_aksen_t[$alpha][$key]);
					$ftm[$alpha][$key] = $a_t[$alpha][$key-1] + $b_t[$alpha][$key-1];
				} else {
					$s_aksen_t[$alpha][$key] = ($alpha * $aktual) + ((1 - $alpha) * $s_aksen_t[$alpha][$key-1]);
					$s_dua_aksen_t[$alpha][$key] = ($alpha * $s_aksen_t[$alpha][$key]) + ((1 - $alpha) * $s_dua_aksen_t[$alpha][$key-1]);
					$a_t[$alpha][$key] = (2 * $s_aksen_t[$alpha][$key]) - ($s_dua_aksen_t[$alpha][$key]);
					$b_t[$alpha][$key] = $alpha / (1 - $alpha) * ($s_aksen_t[$alpha][$key] - $s_dua_aksen_t[$alpha][$key]);
					$ftm[$alpha][$key] = $a_t[$alpha][$key-1] + $b_t[$alpha][$key-1];
				}

				//hitung PE
				if ($key == 0 || $key == 1 || $aktual == 0) {
					$selisih[$alpha][$key] = 0;
					$pe[$alpha][$key] = 0;
				} else {
					$selisih[$alpha][$key] = ($aktual - $ftm[$alpha][$key]) / $aktual;
					$pe[$alpha][$key] = abs($selisih[$alpha][$key]);
				}
				$total[$alpha] += $pe[$alpha][$key];
			}
			$mape[$alpha] = ($total[$alpha] / ((count($data_periode)-2))) * 100;
		}

		//cari index MAPE terkecil
		$mape_terkecil = min($mape);
		$index_mape_terkecil = array_search($mape_terkecil, $mape);

		$data['produk'] = $produk;
		$data['alpha'] = $data_alpha;
		$data['periode'] = $data_periode;
		$data['aktual'] = $data_aktual;
		$data['s_aksen_t'] = $s_aksen_t;
		$data['s_dua_aksen_t'] = $s_dua_aksen_t;
		$data['a_t'] = $a_t;
		$data['b_t'] = $b_t;
		$data['ftm'] = $ftm;
		$data['selisih'] = $selisih;
		$data['pe'] = $pe;
		$data['mape'] = $mape;
		$data['index_mape_terkecil'] = $index_mape_terkecil;

		$this->load->view('perhitungan_peramalan', $data);
	}

	public function get_periode($periode_awal, $periode_peramalan)
	{
		//cari selisih bulan
		$timeStart = strtotime($periode_awal);
		$timeEnd = strtotime($periode_peramalan);
		// Menambah bulan ini + semua bulan pada tahun sebelumnya
		$months = (date("Y",$timeEnd)-date("Y",$timeStart))*12;
		// menghitung selisih bulan
		$months += date("m",$timeEnd)-date("m",$timeStart);

		//set periode
		$periode = array();
		for ($i = 0; $i <= $months; $i++)
		{
			$periode[] = date('Y-m', strtotime('+'.$i.' month', strtotime($periode_awal)));
		}

		return $periode;
	}
}
