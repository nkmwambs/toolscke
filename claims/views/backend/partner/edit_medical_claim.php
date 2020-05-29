<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('edit_claim');?></div>						
				</div>
										
				<div class="panel-body">
					
					<div class="col-sm-12" id="progress"></div>
		
					<?php echo form_open(base_url() . 'claims.php/partner/medical_claims/edit/'.$claim->rec , array('id'=>'frm_medical_claim','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
					
					
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
								<label class="control-label col-sm-4"><?php echo get_phrase('incidentID');?></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="incidentID" id="incidentID" value="<?=$claim->incidentID;?>"/>
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
								<label class="control-label col-sm-4"><?php echo get_phrase('diagnosis');?></label>
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
									<input type="text" readonly="readonly" class="form-control" name="vnum" id="vnum" value="<?=$claim->vnum;?>"/>
								</div>
							</div>
							
							<input type="hidden" class="form-control"  id="totAmtSaved" value="<?=$claim->totAmt;?>"/>
							
							<input type="hidden" class="form-control"  id="careContrSaved" value="<?=$claim->careContr;?>"/>
							
							<input type="hidden" class="form-control"  id="amtReimSaved" value="<?=$claim->amtReim;?>"/>
							
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
										<option value="public" <?php if($claim->facClass==='Public') echo "selected";?>><?=get_phrase("public");?></option>
										<option value="missionary" <?php if($claim->facClass==='Missionary') echo "selected";?>><?=get_phrase("missionary");?></option>
										<option value="private" <?php if($claim->facClass==='Private') echo "selected";?>><?=get_phrase("private");?></option>
									</select>
								</div>
							</div>
					</div>
					
					
					<div class="col-sm-12"><hr/>
							
							<div class="form-group">
								<div class="col-sm-4">
									<button type="submit" disabled="disabled" id="submit" class="btn btn-primary btn-icon"><i class="fa fa-pencil"></i><?php echo get_phrase('edit');?></button>
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

<?php
//$amount_claimed = $this->db->select_sum('totAmt')->get_where('claims',array('vnum'=>'180201','proNo'=>$this->session->center_id))->row()->totAmt; 
//$total_in_voucher = $this->db->select_sum('Cost')->get_where('voucher_body',array('VNumber'=>'180201','AccNo'=>'1320','icpNo'=>$this->session->center_id))->row()->Cost;	
											
//echo $total_in_voucher." - ".$amount_claimed;
?>
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
	
	$('#incidentID').change(function(){
		var str = "I-";
		var input = $(this).val();
		$(this).val(str+input);
	});
	
	$('#incidentID').focus(function(){
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
	

$("#totAmt,#incidentID,#diagnosis,#nhif,#facName,#facClass").change(function(){	
		
		if($("#totAmt").val()<1100){
			alert("<?php echo get_phrase('wrong_limit');?>");
			$("#totAmt").val("");
			$("#totAmt").focus();
		}else if(!$.isNumeric($("#totAmt").val())){
			alert("<?php echo get_phrase('numeric_only');?>");
			$("#totAmt").val("");
			$("#totAmt").focus();
		}else{
			var vnum = $('#vnum').val();
			//alert(vnum);
			var url = "<?=base_url();?>claims.php/partner/get_claimed_amount/"+vnum;
			$.ajax({
				url:url,
				beforeSend:function(){
					$("#submit").prop("disabled","disabled");
					jQuery('#progress').html('<div style="text-align:center;"><img width="160" height="100" src="<?php echo base_url();?>uploads/preloader2.gif" /></div>');
				},
				success:function(data){ //alert(data);
					jQuery('#progress').html('');
					
					var original_totAmt = $('#totAmtSaved').val();
					var original_careContr = $('#careContrSaved').val();
					var original_amtReim = $('#amtReimSaved').val();
					
					var dif = (parseInt(data) + parseInt(original_amtReim))-parseInt($("#amtReim").val());
					if(dif < 0){
						alert("You have exceeded the voucher amount by <?=get_phrase('Kes.');?> "+ Math.abs(dif));
						$("#totAmt").val(original_totAmt);
						$("#careContr").val(original_careContr);
						$("#amtReim").val(original_amtReim);
						$("#totAmt").css("border","1px red solid");
						$("#submit").prop("disabled","disabled");
					}else{
						$("#totAmt").css("border","1px gray solid");
						$("#submit").removeAttr("disabled");
					}
				}
			});
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