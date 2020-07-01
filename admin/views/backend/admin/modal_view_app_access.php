<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary " data-collapsed="0">
                <div class="panel-heading">
                      <div class="panel-title">
                          <i class="fa fa-lock"></i>
                          <?php echo get_phrase('application_access');?>
                      </div>
                </div>
        
                <div class="panel-body">
                	<table class="table table-striped">
		       			<thead>
		       				<tr>
		       					<th><?=get_phrase('application_name');?></th>
		       					<th><?=get_phrase('access');?></th>
		       				</tr>
		       			</thead>
		       			<tbody>
		       				<?php
		       					$apps = $this->db->get_where('apps',array('apps_id'=>$param2))->result_object();
								foreach($apps as $app):
		       				?>
		       					<tr>
		       						<td><?=$app->app_given_name;?></td>
		       						<td>
		       							<?php
		       								$access = $this->db->get_where('access',array('apps_id'=>$app->apps_id))->result_object();
		       							
		       								foreach($access as $row):
												$color = 'warning';
												if($row->status==='1')
													$color='primary';
												
											if($row->level!=='9'){
		       							?>
		       									<a href="#" onclick="toggle_status(this);" id="<?=$app->apps_id;?>_<?=$row->level;?>" class="label label-<?=$color;?>"><?=ucfirst($this->db->get_where('positions',array('pstID'=>$row->level))->row()->short_name);?></a>
		       							<?php
											
											}
		       								
		       								endforeach;
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

<script>
	function toggle_status(elem){
		
		var elem_id = $(elem).attr('id'); 
		
		var url = '<?=base_url();?>admin.php/admin/toggle_status/'+elem_id;	
		
		$.ajax({
			url:url,
			success:function(data){
				$(elem).toggleClass('label-primary label-warning');
			}	
		});
	}
</script>			