<?php 

$expense_accounts = $this->db->where(array('parentAccID'=>$param2))->get('accounts')->result_object();

?>
<div class="row">
	<div class="col-xs-12">
		
	<div class="panel panel-primary " data-collapsed="0">
       <div class="panel-heading">
           <div class="panel-title">
              <i class="fa fa-binoculars"></i>
                 <?php echo get_phrase('exepense_accounts');?>
           </div>
       </div>
        
       <div class="panel-body"  style="max-width:50; overflow: auto;">
		
			<div class="btn btn-primary btn-icon" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_new_expense_account/<?php echo $param2;?>');">
				<i class="entypo-plus-squared"></i><?php echo get_phrase('new_sub_account');?>
			</div>
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Short Code</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($expense_accounts as $row):?>
						<tr>
							<td><?php echo $row->AccName;?></td>
							<td><?php echo $row->AccText;?></td>
							<td>
								<div class="btn-group">
				                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				                        Action <span class="caret"></span>
				                    </button>		
				                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">	                        
				                        <!--Edit Sub Account -->
				                        <li>
				                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_expense_account/<?php echo $row->accID;?>');">
				                            	<i class="glyphicon glyphicon-edit"></i>
													<?php echo get_phrase('edit_sub_account');?>
				                               	</a>
				                       	</li>
				                        <!--Delete Sub Account -->
				                        <li class="divider"></li>
				                        <li>
				                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/finance_settings/delete_expense_account/<?php echo $row->accID;?>');">
				                            	<i class="entypo-trash"></i>
													<?php echo get_phrase('delete_sub_account');?>
				                               	</a>
				                       	</li>
				                     	
				                     </ul>
			                     </div>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

</div>

</div>	

