<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-primary">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('reject_reason');?></div>						
				</div>
										
				<div class="panel-body">
					<div class="row">				
						<div class="col-sm-6">
							<?php echo get_phrase('comment');?>
						</div>
						
						<div class="col-sm-4">
							<?php echo get_phrase('comment_by');?>
						</div>
						
						<div class="col-sm-2">
							<?php echo get_phrase('last_modified');?>
						</div>
					</div>
					<hr>		
				<?php
					$comments = $this->db->get_where('reasons',array('photo_id'=>$param2))->result_object();
					
					foreach($comments as $rsn):
				?>
					<div class="row">
						<div class="col-sm-6">
							<?php echo $rsn->reason;?>
						</div>
						<div class="col-sm-4">
							<?php echo $this->db->get_where('users',array('users_id'=>$rsn->reason_by))->row()->name;?>
						</div>
						<div class="col-sm-2">
							<?php echo $rsn->stamp;?>
						</div>
					</div>
					<hr>
				<?php
				 	endforeach;
				?>
					
				
				<form id="frm_reject" method="post" action="<?php echo base_url();?>photos.php/sdsa/reject_photo/<?php echo $param2;?>">	
						<div class="form-group">
							<label class="control-label col-sm-12"><?php echo get_phrase('reject_reason');?></label>
							<div class="col-sm-12">
								<textarea class="form-control" name="reject_reason" id="reject_reason" cols="5" rows="5"></textarea>
							</div>
						</div>
				</form>
					
				</div>
				
				<div class="panel-footer">
                        	<div class="btn btn-danger btn-icon" id="reject_btn"><i class="fa fa-close"></i>Reject</div>
				</div>
				
			
		</div>
	</div>
	
</div>

<script>
	$('#reject_btn').click(function(){
		$('#frm_reject').submit();
	});
</script>