<?php
$rec = $this->db->get_where('banks',array('bankID'=>$param2))->row();
?>
<div class="row">
	<div class="col-sm-12">
		    <div class="panel panel-primary " data-collapsed="0">
                  <div class="panel-heading">
	                  <div class="panel-title">
	                           <i class="fa fa-pencil"></i>
	                           <?php echo get_phrase('edit_bank');?>
	                  </div>
                   </div>
                   
                   <div class="panel-body">
                   		<?php 
							echo form_open(base_url() . 'ifms.php/admin/project_set_up/edit_bank/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
						?>
						
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('bank_name');?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="bankName" id="bankName" value="<?=$rec->bankName;?>" />
									</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('swift_code');?></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="swift_code" id="swift_code" value="<?=$rec->swift_code;?>" />
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
