

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
<!-- ChartJS -->
<script src="<?=base_url()?>assets/template/plugins/chart.js/Chart.min.js"></script>
<!-- Toastr -->
<script src="<?=base_url()?>assets/template/plugins/toastr/toastr.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?=base_url()?>assets/template/dist/js/pages/dashboard2.js"></script>

<script>
	// $( document ).ready(function() {
		// $(document).Toasts('create', {
		// 	title: 'Toast Title',
		// 	autohide: true,
		// 	delay: 750,
		// 	body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
		// })
		// toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
		// toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
	// });

	$(document).Toasts('create', {
		class: 'bg-success',
		title: 'Toast Title',
		icon: 'fas fa-envelope fa-lg',
		autohide: true,
		delay: 2000,
		body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
	})

	$(function () {
		$("#dataTable").DataTable({
			"responsive": true,
			"autoWidth": false,
		});
	});
</script>
</body>
</html>
