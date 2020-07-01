	<?php
		//print_r($this->poya_model->poya_model->cast_votes_summary_per_level(1,1));
		//print_r($count_of_voters);
	?>
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
		buttons:['copy', 'excel', 'pdf']
	});
</script>