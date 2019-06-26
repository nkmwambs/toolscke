<div class="row">
	<div class="col-sm-12">
		<!--Tabs Control-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
				<a href="#system_opening" data-toggle="tab"><i class="entypo-cog"></i>
					<?=get_phrase('system_opening');?>
				</a>
			</li>
			
				
			<li class="">
				<a href="#banks" data-toggle="tab"><i class="fa fa-bank"></i>
					<?=get_phrase('banks');?>
				</a>
			</li>
			
		</ul>
		
		<div class="tab-content">
				
				<div class="tab-pane box active" id="system_opening" style="padding: 5px">
	                <div class="box-content padded">
	                	<table class="table table-striped settings">
	                		<thead>
	                			<tr>
	                				<th><?=get_phrase('project_id');?></th>
	                				<th><?=get_phrase('supervisory_group');?></th>
	                				<th><?=get_phrase('system_start_usage_date');?></th>
	                				<th><?=get_phrase('bank_name');?></th>
	                				<th><?=get_phrase('action');?></th>
	                			</tr>
	                		</thead>
	                		<tbody>
	                			<?php
	                				
	                				$details = $this->db->get('projectsdetails')->result_object();
	                				
	                				foreach($details as $row):
	                			?>
	                				<tr>
	                					<td><?=$row->icpNo;?></td>
	                					<td><?=$this->settings_model->get_supervisory_group_details($row->cluster_id)->clusterName;?></td>
	                					<td><?=$row->system_start_date;?></td>
	                					<td><?=$this->finance_model->get_bank_details($row->bankID)->bankName;?></td>
	                					<td>
		                					<div class="btn-group">
							                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
							                        Action <span class="caret"></span>
							                    </button>
								                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
								                    	
								                        <!-- Edit -->
								                        <li>
								                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_project_details/<?php echo $row->ID;?>');">
								                            	<i class="entypo-pencil"></i>
																	<?php echo get_phrase('edit');?>
								                               	</a>
								                        </li>
								                        <li class="divider"></li>
								                       									
														
								                        <!--Deactivate Project-->
								                        <li>
								                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/project_set_up/deactivate/<?php echo $row->ID;?>');">
								                            	<i class="entypo-cancel"></i>
																	<?php echo get_phrase('deactivate');?>
								                               	</a>
								                       	</li>
								                       	
								                       	<li class="divider"></li>

								                        <!--Activate Project-->
								                        <li>
								                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/project_set_up/activate/<?php echo $row->ID;?>');">
								                            	<i class="fa fa-check"></i>
																	<?php echo get_phrase('activate');?>
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
	             </div>
	             

	             
	             <div class="tab-pane box" id="banks" style="padding: 5px">
	                <div class="box-content padded">
	                	
	                	<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_add_bank');" class="btn btn-primary btn-icon"><i class="fa fa-plus-square"></i><?=get_phrase('add_bank');?></button>
	                	
	                	<hr/>
	                	
	                	<table class="table table-striped settings">
	                		<thead>
	                			<tr>
	                				<th><?=get_phrase('bank');?></th>
	                				<th><?=get_phrase('swift_code');?></th>
	                				<th><?=get_phrase('action');?></th>
	                			</tr>
	                		</thead>
	                		<tbody>
	                			<?php
	                				$banks = $this->db->get('banks')->result_object();
									
									foreach($banks as $bank):
	                			?>
	                				<tr>
	                					<td><?=ucfirst($bank->bankName);?></td>
	                					<td><?=$bank->swift_code;?></td>
	                					<td>
	                						<div class="btn-group">
							                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
							                        Action <span class="caret"></span>
							                    </button>
								                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
								                    	
								                        <!-- Edit -->
								                        <li>
								                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_bank/<?php echo $bank->bankID;?>');">
								                            	<i class="entypo-pencil"></i>
																	<?php echo get_phrase('edit');?>
								                               	</a>
								                        </li>
								                        <li class="divider"></li>
								                       									
														
								                        <!--Delete-->
								                        <li>
								                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/project_set_up/delete_bank/<?php echo $bank->bankID;?>');">
								                            	<i class="fa fa-trash"></i>
																	<?php echo get_phrase('delete');?>
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
	             </div>   	
	     </div>           	
	</div>
</div>	

<script>
	$(document).ready(function(){
		
		$('table.settings').DataTable({
			dom: '<Bf><"col-sm-12"rt><ip>',
		    pagingType: "full_numbers",
		    buttons: [
		         'csv', 'excel', 'print'
		    ],
		    stateSave: true
		});
	});
</script>