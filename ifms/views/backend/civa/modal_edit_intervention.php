<?php
$civ = $this->db->get_where('civa',array('civaID'=>$param2))->row();
?>

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
						echo form_open(base_url() . 'ifms.php/civa/interventions/edit/'.$param2, array('id'=>'frm_edit','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
						
						
					?>
						
						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('CIV_code');?></label>
							<div class="col-xs-8"><INPUT type="text" readonly="readonly" name="AccNoCIVA" id="AccNoCIVA" value="<?=$civ->AccNoCIVA;?>" class="form-control" required="required"/></div>
						</div>
						
						<?php
							$rev_acc = $this->db->get_where('accounts',array('accID'=>$civ->accID))->row();
						?>
						
						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('account_code');?></label>
							<div class="col-xs-8"><INPUT type="text" readonly="readonly" name="" id="AccNoCIVA" value="<?=$rev_acc->AccName;?> - <?=$rev_acc->AccText;?>" class="form-control" required="required"/></div>
						</div>
						
						
						
						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('allocate_ICPs');?></label>
							<div class="col-xs-8">
								<?php
									
										$arr = explode(",", $civ->allocate);
										
									
								?>
								<textarea id="allocate" name="allocate" class="form-control" placeholder="Enter each ICP on a new line as KEXXX (No Zero After KE)"><?php echo  implode("\n", $arr);?></textarea>
								</div>
						</div>

						<div id="" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('closure_date');?></label>
							<div class="col-xs-8">
							<div class="input-group">	
							<input type="text" value="<?=$civ->closureDate;?>" name="closureDate" id="closureDate" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
									data-format="yyyy-mm-dd" data-start-date="" 
										data-end-date="" readonly="readonly">
												
										<div class="input-group-addon">
											<a href="#"><i class="entypo-calendar"></i></a>
										</div>
									</div>	
							</div>			
																		
						</div>
						
						<div class="col-offset-4 col-xs-4 col-offset-4">
							<button id="btn_civ_edit" type="submit" class="btn btn-primary btn-icon"><i class="fa fa-pencil"></i><?php echo get_phrase('edit');?></button>
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