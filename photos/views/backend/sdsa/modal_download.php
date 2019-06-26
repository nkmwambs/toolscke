<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><i class="fa fa-download"></i> <?=get_phrase('download_by_status');?></div>						
				</div>
										
				<div class="panel-body">
					<?php echo form_open(base_url() . 'photos.php/sdsa/download_selected/' , array('id'=>'frm_download','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('status');?></label>
							<div class="col-sm-8">
								<select class="form-control" id="status" name="status" onchange='check_projects(this);'>
									<option value="all"><?=get_phrase('all');?></option>
									<option value="1"><?=get_phrase('new');?></option>
									<option value="2"><?=get_phrase('accepted');?></option>
									<option value="3"><?=get_phrase('declined');?></option>
									<option value="4"><?=get_phrase('reinstated');?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('projects');?></label>
							<div class="col-sm-8">
								<select class="form-control" id="group" name="group" required="required">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php
										$projects = $this->db->get_where('projects',array('sdsa'=>$this->session->login_user_id))->result_object();
									
										foreach($projects as $project):
									?>
										<option value=""><?=$project->num;?></option>
									<?php
										endforeach;
									?>
								</select>
							</div>
						</div>
						
						<!--<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('delete_after_download');?></label>
							<div class="col-sm-8">
								<input type="checkbox" name="delete" value="1"/>
							</div>	
						</div>-->	
						
						<div class="form-group">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-success btn-icon"><i class="fa fa-download"></i><?=get_phrase('download');?></button>
							</div>
						</div>
				</form>
					
							
				</div>
	</div>
</div>
</div>				

<script>
	function check_projects(el){
		
		$('#group option:gt(0)').remove();
		
		$.ajax({
			url:'<?php echo base_url();?>photos.php/sdsa/check_projects/'+$(el).val(),
			success:function(data){
				//alert(data);
				var obj = JSON.parse(data);
				
				for(var i=0;i<obj.length;i++){
					$('#group').append('<option value="'+obj[i].group+'">'+obj[i].group+'</option>');
				}
			}
		});
	}
</script>