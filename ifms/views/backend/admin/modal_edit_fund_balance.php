<?php

$rev_accounts = $this->finance_model->revenue_accounts();

$rec = $this->db->get_where('opfundsbal',array('balID'=>$param2))->row();

$start_date = $this->db->get_where('opfundsbalheader',array("balHdID"=>$rec->balHdID))->row()->closureDate;

//echo $start_date;

?>
<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-pencil-square"></i>
                            <?php echo get_phrase('edit_balance');?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php 
							echo form_open(base_url() . 'ifms.php/admin/opening_fund_balance/edit/'.$param3.'/opening_fund_balance/'.$param2.'/'.$start_date , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('project_number');?></label>
                        		<div class="col-md-8">
                        			<input type="text" name="project_id" readonly class="form-control" value="<?= $param3;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        			
                        		</div>
                        	</div>
							
							<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('start_date');?></label>
                        		<div class="col-md-8">
                        			<input type="text" name="closureDate" readonly class="form-control" value="<?= $start_date;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        		</div>
                        	</div>
							
                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('account');?></label>
                        		
                        		<div class="col-md-8">
                        			<input type='text' name="funds" value="<?=$rec->funds;?>" readonly class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">	
                        		</div>
                        	</div>
                        	
                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('amount');?></label>
                        		<div class="col-md-8">
                        			<input type="text" name="amount" value="<?=$rec->amount;?>" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        			
                        		</div>
                        	</div>
                        	
                        	<div class="form-group">
                        		<div class="col-md-12">
                        			<button class="btn btn-primary btn-icon"><i class="fa fa-pencil-square"></i>Edit</button>
                        		</div>
                        	</div>	
                        </form>
                        
                    </div>
                </div>
             </div>   
</div>