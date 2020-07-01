<?php
	$acc = $this->db->get_where('accounts',array("AccNo"=>$AccNo))->row();
					
		//foreach($acc as $acc):
					
			//if($this->finance_model->total_expense_to_date_per_revenue_vote($center_id,$acc->accID,$month)>0){
								
?>
				
							<div id="<?=$acc->AccNo;?>" class="expense_report">
								<caption class="h4"><?=$acc->AccText;?> - <?=$acc->AccName;?> <?=get_phrase('expense_report_as_at_');?> <?=$month;?></caption>
								<table class="table table-striped">
									<thead>
										<tr>
											<th><?=get_phrase('account');?></th>
											<th><?=get_phrase('month_expenses');?></th>
											<th><?=get_phrase('expense_to_date');?></th>
											<th><?=get_phrase('budget_to_date');?></th>
											<th><?=get_phrase('variance');?></th>
											<th><?=get_phrase('percent_variance');?></th>
										</tr>
									</thead>
									<tbody>
										
										<?php
											$expense_account = $this->finance_model->expense_accounts($acc->accID);
											
											$cur_month = 0;
											$accum_exp = 0;
											$budget_to_date = 0;
											$variance = 0;
											$per_varince = 0;
											
											foreach($expense_account as $acc):
										?>
											<tr>
													<td><?=$acc->AccText;?></td>
													<td style="text-align: right;"><?=number_format($this->finance_model->months_expenses_per_expense_account($center_id,$acc->AccNo,$month),2);?></td>
													<td style="text-align: right;"><?=number_format($this->finance_model->months_expenses_to_date_per_expense_account($center_id,$acc->AccNo,$month),2);?></td>
												<?php
													if($this->db->get_where('accounts',array('AccNo'=>$acc->AccNo))->row()->budget==='1'){
												?>
													<td style="text-align: right;">
														<?php echo number_format($this->finance_model->months_budget_to_date_per_expense_account($center_id,get_fy($month,$center_id),$acc->AccNo,$month),2);?>
													</td>
													<td style="text-align: right;">
														<?=number_format($this->finance_model->months_budget_variance_per_expense_account($center_id,get_fy($month,$center_id),$acc->AccNo,$month),2);?>
													</td>
													<td style="text-align: right;">
														<?=number_format($this->finance_model->months_budget_variance_percent_per_expense_account($center_id,get_fy($month,$center_id),$acc->AccNo,$month));?>%
													</td>
												<?php
													}else{
												?>		
													<td colspan="3">XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</td>

												<?php		
													}
												?>
											</tr>    	
										<?php
											$cur_month += $this->finance_model->months_expenses_per_expense_account($center_id,$acc->AccNo,$month);
											$accum_exp += $this->finance_model->months_expenses_to_date_per_expense_account($center_id,$acc->AccNo,$month);
											$budget_to_date += $this->finance_model->months_budget_to_date_per_expense_account($center_id,get_fy($month,$center_id),$acc->AccNo,$month);
											$variance += $this->finance_model->months_budget_variance_per_expense_account($center_id,get_fy($month,$center_id),$acc->AccNo,$month);
											$per_varince = ($variance/$budget_to_date)*100;
											
											endforeach;
										?>
										
									</tbody>
									<tfoot>
									<tr>
										<td><?=get_phrase('total');?></td>
										<td style="text-align: right;"><?=number_format($cur_month,2);?></td>
										<td style="text-align: right;"><?=number_format($accum_exp,2);?></td>
										<td style="text-align: right;"><?=number_format($budget_to_date,2);?></td>
										<td style="text-align: right;"><?=number_format($variance,2);?></td>
										<td style="text-align: right;"><?=number_format($per_varince);?>%</td>
									</tr>
								</tfoot>
								</table>
<?php
			//}
		//endforeach;	
?>		