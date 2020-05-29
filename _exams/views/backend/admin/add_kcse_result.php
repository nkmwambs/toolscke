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
                    	<ul class="nav nav-pills">
												
						<li>
							<a id="resetBtn" class="btn btn-default">
								<?=get_phrase('reset');?>
							</a>	
						</li>
						
						<li>
							<a id="" onclick="go_back();" href="#" class="btn btn-default">
								<?=get_phrase('back');?>
							</a>	
						</li>
						
					</ul>	
					
					<hr />
					
					<?php echo form_open(base_url().'exams.php/partner/create_kcse_result', array('id' => 'frm_create_kcse_result', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
						
						<div class="row">
							<div class="col-sm-6" style="border-right: 1px solid black;">
								<?php echo $build_bio_form;?>
							</div>
							
							
						
							<div class="col-sm-6">
								<?php echo $build_spread_form;?>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-12">
								<button id="btnCreate" class="btn btn-default">Create</button>
							</div>
						</div>
					</form>	
                    </div>
                </div>
            </div>
       </div>             

<script>
	
	
	$("#btnCreate").on('click',function(ev){
		
		var cnt = 0;
		$("input,select").each(function(){
			if($(this).val() == ""){
				$(this).css('border','1px red solid');
				cnt++;	
			}
		});
		
		if(cnt>0){
			alert(cnt+" fields are empty");
			return false;
		}
		
		var url = $("#frm_create_kcse_result").attr('action');
		var data = $("#frm_create_kcse_result").serializeArray();
		
		$.ajax({
			url:url,
			data:data,
			type:"POST",
			beforeSend:function(){
				//$("#overlay").css("display",'block');
			},
			success:function(resp){
				alert(resp);
				//$("#overlay").css("display",'none');
				//remove_all_rows("tbl_subjects");
				//go_back();
			},
			error:function(){
				alert('Error Occurred');
			}
		});
		
		ev.preventDefault();
	});
	
	$("#childNo").on('click',function(){
		$(this).val(null);
		$("#childName").val(null);
		$("#sex").val(null);
		$("dob").val(null);
	});
	
	$("#childNo").change(function(){
		
		$("input,select").each(function(){
			//if($(this).val() == ""){
				$(this).removeAttr('style');
			//}
		});
		
		
		var prefix = $("#pNo").val();
		var childid = $(this).val();
		$('#childName').css('border','1px gray solid');
		if(childid.length===1){
			childid = "-000"+childid;
		}else if(childid.length===2){
			childid = "-00"+childid;
		}else if(childid.length===3){
			childid = "-0"+childid;
		}else if(childid.length===4){
			childid = "-"+childid; 
		}
		$(this).prop('type','text');
		$(this).val(prefix+childid);	
		
		var url = "<?php echo base_url();?>exams.php/partner/get_childNo/"+$("#childNo").val();
		$.ajax({
			url:url,
			beforeSend:function(){
					//jQuery('#progress').html('<div style="text-align:center;"><img width="160" height="100" src="<?php echo base_url();?>uploads/preloader2.gif" /></div>');
			},
			success:function(data, textStatus, jqXHR){
				//alert(data);
				var obj = JSON.parse(data);
				$("#childName").val(obj.childName);
				$("#sex").val(obj.sex);
				$("#dob").val(obj.dob);
				//jQuery('#progress').html('');
			},
			error:function(error){
				alert("<?php echo get_phrase('error_occurred');?>");
				$("#childName").val("<?php echo get_phrase('name_not_found');?>");
				//jQuery('#progress').html('');
			}
			
		});	
	});	
</script>