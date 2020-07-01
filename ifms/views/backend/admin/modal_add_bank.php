<div class="row">
	<div class="col-sm-12">
		    <div class="panel panel-primary " data-collapsed="0">
                  <div class="panel-heading">
	                  <div class="panel-title">
	                           <i class="fa fa-plus-square"></i>
	                           <?php echo get_phrase('add_bank');?>
	                  </div>
                   </div>
                   
                   <div class="panel-body">
                   		<?php 
							echo form_open(base_url() . 'ifms.php/admin/project_set_up/add_bank/' , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
						
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('bank_name');?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="bankName" id="bankName" />
									</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('swift_code');?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="swift_code" id="swift_code" />
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
