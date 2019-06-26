<?php
$proof_of_cash_check = $this->finance_model->proof_of_cash($this->session->center_id,date('Y-m-01',strtotime($param2)));
$proof_chk = get_phrase('proof_of_cash_successful');
//$proof_color = "success";
if($proof_of_cash_check <> 0){
	$proof_chk = get_phrase('proof_of_cash_failure');
	//$proof_color = "warning";
}


$bank_reconcile_check = $this->finance_model->bank_reconciled($this->session->center_id,date('Y-m-01',strtotime($param2)));
$rec_chk = get_phrase('bank_reconciled_successful');
//$rec_color = "success";
if($bank_reconcile_check<>0){
	$rec_chk = get_phrase('bank_reconciliation_failure');
	//$rec_color = "warning";
}

$bs_chk = $this->finance_model->check_bank_statement($this->session->center_id,date('Y-m-01',strtotime($param2)));
$bs_comment = get_phrase('bank_statement_missing');
if($bs_chk<>0){
	$bs_comment = get_phrase('bank_statement_available');
}

$status_message = get_phrase('financial_report_not_submitted');
$status_color = 'red';

if($this->finance_model->editable($this->session->center_id,date('Y-m-t',strtotime($param2)))===1){
	$status_message = get_phrase('financial_report_submitted');
	$status_color = 'info';
}elseif($this->finance_model->editable($this->session->center_id,date('Y-m-t',strtotime($param2)))===2){
	$status_message = get_phrase('financial_report_reviewed');
	$status_color = 'success';	
}

?>
<style>
	@media screen{
		.print-only{
       		 display: none;
    	}
	}
	
	@media print {
	    div.break {page-break-after: always;},
	    .print-only
		 	{
            	display: block;
        	}
	}
</style>
<div class="row">
		<div class="col-sm-12">
	
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('financial_report');?>
            	</div>
            	
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
			
				<button class="btn btn-info btn-icon" onclick="PrintElem('#tab-content');"><i class="fa fa-print"></i><?=get_phrase('print');?></button>
				
				<button class="btn btn-success btn-icon" onclick="submit_financial_report('<?=strtotime($param2);?>');"><i class="fa fa-flag"></i><?=get_phrase('submit_report');?></button>
				
				<hr/>
				
				<span class="label label-<?=$status_color;?>"><?=$status_message;?></span>
				
				<hr/>
			
				<div class="row">
					<div class="col-md-12">
					
						<div class="tabs-vertical-env">
						
							<ul class="nav tabs-vertical">
								<li class="active">
									<a href="#fund_balance_report" data-toggle="tab"><?php echo get_phrase('fund_balance_report');?></a>
								</li>
								<li>
									<a href="#monthly_expense_report" data-toggle="tab"><?php echo get_phrase('monthly_expense_report');?></a>
								</li>
								<li>
									<a href="#financial_ratios" data-toggle="tab"><?php echo get_phrase('financial_ratios');?></a>
								</li>
								<li>
									<a href="#proof_of_cash_balance" data-toggle="tab"><?php echo get_phrase('proof_of_cash_balance');?></a>
								</li>
								<li>
									<a href="#outstanding_cheques" data-toggle="tab"><?php echo get_phrase('outstanding_cheques');?></a>
								</li>
								<li>
									<a href="#deposit_in_transit" data-toggle="tab"><?php echo get_phrase('deposit_in_transit');?></a>
								</li>
								<li>
									<a href="#bank_reconciliation" data-toggle="tab"><?php echo get_phrase('bank_reconciliation');?></a>
								</li>				
								<li>
									<a href="#variance_explanation" data-toggle="tab"><?php echo get_phrase('variance_explanation');?></a>
								</li>	
								<li>
									<a href="#bank_statements" data-toggle="tab"><?php echo get_phrase('bank_statements');?></a>
								</li>	
											
							</ul>
							
							<div class="tab-content" id="tab-content">
								
											<div class="tab-pane active" id="fund_balance_report">
												
												<div class="print-only row col-sm-8">
													<span style="font-weight: bold;font-size: 15pt;"><?=get_phrase('financial_report_validation');?></span><hr/>
													
													<div class="form-group">
														<label class="control-label"><?php echo get_phrase('proof_of_cash_validation');?></label>
														<input class="form-control" type="text" name="fund_validate" id='fund_validate' value="<?php echo $rec_chk;?>" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
													</div>
													
													<div class="form-group">
														<label class="control-label"><?php echo get_phrase('bank_reconcilliation_validation');?></label>
														<input class="form-control" type="text" id="bank_validate" name="bank_validate" value="<?php echo $proof_chk;?>" readonly/>
													</div>	
													
													<div class="form-group">
														<label class="control-label"><?php echo get_phrase('bank_statement_uploaded');?></label>
														<input class="form-control" type="text" id="statement_uploaded" name="statement_uploaded" value="<?php echo $bs_comment;?>" readonly/>
													</div>	
					
													<div class="form-group">
														<label class="control-label"><?php echo get_phrase('submitting_status');?></label>
														<input class="form-control" type="text" id="statement_uploaded" name="statement_uploaded" value="<?php echo $status_message;?>" readonly/>
													</div>	
													
												</div>
												
												<div class="row col-sm-8">
												<!--<span style="font-weight: bold;font-size: 15pt;"><?=get_phrase('fund_balance_report');?></span><hr/>-->
												<table class="table table-striped">
														<thead>
															<tr>
																<th colspan="5" style="font-weight: bold;font-size: 15pt;">
																	<?php echo get_phrase('fund_balance_report');?> 
																</th>
															</tr>
															<tr>
																<th><?php echo get_phrase('fund');?></th>
																<th><?php echo get_phrase('beginning_balance');?></th>
																<th><?php echo get_phrase('month_income');?></th>
																<th><?php echo get_phrase('month_expenses');?></th>
																<th><?php echo get_phrase('ending_balance');?></th>
															</tr>
														</thead>
														<tbody>
															<?php
																$rec_accs = $this->db->get('revenue')->result_object();
																
																foreach($rec_accs as $row):
																	if(
																		$this->finance_model->months_opening_fund_balances($this->session->center_id,$row->revenue_id,$param2)<>0
																		||
																		$this->finance_model->months_closing_fund_balance_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2)<>0
																		||
																		$this->finance_model->months_incomes_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2)<>0
																		||
																		$this->finance_model->months_expenses_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2)<>0
																	){
															?>
																<tr>
																	<td><?=$row->code;?> - <?=$row->name;?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->months_opening_fund_balances($this->session->center_id,$row->revenue_id,$param2),2);?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->months_incomes_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2),2);?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->months_expenses_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2),2);?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->months_closing_fund_balance_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2),2);?></td>
																</tr>
															<?php
																	}
																endforeach;
															?>
														</tbody>
														<tfoot>
															<tr>
																<td><?=get_phrase('total');?></td>
																<td style="text-align: right;"><?=number_format($this->finance_model->total_months_opening_revenues($this->session->center_id,$param2),2);?></td>
																<td style="text-align: right;"><?=number_format($this->finance_model->total_months_incomes($this->session->center_id,$param2),2);?></td>
																<td style="text-align: right;"><?=number_format($this->finance_model->total_months_expenses($this->session->center_id,$param2),2);?></td>
																<td style="text-align: right;"><?=number_format($this->finance_model->total_months_closing_balance($this->session->center_id,$param2),2);?></td>
															</tr>
														</tfoot>
											</table>		
												</div>	
											</div>
											
											<div class="break"></div>
											
											<div class="tab-pane" id="monthly_expense_report">
												<div class="row col-sm-8">
												<?php
														$acc = $this->db->get('revenue')->result_object();
														
														foreach($acc as $row):
														
														if($this->finance_model->total_expense_to_date_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2)>0){
																	
													?>
														<div id="<?=$row->code;?>" class="expense_report">
														<span style="font-weight: bold;font-size: 15pt;"><?=$row->code;?> - <?=$row->name;?> <?=get_phrase('expense_report_as_at_');?> <?=$param2;?></span><hr/>
														
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
																	$expense_account = $this->finance_model->expense_accounts($row->revenue_id);
																	
																	foreach($expense_account as $acc):
																?>
																	<tr>
																		<td><?=$acc->code;?></td>
																		<td style="text-align: right;"><?=number_format($this->finance_model->months_expenses_per_expense_account($this->session->center_id,$acc->expense_id,$param2),2);?></td>
																		<td style="text-align: right;"><?=number_format($this->finance_model->months_expenses_to_date_per_expense_account($this->session->center_id,$acc->expense_id,$param2),2);?></td>
																		
																		<?php
																			if($this->db->get_where('revenue',array('revenue_id'=>$row->revenue_id))->row()->budgeted==='yes'){
																		?>
																			
																		<td style="text-align: right;"><?=number_format($this->finance_model->months_budget_to_date_per_expense_account($this->session->center_id,get_fy($param2,$this->session->center_id),$acc->expense_id,$param2),2);?></td>
																		<td style="text-align: right;"><?=number_format($this->finance_model->months_budget_variance_per_expense_account($this->session->center_id,get_fy($param2,$this->session->center_id),$acc->expense_id,$param2),2);?></td>
																		<td style="text-align: right;"><?=number_format($this->finance_model->months_budget_variance_percent_per_expense_account($this->session->center_id,get_fy($param2,$this->session->center_id),$acc->expense_id,$param2));?>%</td>
																		
																		<?php
																			}else{
																		?>
																			<td colspan="3">XXXXXXXXXXXXXXXXXXXXXXXXXX</td>
																				
																		<?php		
																			}
																		?>
																	</tr>
																<?php
																	endforeach;
																?>
															</tbody>
															<tfoot>
																<tr>
																	<td><?=get_phrase('total');?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->months_expenses_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2),2);?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->total_expense_to_date_per_revenue_vote($this->session->center_id,$row->revenue_id,$param2),2);?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->total_budget_to_date_per_revenue_vote($this->session->center_id,get_fy($param2,$this->session->center_id),$row->revenue_id,$param2),2);?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->total_variance_per_revenue_vote($this->session->center_id,get_fy($param2,$this->session->center_id),$row->revenue_id,$param2),2);?></td>
																	<td style="text-align: right;"><?=number_format($this->finance_model->total_variance_percent_per_revenue_vote($this->session->center_id,get_fy($param2,$this->session->center_id),$row->revenue_id,$param2));?>%</td>
																</tr>
															</tfoot>
														</table>
														</div>
													<?php
														}
														
														endforeach;
													?>
													</div>
											</div>
											
											<div class="break"></div>
											
											<div class="tab-pane" id="financial_ratios">
												<div class="row col-sm-8">
													
												</div>
																	
											</div>
											
											<!--<div class="break"></div>-->
							
											<div class="tab-pane" id="proof_of_cash_balance">
												<div class="row col-sm-8">
													<span style="font-weight: bold;font-size: 15pt;"><?=get_phrase('proof_of_cash_balance');?></span><hr/>
													<table class="table table-hover">
														<thead>
															<tr>
																<th><?php echo get_phrase('petty_cash');?></th>
																<th><?php echo get_phrase('cash_at_bank');?></th>
																<th><?php echo get_phrase('total');?></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><?php echo $this->finance_model->petty_cash_balance(date('Y-m-01',strtotime($param2)),$this->session->center_id);?></td>
																<td><?php echo $this->finance_model->bank_balance(date('Y-m-01',strtotime($param2)),$this->session->center_id);?></td>
																<td><?php echo $this->finance_model->total_cash(date('Y-m-01',strtotime($param2)),$this->session->center_id);?></td>
															</tr>
														</tbody>
														<tfoot>
															<tr>
																<td colspan="3">
																	<?php
																		if($this->finance_model->proof_of_cash($this->session->center_id,date('Y-m-01',strtotime($param2)))<>0){
																	?>
																		<div class="label label-danger"><?=get_phrase('proof_of_cash_failure');?></div>
																	<?php
																		}else{
																	?>
																		<div class="label label-success"><?=get_phrase('proof_of_cash_successful');?></div>
																	<?php
																		}
																	?>
																</td>
															</tr>
														</tfoot>
													</table>
												</div>
																	
											</div>
										
											<div class="break"></div>
											
											<div class="tab-pane" id="outstanding_cheques">
												<div class="row col-sm-8">
													<?php
													//Outstanding Cheques
													
													$mfr_submitted = $this->finance_model->editable($this->session->center_id,date('Y-m-d',strtotime($param2)));
													
													$oc=$this->finance_model->outstanding_cheques($param2,$this->session->center_id);
													
													?>
												<span style="font-weight: bold;font-size: 15pt;"><?=get_phrase('outstanding_cheques');?></span><hr/>
													<table class="table table-hover" id="ocTable">
														<thead>
															<tr>
																<!--<th><?php echo get_phrase('action');?></th>-->
																<th><?php echo get_phrase('date');?></th>
																<th><?php echo get_phrase('cheque_number');?></th>
																<th><?php echo get_phrase('details');?></th>
																<th><?php echo get_phrase('amount');?></th>
															</tr>
														</thead>
														<body>
															<?php
																$oc_total = 0;
																foreach($oc as$row):
																	$chq=explode('-',$row['ChqNo']);
															?>
																<tr>
																	<!--<td><div <?php if($mfr_submitted===1){echo "style='display:none;'";};?> class="btn btn-danger chqClr"  id='oc_<?php echo $row['hID'];?>'><?php echo get_phrase('clear');?></div></td>-->
																	<td><?php echo $row['TDate']?></td>
																	<td><?php  echo $chq[0];?></td>
																	<td><?php echo $row['TDescription']?></td>
																	<td><?php echo $row['totals']?></td>
																</tr>
															<?php
																$oc_total+=$row['totals'];
																endforeach;
															?>
															<tr><td><?php echo get_phrase('total');?></td><td id="ocTotal" colspan="4" style="text-align: right;"><?php echo number_format($oc_total,2);?></td></tr>
														</body>
													</table>
												</div>
																	
											</div>				
											
											<div class="break"></div>
											
											<div class="tab-pane" id="deposit_in_transit">
												<div class="row col-sm-8">
												<span style="font-weight: bold;font-size: 15pt;"><?=get_phrase('deposit_in_transit');?></span><hr/>
													<?php
													//Deposit in Transit
													
													$mfr_submitted = $this->finance_model->editable($this->session->center_id,date('Y-m-d',strtotime($param2)));
													
													$dep = $this->finance_model->deposit_transit($param2,$this->session->center_id);
													?>
													<table class="table table-hover" id="depTable">
														<thead>
															<tr>
																<!--<th><?php echo get_phrase('action');?></th>-->
																<th><?php echo get_phrase('date');?></th>
																<th><?php echo get_phrase('details');?></th>
																<th><?php echo get_phrase('amount');?></th>									
															</tr>								
														</thead>
														<tbody>
																<?php
																	$depTotal = 0;
																	foreach($dep as $row):
																?>
															<tr>
							
																<!--<td><div <?php if($mfr_submitted===1){echo "style='display:none;'";};?>  class="btn btn-danger depClr" id="dep_<?php echo $row['hID'];?>"><?php echo get_phrase('clear');?></div></td>-->
																<td><?php echo $row['TDate']?></td>
																<td><?php echo $row['TDescription']?></td>
																<td><?php echo $row['totals']?></td>
															</tr>
															
															<?php
																$depTotal +=$row['totals'];
																endforeach;
															?>
														<tr><td><?php echo get_phrase('total');?></td><td id="depTotal" colspan="4" style="text-align: right;"><?php echo number_format($depTotal,2);?></td></tr>									
														</tbody>
													</table>							
												</div>
																	
											</div>				
												
											<div class="break"></div>
															
											<div class="tab-pane" id="bank_reconciliation">
												
												<div class="row col-sm-8">
													<span style="font-weight: bold;font-size: 15pt;"><?=get_phrase('bank_reconciliation_statement');?></span><hr/>
													<?php
			
													$mfr_submitted = $this->finance_model->editable($this->session->center_id,date('Y-m-d',strtotime($param2)));
													
													$statement = $this->finance_model->statement_balance($param2,$this->session->center_id);
													
													?>
													
														<div class="form-group">
															<label class="control-label"><?php echo get_phrase('bank_statement_date');?></label>
																<input readonly="readonly"  type="text" name="bsDate" id="bsDate" value="<?php echo $statement->statementDate;?>" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" data-format="yyyy-mm-dd" data-start-date="<?php echo date('Y-m-t',strtotime($param2));?>" data-end-date="<?php echo date('Y-m-t',strtotime($param2));?>">							
														</div>
														
														<div class="form-group">
															<label class="control-label"><?php echo get_phrase('journal_bank_balance');?></label>
															<input class="form-control" type="text" id=''  value="<?=round($this->finance_model->bank_balance($param2,$this->session->center_id),2)?>" readonly/>
														</div>	
														
														<div class="form-group">
															<label class="control-label"><?php echo get_phrase('statement_bank_balance');?></label>
															<input readonly="readonly" class="form-control" type="text" name="bankBal" id='bankBal' value="<?php echo $statement->amount;?>" data-validate="number,minlength[1],required" data-message-required="<?php echo get_phrase('value_required');?>"/>
														</div>
														
														<div class="form-group">
															<label class="control-label"><?php echo get_phrase('plus_deposit_in_transit');?></label>
															<input class="form-control" type="text" id="depTransit" name="depTransit" value="<?php echo $this->finance_model->sum_deposit_transit($param2,$this->session->center_id);?>" readonly/>
														</div>
														<div class="form-group">
															<label class="control-label"><?php echo get_phrase('less_outstanding_cheques');?></label>
															<input class="form-control" type="text" id='osChq' name="osChq"  value="<?php echo $this->finance_model->sum_outstanding_cheques($param2,$this->session->center_id);?>" readonly/>
														</div>
														<div class="form-group">
															<label class="control-label"><?php echo get_phrase('adjusted_bank_balance');?></label>
															<input class="form-control" type="text" id='adjBal' name="adjBal"  value="0" readonly/>
														</div>
															<?php
																if($this->finance_model->bank_reconciled($this->session->center_id,date('Y-m-01',strtotime($param2)))<>0){
															?>
																<div class="label label-danger"><?=get_phrase('bank_reconciliation_failure');?></div>
															<?php
																}else{
															?>
																<div class="label label-success"><?=get_phrase('bank_reconciled_successful');?></div>
															<?php
																}
															?>										
												</div>					
											</div>								
											
											<div class="break"></div>
														
											<div class="tab-pane" id="variance_explanation">
												<div class="row col-sm-8">
													<?php
													
													$rev_acc = $this->finance_model->budgeted_revenue_accounts();
													foreach($rev_acc as $rev):
													?>
													<span style="font-weight: bold;font-size: 15pt;"><?=$rev->code?> - <?=$rev->name;?> <?=get_phrase('variance_explanation');?></span><hr/>
													<table class="table table-hover">
														<thead>
															<tr>
																<td><?php echo get_phrase('account');?></td>
																<td><?php echo get_phrase('variance');?></td>
																<td><?php echo get_phrase('%_variance');?></td>
																<td><?php echo get_phrase('explanation');?></td>
															</tr>
														</thead>
														<tbody>
															<?php 
																$counter = 0;
																$exp = $this->db->get_where('expense',array('revenue_id'=>$rev->revenue_id))->result_object();
																foreach($exp as $row):
																
																$per_var = $this->finance_model->months_budget_variance_percent_per_expense_account($this->session->center_id,get_fy($param2,$this->session->center_id),$row->expense_id,$param2);//$this->finance_model->percentage_budget_variance_per_account($param2,$row['AccNo']);
																$var = $this->finance_model->months_budget_variance_per_expense_account($this->session->center_id,get_fy($param2,$this->session->center_id),$row->expense_id,$param2);//$this->finance_model->budget_variance_per_account($param2,$row['AccNo']);
																
																if(($per_var>10||$per_var<-10)&& $var !==0){
															?>
							
																	<tr>
																		<td><?php echo $row->code." - ".$row->name;?></td>
																		<td><?php echo number_format($var,2);?></td>
																		<td><?php echo number_format($per_var,2)."%";?></td>
																		<td>
																			<div class="form-group">
																				<?php
																					$var_statement = "";//$this->db->get_where('varjustify',array('icpNo'=>$this->session->icp_no,'reportMonth'=>$param2,'AccNo'=>$row['AccNo']))->row()->Details;
																					
																					if($this->db->get_where('varjustify',array('project_id'=>$this->session->center_id,'reportMonth'=>$param2,'AccNo'=>$row->expense_id))->num_rows()>0){
																						$var_statement = $this->db->get_where('varjustify',array('project_id'=>$this->session->center_id,'reportMonth'=>$param2,'AccNo'=>$row->expense_id))->row()->Details;
																					}
																					
																				?>
																				<div class="well well-primary"><?=$var_statement;?></textarea>
																			</div>
																		</td>
																	</tr>
																
															<?php 
																}else{
																	
															?>
																<tr>
																	<td><?php echo $row->code." - ".$row->name;?></td>
																	<td><?php echo number_format($var,2);?></td>
																	<td><?php echo number_format($per_var,2)."%";?></td>
																	
																	<td><div class="well well-primary">Variance is within the acceptable limit</div></td>
																	
																</tr>
															<?php
																		
															} 
																$counter++;
																endforeach;
															?>
														</tbody>
													</table>
													<?php
														endforeach;
													?>
												</div>
																	
											</div>							
											
											<div class="break"></div>
											
											<div class="tab-pane" id="bank_statements">
												<div class="row col-sm-8">
													<span style="font-weight: bold;font-size: 15pt;"><?=get_phrase('bank_statements');?></span>
													<table class="table table-hover table-striped">
								                	<thead>
								                		<tr>
								                			<th><?= get_phrase('bank_statement');?></th>
								                			<th><?= get_phrase('upload_date');?></th>
								                			<th><?= get_phrase('file_size');?></th>
								                			<th></th>
								                		</tr>
								                	</thead>
								                	<tbody>
								                		<?php 
								                			if(file_exists('uploads/bank_statements/'.$this->session->center_id.'/'.date('Y-m',strtotime($param2)).'/')){
								                			$map = directory_map('uploads/bank_statements/'.$this->session->center_id.'/'.date('Y-m',strtotime($param2)).'/', FALSE, TRUE);
															
								                			foreach($map as $row): $prop = (object)get_file_info('uploads/bank_statements/'.$this->session->center_id.'/'.date('Y-m',strtotime($param2)).'/'.$row);
								                		?>
									                		<tr>
									                			<td><a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/partner/bank_statement_download/<?= $row;?>/<?=strtotime($param2);?>');"><?= $row;?></a></td>
									                			<td><?= date('d-m-Y',$prop->date);?></td>
									                			<td><?= number_format(($prop->size/1000000),2).' MB';?></td>
									                		</tr>
								                		<?php 
								                			endforeach;
															}
								                		?>
								                	</tbody>
								                </table>
													
												
												</div>	
												
												<div class="row print-only col-sm-8">
												<span style="font-weight: bold;font-size: 25pt;"><?=get_phrase('signed_herein_below_by_us,_the_project_representatives:');?></span>
												
												<table class="table table-striped" style="width: 100%;font-size: 25pt;">
													<thead>
														<tr>
															<th style="width: 20%;"><?=get_phrase('role');?></th>
															<th><?=get_phrase('name');?></th>
															<th style="width: 20%;"><?=get_phrase('date');?></th>
															<th style="width: 20%;"><?=get_phrase('signature');?></th>
														</tr>
													</thead>
													<tbody>
														<?php
														for($i=0;$i<3;$i++):
															$id = $i+1;
														?>
															<tr>
																<td><?=get_phrase('project_manager')." ".$id;?></td>
																<td>&nbsp;</td>
																<td><?=date('d-m-Y');?></td>
																<td>&nbsp;</td>
															</tr>
														<?php
														endfor;
														?>
														
													</tbody>
												</table>
											</div>
														
											</div>					
											
										</div>
											
											
										
									</div>		
								</div>
															
						</div>
					</div>	
</div>

		</div>
	</div>	
</div>

<script>
	
	function submit_financial_report(dt){
		var url = '<?=base_url();?>ifms.php/partner/submit_mfr/<?=$this->session->center_id;?>/'+dt;
		$.ajax({
			url:url,
			success:function(data){
				alert(data);
			},
			error:function(error){
				alert(error);
			}
		});
	}
	
	$(document).ready(function(){
		if($('#bankBal').val()>0){
			var dep = $('#depTransit').val();
			var oc = $('#osChq').val();
			var adj = parseFloat($('#bankBal').val())+parseFloat(dep)-parseFloat(oc);
			$('#adjBal').val(adj);
		}
		
	});
	
	function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: ".",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: '<h2 style="text-align:center;">'+
		    		'<?=$this->session->center_id;?> <?php echo get_phrase('financial_report');?>'+
		    		'<br/><?=get_phrase('for_the_period_ending_')?> <?=date('t-m-Y',strtotime($param2));?></h2><hr/>',             
		    formValues: true          
		});
    }
</script>