<?php
	$schedule = $this->db->join('planheader','planheader.planHeaderID=plansschedule.planHeaderID')->get_where('plansschedule',array('scheduleID'=>$scheduleID))->row();
?>
<div class="btn-group">
		<button id="btn-<?=$scheduleID;?>" type="button" class="btn btn-sm dropdown-toggle <?=$btn;?>" data-toggle="dropdown">
				<?php echo get_phrase('action');?> <span class="caret"></span>
		</button>
			<ul class="dropdown-menu dropdown-default pull-left" role="menu">
				<?php
					if($schedule->approved==='1' || $schedule->approved==='4'){
				?>
									                   		
						<li>
							
								<a href="#" id="app-<?=$schedule->scheduleID;?>" class="action_item">
									  <i class="fa fa-check"></i>
											<?php echo get_phrase('approve');?>
								</a>
						</li>
									                        
						<li class="divider"></li>
									                      
									                   		
						<li>
							<a href="#" id="dec-<?=$schedule->scheduleID;?>" class="action_item">	
								<i class="fa fa-times"></i>
									<?php echo get_phrase('decline');?>
							</a>
						</li>
									                        
									                        
						<li class="divider"></li>
							<?php
								}elseif($schedule->approved==='2'){
							?>
						<li>
							<a href="#" id="dec-<?=$schedule->scheduleID;?>" class="action_item">
								<i class="fa fa-pencil"></i>
									<?php echo get_phrase('allow_review');?>
							</a>
						</li>
									                        
						<li class="divider"></li>
						<?php		
							}
						?>
									                   											                      
									                   		
						<li>
							<a href="#" id="unc-<?=$schedule->scheduleID;?>" class="action_item">
								<i class="fa fa-trash-o"></i>
										<?php echo get_phrase('unacceptable');?>
							</a>
						</li>
									                        
															
						<li class="divider"></li>
									                   	
						</ul>
			</div> 
			
			<a href="#" onclick="return false;" id="com-<?=$schedule->scheduleID;?>" class="btn btn-white action_popup">
				<i class="fa fa-arrow-circle-o-right"></i>
					<?php echo get_phrase('comments');?>
			</a>
			
			<?php if($schedule->notes) {?>
				<i style="color:green;cursor:pointer;" id="not-<?=$schedule->scheduleID;?>" class="fa fa-book notes"></i>
			<?php }?>		
			
<script>
		$(document).ready(function(){ 

					$('a.action_popup').popover({  
		                title:'Comments',  
		                content:fetchData,
		                html:true,  
		                placement:'bottom'  
		           }); 
	
            
           
           
           function fetchData(){  
                var fetch_data = '';  
                var element = $(this);  
                var id = element.attr("id");  
                
                $.ajax({  
                     url:"<?=base_url();?>ifms.php/facilitator/budget_comments",  
                     method:"POST",  
                     async:false,  
                     data:{id:id},  
                     success:function(data){  
                          fetch_data = data;  
                     }  
                });  
                return fetch_data;  
           }
           
           
       $('.notes').popover({  
		      title:'Notes',  
		      content:fetchNotes,
		      html:true,  
		      placement:'bottom'  
		}); 
	
            
           
           
           function fetchNotes(){  
                var fetch_data = '';  
                var element = $(this);  
                var id = element.attr("id");  
                
                $.ajax({  
                     url:"<?=base_url();?>ifms.php/facilitator/budget_notes",  
                     method:"POST",  
                     async:false,  
                     data:{id:id},  
                     success:function(data){  
                          fetch_data = data;  
                     }  
                });  
                return fetch_data;  
           }  
      });
</script>							                