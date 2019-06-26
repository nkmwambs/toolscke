<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-primary " data-collapsed="0">
	   <div class="panel-heading">
	    	<div class="panel-title">
		        <i class="fa fa-users"></i>
		            <?php echo get_phrase('group_access');?>
		    </div>
		</div>
		        
		<div class="panel-body"  style="max-width:50; overflow: auto;">

				<table class="table table-striped">
		       			<thead>
		       				<tr>
		       					<th><?=get_phrase('user_level');?></th>
		       					<th><?=get_phrase('link_access');?></th>
		       				</tr>
		       			</thead>
		       			<tbody>
		       				<?php
		       					$link_id = $this->db->get_where('external_links',array('external_links_id'=>$param2))->row()->external_links_id;
					
								$access = $this->db->get_where('links_group_access',array('external_links_id'=>$link_id))->result_object();
								foreach($access as $row):
									if($row->userlevel!=='9'){
		       				?>
		       				<tr>
		       					<td><?=$this->db->get_where('positions',array('pstID'=>$row->userlevel))->row()->dsgn;?></td>
		       					<td>
		       						<?php
		       							$color = 'warning';
												if($row->status==='1')
													$color='primary';
												
											//if($row->level!=='9'){
		       							?>
		       									<a href="#" onclick="toggle_status(this);" id="<?=$param2;?>_<?=$row->userlevel;?>" class="label label-<?=$color;?>"><?=ucfirst($this->db->get_where('positions',array('pstID'=>$row->userlevel))->row()->short_name);?></a>
		       							<?php
											
											//}
		       						?>
		       						
		       					</td>
		       				</tr>
		       					
		       			<?php
									}
		       				endforeach;
		       			?>
		</div>
				
	</div>
	</div>
</div>

<script>
	function toggle_status(elem){
		
		var elem_id = $(elem).attr('id'); 
		
		var url = '<?=base_url();?>resources.php/admin/toggle_status/'+elem_id;	
		
		$.ajax({
			url:url,
			success:function(data){
				$(elem).toggleClass('label-primary label-warning');
			}	
		});
	}
</script>