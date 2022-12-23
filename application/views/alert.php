<?php 


$alert = $this->session->userdata("alert");


if($alert){

	if($alert["type"] === "warning"){
		?>
			
			<script type="text/javascript">
				Lobibox.notify('warning', {
					pauseDelayOnHover: true,
					icon: 'bx bx-error',
					continueDelayOnInactiveTab: false,
					position: 'top right',
					size: 'mini',
					title: "<?php echo $alert["title"]; ?>",
					msg: "<?php echo $alert["subTitle"]; ?>"
				});
			</script>

		<?php
	}else if($alert["type"] === "success"){
		?>
			
			<script type="text/javascript">
				Lobibox.notify('success', {
					pauseDelayOnHover: true,
					icon: 'bx bx-error',
					continueDelayOnInactiveTab: false,
					position: 'top right',
					size: 'mini',
					title: "<?php echo $alert["title"]; ?>",
					msg: "<?php echo $alert["subTitle"]; ?>"
				});
			</script>

		<?php
	}else if($alert["type"] === "error"){
		?>
			
			<script type="text/javascript">
				Lobibox.notify('error', {
					pauseDelayOnHover: true,
					icon: 'bx bx-error',
					continueDelayOnInactiveTab: false,
					position: 'top right',
					size: 'mini',
					title: "<?php echo $alert["title"]; ?>",
					msg: "<?php echo $alert["subTitle"]; ?>"
				});
			</script>

		<?php
	}else if($alert["type"] === "warning"){
		?>
			
			<script type="text/javascript">
				Lobibox.notify('warning', {
					pauseDelayOnHover: true,
					icon: 'bx bx-warning',
					continueDelayOnInactiveTab: false,
					position: 'top right',
					size: 'mini',
					title: "<?php echo $alert["title"]; ?>",
					msg: "<?php echo $alert["subTitle"]; ?>"
				});
			</script>

		<?php
	}


}

?>