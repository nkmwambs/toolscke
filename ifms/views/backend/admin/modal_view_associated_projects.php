<?php
	$record = $this->db->get_where('revenue_control',array('revenue_control_id'=>$param2))->row();
?>
<div class="row">
	<div class="col-xs-12">
		
	<div class="panel panel-primary " data-collapsed="0">
       <div class="panel-heading">
           <div class="panel-title">
              <i class="fa fa-users"></i>
                 <?php echo get_phrase('associated_projects');?>
           </div>
       </div>
        
       	<div class="panel-body"  style="max-width:50; overflow: auto;">
       	<h4>Associated Projects for <?php echo $record->specific_fund_code;?></h4>
       	
       	<hr>
       		<button class="btn btn-warning btn-icon" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_add_associated_projects/<?php echo $record->revenue_control_id;?>');"><i class="fa fa-plus-circle"></i><?php echo get_phrase('add_projects');?></button>
       	<hr>
       	<table class="table table-striped" id="projects">
       		<thead>
       			<tr>
       				<th>ICP ID</th>
       				<th>Start Date</th>
       				<th>End Date</th>
       				<th>Action</th>
       			</tr>
       		</thead>
       		<tbody>
       			<?php
       				$projects = $this->db->get_where('revenue_control',array('specific_fund_code'=>$record->specific_fund_code))->result_object();
       				
					foreach($projects as $project):
       			?>
       				<tr>
       					<td><?php echo $project->partner_id;?></td>
       					<td><?php echo $project->start_date;?></td>
       					<td><?php echo $project->end_date;?></td>
       					<td>
       						<div class="btn-group">
				                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				                        <?php echo get_phrase('action');?> <span class="caret"></span>
				                    </button>
					                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					                    	<li>
					                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_associated_project/<?php echo $project->revenue_control_id;?>');">
					                            	<i class="entypo-pencil"></i>
														<?php echo get_phrase('edit');?>
					                               	</a>
					                        </li>
					                        
					                        <li class="divider"></li>
					                        
					                        <li>
					                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/special_fund/delete_project/<?php echo $project->revenue_control_id;?>');">
					                            	<i class="entypo-trash"></i>
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

<script>
	$(document).ready(function(){
		var datatable = $('#projects').DataTable();
	});
</script>