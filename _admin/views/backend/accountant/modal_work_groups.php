<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-eye"></i>
                            <?php echo get_phrase('projects');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<button class="btn btn-primary btn-icon" onclick="showAjaxModal('<?=base_url();?>admin.php/modal/popup/modal_add_work_group/<?=$param2;?>')"><i class="fa fa-plus-square"></i><?=get_phrase('add_project');?></button>
                    	
                    	<hr/>
                    	
                    	<table class="table table-striped">
                    		<thead>
                    			<tr>
                    				<th><?php echo get_phrase('project_id');?></th>
                    				<th><?php echo get_phrase('name');?></th>
                    				<th><?php echo get_phrase('users');?></th>
                    				<th><?php echo get_phrase('action');?></th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			
                    				<?php
                    					//$groups = $this->db->get_where('projectsdetails',array('cluster_id'=>$param2))->result_object();
										$groups = $this->crud_model->project_per_cluster($param2);
										foreach($groups as $group):
                    				?>
                    					<tr>
                    						<td><?php echo $group->fname;?></td>
                    						<td><?php echo $group->lname;?></td>
                    						<td>
                    							<?php
                    								echo $this->db->get_where('users',array('fname'=>$group->fname,'auth'=>'1',"department<>"=>"0"))->num_rows();
                    							?>
                    						</td>
                    						<td>
                    							<div class="btn-group">
								                    <button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								                        <?php echo get_phrase('action');?> <span class="caret"></span>
								                    </button>
									                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
									                      
									                        <li>
									                        	<a href="#groups" id="" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_work_group_users/<?php echo $group->fname;?>');">
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