<?php
$rec = $this->db->get_where('oschqbf',array('osBfID'=>$param2))->row();
?>

<div class="row">
		<div class="col-md-12">
			
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-plus-square"></i>
                            <?php echo get_phrase('edit_outstanding_cheques');?>
                        </div>
                    </div>
                    <div class="panel-body">

                    <?php 
						echo form_open(base_url() . 'ifms.php/admin/opening_outstanding_cheques/edit/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
					?>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('cheque_date');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control datepicker" name="TDate" id="TDate"  value="<?php if($rec->TDate!=='0000-00-00') echo $rec->TDate;?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('cheque_number');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="ChqNo" id="ChqNo"  value="<?=$rec->ChqNo;?>" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('details');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="TDescription" id="TDescription"  value="<?=$rec->TDescription;?>" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('cheque_status');?></label>
							<div class="col-sm-8">
								<select class="form-control" name="chqState" id="chqState">
									<option><?=get_phrase('select');?></option>
									<option value="0"><?=get_phrase('oustanding');?></option>
									<option value="1"><?=get_phrase('cleared');?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('cleared_month');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control datepicker" name="clrMonth" id="clrMonth" value="<?php if($rec->clrMonth!=='0000-00-00') echo $rec->clrMonth;?>" />
							</div>
						</div>						
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('amount');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="totals" id="totals" value="<?=$rec->totals;?>" />
							</div>
						</div>	
						
						<div class="form-group">
							<button class="btn btn-success btn-icon"><i class="fa fa-pencil"></i><?=get_phrase('edit');?></button>
						</div>						
											
					</form>                    	
                    
                  </div>
           </div> 
   </div>
                  	
<script>
		$('.datepicker')
		.datepicker({
				format: 'yyyy-mm-dd',
				endDate:"<?php echo date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->system_start_date($rec->project_id))));?>"
		})
		.prop('readonly','readonly');
</script>