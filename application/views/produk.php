<?php $this->load->view('header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Produk</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
						<li class="breadcrumb-item active">Produk</li>
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
							<h3 class="card-title">Data Produk</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modal-default">
								Tambah
							</button>

							<table id="dataTable" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th>ID</th>
									<th>Nama Produk</th>
									<th>Foto Produk</th>
									<th>Deskripsi</th>
									<th>Harga</th>
									<th>Stok</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php $no = 1; foreach ($produk as $p) {?>
								<tr>
									<td><?=$no++?></td>
									<td><?=$p->nama_produk?></td>
									<td><img width="50" height="50" src="<?=base_url('assets/foto_produk/').$p->foto?>"></td>
									<td><?=$p->deskripsi?></td>
									<td><?=$p->harga?></td>
									<td><?=$p->stok?></td>
									<td>
										<button class="btn btn-success btn-sm" onclick="tambah_stok(<?=$p->id?>)">
											<i class="fas fa-plus"></i>
										</button>
										<button class="btn btn-primary btn-sm" onclick="edit(<?=$p->id?>)">
											<i class="fas fa-edit"></i>
										</button>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"
										   href="<?=site_url('produk/delete/'.$p->id)?>">
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
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Produk</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_produk" action="<?=site_url('produk/tambah')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" id="id" name="id">
					<div class="modal-body">
						<div class="form-group">
							<label for="nama_produk">Nama Produk</label>
							<input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama produk" required>
						</div>
						<div class="form-group">
							<label for="deskripsi">Deskripsi</label>
							<textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi produk"></textarea>
						</div>
						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" id="foto" name="foto" placeholder="Foto produk">
						</div>
						<div class="form-group">
							<label for="harga">Harga</label>
							<input type="number" class="form-control" id="harga" name="harga" placeholder="Harga produk" min="1" required>
						</div>
						<div class="form-group">
							<label for="stok">Stok</label>
							<input type="number" class="form-control" id="stok" name="stok" placeholder="Stok produk" min="1" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<div class="modal fade" id="modal-edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Produk</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_produk" action="<?=site_url('produk/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" id="edit-id" name="id">
					<input type="hidden" id="edit-foto-old" name="foto_old">
					<div class="modal-body">
						<div class="form-group">
							<label for="edit-nama_produk">Nama Produk</label>
							<input type="text" class="form-control" id="edit-nama_produk" name="nama_produk" placeholder="Nama produk" required>
						</div>
						<div class="form-group">
							<label for="edit-deskripsi">Deskripsi</label>
							<textarea type="text" class="form-control" id="edit-deskripsi" name="deskripsi" placeholder="Deskripsi produk"></textarea>
						</div>
						<div class="form-group">
							<label for="edit-foto">Foto</label>
							<input type="file" class="form-control" id="edit-foto" name="foto" placeholder="Foto produk">
						</div>
						<div class="form-group">
							<label for="edit-harga">Harga</label>
							<input type="number" class="form-control" id="edit-harga" name="harga" placeholder="Harga produk" min="1" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<div class="modal fade" id="modal-tambahstok">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Stok</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_update_stok" action="<?=site_url('produk/update_stok')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" id="stok-id" name="id">
					<div class="modal-body">
						<div class="form-group">
							<label for="stok-nama_produk">Nama Produk</label>
							<input type="text" class="form-control" id="stok-nama_produk" name="nama_produk" placeholder="Nama produk" readonly>
						</div>
						<div class="form-group">
							<label for="stok-stok">Stok</label>
							<input type="hidden" id="stok-stok_lama" name="stok_lama" readonly>
							<input type="number" class="form-control" id="stok-stok" name="stok" placeholder="Stok" min="1" readonly>
						</div>
						<div class="form-group">
							<label for="stok-input_stok">Input Stok Tambahan</label>
							<input type="number" class="form-control" id="stok-input_stok" name="input_stok" placeholder="Input Stok Tambahan" min="1" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
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
				$("#edit-harga").val(data.harga);
				$("#modal-edit").modal("show");
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}

	$('#stok-input_stok').on('input',function(e){
		var stok = $("#stok-stok_lama").val();
		var input_stok = $("#stok-input_stok").val();
		if (isNaN(input_stok) || input_stok === "") {
			input_stok = 0;
		}

		$("#stok-stok").val(parseInt(stok) + parseInt(input_stok));
	});

	function tambah_stok(id) {
		$.ajax({
			url: "<?php echo base_url(); ?>produk/get_detail/"+id,
			// data: {"id_truck":json_truck[i].id_truck},
			type: 'GET',
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				console.log(data);
				$("#stok-id").val(data.id);
				$("#stok-nama_produk").val(data.nama_produk);
				$("#stok-stok_lama").val(data.stok);
				$("#stok-stok").val(data.stok);
				$("#modal-tambahstok").modal("show");
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}
</script>
