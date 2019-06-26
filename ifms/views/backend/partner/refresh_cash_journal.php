<?php
echo date('Y-m-d',$tym);
?>

			<div class="col-md-12 col-sm-12">
			
				<div class="panel panel-primary" data-collapsed="0">
					
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">
						
						<?php
							if($this->finance_model->mfr_submit_state(date('Y-m-d',$tym))->current_mfr===FALSE && $this->finance_model->mfr_submit_state(date('Y-m-d',$tym))->last_mfr===TRUE){
						?>
							<div class="btn btn-blue btn-icon" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_new_voucher/<?php echo $this->finance_model->last_voucher()->VNumber;?>/<?php echo $this->finance_model->last_voucher()->TDate;?>',false);">
								<?php echo get_phrase('new_voucher');?>
								<i class="entypo-plus-squared"></i>
							</div>
						<?php
							}
						?>	
							
							<div class="btn-group right-dropdown">
								<button type="button" class="btn btn-blue"><?php echo get_phrase('funds_transfer');?></button>
								<button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								
								<ul class="dropdown-menu dropdown-blue" role="menu">
									<li>
										<a href="#"><?php echo get_phrase('new_request');?></a>
									</li>
									
									<li class="divider"></li>
									
									<li>
										<a href="#"><?php echo get_phrase('view_requests');?></a>
									</li>
								</ul>
							</div>


							<div class="btn-group right-dropdown">
								<button type="button" class="btn btn-blue"><?php echo get_phrase('reconciliation');?></button>
								<button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								
								<ul class="dropdown-menu dropdown-blue" role="menu">
									<li>
										<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_outstanding_cheques/<?php echo date('Y-m-t',$tym);?>')"><?php echo get_phrase('outstanding_cheques');?></a>
									</li>
									
									<li class="divider"></li>
									<li>
										<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_transit_deposits/<?php echo date('Y-m-t',$tym);?>')"><?php echo get_phrase('deposits_in_transit');?></a>
									</li>
									
									<li class="divider"></li>
									
									<li>
										<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_cleared_effects/<?php echo date('Y-m-t',$tym);?>')"><?php echo get_phrase('cleared_effects');?></a>
										
									</li>
									
									<li class="divider"></li>
									<li>
										<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_bank_reconcile/<?php echo date('Y-m-t',$tym);?>')"><?php echo get_phrase('bank_reconciliation');?></a>
									</li>
									
									<li class="divider"></li>
									
									<li>
										<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_variance_explanation/<?php echo date('Y-m-t',$tym);?>')"><?php echo get_phrase('variance_explanation');?></a>
									</li>
									
									<li class="divider"></li>
									
									<li>
										<a href="#"><?php echo get_phrase('bank_statement');?></a>
									</li>
									
									<li class="divider"></li>
									
									<li>
										<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_financial_report/<?php echo date('Y-m-t',$tym);?>')"><?php echo get_phrase('view_report');?></a>
									</li>
									
								</ul>
							</div>

							
							<!--<div class="btn btn-blue btn-icon" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_financial_report/<?php echo date('Y-m-d',$tym);?>',false);">
								<?php echo get_phrase('financial_report');?> <i class="entypo-suitcase"></i></a>
							</div>-->
							<!--<?php echo form_open(base_url() . 'icp/scroll_journal/' , array('id'=>'frm_scroll_date','class' => 'form-horizontal'));?>		
							<div class="form-group">										
											<div class="input-group col-sm-2">
												<input type="text" placeholder="Scroll To Date" name="scroll_date" id="scroll_date" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" data-format="yyyy-mm-dd" data-start-date="<?php echo date('Y-m-d',$tym);?>" data-end-date="">
												
												<div class="input-group-addon">
													<a href="#"><i class="entypo-calendar"></i></a>
												</div>
											</div>
										
							</div>
							
							<div class="form-group">
								<button class="btn btn-primary" id="scroll">Scroll</button>
							</div>
							</form>-->
							<div class="btn btn-blue btn-icon icon-left"><a href="<?php echo base_url(); ?>icp/scroll_journal/<?php echo strtotime("-1 month",$tym);?>">
								<i class="entypo-fast-backward"></i> <?php echo date('M-Y',strtotime("-1 month",$tym))?></a>
							</div>
							
							<div class="btn btn-blue btn-icon"><a href="<?php echo base_url(); ?>icp/scroll_journal/<?php echo $tym;?>">
								<i class="entypo-play"></i> <?php echo date('M-Y',$tym)?> </a>
							</div>
							
							<div class="btn btn-blue btn-icon"><a href="<?php echo base_url(); ?>icp/scroll_journal/<?php echo strtotime("+1 month",$tym);?>">
								<?php echo date('M-Y',strtotime("+1 month",$tym))?>  <i class="entypo-fast-forward"></i></a>
							</div>
							
							<div class="btn btn-primary" id="monkey_dialog">Health Check</div>
							
						</div>
						
						<div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
						</div>
					</div>
					
					<!-- panel body -->
					<div class="panel-body" style="max-width:50; overflow: auto;">
						
						
						<?php
							$max_col = 12;
							
							/** Journal Records **/
							$condition = "Month(`TDate`)='".date('m',$tym)."' AND Fy='".get_fy(date('d-m-Y',$tym))."' AND icpNo='".$this->session->userdata('icp_no')."'";
							$records = $this->db->where($condition)->get('voucher_header')->result_array();
							
							//print_r($records);
						?>
						<table class="table table-bordered datatable table-hover table-responsive" id="table_export">
							<thead>
								<tr>
									<th style="text-align: center;" colspan="<?php echo $max_col;?>">										
											<?php echo $this->session->userdata('icp_no'); ?><br><?php echo get_phrase('cash_journal');?> 
									</th>
								</tr>

								<tr>
									<th colspan="3"><?php echo get_phrase('center_number');?></th>
									<th colspan="5"><?php echo $this->session->userdata('icp_no');?></th>
									<th><?php echo get_phrase('month');?></th>
									<th><?php echo date('M',$tym);?></th>
									<th><?php echo get_phrase('year');?></th>
									<th><?php echo date('Y',$tym);?></th>
								</tr>
								
								<tr>
									<th><?php echo get_phrase('date');?></th>
									<th><?php echo get_phrase('voucher_type');?></th>
									<th><?php echo get_phrase('payee_/_source');?></th>
									<th><?php echo get_phrase('voucher_no');?></th>
									<th><?php echo get_phrase('description_/_details');?></th>
									<th colspan="4"><?php echo get_phrase('bank');?></th>
									<th colspan="3"><?php echo get_phrase('petty_cash');?></th>
								</tr>
								
								<tr>
									<th colspan="5">&nbsp;</th>
									<th><?php echo get_phrase('chq_no');?></th>
									<th><?php echo get_phrase('deposits');?></th>
									<th><?php echo get_phrase('payments');?></th>
									<th><?php echo get_phrase('balance');?></th>
									<th><?php echo get_phrase('deposits');?></th>
									<th><?php echo get_phrase('payments');?></th>
									<th><?php echo get_phrase('balance');?></th>
								</tr>
								
								<tr>
									<th colspan="6">&nbsp;</th>
									<th><?php echo get_phrase('kes.');?></th>
									<th><?php echo get_phrase('kes.');?></th>
									<th><?php echo get_phrase('kes.');?></th>
									<th><?php echo get_phrase('kes.');?></th>
									<th><?php echo get_phrase('kes.');?></th>
									<th><?php echo get_phrase('kes.');?></th>
								</tr>

								<tr>
									<?php
										$bank_bal_cond = "month='".date('Y-m-t',strtotime('-1 month',$tym))."' AND AccNo='BC'";
										$begin_bank = $this->db->where($bank_bal_cond)->get('cashbal')->row()->amount; 
										
										$pc_bal_cond = "month='".date('Y-m-t',strtotime('-1 month',$tym))."' AND AccNo='PC'";
										$begin_pc = $this->db->where($pc_bal_cond)->get('cashbal')->row()->amount;
									?>
									<th colspan="6"><?php echo get_phrase('balance_brought_forward');?></th>
									<th colspan="3"><?php echo number_format($begin_bank,2);?></th>
									<th colspan="3"><?php echo number_format($begin_pc,2);?></th>
								</tr>
								
								<tr>
									<?php
										$sum_bank_income = 0;
										$sum_bank_payment = 0;
										$sum_bank_balance = 0;
										
										$sum_pc_income = 0;
										$sum_pc_payment = 0;
										$sum_pc_balance = 0;
										
										//SUM Bank Income
										$condition_bank_income = $condition." AND (VType='CR' OR VType='PCR')";
										$sum_bank_income = $this->db->where($condition_bank_income)->select_sum(totals)->get('voucher_header')->row()->totals;
										
										//SUM Bank Payments
										$condition_bank_payment = $condition." AND (VType='CHQ' OR VType='BCHG')";
										$sum_bank_payment = $this->db->where($condition_bank_payment)->select_sum(totals)->get('voucher_header')->row()->totals;
										
										//SUM Bank Balance
										$sum_bank_balance = $begin_bank+$sum_bank_income-$sum_bank_payment;						
										
										
									?>
									<th colspan="6"><?php echo get_phrase('totals');?></th>
									<th><?php echo number_format($sum_bank_income,2);?></th>
									<th><?php echo number_format($sum_bank_payment,2);?></th>
									<th><?php echo number_format($sum_bank_balance,2);?></th>
									
									<?php
										/** SUM ALL PC Income Vouchers **/
										$sum_pc_income = 0;
										$sum_pc_payment = 0;
										foreach($records as $rw):
											$cond_inc = "AccNo='2000' AND hID=".$rw['hID'];
											$sum_pc_income+=$this->db->select_sum(Cost)->where($cond_inc)->get('voucher_body')->row()->Cost;
											
											$cond_pay = "(VType='PC' OR VType='PCR') AND hID=".$rw['hID'];
											$sum_pc_payment+=$this->db->select_sum(Cost)->where($cond_pay)->get('voucher_body')->row()->Cost;
											
										endforeach;
										
										$sum_pc_balance = $begin_pc+$sum_pc_income-$sum_pc_payment;	
									?>
									
									<th><?php echo number_format($sum_pc_income,2);?></th>
									<th><?php echo number_format($sum_pc_payment,2);?></th>
									<th><?php echo number_format($sum_pc_balance,2);?></th>
								</tr>								
																
							</thead>
							
							<tbody>
									<?php
										
										
										foreach($records as $row):
									?>
										<tr>
											<td class="tdate"><?php echo $row['TDate'];?></td>
											
											<?php
												
												if(($row['VType']==='CHQ' || $row['VType']==='BCHG' || $row['VType']==='CR') && $row['ChqState']==='0'){
											?>
												<td>
													<div id="<?php echo $row['hID'];?>" class="make-switch switch-small clr" data-on-label="<?php echo $row['VType'];?>" data-off-label="<?php echo $row['VType'];?>">
														<input type="checkbox" checked value="<?php echo $row['VNumber'];?>">
													</div>
												</td>	
											<?php
												}elseif(($row['VType']==='CHQ' || $row['VType']==='BCHG' || $row['VType']==='CR') && (sizeof($mfr)===0 || $row['ChqState']==='1')){
											?>	
												<td>
													<div id="<?php echo $row['hID'];?>" class="make-switch switch-small clr" data-on-label="<?php echo $row['VType'];?>" data-off-label="<?php echo $row['VType'];?>">
														<input type="checkbox" value="<?php echo $row['VNumber'];?>">
													</div>
												</td>											
											<?php						
												}else{
											?>
												<td>
													<div class="make-switch switch-small" data-off-label="<?php echo $row['VType'];?>">
													    <input type="checkbox" disabled>
													</div>
												</td>
											<?php
												}
											?>
											
											
											<td><?php echo $row['Payee'];?></td>
											<td>
																							
												<div class="btn btn-green popover-primary popup-ajax" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Click on the button to view a voucher" data-original-title="Tooltip" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_voucher/<?php echo $row['VNumber'];?>');">
												<!--<div class="btn btn-green popover-primary" data-poload="<?php echo base_url();?>index.php?modal/popup/modal_voucher_details/<?php echo $row['VNumber'];?>" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_voucher/<?php echo $row['VNumber'];?>');">-->
													<a href="#">
														<?php echo $row['VNumber'];?>
													</a>
													
												</div>
												
												
											</td>
											<td><?php echo $row['TDescription'];?></td>
											<?php
												$mixed_chq = explode("-", $row['ChqNo']);
											?>
											<td><?php echo $mixed_chq[0];?></td>
											
											<!-- Bank Income and Expenses -->
											
											<?php
												$cr = '';
												$chq = '';
												
												if($row['VType']==='CR'||$row['VType']==='PCR') $cr = $row['totals'];
												if($row['VType']==='CHQ' || $row['VType'] ==='BCHG') $chq = $row['totals'];
												$bank_balance += $cr-$chq; 
												
											?>
											<td><?php echo number_format($cr,2);?></td>
											<td><?php echo number_format($chq,2);?></td>
											<td><?php echo number_format($begin_bank+$bank_balance,2);?></td>
											
											<!-- Petty Cash Income and Expenses -->
											
											<?php
												
												$get_body = $this->db->select_sum(Cost)->select(array("AccNo","VType"))->get_where("voucher_body",array("hID"=>$row['hID']))->result_array();
												//print_r($get_body);
													$pcr = "";
													$pc = "";
												foreach($get_body as $rows):
													
													if($rows['AccNo']==='2000') $pcr = $rows['Cost'];
													if($rows['VType']==='PC' || $rows['VType']==='PCR') $pc = $rows['Cost'];
													$pc_balance += $pcr-$pc; 
											?>
												<td><?php echo number_format($pcr,2);?></td>
												<td><?php echo number_format($pc,2);?></td>
												<td><?php echo number_format($begin_pc+$pc_balance,2);?></td>
											<?php		
												endforeach;
											?>
												
																						
											
										</tr>
									<?php
										endforeach;
									?>
							</tbody>
						</table>
											
					</div>
					
				</div>
				
				
			</div>	

<style type="text/css">
    .popover{
        max-width:2500px;
    }

</style>
<script>

	$(document).ready(function($){
		
		//$('#scroll').click(function(){
			//var dateString = $('#scroll_date').val());
		    //dateParts = dateString.split('-'),
		
			//var tym = new Date(dateParts[0], parseInt(dateParts[1], 10) - 1, dateParts[2], 0, 0);
		

			//var url = '<?php //echo base_url();?>icp/scroll_journal/'+tym;
			
			//$.ajax({
				//url:url,
				//success:function(response){
					
				//}
			//});
		//});
		
		  //$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
		  //setInterval(function() {
		    //$('#journal').load('<?php echo base_url();?>icp/scroll_journal_refresh/<?php echo $tym;?>');
		  //}, 3000); // the "3000" 
		
			// On first hover event we will make popover and then AJAX content into it.
			$('[data-poload]').hover(
			    function (event) {
			        var el = $(this);
			
			        // disable this event after first binding 
			        el.off(event);
			
			        // add initial popovers with LOADING text
			        el.popover({
			            content: "loading…", // maybe some loading animation like <img src='loading.gif />
			            html: true,
			            placement: "auto top",
			            container: 'body',
			            trigger: 'hover'
			        });
			
			        // show this LOADING popover
			        el.popover('show');
			
			        // requesting data from unsing url from data-poload attribute
			        $.get(el.data('poload'), function (d) {
			            // set new content to popover
			            el.data('bs.popover').options.content = d;
			
			            // reshow popover with new content
			            el.popover('show');
			        });
			    },
			    // Without this handler popover flashes on first mouseout
			    function() { }
			);
			
			
			//Clear records
			$('.clr').on('switch-change', function(e, data) {
			var el = $(this);
	       	var hID = el.attr('id');
			//alert(data.value);
			
		        var state = 1;
		        if(data.value==true){
		        	state = 0;
		        }
		        
		        	var url = '<?php //echo base_url();?>index.php?icp/clear_bank_transactions/'+hID+'/'+state;	
					$.ajax({
							url: url,
							success: function(response)
							{
								//jQuery('#rate').val(response);
								//alert(response);
							},
							error:function(response){
								//alert(response);
							}
						});	
	        
	   		});
	    
			$('#monkey_dialog').click(function(){
				
			var $textAndPic = $('<div></div>');
        	$textAndPic.append('Who\'s this? <br />');
        	$textAndPic.append('<img  class="img-circle" src="uploads/icp_image/906.jpg" width="80"/>');
				
				var opts = {
						title:'Health Check',
		            	message: 'Hi <?php echo $this->session->firstname." ".$this->session->lastname;?>',
		            	draggable:true,
		            	buttons:[
		            		{
				                icon: 'glyphicon glyphicon-send',
				                label: 'Send a request',
				                cssClass: 'btn-info login-dialog',
				                autospin: true,
				                action: function(dialogRef){
				                    dialogRef.enableButtons(false);
				                    dialogRef.setClosable(false);
				                    dialogRef.getModalBody().html('Checking your books health!');
				                    setTimeout(function(){
				                        //dialogRef.close();
				                        dialogRef.getModalBody().html('Your books are health!');
				                        setTimeout(function(){dialogRef.close();},3000);
				                    }, 5000);
				                }
				            },
		            		{
		            			label:'Close',
		            			cssClass:'btn-warning',
		            			hotkey:13,
		            			action:function(dialog){
		            				//dialog.setTitle('Encouragement <div class="entypo-thumbs-up pull-right"></div>');
		            				//dialog.setMessage($textAndPic);
		            				//dialog.setSize(BootstrapDialog.SIZE_WIDE);
		            				dialog.close();
		            			}
		            		}
		            	]
		        	}
				//BootstrapDialog.SIZE_WIDE,
				BootstrapDialog.show(opts);
			});

	});
</script>

