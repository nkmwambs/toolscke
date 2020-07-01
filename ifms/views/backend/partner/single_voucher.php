<!--<h3>Voucher # <?=$row['VNumber'];?></h3>
<p>Description: <?=$row['TDescription'];?></p>
<p>Voucher Type: <?=$row['VType'];?></p>
<p>Cost: <?=number_format($row['totals'],2);?></p>-->

<?php
$VNumber = $row['VNumber'];

$icpNo = $this->session->userdata('icp_no');

$voucher_header = $this->db->get_where('voucher_header',array("icpNo"=>$icpNo,"VNumber"=>$VNumber))->row(0);

$cond_summary = "Month(TDate)='".date('m',strtotime($voucher_header->TDate))."' AND Year(TDate)='".date('Y',strtotime($voucher_header->TDate))."'";
//$summary = $this->db->where($cond_summary)->select_sum('Cost')->select(array("AccNo"))->group_by('AccNo')->order_by('AccNo')->get('voucher_body')->result_array();


?>

		<table class="table" style="font-size: 8pt;">
			<thead>
				<tr> 
					<div style="float: left;" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_voucher/<?php echo $row['VNumber'];?>');"><i class="fa fa-search"></i></div>
					
					<a style="float: left;" href="<?php echo base_url();?>icp/finance/scroll_journal/<?php echo strtotime($row['TDate']);?>"><i class="fa fa-backward"></i></a>
				</tr>
				<tr>
					<th colspan="3" style="text-align:center;"><?php echo $icpNo;?><br>Voucher</th>
				</tr>
			</thead>
			<tbody>
								
				<tr>
					<td colspan="3"><span style="font-weight: bold;">Date: </span> <?php echo $voucher_header->TDate;?></td>
				</tr>
				
				<tr>
					<td colspan="3"><span style="font-weight: bold;">Number: </span> <?php echo $voucher_header->VNumber;?></td>
				</tr>
								
				<tr>
					<td  colspan="3"><span style="font-weight: bold;">Voucher Type: </span> <?php echo $voucher_header->VType;?></td>
				</tr>
								
				<tr>
					<td colspan="3"><span style="font-weight: bold;">Description: </span> <?php echo substr($voucher_header->TDescription,0,15);?></td>
				</tr>
								
								
				<?php
									
						$cond = "hID=".$voucher_header->hID;
						$body = $this->db->where($cond)->get('voucher_body')->result_array();
						$sum_cost = 0;
						foreach($body as $row):
			

					$sum_cost +=$row['Cost'];
					endforeach;
				?>
				<tr>
					<td style="font-weight: bold;">Totals</td>
					<td colspan="2"><?php echo number_format($sum_cost,2);?></td>
				</tr>
								
			</tbody>
		</table>
		

