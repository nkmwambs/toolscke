<div class="row">
	<div class="col-sm-11">
	<div class="panel panel-primary">
						
		<div class="panel-heading">
			<div class="panel-title"><?=get_phrase('set_financial_year');?></div>						
				
		</div>
								
		<div class="panel-body">
		<?php echo form_open(base_url() . 'ifms.php/partner/plans/clone/'.$this->session->center_id , array('id'=>'','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
			<div class="form-group">
				<label class="control-label col-sm-4" for=""><?=get_phrase('clone_from');?></label>
				<div class="col-sm-8">
					<select name="fy" id="fy" class="form-control">
						<option><?=get_phrase('select');?></option>
						<?php 
							$fy = range(date('y')-5, date('y')+5);
											
							foreach($fy as $yr):
						?>
							<option value="<?=$yr;?>" <?php if($param2 == $yr)echo 'selected';?>><?='FY'.$yr;?></option>
						<?php 
							endforeach;
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for=""><?=get_phrase('clone_to');?></label>
				<div class="col-sm-8">
					<select name="nextfy" id="nextfy" class="form-control">
						<option><?=get_phrase('select');?></option>
						<?php 
							$fy = range(date('y')-5, date('y')+5);
											
							foreach($fy as $yr):
						?>
							<option value="<?=$yr;?>" <?php if($param3 == $yr)echo 'selected';?>><?='FY'.$yr;?></option>
						<?php 
							endforeach;
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				
				<div class="col-sm-12">
					<button class="btn btn-primary btn-icon"><i class="fa fa-gg"></i><?=get_phrase('clone');?></button>
				</div>
			</div>
			
		</form>
		
		</div>
	</div>
	</div>
</div>		
			