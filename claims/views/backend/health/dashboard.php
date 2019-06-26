<?php
	$icp_id = $this->session->userdata('center_id');
	
	switch($this->session->userdata('logged_user_level')):
		case '1':
			$this->db->where(array("proNo"=>$this->session->userdata('center_id')));
			break;				
		case '2':
			$this->db->where(array("cluster"=>$this->session->userdata('cluster')));
			break;
		endswitch;

$rmks_arr = array('-1'=>"New","0"=>"Submitted","1"=>"Declined By PF","2"=>"Processed By PF","3"=>"Declined By HS","4"=>"Approved By HS","7"=>"Paid","8"=>"Reinstated after PF Decline","9"=>"Reinstated after HS Decline","10"=>"Archived");
$years = range(date('Y',strtotime('-6 years')),date('Y'), 1);
$clusters = $this->db->distinct()->select('cname')->order_by('cname')->get_where('users',array('userlevel'=>2))->result_object();									

//Claims Per Status Count and Cost 
 $this -> db -> select('rmks, COUNT(*) as total,SUM(amtReim) as Cost');
	$this -> db -> group_by('rmks');
	$this -> db -> order_by('proNo');
	$this->db->where(array('rmks<>'=>7));
	$this->db->where(array('rmks<>'=>10)); 
	$claims_rec = $this -> db -> get('claims') -> result_object();
	
	$count_status_arr = array();
	$amount_status_arr = array();	

	//Used by the Count Per Status and Cost Per Status Donuts 
	foreach ($claims_rec as $rows) :

		$rmks_arr[$rows -> rmks];

		$count = $this -> db -> select('COUNT(childNo) as count') -> get_where('claims', array('rmks' => $rows -> rmks)) -> row() -> count;

		$cost = $this -> db -> select('SUM(amtReim) as cost') -> get_where('claims', array('rmks' => $rows -> rmks)) -> row() -> cost;

		//$status_arr[$rmks_arr[$rows -> rmks]] = array($count, $cost);
		$count_arr['label'] = $rmks_arr[$rows -> rmks];
		$count_arr['value'] = $count;
		
		$amount_arr['label'] = $rmks_arr[$rows -> rmks];
		$amount_arr['value'] = $cost;
		
		$count_status_arr[] = $count_arr;
		$amount_status_arr[] = $amount_arr;

	endforeach;
	
	
	//Used by the Status Vs Cost Table By Cluster
	$cluster_status_arr = array();
	foreach($clusters as $cluster):
		foreach($rmks_arr as $status_key=>$status_value):
			if($status_key!==7 && $status_key!==10){
				$this->db->group_by('rmks');
				$this->db->group_by('cluster');
				$amount =  0;
				
				if(!empty($this->db->select('SUM(amtReim)')->get_where('claims',array('rmks'=>$status_key,'cluster'=>$cluster->cname))->row())){
					$amount = $this->db->select('SUM(amtReim) as Cost')->get_where('claims',array('rmks'=>$status_key,'cluster'=>$cluster->cname))->row()->Cost;
				}
				
				$cluster_status_arr[$cluster->cname][$status_value] = $amount;
			}
		endforeach;	
	endforeach;	

?>    

 <div class="row">
	<div class="col-xs-4">
		<div class="panel panel-info">			
			<div class="panel-heading">
				<div class="panel-title"><?=get_phrase('count_per_status');?> (<?=get_phrase('excluding_paid');?>)</div>						
			</div>
			
			<div class="panel-body">
				<div id="count_per_status"></div>
			</div>
		</div>		
	</div>   
	
	<div class="col-xs-4">
		  <div class="panel panel-info">							
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('cost_per_status');?> (<?=get_phrase('excluding_paid');?>)</div>						
				</div>				
					<div class="panel-body">
	    				<div id="cost_per_status"></div>
	    			</div>
    		</div>	
    </div>
     
</div>
    

<div class="row">
		<div class="col-md-12">
		  <div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('pending_claims_by_cluster_per_status');?></div>						
				</div>
										
					<div class="panel-body">
						<table class="table table-striped" id="table_export">
							<thead>
								<tr>
									<th><?=get_phrase('cluster');?></th>
									<?php 
										foreach($rmks_arr as $status=>$value):
											if($status!==7  && $status!==10){?>
												<th><?=$value;?></th>	
									<?php 
											}
										endforeach;
									?>
									<th><?=get_phrase('total');?></th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
								$grand_total = 0;
								foreach($clusters as $cluster):
									
								?>
									<tr>
										<?php $total = 0;?>
										<td> <?=$cluster->cname;?></td>
										<?php 
											$cnt_cols = 0;
											foreach($rmks_arr as $status=>$value):
											
												if($status!==7  && $status!==10){
													$cnt_cols++;
										?>		
													<td  style="text-align: right;" class="">
														<?php 
														
															if($cluster_status_arr[$cluster->cname][$value]) {
																echo number_format($cluster_status_arr[$cluster->cname][$value]);
																//$grand_total+=$cluster_status_arr[$cluster->cname][$value];
															} else {
																 echo "0.00";
																//$grand_total+=0; 
															}
														?>
													</td>	
										<?php			
												}
											
											endforeach;
											if(isset($cluster_status_arr[$cluster->cname])) $total = array_sum($cluster_status_arr[$cluster->cname]);
											
										?>
										<td style="text-align: right;"><?php echo number_format($total,2); $grand_total+=$total;?></td>
									</tr>
									
								<?php endforeach;?>
								<!-- <tr><td colspan="<?=$cnt_cols+1;?>"><?=get_phrase('grand_total');?></td><td><?=number_format($grand_total,2);?></td></tr> -->
							</tbody>
						</table>
	    				
	    			</div>
    		</div>	
    </div>
</div>

<div class="row">
		<div class="col-md-12">
		  <div class="panel panel-info">		
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('cost_trend');?> (<?=get_phrase('based_on_paid_date');?>)</div>						
				</div>
					<div class="panel-body">
	    				<div id="cost_trend"></div>
	    			</div>
    		</div>	
    </div>
</div>


<?php 
	$trend = array();
	foreach($years as $yr){ 
		$paid = 0;
		$archived = 0;
		
  		
		if(!empty($this->db->get_where('claims',array('rmks'=>7,'YEAR(stmp)'=>$yr))->row())) {
			$paid = $this->db->select_sum('amtReim')->get_where('claims',array('rmks'=>7,'YEAR(stmp)'=>$yr))->row()->amtReim;	
		}
		
		if(!empty($this->db->get_where('claims',array('rmks'=>10,'YEAR(stmp)'=>$yr))->row())){
			$archived = $this->db->select_sum('amtReim')->get_where('claims',array('rmks'=>10,"YEAR(stmp)"=>$yr))->row()->amtReim;	
		}
		
		$inner_arr['y'] = $yr;
		$inner_arr['Paid'] = $paid;
		$inner_arr['Archived'] = $archived;
		$trend[] = $inner_arr;
	}

	//echo json_encode($trend);	
?>

<script>

$(document).ready(function(){
	Morris.Donut({
	  element: 'count_per_status',
	  data: JSON.parse('<?=json_encode($count_status_arr);?>')
	});	
	
	Morris.Donut({
		  element: 'cost_per_status',
		  data: JSON.parse('<?=json_encode($amount_status_arr);?>')
	});
	
	Morris.Line({
	  element: 'cost_trend',
	  data: JSON.parse('<?=json_encode($trend);?>'),
	  xkey: 'y',
	  ykeys: ['Paid', 'Archived'],
	  labels: ['Series Paid', 'Series Archived']
	});
  
});


$(".popover_a").popover({
 	title:$("#popover_header").text(),
    html:true,
    content:function(){
    	var cluster = $(this).attr("id");
        var url = "<?php echo base_url();?>claims.php/health/get_cluster_pending_claims/" + cluster;
        return pop_content(url);
  	}
});
  
function pop_content(url){
	$.ajax({
      url:url,
      success:function(resp){
       	return $("#popover_content").html(resp);
      }
    });
    
    return $('#popover_content').html('<div style="text-align:center;"><img width="160" height="100" src="<?php echo base_url();?>uploads/preloader2.gif" /></div>');
}


$('.popover_a').on('click', function (e) {
    $('.popover_a').not(this).popover('hide');
});



var datatable = $('#table_export').DataTable({
	dom: '<"row"l><Bf><"col-sm-12"rt><ip>',
	//sDom:'r',
	pagingType: "full_numbers",
	buttons: [
		'csv', 'excel', 'print'
	],
	stateSave: true,
	lengthMenu: [[25,50, 100, 150,-1], [25,50 ,100,150 ,"All"]],
	pageLength: 50
});   
</script>

  
