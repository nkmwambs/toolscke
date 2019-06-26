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
							echo form_open(base_url() . 'ifms.php/admin/budget_settings/add_plan_limit/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
							<input type="hidden" name="fy" id="fy" value="<?=$param2;?>" /> 
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('project_id');?></label>
									<div class="col-sm-8">
										<select class="form-control" name="icpNo" id="icpNo">
											<option><?=get_phrase('select');?></option>
											<?php
												$projects = $this->db->get('projectsdetails')->result_object();
												
												foreach($projects as $row):
											?>
												<option value="<?=$row->icpNo;?>"><?=$row->icpNo;?> - <?=$row->icpName;?></option>
											<?php
												endforeach;
											?>
											
										</select>
									</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('revenue_account');?></label>
									<div class="col-sm-8">
										<select class="form-control" name="revenue_id" id="revenue_id">
											<option><?=get_phrase('select');?></option>
											<?php
												$rev = $this->finance_model->budgeted_revenue_accounts();
												
												foreach($rev as $acc):
											?>
													<option value="<?=$acc->accID;?>"><?=$acc->AccText;?> - <?=$acc->AccName;?></option>
											<?php
												endforeach;
											?>
										</select>
									</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('description');?></label>
									<div class="col-sm-8">
										<textarea class="form-control" name="limit_description" id="limit_description" placeholder="<?=get_phrase('enter_description_here');?>"> </textarea>
									</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('limit');?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="amount" id="amount" />
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
