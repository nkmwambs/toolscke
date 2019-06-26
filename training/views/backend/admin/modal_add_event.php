<?php

$event_start_date = "";

$event_end_date = "";

if($param2 !== "" && $param3 !== ""){
	$event_start_date = date('Y-m-d h:m:i',strtotime($param2));
	
	$event_end_date = date('Y-m-d h:m:i',strtotime($param3));	
}

?>
<div class="row">
	<div class="col-sm-12">
		 <div class="panel panel-primary " data-collapsed="0">
           <div class="panel-heading">
             <div class="panel-title">
              	<i class="fa fa-plus-circle"></i>
                  <?php echo get_phrase('add_event');?>
             </div>
           </div>
           
           <div class="panel-body">
           		<?php 
					echo form_open(base_url() . 'training.php/admin/dashboard/add_event/', array('id'=>'frm_user_event','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));		
				?>
          
           			<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_title');?></label>
							<div class="col-xs-8"><INPUT type="text" name="event_title" id="event_title" class="form-control" required="required"/></div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_start_date');?></label>
							<div class="col-xs-8"><INPUT type="text" name="event_start_date" id="event_start_date" value="<?=$event_start_date;?>" class="form-control datepicker" data-format="yyyy-mm-dd" readonly="readonly" required="required"/></div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_end_date');?></label>
							<div class="col-xs-8"><INPUT type="text" name="event_end_date" id="event_end_date" value="<?=$event_end_date;?>" class="form-control datepicker" data-format="yyyy-mm-dd" readonly="readonly" required="required"/></div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('full_day_event');?></label>
							<div class="col-xs-8"><INPUT type="checkbox" name="allDay" id="allDay" /></div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('status');?></label>
							<div class="col-xs-8">
								<select name="color_code" id="color_code" class="form-control">
									<option value=""><?=get_phrase('select');?></option>
									<?php
										$colors = $this->db->get_where('color',array('status'=>'1'))->result_object();
										
										foreach($colors as $row):
									?>
										<option value="<?=$row->color;?>"><?=ucwords($row->description);?></option>
									<?php
										endforeach;
									?>
								</select>
							</div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_description');?></label>
							<div class="col-xs-8">
								<textarea name="event_description" id="event_description" class="form-control" required="required" cols="" rows="5"></textarea>
							</div>
					</div>
           			
           			<div class="form-group">
           				<button class="btn btn-primary btn-icon" type="submit"><i class="fa fa-plus-square"></i><?=get_phrase('create');?></button>
           			</div>	
          	</form>
          </div>	
	</div>
</div>

<script>
	$(document).ready(function(){
			//$('.datepicker').datepicker({
				//format: 'yyyy-mm-dd'
			//});
			$('.datepicker').datetimepicker({
				formar:'yyyy-mm-dd h:m'
			});
	});
</script>