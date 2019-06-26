<div class="row">
	<div class="col-sm-12">
		<hr/>
			<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_add_budget_limit/<?=$revenue_id;?>/<?=$fyr;?>');" class="btn btn-primary btn-icon"><i class="fa fa-plus-circle"></i><?=get_phrase('add_limit');?></button>
			
			<a href="<?=base_url();?>ifms.php/admin/finance_settings/" class="btn btn-info btn-icon"><i class="fa fa-reply"></i><?=get_phrase('back');?></a>
		<hr/>
		<?php //echo form_open(base_url() . 'ifms.php/admin/scroll_plans_limits/' , array('id'=>'frm_schedule','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
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
						<br/> 
		<!--</form>-->
					
		<hr/>
		<caption class="h4"><?=$this->db->get_where('revenue',array('revenue_id'=>$revenue_id))->row()->code;?> - <?=get_phrase('budget_limits_for_FY');?> <?=$fyr;?></caption>
		  <hr/>
		   <table class="table table-striped display">
		   		<thead>
		   			<tr>
		   				<th><?=get_phrase('project_id');?></th>
		   				<th><?=get_phrase('revenue_account');?></th>
		   				<th><?=get_phrase('limit_description');?></th>
		   				<th><?=get_phrase('amount');?></th>
		   				<th><?=get_phrase('action');?></th>
		   			</tr>
		   		</thead>
		   		<tbody>
		   			<?php
		   				$limits = $this->db->get_where('plans_limits',array('fy'=>$fyr,'revenue_id'=>$revenue_id))->result_object();
						
						foreach($limits as $limit):
		   			?>
		   				<tr>
		   					<td><?=$limit->project_id;?></td>
		   					<td><?=$this->db->get_where('revenue',array('revenue_id'=>$limit->revenue_id))->row()->code;?></td>
		   					<td><?=$limit->limit_description;?></td>
		   					<td style="text-align: right;"><?=number_format($limit->amount,2);?></td>
		   					<td>
		   						<div class="btn-group">
				                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				                        <?php echo get_phrase('action');?> <span class="caret"></span>
				                    </button>
					                   	 <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                   		<li>
						                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_budget_limit/<?php echo $limit->plans_limits_id;?>');">
						                            	<i class="fa fa-pencil"></i>
															<?php echo get_phrase('edit');?>
						                               	</a>
						                        </li>
						                    
						                    	    
						                        <li class="divider"></li>
						                      	
						                      	<li>
						                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/budget_limits/delete/<?php echo $limit->revenue_id;?>/<?php echo $limit->plans_limits_id;?>');">
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

<script>
	$(document).ready(function(){
			$('table.display').DataTable({
			dom: '<Bf><"col-sm-12"rt><ip>',
		    pagingType: "full_numbers",
		    buttons: [
		         'csv', 'excel', 'print'
		    ],
		    stateSave: true
		});
	});
	
		$('.scroll-fy').click(function(){
			var fy = $(this).siblings('input').val();
			
			if($(this).attr('id')==='next_fy'){
				$(this).siblings('input').val(parseInt(fy)+1); 
			}else{
				$(this).siblings('input').val(parseInt(fy)-1);
			}
			
			//alert($(this).siblings('input').val());
			
			$(this).attr('href','<?php echo base_url();?>ifms.php/admin/scroll_plans_limits/'+$(this).siblings('input').val()+'/<?=$revenue_id;?>');
		
		});
</script>