<?php

$mfr_submitted = $this->finance_model->mfr_submitted($param3,date('Y-m-d',strtotime($param2)));

$statement = $this->finance_model->statement_balance($param3,$param2);

?>

<div class="row">
	<div class="col-sm-12">
		<?php echo form_open(base_url() . 'ifms.php/partner/financial_reports/bank_reconcile/'.$param2.'/'.$param3 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('bank_reconciliation');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
				<div class="row  col-sm-offset-1 col-sm-10">
						<div class="form-group">
							<label class="control-label"><?php echo get_phrase('bank_statement_date');?></label>
								<div class="input-group">
										<input <?php if($mfr_submitted==='1'){echo "readonly='readonly'";};?>  type="text" name="bsDate" id="bsDate" value="<?php echo date('Y-m-t');?>" class="form-control datepicker accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" data-format="yyyy-mm-dd" data-start-date="<?php echo date('Y-m-t',strtotime($param2));?>" data-end-date="<?php echo date('Y-m-t',strtotime($param2));?>">
										
										<div class="input-group-addon">
											<a href="#"><i class="entypo-calendar"></i></a>
										</div>
								</div>							
						</div>
						
						<div class="form-group">
							<label class="control-label"><?php echo get_phrase('journal_bank_balance');?></label>
							<input class="form-control" type="text" id=''  value="<?=round($this->finance_model->bank_balance($param2,$param3),2)?>" readonly/>
						</div>	
						
						<div class="form-group">
							<label class="control-label"><?php echo get_phrase('statement_bank_balance');?></label>
							<input <?php if($mfr_submitted==='1'){echo "readonly='readonly'";};?> class="form-control" type="text" name="bankBal" id='bankBal' value="<?php echo $statement->amount;?>" data-validate="number,minlength[1],required" data-message-required="<?php echo get_phrase('value_required');?>"/>
						</div>
						
						<div class="form-group">
							<label class="control-label"><?php echo get_phrase('plus_deposit_in_transit');?></label>
							<input class="form-control" type="text" id="depTransit" name="depTransit" value="<?php echo $this->finance_model->sum_deposit_transit($param2,$param3);?>" readonly/>
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo get_phrase('less_outstanding_cheques');?></label>
							<input class="form-control" type="text" id='osChq' name="osChq"  value="<?php echo $this->finance_model->sum_outstanding_cheques($param2,$param3);?>" readonly/>
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo get_phrase('adjusted_bank_balance');?></label>
							<input class="form-control" type="text" id='adjBal' name="adjBal"  value="0" readonly/>
						</div>
						
						<div class="form-group">
							<label class="control-label"><?php echo get_phrase('journal_bank_balance');?></label>
							<input class="form-control" type="text" id='' name=""  value="<?php echo $this->finance_model->bank_balance($param2,$param3);?>" readonly/>
						</div>	
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('bank_reconciled');?></label>
							<div class="col-sm-8">	
								<?php
									if(abs(floor($this->finance_model->bank_reconciled($param3,date('Y-m-t',strtotime($param2)))))<>0){
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
					
				</div>
			
		</div>
		<!--<div class="panel panel-footer">
			
			<button id="save" class="btn btn-primary btn-icon"><i class="fa fa-save"></i><?=get_phrase('update');?></button>
		</div>-->
	</div>
	</form>		
	</div>
	
</div>

<script>
	$(document).ready(function(){
		
		var bs = $('#bankBal').val();
		var dep = $('#depTransit').val();
		var oc = $('#osChq').val();
		if(dep===""){
			dep = $('#depTransit').val("0");
		}
		var adj = parseFloat(bs)+parseFloat(dep)-parseFloat(oc);
			$('#adjBal').val(adj.toFixed(2));		
			
		
		if($('#bankBal').val()>0){
			var dep = $('#depTransit').val();
			var oc = $('#osChq').val();
			var adj = parseFloat($('#bankBal').val())+parseFloat(dep)-parseFloat(oc);
			$('#adjBal').val(adj.toFixed(2));
		}
		
		$('#bankBal').keyup(function(){
			$('#save').attr('style','display:block;')
			if($(this).val()===''){
				$(this).val() = 0;
			}
			var dep = $('#depTransit').val();
			var oc = $('#osChq').val();
			var adj = parseFloat($(this).val())+parseFloat(dep)-parseFloat(oc);
			$('#adjBal').val(adj.toFixed(2));
		});
		
	});
</script>
