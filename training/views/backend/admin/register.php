<?php
//if(isset($test)) print_r($test);
//print_r($participants);
?>
<hr/>
<div class="row">
	<div class="col-md-12" style="text-align: center;font-weight: bolder;"> <a href="<?=base_url();?>training.php/admin/dashboard" title="<?=get_phrase("back_to_calender");?>"><i class="fa fa-home"></i></a> <?=$event->event_title?>: <?=get_phrase("from")." ". date(date('d-m-Y',strtotime($event->event_start_date)))." " .get_phrase("to")." ".date(date('d-m-Y',strtotime($event->event_end_date)));?></div>
</div>

<div class="row">
	<div class="col-md-12">
		    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#participants" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('participants');?>
                    	</a>
            </li>
			
			<li class="">
            	<a href="#add_participants" data-toggle="tab"><i class="entypo-plus"></i> 
					<?php echo get_phrase('add_participants');?>
                    	</a>
            </li>
            
		</ul>
    	<!------CONTROL TABS END------>
        
	
		<div class="tab-content">
			
			<div class="tab-pane box active" id="participants" style="padding: 5px">
               <div class="box-content">
               			<hr/>
						<div class="row">
							<div class="col-sm-12">
								<button id="btn_erase"  class="btn btn-warning btn-icon hidden"><i class="fa fa-eraser"></i><?=get_phrase("removed_selected");?></button>
							</div>
						<div>		    		
						<hr/>	
						
						<div class="row">
							<div class="col-sm-3">
								<div class="tile-stats tile-red">
									<div class="icon"><i class="entypo-gauge"></i></div>
									<div class="num"><?=$this->db->get_where("participant",array("event_id"=>$event->event_id,"confirmed"=>"1"))->num_rows();?></div>
									
									<h3><?=get_phrase("confirmed_participants");?></h3>
									<p><?=get_phrase("for_this_training");?></p>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="tile-stats tile-blue">
									<div class="icon"><i class="entypo-gauge"></i></div>
									<div class="num"><?=$this->db->get_where("participant",array("event_id"=>$event->event_id,"confirmed"=>"0"))->num_rows();?></div>
									
									<h3><?=get_phrase("invited_participants");?></h3>
									<p><?=get_phrase("for_this_training");?></p>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="tile-stats tile-aqua">
									<div class="icon"><i class="entypo-gauge"></i></div>
									<div class="num"><?=$this->db->get_where("participant",array("event_id"=>$event->event_id))->num_rows();?></div>
									
									<h3><?=get_phrase("attended_participants");?></h3>
									<p><?=get_phrase("for_this_training");?></p>
								</div>
							</div>
							<div class="col-sm-3"></div>
						</div>
						
						<div class="row">
							<div class="col-sm-12">	
					    		<table class="table table-striped datatable" id="table_export">
					    			<thead>
					    				<tr>
					    					<th><input type="checkbox" class="select_all" id="select_all" /></th>
					    					<th><?=get_phrase("first_name");?></th>
					    					<th><?=get_phrase("last_name");?></th>
					    					<th><?=get_phrase("cluster");?></th>
					    					<th><?=get_phrase("ICP_ID");?></th>
					    					<th><?=get_phrase("designation");?></th>
					    					<th><?=get_phrase("confirmed");?></th>
					    					<th><?=get_phrase("attended");?></th>
					    					
					    				</tr>	
					    			</thead>
					    			<tbody>
					    				<?php
					    					foreach($participants as $participant){
												$staff = $this->db->get_where("users",array("ID"=>$participant->users_id))->row();
					    				?>
					    					<tr>
					    						<td><input type="checkbox" class="choose" id="<?=$participant->users_id;?>" /></td>
					    						<td><?=$staff->userfirstname;?></td>
					    						<td><?=$staff->userlastname;?></td>
					    						<td><?=$staff->cname;?></td>
					    						<td><?=$staff->fname;?></td>
					    						<td><?=$this->db->get_where("department",array("department_id"=>$staff->department))->row()->name;?></td>
					    						<td><input type="checkbox" class="confirm mark" id="confirm_<?=$participant->users_id;?>" value="<?=$participant->confirmed;?>" <?php if($participant->confirmed === '1') echo "checked";?>  <?php if($participant->attended === '1') echo "disabled='disabled'";?>  /></td>
					    						<td><input type="checkbox" class="attend mark" id="attend_<?=$participant->users_id;?>" value="<?=$participant->attended;?>" <?php if($participant->attended === '1') echo "checked";?>  <?php if($participant->confirmed === '0') echo "disabled='disabled'";?> /></td>
					    						
					    					</tr>
					    				
					    				<?php
											}
					    				?>
					    			</tbody>
					    		</table>
					    </div>
   					</div>		
					    		
   				</div>
   			</div>
   			</div>
   			</div>
   			
   			<div class="tab-pane box" id="add_participants" style="padding: 5px">
               <div class="box-content">
               		
               	<div class="row">
               		<div class="col-sm-12">	
               			<?php 
							echo form_open(base_url() . 'training.php/admin/manage_register/list_users/'.$event->event_id.'#add_participants', array('id'=>'frm_user_list','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
						?>
							<div class="form-group">
								<label class="control-label col-sm-2"><?=get_phrase("choose_projects");?></label>
								<div class="col-sm-8">
									<select class="form-control select2" multiple="multiple" name="projects[]">
										<?php 
											$icps = $this->db->get_where("users",array("userlevel"=>'1',"department"=>0))->result_object();
											$icp_arr = array();
											foreach($icps as $icp){
												$icp_arr[$icp->cname][] = $icp->fname; 
											}
											
											foreach($icp_arr as $cluster=>$projects){
										?>
												<optgroup label="<?=$cluster;?>">
													<?php
														foreach($projects as $project){
													?>
														<option value="<?=$project;?>"><?=$project;?></option>
													
													<?php
														}
													?>
												</optgroup>	
										<?php
											}
										?>
									</select>
								</div>
								<div class="col-sm-2">
									<button class="btn btn-default"><?=get_phrase("search")?></button>
								</div>
							</div>
						</form>
               		</div>
               	</div>	
               		
               	<hr/>
               			
               	<div class="row">
               		<div class="col-sm-12">
               			
               		
				    <?php
				    	
				    	if(isset($users) && sizeof($users)>0){
				     
						echo form_open(base_url() . 'training.php/admin/manage_register/add_participants/'.$event->event_id, array('id'=>'frm_user_add','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
					?>
						<div class="form-group">
							<label for="" class="col-xs-2 control-label"><?php echo get_phrase('choose_participants');?></label>
								<div class="col-xs-10">
									<!-- <select  class="form-control" multiple="multiple" id="participants_list" name="participants_list[]"> -->
								    <div class="col-sm-5">
									    <select  id="multiselect" class="form-control" size="8" multiple="multiple">
	 										
									      <?php 
									      	foreach($users as $project=>$user_array){
									      ?>
									      		<optgroup label="<?=$project;?>">
									      			<?php 
									      				foreach($user_array as $user){
									      					$selected = "";
									      					foreach($participants as $marked){
									      						if($marked->users_id === $user['ID']){
									      							$selected = "disabled='disabled' style='color:red;'";		
									      						}
									      					}
									      			?>
									      				<option <?=$selected;?> value="<?=$user['ID'];?>"><?=$user['userfirstname'].' '.$user['userlastname'];?> </option>								      	
												
													<?php 
															
														}
									      			?>
												</optgroup>								      
									      <?php 
											}
									      ?>
									      
									    </select>
									   </div>
									    
									    <div class="col-xs-2">
										    <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
										    <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
										    <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
										    <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
										  </div>
									    
									    
									    <div class="col-xs-5">
										    <select name="selected_participants[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
										    </select>
    
    									</div>		
									    
								</div>
						</div>
										
						<div class="form-group">
							<div class="col-xs-12">
								<button class="btn btn-primary btn-icon"><i class="fa fa-save"></i><?=get_phrase('create');?></button>
							</div>
						</div>	
										
					</form>                
					<?php
						}else{
					?>	
						<hr/><div class="well">No User Found</div>
					
					<?php
						}
					?>
					</div>
               	</div>		
							
            </div>   	
   			
   		</div>
	
	

</div>

</div>
</div>

<script>
	$(document).ready(function(){
		//var datatable = $('.table').DataTable();
		
		
		    if (location.hash) {
			        $("a[href='" + location.hash + "']").tab("show");
			    }
			    $(document.body).on("click", "a[data-toggle]", function(event) {
			        location.hash = this.getAttribute("href");
			    });
		
			$(window).on("popstate", function() {
			    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
			    $("a[href='" + anchor + "']").tab("show");
		
		});
		
		
		
		var datatable = $('.table').DataTable({
		       dom: '<"row"l><Bf><"col-sm-12"rt><ip>',
		       pagingType: "full_numbers",
		       buttons: [
		           'csv', 'excel', 'print'
		       ],
		       stateSave: true,
		       "columnDefs": [{ "targets": [0], "searchable": false, "orderable": false, "visible": true } ],
				lengthMenu: [[25,50, 100, 150,-1], [25,50 ,100,150 ,"All"]],
				pageLength: 50 
		
		   });
		   

		
		$('#multiselect').multiselect();
	   
	});
	
	$(".mark").click(function(){
			
		var url = "<?=base_url();?>training.php/admin/manage_register/mark_participation/<?=$event->event_id;?>";
		var users_id = $(this).attr('id').split("_")['1'];
		
		var confirmed = 0;
		var attended = 0;
		
		if($(this).is(":checked") && $(this).hasClass("confirm")){
			$( "#attend_"+$(this).attr('id').split("_")['1'] ).prop('disabled',false);
				confirmed = '1';
				attended = '0';
		}else if($(this).not(":checked") && $(this).hasClass("confirm")){
			$( "#attend_"+$(this).attr('id').split("_")['1'] ).prop("checked",false)
			$( "#attend_"+$(this).attr('id').split("_")['1'] ).prop('disabled',true);
			confirmed = '0';
			attended = '0';
		}else if($(this).is(":checked") && $(this).hasClass("attend")){
			$( "#confirm_"+$(this).attr('id').split("_")['1'] ).prop('disabled',true);
			confirmed = '1';
			attended = '1';
		}else if($(this).not(":checked") && $(this).hasClass("attend")){
			$( "#confirm_"+$(this).attr('id').split("_")['1'] ).prop('disabled',false);
			$( "#attend_"+$(this).attr('id').split("_")['1'] ).prop('disabled',true);
			confirmed = '1';
			attended = '0';
		}		
		
		var jqxhr = $.post( url, {"users_id":users_id,"marking":{"attended":attended,"confirmed":confirmed}})
					  .done(function(response) {
					    //alert( response );
					  })
					  .fail(function() {
					    alert( "error" );
					  })
					  .always(function() {
					    //alert( "finished" );
					  });

	})
	
	$(".select_all").click(function(){
		if($(this).is(":checked")){
			$(".choose").prop("checked",true);
			$("#btn_erase").removeClass("hidden");
		}else{
			$(".choose").prop("checked",false);
			$("#btn_erase").addClass("hidden");
		}
	});
	
	$(".choose").click(function(){
		//alert($(".choose:checked").length );
		if($(".choose:checked").length > 0 && $("#btn_erase").hasClass("hidden"))  {
			$("#btn_erase").removeClass("hidden");
		} else if($(".choose:checked").length === 0 && $("#btn_erase").not("hidden")) {
			$("#btn_erase").addClass("hidden");
		}
	});
	
	$("#btn_erase").click(function(){
		var selected = $(".choose:checked");
		var items = {};
		var url = '<?=base_url();;?>training.php/admin/manage_register/erase_participants/<?=$event->event_id;?>';
		
		$.each(selected,function(i,el){
			
			items[i] = $(el).attr('id');
		});
		
		var cnf = confirm("Are you sure you want to delete these records?");
		
		if(!cnf) {alert("Process Aborted"); return false;}
		
		var req = $.post(url,items)
			.done(function(resp){
				alert(resp);window.location.reload();
			})
			fail(function(){
				
			});
	})
	
</script>

