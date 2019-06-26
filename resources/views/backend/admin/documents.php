<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-primary " data-collapsed="0">
	   <div class="panel-heading">
	    	<div class="panel-title">
		        <i class="fa fa-folder-open-o"></i>
		            <?php echo get_phrase('documents');?>
		    </div>
		</div>
		        
		<div class="panel-body"  style="max-width:50; overflow: auto;">
			
			<button class="btn btn-primary" onclick="showAjaxModal('<?=base_url();?>resources.php/modal/popup/modal_add_document');"><i class="fa fa-plus-square-o"></i> <?=get_phrase('new_document');?></button><hr/>
			
		       		<table class="table table-striped">
		       			<thead>
		       				<tr>
		       					<th><?=get_phrase('document');?></th>
		       					<th><?=get_phrase('description');?></th>
		       					<th><?=get_phrase('status');?></th>
		       					<th><?=get_phrase('action');?></th>
		       				</tr>
		       			</thead>
		       			<tbody>
		       				<?php
		       					$files = $this->db->get('document')->result_object();
		       					
								foreach($files as $row):
		       				?>
		       					<tr>
		       						<td>
		       							<a href="<?php echo base_url();?>resources.php/admin/ziparchive/<?php echo $row->document_id;?>/approval" class=""><?php echo str_replace("_", " ", $row->title);?></a>
		       						</td>
		       						<td><?=$row->description;?></td>
		       						<?php
		       							$status_arr = array('Inactive','Active')
		       						?>
		       						<td><?=$status_arr[$row->status];?></td>
		       						<td>
		       							<div class="btn-group">
						                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        <?php echo get_phrase('action');?> <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                   		<li>
						                        	<a href="#" onclick="showAjaxModal('<?=base_url();?>resources.php/modal/popup/modal_edit_document/<?=$row->document_id;?>');">
						                            	<i class="fa fa-edit"></i>
															<?php echo get_phrase('edit');?>
						                               	</a>
						                        </li>
						                        
						                        <li class="divider"></li>
						                        
						                        <li>
						                        	<a href="#" onclick="confirm_modal('<?=base_url();?>resources.php/admin/delete_document/<?=$row->document_id;?>');">
						                            	<i class="fa fa-trash-o"></i>
															<?php echo get_phrase('delete');?>
						                               	</a>
						                        </li>
						                        
						                        <li class="divider"></li>
						                        
						                        <li>
						                        	<a href="#" onclick="showAjaxModal('<?=base_url();?>resources.php/modal/popup/modal_group_access/<?=$row->document_id;?>');">
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