<!-- <div class="btn-group">
	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
		Action <span class="caret"></span>
	</button>

	<ul class="dropdown-menu dropdown-default pull-right" role="menu"> -->

		<div class="pull-left"  onclick="showAjaxModal('<?php echo base_url(); ?>admin.php/modal/popup/modal_edit_user/<?php echo $userid; ?>');"><i class="entypo-pencil"></i>
			 
		</div>
		<!-- <li class="divider"></li> -->

		<div title="<?php if($auth==='1') echo get_phrase("suspend"); else echo get_phrase("activate");?>" class="pull-left" onclick="confirm_action('<?php echo base_url(); ?>admin.php/admin/manage_profile/suspend_user/<?php echo $userid; ?>/<?php echo $auth; ?>');"> 
				<?php
					if($auth==='1'){
				?>
					<i class="fa fa-ban fa-fw"></i> 
					
				<?php 
					
					
					}else{
				?>
					<i class="fa fa-check fa-fw"></i> 
				<?php
					
				}
				?>
				
		</div>

	<!-- </ul>
</div> -->