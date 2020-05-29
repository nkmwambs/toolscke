<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('view_comments');?></div>						
				</div>
										
				<div class="panel-body">

					<?php echo form_open(base_url() . 'claims.php/health/mass_commenting/'.$param2 , array('id'=>'frm_commenting','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>		
						
						<div class="form-group">
								<label class="control-label col-sm-12 pull-left"><?php echo get_phrase('comment');?></label>
								<div class="col-sm-12">
									<!--<input type="text" class="form-control" name="proNo" id="proNo" readonly="readonly" value="<?=$center;?>"/>-->
									<textarea class="form-control" name="" id="rson" cols="10" rows="10" placeholder="Enter comment here ..."></textarea>
								</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-warning btn-icon" id="submit"><i class="fa fa-times-rectangle"></i><?=get_phrase('add_comment');?></button>
							</div>
						</div>	
					
					</form>
					
				</div>
				
			</div>
	</div>
</div>		



<script>
	$('#submit').click(function(ev){
		var url = $("#frm_commenting").attr('action');
		
		var postData;
		
		postData = new FormData();
    	
    	var cnt = 0;
    	
    	$('.chkbox').each(function(){
    		if($(this).is(':checked')){
    			postData.append( 'claim[]', $(this).attr('id'));
    			cnt++;
    		}
    	});
		
		postData.append( 'rson', $("#rson").val());
		
		if(cnt=== 0){
			
			BootstrapDialog.show({
				title:"<?=get_phrase('alert');?>",
				message:"<?=get_phrase("no_claim_selected");?>"
			});
			
			return false;
		}
			
		$.ajax({
			url:url,
			type:"POST",
			data:postData,
			processData: false,
			contentType: false,
			success:function(response){
				BootstrapDialog.show({
						title:"<?=get_phrase('information');?>",
						message:response
				});
				
				//$('#modal').modal(toggle);
				location.reload();
			},
			error:function(error){
				
			}
		});
		
		ev.preventDefault();
	});
</script>