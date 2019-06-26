<?php
		
	$account_type       =	$this->session->userdata('login_type');
	
	include $account_type.'/'.$app_name.'/'.$page_name.'.php';
	
?>
<script src="<?php echo base_url();?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-switch.min.js"></script>