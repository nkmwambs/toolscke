<div class="row">
	<div class="col-xs-12">
		
	<div class="panel panel-primary " data-collapsed="0">
       <div class="panel-heading">
           <div class="panel-title">
              <i class="fa fa-sign-language"></i>
                 <?php echo get_phrase('view_special_funds');?>
           </div>
       </div>
        
       	<div class="panel-body"  style="max-width:50; overflow: auto;">
       		<a href="<?php echo base_url();?>ifms.php/admin/finance_settings" class="btn btn-success btn-icon"><i class="fa fa-reply"></i><?php echo get_phrase('finance_settings');?></a>
       		<hr>
       		<table class="table table-striped" id="special-funds">
       			<thead>
       				<tr>
       					<th>Funds Code</th>
       					<th>Funds Description</th>
       					<th>Revenue Code</th>
       					<th>Revenue Description</th>
       					<th>Start Date</th>
       					<th>End Date</th>
       					<th>Action</th>
       				</tr>
       			</thead>
       			<tbody>
       				<?php
       					$special_funds = $this->db->group_by('specific_fund_code')->where('end_date>=CURDATE()')->get('revenue_control')->result_object();
						
						foreach($special_funds as $fund):
       				?>	
       					<tr>
       						<td><?php echo $fund->specific_fund_code;?></td>
       						<td><?php echo $fund->description;?></td>
       						<td><?php echo $this->db->get_where('revenue',array('revenue_id'=>$fund->revenue_id))->row()->code;?></td>
       						<td><?php echo $this->db->get_where('revenue',array('revenue_id'=>$fund->revenue_id))->row()->name;?></td>
       						<td><?php echo $this->db->select('MIN(start_date) as min_start_date')->get_where('revenue_control',array('specific_fund_code'=>$fund->specific_fund_code))->row()->min_start_date;?></td>
       						<td><?php echo $this->db->select('MAX(end_date) as max_end_date')->get_where('revenue_control',array('specific_fund_code'=>$fund->specific_fund_code))->row()->max_end_date;?></td>
       						<td>
       							<div class="btn-group">
				                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				                        <?php echo get_phrase('action');?> <span class="caret"></span>
				                    </button>
					                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					                    	<li>
					                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_view_associated_projects/<?php echo $fund->revenue_control_id;?>');">
					                            	<i class="fa fa-binoculars"></i>
														<?php echo get_phrase('associated_projects');?>
					                               	</a>
					                        </li>
					                        
					                        <li class="divider"></li>
					                        
					                        <li>
					                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_special_fund/<?php echo $fund->revenue_control_id;?>');">
					                            	<i class="fa fa-pencil"></i>
														<?php echo get_phrase('edit');?>
					                               	</a>
					                        </li>
					                        
					                        <li class="divider"></li>
					                        
					                        <li>
					                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/special_fund/delete/<?php echo $fund->specific_fund_code;?>');">
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
		var datatable = $("#special-funds").DataTable({
			"order": [[ 4, "desc" ]]
		});
	});
</script>