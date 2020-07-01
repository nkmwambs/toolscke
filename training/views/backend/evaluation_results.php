<div class="row">
	<div class="col-sm-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?=get_phrase("responder");?></th>
					<th><?=get_phrase("project");?></th>
					<th><?=get_phrase("start_date");?></th>
					<th><?=get_phrase("question");?></th>
					<th><?=get_phrase("score");?></th>
					<th><?=get_phrase("suggestion");?></th>
					<th><?=get_phrase("comment");?></th>
					<th><?=get_phrase("trainer");?></th>
					<th><?=get_phrase("posted_date");?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($responses as $response){
				?>
					<tr>
						<td><?php 
								$user = $this->db->get_where("users",array("ID"=>$response->user_id))->row(); 
								echo $user->userfirstname." ".$user->userfirstname;
							?>
						</td>
						<td><?=$user->fname;?></td>
						<?php 
								$event = $this->db->get_where("event",array("event_id"=>$response->event_id))->row();
								
							?>
						
						<td><?=$event->event_start_date?></td>
						<td><?=$this->db->get_where("lemquestions",array("lemquestions_id"=>$response->lemquestions_id))->row()->description;?></td>
						<td><?=$response->score;?></td>
						<td><?=$response->suggestion;?></td>
						<td><?=$response->comment;?></td>
						<td>
							<?php 
								$trainer = $this->db->get_where("trainer",array("trainer_id"=>$response->trainer_id));
								echo $trainer->num_rows() === 0?"None":$trainer->row()->name;
							;?>
						</td>
						<td><?=$response->stmp;?></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>		
	</div>
</div>




<script>
			var datatable = $('.table').DataTable({
		       dom: '<Bf><"col-sm-12"rt><ip>',
		       //sDom:'r',
		       pagingType: "full_numbers",
		       buttons: [
		           'csv', 'excel', 'print'
		       ],
		       stateSave: true,

		       
		
		     
		   });
</script>