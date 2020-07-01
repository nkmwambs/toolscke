<style>
	.pagebreak { page-break-before: always; }
</style>

<div class="row">
		<div class="col-sm-12">
	
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('financial_report');?>
            	</div>
            </div>
			<div class="panel-body">	

				<div class="row">
					<div class="col-sm-12">
						<form role="form" class="form-horizontal form-groups-bordered">
							<div class="form-group">
								<label for="" class="control-label col-sm-2">Scroll Month</label>
								<div class="col-sm-4">
									<div class="input-spinner">
										<button type="button" class="btn btn-danger btn-lg">-</button>
											<input readonly="readonly" type="text" id="scroll_months" class="form-control size-1 input-lg" value="0" />
										<button type="button" class="btn btn-danger btn-lg">+</button>
									</div>
								</div>
								<div class="col-sm-2">
									<div id="go_btn" class="btn btn-danger pull-left btn-lg">Go</div>
								</div>
								<div class="col-sm-3">
									<a href="#" class="btn btn-info btn-icon btn-lg" onclick="PrintElem('#tbl_fund_balance');"><i class="fa fa-print"></i><?=get_phrase('print');?></a>
								</div>
							</div>
							
							
						</form>
					</div>
				</div>
				
				<hr />
				
				
				<div class="row">
					<div class="col-sm-12" id="tbl_fund_balance">
						
					<?php
						$month = date("Y-m-t",strtotime($this->finance_model->current_financial_month($this->session->center_id)));
									
						include "include_report_queries.php";
					?>
					
											
						<!--Fund Balance Report -->
						<table class="table table-striped">
							<thead>
								<tr>
									<th colspan="5">Fund Balance Report for the Month Ending <?=date("Y-m-t",strtotime($month_end));?></th>
								</tr>
								<tr>
									<th>Account</th>
									<th style="text-align: right;">Opening Balance</th>
									<th style="text-align: right;">Month Income</th>
									<th style="text-align: right;">Month Expense</th>
									<th style="text-align: right;">Ending Balance</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($removed_empty_rows_in_grid as $row_key=>$row_value){
										$row = $revenue_accounts_with_acc_id_keys[$row_key];
								?>
									<tr>
										<td><?=$row['AccText'].' - '.$row['AccName'];?></td>
										<?php
											
											foreach($row_value as $col){
										?>
											<td style="text-align: right;"><?=number_format($col,2);?></td>
										<?php
											}
										?>
									</tr>
								<?php
									}
								?>
								<tfoot>
									<tr>
										<th>Total:</th>
										<th style="text-align: right;"><?=number_format(array_sum(array_column($removed_empty_rows_in_grid,"ob")),2);?></th>
										<th style="text-align: right;"><?=number_format(array_sum(array_column($removed_empty_rows_in_grid,"mi")),2);?></th>
										<th style="text-align: right;"><?=number_format(array_sum(array_column($removed_empty_rows_in_grid,"me")),2);?></th>
										<th style="text-align: right;"><?=number_format(array_sum(array_column($removed_empty_rows_in_grid,"cb")),2);?></th>
									</tr>
								</tfoot>
							</tbody>
						</table>
						<div class="pagebreak"></div>
				
						<hr />
						
						<!--Proof Of Cash -->
						<hr>
						<table class="table table-striped">
							<thead>
								<tr>
									<th colspan="2" style="text-align: center;font-weight: bold;">Proof Of Cash as at <?=$month;?></th> 
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="font-weight: bold;">Cash At Bank</td>
									<td style="text-align: right;"><?=number_format($proof_of_cash_grid['BC']['cb'],2);?></td>
								</tr>
								<tr>
									<td style="font-weight: bold;">Petty Cash</td>
									<td style="text-align: right;"><?=number_format($proof_of_cash_grid['PC']['cb'],2);?></td>
								</tr>
								<tr>
									<td style="font-weight: bold;">Total Cash Balance</td>
									<td style="text-align: right;"><?=number_format(array_sum(array_column($proof_of_cash_grid,"cb")),2);?></td>
								</tr>
								<tr>
									<td style="font-weight: bold;">Fund Balance</td>
									<td style="text-align: right;"><?=number_format(array_sum(array_column($removed_empty_rows_in_grid,"cb")),2);?></td>
								</tr>
								<tr>
									<td style="font-weight: bold;">Proof Of Cash</td>
									<?php
										$status = "Successful";
										if(array_sum(array_column($removed_empty_rows_in_grid,"cb"))!= array_sum(array_column($removed_empty_rows_in_grid,"cb"))){
											$status = "Unsuccessful";
										}
									?>
									<td style="text-align: right;"><?=$status;?></td>
								</tr>
							</tbody>
						</table>
						
						<div class="pagebreak"></div>
						
						<hr />
						
						<!-- Outstanding Cheques -->
						
						<table class="table table-striped">
							<thead>
								<tr>
									
									<th style="font-weight: bold;text-align: center;" colspan="6">List of Outstanding Cheques <div class="btn btn-default">Show Cleared Effects</div></th>
								</tr>
								<tr>
									<th>Action</th>
									<th>Date</th>
									<th>Cheque Number</th>
									<th>Voucher Number</th>
									<th>Details</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sum = 0;
									foreach($month_outstanding_cheques as $rows){
								?>
									<tr>
										<td><div class="btn btn-default">Clear</div></td>
										<td><?=$rows['TDate'];?></td>
										<td><?=$rows['ChqNo'];?></td>
										<td><?=$rows['VNumber'];?></td>
										<td><?=$rows['TDescription'];?></td>
										<td><?=$rows['Cost'];?></td>
									</tr>
								
								<?php
										$sum+=$rows['Cost'];
									}
								?>
								<tfoot>
									<tr>
										<td colspan="5">Totals:</td>
										<td style="font-weight: bold;"><?=number_format($sum,2);?></td>
									</tr>
								</tfoot>
							</tbody>
						</table>
						
						<div class="pagebreak"></div>
						
						<hr />
						
						<!-- Outstanding Cheques -->
						
						<table class="table table-striped">
							<thead>
								<tr>
									
									<th style="font-weight: bold;text-align: center;" colspan="6">List of In Transit Deposits <div class="btn btn-default">Show Cleared Effects</div></th>
								</tr>
								<tr>
									<th>Action</th>
									<th>Date</th>
									<th>Cheque Number</th>
									<th>Voucher Number</th>
									<th>Details</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sum = 0;
									foreach($month_in_transit_deposit as $rows){
								?>
									<tr>
										<td><div class="btn btn-default">Clear</div></td>
										<td><?=$rows['TDate'];?></td>
										<td><?=$rows['ChqNo'];?></td>
										<td><?=$rows['VNumber'];?></td>
										<td><?=$rows['TDescription'];?></td>
										<td><?=$rows['Cost'];?></td>
									</tr>
								
								<?php
										$sum+=$rows['Cost'];
									}
								?>
								<tfoot>
									<tr>
										<td colspan="5">Totals:</td>
										<td style="font-weight: bold;"><?=number_format($sum,2);?></td>
									</tr>
								</tfoot>
							</tbody>
						</table>
						
						<div class="pagebreak"></div>
						
						<hr />
						
						<!-- Bank Reconciliation -->
						
						<?php echo form_open('' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
							
							<div style="font-weight: bold;text-align: center;" class="col-sm-12">Bank Reconciliation</div>
							<hr />
							<div class="form-group">
								<label for="" class="control-label col-sm-4">Bank Statement Date</label>
								<div class="col-sm-8">
									<input type="text" class="form-control datepicker" name="" id="" readonly="readonly" data-format="yyyy-mm-dd" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="" class="control-label col-sm-4">Statement Amount</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="" id="" />
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="" class="control-label col-sm-4">Add: In Transit Deposit</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="" id="" readonly="readonly" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="" class="control-label col-sm-4">Less: Outstanding Cheque</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="" id="" readonly="" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="" class="control-label col-sm-4">Reconciled Bank Balance</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="" id="" readonly="readonly"/>
								</div>
							</div>
							
							<div class="form-group">
								<label for="" class="control-label col-sm-4">Book Balance</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="" id="" readonly="readonly"/>
								</div>
							</div>
							
							<label for="" class="control-label col-sm-12"><div class="label label-info">Successful</div></label>
								
							
							
						</form>
						
						<div class="pagebreak"></div>
					
					</div>
				</div>
				
			</div>
		</div>
	</div>	
</div>


<script>
    function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: "<?php echo get_phrase('fund_balance_report');?>",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: null,             
		    formValues: true          
		});
    }
    
    $("#go_btn").click(function(){
    	var url = "<?=base_url();?>ifms.php/partner/scroll_financial_report/<?=$month;?>/"+$("#scroll_months").val();
    	
    	$.ajax({
    		url:url,
    		beforeSend:function(){
    			$('#tbl_fund_balance').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url();?>uploads/preloader4.gif" /></div>');
    		},
    		success:function(resp){
    			$('#tbl_fund_balance').html(resp);
    			$("#scroll_months").val("0");
    		},
    		error:function(){
    			
    		}
    	});
    });
</script>	