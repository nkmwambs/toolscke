<div class="row">
	<div class="col-sm-12">
		    <div class="panel panel-primary " data-collapsed="0">
                  <div class="panel-heading">
	                  <div class="panel-title">
	                           <i class="fa fa-plus-square"></i>
	                           <?php echo get_phrase('add_plan_limit');?>
	                  </div>
                   </div>
                   
                   <div class="panel-body">
                   		<?php
                   			
                   			$rec = $this->db->get_where('plan_item_tag',array('plan_item_tag_id'=>$param2))->row();
                   			 
							echo form_open(base_url() . 'ifms.php/admin/budget_settings/edit_plan_tag/'.$param2.'/'.$param3 , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
							
							<input type="hidden" class="form-control" name="supervisory_group" id="supervisory_group" value="<?=$rec->supervisory_group;?>" />
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('supervisory_group');?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="" id="" value="<?=$this->db->get_where('clusters',array('cluster_id'=>$rec->supervisory_group))->row()->name;;?>" readonly="readonly" />
											
									</div>
							</div>
							
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('tag_name');?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="name" id="name" value="<?=$rec->name;?>" />
									</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('status');?></label>
									<div class="col-sm-8">
										<select class="form-control" name="status" id="status">
											<option><?=get_phrase('select');?></option>
											<option value="0" <?=$rec->status==='0'? 'selected':'';?>><?=get_phrase('inactive');?></option>
											<option value="1" <?=$rec->status==='1'? 'selected':'';?> selected="selected"><?=get_phrase('active');?></option>
										</select>	
									</div>
							</div>
							
							<div class="form-group">
								<button class="btn btn-primary btn-icon"><i class="fa fa-pencil-square-o"></i><?=get_phrase('edit');?></button>
							</div>	
						
						</form>
                   </div>	
            </div>  
	</div>
</div>
