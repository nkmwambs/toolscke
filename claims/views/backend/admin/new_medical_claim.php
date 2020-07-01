<?php
//echo base_url();
?>

<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('new_claim');?></div>						
				</div>
										
				<div class="panel-body">
					
					
		
					<?php echo form_open(base_url() . 'claims.php/medical/medical_claims/add/' , array('id'=>'frm_medical_claim','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
					
					
					<div class="col-sm-6">
					
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('ke_no');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="proNo" id="proNo" readonly="readonly" value="<?=$center;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('cluster');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="cluster" id="cluster" readonly="readonly" value="<?=$cluster;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('connect_incident_id');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="connect_incident_id" id="connect_incident_id" value=""/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('child_no');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="childNo" id="childNo" value=""/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('child_name');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="childName" id="childName" readonly="readonly"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('incident_type');?></label>
								<div class="col-sm-8">
									<select class="form-control" name="incident_type" id="incident_type" onchange="get_incident_category(this);">
										<option value=""><?php echo get_phrase('select');?></option>
										<option value="illness"><?php echo get_phrase('illness');?></option>
										<option value="injury"><?php echo get_phrase('injury');?></option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('incident_category');?></label>
								<div class="col-sm-8">
									<!--<input type="text" class="form-control" name="diagnosis" id="diagnosis"/>-->
									<select class="form-control" name="incident_sub_category_id" id="incident_sub_category_id" readonly="readonly" onchange="get_incident_sub_category(this);">
										<option value=""><?php echo get_phrase('select');?></option>
										
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('incident');?></label>
								<div class="col-sm-8">
									<!--<input type="text" class="form-control" name="diagnosis" id="diagnosis"/>-->
									<select class="form-control" name="illness_id" id="illness_id" readonly="readonly">
										<option value=""><?php echo get_phrase('select');?></option>
										
									</select>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('comments');?></label>
								<div class="col-sm-8">
									<textarea class="form-control" name="diagnosis" id="diagnosis" placeholder="Enter Comments Here!"></textarea>
								</div>
							</div>
		
					
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('treatment_date');?></label>
								<div class="col-sm-8">
									<input type="text" class="datepicker form-control" readonly="readonly" name="treatDate" id="treatDate" data-format="yyyy-mm-dd" data-end-date="0d" data-start-date="-30d"/>
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('voucher_number');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="vnum" id="vnum"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('total_amount');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="totAmt" id="totAmt" value=""/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('N.H.I.F');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nhif" id="nhif" value="0"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('caregiver_contribution');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="careContr" id="careContr" readonly="readonly" value="0"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('amount_reimbursable');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="amtReim" id="amtReim" readonly="readonly" value="0"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('facility_name');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="facName" id="facName" value=""/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('facility_type');?></label>
								<div class="col-sm-8">
									<select class="form-control" id="facClass" name="facClass">
										<option value=""><?php echo get_phrase('select');?></option>
										<option value="public"><?=get_phrase("public");?></option>
										<option value="missionary"><?=get_phrase("missionary");?></option>
										<option value="private"><?=get_phrase("private");?></option>
									</select>
								</div>
							</div>
					</div>
					
					
					<div class="col-sm-12"><hr/>
							
							<div class="form-group">
								<div class="col-sm-4">
									<button type="submit" id="submit" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i><?php echo get_phrase('create');?></button>
								</div>
								<div class="col-sm-4">
									<button id="reset" class="btn btn-danger btn-icon"><i class="fa fa-minus"></i><?php echo get_phrase('reset');?></button>
								</div>
		
							</div>				
					</div>
					
					</form>
					
					
					
				</div>
			</div>		
	</div>
</div>
<script>
	
	function get_incident_category(el){
		
		$('#incident_sub_category_id').find('option').remove();
		
		$('#incident_sub_category_id').removeAttr('readonly');
		
		var url = "<?php echo base_url();?>claims.php/medical/get_incident_sub_category/"+$(el).val();
		$.ajax({
			url:url,
			success:function(data){
				$('#incident_sub_category_id').append(data);
			}
		});
	}
	
	function get_incident_sub_category(el){
		$('#illness_id').find('option').remove();
		
		$('#illness_id').removeAttr('readonly');
		
		if($('#incident_sub_category_id').val()===""){
			alert('Please select an incident category');
			$('#illness_id').attr('readonly','readonly');
		}else{
		
			var url = "<?php echo base_url();?>claims.php/medical/get_incident/"+$('#incident_sub_category_id').val();
			$.ajax({
				url:url,
				success:function(data){
					$('#illness_id').append(data);
				}
			});
			
		}
	}
	
	$('#connect_incident_id').change(function(){
		var str = "I-";
		var input = $(this).val();
		$(this).val(str+input);
	});
	
	$('#connect_incident_id').focus(function(){
		$(this).val("");
	});
	
	$("#childNo").change(function(){
		var prefix = $("#proNo").val();
		var childid = $(this).val();
		
		if(childid.length===1){
			childid = "0000"+childid;
		}else if(childid.length===2){
			childid = "000"+childid;
		}else if(childid.length===3){
			childid = "00"+childid;
		}else if(childid.length===4){
			childid = "0"+childid;
		}
		
		$(this).val(prefix+childid);	
		
		var url = "<?php echo base_url();?>claims.php/claims/get_child_name/"+$("#childNo").val();
		$.ajax({
			url:url,
			success:function(data, textStatus, jqXHR){
				$("#childName").val($.trim(data));
			},
			error:function(error){
				alert("<?php echo get_phrase('error_occurred');?>");
				$("#childName").val("<?php echo get_phrase('name_not_found');?>");
			}
			
		});	
	});
	
	$('#childNo').focus(function(){
		$(this).val("");
	});
	
	$("#vnum").change(function(){
		if($(this).val().length<6){
			alert("<?php echo get_phrase('incorrect_string_length');?>");
			$(this).val("");
			$(this).focus();
		}else if(!$.isNumeric($(this).val())){
			alert("<?php echo get_phrase('numeric_only');?>");
			$(this).val("");
			$(this).focus();
		}
	});
	

	$("#totAmt").change(function(){	
		
		if($(this).val()<1100){
			alert("<?php echo get_phrase('wrong_limit');?>");
			$(this).val("");
			$(this).focus();
		}else if(!$.isNumeric($(this).val())){
			alert("<?php echo get_phrase('numeric_only');?>");
			$(this).val("");
			$(this).focus();
		}
	});
	
	function require_numeric(id){
		if(!$.isNumeric($("#"+id).val())){
			alert("<?php echo get_phrase('numeric_only');?>");
			$("#"+id).val("");
			$("#"+id).focus();
		}
	}
	
	$("#nhif").change(function(){
		require_numeric("nhif");
	});

	$("#nhif,#totAmt").change(function(){
		var nhif = $("#nhif").val();
		var totAmt = $("#totAmt").val();
		var careContr = 0;
		var amtReim = totAmt;
		
		if(nhif.length<2 && totAmt.length>0){
			careContr = 0.1*totAmt;
			amtReim =  totAmt - careContr;
			
		}
		
		$("#careContr").val(careContr);
		$("#amtReim").val(amtReim);
		
	});
	
	$("#submit").click(function(ev){
		var cnt = 0;
		
		$('input,select').each(function(){
			
			if($(this).val()===""){
				//alert('One or more input is empty!');
				cnt++;	
				
				$(this).css('border','1px solid red');
				
				
			}else{
				$(this).css('border','');
			}
			
		});
		
		
		if(cnt>0){
			alert(cnt+' fields are empty!');
			
			ev.preventDefault();
		}
	});
	
	$("#reset").click(function(ev){
		ev.preventDefault();
	});
	
</script>