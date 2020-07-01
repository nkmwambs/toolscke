<?php
//print_r($fcp_progress);
//print_r($progress);
//print_r($fcps_in_progress);
?>
<hr />
<div class="row">
	<div class="col-xs-12">

		<table class="table table-striped datatable">
			<thead>
				<tr>
					<th rowspan="2">FCP ID</th>
					<th rowspan="2">Current Nomination Level</th>
					<th colspan="3">Eligible Voting Level</th>
					
				</tr>
				<tr>
					
					<th>Cluster Level</th>
					<th>Regional Level</th>
					<th>National Level</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($fcp_progress  as $fcp_id=>$fcp_progress){
					 foreach($fcp_progress as $group_id=>$group_progress){
				?>
						<tr>
							<td><?=$fcp_id;?> - <?=$group_progress['group_name'];?></td>
							<td class="nomination_level_label"><?=$nomination_levels[$group_progress['nomination_level']];?></td>
							
							<?php if($group_progress['nomination_level'] == 1){?>
							<td>
								<div class="btn btn-success level_1" data-group-id= "<?=$group_id;?>" data-fcp-id = "<?=$fcp_id;?>">
									<i id="left_arrow" class="fa fa-arrow-circle-left btn_progress"></i> 
										<span>Level 1</span>
									<i id="right_arrow" class="fa fa-arrow-circle-right btn_progress"></i>
								</div>
							</td>
							<td></td>
							<td></td>
							<?php }?>
							
							<?php if($group_progress['nomination_level'] == 2){?>
							<td></td>
							<td>
								<div class="btn btn-success level_2" data-group-id= "<?=$group_id;?>" data-fcp-id = "<?=$fcp_id;?>">
									<i id="left_arrow" class="fa fa-arrow-circle-left btn_progress"></i> 
										<span>Level 2</span>
									<i id="right_arrow" class="fa fa-arrow-circle-right btn_progress"></i>
								</div>
							</td>
							<td></td>
							<?php }?>
							
							<?php if($group_progress['nomination_level'] == 3){?>
							<td></td>
							<td></td>
							<td>
								<div class="btn btn-success level_3" data-group-id= "<?=$group_id;?>" data-fcp-id = "<?=$fcp_id;?>">
									<i id="left_arrow" class="fa fa-arrow-circle-left btn_progress"></i> 
										<span>Level 3</span>
									<i id="right_arrow" class="fa fa-arrow-circle-right btn_progress"></i>
								</div>
							</td>
							<?php }?>
							
							
						</tr>
					<?php 
						}
					 }
					?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$('.datatable').DataTable({
		stateSave:true,
	});
	
	$(document).on('click','.btn_progress',function(){
		var clone = $(this).closest('div').clone();
		var data_provider = $(this).closest('div').data();
		var fcp_id = data_provider.fcpId;
		var group_id = data_provider.groupId;
		var nomination_level = 1;
		
		if($(this).closest('div').hasClass('level_1')){
			
			if($(this).hasClass('fa-arrow-circle-left')){
				alert('Illegal action');
				return false;
			}
			
			clone.find('span').html('Level 2');
			clone.toggleClass('level_1 level_2');
			
			$(this).closest('td').siblings('.nomination_level_label').html('Regional Level');
			
			var next_level = $(this).closest('td').next();
			next_level.html(clone);
			$(this).closest('div').remove();
	
			nomination_level = 2;
		}
		
		if($(this).closest('div').hasClass('level_2')){
			
			if($(this).hasClass('fa-arrow-circle-right')){
				clone.find('span').html('Level 3');
				clone.toggleClass('level_2 level_3');
				
				$(this).closest('td').siblings('.nomination_level_label').html('National Level');
				
				var next_level = $(this).closest('td').next();
				nomination_level = 3;
			}else{
				clone.find('span').html('Level 1');
				clone.toggleClass('level_2 level_1');
				
				$(this).closest('td').siblings('.nomination_level_label').html('Cluster Level');
				
				var next_level = $(this).closest('td').prev();
				nomination_level = 1;
			}
			
			next_level.html(clone);
			$(this).closest('div').remove();
		}
		
		if($(this).closest('div').hasClass('level_3')){
			
			if($(this).hasClass('fa-arrow-circle-right')){
				alert('Illegal action');
			}else{
				clone.find('span').html('Level 2');
				clone.toggleClass('level_3 level_2');
				
				$(this).closest('td').siblings('.nomination_level_label').html('Regional Level');
				
				var next_level = $(this).closest('td').prev();
				nomination_level = 2;
			}
			
			next_level.html(clone);
			$(this).closest('div').remove();
		}
		
		var url = "<?=base_url();?>poya.php/admin/change_fcp_nomination_level"
		var data = {'fcp_id':fcp_id,'nomination_level':nomination_level,'group_id':group_id};
		//console.log(data);
		$.ajax({
			url:url,
			data:data,
			type:"POST",
			beforeSend:function(){
				$("#overlay").css('display','block');
			},
			success:function(){
				//alert(resp);
				$("#overlay").css('display','none');
			},
			error:function(rhx,msgErr){
				alert(msgErr);
				$("#overlay").css('display','none');
			}
		});
		
	});
	
	
</script>