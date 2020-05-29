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
							<a id="btnBack" onclick="go_back();" href="#" class="btn btn-default">
								<?=get_phrase('back');?>
							</a>	
						</li>
						
					</ul>	
					
					<hr />
					
					<?php echo form_open(base_url().'exams.php/partner/post_edit_kcse_result/'.$result_id, array('id' => 'frm_edit_kcse_result', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
						
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
								<button id="btnCreate" class="btn btn-default">Save</button>
							</div>
						</div>
					</form>	
                    </div>
                </div>
            </div>
       </div>             

<script>
		$("#btnCreate").on("click",function(ev){
						
						var url = $("#frm_edit_kcse_result").attr("action");
						var data = $("#frm_edit_kcse_result").serializeArray();
						
						$.ajax({
							url:url,
							data:data,
							type:"POST",
							beforeSend:function(){
								$("#overlay").css("display","block");
							},
							success:function(resp){
								alert(resp);
								$("#overlay").css("display","none");
								go_back();
							},
							error:function(){
								alert("Error Occurred");
							}
						});
						
						ev.preventDefault();
					});
</script>

<script>
	$(document).ready(function(){
		$(".btn").not("#btnBack").hide();
		
		$("#tbl_multi_column tbody tr").find("td:eq(0)").remove();
		$("#tbl_multi_column thead tr").find("th:eq(0)").remove();
		
		$("input[type=text]").each(function(){
			var value = $(this).val();
			var parent = $(this).parent();
			
			$(this).remove();
			parent.html(value);
		});
		
		$("select").each(function(){
			
			//Remove select string in the first option
			$(this).find("option:eq(0)").html("Data Missing");
			
			var value = $(this).find("option:selected").html();
			var parent = $(this).parent();
			
			$(this).remove();
			parent.html(value);
		});
		
	});
</script>