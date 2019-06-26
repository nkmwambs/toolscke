<?php

	$rec = $this->db->get_where('projectsdetails',array('ID'=>$param2))->row();
	
	$general_system_start_date = date('Y-m-01',strtotime('-1 month',strtotime($this->db->get_where('settings',array('type'=>'system_start_date'))->row()->description)));
	
	//print_r($rec);

?>
<div class="row">
		<div class="col-md-12">
			
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-pencil"></i>
                            <?php echo get_phrase('edit_project_details');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	
	                    <?php 
							echo form_open(base_url() . 'ifms.php/admin/project_set_up/edit/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
						
							<div class="form-group">
								<label class="control-label col-sm-4"><?=get_phrase('project_id');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="icpNo" id="icpNo" value="<?=$rec->icpNo;?>" readonly="readonly" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?=get_phrase('cluster');?></label>
								<div class="col-sm-8">
									<select class="form-control" name="cluster_id" id="cluster_id">
										<option><?=get_phrase('select');?></option>
										<?php
											$clusters = $this->db->get('clusters')->result_object();
											foreach($clusters as $cluster):
										?>
											<option value="<?=$cluster->clusters_id;?>" <?php if($cluster->clusters_id===$rec->cluster_id) echo 'selected';?>><?=$cluster->clusterName;?></option>
										<?php
											endforeach;
										?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?=get_phrase('system_start_usage_date');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control datepicker" name="system_start_date" id="system_start_date" value="<?=$rec->system_start_date;?>" readonly="readonly" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?=get_phrase('bank_name');?></label>
								<div class="col-sm-8">
									<select class="form-control" name="bankID" id="bankID">
										<option><?=get_phrase('select');?></option>
										<?php
											$banks = $this->db->get('banks')->result_object();
											foreach($banks as $bank):
										?>
											<option value="<?=$bank->bankID;?>" <?php if($bank->bankID===$rec->bankID) echo 'selected';?>><?=$bank->bankName;?></option>
										<?php
											endforeach;
										?>
									</select>
								</div>
							</div>
							
													
							<div class="form-group">
								<button class="btn btn-primary btn-icon"><i class="fa fa-pencil"></i><?=get_phrase('edit');?></button>
							</div>
						
						</form>
					</div>
				</div>
		</div>
</div>						

<script>
	$('.datepicker').datepicker({
		format:'yyyy-mm-dd',
		startDate:'<?=$general_system_start_date;?>'
	});
</script>
