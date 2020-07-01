<?php
	$user = $this->db->get_where('users',array('ID'=>$param2))->row();
	
	//$user_category = $this->db->get_where('userlevels',array('userlevel_id'=>$user->userlevel))->row()->role;
?>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-pencil-square"></i>
                            <?php echo get_phrase('edit_user');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    <?php 
						echo form_open(base_url() . 'admin.php/facilitator/manage_profile/edit_user/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
					?>
                    
                    	<div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('userfirstname');?></label>
							<div class="col-xs-8"><INPUT type="text" name="userfirstname" id="userfirstname" class="form-control" value="<?php echo $user->userfirstname;?>"/></div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('userlastname');?></label>
							<div class="col-xs-8"><INPUT type="text" name="userlastname" id="userlastname" class="form-control" value="<?php echo $user->userlastname;?>"/></div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('username');?></label>
							<div class="col-xs-8"><INPUT type="text" name="username" id="username" class="form-control" value="<?php echo $user->username;?>"/></div>
						</div>
						
						<div id="_department" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('designation');?></label>
							<div class="col-xs-8">
								<select class="form-control" id="department" name="department">
									<option value=""><?php echo get_phrase('select');?></option>
									<option value="15" <?php if($user->department==='15') echo "selected";?>><?=get_phrase("project_director");?></option>
									<option value="16" <?php if($user->department==='16') echo "selected";?>><?=get_phrase("project_accountant");?></option>
									<option value="17" <?php if($user->department==='17') echo "selected";?>><?=get_phrase("project_social_worker");?></option>
									<option value="18" <?php if($user->department==='18') echo "selected";?>><?=get_phrase("project_health_worker");?></option>
									<option value="19" <?php if($user->department==='19') echo "selected";?>><?=get_phrase("child_survival_implementer");?></option>
									<option value="20" <?php if($user->department==='20') echo "selected";?>><?=get_phrase("patron");?></option>
									<option value="21" <?php if($user->department==='21') echo "selected";?>><?=get_phrase("cpc_member");?></option>
								</select>
							</div>
						</div>					
						
						<div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('email');?></label>
							<div class="col-xs-8"><INPUT type="text" name="email" id="email" class="form-control" value="<?php echo $user->email;?>"/></div>
						</div>
						
						<div class="form-group">
                                <label class="col-xs-4 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" name="password" id="password" value="<?php echo $user->password;?>"/>
                                </div>
                        </div>
						
						<div class="col-offset-4 col-xs-4 col-offset-4">
							<button type="submit" class="btn btn-primary btn-icon"><i class="entypo-pencil"></i>Edit</button>
						</div>
                    
                    </form>	
                    </div>
     	</div>               
  </div>                  	
</div>