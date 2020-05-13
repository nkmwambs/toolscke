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
							echo form_open(base_url() . 'admin.php/facilitator/user_groups/change_work_group/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
						
						?>
												
						<div id="_username" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('full_name');?></label>
							<div class="col-xs-8"><INPUT type="text" id="name" class="form-control" value="<?=$user->userfirstname?> <?=$user->userfirstname?>" readonly="readonly"/></div>
						</div>
						
						
						<div id="_email" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('email');?></label>
							<div class="col-xs-8"><INPUT type="text" id="email" class="form-control" value="<?=$user->email?>" readonly="readonly"/></div>
						</div>
						
						<div id="_email" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('cluster');?></label>
							<div class="col-xs-8"><INPUT type="text" id="cname" name="cname" class="form-control" value="<?=$user->cname?>" readonly="readonly"/></div>
						</div>
						
						<div id="_usergroup" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('new_project');?></label>
							<div class="col-xs-8">
								<!--<INPUT type="text" name="fname" id="fname" class="form-control"/>-->
								<select class="form-control" name="fname" id="fname">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php
										$projects = $this->crud_model->project_per_cluster($user->cname);
										
										foreach($projects as $project):
									?>
										<option value="<?php echo $project->fname;?> <?php if($project->fname===$user->fname) echo 'selected';?>"><?php echo $project->fname;?></option>
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

</script>					