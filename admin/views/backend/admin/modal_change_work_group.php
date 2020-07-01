<?php
	$user = $this->db->get_where('users',array('users_id'=>$param2))->row();
?>
<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-random"></i>
                            <?php echo get_phrase('change_work_group');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<?php 
							echo form_open(base_url() . 'admin.php/admin/user_groups/change_work_group/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
						
						?>
												
						<div id="_username" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('full_name');?></label>
							<div class="col-xs-8"><INPUT type="text" id="name" class="form-control" value="<?=$user->name?>" readonly="readonly"/></div>
						</div>
						
						
						<div id="_email" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('email');?></label>
							<div class="col-xs-8"><INPUT type="text" id="email" class="form-control" value="<?=$user->email?>" readonly="readonly"/></div>
						</div>

						<div id="_supervisorygroup" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('supervisory_group');?></label>
							<div class="col-xs-8">
								<!--<INPUT type="text" name="fname" id="fname" class="form-control"/>-->
								<select class="form-control" name="cluster_id" id="cluster_id"  onchange="populate_projects(this);">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php
										$clusters = $this->db->get('clusters')->result_object();
										
										foreach($clusters as $row):
									?>
										<option value="<?php echo $row->cluster_id;?>" <?php if($row->cluster_id===$user->cluster_id) echo "selected";?>><?php echo $row->name;?></option>
									<?php
									 	endforeach;
									?>
								</select>
							</div>
						</div>
						
						<div id="_usergroup" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('work_group');?></label>
							<div class="col-xs-8">
								<!--<INPUT type="text" name="fname" id="fname" class="form-control"/>-->
								<select class="form-control" name="project_id" id="project_id">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php
										$projects = $this->db->get_where('projectsdetails',array('cluster_id'=>$user->cluster_id))->result_object();
										
										foreach($projects as $project):
									?>
										<option value="<?php echo $project->project_id;?> <?php if($project->project_id===$user->project_id) echo 'selected';?>"><?php echo $project->project_id;?></option>
									<?php 
										endforeach;
									?>
								</select>
							</div>
						</div>
                        
                        
						
						<div class="col-offset-4 col-xs-4 col-offset-4">
							<button type="submit" class="btn btn-primary btn-icon"><i class="fa fa-pencil"></i><?php echo get_phrase('edit');?></button>
						</div>
						
					</form>
					</div>
			</div>
		</div>
</div>	

<script>
	function populate_projects(el){
		var url = '<?php echo base_url();?>admin.php/admin/populate_projects/'+$(el).val();
		
		$('#project_id').find('option').remove();
		
		$.ajax({
			url:url,
			success:function(data){
				$('#project_id').append(data);
			}
		});
	}
</script>					