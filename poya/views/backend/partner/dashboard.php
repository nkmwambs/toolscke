<hr />
<?php

if($current_nomination_level == 0){
?>
	<div class="well" style="text-align: center;color:red;">Error has occurred or voting has not commenced, please contact the administrator</div>
<?php	
}else{
?>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?= get_phrase('nomination_level'); ?> : <?=$nomination_levels[$current_nomination_level];?></div>						
				</div>
										
				<div class="panel-body">
					<?php
						if(empty($projects)){
					?>	
							<div class="well" style="text-align: center;color: red;">You do not have eligible partners to vote for at this level</div>
					<?php
						}
						else{		
					 echo form_open(base_url() . 'poya.php/partner/nominate/', array('id' => 'frm_nominate', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
					
					<div class="form-group">
						<div class="col-xs-12"  style="text-align: center;">
							<h3>Choose an FCP to View a Profile For</h3> 
						</div>
					</div>		
					
					<div class="form-group">
						<div class="col-xs-12">
															
								<?php
									foreach($projects as $projects_row){
								?>
									<div class="btn-toolbar" style="margin-bottom: 5px;">
										<?php
										foreach($projects_row as $project=>$token){
											
										?>
											<div id="<?=$token;?>" class="btn btn-info project_btn"><?=$project;?></div>
										<?php
										}
										?>
									</div>
									
								<?php
									}
								?>
								
						</div>
						</div>
						
						</form>
						
						<?php
						}
						?>
						
						<div id="profile">
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
						</div>
					
					
				</div>
			</div>	
	</div>
</div>
<?php
}
?>

<script>
	$('.project_btn').on('click',function(){
		
		$('.project_btn').each(function(i,el){
			if($(el).hasClass('btn-success')){
				$(el).toggleClass('btn-success btn-info');
			}
			
		});
		
		$(this).toggleClass('btn-info btn-success');
		
		var token = $(this).attr('id');
		var fcp = $(this).html();
		var url = "<?=base_url();?>poya.php/partner/retrieve_profiles/"+token;
		
		$.ajax({
			url:url,
			data:{'fcp':fcp},
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