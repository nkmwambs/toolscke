<?php
//print_r($votes_cast);
//echo $count_of_voters;
?>
<hr />
<div class="row">
	<div class="col-xs-4">
		<select id="select_survey_id" class="form-control">
			<option value=""><?php echo "Choose a Survey ID";?></option>
			<?php foreach($surveys as $survey){?>
				<option value="<?=$survey->limesurvey_id;?>" <?php if($active_poya_survey_id == $survey->poya_survey_id) echo "selected";?>><?=$survey->limesurvey_id;?> (<?=$survey->cluster_voting_start_date;?> - <?=$survey->national_voting_end_date;?>)</option>
			<?php }?>
		</select>
	</div>
	<div class="col-xs-4">
		<select id="select_nomination_level" class="form-control">
			<option value=""><?php echo "Choose Nomination Level";?></option>
			<?php
				foreach($nomination_levels as $nomination_level_key=>$nomination_level){
			?>
				<option value="<?=$nomination_level_key;?>" <?php if($current_nomination_level == $nomination_level_key) echo "selected";?>><?=$nomination_level;?></option>
			<?php
			}
			?>
		</select>
	</div>
	<div class="col-xs-2">
		<div class="btn btn-default" id="btn_go">Go</div>
	</div>
</div>
<hr />
<div id="results">
<div class="row">
	<div class="col-xs-6">
		<table class="table table-bordered datatable">
			<thead>
				<tr>
					<th colspan="12">Votes Summary</th>
				</tr>
				<tr>
					<th>Cluster</th>
					<th>FCP ID</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($count_of_voters as $row){
				?>
				<tr>
					<td><?=$row->cluster;?></td>
					<td><?=$row->fcp_id;?></td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<hr />

<div class="row">
	<div class="col-xs-12">
		<table class="table table-striped datatable">
			<thead>
				<tr>
					<th colspan="6">Votes List</th>
				</tr>
				<tr>
					<th>Survey ID</th>
					<th>Nomination Level</th>
					<th>Voted FCP</th>
					<th>Category</th>
					<th>Score</th>
					<th>Vote Submitted Date</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($votes_cast as $vote){?>
					<tr>
						<td><?=$vote->limesurvey_id;?></td>
						<td><?=$nomination_levels[$vote->nomination_level];?></td>
						<td><?=$vote->fcp_id;?></td>
						<td><?=$vote->question_group_name;?></td>
						<td><?=$vote->score;?></td>
						<td><?=$vote->lastmodifieddate;?></td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
</div>

<script>
	$(".datatable").DataTable({
		dom: 'Bfrtip',
	    buttons: [
	        'copy', 'excel', 'pdf'
	    ]
	});
	
	$('#btn_go').on('click',function(){
		
		var survey_id = $("#select_survey_id").val();
		var nomination_level = $("#select_nomination_level").val();
		var url = "<?=base_url();?>poya.php/admin/get_nomination_votes";
		var data = {'limesurvey_id':survey_id,"nomination_level":nomination_level};
		
		$.ajax({
			url:url,
			data:data,
			type:"POST",
			beforeSend:function(){
				$("#overlay").css('display','block');
			},
			success:function(resp){
				$("#results").html(resp);
				$("#overlay").css('display','none');
			},
			error:function(rhx,msgErr){
				alert(msgErr);
				$("#overlay").css('display','none');
			}	
		});
	})
	
</script>