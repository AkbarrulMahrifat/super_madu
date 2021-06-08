<?php


class Beranda extends CI_Controller
{
	function __construct(){
		parent::__construct();

		$this->load->model('ModelUser');
		$this->load->model('ModelProduk');
		$this->load->model('ModelPenjualan');
		$this->load->model('ModelPeramalan');
	}

	public function index()
	{
		$data["rekomendasi"] = $this->get_rekomendasi();
		$this->load->view('beranda', $data);
	}

	public function about()
	{
		$this->load->view('about');
	}

	function get_rekomendasi()
	{
		$produk = $this->ModelProduk->get_all()->result();
		$data = array();
		foreach ($produk as $key_p => $p) {
			$data[$key_p]["nama_produk"] = $p->nama_produk;
			$data[$key_p]["nama_bahan_baku"] = $p->nama_bahan_baku;
			$data[$key_p]["periode"] = "-";
			$data[$key_p]["rekomendasi"] = "-";
			$data[$key_p]["rekomendasi_bb"] = "-";

			$produk_id = $p->id;
			$first_data_penjualan = $this->ModelPenjualan->get_all()->first_row();
			$last_data_penjualan = $this->db->join("penjualan_detail", "penjualan_detail.penjualan_id = penjualan.id")
				->where("produk_id", $produk_id)
				->order_by("tanggal", "DESC")
				->get("penjualan")
				->first_row();
			if (!empty($first_data_penjualan) && !empty($last_data_penjualan)) {
				$periode_awal = date('Y-m', strtotime($first_data_penjualan->tanggal));
				$periode_peramalan = date("Y-m", strtotime($last_data_penjualan->tanggal . "+1 months"));
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

				$rekomendasi = round($ftm[$index_mape_terkecil][count($data_periode)-1]);
				$rekomendasi_bb = $rekomendasi * $p->takaran_resep;
				$data[$key_p]["periode"] = $periode_peramalan;
				$data[$key_p]["rekomendasi"] = $rekomendasi;
				$data[$key_p]["rekomendasi_bb"] = $rekomendasi_bb;
			}
		}

		return $data;
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
