<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('new_claim');?></div>						
				</div>
										
				<div class="panel-body">
					
					
		
					<?php echo form_open(base_url() . 'claims.php/medical/medical_claims/edit/'.$claim->rec , array('id'=>'frm_medical_claim','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
					
					
					<div class="col-sm-6">
					
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('ke_no');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="proNo" id="proNo" readonly="readonly" value="<?=$claim->proNo;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('cluster');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="cluster" id="cluster" readonly="readonly" value="<?=$claim->cluster;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('connect_incident_id');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="connect_incident_id" id="connect_incident_id" value="<?=$claim->connect_incident_id;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('child_no');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="childNo" id="" value="<?=$claim->childNo;?>" readonly="readonly"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('child_name');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="childName" id="childName" readonly="readonly" value="<?=$claim->childName;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('incident_type');?></label>
								<div class="col-sm-8">
									<select class="form-control" name="incident_type" id="incident_type" onchange="get_incident_category(this);">
										<option value=""><?php echo get_phrase('select');?></option>
										<option value="illness" <?php if($claim->incident_type==='illness') echo 'selected';?>><?php echo get_phrase('illness');?></option>
										<option value="injury" <?php if($claim->incident_type==='injury') echo 'selected';?>><?php echo get_phrase('injury');?></option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('incident_category');?></label>
								<div class="col-sm-8">
									<?php
										$types = $this->db->get_where('illness_sub_category',array('type'=>$claim->incident_type))->result_object();
		
										$opt = "";
										
										$sel = "";
										
										foreach($types as $type):
							
											if($type->illness_sub_category_id===$claim->incident_sub_category_id){
												$sel = "selected";
											}
											$opt .="<option value='".$type->illness_sub_category_id."' ".$sel.">".$type->name."</option>";
										endforeach;	

									?>
									<select class="form-control" name="incident_sub_category_id" id="incident_sub_category_id" readonly="readonly" onchange="get_incident_sub_category(this);">
										<option value=""><?php echo get_phrase('select');?></option>
										<?php echo $opt;?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('incident');?></label>
								<div class="col-sm-8">
									<?php
											$ty = $this->db->get_where('illness',array('illness_id'=>$claim->illness_id))->result_object();
											
											$sl = "";
											
											$op ="";
											
											foreach($ty as $type):
												if($type->illness_id === $claim->illness_id){
													$sl = "selected";
												}
												$op .="<option value='".$type->illness_id."' ".$sl.">".ucfirst($type->illness_name)."</option>";
											endforeach;	
											

									?>
									<select class="form-control" name="illness_id" id="illness_id" readonly="readonly">
										<option value=""><?php echo get_phrase('select');?></option>
										<?php echo $op;?>
									</select>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('comments');?></label>
								<div class="col-sm-8">
									<textarea class="form-control" name="diagnosis" id="diagnosis" placeholder="Enter Comments Here!"><?php echo $claim->diagnosis;?></textarea>
								</div>
							</div>
							
		
					
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('treatment_date');?></label>
								<div class="col-sm-8">
									<input type="text" class="datepicker form-control" readonly="readonly" name="treatDate" id="treatDate" data-format="yyyy-mm-dd" data-end-date="0d" data-start-date="-90d" value="<?=$claim->treatDate;?>"/>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('voucher_number');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="vnum" id="vnum" value="<?=$claim->vnum;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('total_amount');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="totAmt" id="totAmt" value="<?=$claim->totAmt;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('N.H.I.F');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nhif" id="nhif" value="<?=$claim->nhif;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('caregiver_contribution');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="careContr" id="careContr" readonly="readonly" value="<?=$claim->careContr;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('amount_reimbursable');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="amtReim" id="amtReim" readonly="readonly" value="<?=$claim->amtReim;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('facility_name');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="facName" id="facName" value="<?=$claim->facName;?>"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-4"><?php echo get_phrase('facility_type');?></label>
								<div class="col-sm-8">
									<select class="form-control" id="facClass" name="facClass">
										<option value=""><?php echo get_phrase('select');?></option>
										<option value="public" <?php if($claim->facClass==='public') echo "selected";?>><?=get_phrase("public");?></option>
										<option value="missionary" <?php if($claim->facClass==='missionary') echo "selected";?>><?=get_phrase("missionary");?></option>
										<option value="private" <?php if($claim->facClass==='private') echo "selected";?>><?=get_phrase("private");?></option>
									</select>
								</div>
							</div>
					</div>
					
					
					<div class="col-sm-12"><hr/>
							
							<div class="form-group">
								<div class="col-sm-4">
									<button type="submit" id="submit" class="btn btn-primary btn-icon"><i class="fa fa-pencil"></i><?php echo get_phrase('edit');?></button>
								</div>
								<div class="col-sm-4">
									<a href="<?php echo base_url();?>claims.php/medical/medical_claims" class="btn btn-danger btn-icon"><i class="fa fa-minus"></i><?php echo get_phrase('cancel');?></a>
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
		
		var url = "<?php echo base_url();?>claims/get_child_name/"+$("#childNo").val();
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
		//$("#frm_medical_claim").submit();
		//ev.preventDefault();
	});
	
	$("#reset").click(function(ev){
		ev.preventDefault();
	});
	
</script>