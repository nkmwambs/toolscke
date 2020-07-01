<?php
//echo $scheduleID;
?>
<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('decline_comment');?></div>						
				</div>
										
				<div class="panel-body">
					<?php echo form_open(base_url() . 'ifms.php/facilitator/action_comment/'.$scheduleID, array('id'=>'frm_comment_budget','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
						
						<div class="form-group">
							<div class="col-sm-12">
								<table id="tbl_comments" class="table table-bordered">
									<thead>
										<tr>
											<th><?=get_phrase('from');?></th>
											<th><?=get_phrase('comment');?></th>
											<th><?=get_phrase('time_stamp');?></th>
										</tr>
									</thead>
									<tbody id="comment_body">
										<?php
											$comments = $this->db->get_where("detail",array('recid'=>$scheduleID,"app_name"=>$this->session->app_name))->result_object();
											
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
								<button id="com" class="action-btn btn btn-info btn-icon"><i class="fa fa-plus-square"></i><?=get_phrase('post');?></button>
								<!--<button id="rev" class="action-btn btn btn-info btn-icon"><i class="fa fa-refresh"></i><?=get_phrase('allow_review');?></button>
								<button id="can" class="action-btn btn btn-danger btn-icon"><i class="fa fa-trash-o"></i><?=get_phrase('unacceptable');?></button>-->
							</div>
						</div>	
					
					</form>
				</div>
			</div>
	</div>
</div>				

<script>
	$('.action-btn').click(function(ev){
		
		var data = $('#frm_comment_budget').serializeArray();
		var url = $('#frm_comment_budget').attr('action')+'/'+$(this).attr('id');
		
		$.ajax({
			url:url,
			data:data,
			method:'POST',
			success:function(resp){
				var obj = JSON.parse(resp);
				var msg = obj.msg;
				var view = obj.view
				
				alert(msg);
				
				$('#rson').val("");
				$('#comment_body').html(view);
				
			},
			error:function(){
				
			}
		});
		
		ev.preventDefault();
	});
</script>	