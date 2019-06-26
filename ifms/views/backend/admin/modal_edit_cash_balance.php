<?php
$cash_bal = $this->db->get_where('cashbal',array('balID'=>$param2))->row();
?>

<div class="row">
	<div class="col-sm-12">
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('cash_balances');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
				<?php echo form_open(base_url() . 'ifms.php/admin/opening_cash_balance/edit/'.$cash_bal->icpNo.'/opening_cash_balance/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
					
					<div class="form-group">
						<label class="col-sm-4 control-label"><?=get_phrase('project');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="icpNo" id="icpNo" value="<?=$cash_bal->icpNo;?>" readonly="readonly"/>
						</div>
					</div>
					<?php
						if($cash_bal->accNo==='BC'){
					?>
					<div class="form-group">
						<label class="col-sm-4 control-label"><?=get_phrase('petty_cash_balance');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="amount" id="BC" value="<?php echo $cash_bal->amount;?>" />
						</div>
					</div>
					<?php
					
						}elseif($cash_bal->accNo==='PC'){
					
					?>
					<div class="form-group">
						<label class="col-sm-4 control-label"><?=get_phrase('bank_cash_balance');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="amount" id="PC" value="<?php echo $cash_bal->amount;?>"/>
						</div>
					</div>
					<?php
						}
					?>
					<div class="form-group">
						<button class="btn btn-success btn-icon"><i class="fa fa-pencil"></i><?=get_phrase('edit');?></button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
			