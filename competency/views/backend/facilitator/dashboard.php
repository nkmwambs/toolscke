<?php
//$assessed = $this->assessment_model->assessed_benchmarks($this->session->login_user_id,$date);
//print_r($assessed);
?>
<div class="row">
     <div class="col-sm-12">
     	<div class="row">
            <div class="col-md-3">
     			<div class="tile-stats tile-orange">
     				<div class="icon"><i class="fa fa-list"></i></div>
                    <div class="num" data-start="0" data-end="<?=count($benchmarks);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                   <h3><?=get_phrase('due_parameters');?></h3>
                   
        		</div>
        	</div>
        	
        	 <div class="col-md-3">
     			<div class="tile-stats tile-green">
     				<div class="icon"><i class="fa fa-thumbs-up"></i></div>
                    <div class="num" data-start="0" data-end="<?=count($high);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?=get_phrase('scored_high');?></h3>
                   
        		</div>
        	</div>
        	
        	 <div class="col-md-3">
     			<div class="tile-stats tile-red">
     				<div class="icon"><i class="fa fa-thumbs-down"></i></div>
                    <div class="num" data-start="0" data-end="<?=count($low);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?=get_phrase('scored_low');?></h3>
                   
        		</div>
        	</div>
        	
        	<div class="col-md-3">
     			<div class="tile-stats tile-brown">
     				<div class="icon"><i class="fa fa-book"></i></div>
                    <div class="num" data-start="0" data-end="<?=$performance;?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('performance');?></h3>
                   
        		</div>
        	</div>
        	
        </div>
     </div>
</div>


<!--<div class="row">
	<div class="col-md-12">
    	<div class="row">
        
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
    
 </div>-->
    
    
    <div class="row">
	<div class="col-md-4">
		<div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->get('ci_sessions')->num_rows();?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('users');?></h3>
                   <p>Total Users</p>
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
						$assessed = $this->assessment_model->assessed_benchmarks($this->session->login_user_id,$date);
						foreach($assessed as $row):
						?>
						{
							title: "<?php echo $this->db->get_where('benchmark',array('benchmark_id'=>$row->benchmark_id))->row()->name;?>",
							start: new Date(<?php echo date('Y',strtotime($row->next_assessment_date));?>, <?php echo date('m',strtotime($row->next_assessment_date))-1;?>, <?php echo date('d',strtotime($row->next_assessment_date));?>),
							end:	new Date(<?php echo date('Y',strtotime($row->next_assessment_date));?>, <?php echo date('m',strtotime($row->next_assessment_date))-1;?>, <?php echo date('d',strtotime($row->next_assessment_date));?>), 
							url: "<?=base_url();?>competency.php/facilitator/assessment/<?=strtotime('+1 day',strtotime($row->next_assessment_date));?>"
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script>