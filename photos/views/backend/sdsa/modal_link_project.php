<?php
$user = $this->db->get_where('users',array('ID'=>$param2))->row();

$levels = array(9=>'administrator',19=>'sdsa',2=>'facilitator',1=>'partner');

$link_type = $levels[$user->userlevel];

?>
<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('link_project');?></div>						
				</div>
										
				<div class="panel-body">
					<?php echo form_open(base_url() . 'photos.php/sdsa/projects/link_project/'.$param2 , array('id'=>'frm_profile','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('user');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="<?php echo $user->userfirstname.' '.$user->userlastname;?>" readonly="readonly"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('link_type');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="link_type" id="link_type" value="<?php echo $link_type;?>" readonly="readonly"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('project_number');?></label>
							<div class="col-sm-8">
								<select class="form-control" name="num" id="num">
									<option><?php echo get_phrase('select');?></option>
									
									<?php
										$projects = $this->db->get_where('projects',array($link_type=>''))->result_object();
										
										foreach($projects as $rows):
									?>
										<option value="<?php echo $rows->num;?>"><?php echo $rows->num;?></option>
									<?php
										endforeach;
									?>
								</select>
							</div>
						</div>
						
											
						<div class="form-group">
							<button class="btn btn-success btn-icon col-sm-offset-6"><i class="fa fa-link"></i><?php echo get_phrase('link_project');?></button>
						</div>
						
					</form>
				</div>
			</div>
		</div>
</div>