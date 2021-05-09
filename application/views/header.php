<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Super Madu</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/fontawesome-free/css/all.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/toastr/toastr.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- daterange picker -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/daterangepicker/daterangepicker.css">
	<!--datetimepicker-->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/plugins/datepicker/css/bootstrap-datepicker.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
<!--				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i-->
<!--						class="fas fa-th-large"></i></a>-->
				<a class="nav-link" role="button" href="<?=site_url('Login/logout')?>">
					<i class="fas fa-sign-out-alt"></i> Logout
				</a>
			</li>
		</ul>
	</nav>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="<?=base_url()?>" class="brand-link">
			<img src="<?=base_url()?>assets/template/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">Super Madu</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="<?=base_url()?>assets/foto_user/<?=$this->session->userdata("foto")?>" class="img-circle elevation-2">
				</div>
				<div class="info">
					<a href="#" class="d-block"><?=$this->session->userdata("nama")?></a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="<?=site_url('beranda')?>" class="nav-link">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>
								Beranda
							</p>
						</a>
					</li>

					<?php if (
							$this->session->userdata("role") == "admin" || $this->session->userdata("role") == "pemilik"
					) { ?>
					<li class="nav-item">
						<a href="<?=site_url('user')?>" class="nav-link">
							<i class="nav-icon fas fa-user"></i>
							<p>
								User
							</p>
						</a>
					</li>
					<?php } ?>

					<?php if (
							$this->session->userdata("role") == "admin" ||
							$this->session->userdata("role") == "pemilik" ||
							$this->session->userdata("role") == "produksi"
					) { ?>
					<li class="nav-item">
						<a href="<?=site_url('produk')?>" class="nav-link">
							<i class="nav-icon fas fa-barcode"></i>
							<p>
								Produk
							</p>
						</a>
					</li>
					<?php } ?>

					<?php if (
					$this->session->userdata("role") == "admin" ||
					$this->session->userdata("role") == "pemilik" ||
					$this->session->userdata("role") == "penjualan"
					) { ?>
					<li class="nav-item">
						<a href="<?=site_url('penjualan')?>" class="nav-link">
							<i class="nav-icon fas fa-money-bill"></i>
							<p>
								Penjualan
							</p>
						</a>
					</li>
					<?php } ?>

					<?php if (
					$this->session->userdata("role") == "admin" ||
					$this->session->userdata("role") == "pemilik" ||
					$this->session->userdata("role") == "produksi"
					) { ?>
					<li class="nav-item">
						<a href="<?=site_url('peramalan')?>" class="nav-link">
							<i class="nav-icon fas fa-chart-bar"></i>
							<p>
								Peramalan
							</p>
						</a>
					</li>
					<?php } ?>

				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>
