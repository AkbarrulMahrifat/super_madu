<?php $this->load->view('header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Bahan Baku</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
						<li class="breadcrumb-item active">Bahan Baku</li>
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
							<h3 class="card-title">Data Bahan Baku</h3>
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
									<th>Stok (gr)</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php $no = 1; foreach ($bahan_baku as $p) {?>
								<tr>
									<td><?=$no++?></td>
									<td><?=$p->nama_bahan_baku?></td>
									<td><?=$p->stok?></td>
									<td>
										<button class="btn btn-primary btn-sm" onclick="edit(<?=$p->id?>)">
											<i class="fas fa-edit"></i>
										</button>
										<a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"
										   href="<?=site_url('bahanbaku/delete/'.$p->id)?>">
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
					<h4 class="modal-title">Tambah Bahan Baku</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_produk" action="<?=site_url('bahanbaku/tambah')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" id="id" name="id">
					<div class="modal-body">
						<div class="form-group">
							<label for="nama_bahan_baku">Nama Bahan Baku</label>
							<input type="text" class="form-control" id="nama_bahan_baku" name="nama_bahan_baku" placeholder="Nama bahan baku" required>
						</div>
						<div class="form-group">
							<label for="stok">Stok (gr)</label>
							<input type="number" class="form-control" id="stok" name="stok" placeholder="Stok bahan baku" min="1" required>
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
					<h4 class="modal-title">Edit Bahan Baku</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_edit_produk" action="<?=site_url('bahanbaku/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" id="edit-id" name="id">
					<div class="modal-body">
						<div class="form-group">
							<label for="edit-nama_bahan_baku">Nama Bahan Baku</label>
							<input type="text" class="form-control" id="edit-nama_bahan_baku" name="nama_bahan_baku" placeholder="Nama bahan baku" required>
						</div>
						<div class="form-group">
							<label for="edit-stok">Stok (gr)</label>
							<input type="number" class="form-control" id="edit-stok" name="stok" placeholder="Stok bahan baku" min="1" required>
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
			url: "<?php echo base_url(); ?>bahanbaku/get_detail/"+id,
			// data: {"id_truck":json_truck[i].id_truck},
			type: 'GET',
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				console.log(data);
				$("#edit-id").val(data.id);
				$("#edit-nama_bahan_baku").val(data.nama_bahan_baku);
				$("#edit-stok").val(data.stok);
				$("#modal-edit").modal("show");
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}
</script>
