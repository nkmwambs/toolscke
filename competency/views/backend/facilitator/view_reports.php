<?php
$benchmark = $this->db->get_where('benchmark',array('benchmark_id'=>$benchmark_id))->row();
?>
<div class="row">
	<div class="col-md-12">
	   	<div class="row">
	        <div class="col-md-12 col-xs-12">    
	            <div class="panel panel-primary " data-collapsed="0">
                   <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-gauge"></i> 
	                            <?php echo get_phrase('reports');?> : <?=$benchmark->name;?>
	                      </div>
	               </div>
		            <div class="panel-body" style="padding:0px;overflow: auto;">
		            	<?php 
						
							echo form_open(base_url() . 'competency.php/facilitator/mark_assessed/'.$benchmark_id.'/'.$tym, array('id'=>'frm_assess','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
						?>
		            	<table class="table table-striped">
		            		<thead>
		            			<tr>
		            				<th><?=get_phrase('name');?></th>
		            				<th><?=get_phrase('description');?></th>
		            				<th><?=get_phrase('report_rating');?></th>
		            			</tr>
		            		</thead>
		            		<tbody>
		            			<?php
		            				$reports = $this->db->get_where('report',array('benchmark_id'=>$benchmark_id))->result_object();
		            				foreach($reports as $row):
		            			?>
		            				<tr>
		            					<input type="hidden" name="report_id[]" value="<?=$row->report_id;?>" />
		            					<td><a target="__blank" href="<?=$row->url;?>"><?=$row->name;?></a></td>
		            					<td><?=$row->description;?></td>
		            					<td>
		            						<select class="form-control must report_rating" name="rating[]" id="rating_<?=$row->report_id;?>">
		            							<option value=""><?=get_phrase('select');?></option>
		            							<option value="0"><?=get_phrase('low');?></option>
		            							<option value="1"><?=get_phrase('high');?></option>
		            						</select>
		            					</td>
		            				</tr>
		            			<?php
		            				endforeach;
		            			?>
		            		</tbody>
		            	</table>
					
		            </div>
		          </div>
		       </div>
		     </div>
		   </div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
						
						
						<div id="_rating" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('benchmark_rating');?></label>
							<div class="col-xs-8" id="">
								<!--<select class="form-control must benchmark_rating" name="score" id="score" required="required">
									<option value=""><?=get_phrase('select');?></option>
									<option value="0"><?=get_phrase('low');?></option>
									<option value="1"><?=get_phrase('high');?></option>
								</select>-->
								<input type="text" id="score_label" class="form-control must" required="required" readonly="readonly" value="Low"/>
								<input type="hidden" name="score" id="score" class="form-control must benchmark_rating" required="required" value="0"/>
							</div>
						</div>
						
						<div id="_comment" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('comments');?></label>
							<div class="col-xs-8">
								<textarea rows="15" class="form-control must" id="comment" name="comment" required="required" placeholder="Please provide your comment and action plan here"></textarea>

							</div>
						</div>
						
						<div id="_submit" class="form-group">
							<button class="btn btn-success btn-icon" id="assess"><i class="fa fa-plus-square"></i><?=get_phrase('mark_assessed');?></button>
							
							<a href="<?=base_url();?>competency.php/facilitator/assessment" class="btn btn-info btn-icon"><i class="fa fa-arrow-left"></i><?=get_phrase('back');?></a>
						</div>
						
						</form>
		</div>
	</div>
		            	
<script>

$('#assess').on('click',function(){
	var empty=0;
	$('.must').each(function(){
		if($(this).val()===""){
			empty++;
			$(this).css('border','1px red solid');
		}
	});
	
	if(empty>0){
		alert('Kindly provide report and benchmark rating and comment');
		return false;
	}
});

$('.report_rating').change(function(){
	//alert($(this).val());
	var sum_rating = 0;
	var count_reports = $('.report_rating').length;	
	var avg = 0;
	var score = 0;
	
	$('.report_rating').each(function(){
		if($(this).val()!==""){
			sum_rating = parseInt($(this).val())+parseInt(sum_rating)
			avg = parseInt(sum_rating)/parseInt(count_reports);
			
			if(avg>0.8){
				score = 1;
			}
		}
	});
	
	$('#score').val(score);
	if(score === 1){
		$('#score_label').val('High');
	}else{
		$('#score_label').val('Low');
	}
	
});
	
</script>
