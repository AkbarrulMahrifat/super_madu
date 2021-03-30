<?php $this->load->view('header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Penjualan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
						<li class="breadcrumb-item active">Penjualan</li>
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
							<h3 class="card-title">Data Penjualan</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<a href="<?=site_url('penjualan/tambah_penjualan')?>" class="btn btn-success btn-sm float-right">
								Tambah
							</a>

							<table id="dataTable" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th>#</th>
									<th>Nomor Pesanan</th>
									<th>Tanggal Pesanan</th>
									<th>Dibuat Oleh</th>
									<th>Total Pesanan</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php $no = 1; foreach ($penjualan as $p) {?>
								<tr>
									<td><?=$no++?></td>
									<td><?=$p->nomor_pesanan?></td>
									<td><?=$p->tanggal?></td>
									<td><?=$p->nama?></td>
									<td>Rp. <?=$p->total?></td>
									<td>
										<button class="btn btn-info btn-sm" onclick="detail(<?=$p->id?>)">
											<i class="fas fa-eye"></i>
										</button>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"
										   href="<?=site_url('penjualan/delete/'.$p->id)?>">
											<i class="fas fa-trash"></i>
										</a>
									</td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
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

	<!-- modal -->
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Detail Pesanan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
					<div class="modal-body">
							<div class="p-3 mb-3">
								<!-- title row -->
								<div class="row">
									<div class="col-12">
										<h4>
											<i class="fas fa-globe"></i> Sumber Madu
											<small class="float-right">Kasir: <?=$this->session->userdata("nama")?></small>
										</h4>
									</div>
									<!-- /.col -->
								</div>
								<br>
								<!-- info row -->
								<div class="row invoice-info">
									<div class="col-sm-4 invoice-col">
										Nomor Pesanan :
										<br>
										<strong id="nomor_pesanan"></strong>
									</div>
									<!-- /.col -->
									<div class="col-sm-4 invoice-col">
										Tanggal Pesanan :
										<br>
										<strong id="tanggal"></strong>
									</div>
									<!-- /.col -->
								</div>
								<!-- /.row -->

								<!-- Table row -->
								<div class="row mt-4">
									<div class="col-12 table-responsive">
										<table class="table table-striped">
											<thead>
											<tr>
												<th>Produk</th>
												<th>Harga</th>
												<th>Qty</th>
												<th>Subtotal</th>
											</tr>
											</thead>
											<tbody id="item">
											</tbody>
										</table>
									</div>
									<!-- /.col -->
								</div>
								<!-- /.row -->

								<div class="row">
									<!-- accepted payments column -->
									<div class="col-6">
										<p class="text-light well well-sm shadow-none" style="margin-top: 10px;">
											Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
											plugg
											dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
										</p>
									</div>
									<!-- /.col -->
									<div class="col-6">
										<div class="table-responsive">
											<table class="table">
												<tr>
													<th colspan="3" style="text-align: right">Total :</th>
													<td id="total"></td>
												</tr>
												<tr>
													<th colspan="3" style="text-align: right">Bayar :</th>
													<td id="bayar"></td>
												</tr>
												<tr>
													<th colspan="3" style="text-align: right">Kembali :</th>
													<td id="kembali"></td>
												</tr>
											</table class="table">
										</div>
									</div>
									<!-- /.col -->
								</div>
								<!-- /.row -->
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
					</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
<script>
	function detail(id) {
		$.ajax({
			url: "<?php echo base_url(); ?>penjualan/get_detail/"+id,
			type: 'GET',
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				console.log(data);
				item = data.item;
				$("#nomor_pesanan").html(data.nomor_pesanan);
				$("#tanggal").html(data.tanggal);
				$("#kasir").html(data.nama);
				$("#total").html("Rp. " + data.total);
				$("#bayar").html("Rp. " + data.bayar);
				$("#kembali").html("Rp. " + data.kembali);

				item_pesanan = "";
				for (i = 0; i < item.length; i++) {
					subtotal = item[i].jumlah * item[i].harga;
					item_pesanan += '<tr>' +
							"<td>"+ item[i].nama_produk +"</td>" +
							"<td>Rp. "+ item[i].harga +"</td>" +
							"<td>"+ item[i].jumlah +"</td>" +
							"<td>"+ subtotal +"</td>" +
							"</tr>";
				}
				$('#item').html(item_pesanan);
				$("#modal-default").modal("show");
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}
</script>
