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
									

//Claims Per Status Count and Cost 
 $this -> db -> select('rmks, COUNT(proNo) as total,SUM(amtReim) as Cost');
	$this -> db -> group_by('rmks');
	$this -> db -> order_by('proNo');
	$this->db->where(array('rmks<>'=>7));
	$this->db->where(array('rmks<>'=>10));
	$this->db->where(array('proNo' => $this -> session -> center_id));
	$claims_rec = $this -> db -> get('claims') -> result_object();
	
	$count_status_arr = array();
	$amount_status_arr = array();

	foreach ($claims_rec as $rows) :

		$rmks_arr[$rows -> rmks];

		$count = $this -> db -> select('COUNT(childNo) as count') -> get_where('claims', array('rmks' => $rows -> rmks, 'proNo' => $this -> session -> center_id)) -> row() -> count;

		$cost = $this -> db -> select('SUM(amtReim) as cost') -> get_where('claims', array('rmks' => $rows -> rmks, 'proNo' => $this -> session -> center_id)) -> row() -> cost;

		//$status_arr[$rmks_arr[$rows -> rmks]] = array($count, $cost);
		
		$count_arr['label'] = $rmks_arr[$rows -> rmks];
		$count_arr['value'] = $count;
		
		$amount_arr['label'] = $rmks_arr[$rows -> rmks];
		$amount_arr['value'] = $cost;
		
		$count_status_arr[] = $count_arr;
		$amount_status_arr[] = $amount_arr;
	endforeach;
?>

<?php	
	$years = range(date('Y',strtotime('-6 years')),date('Y'), 1);
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
		<div class="col-xs-12">
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
		
		if(!empty($this->db->get_where('claims',array('proNo'=>$this->session->center_id,'rmks'=>7,'YEAR(stmp)'=>$yr))->row())) {
			$paid = $this->db->select_sum('amtReim')->get_where('claims',array('proNo'=>$this->session->center_id,'rmks'=>7,'YEAR(stmp)'=>$yr))->row()->amtReim;	
		}
		
		if(!empty($this->db->get_where('claims',array('proNo'=>$this->session->center_id,'rmks'=>10,'YEAR(stmp)'=>$yr))->row())){
			$archived = $this->db->select_sum('amtReim')->get_where('claims',array('proNo'=>$this->session->center_id,'rmks'=>10,"YEAR(stmp)"=>$yr))->row()->amtReim;	
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
</script>