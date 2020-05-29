<?php

?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-code"></i>
                            <?php echo get_phrase($page_title);?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<hr />
                    	<div class="row">
                    		<div class="col-sm-12">
                    			
                    				<!-- <a href="<?=base_url();?>exams.php/civa/add_kcse_result" class="btn btn-default"><?=get_phrase('add_exam_results');?></a> -->
		                    		<a href="<?=base_url();?>exams.php/civa/download_kcse_results/<?=$start_of_year_date;?>" id="excel_download" class="btn btn-default"><?=get_phrase('download_results');?></a>									
		                    		<!-- <a href="<?=base_url();?>exams.php/civa/add_subject"  class="btn btn-default"><?=get_phrase('add_subject');?></a> -->
								
								<div class="btn-group">
		                    		<a href="<?=base_url();?>exams.php/civa/kcse/<?=strtotime('first day of january last year',$start_of_year_date);?>" 
		                    			class="btn btn-default"><i class="fa fa-backward"></i> 
		                    			<?=get_phrase('examination_year')." ".date('Y',strtotime('first day of january last year',$start_of_year_date))?></a>
		                    		
		                    		<div class="btn btn-success"><?=get_phrase('examination_year')." ".date('Y',$start_of_year_date)?></div>
		                    		
		                    		<a href="<?=base_url();?>exams.php/civa/kcse/<?=strtotime('first day of january next year',$start_of_year_date);?>" 
		                    			class="btn btn-default"><?=get_phrase('examination_year')." ".date('Y',strtotime('first day of january next year',$start_of_year_date))?> 
		                    			<i class="fa fa-forward"></i></a>
		                    	</div>
                    		</div>
                    	</div>
                    	<hr />
                    	<div class="row">
                    		<div class="col-sm-12">
                    			<table class="table table-striped datatable">
		                    		<thead>
		                    			<tr>
		                    				<th><?=get_phrase('action');?></th>
		                    				<th><?=get_phrase('cluster');?></th>
		                    				<th><?=get_phrase('project_id');?></th>
		                    				<th><?=get_phrase('beneficiary_id');?></th>
		                    				<th><?=get_phrase('beneficiary_name');?></th>
		                    				<th><?=get_phrase('date_of_birth');?></th>
		                    				<th><?=get_phrase('gender');?></th>
		                    				<th><?=get_phrase('index_number');?></th>
		                    				<th><?=get_phrase('examination_year');?></th>
		                    				<th><?=get_phrase('mean_grade');?></th>
		                    				
		                    			</tr>
		                    		</thead>
		                    		<tbody>
		                    			<?php
		                    				foreach($records as $row){
		                    			?>
		                    			<tr>
		                    				<td>
		                    					<div class="btn-group">
													<button id="" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
														<?php echo get_phrase('action');?> <span class="caret"></span>
													</button>
													
													<ul class="dropdown-menu dropdown-default pull-left" role="menu">
														<li>
															<a target="__blank" href="<?=base_url();?>exams.php/civa/edit_kcse_results/<?=$row->rID;?>/<?=true;?>">
																 <i class="fa fa-eye"></i>
																	<?php echo get_phrase('view');?>
															 </a>
														</li>
																					
														<li  style="" class="divider"></li>
														<!-- <li>
															<a href="<?=base_url();?>exams.php/civa/edit_kcse_results/<?=$row->rID;?>">
																 <i class="fa fa-pencil"></i>
																	<?php echo get_phrase('edit');?>
															 </a>
														</li>
																					
														<li  style="" class="divider"></li> -->
														
														<li>
															<a href="#" onclick="confirm_action('<?=base_url();?>exams.php/civa/delete_kcse_result/<?=$row->rID;?>/<?=$start_of_year_date;?>')">
																 <i class="fa fa-trash"></i>
																	<?php echo get_phrase('delete');?>
															 </a>
														</li>
																					
														<li  style="" class="divider"></li>
																					
													</ul>
												</div>										
		                    					
		                    				</td>
		                    				<td><?=$row->cstName;?></td>
		                    				<td><?=$row->pNo;?></td>
		                    				<td><?=$row->childNo;?></td>
		                    				<td><?=$row->childName;?></td>
		                    				<td><?=$row->dob;?></td>
		                    				<td><?=$row->sex;?></td>
		                    				<td><?=$row->indx;?></td>
		                    				<td><?=$row->acYr;?></td>
		                    				<td><?=$grades_key[$row->mean_grade];?></td>
		                    			<?php
											}
		                    			?>
		                    		</tr>	
		                    		</tbody>
		                    	</table>
                    		</div>
                    	</div>
                    </div>
             </div>       	
		
	</div>
</div>

<script>
	$("#excel_download").on("click",function(ev){
		

	});
	
	$(".datatable").DataTable();
</script>