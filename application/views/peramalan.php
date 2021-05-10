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
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
<script>

</script>
