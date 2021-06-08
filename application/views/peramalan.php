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
						<li class="breadcrumb-item active">Peramalan</li>
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
							<h3 class="card-title">Perhitungan Metode</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
<!--							<div class="row">-->
								<form class="row" method="get" action="<?=site_url('peramalan/perhitungan_metode')?>">
									<div class="form-group col-sm-4">
										<label for="produk_id">Produk</label>
										<select class="form-control select2" style="width: 100%;" id="produk_id" name="produk_id" required>
											<option value="">-- Pilih Produk --</option>
											<?php foreach ($produk as $p) { ?>
												<option value="<?=$p->id?>"><?=$p->nama_produk?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-sm-4">
										<label for="tanggal_peramalan">Periode Peramalan</label>
										<div class="input-group" id="tanggal">
											<input data-date-container='#tanggal' type="text" class="form-control month1" id="tanggal_peramalan" name="tanggal_peramalan" required/>
										</div>
									</div>

									<div class="form-group col-sm-4">
										<label class="text-light">Submit</label>
										<div class="input-group">
											<button class="btn btn-primary" type="submit">Submit</button>
										</div>
									</div>
								</form>
<!--							</div>-->
						<!-- /.card-body -->
						</div>
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->

		<div class="container-fluid">
			<!-- BAR CHART -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Grafik Hasil Perhitungan Sistem dan Manual</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
						</button>
						<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group row col-sm-6">
						<label for="peramalan_produk_id" class="col-sm-2 col-form-label">Produk</label>
						<div class="col-sm-10">
							<select class="form-control select2" style="width: 100%;" id="peramalan_produk_id" name="produk_id" onchange="grafikPeramalan()" required>
								<?php foreach ($produk as $p) { ?>
									<option value="<?=$p->id?>"><?=$p->nama_produk?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="chart" id="containerGrafikPeramalan">
						<canvas id="grafikPeramalan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
					</div>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
<script>
	$( document ).ready(function() {
		grafikPeramalan();
	});

	function grafikPeramalan() {
		//reset canvas
		var containerGrafikPeramalan = document.getElementById('containerGrafikPeramalan');
		containerGrafikPeramalan.innerHTML = '&nbsp;';
		$('#containerGrafikPeramalan').append('<canvas id="grafikPeramalan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');

		var produk_id = $("#peramalan_produk_id").val()
		$.ajax({
			url: "<?php echo base_url(); ?>peramalan/get_grafik/"+produk_id,
			type: 'GET',
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				console.log(data);
				var grafikPeramalanData = {
					labels  : data.periode,
					datasets: [
						{
							label               : 'Hasil Penjualan',
							borderColor         : 'rgb(65, 105, 225)',
							fill         		: false,
							pointColor          : '#3b8bba',
							data                : data.penjualan
						},
						{
							label               : 'Hasil Peramalan',
							borderColor         : 'rgb(220, 20, 60)',
							fill         		: false,
							pointColor          : 'rgba(210, 214, 222, 1)',
							data                : data.peramalan
						},
					]
				}
				//-------------
				//- BAR CHART -
				//-------------
				var grafikPeramalanCanvas = $('#grafikPeramalan').get(0).getContext('2d')
				var grafikPeramalanData = $.extend(true, {}, grafikPeramalanData)
				var temp0 = grafikPeramalanData.datasets[0]
				var temp1 = grafikPeramalanData.datasets[1]
				grafikPeramalanData.datasets[0] = temp1
				grafikPeramalanData.datasets[1] = temp0

				var grafikPeramalanOptions = {
					responsive			: true,
					maintainAspectRatio	: false,
					datasetFill			: false,
					scales				: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
				}

				var grafikPeramalan = new Chart(grafikPeramalanCanvas, {
					type: 'line',
					data: grafikPeramalanData,
					options: grafikPeramalanOptions,
					tension: 0.1
				})
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}
</script>
