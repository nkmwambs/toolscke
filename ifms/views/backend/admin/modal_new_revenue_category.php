<?php
$max_global = $this->db->select_max('parentID')->get('primary_accounts')->row()->parentID;
?>
<div class="row">
	<div class="col-xs-12">
		<?php 
			echo form_open(base_url() . 'admin/finance/finance_settings/add_revenue_category/' , array('class' => 'form-horizontal form-groups-bordered validate'));
		?>
		<div class="form-group">
			<label for="" class="col-xs-4 control-label">Account Name</label>
			<div class="col-xs-8"><INPUT type="text" name="AccName" id="AccName" readonly="readonly" value="Revenue_<?= $max_global+1;?>" class="form-control"/></div>
		</div>	

		<div class="form-group">
			<label for="" class="col-xs-4 control-label">Category Active</label>
			<div class="col-xs-8">
				<!--<INPUT type="checkbox" value="1" name="active" id="active" />-->
				<select class="form-control" name="Active" id="Active">
					<option value="0">select</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-xs-4 control-label">Has Sub Accounts</label>
			<div class="col-xs-8">
				<!--<INPUT type="checkbox" value="1" name="has_sub_accounts" id="has_sub_accounts" />-->
				<select class="form-control" name="has_sub_accounts" id="has_sub_accounts">
					<option value="0">select</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-xs-4 control-label">Budget Required</label>
			<div class="col-xs-8">
				<!--<INPUT type="checkbox" value="1" name="budgeted" id="budgeted" />-->
				<select class="form-control" name="budgeted" id="budgeted">
					<option value="0">select</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
			</div>
		</div>		
		
		
		<div class="col-offset-4 col-xs-4 col-offset-4">
			<button type="submit" class="btn btn-primary btn-icon"><i class="entypo-plus"></i>Add</button>
		</div>				
	</form>
	</div>
</div>