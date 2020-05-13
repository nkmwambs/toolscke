<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-user"></i>
                            <?php echo get_phrase('users');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<table class="table table-striped">
                    		<thead>
                    			<tr>
                    				<th><?=get_phrase('full_name');?></th>
                    				<th><?=get_phrase('email');?></th>
                    				<th><?=get_phrase('action');?></th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php
                    				$users = $this->db->get_where('users',array('project_id'=>$param2,'authentication_key'=>1))->result_object();
                    				
									foreach($users as $user):
                    			?>
                    				<tr>
                    					<td><?=$user->name;?></td>
                    					<td><?=$user->email;?></td>
                    					<td>
                    						<div class="btn-group">
						                    <button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        <?php echo get_phrase('action');?> <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                      
						                        <li>
						                        	<a href="#groups" id="" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_change_work_group/<?php echo $user->users_id;?>');">
						                            	<i class="fa fa-random"></i>
															<?php echo get_phrase('change_work_group');?>
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