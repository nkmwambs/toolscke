<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-plus-squared"></i>
                            <?php echo get_phrase('new_intervention_account');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    <?php 
						echo form_open(base_url() . 'ifms.php/civa/interventions/add/'.$param2, array('id'=>'frm_add','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
						
						
					?>
						
						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('CIV_code');?></label>
							<div class="col-xs-8"><INPUT type="text" name="AccNoCIVA" id="AccNoCIVA" class="form-control" required="required"/></div>
						</div>
						
						<?php
							$rev_acc = $this->db->get_where('accounts',array('AccGrp'=>'1','Active'=>'0'))->result_object();
						?>
						
						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('account_code');?></label>
							<div class="col-xs-8">
								<select class="form-control" id="accID" name="accID" required="required">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php
										foreach($rev_acc as $row):
									?>
									<option value="<?=$row->accID?>"><?=$row->AccText;?> - <?=$row->AccName;?></option>
									<?php
										endforeach;
									?>
								</select>
							</div>
						</div>
						
						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('allocate_ICPs');?></label>
							<div class="col-xs-8">
								<textarea id="allocate" name="allocate" class="form-control" placeholder="Enter each ICP on a new line as KEXXX (No Zero After KE)"></textarea>
								</div>
						</div>

						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('closure_date');?></label>
							<div class="col-xs-8">
							<div class="input-group">	
							<input type="text" name="closureDate" id="closureDate" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
									data-format="yyyy-mm-dd" data-start-date="" 
										data-end-date="" readonly="readonly">
												
										<div class="input-group-addon">
											<a href="#"><i class="entypo-calendar"></i></a>
										</div>
									</div>	
							</div>			
																		
						</div>
						
						<div class="col-offset-4 col-xs-4 col-offset-4">
							<button id="btn_civ_add" type="submit" class="btn btn-primary btn-icon"><i class="entypo-plus"></i><?php echo get_phrase('add');?></button>
						</div>
						
					</form>
					</div>
				</div>
			</div>
		</div>			
		
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'		
	});
	
});	
		
</script>