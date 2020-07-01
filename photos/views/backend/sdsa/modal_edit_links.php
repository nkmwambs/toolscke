<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('unlink');?></div>						
				</div>
										
				<div class="panel-body">
				
				<table class="table table-striped">
					<thead>
						<tr>
							<th><?php echo get_phrase('user\'s_name');?></th>
							<th><?php echo get_phrase('user\'s_role');?></th>
							<th><?php echo get_phrase('action');?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$links = $this->db->get_where('projects',array('projects_id'=>$param2))->row();
							
							$fields = $this->db->list_fields('projects');
							
							//$roles = array('','admin','sdsa','facilitator','user');
							
							for($i=3;$i<count($fields);$i++){
								
								$users_id = $this->db->get_where('projects',array('projects_id'=>$param2))->row()->$fields[$i];
								
								if($users_id){
						?>
							<tr>
								<td><?=$this->db->get_where('users',array('ID'=>$users_id))->row()->userfirstname;?></td>
								<td><?=ucfirst($fields[$i]);?></td>
								<td><button onclick="unlink('<?=$fields[$i];?>');" class="btn btn-primary"><?=get_phrase('unlink');?></button></td>
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

<script>
	function unlink(role){
		//alert(role);
		$.ajax({
			url:'<?php echo base_url();?>photos.php/sdsa/manage_user_links/'+role+'/<?=$param2?>',
			success:function(data){
				alert(data);
				location.reload();
			}
		});
	}
</script>