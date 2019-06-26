<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('add_user');?></div>						
				</div>
										
				<div class="panel-body">
					<?php echo form_open(base_url() . 'index.php?sdsa/manage_profile/add_user/' , array('id'=>'frm_profile','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('full_name');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="fname" id="fname"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('email');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="email" id="email" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('level');?></label>
							<div class="col-sm-8">
								<!--<input type="text" class="form-control" name="level" id="level"  value="<?php echo $user->level;?>"/>-->
								<select class="form-control" name="level" id="level">
									<option value=""><?php echo get_phrase('select');?></option>
									<option value="1"><?php echo get_phrase('administrator');?></option>
									<option value="2"><?php echo get_phrase('sdsa');?></option>
									<option value="3"><?php echo get_phrase('facilitator');?></option>
									<option value="4"><?php echo get_phrase('project');?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('password');?></label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="" id="" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('confirm_password');?></label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="password" id="password" />
							</div>
						</div>
						
						<div class="form-group">
							<button class="btn btn-success btn-icon col-sm-offset-6"><i class="fa fa-plus-square"></i><?php echo get_phrase('add_user');?></button>
						</div>
						
					</form>
				</div>
			</div>
		</div>
</div>