<?php
//echo $param2;
?>
<div class="row">
	<div class="col-sm-12">
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="fa fa-vcard"></i>
					<?php echo get_phrase('fund_balance_report');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
			<div class="row">
					<div class="col-sm-12">
						<a href="#" class="fa fa-print" onclick="PrintElem('#tbl_fund_balance');"><?=get_phrase('print');?></a>
					</div>
				</div>
	
			<table class="table table-bordered" id="tbl_fund_balance">
						<thead>
							<tr>
								<th colspan="5">
									<?php echo get_phrase('fund_balance_report_for_the_month_ending')." ".date('t-m-Y',strtotime($param2));?> 
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
									$rec_accs = $this->db->get_where('accounts',array("AccGrp"=>"1"))->result_object();
									
									foreach($rec_accs as $row):
									if(
										$this->finance_model->months_opening_fund_balances($param3,$row->AccNo,$param2)<>0
										||
										$this->finance_model->months_closing_fund_balance_per_revenue_vote($param3,$row->AccNo,$param2)<>0
										||
										$this->finance_model->months_incomes_per_revenue_vote($param3,$row->AccNo,$param2)<>0
										||
										$this->finance_model->months_expenses_per_revenue_vote($param3,$row->accID,$param2)<>0
									){
								?>
								<tr>
									<td><?=$row->AccText;?> - <?=$row->AccName;?></td>
									<td style="text-align: right;"><?=number_format($this->finance_model->months_opening_fund_balances($param3,$row->AccNo,$param2),2);?></td>
									<td style="text-align: right;"><?=number_format($this->finance_model->months_incomes_per_revenue_vote($param3,$row->AccNo,$param2),2);?></td>
									<td style="text-align: right;"><?=number_format($this->finance_model->months_expenses_per_revenue_vote($param3,$row->accID,$param2),2);?></td>
									<td style="text-align: right;"><?=number_format($this->finance_model->months_closing_fund_balance_per_revenue_vote($param3,$row->AccNo,$param2),2);?></td>
								</tr>
										
								<?php
									}
								endforeach;
								
								?>
						</tbody>
						<tfoot>
							<tr>
								<td><?=get_phrase('total');?></td>
								<td style="text-align: right;"><?=number_format($this->finance_model->total_months_opening_revenues($param3,$param2),2);?></td>
								<td style="text-align: right;"><?=number_format($this->finance_model->total_months_incomes($param3,$param2),2);?></td>
								<td style="text-align: right;"><?=number_format($this->finance_model->total_months_expenses($param3,$param2),2);?></td>
								<td style="text-align: right;"><?=number_format($this->finance_model->total_months_closing_balance($param3,$param2),2);?></td>
							</tr>
						</tfoot>
			</table>
		</div>
		<div class="panel-footer">
		

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
		    pageTitle: "<?php echo get_phrase('payment_voucher');?>",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: null,             
		    formValues: true          
		});
    }
</script>			
</div>