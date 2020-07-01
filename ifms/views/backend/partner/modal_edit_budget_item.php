<?php
$inc_acc = $this->finance_model->budgeted_revenue_accounts();

$item = $this->db->get_where('plansschedule',array('scheduleID'=>$param2))->row();

$fy = $this->db->get_where('planheader',array('planHeaderID'=>$item->planHeaderID))->row()->fy;

$accNo = $item->AccNo;

$parentAccID = $this->db->get_where('accounts',array('AccNo'=>$accNo))->row()->parentAccID;
			
$rev_acc = $this->db->get_where('accounts',array('accID'=>$parentAccID))->row();

//echo $rev_acc->AccText;

?>

<div class="panel panel-primary">
						
		<div class="panel-heading">
			<div class="panel-title"><?=get_phrase('new_budget_item');?></div>						
		</div>
								
		<div class="panel-body" style="overflow-y: auto;">

			<div class="row">	
					<?php echo form_open(base_url() . 'ifms.php/partner/edit_budget_item/'.$param2.'/'.$this->session->center_id."/".$param3 , array('id'=>'frm_schedule','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
								
								
								<div class="form-group">
									
									<div class="col-sm-12">
										<table class="table">
											<thead>
												<tr><th colspan="4" style="font-weight: bold;"><?=get_phrase('bugdet_limit');?></th></tr>
												<tr>
													<th><?=get_phrase('fund_category');?></th>
													<th><?=get_phrase('limit');?></th>
													<th><?=get_phrase('budgeted');?></th>
													<th><?=get_phrase('balance');?></th>
													<th><?=get_phrase('status');?></th>
												</tr>
											</thead>

										</table>
									</div>
								</div>
								
								
					<div class="form-group">
						<label class="control-label col-sm-4"><?=get_phrase('account');?></label>
						<div class="col-sm-7">
							<select name="AccNo" id="expense_id" class="form-control expense_id" data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>">
								<option value=""><?=get_phrase('select');?></option>
								<?php
											
										
									foreach($inc_acc as $inc):
								?>
								<optgroup label="<?=$inc->AccText." - ".$inc->AccName;?>">
									<?php
										$exp_acc = $this->finance_model->expense_accounts($inc->accID);
												
										foreach($exp_acc as $exp):
									?>
										<option value="<?=$exp->AccNo;?>" <?php if($item->AccNo===$exp->AccNo) echo "selected";?>><?=$exp->AccText." - ".$exp->AccName;?></option>
									<?php
										endforeach;
									?>
										</optgroup>
									<?php
										endforeach;
									?>
								</select>
							</div>
						</div>	
						
								
								
							
								
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('budget_tag');?></label>
								<div class="col-sm-7">
									<select class="form-control" name="plan_item_tag_id" id="plan_item_tag_id">
										<option><?=get_phrase('select');?></option>
										<?php
											$cluster_id = $this->db->get_where('users',array('fname'=>$this->session->center_id))->row()->cname;
											$tags = $this->db->get_where('plan_item_tag',array('cname'=>$cluster_id,'status'=>'1'))->result_object();
												
											foreach($tags as $row):
										?>
											<option value="<?=$row->plan_item_tag_id;?>" <?php if($row->plan_item_tag_id===$item->plan_item_tag_id) echo "selected";?>><?=$row->name;?></option>
										<?php
											endforeach;
										?>											
									</select>
								</div>
							</div>	
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('description');?></label>
									<div class="col-sm-7">
										<input type="text" name="details" value="<?=$item->details;?>" id="details" class="form-control details"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('financial_year');?></label>
									<div class="col-sm-7">

										<input type="text" class="form-control" name="fy" id="fy" value="<?=$fy;?>" readonly="readonly" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('quantity');?></label>
									<div class="col-sm-7">
										<input type="text" value="<?=$item->qty;?>" id="qty" name="qty" class="form-control header qty"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('unit_cost');?></label>
									<div class="col-sm-7">
										<input type="text" value="<?=$item->unitCost;?>" id="unitCost" name="unitCost" class="form-control header unitCost"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('often');?></label>
									<div class="col-sm-7">
										<input type="text" value="<?=$item->often;?>" id="often" name="often" class="form-control header often"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('total');?></label>
									<div class="col-sm-7">
										<input type="text" value="<?=$item->totalCost;?>" id="totalCost" readonly="readonly" name="totalCost" class="form-control header totalCost"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>"/>
									</div>
								</div>
								
								<?php
									$months = $this->finance_model->months_in_year($this->session->center_id);
								?>
								
								<table class="table">
									<thead>
										<tr>
											<th colspan="12"><?=get_phrase('monthly_spread');?></th>
										</tr>
										<tr>
											<th><?=get_phrase('action');?></th>
											<th style="text-align: center;"><?=$months['month_1_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_2_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_3_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_4_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_5_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_6_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_7_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_8_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_9_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_10_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_11_amount'];?></th>
											<th style="text-align: center;"><?=$months['month_12_amount'];?></th>
										</tr>
									</thead>
									
									<tbody>
										<tr>
											<td><div class="btn btn-warning" id="clear_spread">Clear</div></td>
											<td><input type="text" class="form-control spread Month_1" value="<?=$item->month_1_amount;?>" data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" 	name="month_1_amount" id="month_1_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_2" value="<?=$item->month_2_amount;?>"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_2_amount" id="month_2_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_3" value="<?=$item->month_3_amount;?>"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_3_amount" id="month_3_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_4" value="<?=$item->month_4_amount;?>"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_4_amount" id="month_4_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_5" value="<?=$item->month_5_amount;?>"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_5_amount" id="month_5_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_6" value="<?=$item->month_6_amount;?>"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_6_amount" id="month_6_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_7" value="<?=$item->month_7_amount;?>"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_7_amount" id="month_7_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_8" value="<?=$item->month_8_amount;?>"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_8_amount" id="month_8_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_9" value="<?=$item->month_9_amount;?>"  data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_9_amount" id="month_9_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_10" value="<?=$item->month_10_amount;?>" data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_10_amount" id="month_10_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_11" value="<?=$item->month_11_amount;?>" data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_11_amount" id="month_11_amount" style="min-width: 80px;" /></td>
											<td><input type="text" class="form-control spread Month_12" value="<?=$item->month_12_amount;?>" data-validate='required' data-message-required="<?php echo get_phrase('value_required');?>" name="month_12_amount" id="month_12_amount" style="min-width: 80px;" /></td>
										</tr>
										<tr>
											<td colspan="13">
												<textarea name="notes" id="notes" class="form-control ckeditor" cols="10" rows="5" placeholder="<?=get_phrase('write_your_notes_here');?>"><?=$item->notes;?></textarea>
											</td>
										</tr>
									</tbody>
								</table>
							
							<div class="form-group">
									<div class="col-sm-12">
										<div id="error_msg" style="color:red;"></div>
									</div>
								</div>
							
								<div class="form-group">
									<div class="col-offset-4 col-sm-8">
										<?php
											if($param3==='3'){
										?>
											<button class="btn btn-primary" id="edit"><?=get_phrase('reinstate');?></button>
										<?php		
											}else{
										?>
											<button class="btn btn-primary" id="edit"><?=get_phrase('edit');?></button>
										<?php
											}
										?>
										
									</div>
								</div>
						</form>				
			</div>
		</div>
				<div class="panel-footer">
					
				</div>
	</div>

<script>
	//$(document).ready(function(){
		$('.spread').keyup(function(e){			
			
		});
		
		
		$('.header').keyup(function(e){
			
			var spread=0;
			var sum = 0;
			var sum_spread = 0;
			var sum_header = 0;
			
			if($(this).attr('id')==='qty'){	
				sum = $(this).val()*$('.unitCost').val()*$('.often').val();
				
				$('.totalCost').val(sum);
				
				spread = sum/12;
				
				$('.spread').each(function(){
					$(this).val(spread);
				})
			}
			
			if($(this).attr('id')==='unitCost'){
				sum = $(this).val()*$('.qty').val()*$('.often').val();
				
				$('.totalCost').val(sum);
				
				spread = sum/12;
				
				$('.spread').each(function(){
					$(this).val(spread);
				})
			}
			
			if($(this).attr('id')==='often'){
				sum = $(this).val()*$('.unitCost').val()*$('.qty').val();
				
				$('.totalCost').val(sum);
				
				spread = sum/12;
				
				$('.spread').each(function(){
					$(this).val(spread);
				})
			}
				

		});
		
		$('#frm_schedule').submit(function(ev){	
			$('#error_msg').html();
			
			if($('#expense_id').val().length===0){
				$('#error_msg').html('<?php echo get_phrase('error:_account_missing');?>');
				ev.preventDefault();
			}
			
			if($('#details').val().length===0){
				$('#error_msg').html('<?php echo get_phrase('error:_description_missing');?>');
				ev.preventDefault();
			}		
			
			if($('#fy').val().length===0){
				$('#error_msg').html('<?php echo get_phrase('error:_financial_year_missing');?>');
				ev.preventDefault();
			}
			
			if($('#qty').val().length===0){
				$('#error_msg').html('<?php echo get_phrase('error:_quantity_missing');?>');
				ev.preventDefault();
			}
			
			if($('#unitCost').val().length===0){
				$('#error_msg').html('<?php echo get_phrase('error:_unit_cost_missing');?>');
				ev.preventDefault();
			}
			
			if($('#often').val().length===0){
				$('#error_msg').html('<?php echo get_phrase('error:_frequency_missing');?>');
				ev.preventDefault();
			}
			
			if($('#totalCost').val().length===0){
				$('#error_msg').html('<?php echo get_phrase('error:_total_cost_missing');?>');
				ev.preventDefault();
			}
			
			var cnt = 0;
			
			$('.spread').each(function(index){
				
				if($(this).val().length===0){
					cnt++;	
				}
				
			});
			
			if(cnt>0){
				$('#error_msg').html('<?php echo get_phrase('error:_spread_missing');?>');
				ev.preventDefault();
			}
			
			var spread = 0;
			$('.spread').each(function(index){
				spread += +$(this).val();
			});
			
			var total = $('#totalCost').val();
			
			//alert(Math.ceil(spread));
			
			if(Math.ceil(spread)!==Math.ceil(total)){
				$('#error_msg').html('<?php echo get_phrase('error:_spread_incorrect');?>');
				ev.preventDefault();
			}
				
				    var postData = $(this).serializeArray();
				    var formURL = $(this).attr("action");
				    $.ajax(
				    {
				        url : formURL,
				        type: "POST",
				        data : postData,
				        beforeSend:function(){
				        	var dialog = BootstrapDialog.show({
								title:"Information",
								message:'<?php echo get_phrase('please_wait_until_you_receive_confirmation');?>'
							});
				        },
				        success:function(data, textStatus, jqXHR) 
				        {
							$('#modal_ajax').modal('toggle');
							BootstrapDialog.show({
								title:"Information",
								message:'<?php echo get_phrase('record_edited');?>'
							});
							
							dialog.message = '<?php echo get_phrase('record_edited');?>';
	
				            				            
				            //location.reload();
				            $("#schedules").html(data);
				            
				        },
				        error: function(jqXHR, textStatus, errorThrown) 
				        {
				            //if fails
				            alert(textStatus);      
				        }
				    });
				    ev.preventDefault(); //STOP default action
				    ev.unbind(); //unbind. to stop multiple form submit.
			
		});
		
		$('#clear_spread').click(function(){
			$('.spread').each(function(index){
				$(this).val('0');
			});
		});
		
		
	//});
</script>