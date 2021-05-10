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
				<form action="<?=site_url('penjualan/tambah')?>" method="post">
					<div class="invoice p-3 mb-3">
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
								<input class="form-control" type="text" id="nomor_pesanan" name="nomor_pesanan" value="<?=$nomor?>" readonly>
							</div>
							<!-- /.col -->
							<div class="col-sm-4 invoice-col" id="date">
								Tanggal Pesanan :
								<br>
								<input data-date-container='#date' class="form-control datetimepicker" type="text" id="tanggal" name="tanggal" value="<?=date("Y-m-d H:i")?>" required>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<!-- Table row -->
						<div class="row">
							<div class="col-12 table-responsive">
								<button type="button" class="btn btn-primary btn-sm float-right mb-2" data-toggle="modal" data-target="#modal-default">
									Tambah Item
								</button>
								<table class="table table-striped">
									<thead>
									<tr>
										<th>Produk</th>
										<th>Harga</th>
										<th>Qty</th>
										<th>Subtotal</th>
										<th>Aksi</th>
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
											<td colspan="2"><input type="number" class="form-control" id="total" name="total" readonly></td>
										</tr>
										<tr>
											<th colspan="3" style="text-align: right">Bayar :</th>
											<td colspan="2"><input type="number" class="form-control" id="bayar" name="bayar" required></td>
										</tr>
										<tr>
											<th colspan="3" style="text-align: right">Kembali :</th>
											<td colspan="2"><input type="number" class="form-control" id="kembali" name="kembali" readonly></td>
										</tr>
									</table>
								</div>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<div id="form-item"></div>

						<!-- this row will not appear when printing -->
						<div class="row no-print">
							<div class="col-12">
								<a href="<?=site_url('penjualan')?>" class="btn btn-danger float-right text-light" style="margin-left: 5px;">
									<i class="fas fa-close"></i> Batalkan
								</a>
								<button type="submit" class="btn btn-success float-right">
									<i class="far fa-credit-card"></i> Submit
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->

	<!-- modal -->
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Item Pesanan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="produk">Produk</label>
						<select id="produk" class="form-control" required>
							<option value="">-- Pilih Produk --</option>
							<?php foreach ($produk as $key => $p) { ?>
								<option value="<?=$key?>"><?=$p->nama_produk?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="qty">Qty</label>
						<input type="number" class="form-control" id="qty" name="qty" placeholder="Jumlah pesanan" min="1" required>
					</div>
					<input type="hidden" class="form-control" id="produk_id" name="produk_id">
					<input type="hidden" class="form-control" id="produk_name" name="produk_name">
					<input type="hidden" class="form-control" id="harga" name="harga">
					<input type="hidden" class="form-control" id="stok" name="stok">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" onclick="set_item()">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
	$(function () {
		$('#datetimepicker4').datetimepicker();
	});
	var item = [];
	var produk = <?=json_encode($produk)?>;

	function set_item() {
		var qty = parseInt($("#qty").val());
		var stok = parseInt($("#stok").val());
		if (qty > stok) {
			alert("Qty tidak boleh melebihi " + stok);
			return false;
		}
		var item_tambah = {
			'produk_id': $("#produk_id").val(),
			'produk_name': $("#produk_name").val(),
			'qty': $("#qty").val(),
			'harga': $("#harga").val(),
		}
		item.push(item_tambah)
		set_item_pesanan()
		$("#modal-default").modal("hide");
	}

	function unset_item(i) {
		item.splice(i, 1)
		set_item_pesanan()
	}

	function set_item_pesanan() {
		var item_pesanan = "";
		var form_item_pesanan = "";
		var total = 0;
		var i
		for (i = 0; i < item.length; i++) {
			subtotal = item[i].qty * item[i].harga;
			total += subtotal;
			item_pesanan += '<tr>' +
					"<td>"+ item[i].produk_name +"</td>" +
					"<td>"+ item[i].harga +"</td>" +
					"<td>"+ item[i].qty +"</td>" +
					"<td>"+ subtotal +"</td>" +
					"<td>" +
					'<button class="btn btn-danger btn-sm" onclick="unset_item('+i+')"> ' +
					'<i class="fas fa-trash"></i> ' +
					"</button></td>" +
					"</tr>";
			form_item_pesanan += '<input type="hidden" name="produk_id['+i+']" value="'+ item[i].produk_id +'">' +
					'<input type="hidden" name="jumlah['+i+']" value="'+ item[i].qty +'">' +
					'<input type="hidden" name="harga['+i+']" value="'+ item[i].harga +'">';
		}

		$('#total').val(total);
		$('#item').html(item_pesanan);
		$('#form-item').html(form_item_pesanan);
	}

	$('#produk').on('change', function () {
		id = $('#produk').val()

		$("#produk_id").val(produk[id].id);
		$("#produk_name").val(produk[id].nama_produk);
		$("#harga").val(produk[id].harga);
		$("#stok").val(produk[id].stok);
		$("#qty").attr("max", parseInt(produk[id].stok));
	});

	$('#bayar').on('input', function () {
		total = $('#total').val()
		bayar = $('#bayar').val()

		kembali = bayar-total
		$("#kembali").val(kembali);
	});
</script>
