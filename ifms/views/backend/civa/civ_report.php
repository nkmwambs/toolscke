<?php
// $icps_civs_open_income_statement = "SELECT SUM(`voucher_body`.`Cost`) as Cost,`civa`.`civaID` as civaID,`voucher_body`.`icpNo` as icpNo,";
// $icps_civs_open_income_statement .= "`civa`.`AccNoCIVA` as AccNoCIVA,`civa`.`closureDate` as closureDate,`accounts`.`AccGrp` as AccGrp,`civa`.`accID` as accID  FROM `voucher_body`"; 
// $icps_civs_open_income_statement .= "LEFT JOIN `accounts` ON `voucher_body`.`AccNo`=`accounts`.`AccNo`"; 
// $icps_civs_open_income_statement .= "LEFT JOIN `civa` ON `voucher_body`.`civaCode`=`civa`.`civaID`"; 
// $icps_civs_open_income_statement .= "WHERE `civa`.`open`='1'"; 
// $icps_civs_open_income_statement .= "GROUP BY `voucher_body`.`icpNo`,`accounts`.`AccGrp`,`civa`.`civaID`"; 

//$icps_civs_open_income = $this->db->query($icps_civs_open_income_statement)->result_object();

$this->db->select(array('accounts.accID as account_id','parentAccID','civaID','icpNo',
'AccNoCIVA','closureDate','AccGrp','civa.accID as accID'));
$this->db->select_sum('Cost');
$this->db->join('accounts','accounts.AccNo=voucher_body.AccNo');
$this->db->join('civa','civa.civaID=voucher_body.civaCode');
$this->db->group_by('icpNo','civaID');
$this->db->where(array('open'=>1));
$icps_civs_open_income = $this->db->get('voucher_body')->result_object();

print_r($icps_civs_open_income);

$refined_arr = array();

foreach($icps_civs_open_income as $rw){
	$refined_arr[trim($rw->icpNo)][trim($rw->AccNoCIVA)][$rw->AccGrp] = array('civaID'=>$rw->civaID,'accID'=>$rw->accID,'closureDate'=>$rw->closureDate,'Cost'=>$rw->Cost);
}

?>

<div class="row">
	<div class="col-sm-12">
		<a href="<?=base_url();?>ifms.php/civa/civ_report/closed" class="btn btn-danger"><?=get_phrase('closed_interventions_report');?></a>	
	</div>
</div>
<hr />
<div class="row">
	<div class="col-md-12">
	    	<div class="row">
	            <div class="col-md-12 col-xs-12">    
	                <div class="panel panel-info" data-collapsed="0">
	                    <div class="panel-heading">
	                        <div class="panel-title">
	                           <i class="fa fa-book"></i> 
	                            <?php echo get_phrase('open_interventions_report');?>
	                        </div>
	                    </div>
	                 <div class="panel-body" style="padding:0px;overflow: auto;">
	                 		<table class="table table-striped datatable">
	                 			<thead>
	                 				<tr>
	                 					<th><?=get_phrase('project');?></th>
	                 					<th><?=get_phrase('intervention_code');?></th>
	                 					<th><?=get_phrase('completion_date');?></th>
	                 					<th><?=get_phrase('income');?></th>
	                 					<th><?=get_phrase('expense');?></th>
	                 					<th><?=get_phrase('balance');?></th>
	                 				</tr>
	                 			</thead>
	                 			<tbody>
	                 				<?php
	                 				foreach($refined_arr as $fcp_number=>$civ_income_or_expense_record){
	                 					$civ_income = 0;
										$civ_expense = 0;
										$balance = 0;
	                 					foreach($civ_income_or_expense_record as $AccNoCIVA=>$civ_account_groups){
	                 				?>
	                 						
	                 							<tr>
		                 							<td><?=$fcp_number;?></td>
													<td><?=$AccNoCIVA;?></td>
		                 							<td>
		                 								<?php
		                 									if(isset($civ_account_groups[1])){
		                 										echo $civ_account_groups[1]['closureDate'];
		                 									}elseif(isset($civ_account_groups[0])){
		                 										echo $civ_account_groups[0]['closureDate'];
		                 									} 
		                 								?>
		                 							</td>
		                 							<td style="text-align: right;">
		                 								<?php
		                 									if(isset($civ_account_groups[1])) {
																 $civ_income = $civ_account_groups[1]['Cost'];
																
																 $balance = $civ_income-$civ_expense;
															 }
		                 									
		                 								?>
		                 								<a class="btn btn-default" href="#" <?php if(isset($civ_account_groups[1]['civaID'])){?> onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_show_breakdown/<?=$fcp_number;?>/<?=$civ_account_groups[1]['civaID'];?>');" <?php }?> ><?=number_format($civ_income,2);?></a>
		                 							</td>
		                 							<td style="text-align: right;">
		                 								<?php
		                 									if(isset($civ_account_groups[0])) {
																
																$civ_expense = $civ_account_groups[0]['Cost'];
																$balance = $civ_income-$civ_expense;
																}
		  
		                 								?>
		                 								<a class="btn btn-default" href="#" <?php if(isset($civ_account_groups[0]['civaID'])){?> onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_show_breakdown/<?=$fcp_number;?>/<?=$civ_account_groups[0]['civaID'];?>');" <?php }?> ><?=number_format($civ_expense,2);?></a>
		                 							</td>
		                 							<td style="text-align: right;">
		                 								<?php
		                 									echo number_format($balance,2);
		                 								?>
		                 							</td>
		                 							
	                 							</tr>
	                 				<?php
										}	
	                 				}
	                 				?>
	                 				
	                 			</tbody>
	                 		</table>
	                 </div>
	              </div>
	           </div>
	       </div>
	   </div>
</div>	                 	


    <script>
	$(document).ready(function(){
		var datatable = $('.table').DataTable({
			stateSave: true,
			"bSort" : false ,
			lengthMenu: [[25,50, 100, 150,-1], [25,50 ,100,150 ,"All"]],
			pageLength: 25,
			dom: '<"row"l><Bf><"col-sm-12"rt><ip>',
		       //sDom:'r',
		    pagingType: "full_numbers",
		    buttons: [
		           'csv', 'excel', 'print'
		       ]
		});
		
		
		    if (location.hash) {
			        $("a[href='" + location.hash + "']").tab("show");
			    }
			    $(document.body).on("click", "a[data-toggle]", function(event) {
			        location.hash = this.getAttribute("href");
			    });
			});
			
			$(window).on("popstate", function() {
			    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
			    $("a[href='" + anchor + "']").tab("show");
		
	});
	

  </script>