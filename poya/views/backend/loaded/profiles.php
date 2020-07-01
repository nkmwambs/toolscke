<?php
//print_r($poya_nomination_progress);

$points = range(0, $this->config->item('voting_score_range_max'));

?>


<div class="row">
	<div class="col-xs-12">
		<table class="table table-striped datatable">
			<thead>
				<tr>
					<th colspan="4" style="text-align: center;">Your Cast Votes Summary</th>
				</tr>
				<tr>
					<th>Voted FCP</th><th>Category</th><th>Nomination Level</th><th>Score</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				foreach($votes_cast as $vote){
				?>
					<tr>
						<td><?=$vote->fcp_id;?></td>
						<td><?=$question_groups[$vote->question_group_id];?></td>
						<td><?=$nomination_levels[$vote->nomination_level];?></td>
						<td><?=$vote->score;?></td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<hr />

<div class="form-group">
	<div class="col-xs-12" style="text-align: center;">
		<?php
			if(empty($grid)){
		?>
			<h3 style="color: red;">FCP submitted an empty profile</h3>
		<?php	
			}else{
		?>
			<h3>Check on the Profile Per Category to Nominate</h3>
		<?php		
			}	
		?>
		
	</div>
</div>

<?php
foreach($grid as $group_key=>$group){
	if(isset($group['group_name']) && 
		$poya_nomination_progress[$group_key]['nomination_level'] == $nomination_level
		){
?>

<div class="form-group">
	<div class="col-xs-12">
		<div class="panel-group" id="accordion">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="btn btn-icon btn-block" data-toggle="collapse" data-parent="#accordion" href="#category_<?=$group_key;?>">
							<i class="fa fa-folder"></i> 
								 <h4><?=$group['group_name'];?></h4>
						</a>
					</h4>
				</div>
				
				<div id="category_<?=$group_key;?>" class="panel-collapse collapse">
					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<tbody>
								<?php foreach($group['questions'] as $question){
									
								?>
									<tr>
										<td style="text-align: center">
											<h4><?=$question['question_text'];?></h4>
										</td>
									</tr>
									<tr>
										<td>
											<?php
												if($question['question_type'] == 'U'){
											?>
											<textarea class="form-control" readonly="readonly" rows="25">
												<?=$question['response'];?>
											</textarea>
											
											<?php
												}elseif($question['question_type'] !=='|'){
													if(strpos($question['response'], 'http') !== false){
											?>
													<a target="__blank" href="<?=$question['response'];?>">Click here to view for more information</a>
											<?php
													}
												}elseif($question['question_type'] =='|'){
													if(isset($question['response'])){
													foreach($question['response'] as $file_name => $uploaded_file){
											?>		
													<a target="__blank" href="<?=$uploaded_file;?>"><?=$file_name;?></a></br/>
											<?php
													}
													}else{
											?>
													No Record Available
											<?php			
													}
												}else{
													echo $question['response'];	
												}
											?>
										</td>
									</tr>
									
								<?php }?>
								<tr>
										<td style="text-align: center;">
											<h4>Nominate in a range of 0 to <?=$this->config->item('voting_score_range_max')?> where 0 is "Not Satisfied" and <?=$this->config->item('voting_score_range_max')?> is "Extremely Satisfied" </h4>
										</td>
									</tr>
									
									<tr>
										<td>
											<select style="border:2px solid red;" class="form-control score" id="score_<?=$group_key;?>"
											 data-survey-id = "<?=$survey_id;?>" 
											  data-nomination-level = "<?=$nomination_level;?>" 
											   data-question-group-id = "<?=$group_key;?>"	
											   	data-token = "<?=$token;?>" 
											   	data-fcp = "<?=$fcp;?>"
											>
												<option value=""><?=get_phrase('select_a_score');?></option>
													<?php
														foreach($points as $point){
													?>
														<option value="<?=$point?>" <?php if($point == $group['score']) echo 'selected';?>><?=$point?></option>
													<?php
														}
													?>
											</select>
										</td>
									</tr>
							</tbody>
						</table>										
					</div>
				</div>		
			</div>	
		</div>		
	</div>
</div>	

<?php
}
}
?>

<script>
	$(".score").on('change',function(){
		
		var url = "<?=base_url();?>poya.php/partner/post_a_score/";
		var data_to_post = $(this).data();
		data_to_post.score = $(this).val();
		
		$.ajax({
			url:url,
			data:data_to_post,
			type:"POST",
			beforeSend:function(){
				$("#overlay").css('display','block');
			},
			success:function(resp){
				$("#profile").html(resp);
				$("#overlay").css('display','none');
			},
			error:function(rhx,msgErr){
				alert(msgErr);
				$("#overlay").css('display','none');
			}
		});
		
	});
	
	$('.datatable').DataTable();
</script>