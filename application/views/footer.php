

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
	<strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 3.1.0-pre
	</div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?=base_url()?>assets/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=base_url()?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url()?>assets/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/template/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?=base_url()?>assets/template/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?=base_url()?>assets/template/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?=base_url()?>assets/template/plugins/raphael/raphael.min.js"></script>
<script src="<?=base_url()?>assets/template/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?=base_url()?>assets/template/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>assets/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- InputMask -->
<script src="<?=base_url()?>assets/template/plugins/moment/moment.min.js"></script>
<script src="<?=base_url()?>assets/template/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Select2 -->
<script src="<?=base_url()?>assets/template/plugins/select2/js/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="<?=base_url()?>assets/template/plugins/daterangepicker/daterangepicker.js"></script>
<!--datepicker-->
<script src="<?=base_url()?>assets/template/plugins/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- ChartJS -->
<script src="<?=base_url()?>assets/template/plugins/chart.js/Chart.min.js"></script>
<!-- Toastr -->
<script src="<?=base_url()?>assets/template/plugins/toastr/toastr.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url()?>assets/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?=base_url()?>assets/template/dist/js/pages/dashboard2.js"></script>

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

	//dataTable function
	$(function () {
		$("#dataTable").DataTable({
			"responsive": true,
			"autoWidth": false,
		});
	});

	//Initialize Select2 Elements
	$('.select2').select2()

	//Initialize Select2 Elements
	$('.select2bs4').select2({
		theme: 'bootstrap4'
	})

	$('.datetimepicker').datetimepicker({
		format: "YYYY-MM-DD hh:mm",
		useCurrent: false
	});

	$('#datepicker').datetimepicker({
		uiLibrary: 'bootstrap4'
	});

	$('.date1').datepicker({
		format: "dd-mm-yyyy",
		clearBtn: true,
		autoclose: true
	});
	$('.month1').datepicker({
		format: "yyyy-mm",
		startView: 1,
		minViewMode: 1,
		maxViewMode: 2,
		clearBtn: true,
		autoclose: true,
		orientation: "bottom"
	});
	$('.month2').datepicker({
		format: "yyyy-mm",
		startView: 1,
		minViewMode: 1,
		maxViewMode: 2,
		clearBtn: true,
		autoclose: true,
		orientation: "bottom"
	});

	var warna = [
		'rgb(65, 105, 225)',
		'rgb(220, 20, 60)',
		'rgb(252, 165, 3)',
		'rgb(30, 144, 255)',
		'rgb(210, 105, 30)',
		'rgb(100, 149, 237)',
		'rgb(27, 128, 1)',
		'rgb(40, 178, 170)',
		'rgb(199, 21, 133)',
		'rgb(218, 112, 214)',
	];
</script>
</body>
</html>
