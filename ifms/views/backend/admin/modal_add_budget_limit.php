<div class="row">
	<div class="col-sm-12">
		 <div class="panel panel-primary " data-collapsed="0">
               <div class="panel-heading">
                    <div class="panel-title">
                        <i class="fa fa-plus-square"></i>
                          <?php echo get_phrase('add_budget_limit_for');?> <?php echo $this->db->get_where('revenue',array('revenue_id'=>$param2))->row()->code;?>
                     </div>
                </div>
         
                <div class="panel-body">
                	<?php 
						echo form_open(base_url() . 'ifms.php/admin/budget_limits/add/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
					?>
						
						<div class="form-group">
							<label class="col-sm-4 control-label"><?=get_phrase('project_id');?></label>
							<div class="col-sm-8">
								<select class="form-control" name="project_id" id="project_id">
									<option><?=get_phrase('select');?></option>
									<?php
										$projects = $this->finance_model->projects_missing_plans_limit($param2,$param3);//$this->db->get('projectsdetails')->result_object();
										
										foreach($projects as $project):
									?>
										<option value="<?=$project->project_id;?>"><?=$project->project_id;?> - <?=$project->name;?></option>
									<?php
										endforeach;
									?>
								</select>	
							</div>
						</div>
						
						<div class="form-group">
						 	<label class="control-label col-sm-4"><?=get_phrase('financial_year');?></label> 
						  	<div class="col-sm-8">
							    <input class="form-control" type="text" name="fy" id="fy" value="<?=$param3;?>" readonly="readonly" />
							</div>
						</div> 
						
						<input type="hidden" name="revenue_id" id="revenue_id" value="<?=$param2;?>" />
					
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('limit_description');?></label>
							<div class="col-sm-8">
								<textarea name="limit_description" id="limit_description" class="form-control" cols="12" rows="3" placeholder='<?=get_phrase('enter_limit_description_here');?>'></textarea>
							</div>
						</div>
						
						<div class="form-group">
						 	<label class="control-label col-sm-4"><?=get_phrase('amount');?></label> 
						  	<div class="col-sm-8">
							    <input class="form-control" type="text" name="amount" id="amount" />
							</div>
						</div>
						
						<div class="form-group">
							<button class="btn btn-primary btn-icon"><i class="fa fa-plus-square"></i><?=get_phrase('add');?></button>
						</div>
						
					</form>
                </div>
         </div>   
	</div>
</div>