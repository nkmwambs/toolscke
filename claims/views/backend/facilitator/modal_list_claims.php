<?php
$rmks_arr = array('-1'=>"New","0"=>"Submitted","1"=>"Declined By PF","2"=>"Processed By PF","3"=>"Declined By HS","4"=>"Approved By HS","7"=>"Paid","8"=>"Reinstated After PF Decline","9"=>"Reinstated After HS Decline");

	switch($this->session->userdata('logged_user_level')):
		case '1':
			$this->db->where(array("proNo"=>$this->session->userdata('center_id'),"rmks"=>$param2));
			break;				
		case '2':
			$this->db->where(array("cluster"=>$this->session->userdata('cluster'),"rmks"=>$param2));
			break;
		default:
			$this->db->where(array("rmks"=>$param2));	
	endswitch;
		
$rec = $this->db->get('claims')->result_object();

?>
<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('claim_list');?></div>						
				</div>
										
				<div class="panel-body">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th><?=get_phrase('cluster');?></th>
								<th><?=get_phrase('project');?></th>	
								<th><?=get_phrase('beneficiary_ID');?></th>
								<th><?=get_phrase('claim_date');?></th>
								<th><?=get_phrase('amount_reimbursable');?></th>
								<th><?=get_phrase('status');?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($rec as $row):
							?>
							<tr>
								<th><?=$row->cluster;?></th>
								<th><?=$row->proNo;?></th>
								<th><?=$row->childNo;?></th>
								<th><?=$row->date;?></th>
								<th><?=number_format($row->amtReim,2);?></th>
								<th><?=$rmks_arr[$row->rmks];?></th>
							</tr>
							<?php
								endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		$(document).ready(function(){
			var datatable = $('.datatable').DataTable({
		       dom: '<Bf><"col-sm-12"rt><ip>',
		       //sDom:'r',
		       pagingType: "full_numbers",
		       buttons: [
		           'csv', 'excel', 'print'
		       ]
		    });
		});
	</script>
				