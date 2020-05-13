<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-eye"></i>
                            <?php echo get_phrase('new_work_groups');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    <?php 
						echo form_open(base_url() . 'admin.php/admin/manage_profile/add_work_group/'.$param2, array('id'=>'frm_work_group_add','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
					?>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('supervisory_group');?></label>
							<div class="col-sm-8">
								<input readonly="readonly" class="form-control" type="text" name="" id="" value="<?=$this->db->get_where('clusters',array('cluster_id'=>$param2))->row()->name;?>" />
							</div>
						</div>
					
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('work_group_name');?></label>
							<div class="col-sm-8">
								<input type="text" name="name" id="name" class="form-control" required="required"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('work_group_code');?></label>
							<div class="col-sm-8">
								<input type="text" name="project_id" id="project_id" class="form-control" required="required"/>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-primary btn-icon"><i class="fa fa-plus-circle"></i><?=get_phrase('add');?></button>
							</div>
						</div>
						
					<?php
						echo form_close();
					?>
                    </div>
             </div>
         </div>
 </div>            	