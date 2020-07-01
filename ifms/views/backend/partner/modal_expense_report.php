<?php
//echo get_fy($param2,$this->session->center_id);
?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="fa fa-vcard"></i>
					<?php echo get_phrase('expenses_report');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
			
						
			<div class="row">
					<div class="col-sm-12">
						<a href="#" class="fa fa-print" onclick="PrintElem('#frm_expenses');"><?=get_phrase('print');?></a>
					</div>
			</div>	
			<div id="frm_expenses">		
				<?php echo form_open('', array('id'=>'frm_expense_accounts','class' => 'form-horizontal'));?>
			
					<div class="form-group">
						<label class="control-label col-sm-4"><?=get_phrase('revenue');?></label>
						<div class="col-sm-8">
							<select class="form-control" id="revenue_id" name="revenue_id">
								<option><?=get_phrase('select');?></option>
								<?php
									$rev = $this->db->get_where('accounts',array("AccGrp"=>"1"))->result_object();
									
									foreach($rev as $row):
									
									if($this->finance_model->total_expense_to_date_per_revenue_vote($this->session->center_id,$row->accID,$param2)>0){
								?>
									<option value="<?=$row->AccNo;?>"><?=$row->AccText;?> - <?=$row->AccName;?></option>
								<?php
									}
									endforeach;
								?>
							</select>		
						</div>				
					</div>	
					
					
					
					<!--<div class="form-group">
						<button id="btn_check" class="btn btn-primary btn-icon"><i class="fa fa-search-plus"></i><?=get_phrase('search');?></button>
					</div>-->
			</form>
				
			
			<div class="row">
				<div class="col-sm-12" id="expense_data">
					
				</div>
			</div>	
			
			</div>
			
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('.expense_report').css('display','none');
});	

$('#revenue_id').change(function(ev){

	var rpt_id = $('#revenue_id').val();
	
	//alert(rpt_id);
	
	//$('.expense_report').each(function(i,e){

		//if($(e).attr('id')===rpt_id){
			//$(e).css('display','block');
		//}else{
			//$(e).css('display','none');
		//}
	//});
	
	var url = '<?=base_url();?>ifms.php/partner/load_expense_data/<?=$this->session->center_id?>/'+rpt_id+'/<?=$param2?>';
	
	jQuery('#expense_data').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url();?>uploads/preloader.gif" /></div>');
	
	$.ajax({
		url:url,
		success:function(response){
			$('#expense_data').html(response);
		}
	});
	
	ev.preventDefault();
});

	   function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: "<?php echo get_phrase('payment_voucher');?>",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: null,             
		    formValues: true          
		});
    }
</script>				