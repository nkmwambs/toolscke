<?php
$event = $this->db->get_where('event',array('event_id'=>$param2))->row();
?>
<div class="row">
	<div class="col-sm-12">
		 <div class="panel panel-primary " data-collapsed="0">
           <div class="panel-heading">
             <div class="panel-title">
              	<i class="fa fa-pencil-square"></i>
                  <?php echo get_phrase('edit_event');?>
             </div>
           </div>
           
           <div class="panel-body">
           		<?php 
					echo form_open(base_url() . 'training.php/admin/dashboard/edit_event/'.$param2, array('id'=>'frm_user_event','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));		
				?>
          
           			<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_title');?></label>
							<div class="col-xs-8"><INPUT readonly="readonly" type="text" name="event_title" id="event_title" value="<?=$event->event_title;?>" class="form-control" required="required"/></div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_start_date');?></label>
							<div class="col-xs-8"><INPUT type="text" name="event_start_date" id="event_start_date" value="<?=date("d-m-Y",strtotime($event->event_start_date));?>" class="form-control" data-format="yyyy-mm-dd" readonly="readonly" required="required"/></div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_end_date');?></label>
							<div class="col-xs-8"><INPUT type="text" name="event_end_date" id="event_end_date" value="<?=date("d-m-Y",strtotime($event->event_end_date));?>" class="form-control" data-format="yyyy-mm-dd" readonly="readonly" required="required"/></div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_end_date');?></label>
							<div class="col-xs-8"><INPUT type="checkbox" disabled="disabled" name="allDay" <?php if($event->allDay==='true') echo 'checked';?> id="allDay" /></div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('status');?></label>
							<div class="col-xs-8">
								<select disabled="disabled" name="color_code" id="color_code" class="form-control">
									<option value=""><?=get_phrase('select');?></option>
									<?php
										$colors = $this->db->get_where('color',array('status'=>'1'))->result_object();
										
										foreach($colors as $row):
									?>
										<option value="<?=$row->color;?>" <?php if($row->color===$event->color_code) echo "selected";?>><?=ucwords($row->description);?></option>
									<?php
										endforeach;
									?>
								</select>
							</div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-4 control-label"><?php echo get_phrase('event_description');?></label>
							<div class="col-xs-8">
								<textarea disabled="disabled" name="event_description" id="event_description" class="form-control" required="required" cols="" rows="5"><?=$event->event_description;?></textarea>
							</div>
					</div>
           			
          	</form>
          </div>	
	</div>
</div>

<script>

</script>