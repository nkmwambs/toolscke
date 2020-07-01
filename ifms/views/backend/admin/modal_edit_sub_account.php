<?php
//echo $param2;
$exp = $this->db->get_where('accounts',array('AccGrp'=>0,'parentAccID'=>0))->result_object();
//print_r($exp);
?>
<div class="row">
	<?php 
		echo form_open(base_url() . 'admin/finance/finance_settings/edit_sub/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
	 	
	?>
	<div class="col-xs-12">
		<div class="form-group">
			<label for="" class="control-label col-sm-4">Sub Account Name</label>
			<div class="col-sm-8">
				<select class="form-control" name="accID" id="accID">
					<option value="">Select</option>
									<?php
						foreach($exp as $row):
					?>
						<option value="<?php echo $row->accID;?>"><?= $row->AccName.' ('.$row->AccText.')';?></option>
					<?php
						endforeach;
					?>
	
				</select>
			</div>
		</div> 

		
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-info">Add</button>
		</div>
	</div>

</form>
</div>