<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-primary " data-collapsed="0">
             <div class="panel-heading">
                   <div class="panel-title">
                        <i class="fa fa-calendar"></i>
                          <?php echo get_phrase('new_revenue_account');?>
                   </div>
              </div>
        
             <div class="panel-body"  style="max-width:50; overflow: auto;">	
				<?php 
					echo form_open(base_url() . 'ifms.php/admin/finance_settings/add_revenue_account/' , array('class' => 'form-horizontal form-groups-bordered validate'));
				?>
				<div class="form-group">
					<label for="" class="col-xs-4 control-label"><?php echo get_phrase('account_name');?></label>
					<div class="col-xs-8"><INPUT type="text" name="AccName" id="AccName" class="form-control"/></div>
				</div>	
		
				<div class="form-group">
					<label for="" class="col-xs-4 control-label"><?php echo get_phrase('account_short_code');?></label>
					<div class="col-xs-8"><INPUT type="text" name="AccText" id="AccText"  class="form-control"/></div>
				</div>	
				
				<div class="form-group">
					<label for="" class="col-xs-4 control-label"><?php echo get_phrase('account_numeric_code');?></label>
					<div class="col-xs-8"><INPUT type="text" name="AccNo" id="AccNo"  class="form-control"/></div>
				</div>	
		
				<div class="form-group">
					<label for="" class="col-xs-4 control-label"><?php echo get_phrase('account_status');?></label>
					<div class="col-xs-8">
						<!--<INPUT type="checkbox" value="1" name="active" id="active" />-->
						<select class="form-control" name="Active" id="Active">
							<option value="0"><?php echo get_phrase('select');?></option>
							<option value="1" selected="selected"><?php echo get_phrase('on');?></option>
							<option value="0"><?php echo get_phrase('off');?></option>
						</select>
					</div>
				</div>	
				
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('budget_required?');?></label>
						<div class="col-xs-8">
							<input type="checkbox" name="budget" id="budget" value="1" />
						</div>
					</div>				
				
				<div class="col-offset-4 col-xs-4 col-offset-4">
					<button type="submit" class="btn btn-primary btn-icon"><i class="entypo-plus"></i>Add</button>
				</div>				
			</form>
		
		</div>
	</div>	
	
	</div>
</div>