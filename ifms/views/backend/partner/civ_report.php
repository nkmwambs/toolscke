<?php
$icps_civs_open_income_statement = "SELECT SUM(`voucher_body`.`Cost`) as Cost,`civa`.`civaID` as civaID,`voucher_body`.`icpNo` as icpNo,";
$icps_civs_open_income_statement .= "`civa`.`AccNoCIVA` as AccNoCIVA,`civa`.`closureDate` as closureDate,`accounts`.`AccGrp` as AccGrp,`civa`.`accID` as accID  FROM `voucher_body`"; 
$icps_civs_open_income_statement .= "LEFT JOIN `accounts` ON `voucher_body`.`AccNo`=`accounts`.`AccNo`"; 
$icps_civs_open_income_statement .= "LEFT JOIN `civa` ON `voucher_body`.`civaCode`=`civa`.`civaID`"; 
$icps_civs_open_income_statement .= "WHERE `civa`.`open`='1' AND voucher_body.icpNo='".$this->session->center_id."' AND civa.allocate LIKE '%".$this->session->center_id."%'";
$icps_civs_open_income_statement .= "GROUP BY `voucher_body`.`icpNo`,`accounts`.`AccGrp`,`civa`.`civaID`"; 

$icps_civs_open_income = $this->db->query($icps_civs_open_income_statement)->result_object();

//$icps_with_civs_statement = "SELECT DISTINCT icpNo FROM voucher_body WHERE civaCode>0";
//$icps_with_civs = $this->db->query($icps_with_civs_statement)->result_object();

$refined_arr = array();

foreach($icps_civs_open_income as $rw){
	$refined_arr[$rw->icpNo][$rw->AccNoCIVA][$rw->AccGrp] = array('civaID'=>$rw->civaID,'accID'=>$rw->accID,'closureDate'=>$rw->closureDate,'Cost'=>$rw->Cost);
}
//print_r($refined_arr);
?>

<div class="row">
	<div class="col-sm-12">
		<a href="<?=base_url();?>ifms.php/partner/civ_report/closed" class="btn btn-danger"><?=get_phrase('closed_interventions_report');?></a>	
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
	                 				foreach($refined_arr as $key=>$value){
	                 					//$inc = 0;
										//$exp = 0;
	                 					foreach($value as $key2=>$value2){
	                 				?>
	                 						
	                 							<tr>
		                 							<td><?=$key;?></td>
													<td><?=$key2;?></td>
		                 							<td>
		                 								<?php
		                 									if(isset($value2[1])){
		                 										echo $value2[1]['closureDate'];
		                 									}elseif(isset($value2[0])){
		                 										echo $value2[0]['closureDate'];
		                 									} 
		                 								?>
		                 							</td>
		                 							<td style="text-align: right;">
		                 								<?php $inc = 0;
		                 									if(isset($value2[1])) $inc = $value2[1]['Cost'];
		                 									
		                 								?>
		                 								<a class="btn btn-default" href="#" onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_show_breakdown/<?=$key;?>/<?=$value2[1]['civaID'];?>');"><?=number_format($inc,2);?></a>
		                 							</td>
		                 							<td style="text-align: right;">
		                 								<?php $exp = 0;
		                 									if(isset($value2[0])) $exp = $value2[0]['Cost'];
		  
		                 								?>
		                 								<a class="btn btn-default" href="#" onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_show_breakdown/<?=$key;?>/<?=$value2[0]['civaID'];?>');"><?=number_format($exp,2);?></a>
		                 							</td>
		                 							<td style="text-align: right;">
		                 								<?php
		                 									echo number_format($inc-$exp,2);
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