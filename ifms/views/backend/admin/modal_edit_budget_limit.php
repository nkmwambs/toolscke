<?php
	$rec = $this->db->get_where('plans_limits',array('plans_limits_id'=>$param2))->row();
?>
<div class="row">
	<div class="col-sm-12">
		 <div class="panel panel-primary " data-collapsed="0">
               <div class="panel-heading">
                    <div class="panel-title">
                        <i class="fa fa-pencil"></i>
                          <?php echo get_phrase('edit_budget_limit_for');?> <?=$rec->project_id;?> - <?=get_phrase('FY');?> <?=$rec->fy;?> (<?=$this->db->get_where('revenue',array('revenue_id'=>$rec->revenue_id))->row()->code;?>)
                     </div>
                </div>
         
                <div class="panel-body">
                	<?php 
						echo form_open(base_url() . 'ifms.php/admin/budget_limits/edit/'.$rec->revenue_id.'/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
					?>	
					
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('limit_description');?></label>
							<div class="col-sm-8">
								<textarea name="limit_description" id="limit_description" class="form-control" cols="12" rows="3" placeholder='<?=get_phrase('enter_limit_description_here');?>'><?=$rec->limit_description;?></textarea>
							</div>
						</div>
						
						<div class="form-group">
						 	<label class="control-label col-sm-4"><?=get_phrase('amount');?></label> 
						  	<div class="col-sm-8">
							    <input class="form-control" type="text" name="amount" id="amount" value="<?=$rec->amount;?>" />
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