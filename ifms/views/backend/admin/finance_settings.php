<div class="row">
	<div class="col-xs-12">
	
		<button onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_add_revenue_account');" class="btn btn-info btn-icon"><i class="fa fa-plus-square"></i><?php echo get_phrase('add_revenue_account');?></button>
		<!--
		<a href="<?php echo base_url();?>ifms.php/admin/new_special_fund/" class="btn btn-info btn-icon"><i class="fa fa-signing"></i><?php echo get_phrase('add_special_fund');?></a>
		
		<a href="<?php echo base_url();?>ifms.php/admin/special_fund/" class="btn btn-info btn-icon"><i class="fa fa-eye"></i><?php echo get_phrase('special_funds_list');?></a>
		-->
		<hr/>
		<table class="table table-hover table-striped" id="datatable">
			<thead>
				<tr>
					<th><?php echo get_phrase('account_name');?></th>
					<th><?php echo get_phrase('account_code');?></th>
					<th><?php echo get_phrase('account_state');?></th>
					<th><?php echo get_phrase('budget_required?');?></th>
					<th><?php echo get_phrase('action');?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$revenue = $this->finance_model->revenue_accounts();
					//print_r($revenue);
					foreach($revenue as $account):
				?>
					<tr>
						<td><?php echo $account->AccName;?></td>
						<td><?php echo $account->AccText;?></td>
						<?php
							$state = array('locked','active');
							$budget = array('no','yes')
						?>
						<td><?php echo ucfirst($state[$account->Active]);?></td>
						<td><?php echo ucfirst($budget[$account->budget]);?></td>
						<td>
							<div class="btn-group">
			                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
			                        <?php echo get_phrase('action');?> <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
			                   		<li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_view_expense_account/<?php echo $account->accID;?>');">
			                            	<i class="fa fa-binoculars"></i>
												<?php echo get_phrase('view');?>
			                               	</a>
			                        </li>
			                    
			                    	    
			                        <li class="divider"></li>
			                   	
			                   		
			                   		<li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_revenue_account/<?php echo $account->accID;?>');">
			                            	<i class="fa fa-pencil"></i>
												<?php echo get_phrase('edit');?>
			                               	</a>
			                        </li>
			                        <?php
			                        	//if($this->finance_model->check_budgeted_revenue_account($account->accID)==='1'){
			                        ?>
			                        
			                        <li class="divider"></li>
			                   		
			                        
			                        <?php
			                        	
										//}
			                        	
			                         	if($this->finance_model->expense_accounts_association($account->AccNo)==='0'){
			                         	
			                        ?>
			                        
			                        <li class="divider"></li>
			                   		
			                   		<li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/finance_settings/delete_revenue/<?php echo $account->accID;?>');">
			                            	<i class="fa fa-times"></i>
												<?php echo get_phrase('delete');?>
			                               	</a>
			                        </li>			                        
			                        
			                        <?php } ?>
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
	var datatable = $('#datatable').DataTable({
			dom: '<Bf><"col-sm-12"rt><ip>',
		    pagingType: "full_numbers",
		    buttons: [
		         'csv', 'excel', 'print'
		    ],
		    stateSave: true
	});
});
</script>