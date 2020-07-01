<?php
//echo $param2.'</br>';
//echo $param3;
?>

<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('linked_projects');?></div>						
				</div>
										
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th><?php echo get_phrase('project_name');?></th>
								<th><?php echo get_phrase('project_number');?></th>
								<th><?php echo get_phrase('linked_sdsa');?></th>
								<th><?php echo get_phrase('linked_facilitator');?></th>
							</tr>
						</thead>
						<?php
							$projects = $this->db->get_where('projects',array($param2=>$param3))->result_object();
						?>
						<tbody>
							<?php
								foreach($projects as $rows):
							?>
								<tr>
									<td><?php echo $rows->name;?></td>
									<td><?php echo $rows->num;?></td>
									<td><?php echo $this->db->get_where('users',array('ID'=>$rows->sdsa))->row()->userfirstname;?></td>
									<td><?php echo $this->db->get_where('users',array('ID'=>$rows->facilitator))->row()->userfirstname;?></td>
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
			