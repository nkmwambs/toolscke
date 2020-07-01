<?php

$start_date = date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->project_system_start_date($param2))));

$bc_amount = 0;

$pc_amount = 0;

$bc_readonly = '';

$pc_readonly = '';

if($rec = $this->db->get_where('cashbal',array('icpNo'=>$param2,'month'=>$start_date,'accNo'=>'BC'))->row()){
		$rec = $this->db->get_where('cashbal',array('icpNo'=>$param2,'month'=>$start_date,'accNo'=>'BC'))->row();
		$bc_amount = $rec->amount; 
		
		if($bc_amount>0){
			$bc_readonly = 'readonly="readonly"';
		}
		
}

if($rec = $this->db->get_where('cashbal',array('icpNo'=>$param2,'month'=>$start_date,'accNo'=>'PC'))->row()){
		$pc_amount = $rec->amount;

		if($pc_amount>0){
			$pc_readonly = 'readonly="readonly"';
		}
}

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
				<?php echo form_open(base_url() . 'ifms.php/admin/opening_cash_balance/add/'.$param2.'/'.$param3 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
					
					<div class="form-group">
						<label class="col-sm-4 control-label"><?=get_phrase('project');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="icpNo" id="icpNo" value="<?=$param2;?>" readonly="readonly"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label"><?=get_phrase('petty_cash_balance');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="accNo[]" id="BC" value="<?=$bc_amount;?>" <?=$bc_readonly;?>/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label"><?=get_phrase('bank_cash_balance');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="accNo[]" id="PC" value="<?=$pc_amount;?>" <?=$pc_readonly;?>/>
						</div>
					</div>
					
					<div class="form-group">
						<button class="btn btn-success btn-icon"><i class="fa fa-plus-square"></i><?=get_phrase('add');?></button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
			