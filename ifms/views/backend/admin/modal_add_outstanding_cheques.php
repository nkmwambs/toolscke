<div class="row">
		<div class="col-md-12">
			
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-plus-square"></i>
                            <?php echo get_phrase('add_outstanding_cheques');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    <?php 
						echo form_open(base_url() . 'ifms.php/admin/opening_outstanding_cheques/add/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
					?>
					
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('project_id');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="icpNo" id="icpNo" value="<?=$param2;?>" readonly="readonly" />
							</div>
						</div>
						
						<div class="form-group">
							<button id="add_row" class="btn btn-info btn-icon"><i class="fa fa-align-justify"></i><?=get_phrase('insert_row');?></button>
							<button type="submit" class="btn btn-primary btn-icon"><i class="fa fa-plus-square"></i><?=get_phrase('post');?></button>
						</div>
						
						<div class="form-group">
						<table class="table table-striped" id="cheques">
							<thead>
								<tr>
									<th><?=get_phrase('action');?></th>
									<th><?=get_phrase('date');?></th>
									<th><?=get_phrase('cheque_no');?></th>
									<th><?=get_phrase('details');?></th>
									<th><?=get_phrase('amount');?></th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						</div>
					</form>
					</div>
				</div>
		</div>
</div>	

<script>
	$('#add_row').click(function(ev){
		$('table#cheques tbody').append('<tr>'+
										'<td class="fa fa-minus-circle"></td>'+
										'<td><input type="text" name="chqDate[]" class="form-control datepicker"/></td>'+
										'<td><input type="text" name="chqNo[]" class="form-control"/></td>'+
										'<td><input type="text" name="Details[]" class="form-control"/></td>'+
										'<td><input type="text" name="amount[]" class="form-control amount"/></td>'+
										'</tr>');
		$('.datepicker')
		.datepicker({
				format: 'yyyy-mm-dd',
				endDate:"<?php echo date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->system_start_date($param2))));?>"
		})
		.prop('readonly','readonly');
										
		ev.preventDefault();
	});
	
</script>				