<?php
//$start_date = date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->project_system_start_date($project_id))));
//if(isset($closure_date)){
	$start_date = $closure_date;
//}


?>
<div class="row">
		<div class="col-md-8">
			
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-users"></i>
                            <?php echo get_phrase('cash_balances').' '.get_phrase('for').' '.$project_id.' '.get_phrase('as_at').' '.$start_date ;?> 
                        </div>
                    </div>
                    <div class="panel-body">
                    	
                    	<button onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_add_cash_balance/<?=$project_id;?>');" class="btn btn-info btn-icon"><i class="fa fa-plus-circle"></i><?= get_phrase('add_cash_balance');?></button>
                    	
                    	<a href="<?php echo base_url();?>ifms.php/admin/opening_balances" class="btn btn-info btn-icon"><i class="fa fa-mail-reply-all"></i><?=get_phrase('back');?></a>
                    	<hr/>
                    	
                    	<table class="table table-stripped datatable">
                    		<thead>
                    			<tr>
                    				<th><?= get_phrase('account');?></th>
                    				<th  style="text-align: right;"><?= get_phrase('amount');?></th>
                    				<th style="text-align: right;"><?= get_phrase('action');?></th>
                    			</tr>
                    		</thead>
							<tbody>
								<?php
									
									$total_funds = 0;
									
									$cash_balance = $this->db->get_where('cashbal',array('icpNo'=>$project_id,'month'=>$start_date))->result_object();
									
									foreach($cash_balance as $row):
								?>
									<tr>
										<td><?php if($row->accNo==='BC'){echo 'Cash at Bank';}else{echo 'Petty Cash';};?></td>
										<td style="text-align: right;"><?= number_format($row->amount,2); $total_funds+=$row->amount;?></td>
										<td  style="text-align: right;">
											
										<div class="btn-group">
					                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
					                        Action <span class="caret"></span>
					                    </button>
					                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					                    	
					                        <!-- Edit -->
					                        <li>
					                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_cash_balance/<?php echo $row->balID;?>');">
					                            	<i class="entypo-pencil"></i>
														<?php echo get_phrase('edit');?>
					                               	</a>
					                        </li>
					                        <li class="divider"></li>
					                       									
											
					                        <!--Delete-->
					                        <li>
					                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/opening_cash_balance/delete/<?php echo $row->balID;?>');">
					                            	<i class="fa fa-eraser"></i>
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
								<tr><td style="font-weight: bold;"><?= get_phrase('total');?></td><td style="text-align: right;"><?= number_format($total_funds,2);?></td>
									
									<td>&nbsp;</td></tr>
							</tbody>
                    	</table>
					</div>
				</div>
		</div>
</div>	