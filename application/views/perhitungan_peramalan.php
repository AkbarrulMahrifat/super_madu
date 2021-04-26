<?php $this->load->view('header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Peramalan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?=site_url('peramalan')?>">Peramalan</a></li>
						<li class="breadcrumb-item active">Hasil Perhitungan</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Hasil Perhitungan</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<p>
								Hasil Perhitungan <b><?=$produk->nama_produk?></b>
								periode <b><?=date("M Y", strtotime($periode[count($periode)-1]))?></b>
								Menggunakan Metode <b><i>Double Exponential Smoothing</i></b>
								adalah sebagai berikut :
							</p>
							<dl>
								<dt>Alpha dengan tingkat error terkecil</dt>
								<dd><?=$index_mape_terkecil?></dd>
								<dt>Hasil Prediksi</dt>
								<dd><?=round($ftm[$index_mape_terkecil][count($periode)-1], 6)?></dd>
								<dt>MAPE</dt>
								<dd><?=round($mape[$index_mape_terkecil], 6)?></dd>
							</dl>

							<div id="accordion">
								<?php foreach ($alpha as $key => $a) { ?>
									<div class="card card-primary">
										<div class="card-header">
											<h4 class="card-title w-100">
												<a class="d-block w-100" data-toggle="collapse" href="#collapse<?=$key?>">
													Detail Perhitungan Alpha <?=$a?>
												</a>
											</h4>
										</div>
										<div id="collapse<?=$key?>" class="collapse" data-parent="#accordion">
											<div class="card-body">
												<table class="table table-bordered table-hover">
													<thead>
													<tr>
														<th>Periode</th>
														<th>Penjualan</th>
														<th>S't</th>
														<th>S"t</th>
														<th>at</th>
														<th>bt</th>
														<th>Prediksi (Ftm)</th>
														<th>PE</th>
													</tr>
													</thead>
													<tbody>
													<?php $no = 1; foreach ($periode as $key2 => $p) {?>
														<tr>
															<td><?=date("M Y", strtotime($p))?></td>
															<td><?=$aktual[$key2]?></td>
															<td><?=round($s_aksen_t[$a][$key2], 6)?></td>
															<td><?=round($s_dua_aksen_t[$a][$key2], 6)?></td>
															<td><?=round($a_t[$a][$key2], 6)?></td>
															<td><?=round($b_t[$a][$key2], 6)?></td>
															<td><?=round($ftm[$a][$key2], 6)?></td>
															<td><?=round($pe[$a][$key2], 6)?></td>
														</tr>
													<?php } ?>
													</tbody>
													<tfoot>
														<tr>
															<td colspan="7" style="text-align:right">MAPE</td>
															<td><?=round($mape[$a], 6)?></td>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
<script>
	function edit(id) {
		$.ajax({
			url: "<?php echo base_url(); ?>produk/get_detail/"+id,
			// data: {"id_truck":json_truck[i].id_truck},
			type: 'GET',
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				console.log(data);
				$("#edit-id").val(data.id);
				$("#edit-nama_produk").val(data.nama_produk);
				$("#edit-deskripsi").val(data.deskripsi);
				$("#edit-foto-old").val(data.foto);
				$("#edit-stok").val(data.stok);
				$("#modal-edit").modal("show");
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}
</script>
