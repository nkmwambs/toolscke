<?php
//echo $param2;
$row = $this->db->get_where('accounts',array('accID'=>$param2))->row();
?>

<div class="row">	
	<div class="col-xs-12">

	<div class="panel panel-primary " data-collapsed="0">
       <div class="panel-heading">
           <div class="panel-title">
              <i class="fa fa-pencil"></i>
                 <?php echo get_phrase('edit_expense_account');?>
           </div>
       </div>
        
       <div class="panel-body"  style="max-width:50; overflow: auto;">
			
				<?php 
					echo form_open(base_url() . 'ifms.php/admin/finance_settings/edit_expense_account/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
				 	
				?>
			
					<div class="form-group">
						<label for="" class="control-label col-sm-4"><?php echo get_phrase('account_name');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="AccName" id="AccName" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row->AccName;?>"/>
						</div>
					</div>
					
					<div class="form-group">
						<label for="" class="control-label col-sm-4"><?php echo get_phrase('account_code');?></label>
						<div class="col-sm-8">	
							<input type="text" class="form-control" name="AccText" id="AccText" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row->AccText;?>"/>
						</div>
					</div> 
					
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-info">Edit</button>
					</div>
				</div>
			
			</form>
	</div>
</div>
</div>