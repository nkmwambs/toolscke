

<style>
	.can-hide{
		display: none;
	}
</style>

<hr />

<div class="row">
	<div class="col-sm-12">
		<form role="form" class="form-horizontal form-groups-bordered">
			<div class="form-group">
				<label for="" class="control-label col-sm-2">Scroll Month</label>
					<div class="col-sm-4">
						<div class="input-spinner">
							<button type="button" class="btn btn-danger btn-lg">-</button>
							<input readonly="readonly" type="text" id="scroll_months" class="form-control size-1 input-lg" value="0" />
							<button type="button" class="btn btn-danger btn-lg">+</button>
						</div>
					</div>
					<div class="col-sm-2">
						<div id="go_btn" class="btn btn-danger pull-left btn-lg">Go</div>
					</div>
					<div class="col-sm-3">
						<a href="#" class="btn btn-info btn-icon btn-lg" onclick="PrintElem('#print_journal');"><i class="fa fa-print"></i><?=get_phrase('print');?></a>
					</div>
			</div>
							
							
		</form>
	</div>
</div>

<hr />
<!-- Summary table -->
<div id="print_journal">					


<?php 

	include "include_journal_queries.php";
	
	$bank_opening_balance = $proof_of_cash_grid["BC"]['ob'];
	$petty_opening_balance = $proof_of_cash_grid["PC"]['ob'];
	//print_r($balance_array);
?>

<div class="row">
	<div class="col-sm-12">
		<div id="balance_summary">
									
			<table class="table table-bordered">
				<thead>
					<tr>
						<th colspan="6" style="text-align: center;font-weight: bold;"><?php echo $this->session->userdata('center_id');?><br/><?=get_phrase('cash_journal');?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="2" style="font-weight: bold;"><?=get_phrase('period');?></td>
						<td style="font-weight: bold;"><?=get_phrase('month');?></td>
						<td><?php echo date('M',strtotime($month));?></td>
						<td style="font-weight: bold;"><?=get_phrase('year');?></td>
						<td><?php echo date('Y',strtotime($month));?></td>
					</tr>	
					<tr>	
						<td style="font-weight: bold;"><?=get_phrase('balance_brought_forward');?></td>
						<td rowspan="4" style="font-weight: bold;"><?=get_phrase('bank');?></td>
						<td style="text-align: right;"><?=number_format($proof_of_cash_grid["BC"]["ob"],2);?></td>
						<td rowspan="4" style="font-weight: bold;"><?=get_phrase("petty_cash");?></td>
						<td  colspan="2" style="text-align: right;"><?=number_format($proof_of_cash_grid["PC"]["ob"],2);?></td>							
					</tr>
										
					<tr>
						<td style="font-weight: bold;"><?=get_phrase('deposit');?></td>
						<td style="text-align: right;"><?=number_format($proof_of_cash_grid["BC"]["mi"],2);?></td>
						<td colspan="2" style="text-align: right;"><?=number_format($proof_of_cash_grid["PC"]["mi"],2)?></td>
					</tr>
					<tr>
						<td style="font-weight: bold;"><?=get_phrase('payment');?></td>
						<td style="text-align: right;"><?=number_format($proof_of_cash_grid["BC"]["me"],2);?></td>
						<td colspan="2" style="text-align: right;"><?=number_format($proof_of_cash_grid["PC"]["me"],2)?></td>
					</tr>
					<tr>
						<td style="font-weight: bold;"><?=get_phrase('end_month_balance');?></td>
						<td style="text-align: right;"><?=number_format($proof_of_cash_grid["BC"]["cb"],2);?></td>
						<td colspan="2" style="text-align: right;"><?=number_format($proof_of_cash_grid["PC"]["cb"],2)?></td>
					</tr>
											
				</tbody>
			</table>
		</div>	
					
					
	<!-- End Summary table -->	
	
	<hr />
		<button class="btn btn-default" id="show_hide_btn">Show/Hide Spread</button>
		<button class="btn btn-default">Select All Vouchers</button>
		<button class="btn btn-default">Print Selected Vouchers</button>
	<hr/>


	<table class="table table-striped journal">
		<thead>
			<tr>
				<?php //array_shift($main_section_header_label);?>
				<th style="text-align: center;" colspan="<?=count($main_section_header_label);?>">Cash Journal</th>
			</tr>
			<tr>
				<?php foreach(array_values($real_header_labels) as $value):?>
					<td><?=$value;?></td>	
				<?php endforeach;?>
				<th class='can-hide' style="border-right: 2px black solid;" colspan="<?=count($ordered_utilized_accounts[1]);?>">Income</th>
				<th class='can-hide' colspan="<?=count($ordered_utilized_accounts[0]);?>">Expenses</th>
			</tr>
			<tr>
				<th colspan="6">Balance Brought Forward:</th>
				<th colspan="2">Bank:</th><th><?=number_format($bank_opening_balance,2);?></th>
				<th colspan="2">Petty Cash:</th><th><?=number_format($petty_opening_balance,2);?></th>
				<?php foreach($ordered_utilized_accounts[1] as $row): ?>
					<th class='can-hide'><?=$row[1]?></th>
				<?php endforeach;?>	
					
				<?php if(isset($ordered_utilized_accounts[0])){ foreach($ordered_utilized_accounts[0] as $row): ?>
					<th class='can-hide'><?=$row[1]?></th>
				<?php endforeach;}?>	
			
			</tr>
			
		</thead>
		<tbody>
			<?php 
				$i = 0;
				 foreach($months_transactions_with_main_spread_acc_keys as $row):?>
				<tr>
					<?php 
						/**Main Section Part**/
						foreach(array_keys($real_header_labels) as $label):
							
							if($label == 'bank_bal'){
								echo "<td>".number_format($balance_array[$i]['bank'],2)."</td>";
							}elseif($label == 'petty_bal'){
								echo "<td>".number_format($balance_array[$i]['petty'],2)."</td>";
							}elseif($label == 'bank_inc' || $label == 'bank_exp' || $label == 'petty_inc' || $label == 'petty_exp'){
								echo "<td>".number_format($row['main'][$label],2)."</td>";
							}elseif($label == 'VNumber'){
							?>	
								<td><div onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_view_voucher/<?=$row['main'][$label];?>')" class='btn btn-primary'><input type='checkbox'/><?=$row['main'][$label];?></div></td>
							<?php
							}elseif($label == 'ChqNo'){
								$chq_string = explode("-",$row['main'][$label]);
								echo "<td>".$chq_string[0]."</td>";
							}else{
								echo "<td>".$row['main'][$label]."</td>";
							}
								
					 	endforeach;
						
						
						/**Spread Part**/
						
						foreach($all_utilized_acc_in_order as $acc){
							if(array_key_exists($acc, $row['spread'])){
								echo "<td style='font-weight:bold;' class='can-hide'>".number_format($row['spread'][$acc])."</td>";
							}else{
								echo "<td style='color:#C8C8C8;' class='can-hide'>0.00</td>";
							}
						}
						
					?>
					
							
				</tr>
			<?php 
				$i++;
				endforeach;?>
		</tbody>
	</table>


</div>

</div>

</div>

<script>
	$(document).ready(function(){
						
			$('.journal').DataTable( {
				"ordering": false,
		        dom: 'Bfrtip',
		        buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdfHtml5'
		        ]
		    } );
	});
	
	$("#show_hide_btn").click(function(){
		$(".can-hide").toggleClass("can-show");
	});
	
	function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: "<?php echo get_phrase('cash_journal');?>",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: null,             
		    formValues: true          
		});
    }
    
        $("#go_btn").click(function(){
    	var url = "<?=base_url();?>ifms.php/partner/scroll_cash_journal/<?=$month;?>/"+$("#scroll_months").val();
    	
    	$.ajax({
    		url:url,
    		beforeSend:function(){
    			$('#print_journal').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url();?>uploads/preloader4.gif" /></div>');
    		},
    		success:function(resp){
    			$('#print_journal').html(resp);
    			$("#scroll_months").val("0");
    		},
    		error:function(){
    			
    		}
    	});
    });
</script>