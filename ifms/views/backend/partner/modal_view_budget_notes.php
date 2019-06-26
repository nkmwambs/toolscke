<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary">
						
		<div class="panel-heading">
			<div class="panel-title"><?=get_phrase('project_notes');?></div>						
		</div>
								
		<div class="panel-body" style="overflow-y: auto;">
				<div class="col-sm-12">
					<?=$this->db->get_where('plansschedule',array('scheduleID'=>$param2))->row()->notes;?>
				</div>
			
		</div>
		
		
</div>
	</div>
</div>



<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary">
						
		<div class="panel-heading">
			<div class="panel-title"><?=get_phrase('facilitator_comments');?></div>						
		</div>


		<div class="panel-body" style="overflow-y: auto;">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?=get_phrase('from');?></th>
								<th><?=get_phrase('comment');?></th>
								<th><?=get_phrase('time_stamp');?></th>
							</tr>
								</thead>
									<tbody>
										<?php
											$comments = $this->db->get_where("detail",array('recid'=>$param2,"app_name"=>$this->session->app_name))->result_object();
													
											foreach($comments as $rows):
										?>
										<tr>
											<td>
												<?php
													echo $this->db->get_where("users",array('ID'=>$rows->userid))->row()->username;
												?>
											</td>
											<td>
												<?php
													echo $rows->rson;
												?>
											</td>
											<td>
												<?php
													echo $rows->stamp;
												?>
											</td>
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

		