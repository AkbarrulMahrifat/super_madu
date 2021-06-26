<?php $this->load->view('header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Profile</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
						<li class="breadcrumb-item active">Edit Profile</li>
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
				<div class="col-md-3" style="min-height: 330px">
					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle"
									 src="<?=base_url()?>assets/foto_user/<?=$user->foto?>"
									 alt="User profile picture"
									 style="width: 90%">
							</div>

							<h3 class="profile-username text-center" style="font-size: 25px"><?=$user->nama?></h3>

							<p class="text-muted text-center" style="font-size: 20px"><?=ucfirst($user->role)?></p>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->

				<div class="col-md-9" style="min-height: 330px">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Update Profile</a></li>
								<li class="nav-item"><a class="nav-link" href="#change-password" data-toggle="tab">Ubah Password</a></li>
							</ul>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="settings">
									<form class="form-horizontal" action="<?=site_url('user/update')?>" method="post" enctype="multipart/form-data">
										<input type="hidden" name="id" value="<?=$user->id?>">
										<input type="hidden" name="foto_old" value="<?=$user->foto?>">
										<input type="hidden" name="role" value="<?=$user->role?>">
										<div class="form-group row">
											<label for="nama" class="col-sm-2 col-form-label">Nama</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?=$user->nama?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-sm-2 col-form-label">Username</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?=$user->username?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="foto" class="col-sm-2 col-form-label">Foto</label>
											<div class="col-sm-10">
												<input type="file" class="form-control" id="foto" name="foto" placeholder="Foto Profile">
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" class="btn btn-primary">Simpan</button>
											</div>
										</div>
									</form>
								</div>

								<div class="tab-pane" id="change-password">
									<form class="form-horizontal" action="<?=site_url('user/change_password')?>" method="post" enctype="multipart/form-data">
										<input type="hidden" name="id" value="<?=$user->id?>">
										<div class="form-group row">
											<label for="password" class="col-sm-2 col-form-label">Password Baru</label>
											<div class="col-sm-10">
												<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" class="btn btn-primary">Simpan</button>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->

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
