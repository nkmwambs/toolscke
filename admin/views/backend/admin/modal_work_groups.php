<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-eye"></i>
                            <?php echo get_phrase('work_groups');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<button class="btn btn-primary btn-icon" onclick="showAjaxModal('<?=base_url();?>admin.php/modal/popup/modal_add_work_group/<?=$param2;?>')"><i class="fa fa-plus-square"></i><?=get_phrase('add_work_group');?></button>
                    	
                    	<hr/>
                    	
                    	<table class="table table-striped">
                    		<thead>
                    			<tr>
                    				<th><?php echo get_phrase('work_group_code');?></th>
                    				<th><?php echo get_phrase('work_group_name');?></th>
                    				<th><?php echo get_phrase('users');?></th>
                    				<th><?php echo get_phrase('action');?></th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			
                    				<?php
                    					$groups = $this->db->get_where('projectsdetails',array('cluster_id'=>$param2))->result_object();
										
										foreach($groups as $group):
                    				?>
                    					<tr>
                    						<td><?php echo $group->project_id;?></td>
                    						<td><?php echo $group->name;?></td>
                    						<td>
                    							<?php
                    								echo $this->db->get_where('users',array('project_id'=>$group->projectsdetails_id,'authentication_key'=>'1'))->num_rows();
                    							?>
                    						</td>
                    						<td>
                    							<div class="btn-group">
								                    <button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								                        <?php echo get_phrase('action');?> <span class="caret"></span>
								                    </button>
									                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
									                      
									                        <li>
									                        	<a href="#groups" id="" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_work_group_users/<?php echo $group->projectsdetails_id;?>');">
									                            	<i class="fa fa-eye"></i>
																		<?php echo get_phrase('users');?>
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

<script>
	$(document).ready(function(){
		var datatable = $('.table').DataTable();
	});
</script>				