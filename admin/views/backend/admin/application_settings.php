<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="panel panel-primary " data-collapsed="0">
		       <div class="panel-heading">
		           <div class="panel-title">
		              <i class="fa fa-code"></i>
		                 <?php echo get_phrase('applications');?>
		           </div>
		       </div>
		        
		       	<div class="panel-body"  style="max-width:50; overflow: auto;">
		       		<table class="table table-striped">
		       			<thead>
		       				<tr>
		       					<th><?=get_phrase('application_name');?></th>
		       					<th><?=get_phrase('description');?></th>
		       					<th><?=get_phrase('status');?></th>
		       					<th><?=get_phrase('action');?></th>
		       				</tr>
		       			</thead>
		       			<tbody>
		       				<?php
		       					$apps = $this->db->get('apps')->result_object();
								foreach($apps as $app):
		       				?>
		       					<tr>
		       						<td><i class="fa fa-<?=$app->icon;?>"></i> <?=$app->app_given_name;?></td>
		       						<td><?=$app->app_description;?></td>
		       						<td>
		       							<div class="make-switch switch-small clr" id="<?=$app->apps_id;?>" data-on-label="<?=get_phrase('on');?>" data-off-label="<?=get_phrase('off');?>">
											    <input type="checkbox"  <?php if($app->status==='1') echo 'checked';?>/>
										</div>
		       						</td>
		       						<td>
		       						
		       							<div class="btn-group">
						                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        <?php echo get_phrase('action');?> <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                   		<li>
						                        	<a href="#" onclick="showAjaxModal('<?=base_url();?>admin.php/modal/popup/modal_edit_app_details/<?=$app->apps_id;?>');">
						                            	<i class="fa fa-edit"></i>
															<?php echo get_phrase('edit');?>
						                               	</a>
						                        </li>
						                    
						                    	<?php
						                    		if($app->status==='1'){
						                    	?>    
						                        <li class="divider"></li>
						                        
						                        <li>
						                        	<a href="#" onclick="showAjaxModal('<?=base_url();?>admin.php/modal/popup/modal_view_app_access/<?=$app->apps_id;?>');">
						                            	<i class="fa fa-lock"></i>
															<?php echo get_phrase('group_access');?>
						                               	</a>
						                        </li>
						                        
						                        <?php
													}
						                    	?>
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
</div>

<script>
		$('.clr').on('switch-change', function(e, data) {
			var el = $(this);
	       	var app_id = el.attr('id');
			//alert(app_id);
			
				var state = 0;
		        if(data.value==true){
		        	state = 1;
		        }
		        
		        var url = '<?php echo base_url();?>admin.php/admin/switch_app_status/'+app_id+'/'+state;	
				$.ajax({
						url: url
					});
	        
	   });
</script>