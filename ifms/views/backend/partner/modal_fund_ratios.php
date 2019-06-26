<?php
//echo $param2;
?>
<div class="row">
	<div class="col-sm-12">	
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('financial_ratios');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
				<div class="row">
					<div class="col-sm-12">
						<a href="#" class="fa fa-print" onclick="PrintElem('#tbl_fund_balance');"><?=get_phrase('print');?></a>
					</div>
				</div>
				<table class="table" id="tbl_fund_balance">

					<thead>
						<tr>
							<th><?php echo get_phrase('operating_ratio');?></th>
							<th><?php echo get_phrase('funds_accumulation_ratio');?></th>
							<th><?php echo get_phrase('budget_variance');?></th>
							<th><?php echo get_phrase('petty_cash');?></th>
							<th><?php echo get_phrase('survival_ratio');?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo number_format($this->finance_model->operating_ratio($this->session->center_id,$param2,'100'),2)*100;?>%</td>
							<td><?=number_format($this->finance_model->accumulated_fund_ratio($this->session->center_id,'100',$param2),2);?></td>
							<td>0%</td>
							<td><?php echo number_format($this->finance_model->petty_cash_balance($param2,$this->session->center_id),2);?></td>
							<td>0%</td>
						</tr>
					</tbody>
					
				</table>
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
		    pageTitle: "<?php echo get_phrase('payment_voucher');?>",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: null,             
		    formValues: true          
		});
    }
</script>
			