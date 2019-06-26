<?php
$user = $this->db->get_where('users',array('users_id'=>$this->session->userdata('login_user_id')))->row();
?>
<div class="row">
	<div class="col-xs-12">
		
		
		    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#update_profile" data-toggle="tab"><i class="fa fa-user"></i> 
					<?php echo get_phrase('update_profile');?>
                    	</a>
            </li>
            
            
        </ul>    
        
        
       	<div class="tab-content">
        <!----EDITING FORM STARTS---->
		<div class="tab-pane box active" id="update_profile" style="padding: 5px">
				
				
		
		<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('update_profile');?></div>						
				</div>
										
				<div class="panel-body">
					<?php echo form_open(base_url() . 'index.php?sdsa/manage_profile/update/'.$this->session->userdata('login_user_id') , array('id'=>'frm_profile','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('full_name');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $user->name;?>"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('email');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" readonly="readonly" name="email" id="email" value="<?php echo $user->email;?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('level');?></label>
							<div class="col-sm-8">
								<!--<input type="text" class="form-control" name="level" id="level"  value="<?php echo $user->level;?>"/>-->
								<select class="form-control" name="level" id="level">
									<option value=""><?php echo get_phrase('select');?></option>
									<option value="1" <?php if($user->level==='1') echo 'selected';?>><?php echo get_phrase('administrator');?></option>
									<option value="2" <?php if($user->level==='2') echo 'selected';?>><?php echo get_phrase('sdsa');?></option>
									<option value="3" <?php if($user->level==='3') echo 'selected';?>><?php echo get_phrase('facilitator');?></option>
									<option value="4" <?php if($user->level==='4') echo 'selected';?>><?php echo get_phrase('project');?></option>
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
							<button class="btn btn-success btn-icon col-sm-offset-6"><i class="fa fa-save"></i><?php echo get_phrase('save');?></button>
						</div>
						
					</form>
				</div>

		</div>
		
		</div>
		
		
</div>

</div>

</div>


					