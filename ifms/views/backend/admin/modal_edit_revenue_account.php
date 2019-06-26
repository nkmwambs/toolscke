<div class="row">
	<div class="col-xs-12">
		
	<div class="panel panel-primary " data-collapsed="0">
       <div class="panel-heading">
           <div class="panel-title">
              <i class="fa fa-pencil"></i>
                 <?php echo get_phrase('edit_revenue_account');?>
           </div>
       </div>
        
       	<div class="panel-body"  style="max-width:50; overflow: auto;">
       		
			<?php
			$rev = $this->db->get_where('accounts',array('accID'=>$param2))->row();
			
			if(empty($rev)){
			?>
				<div class="well well-default">Missing Revenue Account</div>
			
			<?php	
				exit;
			}
			?>
			<div class="row">
				<div class="col-xs-12">
					<?php 
						echo form_open(base_url() . 'ifms.php/admin/finance_settings/edit_revenue_account/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
					?>
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('account_name');?></label>
						<div class="col-xs-8"><INPUT type="text" name="AccName" id="AccName" value="<?= $rev->AccName;?>" class="form-control"/></div>
					</div>	
					
					<?php 
						
						$readonly = "";
					
						if($this->finance_model->expense_accounts_association($rev->AccNo)==='1'){
							$readonly = "readonly='readonly'";
						}
					
					?>		
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('account_short_code');?></label>
						<div class="col-xs-8"><INPUT type="text" name="AccText" id="AccText" value="<?= $rev->AccText?>" class="form-control" <?php echo $readonly;?>/></div>
					</div>	
					
			
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('status');?></label>
						<div class="col-xs-8">
							<!--<INPUT type="checkbox" value="1" name="active" id="active" <?php if($rev->Active==='1') echo 'checked';?>/>-->
								<select name="Active" id="Active" class="form-control">
									<option value="0">Select</option>
									<option value="1" <?php if($rev->Active==='1') echo 'selected';?>><?php echo get_phrase('on');?></option>
									<option value="0" <?php if($rev->Active==='0') echo 'selected';?>><?php echo get_phrase('off');?></option>
								</select>
								
							</div>
					</div>
					
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('budget_required?');?></label>
						<div class="col-xs-8">
							<input type="checkbox" name="budget" id="budget" value="1" <?php if($rev->budget==='1') echo 'checked';?> />
						</div>
					</div>
					
					<div class="col-offset-4 col-xs-4 col-offset-4">
						<button type="submit" class="btn btn-primary btn-icon"><i class="entypo-pencil"></i>Edit</button>
					</div>				
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
			