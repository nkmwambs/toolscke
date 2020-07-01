<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-primary btn-icon" onclick="showAjaxModal('<?=base_url();?>training.php/modal/popup/modal_add_event');"><i class="fa fa-plus"></i><?=get_phrase('add_event');?></button>
                    	
	</div>
</div>
<hr />
<div class="row">
	<div class="col-md-8">
   
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('training_calendar');?>
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

	<div class="col-md-4">
		<div class="row">
			<div class="col-sm-12">
				<span style="font-weight: bold;text-decoration: underline;"><?=get_phrase("key");?></span></br>
				<div class="label label-success"><?=get_phrase("confirmed");?></div></br>
				<div class="label label-danger"><?=get_phrase("tentative");?></div></br>
				<div class="label label-info"><?=get_phrase("rescheduled");?></div></br>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped">
                	<thead>
                		<tr>
                			<th colspan="2"><?=get_phrase('event_details');?></th>
                		</tr>
                	</thead>
                	<tbody>
                		<tr>
                			<td><?=get_phrase('title');?></td>
                			<td id="event_details_title" class="event_details"></td>
                		</tr>
                		<tr>
                			<td><?=get_phrase('start_date');?></td>
                			<td id="event_details_start" class="event_details"></td>
                		</tr>
                		<tr>
                			<td><?=get_phrase('end_date');?></td>
                			<td id="event_details_end" class="event_details"></td>
                		</tr>
                		<tr>
                			<td><?=get_phrase('status');?></td>
                			<td id="event_details_status" class="event_details"></td>
                		</tr>
                		<tr>
                			<td><?=get_phrase('all_day');?></td>
                			<td id="event_details_allDay" class="event_details"></td>
                		</tr>
                		<tr>
                			<td><?=get_phrase('description');?></td>
                			<td id="event_details_description" class="event_details"></td>
                		</tr>
                	</tbody>
                </table>
			</div>
		</div>		
	</div>
</div>



    <script>
  $(document).ready(function() {
	  

		// Get defaultView from LocalStorage, fallback on basicWeek if it is not set yet.
		//var defaultView = (localStorage.getItem("fcDefaultView") !== null ? localStorage.getItem("fcDefaultView") : "basicWeek");
				
		var $calendar =$('#notice_calendar').fullCalendar({
					
					header: {
						left: 'title',
						right: 'prevYear prev today,month,agendaDay,agendaWeek next nextYear'
					},
					dragOpacity:0.45,	
					eventDrop: function(event, delta, revertFunc) {

				        alert(event.title + " was dropped on " + moment(event.start).format('YYYY-MM-DD hh:mm:ss'));
				
				        if (!confirm("Are you sure about this change?")) {
				            revertFunc();
				        }else{
				        	var url = "<?=base_url();?>training.php/admin/event_edit/";
				        	$.ajax({
				        		url:url,
				        		type:"post",
				        		data:{
				        			event_title:event.title,
				        			event_start_date:moment(event.start).format('YYYY-MM-DD hh:mm:ss'),
				        			event_end_date:moment(event.end).format('YYYY-MM-DD hh:mm:ss')
				        		},
				        		success:function(response){
				        			alert(response);
				        		}
				        	});
				        }
				
				    },
					
					eventMouseover:function(event, jsEvent, view){
						
						$(".fc-event-inner").addClass("col-sm-8");
						$(".fc-event-inner").parent().css('border-radius','5px');					
												
						var el=$(this);

					    var layer='<div style="background-color:white;color:black;border-radius:5px;" class="action-buttons col-sm-4 pull-right"> <div style="padding-right:10px;cursor:pointer;" id="events-layer" class="fc-transparent pull-right"><i id="delbut'+event.id+'" class="fa fa-trash"></i></div>';
					    layer +='&nbsp;<div style="padding-right:10px;cursor:pointer;" id="events-edit" class="fc-transparent pull-right"><i id="viewbut'+event.id+'" class="fa fa-edit"></i></div> &nbsp; ';
					    layer +='&nbsp;<div style="padding-right:10px;cursor:pointer;" id="events-register" class="fc-transparent pull-right"><i id="regbut'+event.id+'" class="fa fa-eye"></i></div> &nbsp; ';
					    layer +='&nbsp;<div style="padding-right:10px;cursor:pointer;" id="events-evaluation" class="fc-transparent pull-right"><i id="evalbut'+event.id+'" class="fa fa-folder-o"></i></div> </div>';
					    el.append(layer);
						
						
						var status = 'Full Planned';
						if(event.status=='red') status = 'Tentantive';
					    if(event.status=='blue') status = 'Rescheduled';
					    var event_title = event.title;
						var event_start_date = moment(new Date(event.start)).format('DD-MM-YYYY');
						var event_end_date = moment(new Date(event.end)).format('DD-MM-YYYY');
						
						$('#event_details_title').html(event.title);
						$('#event_details_start').html(event_start_date);
						$('#event_details_end').html(event_end_date);
						$('#event_details_status').html(status);
						$('#event_details_description').html(event.description);
						$('#event_details_allDay').html(event.allDay);
							
					    el.find(".fc-bg").css("pointer-events","none");
					
					    $("#delbut"+event.id).click(function(){
					    	var cnfrm = confirm('Are you sure you want to perform this task?');
					    	
					    	if(!cnfrm){
					    		alert('Process Aborted');
					    	}else{
					    		
					    		var url2 = "<?=base_url();?>training.php/admin/delete_event/";
					    		$.ajax({
									url:url2,
									type:"post",
									data:{
										title:event_title
									},
									success:function(response){
										alert(response);
										$calendar.fullCalendar('removeEvents', event._id);
									}
								});
					    	}
					        
					    });
					    
					    $("#viewbut"+event.id).click(function(){
					    	
					    	var url = "<?=base_url();?>training.php/admin/view_event/"+event.id;
					    	
					        $.ajax({
								url:url,
								success:function(response){ 
									var obj  = JSON.parse(response);
									showAjaxModal('<?=base_url();?>training.php/modal/popup/modal_edit_event/'+obj.event_id);
								}
							});
					    });
					    
					    $("#regbut"+event.id).click(function() {
						   window.open('<?=base_url();?>training.php/admin/register/'+event.id, '_blank');
						});
					    
					    
					    $("#evalbut"+event.id).click(function() {
						   window.open('<?=base_url();?>training.php/admin/evaluation', '_blank');
						});
					    
					  tooltip = '<div class="tooltiptopicevent" style="max-width:350px;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">' + 'Title' + ': ' + event.title + '</br>' + 'Start' + ': ' + event.start + '</br>' + 'Description'+': ' + event.description + '</div>';

				      $("body").append(tooltip);
				      $(this).mouseover(function (e) {
				            $(this).css('z-index', 10000);
				            $('.tooltiptopicevent').fadeIn('500');
				             $('.tooltiptopicevent').fadeTo('10', 1.9);
				       }).mousemove(function (e) {
				            $('.tooltiptopicevent').css('top', e.pageY + 10);
				            $('.tooltiptopicevent').css('left', e.pageX + 20);
				       });
					    
						
					},
					eventMouseout:function(event, jsEvent, view ){
						//$(this).css('border','1px solid white');
						$('.event_details').html("");

						$(".action-buttons").remove();
												
						$(this).css('z-index', 8);

            			$('.tooltiptopicevent').remove();
					},
					firstDay: 1,
					height: 530,
					droppable: false,
					weekends : false,
					selectable: true,
					select: function(start, end, jsEvent, view) {
							var start_date = new Date(start);
							var end_date = new Date(end);
							
							var s_date = moment(start_date).format('YYYY-MM-DDTHH:mm:ss');
							var e_date = moment(end_date).format('YYYY-MM-DDTHH:mm:ss');
							
							showAjaxModal('<?=base_url();?>training.php/modal/popup/modal_add_event/'+s_date+'/'+e_date);
							
						},
						
					editable: true,	
					eventResize: function(event, delta, revertFunc) {

				        alert(event.title + " end is now " + moment(event.end).format('YYYY-MM-DD hh:mm:ss'));
				
				        if (!confirm("Are you sure about this change?")) {
				            revertFunc();
				        }else{
				        	var url = "<?=base_url();?>training.php/admin/event_edit/";
				        	$.ajax({
				        		url:url,
				        		type:"post",
				        		data:{
				        			event_title:event.title,
				        			event_start_date:moment(event.start).format('YYYY-MM-DD hh:mm:ss'),
				        			event_end_date:moment(event.end).format('YYYY-MM-DD hh:mm:ss')
				        		},
				        		success:function(response){
				        			alert(response);
				        		}
				        	});
				        }
				
				    },
					events: [
						<?php 
						$notices	=	$this->db->get('event')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo trim($row['event_title']);?>",
							start: new Date(<?php echo date('Y',strtotime($row['event_start_date']));?>, <?php echo date('m',strtotime($row['event_start_date']))-1;?>, <?php echo date('d',strtotime($row['event_start_date']));?>),
							end:	new Date(<?php echo date('Y',strtotime($row['event_end_date']));?>, <?php echo date('m',strtotime($row['event_end_date']))-1;?>, <?php echo date('d',strtotime($row['event_end_date']));?>), 
							color:'<?php echo $row['color_code'];?>',
							allDay:'<?php echo $row['allDay'];?>',
							id: "<?php echo $row['event_id'];?>",
							description: "<?php echo trim($row['event_description']);?>",
							status: "<?php echo $row['color_code'];?>"
						},
						<?php 
						endforeach;
						?>
						
					],
					
				    viewRender: function (view, element) {
				        // When the view changes, we update our localStorage value with the new view name.
				        //localStorage.setItem("fcDefaultView", view.name);
				    }
				});
	});
  </script>

  
