<?php

$voucher_array = array();

if(!empty($param3)){
	$raw_array = explode('_', $param3);
	$this->db->where_in('VNumber', $raw_array);
	$this->db->where(array('icpNo'=>$this->session->center_id,'TDate>='=>date('Y-m-01',$param2),'TDate<='=>date('Y-m-t',$param2)));
	$voucher_array = $this->db->get('voucher_header')->result_object();
	
}else{
	$this->db->where(array('icpNo'=>$this->session->center_id,'TDate>='=>date('Y-m-01',$param2),'TDate<='=>date('Y-m-t',$param2)));
	$voucher_array = $this->db->get('voucher_header')->result_object();
}

//print_r($voucher_array);

?>

<style>
    
@media print {
	    div.break 
	    	{
	    		page-break-after: always;
	    	}
	    
	}
</style>

<div class="row">
	<div class="col-sm-12">
	
	<a href="#" onclick="PrintElem('#print_all');" class="btn btn-primary btn-icon hidden-print icon-left"><i class="fa fa-print"></i><?=get_phrase('print');?></a>
	
	<div id="print_all">	
	<?php
		foreach($voucher_array as $row):
	?>
							<table  class="table table-striped datatable">
							<thead>
								<tr>
									<th colspan="6" style="text-align:center;"><?php echo $this->session->center_id;?><br><?=get_phrase('transaction_voucher');?></th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td  colspan="3"><span style="font-weight: bold;">Date: </span> <?php echo $row->TDate;?></td>
									<td  colspan="3"><span style="font-weight: bold;">Number: </span> <?php echo $row->VNumber;?></td>
								</tr>
								
								<tr>
									<td colspan="6"><span style="font-weight: bold;">Vendor/Payee: </span> <?php echo $row->Payee;?></td>
								</tr>
								
								<tr>
									<td  colspan="3"><span style="font-weight: bold;">Address: </span> <?php echo $row->Address;?></td>
									<td  colspan="3"><span style="font-weight: bold;">Voucher Type: </span> <?php echo $row->VType;?></td>
								</tr>
								
								<tr>
									<td colspan="6"><span style="font-weight: bold;">Description: </span> <?php echo $row->TDescription;?></td>
								</tr>
								
								<tr style="font-weight: bold;">
									<td>Quantity</td>
									<td colspan="2">Items Purchased/ Service Received</td>
									<td>Unit Cost</td>
									<td>Cost</td>
									<td>Account</td>
								</tr>
								
								<?php
									
										$cond = "hID=".$row->hID;
										$body = $this->db->where($cond)->get('voucher_body')->result_array();
										$sum_cost = 0;
										foreach($body as $rows):
								?>
									<tr>
										<td><?php echo $rows['Qty'];?></td>
										<td colspan="2"><?php echo $rows['Details'];?></td>
										<td><?php echo number_format($rows['UnitCost'],2);?></td>
										<td><?php echo number_format($rows['Cost'],2);?></td>
										<td><?php echo $rows['AccNo'];?></td>
									</tr>
								<?php
									$sum_cost +=$rows['Cost'];
									endforeach;
								?>
								<tr>
									<td colspan="4" style="font-weight: bold;">Totals</td>
									<td colspan="2"><?php echo number_format($sum_cost,2);?></td>
								</tr>
								
								<tr>
									<td><span style="font-weight: bold;">Raised By</span></td>
									<td colspan="2"><span style="font-weight: bold;">Name: </span> <?=$this->db->get_where('users',array('users_id'=>$row->raiser_id))->row()->name;?> </td>
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
						
						<div class="break"></div>
		<?php
			endforeach;
		?>
		</div>
	</div>					
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
		    pageTitle: ".",             
		    removeInline: false,        
		    printDelay: 333,            
		   	header:null,            
		    formValues: true          
		});
    }
</script>

