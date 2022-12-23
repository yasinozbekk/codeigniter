
	<!-- Bootstrap JS -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="<?php echo base_url(); ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>


    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>

	
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
	  <script src="<?php echo base_url(); ?>assets/js/index.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/notifications/js/notifications.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/notifications/js/notification-custom-script.js"></script>
	<!--app JS-->
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>

	<?php $this->load->view("alert");  ?> 


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>