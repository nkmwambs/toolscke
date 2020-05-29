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

$rmks_arr = array('-1'=>"New","0"=>"Submitted","1"=>"Declined By PF","2"=>"Processed By PF","3"=>"Declined By HS","4"=>"Approved By HS","7"=>"Paid");
									
						
?>
<div class="row">
	<div class="col-md-12">
		  <div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title">Amount Paid Per Category</div>						
				</div>
										
					<div class="panel-body">
						<?php
							$this->db->select('name,incident_sub_category_id,SUM(amtReim) as Cost');
							$this->db->group_by('incident_sub_category_id'); 
							$this->db->join('illness_sub_category','illness_sub_category.illness_sub_category_id=app_medical_claims.incident_sub_category_id');
							$cost_per_incident_sub_category = $this->db->get('app_medical_claims')->result_object();

						?>

	    				<div id="bar-example" style="height: 250px;"></div>
	    			</div>
    		</div>
    			
    </div>	
    
   </div>
    
    <div class="row">
	<div class="col-md-4">
		  <div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('count_per_status');?></div>						
				</div>
										
					<div class="panel-body">
						<?php

							$this->db->select('rmks, COUNT(proNo) as total,SUM(amtReim) as Cost');
				 			$this->db->group_by('rmks'); 							
				 			$this->db->order_by('proNo'); 
				 			$claims_rec = $this->db->get('app_medical_claims')->result_object();
							
							$status_arr=array();
							
							foreach($claims_rec as $rows):

								$rmks_arr[$rows->rmks];
						
								$count = $this->db->select('COUNT(childNo) as count')->get_where('app_medical_claims',array('rmks'=>$rows->rmks))->row()->count;
						
								$cost = $this->db->select('SUM(amtReim) as cost')->get_where('app_medical_claims',array('rmks'=>$rows->rmks))->row()->cost;
							
								$status_arr[$rmks_arr[$rows->rmks]] = array($count,$cost);
						
							endforeach;
						

					?>
	    				<div id="donut-example" style="height: 250px;"></div>
	    			</div>
    		</div>	
    </div>
	

	
	<div class="col-md-4">
		  <div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('annual_paid_claims');?></div>						
				</div>
										
					<div class="panel-body">
	    				<div id="line-example" style="height: 250px;"></div>
	    			</div>
    		</div>	
    </div>
    
    
	<div class="col-md-4">
		  <div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('annual_paid_claims');?></div>						
				</div>
										
					<div class="panel-body">
	    				<div id="area-example" style="height: 250px;"></div>
	    			</div>
    		</div>	
    </div>    
    
    <div class="col-md-4">
		  <div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('cost_per_status');?></div>						
				</div>
										
					<div class="panel-body">
	    				<div id="donut-status-cost" style="height: 250px;"></div>
	    			</div>
    		</div>	
    </div>  
	
</div>

<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>-->

<script>
/**
	new Morris.Line({
		  // ID of the element in which to draw the chart.
		  element: 'myfirstchart',
		  // Chart data records -- each entry in this array corresponds to a point on
		  // the chart.
		  data: [
		    { year: '2008', value: 20 },
		    { year: '2009', value: 10 },
		    { year: '2010', value: 5 },
		    { year: '2011', value: 5 },
		    { year: '2012', value: 20 }
		  ],
		  // The name of the data record attribute that contains x-values.
		  xkey: 'year',
		  // A list of names of data record attributes that contain y-values.
		  ykeys: ['value'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Value']
	});
	
	**/
	
	Morris.Bar({
		  element: 'bar-example',
		  data: [

		   	<?php
		   		foreach($cost_per_incident_sub_category as $rows):
			?>
					{y: '<?php echo ucfirst($rows->name);?>', a: <?php echo $rows->Cost;?>},
			<?php		
				endforeach;
		   	?>
		  ],
		  xkey: 'y',
		  ykeys: ['a'],
		  labels: ['Cost'],
		  xLabelAngle: 270
	});
	

	Morris.Donut({
	  element: 'donut-example',
	  data: [
	  <?php foreach($status_arr as $status_key=>$status_value):?>
	  	
	  		{label: "<?php echo $status_key;?>", value: <?php echo $status_value[0];?>},
	  
	  <?php endforeach;?>

	  ]
	});	
	
	
	Morris.Donut({
	  element: 'donut-status-cost',
	  data: [
	  <?php foreach($status_arr as $status_key=>$status_value):?>
	  	
	  		{label: "<?php echo $status_key;?>", value: <?php echo $status_value[1];?>},
	  
	  <?php endforeach;?>

	  ]
	});	
		
	

Morris.Line({
  element: 'line-example',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B']
});	



Morris.Area({
  element: 'area-example',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B']
});
</script>

  
