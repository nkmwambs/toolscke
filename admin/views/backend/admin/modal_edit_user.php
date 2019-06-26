<?php
	$user = $this->db->get_where('users',array('ID'=>$param2))->row();
	
	$user_category = $this->db->get_where('positions',array('pstID'=>$user->userlevel))->row()->dsgn;
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
						echo form_open(base_url() . 'admin.php/admin/manage_profile/edit_user/'.$param2.'/'.$user_category , array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
					?>
                    
                    	<div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('first_name');?></label>
							<div class="col-xs-8"><INPUT type="text" name="userfirstname" id="userfirstname" class="form-control" value="<?php echo $user->userfirstname;?>"/></div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('last_name');?></label>
							<div class="col-xs-8"><INPUT type="text" name="userlastname" id="userlastname" class="form-control" value="<?php echo $user->userlastname;?>"/></div>
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