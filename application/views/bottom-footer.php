
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

	<?php $this->load->view("alert"); //alert sistemi ?> 

<!-- Sortable -->
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js">/*Sortable*/</script>
	<script>
		$( "#sortable" ).sortable();

		$("#sortable").on("sortupdate", function() {
			var data = $(this).sortable("serialize");
			var data_url = $(this).data("url");

			$.post(data_url,{data : data}, function(response) {
				Lobibox.notify('success', {
							pauseDelayOnHover: true,
							size: 'mini',
							rounded: true,
							icon: 'bx bx-check-circle',
							delayIndicator: true,
							continueDelayOnInactiveTab: true,
							position: 'top right',
							title: "İşlem Başarılı!",
							msg: 'Sıralama başarıyla güncellendi..'
						});
			})
		})
	</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="text/javascript">
	$(document).ready(function () {
		$(".table").on("change", "#isActive", function () {
			var data = $(this).prop("checked");
			var data_url = $(this).attr("data-url");
			if(data !== "" && data_url !== ""){

				$.ajax({
					url: data_url,
					type: "POST",
					data: {data: data},
					success: function (result) {
						Lobibox.notify('success', {
							pauseDelayOnHover: true,
							size: 'mini',
							rounded: true,
							icon: 'bx bx-check-circle',
							delayIndicator: true,
							continueDelayOnInactiveTab: true,
							position: 'top right',
							title: "İşlem Başarılı!",
							msg: 'Durum güncellendi..'
						});
					},
					error: function () {
						Lobibox.notify('error', {
							pauseDelayOnHover: true,
							size: 'mini',
							rounded: true,
							icon: 'bx bx-x-circle',
							delayIndicator: true,
							continueDelayOnInactiveTab: true,
							position: 'top right',
							title: "Hata!",
							msg: 'Bir sorun oluştu.'
						});
					}
				})

			}
		})
	})
</script>

</body>

</html>