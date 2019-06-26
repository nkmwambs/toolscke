<?php
//print_r($projects);
?>
<style>
	.divider{
		margin:1px 0px 1px 0px;
		border-bottom: 2px solid silver;
	}
</style>


<div class="row">
		<div class="col-md-8">
                
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-upload"></i>
                            <?php echo get_phrase('details');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	
                    	
                        <?php 
							echo form_open(base_url() . 'ifms.php/admin/opening_balances/' , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('project_number');?></label>
                        		<div class="col-md-8">
                        			<select name="icpNo" id="icpNo" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                        			<option value=""><?php echo get_phrase('select');?></option>
                        			
                        			<?php
                        				foreach($projects as $row):
									?>		
										<option value="<?= $row->fname;?>"><?= $row->fname.' - '.$row->lname;?></option>
										
									<?php	
										endforeach;
                        			
                        			?>
                        			</select>
                        		</div>
                        	</div>

                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('type');?></label>
                        		
                        		<div class="col-md-8">
                        			<select name="balance_type" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                        			<option value=""><?php echo get_phrase('select');?></option>
                        			<option value="opening_fund_balance"><?php echo get_phrase('fund_balances');?></option>
                        			<option value="opening_cash_balance"><?php echo get_phrase('cash_balances');?></option>
                        			<option value="opening_outstanding_cheques"><?php echo get_phrase('outstanding_cheques');?></option>
                        			<option value="opening_deposit_in_transit"><?php echo get_phrase('deposit_in_transit');?></option>
                        			</select>	
                        		</div>
                        	</div>
                        	
                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('closure_date');?></label>
                        		
                        		<div class="col-md-8">
                        			<input type="text" class="form-control datepicker" readonly="readonly" id="closure_date" required="required" name="closure_date" data-format="yyyy-mm-dd"/>
                        		</div>
                        	</div>
                        	
                        	<div class="form-group">
                        		<div class="col-md-12">
                        			<button class="btn btn-primary btn-icon"><i class="fa fa-cloud-download"></i>Load</button>
                        		</div>
                        	</div>	
                        </form>
                        
                    </div>
                </div>

    </div>
    <!-- <div class="col-sm-4">
    	
    	<div class="row">
    		<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_upload_budget');" class="btn btn-primary btn-block btn-icon"><i class="fa fa-upload"></i><?=get_phrase('budget');?></button>
    	</div>
    	
    	<div class="divider"></div>
    	
    	<div class="row">
    		<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_cash_balance');" class="btn btn-primary btn-block btn-icon"><i class="fa fa-upload"></i><?=get_phrase('cash_balance');?></button>
    	</div>
    	
    	<div class="divider"></div>
    	
    	<div class="row">
    		<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_fund_balance');" class="btn btn-primary btn-block btn-icon"><i class="fa fa-upload"></i><?=get_phrase('fund_balance');?></button>
    	</div>
    	
    	<div class="divider"></div>
    	
    	<div class="row">
    		<button class="btn btn-warning btn-block btn-icon"><i class="fa fa-upload"></i><?=get_phrase('statement_balance');?></button>
    	</div>
    	
    	<div class="divider"></div>
    	
    	<div class="row">
    		<button class="btn btn-warning btn-block btn-icon"><i class="fa fa-upload"></i><?=get_phrase('vouchers');?></button>
    	</div>
    	
    	<div class="divider"></div>
    	
    	<div class="row">
    		<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_upload_deposit_in_transit');" class="btn btn-primary btn-block btn-icon"><i class="fa fa-upload"></i><?=get_phrase('deposit_in_transit');?></button>
    	</div>
    	
    	<div class="divider"></div>
    	
    	<div class="row">
    		<button class="btn btn-primary btn-block btn-icon"><i class="fa fa-upload"></i><?=get_phrase('outstanding_cheques');?></button>
    	</div>
    	
   
    </div> -->
</div>
<script>
	$(document).ready(function(){
		$('#icpNo').change(function(){
			
			var icpNo = $(this).val();
			var url = '<?=base_url();?>ifms.php/admin/get_project_start_date/'+icpNo;
			
			$.ajax({
				url:url,
				success:function(response){
					$('#closure_date').val(response);
					
				}
			});
		});
	});
</script>
