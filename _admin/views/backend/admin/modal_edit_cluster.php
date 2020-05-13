<?php
$cluster = $this->db->get_where('clusters',array('clusters_id'=>$param2))->row();
?>
<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-plus-squared"></i>
                            <?php echo get_phrase('new_user');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    <?php 
						echo form_open(base_url() . 'admin.php/admin/manage_profile/edit_cluster/'.$param2, array('id'=>'frm_user_add','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
						
						
					?>
						<div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('cluster_name');?></label>
							<div class="col-xs-8">
								<input type="text" class="form-control" value="<?=$cluster->clusterName;?>" id="clusterName" name="clusterName" />
							</div>
						</div>
						
						<!-- <div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('facilitator');?></label>
							<div class="col-xs-8">
								<select class="form-control" id="facilitator" name="facilitator">
									<option value=""><?=get_phrase('select');?></option>
									<?php
										$facilitators = $this->db->order_by('userfirstname')->get_where('users',array('userlevel'=>'2'))->result_object();
										
										foreach($facilitators as $row):
									?>	
										<option value="<?=$row->ID;?>" <?php if($row->ID===$cluster->facilitator) echo 'selected';?>><?=$row->userfirstname;?> <?=$row->userlastname;?></option>
									<?php
										endforeach;
									?>
								</select>
							</div>
						</div> -->
						
						<div class="form-group">
							<div class="col-xs-12">
								<button class="btn btn-primary btn-icon"><i class="fa fa-edit"></i><?=get_phrase('edit');?></button>
							</div>
						</div>	
						
					</form>
					</div>
				</div>
			</div>
		</div>			
		
<script>
	

		
</script>