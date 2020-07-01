<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-plus-squared"></i>
                            <?php echo get_phrase('new_cluster');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    <?php 
						echo form_open(base_url() . 'admin.php/admin/manage_profile/add_cluster/', array('id'=>'frm_user_add','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
						
						
					?>
						<div class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('cluster_name');?></label>
							<div class="col-xs-8">
								<input type="text" class="form-control" id="clusterName" name="clusterName" />
							</div>
						</div>
						
						
						
						<div class="form-group">
							<div class="col-xs-12">
								<button class="btn btn-primary btn-icon"><i class="fa fa-save"></i><?=get_phrase('create');?></button>
							</div>
						</div>	
						
					</form>
					</div>
				</div>
			</div>
		</div>			
		
<script>
	

		
</script>