<div class="row">
			<div class="col-sm-12">
				<button onclick="PrintElem('#get_vouchers');" class="btn btn-success btn-icon pull-right"><i class="fa fa-print"></i><?=get_phrase('print');?></button>
				<a href="<?=base_url();?>ifms.php/partner/scroll_cash_journal/<?=$tym;?>" class="btn btn-info btn-icon pull-right"><i  class="fa fa-arrow-left" aria-hidden="true"></i><?=get_phrase('cash_journal');?></a>
			</div>
</div>
<hr />

<?php

if(empty($vouchers)){
?>	
<div class="row">	
	<div class="col-sm-12">	
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="fa fa-vcard"></i>
					<?php echo get_phrase('vouchers');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">
				<?php
				echo get_phrase('You have not selected voucher');
			?>
	</div>
</div>
</div>
</div>
	
<?php
}else{

$icpNo = $this->session->center_id;
?>

<div id="get_vouchers">
	
<?php
foreach($vouchers as $rw=>$val):
//echo $param2;
$VNumber = $val;


$voucher_header = $this->db->get_where('voucher_header',array("icpNo"=>$icpNo,"VNumber"=>$VNumber))->row(0);

$cond_summary = "Month(TDate)='".date('m',strtotime($voucher_header->TDate))."' AND Year(TDate)='".date('Y',strtotime($voucher_header->TDate))."'";
//$summary = $this->db->where($cond_summary)->select_sum('Cost')->select(array("AccNo"))->group_by('AccNo')->order_by('AccNo')->get('voucher_body')->result_array();

//print_r($summary);
?>
			


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
						Voucher # <?=$VNumber?>
            	</div>
            </div>
						<table  class="table">
							<thead>
								<tr>
									<th colspan="6" style="text-align:center;"><?php echo $icpNo;?><br>Compassion Assisted Project Voucher</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td  colspan="3"><span style="font-weight: bold;">Date: </span> <?php echo $voucher_header->TDate;?></td>
									<td  colspan="3"><span style="font-weight: bold;">Number: </span> <?php echo $voucher_header->VNumber;?></td>
								</tr>
								
								<tr>
									<td colspan="3"><span style="font-weight: bold;">Vendor/Payee: </span> <?php echo $voucher_header->Payee;?></td>
									<?php $chqNo = explode("-",$voucher_header->ChqNo);?>
									<td  colspan="3"><span style="font-weight: bold;">Cheque Number: </span> <?php echo $chqNo[0];?></td>
								</tr>
								
								<tr>
									<td  colspan="3"><span style="font-weight: bold;">Address: </span> <?php echo $voucher_header->Address;?></td>
									<td  colspan="3"><span style="font-weight: bold;">Voucher Type: </span> <?php echo $voucher_header->VType;?></td>
								</tr>
								
								<tr>
									<td colspan="6"><span style="font-weight: bold;">Description: </span> <?php echo $voucher_header->TDescription;?></td>
								</tr>
								
								<tr style="font-weight: bold;">
									<td>Quantity</td>
									<td colspan="2">Items Purchased/ Service Received</td>
									<td>Unit Cost</td>
									<td>Cost</td>
									<td>Account</td>
								</tr>
								
								<?php
									
										$cond = "hID=".$voucher_header->hID;
										$body = $this->db->where($cond)->get('voucher_body')->result_array();
										$sum_cost = 0;
										foreach($body as $row):
								?>
									<tr>
										<td><?php echo $row['Qty'];?></td>
										<td colspan="2"><?php echo $row['Details'];?></td>
										<td><?php echo number_format($row['UnitCost'],2);?></td>
										<td><?php echo number_format($row['Cost'],2);?></td>
										<?php
											$accs = $this->db->get_where('accounts',array("AccNo"=>$row['AccNo']))->row(0);
										?>
										<td title="<?php echo $accs->AccName;?>"><?php echo $accs->AccText;?></td>
									</tr>
								<?php
									$sum_cost +=$row['Cost'];
									endforeach;
								?>
								<tr>
									<td colspan="4" style="font-weight: bold;">Totals</td>
									<td colspan="2"><?php echo number_format($sum_cost,2);?></td>
								</tr>
								
								<tr>
									<td><span style="font-weight: bold;">Raised By</span></td>
									<td colspan="2"><span style="font-weight: bold;">Name: </span> </td>
									<td colspan="3"><span style="font-weight: bold;">Signature: </span></td>
								</tr>
								<tr>
									<td colspan="3"><span style="font-weight: bold;">Verified By</span></td>
									<td colspan="3"><span style="font-weight: bold;">Approved By</span></td>
								</tr>
								<tr>
									<td>Name: </td><td colspan="2">Signature: </td> <td>Name: </td><td colspan="2">Signature</td>
								</tr>
								<tr>
									<td>Name: </td><td colspan="2">Signature: </td> <td>Name: </td><td colspan="2">Signature</td>
								</tr>
								
								<tr>
									<td>Name: </td><td colspan="2">Signature: </td> <td>Name: </td><td colspan="2">Signature</td>
								</tr>
							</tbody>
						</table>
           
        </div>
    </div>
</div>
<p style="page-break-after:always;"></p>

<?php
	endforeach;
	}
?>
</div>
<script>
	    function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: "<?php echo get_phrase('payment_vouchers');?>",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: null,             
		    formValues: true          
		});
    }
</script>