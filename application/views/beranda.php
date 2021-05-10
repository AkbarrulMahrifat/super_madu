<?php $this->load->view('header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Beranda</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
						<li class="breadcrumb-item active">Beranda</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Grafik Penjualan Per Bulan</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
						</button>
						<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
					</div>
				</div>
				<div class="card-body">
					<div class="chart">
						<canvas id="grafikPenjualan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
					</div>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div><!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>

<script>
	$( document ).ready(function() {
		grafikPenjualan();
	});
	function grafikPenjualan() {
		$.ajax({
			url: "<?php echo base_url(); ?>penjualan/get_grafik",
			type: 'GET',
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				console.log(data);
				var dynamicColors = function() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);
					return "rgb(" + r + "," + g + "," + b + ")";
				}

				var penjualan = data.penjualan;
				var set_data = [];
				for (var i=0; i<penjualan.length; i++) {
					var index_warna = i.toString().substring(0, 1);
					set_data[i] = {
						label		: penjualan[i].nama_produk,
						borderColor	: warna[index_warna],
						pointColor	: '#3b8bba',
						fill		: false,
						data		: penjualan[i].data_penjualan
					}
				}

				var grafikPenjualanData = {
					labels  : data.periode,
					datasets: set_data
				}
				//-------------
				//- BAR CHART -
				//-------------
				var grafikPenjualanCanvas = $('#grafikPenjualan').get(0).getContext('2d')
				var grafikPenjualanData = $.extend(true, {}, grafikPenjualanData)
				var temp0 = grafikPenjualanData.datasets[0]
				var temp1 = grafikPenjualanData.datasets[1]
				grafikPenjualanData.datasets[0] = temp1
				grafikPenjualanData.datasets[1] = temp0

				var grafikPenjualanOptions = {
					responsive              : true,
					maintainAspectRatio     : false,
					datasetFill             : false
				}

				var grafikPenjualan = new Chart(grafikPenjualanCanvas, {
					type: 'line',
					data: grafikPenjualanData,
					options: grafikPenjualanOptions,
					tension: 0.1
				})
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}
</script>
