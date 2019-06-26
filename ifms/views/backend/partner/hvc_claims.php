<hr>
<div class="row">
	<div class="col-sm-12">
		<div class="btn btn-info"><a href="<?php echo base_url();?>indexp.php?icp/hvc_claims/show">View Claims</a></div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('hvc_claim_form');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/hvc_claims/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label"><?php echo get_phrase('project_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="icpNo" id='icpNo' readonly data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $this->session->userdata('icp_no');?>" autofocus>
						</div>
					</div>				

					                  
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('beneficiary_number');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="childno" id="childno" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('beneficiary_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="childnname" id="childname" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
						</div> 
					</div>

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('vulnerability_type');?></label>
                        <div class="col-sm-5">
                            <select name="vulnerability" class="form-control" required>
                                <option value=""><?php echo get_phrase('select');?></option>
                                <option value="yes">Vulnerability 1</option>
                                <option value="no">Vulnerability 2</option>
                            </select>
                        </div>
                    </div>

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('intervention');?></label>
                        <div class="col-sm-5">
                            <div class="checkbox checkbox-replace">
									<input type="checkbox" id="" name="">
										<label>Checkbox 1</label>
									</div>
									
									<div class="checkbox checkbox-replace">
										<input type="checkbox" id="" name="">
										<label>Checkbox 2</label>
									</div>
									
									<div class="checkbox checkbox-replace">
										<input type="checkbox" id="" name="">
										<label>Checkbox 3</label>
									</div>
                        </div>
                    </div>
                    
					<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
	                        
							<div class="col-sm-5">
								<input type="text" class="form-control" name="amount" id="amount" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
							</div> 
					</div> 
					
					<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('remarks');?></label>
	                        
							<div class="col-sm-5">
								<textarea class="form-control" rows="5" id="remarks" name="remarks"></textarea>
							</div> 
					</div>                   
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">



</script>