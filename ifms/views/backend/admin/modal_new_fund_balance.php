<?php
//print_r($this->finance_model->revenue_accounts());
$icpNo = $param2;//$this->db->get_where('users',array('fname'=>$param2))->row()->fname;

$rev_accounts = $this->finance_model->revenue_accounts();

//$start_date = date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->system_start_date($icpNo))));

?>
<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-plus-square"></i>
                            <?php echo get_phrase('new_balance');?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php 
							echo form_open(base_url() . 'ifms.php/admin/opening_fund_balance/add/'.$param2.'/'.$param3 , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
							<input type="hidden" name="balance_type" value="opening_fund_balance" />
							<input type="hidden" name="icpNo" value="<?=$param2;?>" />
		
							
                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('project_number');?></label>
                        		<div class="col-md-8">
                        			<input type="text" name="icpNo" readonly="readonly" class="form-control" value="<?= $param2;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        			
                        		</div>
                        	</div>
							
							<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('closure_date');?></label>
                        		<div class="col-md-8">	
                        			<input type="text" name="closureDate" readonly="readonly" class="form-control" value="<?= $param3;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        		</div>
                        	</div>
							
                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('account');?></label>
                        		
                        		<div class="col-md-8">
                        			<select name="funds" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
										<option value=""><?= get_phrase('select');?></option>
										<?php
											foreach($rev_accounts as $accounts):
										?>
											<option value="<?= $accounts->AccNo;?>"><?= $accounts->AccText.' - '.$accounts->AccName;?></option>
										<?php
											endforeach;
										?>
                        			</select>	
                        		</div>
                        	</div>
                        	
                        	<div class="form-group">
                        		<label class="control-label col-md-4"><?php echo get_phrase('amount');?></label>
                        		<div class="col-md-8">
                        			<input type="text" name="amount" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        			
                        		</div>
                        	</div>
                        	
                        	<div class="form-group">
                        		<div class="col-md-12">
                        			<button class="btn btn-primary btn-icon"><i class="fa fa-plus-circle"></i><?=get_phrase('add');?></button>
                        		</div>
                        	</div>	
                        </form>
                        
                    </div>
                </div>
             </div>   
</div>