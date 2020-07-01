<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('proof_of_cash');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
			
			<div class="row">
					<div class="col-sm-12">
						<a href="#" class="fa fa-print" onclick="PrintElem('#frm_cash');"><?=get_phrase('print');?></a>
					</div>
				</div>	
			
			<?php 
	
				echo form_open(base_url() . 'ifms.php/partner/financial_reports/cash_proof/'.$param2.'/'.$param3 , array('class' => 'form-wizard validate form-horizontal form-groups-bordered validate'));
			?>		
				<div id="frm_cash">
					<div class="form-group">
						<label class="control-label col-sm-4"><?php echo get_phrase('cash_at_bank');?></label>
							<div class="col-sm-8">
								<input class="form-control" type="text" name="BC" id='BC' value="<?php echo $this->finance_model->bank_balance(date('Y-m-01',strtotime($param2)),$param3);?>" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
							</div>
					</div>
					
					<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('petty_cash');?></label>
							<div class="col-sm-8">
								<input class="form-control" type="text" id="PC" name="PC" value="<?php echo $this->finance_model->petty_cash_balance(date('Y-m-01',strtotime($param2)),$param3);?>" readonly/>
							</div>
					</div>	
					
					<div class="form-group">
						<label class="control-label col-sm-4"><?php echo get_phrase('total_cash_balance');?></label>
							<div class="col-sm-8">	
								<input class="form-control" type="text" id="cash_total" name="cash_total" value="<?php echo $this->finance_model->total_cash(date('Y-m-01',strtotime($param2)),$param3);?>" readonly/>
							</div>
					</div>
						
					<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('fund_balance');?></label>
							<div class="col-sm-8">	
								<input class="form-control" type="text" id="cash_total" name="cash_total" value="<?php echo $this->finance_model->total_months_closing_balance($param3,date('Y-m-01',strtotime($param2)));?>" readonly/>
							</div>
					</div>		
					
					<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('proof_of_cash');?></label>
							<div class="col-sm-8">	
								<?php
									if($this->finance_model->proof_of_cash($param3,date('Y-m-01',strtotime($param2)))<>0){
								?>
									<div class="label label-danger"><?=get_phrase('proof_of_cash_failure');?></div>
								<?php
									}else{
								?>
									<div class="label label-success"><?=get_phrase('proof_of_cash_successful');?></div>
								<?php
									}
								?>
							</div>
					</div>	
					
				</div>	
			</form>			
			
		</div>

	</div>
		
	</div>
	
</div>
					
</form>

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