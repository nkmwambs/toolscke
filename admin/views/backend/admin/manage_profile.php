<?php
//print_r($edit_data);
?>
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
                        
    	
            <li class="">
            	<a href="#users" data-toggle="tab"><i class="fa fa-user-plus"></i> 
					<?php echo get_phrase('manage_users');?>
                    	</a>
            </li>        	            
 
            
            <li class="">
            	<a href="#groups" data-toggle="tab"><i class="fa fa-user"></i> 
					<?php echo get_phrase('projects');?>
                    	</a>
            </li>
            
            <li class="">
            	<a href="#clusters" data-toggle="tab"><i class="fa fa-users"></i> 
					<?php echo get_phrase('clusters');?>
                    	</a>
            </li>
            
            
		</ul>
    	<!------CONTROL TABS END------>
        
	
		<div class="tab-content">
			
			<div class="tab-pane box active" id="list" style="padding: 5px">
               <div class="box-content">
					<?php 
                     	echo form_open(base_url() . 'admin.php/admin/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));
                    ?>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('first_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" name="userfirstname" value="<?php echo $edit_data->userfirstname;?>"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('last_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" readonly="readonly" class="form-control" name="userlastname" value="<?php echo $edit_data->userlastname;?>"/>
                                </div>
                            </div>
                       
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $edit_data->email;?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
             </div>
			</div>
			
			<!--End Profile -->
			
			<div class="tab-pane box" id="password" style="padding: 5px">
               <div class="box-content padded">
					<?php 
                     	echo form_open(base_url() . 'admin.php/admin/manage_profile/change_password' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));
                     ?>
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
             </div>
			</div>
            
            <!-- END PASSWORD --->
			
			          <!--Manage Users-->
            <div class="tab-pane box" id="users" style="padding: 5px">
            	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_user_add/');" 
					class="btn btn-primary pull-right">
						<i class="entypo-plus-circled"></i>
							<?php echo get_phrase('add_user');?>
					</a> 
				<br><hr>
				
				<table class="table table-striped datatable" id="table_export">
					<thead>
						<tr>
							<th><?php echo get_phrase('action');?></th>
							<th><?php echo get_phrase('first_name');?></th>
							<th><?php echo get_phrase('last_name');?></th>
							<th><?php echo get_phrase('username');?></th>
							<th><?php echo get_phrase('email');?></th>
							<th><?php echo get_phrase('access_level');?></th>
							<th><?php echo get_phrase('project');?></th>
							<th><?php echo get_phrase('cluster');?></th>
							<th><?php echo get_phrase('status');?></th>
						</tr>
					</thead>
					<tbody>
            		</tbody>
				</table>			
         </div>
         
         <div class="tab-pane box" id="groups" style="padding: 5px">
         	<div class="box-content padded">
				<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_project_add/');" 
					class="btn btn-primary pull-right">
						<i class="entypo-plus-circled"></i>
							<?php echo get_phrase('add_project');?>
					</a> 
				<br><hr>
				
				<table class="table table-striped">
					<thead>
						<tr>
							<th><?=get_phrase('project_number');?></th>
							<th><?=get_phrase('project_name');?></th>
							<th><?=get_phrase('cluster');?></th>
							<th><?=get_phrase('action');?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$projects = $this->db->get('projectsdetails')->result_object();
							
							foreach($projects as $row):
						?>
							<tr>
								<td><?=$row->icpNo;?></td>
								<td><?=$row->icpName;?></td>
								<td><?=$this->db->get_where('clusters',array('clusters_id'=>$row->cluster_id))->row()->clusterName;?></td>
								<td>
									<div class="btn-group">
					                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
					                        Action <span class="caret"></span>
					                    </button>
					                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					                    	<li>
					                    			<a href="#groups" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_edit_project/<?=$row->ID;?>');">
					                            		<i class="fa fa-edit"></i>
															<?php echo get_phrase('edit');?>
					                               	</a>
					                    	</li>
					                    	
					                    	<li class="divider"></li>
					                    	
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
         </div>	
			
						
			<div class="tab-pane box" id="clusters" style="padding: 5px">
				<div class="box-content padded">
				<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_cluster_add/');" 
					class="btn btn-primary pull-right">
						<i class="entypo-plus-circled"></i>
							<?php echo get_phrase('add_cluster');?>
					</a> 
				<br><hr>					
				<table class="table table-striped">
					<thead>
						<tr>
							<th><?=get_phrase('cluster_name');?></th>
							<th><?=get_phrase('facilitator');?></th>
							<th><?=get_phrase('action');?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$clusters = $this->db->get('clusters')->result_object();
							
							foreach($clusters as $row):
						?>
								<tr>
									<td><?=$row->clusterName;?></td>
									<?php
										$fac_row = $this->db->get_where('users',array('cname'=>$row->clusterName,'userlevel'=>'2'))->row();
									?>
									<td><?php if(!empty($fac_row)) {echo $fac_row->userfirstname;?> <?=$fac_row->userlastname;} else{ echo "Not Set";}?></td>
									<td>
										<div class="btn-group">
						                    <button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        Action <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                       
						                      
						                        <li>
						                        	<a href="#clusters" id="" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_edit_cluster/<?php echo $row->clusters_id;?>');">
						                            	<i class="entypo-pencil"></i>
															<?php echo get_phrase('edit_cluster');?>
						                               	</a>
						                        </li>
						                        <li class="divider"></li>
						                        
						                        <li>
						                        	<a href="#clusters" id="" onclick="confirm_action('<?php echo base_url();?>admin.php/admin/manage_profile/delete_cluster/<?php echo $row->clusters_id;?>');">
						                            	<i class="entypo-erase"></i>
															<?php echo get_phrase('delete_cluster');?>
						                               	</a>
						                        </li>
						                        <li class="divider"></li>
						                        
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
			</div>					
             
			
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
		
			$(window).on("popstate", function() {
			    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
			    $("a[href='" + anchor + "']").tab("show");
		
		});
		
		
		
		var datatable = $('#table_export').DataTable({
		       dom: '<Bf><"col-sm-12"rt><ip>',
		       //sDom:'r',
		       pagingType: "full_numbers",
		       buttons: [
		           'csv', 'excel', 'print'
		       ],
		       "bServerSide": true,
		       stateSave: true,
		       oLanguage: {
			        sProcessing: "<img src='<?php echo base_url();?>uploads/preloader4.gif'>"
			    },
			   processing: true, //Feature control the processing indicator.
		       serverSide: true, //Feature control DataTables' server-side processing mode.
		
		       // Load data for the table's content from an Ajax source
		        "ajax": {
		           "url": "<?php echo base_url();?>admin.php/admin/ajax_list",
		           "type": "POST"
		       },
		       //Set column definition initialisation properties.
		        "columnDefs": [
		        { 
		            "targets": [ 0 ], //first column / numbering column
		            "orderable": false, //set not orderable
		        }],
		        "bDestroy": true   
		           
		       
		
		     
		   });
		   
		   
	   
	});
</script>