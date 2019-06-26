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
?>

<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('validation');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
				
				<!--<form class="form-horizontal form-groups-bordered validate">-->
				<?php echo form_open(base_url() . 'ifms.php/partner/submit_mfr/'.strtotime($param2) , array('id'=>'report_validate'));?>	
						
						
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
					
				</form>						
			
		</div>

		<div class="panel panel-footer">
			<button class="btn btn-primary btn-icon" id="save"><i class="fa fa-save"></i>Submit</button>
		</div>
	</div>
		
	</div>
	
</div>

<script>
	$(document).ready(function(){	
		
		$('#save').click(function(e){

	            		var err ="";
	            		
	            		if($('#fund_validate').val()!=='0'){
							//alert('Fund balance validation should be zero');
							err +='Fund balance validation should be zero \n';
							//return false;				
						}
						
						if($('#bank_validate').val()!=='0'){
							
							//alert('Bank reconcilliation validation should be zero');
							err +='Bank reconcilliation validation should be zero \n';
							//return false;				
						}
						
						if($('#proof_of_cash').val()!=='0'){
							
							//alert('Proof of Cash validation should be zero');
							err += 'Proof of Cash validation should be zero \n';
							//return false;				
						}
						
						if($('#statement_uploaded').val()!=='Yes'){
							
							//alert('You have not uploaded any bank statement');
							err +='You have not uploaded any bank statement \n';
							//return false;				
						}
						
						if(err!==""){
							alert(err);
							return false;
						}
						
								//var url = '<?php //echo base_url();?>icp/finance/submit_mfr/<?php //echo strtotime($param2);?>';
								//$.ajax({url:url});							
								
								$('#report_validate').submit();
						
		});
		
	});
</script>
