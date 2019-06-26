<?php
$global_category = $this->db->get_where('primary_accounts',array('parentID'=>$param2))->row(0);
?>
<div class="row">
	<div class="col-xs-12">
		<?php 
			echo form_open(base_url() . 'admin/revenue_category/edit/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
		?>
		<div class="form-group">
			<label for="" class="col-xs-4 control-label">Account Name</label>
			<div class="col-xs-8"><INPUT type="text" name="parentName" id="parentName"  value="<?= $global_category->parentName;?>" class="form-control"/></div>
		</div>	

		<div class="form-group">
			<label for="" class="col-xs-4 control-label">Category Active</label>
			<div class="col-xs-8">
				<!--<INPUT type="checkbox" value="1" name="active" id="active" />-->
				<select class="form-control" name="Active" id="Active">
					<option value="0">select</option>
					<option value="1" <?php if($global_category->Active==='1') echo 'selected';?>>Yes</option>
					<option value="0" <?php if($global_category->Active==='0') echo 'selected';?>>No</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-xs-4 control-label">Has Sub Accounts</label>
			<div class="col-xs-8">
				<!--<INPUT type="checkbox" value="1" name="has_sub_accounts" id="has_sub_accounts" />-->
				<select class="form-control" name="has_sub_accounts" id="has_sub_accounts">
					<option value="0">select</option>
					<option value="1" <?php if($global_category->has_sub_accounts==='1') echo 'selected';?>>Yes</option>
					<option value="0" <?php if($global_category->has_sub_accounts==='0') echo 'selected';?>>No</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="col-xs-4 control-label">Budget Required</label>
			<div class="col-xs-8">
				<!--<INPUT type="checkbox" value="1" name="budgeted" id="budgeted" />-->
				<select class="form-control" name="budgeted" id="budgeted">
					<option value="0">select</option>
					<option value="1" <?php if($global_category->budgeted==='1') echo 'selected';?>>Yes</option>
					<option value="0" <?php if($global_category->budgeted==='0') echo 'selected';?>>No</option>
				</select>
			</div>
		</div>		
		
		
		<div class="col-offset-4 col-xs-4 col-offset-4">
			<button type="submit" class="btn btn-primary btn-icon"><i class="entypo-pencil"></i>Edit</button>
		</div>				
	</form>
	</div>
</div>