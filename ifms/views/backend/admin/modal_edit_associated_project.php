<?php
	$record = $this->db->get_where('revenue_control',array('revenue_control_id'=>$param2))->row();
?>
<div class="row">
	<div class="col-xs-12">
		
	<div class="panel panel-primary " data-collapsed="0">
       <div class="panel-heading">
           <div class="panel-title">
              <i class="fa fa-pencil"></i>
                 <?php echo get_phrase('edit_associated_projects');?>
           </div>
       </div>
        
       	<div class="panel-body"  style="max-width:50; overflow: auto;">
       		<?php 
					echo form_open(base_url() . 'ifms.php/admin/special_fund/edit_project/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate'));
				 	
			?>
				<div class="form-group">
						<label for="" class="control-label col-sm-4"><?php echo get_phrase('ICP_ID');?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="partner_id" id="partner_id" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $record->partner_id;?>"/>
						</div>
				</div>
				
				<div class="form-group">
						<label for="" class="col-xs-2 control-label"><?php echo get_phrase('start_date');?></label>
						<div class="col-xs-4">
							<input type="text" value="<?php echo $record->start_date;?>" class="form-control datepicker" data-format="yyyy-mm-dd" name="start_date" id="start_date"  readonly="readonly"/>
						</div>
						<label for="" class="col-xs-2 control-label"><?php echo get_phrase('end_date');?></label>
						<div class="col-xs-4">
							<input type="text" value="<?php echo $record->end_date;?>" class="form-control datepicker" data-format="yyyy-mm-dd" name="end_date" id="end_date"  readonly="readonly"/>
						</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-info btn-icon"><i class="fa fa-pencil"></i><?php echo get_phrase('edit');?></button>
					</div>
				</div>
			
			</form>
		</div>
	</div>
</div>
</div>	

<script>
	$(".datepicker").datepicker({
         format: 'yyyy-mm-dd'                                    
       });
</script>	