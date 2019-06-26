<?php
//$month = $this->finance_model->current_financial_month($this->session->center_id);

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
				
						<hr />
						
						<!--Proof Of Cash -->
						
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