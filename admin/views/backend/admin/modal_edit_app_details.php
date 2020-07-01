<?php
$rec = $this->db->get_where('apps',array('apps_id'=>$param2))->row();
?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary " data-collapsed="0">
                <div class="panel-heading">
                      <div class="panel-title">
                          <i class="fa fa-pencil-square"></i>
                          <?php echo get_phrase('edit_application_details');?>
                      </div>
                </div>
        
                <div class="panel-body">
        			<?php 
						echo form_open(base_url() . 'admin.php/admin/application_settings/edit/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
					?>
					
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('application_name');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="app_given_name" id="app_given_name" value="<?=$rec->app_given_name;?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('application_description');?></label>
							<div class="col-sm-8">
								<textarea class="form-control" name="app_description" id="app_description" placeholder="<?=get_phrase('enter_description_here');?>"><?=$rec->app_description;?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('icon');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="icon" id="icon" value="<?=$rec->icon;?>" />
							</div>
						</div>
						
						<div class="form-group">
							<button class="btn btn-primary btn-icon"><i class="fa fa-pencil-square-o"></i><?=get_phrase('edit');?></button>
						</div>
					
					</form>
        		</div>            	
	</div>
</div>