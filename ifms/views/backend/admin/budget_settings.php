<div class="row">
	<div class="col-sm-12">
		<!--Tabs Control-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
				<a href="#budget_limits" data-toggle="tab"><i class="fa fa-chain-broken"></i>
					<?=get_phrase('budget_limits');?>
				</a>
			</li>
			
			<li class="">
				<a href="#budget_item_tags" data-toggle="tab"><i class="fa fa-tags"></i>
					<?=get_phrase('budget_item_tags');?>
				</a>
			</li>
			
		</ul>
		
		<div class="tab-content">
				
				<div class="tab-pane box active" id="budget_limits" style="padding: 5px">
	                <div class="box-content padded">
	                	<hr/>
	                	<?php echo form_open(base_url() . 'ifms.php/partner/create_budget_item' , array('id'=>'frm_schedule','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
							 <div class="form-group">
							 	<label class="control-label col-sm-3"><?=get_phrase('financial_year');?></label> 
							  	<div class="col-sm-4">
								  <div class="input-group col-sm-5 col-sm-offset-1">
								    <a href="" id="prev_fy" class="input-group-addon scroll-fy"><i class="glyphicon glyphicon-minus"></i></a>
								    <input id="scrolled_fy" value="<?=$fyr;?>" type="text" class="form-control text-center" name="scrolled_fy" placeholder="FY" readonly="readonly">
								    <a href="" id="next_fy" class="input-group-addon scroll-fy"><i class="glyphicon glyphicon-plus"></i></a>
								  </div>
								</div>
							</div>  
						</form> 
	                	<hr/>
	                	<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_add_plan_limit/<?=$fyr;?>')" class="btn btn-primary btn-icon"><i class="fa fa-plus-square-o"></i><?=get_phrase('add_a_limit');?></button>
	                	<hr/>
	                	<table class="table table-striped settings">
	                		<thead>
	                			<tr>
	                				<th><?=get_phrase('project_id');?></th>
	                				<th><?=get_phrase('description');?></th>
	                				<th><?=get_phrase('revenue_account');?></th>
	                				<th><?=get_phrase('financial_year');?></th>
	                				<th><?=get_phrase('amount');?></th>
	                				<th><?=get_phrase('action');?></th>
	                			</tr>
	                		</thead>
	                		<tbody>
	                			<?php
	                				$limits = $this->db->get_where('plans_limits',array('fy'=>$fyr))->result_object();
									
									foreach($limits as $row):
	                			?>
	                				<tr>
	                					<td><?=$row->icpNo;?></td>
	                					<td><?=$row->limit_description;?></td>
	                					<td><?=$this->db->get_where('accounts',array('accID'=>$row->revenue_id))->row()->AccText;?></td>
	                					<td><?=$row->fy;?></td>
	                					<td><?=number_format($row->amount,2);?></td>
	                					<td>
	                						<div class="btn-group">
							                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
							                        Action <span class="caret"></span>
							                    </button>
								                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
								                    	
								                        <!-- Edit -->
								                        <li>
								                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_plan_limits/<?php echo $row->plans_limits_id;?>');">
								                            	<i class="entypo-pencil"></i>
																	<?php echo get_phrase('edit');?>
								                               	</a>
								                        </li>
								                        <li class="divider"></li>
								                       									
														
								                        <!--Deactivate Project-->
								                        <li>
								                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/budget_settings/delete_limit/<?php echo $row->plans_limits_id;?>/<?php echo $fyr;?>');">
								                            	<i class="entypo-cancel"></i>
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
	             
	             
	             <div class="tab-pane box" id="budget_item_tags" style="padding: 5px">
	                <div class="box-content padded">
	                	<hr/>
	                	<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_add_plan_tag/<?=$fyr;?>');" class="btn btn-primary btn-icon"><i class="fa fa-plus-square-o"></i><?=get_phrase('add_a_tag');?></button>
	                	<hr/>
	                	<table class="table table-striped settings">
	                		<thead>
	                			<tr>
	                				<th><?=get_phrase('supervisory_level');?></th>
	                				<th><?=get_phrase('budget_tag');?></th>
	                				<th><?=get_phrase('tag_status');?></th>
	                				<th><?=get_phrase('action');?></th>
	                			</tr>
	                		</thead>
	                		<tbody>
	                			<?php
	                				$tags = $this->db->get('plan_item_tag')->result_object();
									//print_r($tags);
									
									foreach($tags as $row_tag):
	                			?>
	                				<tr>
	                					<td><?=$this->db->get_where('clusters',array('clusters_id'=>$row_tag->cluster_id))->row()->clusterName;?></td>
	                					<td><?=$row_tag->name;?></td>
	                					<td><?=$row_tag->status==='0'?'Inactive':'Active';?></td>
	                					<td>
	                						<div class="btn-group">
							                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
							                        Action <span class="caret"></span>
							                    </button>
								                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
								                    	
								                        <!-- Edit -->
								                        <li>
								                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_plan_tag/<?php echo $row_tag->plan_item_tag_id;?>/<?php echo $fyr;?>');">
								                            	<i class="entypo-pencil"></i>
																	<?php echo get_phrase('edit');?>
								                               	</a>
								                        </li>
								                        <li class="divider"></li>
								                       									
														
								                        <!--Deactivate Project-->
								                        <li>
								                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/budget_settings/delete_tag/<?php echo $row_tag->plan_item_tag_id;?>/<?php echo $row_tag->plan_item_tag_id;?>/<?=$fyr;?>');">
								                            	<i class="entypo-cancel"></i>
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
	$('.scroll-fy').click(function(){
		var fy = $(this).siblings('input').val();
		
		if($(this).attr('id')==='next_fy'){
			$(this).siblings('input').val(parseInt(fy)+1); 
		}else{
			$(this).siblings('input').val(parseInt(fy)-1);
		}
		
		
		$(this).attr('href','<?php echo base_url();?>ifms.php/admin/budget_settings/scroll/'+$(this).siblings('input').val());
		
	});
	
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