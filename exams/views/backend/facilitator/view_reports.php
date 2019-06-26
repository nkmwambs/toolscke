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
		            	<table class="table table-striped">
		            		<thead>
		            			<tr>
		            				<th><?=get_phrase('name');?></th>
		            				<th><?=get_phrase('description');?></th>
		            			</tr>
		            		</thead>
		            		<tbody>
		            			<?php
		            				$reports = $this->db->get_where('report',array('benchmark_id'=>$benchmark_id))->result_object();
		            				foreach($reports as $row):
		            			?>
		            				<tr>
		            					<td><a target="__blank" href="<?=$row->url;?>"><?=$row->name;?></a></td>
		            					<td><?=$row->description;?></td>
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
						<?php 
						
							echo form_open(base_url() . 'competency.php/facilitator/mark_assessed/'.$benchmark_id.'/'.$tym, array('id'=>'frm_assess','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
						?>
						
						<div id="_rating" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('rating');?></label>
							<div class="col-xs-8">
								<select class="form-control" name="score" id="score" required="required">
									<option value=""><?=get_phrase('select');?></option>
									<option value="0"><?=get_phrase('low');?></option>
									<option value="1"><?=get_phrase('high');?></option>
								</select>
							</div>
						</div>
						
						<div id="_comment" class="form-group">
							<label for="" class="col-xs-4 control-label"><?php echo get_phrase('comments');?></label>
							<div class="col-xs-8">
								<textarea rows="15" class="form-control" id="comment" name="comment" required="required">
									
								</textarea>

							</div>
						</div>
						
						<div id="_submit" class="form-group">
							<button class="btn btn-success btn-icon"><i class="fa fa-plus-square"></i><?=get_phrase('mark_assessed');?></button>
							
							<a href="<?=base_url();?>competency.php/facilitator/assessment" class="btn btn-info btn-icon"><i class="fa fa-arrow-left"></i><?=get_phrase('back');?></a>
						</div>
						
						</form>
		</div>
	</div>
		            	
