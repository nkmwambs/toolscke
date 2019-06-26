<div class="row">
	<div class="col-md-8">
    	<div class="row">
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-info " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-code"></i>
                            <?php echo get_phrase('monthly_photo_statistics');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
   
   							<form>
   								<div class="form-group">
   									<label class="control-label col-sm-3"><?php echo get_phrase('choose_month');?></label>
   									<div class="col-sm-4">
   										<input type="text" class="form-control" name="" id="" data-provide="datepicker" readonly="readonly" required="required"/>
   									</div>
   									<div class="col-sm-2">
   										<div class="btn btn-primary"><?php echo get_phrase('search');?></div>
   									</div>
   								</div>
   							</form>

                            	<table class="table table-striped">
                            		<thead>
                            			<tr>
                            				<th><?php echo get_phrase('Project');?></th>
                            				<th><?php echo get_phrase('New');?></th>
                            				<th><?php echo get_phrase('Accepted');?></th>
                            				<th><?php echo get_phrase('Rejected');?></th>
                            				<th><?php echo get_phrase('Reinstated');?></th>
                            			</tr>
                            		</thead>
                            		
                            		<?php 
                            			$projects = $this->db->get_where('projects',array('facilitator'=>$this->session->userdata('login_user_id')))->result_object()
                            		?>
                            		<tbody>
                            		<?php
                            			foreach($projects as $rows):
										$cnt = $this->db->get_where('files',array('group'=>$rows->num))->num_rows();

										if($cnt>0):
                            		?>
                            			<tr>
                            				<td><?php echo $rows->num;?></td>
                            				<td><a class="btn" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_detailed_list/new/<?php echo $rows->num;?>');"><?php echo $this->db->get_where('files',array('group'=>$rows->num,'status'=>1))->num_rows()?></a></td>
                            				<td><a class="btn" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_detailed_list/accepted/<?php echo $rows->num;?>');"><?php echo $this->db->get_where('files',array('group'=>$rows->num,'status'=>2))->num_rows()?></a></td>
                            				<td><a class="btn" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_detailed_list/rejected/<?php echo $rows->num;?>');"><?php echo $this->db->get_where('files',array('group'=>$rows->num,'status'=>3))->num_rows()?></a></td>
                            				<td><a class="btn" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_detailed_list/reinstated/<?php echo $rows->num;?>');"><?php echo $this->db->get_where('files',array('group'=>$rows->num,'status'=>4))->num_rows()?></a></td>
                            			</tr>
                            		<?php
                            			endif;
                            			endforeach;
                            		?>
                            		</tbody>
                            		
                            	</table>
    						
    						
    				</div>
    			</div>
    		</div>			
    		
    	</div>
    	
    	<div class="row">
    	
    		
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
	<div class="col-md-4">
		<div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->get_where('users',array('level'=>2))->num_rows();?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('total_SDSA');?></h3>
                </div>
                
            </div>
            
            <div class="col-md-12">
            
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->get_where('users',array('level'=>3))->num_rows();?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('total_facilitators');?></h3>
                </div>
                
            </div>
            
                        <div class="col-md-12">
            
                <div class="tile-stats tile-orange">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->get_where('users',array('level'=>4))->num_rows();?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('total_projects');?></h3>
                </div>
                
            </div>

    	</div>
    </div>
	
</div>



    <script>
  $(document).ready(function() {
	  
	  var calendar = $('#notice_calendar');
				
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,
					
					events: [
						<?php 
						$notices	=	$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script>

  
