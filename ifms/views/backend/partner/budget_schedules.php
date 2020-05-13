<?php
//$date  = $this->finance_model->project_fy_start_date($this->session->center_id);
//echo $this->db->get_where('opfundsbalheader',array('closureDate'=>$date))->row()->totalBal;
//$this->benchmark->mark('code_start');
?>
<div class="row">
	<div class="col-sm-12">
		<?php if($this->finance_model->check_opening_balances($this->session->center_id)===true){ ?>
		<div class="row">
			<div class="col-sm-12">
				<button onclick="PrintElem('#schedules');" class="btn btn-success btn-icon pull-right"><i class="fa fa-print"></i><?=get_phrase('print');?></button>
			</div>
			
			<div class="col-sm-12">
					<form>
						 <div class="form-group">
						 	<label class="control-label col-sm-3"><?=get_phrase('financial_year');?></label> 
						  	<div class="col-sm-4">
							  <div class="input-group col-sm-5 col-sm-offset-1">
							    <a href="" id="prev_fy" class="input-group-addon scroll-fy"><i class="glyphicon glyphicon-minus"></i></a>
							    <input id="scrolled_fy" value="<?=$fyr;?>" type="text" class="form-control text-center" name="scrolled_fy" placeholder="FY" readonly="readonly">
							    <a href="" id="next_fy" class="input-group-addon scroll-fy"><i class="glyphicon glyphicon-plus"></i></a>
							  </div>
							</div>
						</div>  
					</form>
				</div>
			</div>
			<hr />
		
			<?php
				$plan = $this->db->get_where('planheader',array('fy'=>$fyr,'icpNo'=>$this->session->center_id));
				
				if($plan->num_rows()>0){
			?>
					<div class="pull-left hidden-print">
						<div class="row">
							<div class="col-sm-12">
								<!-- <button onclick="new_budget_item(this);" class="btn btn-primary btn-icon"><i class="fa fa-plus-square"></i><?=get_phrase('new_budget_item');?></button> -->
								<!-- <button onclick="confirm_action('<?php echo base_url();?>ifms.php/partner/plans/delete_budget/<?php echo $this->db->get_where('planheader',array('fy'=>$fyr,'icpNo'=>$this->session->center_id))->row()->planHeaderID?>');"  class="btn btn-red btn-icon"><i class="fa fa-trash"></i><?=get_phrase('delete_new_items');?></button>
								<button onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_set_fy/<?php echo $fyr;?>/<?php echo $fyr+1;?>');" class="btn btn-warning btn-icon"><i class="fa fa-gg"></i><?=get_phrase('clone');?></button>-->
								<?php if(!empty($this->db->get_where('planheader',array('fy'=>$fyr,"icpNo"=>$this->session->center_id))->row())) {?> <button onclick="confirm_action('<?php echo base_url();?>ifms.php/partner/plans/mass_submit/<?php echo $this->db->get_where('planheader',array('fy'=>$fyr,"icpNo"=>$this->session->center_id))->row()->planHeaderID;?>');" class="btn btn-info btn-icon"><i class="fa fa-send"></i><?=get_phrase('mass_submit');?></button> <?php }?> 
							</div>
						</div>
											
					</div>
				<br/>
				
				<hr />
				
				<?php
					$cnt_months = range(1, 12);
					$budgeted_revenue_accounts = $this->finance_model->budgeted_revenue_accounts();
				?>
				
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="" class="control-label col-sm-4">Choose Account:</label>
							<div class="col-sm-6">
								<select id="show_account" class="form-control">
									<option value=""><?=get_phrase('select');?></option>
									<?php
										foreach($budgeted_revenue_accounts as $row){
									?>
										<optgroup label="<?=$row->AccText;?> - <?=$row->AccName;?>">
											<?php
											$expense_accounts = $this->finance_model->expense_accounts($row->accID);
							
											foreach($expense_accounts as $row2){
											?>
													<option value="<?=$row2->accID;?>"><?=$row2->AccText.' - '.$row2->AccName;?></option>
											<?php	
											}
											?>
										</optgroup>
										
										
									<?php
										}
									?>
									
								</select>
							</div>
							<div>
								<button id="show_schedule" class="btn btn-primary">Show</button>
							</div>
						</div>
					</div>
				</div>
				
				<hr/>

				<div id="schedules">
					<!--Load a schedule here-->
												
				</div>	
			
			<?php 
			}
			} else{ echo get_phrase('please_set_opening_balances');}?>
		
</div>
</div>	

<?php
//$this->benchmark->mark('code_end');

//echo $this->benchmark->elapsed_time('code_start', 'code_end');
?>

<script>
// function new_budget_item(elem){
	// showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_new_budget_item/'+$('#scrolled_fy').val());
// 	
// }

$(document).ready(function(){
		$('.tr-schedule').each(function(){

			var total = 0;	
			
			$(this).find('.schedule-amount').each(function(){
				total += parseFloat($(this).html());
			});
			
			if(parseFloat(total)===parseFloat($(this).find('.td-total-cost').html())){
				$(this).find('.validate').html('<span class="label label-success"><?=get_phrase('ok');?></span>');
			}else{
				$(this).find('.validate').html('<span class="label label-danger"><?=get_phrase('incorrect');?></span>');
			}
			
		});
	});
	
	$('.scroll-fy').click(function(){
		var fy = $(this).siblings('input').val();
		
		if($(this).attr('id')==='next_fy'){
			$(this).siblings('input').val(parseInt(fy)+1); 
		}else{
			$(this).siblings('input').val(parseInt(fy)-1);
		}
		
		
		$(this).attr('href','<?php echo base_url();?>ifms.php/partner/scroll_budget_schedules/'+$(this).siblings('input').val());
		
	});
	
function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: ".",             
		    removeInline: false,        
		    printDelay: 333,            
		   	header:null,            
		    formValues: true          
		});
    }
    
  	$("#show_schedule").click(function(){
  		var fy = $("#scrolled_fy").val();
  		var account = $("#show_account").val();
  		var icpNo = '<?=$this->session->center_id;?>';
  		var data = {"fy":fy,"accID":account,"icpNo":icpNo};
  		var url = "<?=base_url();?>ifms.php/partner/load_budget_schedule_account";
  		
  		if(account=="") {alert("<?=get_phrase("please_choose_a_valid_account");?>"); return false;}
  		
  		$.ajax({
  			url:url,
  			type:"POST",
  			data:data,
  			beforeSend:function(){
  				$('#schedules').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url();?>uploads/preloader4.gif" /></div>');
  			},
  			success:function(resp){
  				$("#schedules").html(resp);
  			},
  			error:function(){
  				
  			}
  		});
  		
  	});
  	
  	

  	
  
</script>	