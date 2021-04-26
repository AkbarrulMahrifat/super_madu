<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Super Madu | Log in</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/dist/css/adminlte.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition login-page" style="background-image: url(<?=base_url()?>'assets/template/dist/img/tape-aesthetic.jpg')">
<div class="login-box">
	<div class="login-logo">
		<a href="<?=base_url()?>"><b>Super</b> Madu</a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Sign in to start your session</p>

			<form action="<?=site_url('Login/login')?>" method="post">
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="username" placeholder="Username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control" name="password" placeholder="Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						<button type="submit" class="btn btn-primary btn-block">Sign in</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url()?>assets/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/template/dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="<?=base_url()?>assets/template/plugins/toastr/toastr.min.js"></script>

<script>
	//toastr function
	toastr.options.closeButton = true;
	<?php
	$notif = $this->session->tempdata();
	if (!empty($notif)) {
		if ($notif["type"] == "success") { ?>
		toastr.success('<?=$this->session->tempdata("message")?>', '<?=$this->session->tempdata("title")?>');
	<?php
		}
		else if ($notif["type"] == "error") { ?>
		toastr.error('<?=$this->session->tempdata("message")?>', '<?=$this->session->tempdata("title")?>');
	<?php
		}
	}
	?>
</script>

</body>
</html>
