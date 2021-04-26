<?php $this->load->view('header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">User</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
						<li class="breadcrumb-item active">User</li>
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
							<h3 class="card-title">Data User</h3>
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
									<th>Nama</th>
									<th>Username</th>
									<th>Role</th>
									<th>Foto</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php $no = 1; foreach ($user as $i) {?>
								<tr>
									<td><?=$no++?></td>
									<td><?=$i->nama?></td>
									<td><?=$i->username?></td>
									<td><?=$i->role?></td>
									<td><img width="50" height="50" src="<?=base_url('assets/foto_user/').$i->foto?>"></td>
									<td>
										<?php if ($i->role != "admin") { ?>
											<button class="btn btn-primary btn-sm" onclick="edit(<?=$i->id?>)">
												<i class="fas fa-edit"></i>
											</button>
											<button class="btn btn-warning btn-sm" onclick="change_password(<?=$i->id?>)">
												<i class="fas fa-lock-open"></i>
											</button>
											<a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"
											   href="<?=site_url('user/delete/'.$i->id)?>">
												<i class="fas fa-trash"></i>
											</a>
										<?php } ?>
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
					<h4 class="modal-title">Tambah User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_produk" action="<?=site_url('user/tambah')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" id="id" name="id">
					<div class="modal-body">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="role">Role</label>
							<select class="form-control select2" style="width: 100%;" id="role" name="role"  required>
								<option value="">-- Pilih Role --</option>
								<option value="pemilik">Pemilik</option>
								<option value="penjualan">Admin Penjualan</option>
								<option value="produksi">Admin Produksi</option>
							</select>
						</div>
						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" id="foto" name="foto" placeholder="Foto">
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
					<h4 class="modal-title">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_produk" action="<?=site_url('user/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" id="edit-id" name="id">
					<input type="hidden" id="edit-foto-old" name="foto_old">
					<div class="modal-body">
						<div class="form-group">
							<label for="edit-nama">Nama</label>
							<input type="text" class="form-control" id="edit-nama" name="nama" placeholder="Nama" required>
						</div>
						<div class="form-group">
							<label for="edit-username">Username</label>
							<input type="text" class="form-control" id="edit-username" name="username" placeholder="Username" required>
						</div>
						<div class="form-group">
							<label for="edit-role">Role</label>
							<select class="form-control select2" style="width: 100%;" id="edit-role" name="role"  required>
								<option value="">-- Pilih Role --</option>
								<option value="pemilik">Pemilik</option>
								<option value="penjualan">Admin Penjualan</option>
								<option value="produksi">Admin Produksi</option>
							</select>
						</div>
						<div class="form-group">
							<label for="edit-foto">Foto</label>
							<input type="file" class="form-control" id="edit-foto" name="foto" placeholder="Foto produk">
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

	<div class="modal fade" id="modal-change-password">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ubah Password</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_produk" action="<?=site_url('user/change_password')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" id="change-password-id" name="id">
					<div class="modal-body">
						<div class="form-group">
							<label for="password">Password Baru</label>
							<input type="password" class="form-control" name="password" placeholder="Password" required>
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
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
<script>
	function edit(id) {
		$.ajax({
			url: "<?php echo base_url(); ?>user/get_detail/"+id,
			type: 'GET',
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				console.log(data);
				$("#edit-id").val(data.id);
				$("#edit-nama").val(data.nama);
				$("#edit-username").val(data.username);
				$("#edit-foto-old").val(data.foto);
				$("#edit-role").val(data.role).change();
				$("#modal-edit").modal("show");
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}

	function change_password(id) {
		$.ajax({
			url: "<?php echo base_url(); ?>user/get_detail/"+id,
			type: 'GET',
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				console.log(data);
				$("#change-password-id").val(data.id);
				$("#modal-change-password").modal("show");
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("NO");
			}
		});
	}
</script>
