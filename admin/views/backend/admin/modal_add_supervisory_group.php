<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-plus-circle"></i>
                            <?php echo get_phrase('add_supervisory_group');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<?php 
							echo form_open(base_url() . 'admin.php/admin/user_groups/add_supervisory_group/', array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
						
						?>
												
						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('supervisory_group');?></label>
							<div class="col-xs-8"><INPUT type="text" name="name" id="name" class="form-control"/></div>
						</div>
						
						<div class="col-offset-4 col-xs-4 col-offset-4">
							<button type="submit" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i><?php echo get_phrase('add');?></button>
						</div>
						
					</form>
					
					</div>
			</div>
		</div>
</div>					