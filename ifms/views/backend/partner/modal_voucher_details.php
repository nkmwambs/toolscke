<?php
//echo $param2;
$VNumber = $param2;
$icpNo = $this->session->userdata('icp_no');

$voucher_header = $this->db->get_where('voucher_header',array("icpNo"=>$icpNo,"VNumber"=>$VNumber))->row(0);

$cond = "hID=".$voucher_header->hID;
$body = $this->db->where($cond)->select_sum('Cost')->select(array("AccNo"))->group_by('AccNo')->order_by('AccNo')->get('voucher_body')->result_array();

$cond_summary = "Month(TDate)='".date('m',strtotime($voucher_header->TDate))."' AND Year(TDate)='".date('Y',strtotime($voucher_header->TDate))."' AND AccNo<100";
$summary = $this->db->where($cond_summary)->select_sum('Cost')->select(array("AccNo"))->group_by('AccNo')->order_by('AccNo','ASC')->get('voucher_body')->result_array();

$cond_summary_rev = "Month(TDate)='".date('m',strtotime($voucher_header->TDate))."' AND Year(TDate)='".date('Y',strtotime($voucher_header->TDate))."' AND AccNo>99 AND AccNo<1000";
$summary_rev = $this->db->where($cond_summary_rev)->select_sum('Cost')->select(array("AccNo"))->group_by('AccNo')->order_by('AccNo','ASC')->get('voucher_body')->result_array();


$cond_summary_none_support = "Month(TDate)='".date('m',strtotime($voucher_header->TDate))."' AND Year(TDate)='".date('Y',strtotime($voucher_header->TDate))."' AND AccNo>1000 AND AccNo<2000";
$summary_none_support = $this->db->where($cond_summary_none_support)->select_sum('Cost')->select(array("AccNo"))->group_by('AccNo')->order_by('AccNo','ASC')->get('voucher_body')->result_array();

?>

<!-- Sum of Revenues Per Account for the month -->
<div class="row">
	<div class="col-md-12">
		<table  class="table table-bordered">
							
							<thead>
								<tr>
									<th colspan="<?php echo count($summary_rev);?>">
										<?php echo get_phrase('sum_of_revenues_per_account_for_the_month');?>
									</th>
								</tr>
								<tr>
								<?php
										foreach($summary_rev as $row1):

										$accs = $this->db->get_where('accounts',array("AccNo"=>$row1['AccNo']))->row(0);
								?>
										<th title="<?php echo $accs->AccName;?>"><?php echo $accs->AccText;?></th>
									
								<?php
									endforeach;
								?>									
								</tr>
							</thead>
							
							<tbody>	
							<tr>
								<?php
									
										foreach($summary_rev as $row2):
								?>

										<td><?php echo number_format($row2['Cost'],2);?></td>
									
								<?php
									endforeach;
								?>
							</tr>
							</tbody>
						</table>
	</div>
</div>

<!-- Sum of Support Expenses per Account for the Month -->
<div class="row">
	<div class="col-md-12">
		<table  class="table table-bordered">
							
							<thead>
								<tr>
									<th colspan="<?php echo count($summary);?>">
										<?php echo get_phrase('sum_of_support_expenses_per_account_for_the_month');?>
									</th>
								</tr>
								<tr>
								<?php
										foreach($summary as $row1):

										$accs = $this->db->get_where('accounts',array("AccNo"=>$row1['AccNo']))->row(0);
								?>
										<th title="<?php echo $accs->AccName;?>"><?php echo $accs->AccText;?></th>
									
								<?php
									endforeach;
								?>									
								</tr>
							</thead>
							
							<tbody>	
							<tr>
								<?php
									
										foreach($summary as $row2):
								?>

										<td><?php echo number_format($row2['Cost'],2);?></td>
									
								<?php
									endforeach;
								?>
							</tr>
							</tbody>
						</table>
	</div>
</div>

<!-- Sum of Non Support Expenses per Account for the Month -->

<div class="row">
	<div class="col-md-12">
		<table  class="table table-bordered">
							
							<thead>
								<tr>
									<th colspan="<?php echo count($summary_none_support);?>">
										
										<?php echo get_phrase('sum_of_none_support_expenses_per_account_for_the_month');?>
									</th>
								</tr>
								<tr>
								<?php
										foreach($summary_none_support as $row1):

										$accs = $this->db->get_where('accounts',array("AccNo"=>$row1['AccNo']))->row(0);
								?>
										<th title="<?php echo $accs->AccName;?>"><?php echo $accs->AccText;?></th>
									
								<?php
									endforeach;
								?>									
								</tr>
							</thead>
							
							<tbody>	
							<tr>
								<?php
									
										foreach($summary_none_support as $row2):
								?>

										<td><?php echo number_format($row2['Cost'],2);?></td>
									
								<?php
									endforeach;
								?>
							</tr>
							</tbody>
						</table>
	</div>
</div>

<!-- Sum per Account in Voucher -->

<div class="row">
	<div class="col-md-12">						
						<table  class="table table-bordered">
							
							<thead>
								<tr>
									<th colspan="<?php echo count($body);?>">
										
										<?php echo get_phrase('sum_per_account_in_voucher')." ".$VNumber;?>
									</th>
								</tr>
								<tr>
								<?php
										foreach($body as $row1):

										$accs = $this->db->get_where('accounts',array("AccNo"=>$row1['AccNo']))->row(0);
								?>
										<th title="<?php echo $accs->AccName;?>"><?php echo $accs->AccText;?></th>
									
								<?php
									endforeach;
								?>									
								</tr>
							</thead>
							
							<tbody>	
							<tr>
								<?php
									
										foreach($body as $row2):
								?>

										<td><?php echo number_format($row2['Cost'],2);?></td>
									
								<?php
									endforeach;
								?>
							</tr>
							</tbody>
						</table>
    </div>
</div>



<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'Vocuher', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Voucher</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>