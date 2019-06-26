<div class="row">
	<div class="col-xs-12">
	
		<button onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_add_revenue_account');" class="btn btn-info btn-icon"><i class="fa fa-plus-square"></i><?php echo get_phrase('add_revenue_account');?></button>
		
		<a href="<?php echo base_url();?>ifms.php/admin/new_special_fund/" class="btn btn-info btn-icon"><i class="fa fa-signing"></i><?php echo get_phrase('add_special_fund');?></a>
		
		<a href="<?php echo base_url();?>ifms.php/admin/special_fund/" class="btn btn-info btn-icon"><i class="fa fa-eye"></i><?php echo get_phrase('special_funds_list');?></a>

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
					
					foreach($revenue as $account):
				?>
					<tr>
						<td><?php echo $account->name;?></td>
						<td><?php echo $account->code;?></td>
						<td><?php echo ucfirst($account->state);?></td>
						<td><?php echo ucfirst($account->budgeted);?></td>
						<td>
							<button class="btn btn-primary btn-icon" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_view_expense_account/<?php echo $account->revenue_id;?>');"><i class="fa fa-eye-slash"></i><?php echo get_phrase('view_sub_accounts');?></button>
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