<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-primary " data-collapsed="0">
	   <div class="panel-heading">
	    	<div class="panel-title">
		        <i class="fa fa-link"></i>
		            <?php echo get_phrase('external_links');?>
		    </div>
		</div>
		        
		<div class="panel-body"  style="max-width:50; overflow: auto;">
			
			<button class="btn btn-primary" onclick="showAjaxModal('<?=base_url();?>resources.php/modal/popup/modal_add_link');"><i class="fa fa-plus-square-o"></i> <?=get_phrase('new_link');?></button><hr/>
			
		       		<table class="table table-striped">
		       			<thead>
		       				<tr>
		       					<th><?=get_phrase('link_name');?></th>
		       					<th><?=get_phrase('description');?></th>
		       					<th><?=get_phrase('notify');?></th>
		       					<th><?=get_phrase('status');?></th>
		       					<th><?=get_phrase('action');?></th>
		       				</tr>
		       			</thead>
		       			<tbody>
		       				<?php
		       					
		       					$this->db->where(array('links_group_access.status'=>'1','external_links.status'=>'1','links_group_access.userlevel'=>$this->session->logged_user_level));
								
								
		       					$links = $this->db->join('links_group_access','links_group_access.external_links_id=external_links.external_links_id')->get('external_links')->result_object();
								
								
								foreach($links as $row):
		       				?>
		       					<tr>
		       						<td><a href="<?=$row->url;?>" target="__blank"><?=$row->link_name;?></a></td>	
		       						<td><?=$row->description;?></td>
		       						<?php
		       							$notify_arr = array('No','Yes');
		       						?>
		       						<td><?=$notify_arr[$row->notify];?></td>
		       						<?php
		       							$status_arr = array('Inactive','Active');
		       						?>
		       						<td><?=$status_arr[$row->status];?></td>
		       						<td>
		       							<?php	
			       							$action = "";
			       							if($row->owner !== $this->session->login_user_id){
			       								$action = "disabled";
			       							}
			       						?>	
		       							<div class="btn-group">
						                    <button <?=$action;?> type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        <?php echo get_phrase('action');?> <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                   		<li>
						                        	<a href="#" onclick="showAjaxModal('<?=base_url();?>resources.php/modal/popup/modal_edit_link/<?=$row->external_links_id;?>');">
						                            	<i class="fa fa-edit"></i>
															<?php echo get_phrase('edit');?>
						                               	</a>
						                        </li>
						                        
						                        <li class="divider"></li>
						                        
						                        <li>
						                        	<a href="#" onclick="showAjaxModal('<?=base_url();?>resources.php/modal/popup/modal_group_access/<?=$row->external_links_id;?>');">
						                            	<i class="fa fa-users"></i>
															<?php echo get_phrase('group_access');?>
						                               	</a>
						                        </li>
						                        
						                     </ul>
						                     
						                   </div>     
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
	$('table').DataTable();
</script>