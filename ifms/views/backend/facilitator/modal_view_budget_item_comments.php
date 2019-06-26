<?php
//echo $param2;
?>
<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('view_comments');?></div>						
				</div>
										
				<div class="panel-body">

					<?php echo form_open(base_url() . 'ifms.php/facilitator/add_budget_item_comments/'.$param2 ."/".$param3.'/'.$param4 , array('id'=>'frm_medical_claim','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
						
						<div class="form-group">
							<div class="col-sm-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th><?=get_phrase('from');?></th>
											<th><?=get_phrase('comment');?></th>
											<th><?=get_phrase('time_stamp');?></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$comments = $this->db->get_where("detail",array('recid'=>$param4,"app_name"=>$this->session->app_name))->result_object();
											
											foreach($comments as $rows):
										?>
										<tr>
											<td>
												<?php
													echo $this->db->get_where("users",array('ID'=>$rows->userid))->row()->username;
												?>
											</td>
											<td>
												<?php
													echo $rows->rson;
												?>
											</td>
											<td>
												<?php
													echo $rows->stamp;
												?>
											</td>
										</tr>
										<?php
											endforeach;
										?>
									</tbody>
								</table>
							</div>
						</div>		
						
						<div class="form-group">
								<label class="control-label col-sm-12 pull-left"><?php echo get_phrase('comment');?></label>
								<div class="col-sm-12">
									<!--<input type="text" class="form-control" name="proNo" id="proNo" readonly="readonly" value="<?=$center;?>"/>-->
									<textarea class="form-control" name="rson" id="rson" cols="10" rows="10" placeholder="Enter comment here ..."></textarea>
								</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-warning btn-icon"><i class="fa fa-times-rectangle"></i><?=get_phrase('add_comment');?></button>
							</div>
						</div>	
					
					</form>
					
				</div>
				
			</div>
	</div>
</div>		