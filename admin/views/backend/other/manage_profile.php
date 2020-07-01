<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('manage_profile');?>
                    	</a>
            </li>
			
			<li class="">
            	<a href="#password" data-toggle="tab"><i class="entypo-lock"></i> 
					<?php echo get_phrase('change_password');?>
                    	</a>
            </li>
                        
           <!--<li class="">
            	<a href="#admins" data-toggle="tab"><i class="entypo-users"></i> 
					<?php echo get_phrase('manage_administrators');?>
                    	</a>
           </li>-->
            <?php if($this->session->login_type==='admin'){?>      	
            <li class="">
            	<a href="#users" data-toggle="tab"><i class="fa fa-user-plus"></i> 
					<?php echo get_phrase('manage_users');?>
                    	</a>
            </li>       
            
            <li class="">
            	<a href="#userlevels" data-toggle="tab"><i class="fa fa-anchor"></i> 
					<?php echo get_phrase('manage_userlevels');?>
                    	</a>
            </li>  	            
            <?php }?>
            
            <li class="">
            	<a href="#groups" data-toggle="tab"><i class="fa fa-users"></i> 
					<?php echo get_phrase('user_groups');?>
                    	</a>
            </li>
		</ul>
    	<!------CONTROL TABS END------>
        
	
		<div class="tab-content">
			
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'admin.php/admin/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('full_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" name="username" value="<?php echo $row['username'];?>"/>
                                </div>
                            </div>
                       
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
			
			<!--End Profile -->
			
			<div class="tab-pane box" id="password" style="padding: 5px">
                <div class="box-content padded">
					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'admin.php/admin/manage_profile/change_password' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
            
            <!-- END PASSWORD --->
           <?php if($this->session->userdata('login_type')==='admin' || $this->session->userdata('logged_user_level')==='2'){?> 
            <!--Manage Users-->
            <div class="tab-pane box" id="users" style="padding: 5px">
            	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_user_add/');" 
					class="btn btn-primary pull-right">
						<i class="entypo-plus-circled"></i>
							<?php echo get_phrase('add_user');?>
					</a> 
				<br><hr>
				
				<table class="table table-striped datatable">
					<thead>
						<tr>
							<th><?php echo get_phrase('action');?></th>
							<th><?php echo get_phrase('name');?></th>
							<th><?php echo get_phrase('email');?></th>
							<th><?php echo get_phrase('access_level');?></th>
							<th><?php echo get_phrase('work_group');?></th>
							<th><?php echo get_phrase('supervisory_group');?></th>
							<th><?php echo get_phrase('status');?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($all_users as $users):
						?>
							<tr>
								<td>
								<div class="btn-group">
			                    <button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
			                        Action <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
			                        <!-- Add Sub Account -->
			                      
			                        <li>
			                        	<a href="#users" id="" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_edit_user/<?php echo $users->users_id;?>');">
			                            	<i class="entypo-pencil"></i>
												<?php echo get_phrase('edit_user');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>
			                        
			                        <li>
			                        	<a href="#users" id="" onclick="confirm_action('<?php echo base_url();?>admin.php/admin/manage_profile/suspend_user/<?php echo $users->users_id;?>/<?php echo $users->authentication_key;?>');">
												<?php
													if($users->auth==='1'){
												?>
													<i class="fa fa-ban fa-fw"></i>
												<?php
														echo get_phrase('suspend_user');
													}else{
												?>
													<i class="fa fa-check fa-fw"></i>
												<?php
														echo get_phrase('activate_user');
													}
													 	
												?>
			                               	</a>
			                        </li>
			                        
			                     </ul>
			                     </div>
								</td>
								
								<td><?php echo $users->username;?></td>
								<td><?php echo $users->email;?></td>
								<td><?php echo $this->db->get_where('positions',array('pstID'=>$users->userlevel))->row()->dsgn;?></td>
								<td><?php echo $this->admin_model->work_groups($users->users_id)->icpNo;?></td>
								<td><?php echo $this->admin_model->work_groups($users->users_id)->cname;?></td>
								<td>
										<?php 
											if($users->auth==='1'){
												echo "<span class='badge badge-sucess'>".get_phrase('active')."</span>";
											}else{
												echo "<span class='badge badge-danger'>".get_phrase('suspended')."</span>";
											};
										?>
								</td>
							</tr>
						<?php
							endforeach;
						?>		
					</tbody>
				</table>
				
            </div>
            
            <div class="tab-pane box" id="userlevels" style="padding: 5px">
            	<table class="table table-striped">
            		<thead>
            			<tr>
            				<th><?=get_phrase('role_name');?></th>
            				<th><?=get_phrase('description');?></th>
            				<th><?=get_phrase('count_of_users');?></th>
            				<th><?=get_phrase('action');?></th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php
            				$roles = $this->db->get('userlevels')->result_object();
							
							foreach($roles as $row):
            			?>
            				<tr>
            					<td><?=$row->role;?></td>
            					<td><?=$row->role_desc;?></td>
            					<td><?=$this->db->get_where('users',array('userlevel'=>$row->userlevel_id))->num_rows();?></td>
            					<td>
            							<div class="btn-group">
						                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        <?php echo get_phrase('action');?> <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                   		<li>
						                        	<a href="#" onclick="showAjaxModal('<?=base_url();?>admin.php/modal/popup/modal_edit_userlevel/<?=$row->userlevel_id;?>');">
						                            	<i class="fa fa-edit"></i>
															<?php echo get_phrase('edit');?>
						                               	</a>
						                        </li>
						                    
						                    	    
						                        <li class="divider"></li>
						                        
						                    	<li>
						                        <a href="#" onclick="showAjaxModal('<?=base_url();?>admin.php/modal/popup/modal_view_userlevel/<?=$row->userlevel_id;?>');">
						                            	<i class="fa fa-eye"></i>
															<?php echo get_phrase('view');?>
						                               	</a>
						                        </li>
						                  	</ul>
						                 </div> 	      
            					</td>
            				</tr>
            			<?php
            				endforeach;
            			?>
            		</tbody>
            	</table>
            </div>
            
            <div class="tab-pane box" id="groups" style="padding: 5px">
            	
            	<a href="#groups" class="btn btn-info btn-icon" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_add_supervisory_group/');"><i class="fa fa-plus-circle"></i><?php echo get_phrase('new_supervisory_group');?></a>
            	
            	<hr/>
            	
            	<table class="table table-striped">
            		<thead>
            			<tr>
            				<th><?php echo get_phrase('supervisory_group');?></th>
            				<th><?php echo get_phrase('supervisor');?></th>
            				<th><?php echo get_phrase('work_groups');?></th>
            				<th><?php echo get_phrase('action');?></th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php
            				$clusters = $this->db->get('clusters')->result_object();
            				
							foreach($clusters as $cluster):
            			?>
            					<tr>
            						<td><?php echo $cluster->name;?></td>
            						<td>
            							<?php
            								
											if($this->db->get_where('users',array('userlevel'=>2,'cluster_id'=>$cluster->cluster_id))->num_rows()>0) 
												echo $this->db->get_where('users',array('userlevel'=>2,'cluster_id'=>$cluster->cluster_id))->row()->name;
            							?>
            						</td>
            						<td>
            							<?php
            								echo $this->db->select('count(project_id) as id')->group_by('project_id')->get_where('projectsdetails',array('cluster_id'=>$cluster->cluster_id))->num_rows();
            							?>
            						</td>
            						<td>
            							<div class="btn-group">
						                    <button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        <?php echo get_phrase('action');?> <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                      
						                        <li>
						                        	<a href="#groups" id="" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_work_groups/<?php echo $cluster->cluster_id;?>');">
						                            	<i class="fa fa-eye"></i>
															<?php echo get_phrase('work_groups');?>
						                               	</a>
						                        </li>
						                        
						                        <li class="divider"></li>
						                        
						                        <li>
						                        	<a href="#groups" id="" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_change_supervisor/<?php echo $cluster->cluster_id;?>');">
						                            	<i class="fa fa-random"></i>
															<?php echo get_phrase('change_supervisor');?>
						                               	</a>
						                        </li>
						                        
						                        <li class="divider"></li>
						                        
						                        <li>
						                        	<a href="#groups" id="" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_edit_supervisory_group/<?php echo $cluster->cluster_id;?>');">
						                            	<i class="entypo-pencil"></i>
															<?php echo get_phrase('edit_supervisory_group');?>
						                               	</a>
						                        </li>
						                        
						                        <li class="divider"></li>
						                        
						                        <li>
						                        	<a href="#groups" id="" onclick="confirm_action('<?php echo base_url();?>admin.php/admin/user_groups/delete_supervisory_group/<?php echo $cluster->cluster_id;?>');">
						                            	<i class="fa fa-trash-o"></i>
															<?php echo get_phrase('delete_supervisory_group');?>
						                               	</a>
						                        </li>
						                        
						                     </ul>
						                   </div>
						                 
            						</td>
            					</tr>
            			<?php
            				endforeach;
            			?>
            		</tbody>
            	</table>
            </div>	
            
            <!--End Manage Users-->
             <?php }?> 
			
		</div>
	</div>
	
</div>

<script>
	$(document).ready(function(){
		var datatable = $('.table').DataTable();
		
		
		    if (location.hash) {
			        $("a[href='" + location.hash + "']").tab("show");
			    }
			    $(document.body).on("click", "a[data-toggle]", function(event) {
			        location.hash = this.getAttribute("href");
			    });
			});
			$(window).on("popstate", function() {
			    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
			    $("a[href='" + anchor + "']").tab("show");
		
	});
</script>