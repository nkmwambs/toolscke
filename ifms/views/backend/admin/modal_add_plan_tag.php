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
							echo form_open(base_url() . 'ifms.php/admin/budget_settings/add_plan_tag/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('supervisory_group');?></label>
									<div class="col-sm-8">
										<select class="form-control" name="supervisory_group" id="supervisory_group">
											<option><?=get_phrase('select');?></option>
											<?php
												$clusters = $this->db->get('clusters')->result_object();
												
												foreach($clusters as $row):
											?>
												<option value="<?=$row->cluster_id?>"><?=$row->name?></option>
											<?php
												endforeach;
											?>
											
										</select>
									</div>
							</div>
							
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('tag_name');?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="name" id="name" />
									</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('status');?></label>
									<div class="col-sm-8">
										<select class="form-control" name="status" id="status">
											<option><?=get_phrase('select');?></option>
											<option value="0"><?=get_phrase('inactive');?></option>
											<option value="1" selected="selected"><?=get_phrase('active');?></option>
										</select>	
									</div>
							</div>
							
							<div class="form-group">
								<button class="btn btn-primary btn-icon"><i class="fa fa-plus-circle"></i><?=get_phrase('add');?></button>
							</div>	
						
						</form>
                   </div>	
            </div>  
	</div>
</div>
