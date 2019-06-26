<hr />

<h3 style="text-align: center;"><a href="<?=base_url();?>training.php/partner/register/<?=$event->event_id;?>"><i class="fa fa-home"></i></a> <?=$event->event_title;?></h3>
<hr />
<?php
	if(count($results['response']) === 0){
?>
	<div class="row">
		 <div style="text-align: center;" class="col-sm-12"> Evaluation was completed and submitted. Click <div class="btn btn-default" id="show_results">here</div> to view responses</div>
	</div>
<?php		
	}else{
		
	
?>
<div class="row">
	<div class="col-sm-6"><?=get_phrase('question');?></div>
	<div class="col-sm-3"><?=get_phrase('scale');?></div>
	<div class="col-sm-3"><?=get_phrase('comment');?></div>
</div>
<hr />
<div class="row">
	<div class="col-sm-12">
		
		
		<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#general" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('general');?>
                    	</a>
            </li>
			
			<li class="">
            	<a href="#trainers" data-toggle="tab"><i class="entypo-lock"></i> 
					<?php echo get_phrase('trainers');?>
                    	</a>
            </li>

            
            
		</ul>
    	 <!------CONTROL TABS END------>
        
	
		<div class="tab-content">
			
			<div class="tab-pane box active" id="general" style="padding: 5px">
               <div class="box-content">
		
						<?php
							echo form_open('', array('id'=>'frmlem','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));	
							foreach($results['general_questions'] as $question){
								
								
							$comment = "";		
							
							$answer_container = "";
								if($question->question_type == 1 ){
									$scale = range(1, 5);
										$answer_container .="<div class='col-sm-6'>";
										$disabled = "disabled='disabled'";
										foreach($scale as $row){
											
												$checked = "";
												
												if(count($scores) > 0){
														foreach($scores as $score){
															if($score->lemquestions_id == $question->lemquestions_id && $row == $score->score){
																$checked = "checked='checked'";
																$disabled = "";
															}
															
														}
													}
											
											$answer_container .=$row." <input ".$checked." type='radio' value='' name='question[".$question->lemquestions_id."]' id='radio_".$question->lemquestions_id."_".$row."' class='response'/> "; 
										}
										$answer_container .="</div>";
										
												if(count($scores) > 0){
														foreach($scores as $score){
															if($score->lemquestions_id == $question->lemquestions_id){
																
																$comment = $score->comment;
															}
															
														}
													}
										
										$answer_container .="<div class='col-sm-6'>";
											$answer_container .="<textarea ".$disabled." class='form-control comment' id='comment_".$question->lemquestions_id."' name='question[".$question->lemquestions_id."]' placeholder='".get_phrase('comment_here')."'>".$comment."</textarea>";
										$answer_container .="</div>";
								}elseif($question->question_type == 2){
									
											$suggestion = "";
											if(count($scores) > 0){
												foreach($scores as $score){
													if($score->lemquestions_id == $question->lemquestions_id){
														$suggestion = $score->suggestion;
													}
															
												}
											}
									
										$answer_container .="<div class='col-sm-offset-6 col-sm-6'>";
											$answer_container .="<textarea class='form-control response response_ans' id='text_".$question->lemquestions_id."' name='question[".$question->lemquestions_id."]' placeholder='".get_phrase('comment_here')."'>".$suggestion."</textarea>";
										$answer_container .="</div>";	
								}
									
						?>
				
								<div class="form-group"> 
									<div class="col-sm-6"><?=$question->description;?></div>
									<div class="col-sm-6"><?=$answer_container;?></div>
								</div>
							
						<?php
							}
						?>
						
							<div class="form-group">
								<div class="col-sm-12" style="text-align: center;">
									<div class="btn btn-danger submit"><?=get_phrase("submit");?></div>
								</div>
							</div>	
							</form>
							
				</div>
				
			</div>	
			
			
			
			<div class="tab-pane box " id="trainers" style="padding: 5px">
               <div class="box-content">
						<?php
							echo form_open('', array('id'=>'frmlem','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));	
							$comment = "";	
							foreach($results['trainers'] as $trainer){
								
							?>	
								 <div class="form-group"> 
								 	<div class="col-sm-12" style="text-align: center;">
								 		<h5 style="font-weight: bold;"><?=$trainer->name;?></h5>
								 	</div>
								 </div>	
							<?php		
									foreach($results['trainer_questions'] as $question){
										
									$disabled = "disabled='disabled'";
									$comment = "";
									$answer_container = "";
										if($question->question_type == 1 ){
											$scale = range(1, 5);
												$answer_container .="<div class='col-sm-6'>";
												$disabled = "disabled='disabled'";
												foreach($scale as $row){
													
														$checked = "";
														
														if(count($scores) > 0){
																foreach($scores as $score){
																	if($score->lemquestions_id == $question->lemquestions_id && $row == $score->score && $trainer->trainer_id === $score->trainer_id){
																		$checked = "checked='checked'";
																		$disabled = "";
																	}
																	
																}
															}
													
													$answer_container .=$row." <input ".$checked." type='radio' value='' name='question[".$question->lemquestions_id."_".$trainer->trainer_id."]' id='radio_".$question->lemquestions_id."_".$row."_".$trainer->trainer_id."' class='response'/> "; 
												}
												$answer_container .="</div>";
												
												
													
												
												if(count($scores) > 0){
														foreach($scores as $score){
															if($score->lemquestions_id == $question->lemquestions_id && $trainer->trainer_id === $score->trainer_id){
																
																$comment = $score->comment;
															}
															
														}
													}
												
												
												$answer_container .="<div class='col-sm-6'>";
													$answer_container .="<textarea ".$disabled." class='form-control comment' id='comment_".$question->lemquestions_id."_".$trainer->trainer_id."' name='question[".$question->lemquestions_id."]'  name='question[".$question->lemquestions_id."]' placeholder='".get_phrase('comment_here')."'>".$comment."</textarea>";
												$answer_container .="</div>";
										}elseif($question->question_type == 2){
												
												$answer_container .="<div class='col-sm-offset-6 col-sm-6'>";
													$answer_container .="<textarea class='form-control response response_ans' id='text_".$question->lemquestions_id."' name='question[".$question->lemquestions_id."]' placeholder='".get_phrase('comment_here')."'></textarea>";
												$answer_container .="</div>";	
										}
											
								?>
						
										<div class="form-group"> 
											<div class="col-sm-6"><?=$question->description;?></div>
											<div class="col-sm-6"><?=$answer_container;?></div>
										</div>
									
								<?php
									}
									
							}
						?>
						
						<div class="form-group">
								<div class="col-sm-12" style="text-align: center;">
									<div class="btn btn-danger submit"><?=get_phrase("submit");?></div>
								</div>
							</div>	
						</form>
				</div>
			</div>		
			
		</div>				
	</div>
</div>
<?php }?>
<hr />
<div class="row">
	<div class="col-sm-12" style="display: none;" id="view_results">
		
	</div>
</div>

<script>
		$("#show_results").click(function(){
			
			var url = "<?=base_url();?>training.php/partner/view_evaluation_result/<?=$event->event_id;?>";
			
			$.ajax({
				url:url,
				beforeSend:function(){
					$("#view_results").css("display","block");
					$("#view_results").html('<div style="text-align:center;margin-top:50px;"><img src="<?php echo base_url();?>uploads/preloader.gif" /></div>');
				},
				success:function(resp){
					$("#view_results").css("display","block");
					$("#view_results").html(resp);
				},
				error:function(){
					
				}
			});
		});

</script>


<script>


	$(".response").change(function(ev){
			
		var id = $(this).attr("id");
		var question_id = id.split("_")['1'];
		var response_type = id.split("_")['0']; 
		var trainer_id = id.split("_").length === 4?id.split("_")['3']:0;
		var score = id.split("_").length > 2?id.split("_")['2']:0;
		var suggestion = id.split("_").length === 2?$(this).val():"";
		
		if(id.split("_").length > 3){
			if(response_type === "radio") $("#comment_"+question_id+"_"+trainer_id).removeAttr("disabled");
		}else{
			if(response_type === "radio") $("#comment_"+question_id).removeAttr("disabled");
		}
		
		
		var data = {"lemresponse_id":"<?=$results['response']->lemresponse_id;?>","response_type":response_type,"lemquestions_id":question_id,"score":score,"suggestion":suggestion,"trainer_id":trainer_id};
		var url = "<?=base_url();?>training.php/partner/mark_evaluation_scores";
		
		$.ajax({
			url:url,
			data:data,
			type:"POST",
			success:function(resp){
				//alert(resp);
			},
			error:function(){
				
			}
		});
		 
	});
	
	$(".comment").change(function(ev){
		var id = $(this).attr("id");
		var question_id = id.split("_")['1'];
		var comment = $(this).val();
		var trainer_id = id.split("_").length === 3?id.split("_")['2']:0;
	
		
		var data = {"lemresponse_id":"<?=$results['response']->lemresponse_id;?>","lemquestions_id":question_id,"comment":comment,"trainer_id":trainer_id};
		var url = "<?=base_url();?>training.php/partner/add_evaluation_comments";
		
		$.ajax({
			url:url,
			data:data,
			type:"POST",
			success:function(resp){
				//alert(resp);
			},
			error:function(){
				
			}
		});
		
	});
	
	
	$(".submit").click(function(ev){
		
		var comment = $(".comment");
		var response = $(".response_ans");
		var cnt = 0;
		var cnt2 = 0;
		$.each(comment,function(i,el){
			if($(el).val() === ""){
				cnt++;
				$(el).css("border","1px red solid");
			}
		});
		
		
		$.each(response,function(i,el){
			if($(el).val() === ""){
				cnt2++;
				$(el).css("border","1px red solid");
			}
		});
		//alert(cnt);alert(cnt2);
		if(cnt > 0 || cnt2 > 0){
			alert("<?=get_phrase("you_have_incomplete_fields");?>");
		}else{
			var url = "<?=base_url();?>training.php/partner/submit_evaluation/<?=$results['response']->lemresponse_id?>";
			
			$.ajax({
				url:url,
				success:function(resp){
					alert(resp);
					window.location.reload();
				},
				error:function(){
					
				}
			});
		}
		
		
		ev.preventDefault();
	});
	
	
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
	
</script>