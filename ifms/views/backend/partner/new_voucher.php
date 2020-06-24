<hr />
<?php

?>
<div id="load_voucher">

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label col-sm-3">Search a Voucher</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="VNumber" placeholder="Enter a voucher number" />
				</div>
				<div class="col-sm-2">
					<div id="go_btn" class="btn btn-primary">Go</div>
				</div>
			</div>
		</div>
	</div>

	<hr />

	<div class="row">
		<div class="col-sm-12">

			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title">
						<i class="entypo-plus-circled"></i>
						<?php echo get_phrase('payment_voucher'); ?>
					</div>
				</div>
				<div class="panel-body" style="max-width:50; overflow: auto;">

					<div class="row">
						<div class="col-sm-12">
							<a href="#" id="resetBtn" class="btn btn-default btn-icon icon-left hidden-print pull-left">
								<?php echo get_phrase('reset'); ?>
								<i class="entypo-plus-circled"></i>
							</a>

							<button type="submit" id="btnPostVch" class="btn btn-default btn-icon icon-left hidden-print pull-left">
								<?php echo get_phrase('post'); ?>
								<i class="entypo-thumbs-up"></i>
							</button>


							<div style="display: none" id='btnDelRow' class="btn btn-default btn-icon icon-left hidden-print pull-left">
								<?php echo get_phrase('remove_item_row'); ?>
								<i class="entypo-minus-circled"></i>
							</div>

							<div id='addrow' class="btn btn-default btn-icon icon-left hidden-print pull-left">
								<?php echo get_phrase('new_item_row'); ?>
								<i class="entypo-plus-circled"></i>
							</div>

						</div>

					</div>

					<?php echo form_open("", array('id' => 'frm_voucher', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" value="<?php echo $this->session->userdata('center_id'); ?>" id="KENo" name="KENo" />

							<table id='tblVch' class='table'>
								<thead>
									<tr>
										<th colspan="8" style="text-align: center;"><?php echo $this->session->userdata('center_id'); ?><br><?php echo get_phrase('payment_voucher'); ?></th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td id="error_msg" style="color:red;text-align: center;">
											<?php
											if (isset($msg)) echo $msg;
											?>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<div class="form-group">
												<label class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('date'); ?>: </span></label>

												<div class="input-group">
													<input type="text" name="TDate" id="TDate" class="form-control datepicker accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" data-format="yyyy-mm-dd" data-start-date="" data-end-date="" readonly="readonly">

													<div class="input-group-addon">
														<a href="#"><i class="entypo-calendar"></i></a>
													</div>
												</div>

											</div>
										</td>
										<td colspan="2">&nbsp;</td>
										<td colspan="3">
											<div class="form-group">
												<label for='VNumber' class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('voucher_number'); ?></span></label>
												<input type="text" class="form-control accNos" id="Generated_VNumber" name="VNumber" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $this->finance_model->next_voucher($this->session->userdata('center_id'))->vnum; ?>" readonly />
											</div>
										</td>

									</tr>
									<tr>
										<td colspan="8">
											<div class="form-group">
												<label for="Payee" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('payee_/_vendor'); ?>: </span></label>
												<input type="text" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" id="Payee" name="Payee" />
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="8">
											<div class="form-group">
												<label for="Address" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('address'); ?>: </span></label>
												<input type="text" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" id="Address" name="Address" />
											</div>
										</td>
									</tr>
									<tr>

										<td colspan="4">
											<div class="col-sm-10 form-group hidden" id='VType'>
												<label for="VTypeMain" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('voucher_type'); ?>:</span></label>
												<select name="VTypeMain" id="VTypeMain" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
													<option value="#"><?php echo get_phrase('select_voucher_type'); ?></option>
													<?php foreach($voucher_types as $voucher_type){?>
														<option value="<?=$voucher_type['voucher_type_abbrev'];?>"><?php echo get_phrase($voucher_type['voucher_type_name']); ?></option>
													<?php }?>
												</select>
											</div>
										</td>
										
										<!-- <td colspan="2">
										<div class="col-sm-10 form-group hidden" id='support_mode_main'>
												<label for="support_mode" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('support_modes'); ?>:</span></label>
												<select name="support_mode" id="support_mode" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
													<option value="0"><?php echo get_phrase('select_support_mode'); ?></option>
												</select>
											</div>
										</td> -->

										<td colspan="2">
											<!-- CHEQUE Number -->
											<div class="col-sm-10 form-group hidden" id='ChqDiv'>
												<label for="ChqNo" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('cheque_number'); ?>:</span></label>
												<input class="form-control" type="text" id="ChqNo" name="ChqNo" data-validate="number,minlength[2]" readonly="readonly" />
											</div>

											<!-- MPESA REFERENCE NO -->
											<!-- <div class="col-sm-10 form-group hidden" id='DCT_div'>
												<label for="DCT" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('reference_no.'); ?>:</span></label>
												<input class="form-control" type="text" id="DCTReference" name="DCTReference" data-validate="required" value=""  />

											</div> -->
										</td>

										<td colspan="2">
											<div id="label-toggle-switch" for="reversal" class="col-sm-6 hidden"><span style="font-weight: bold;"><?php echo get_phrase('cheque_reversal'); ?></span>
												<div class="make-switch switch-small" data-on-label="Yes" data-off-label="No">
													<input type="checkbox" id="reversal" name="reversal" />
												</div>
											</div>

											<!-- Upload Files Area -->

											<!-- <div id="myDropzone" class="dropzone hidden">
												<div class="dropzone-previews"></div>
												<div class="fallback">
													<input name="fileToUpload" type="file" multiple />
												</div>
											</div> -->

											<!-- Upload Files Area -->
											<!-- <div id="uploads_dct_support_docs" for="fileupload" class="col-sm-6 hidden"><span style="font-weight: bold;"><?php echo get_phrase('support_documents'); ?></span>
												<div class="">
													<input type="file" class="form-control file2 inline btn btn-primary" multiple="1" name="fileToUpload" id="fileToUpload" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Upload Files" />
													
												</div>


											</div> -->




										</td>

									</tr>

									<tr>

										<td colspan="8">
											<div class="form-group">
												<label for="TDescription" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('description'); ?></span></label>
												<input type="text" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" id="TDescription" name="TDescription" />
											</div>

										</td>
									</tr>

								</tbody>
							</table>

						</div>
					</div>




					<div class="row">
						<div class="col-sm-12">
							<table id="bodyTable" class="table table-bordered">
								<thead>
									<tr style="font-weight: bold;">
										<th><?php echo get_phrase('delete_row'); ?></th>
										<th><?php echo get_phrase('quantity'); ?></th>
										<th><?php echo get_phrase('item_type'); ?></th>
										<th><?php echo get_phrase('items_purchased_/_services_received'); ?></th>
										<th><?php echo get_phrase('unit_cost'); ?></th>
										<th><?php echo get_phrase('cost'); ?></th>
										<th><?php echo get_phrase('account'); ?></th>
										<th><?php echo get_phrase('support_mode'); ?></th>
										<th><?php echo get_phrase('civ_code'); ?></th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>


					<div class="row">
						<div class="col-sm-12">
							<table id="" class="table">
								<tr>
									<td colspan="5">
										<div class="form-group pull-right">
											<label for='totals' class="control-label"><span style="font-weight: bold;">Totals:</span></label>
											<input class="form-control" type="text" id="totals" name="totals" readonly />
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<INPUT type="hidden" id="hidden" value="" />

				</div>
			</div>


		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-12">

					<div data-toogle="modal" data-target="" id="resetBtn" class="btn btn-default btn-icon icon-left hidden-print pull-left">
						<?php echo get_phrase('reset'); ?>
						<i class="entypo-plus-circled"></i>
					</div>


				</div>

			</div>
		</div>
	</div>
</div>
</div>

</div>

<script type="text/javascript">

	//Added by Onduso on 15/3/2020
	function post_using_ajax() {
		var frm = $("#frm_voucher");
		var postData = frm.serializeArray();
		var formURL = "<?= base_url() ?>ifms.php/partner/post_voucher/";
		//alert(formURL);
		$.ajax({
			url: formURL,
			type: "POST",
			data: postData,
			beforeSend: function() {
				$('#error_msg').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url(); ?>uploads/preloader4.gif" /></div>');
			},
			success: function(data, textStatus, jqXHR) {

				$('#load_voucher').html(data);

				//$('#voucher_count').html(parseInt($('#voucher_count').html())+1);

			},
			error: function(jqXHR, textStatus, errorThrown) {
				//if fails
				alert(textStatus);
			}
		});

	}

	function check_if_temp_session_is_empty() {
		// Check if temps session is not empty
		var url = "<?= base_url() ?>ifms.php?/partner/check_if_temp_session_is_empty";

		$.get(url, function(response) {
			//alert(response);
		});
	}

	$(document).ready(function() {

		Dropzone.autoDiscover = false;

		check_if_temp_session_is_empty();

		$('#TDate').change(function(e) {
			$('#VType').removeClass('hidden');
		});


		

		//Go button
		$("#go_btn").click(function() {
			var VNum = $("#VNumber").val();

			showAjaxModal('<?php echo base_url(); ?>ifms.php/modal/popup/modal_search_voucher/' + VNum);
		});


		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			startDate: '<?php echo $this->finance_model->next_voucher($this->session->userdata('center_id'))->current_voucher_date; ?>',
			endDate: '<?php echo $this->finance_model->next_voucher($this->session->userdata('center_id'))->end_month_date; ?>'
		});

		$('#DCTReference').keyup(function(e) {

			$(this).css({
				'border': '1px solid gray'
			});
			$('#error_msg').html('');

		});

		$('#btnPostVch,#btnPostVch_footer').click(function(e) {


			// added by onduso on 19/5/2020 start
			/** check if the reference number exists*/
			
			var reference_number = ($('#DCTReference') && $('#DCTReference').val() !== "")?$('#DCTReference').val():0;
			var voucher_number = $('#Generated_VNumber').val();
			//alert(reference_number);
			var val = $('#VTypeMain').val();

			//alert (val);

			if ($('#ChqNo').val() < 1 && $("#totals").val() !== "0.00 Kes." && val === 'CHQ' && $('#reversal').prop('checked') === false) {
				//alert("Here 1");
				$('#error_msg').html('<?php echo get_phrase('error:_invalid_cheque_number'); ?>');
				e.preventDefault();
			} else if ($("#bodyTable > tbody").children().length === 0) {
				//alert("Here 2");
				$('#error_msg').html('<?php echo get_phrase('error:_voucher_missing_details'); ?>');
				e.preventDefault();
			} else if ($('#hidden').val().length > 0 && $('#reversal').prop('checked') === false) {
				//alert($('#hidden').val());
				//alert("Here 3");
				$('#error_msg').html('<?php echo get_phrase("cheque_numbers_cannot_be_re-used_or_missing_bank_details"); ?>');
				e.preventDefault();
			} else if (myDropzone.files.length == 0 && (val == 'UDCTB' || val == 'UDCTC')) {

				$('#error_msg').html('<?php echo get_phrase("Upload supporting document"); ?>');
				$('#myDropzone').css({
					'border': '2px solid red'
				});
				e.preventDefault();
			} else if ($('.accNos').length > 0) {
				//alert("Here 4");
				var cnt_empty = 0;
				$('.accNos').each(function(i) {
					if ($(this).val().length === 0) {
						cnt_empty++;
					}
				});

				if (cnt_empty > 0) {
					$('#error_msg').html(cnt_empty + ' <?php echo get_phrase("empty_fields"); ?>');
					e.preventDefault();
				} else {
					//Added by Onduso on 20/5/ 2020 start
					/**Post Voucher only when no duplicate number exists */
					var url = "<?= base_url() ?>ifms.php/partner/is_reference_number_exist/" + reference_number + '/' + voucher_number;
					$.ajax({
						async: false,
						type: "GET",
						url: url,
						beforeSend: function() {
							$('#error_msg').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url(); ?>uploads/preloader4.gif" /></div>');
						},
						success: function(data) {
							/*
							1) if 1 returned: both Reference and voucher number exist

							2) if 2 returned:reference number exist

							3) if 3 returned: voucher number exist

							4) if 0 returned: No duplicate voucher and reference numbers exist
							
							*/
							//alert(data);
							if (data == 1) {
								$('#error_msg').html('<?php echo get_phrase('both_reference_and_voucher_numbers'); ?> ' + reference_number + 'and' + voucher_number + ' <?php echo get_phrase('already_exist'); ?>');
								$('#DCTReference').css({
									'border': '3px solid red'
								});
								return;
							} else if (data == 2 && (val=='UDCTB' ||val=='UDCTC')) {

								$('#error_msg').html('<?php echo get_phrase('reference_number'); ?> ' + reference_number + ' <?php echo get_phrase('already_exist'); ?>');
								$('#DCTReference').css({
									'border': '2px solid red'
								});
								return;

							} else if (data == 3) {

								$('#error_msg').html('<?php echo get_phrase('voucher_number'); ?> ' + voucher_number + ' <?php echo get_phrase('already_exist'); ?>');
								$('#Generated_VNumber').css({
									'border': '3px solid red'
								});
								return;

							}
							$('#error_msg').html('');

							post_using_ajax();

						}
					});
					//Added by Onduso on 20/5/ 2020 End
				}
			} else {
				//alert("Here 5");
				//Added by Onduso on 20/5/ 2020 start
				/**Post Voucher only when no duplicate number exists */
				var url = "<?= base_url() ?>ifms.php/partner/is_reference_number_exist/" + reference_number + '/' + voucher_number;
				$.ajax({
					async: false,
					type: "GET",
					url: url,
					beforeSend: function() {
						$('#error_msg').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url(); ?>uploads/preloader4.gif" /></div>');
					},
					success: function(data) {
						/*
							1) if data==1 returned: both Reference and voucher number exist

							2) if data==2 returned:reference number exist

							3) if data==3 returned: voucher number exist

							4) if data==0 returned: No duplicate voucher and reference numbers exist
							
							*/
						//alert(data);
						if (data == 1) {
							$('#error_msg').html('<?php echo get_phrase('both_reference_and_voucher_numbers'); ?> ' + reference_number + 'and' + voucher_number + ' <?php echo get_phrase('already_exist'); ?>');
							$('#DCTReference').css({
								'border': '3px solid red'
							});
							return;
						} else if (data == 2 && (val=='UDCTB' ||val=='UDCTC')){

							$('#error_msg').html('<?php echo get_phrase('reference_number'); ?> ' + reference_number + ' <?php echo get_phrase('already_exist'); ?>');
							$('#DCTReference').css({
								'border': '3px solid red'
							});
							return;

						} else if (data == 3) {

							$('#error_msg').html('<?php echo get_phrase('voucher_number'); ?> ' + voucher_number + ' <?php echo get_phrase('already_exist'); ?>');
							$('#Generated_VNumber').css({
								'border': '3px solid red'
							});
							return;

						}
						$('#error_msg').html('');

						post_using_ajax();

					}
				});
				//Added by Onduso on 20/5/ 2020 End


			}

			e.preventDefault(); //STOP default action
			e.unbind(); //unbind. to stop multiple form submit.
		});


		$("#resetBtn").click(function() {

			var formURL = "<?= base_url() ?>ifms.php/partner/reset_voucher/";
			$.ajax({
				url: formURL,

				beforeSend: function() {
					$('#error_msg').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url(); ?>uploads/preloader4.gif" /></div>');
				},
				success: function(data, textStatus, jqXHR) {

					//$('#modal_ajax').modal('toggle');
					$('#load_voucher').html(data);

					//added by onduso 5/13/20

					location.reload(true);

				},
				error: function(jqXHR, textStatus, errorThrown) {
					//if fails
					alert(textStatus);
				}
			});
		});

		$("#support_mode").on('change',function(){
			var support_mode_id = $(this).val() > 0 ? $(this).val() : 0;
			var url = "<?=base_url();?>ifms.php/partner/filter_accounts_by_support_mode/"+ support_mode_id +"/"+ $('#VTypeMain').val();
			
			$.get(url,function(response){
				//alert(response);
				//create_voucher_row(response);
				var accs = response.acc;
				var support_modes_is_dct = response.support_modes_is_dct;
				var options = "<option value='0'><?=get_phrase('select_account');?></option>";

				for (i = 0; i < accs.length; i++) {
							if (accs[i].AccTextCIVA !== null && accs[i].open === "1") {
								options += "<option value='"+accs[i].AccNo+"'>"+accs[i].AccNoCIVA+"</option>";
							}else{
								options += "<option value='"+accs[i].AccNo+"'>"+accs[i].AccText + ' - ' + accs[i].AccName+"</option>";
							}
					
				}

				$('.acSelect').html(options);

				if($("#support_mode").val() == 0){
					$('.voucher_item_type').prop('disabled','disabled');
				}else{
					$('.voucher_item_type').removeAttr('disabled');
				}

				if (support_modes_is_dct == 1) {

					$("#DCTReference").addClass('accNos');
					//$('#DCTReference').removeAttr('readonly');
					$('#myDropzone').removeClass('hidden');
					$('#DCT_div').removeClass('hidden');

					//get the transaction date
					var date_val = ($('#TDate').val());

					var url="<?=base_url();?>ifms.php/partner/generate_dct_reference_number/" + date_val;

					//Make the ajax call
					$.get(
						url,
						date_val,
						function(responseText) {
							
							if (responseText.status === 'error') {
								$('#error_msg').html('<p> Error:'+responseText.message +'</p>');
							}
							
							else{
		
							}
						}
					);

				}else{
					$('#myDropzone').addClass('hidden');
					$('#DCT_div').addClass('hidden');
				}


			});
		});

		$('#VTypeMain').change(function() {
			var val = $(this).val();
			$(this).remove();
			$('#VType').append('<INPUT TYPE="text" VALUE="' + val + '" name="VTypeMain" id="VTypeMain" class="form-control" readonly/>');

			// var url = '<?php echo base_url(); ?>ifms.php/partner/voucher_support_modes/' + val;

			// $.ajax({
			// 	url: url,
			// 	success: function(response) {

			// 		var obj_raw = JSON.parse(response);
			// 		var voucher_type_effect = obj_raw.voucher_type_effect;

			// 		if(voucher_type_effect == 'expense'){
						
			// 			$("#support_mode_main").removeClass('hidden');

			// 			var obj = obj_raw.support_modes;

			// 			var options = "<option value=''><?=get_phrase('select_support_mode');?></option>";

			// 			for(var i=0;i<obj.length;i++){
			// 				options += "<option value='"+obj[i].support_mode_id+"'>"+obj[i].support_mode_name+"</option>";
			// 			}

			// 			$("#support_mode").html(options);
			// 		}
			// 		// else{
			// 		// 	$(".voucher_item_type").prop('disabled','disabled');
			// 		// }
			// 	}
			// });

			if (val === 'CHQ') {
				$('#ChqNo').removeAttr('readonly');
				//Modified by Onduso on 13/5/2020
				$('#ChqDiv').removeClass('hidden');
				$('#label-toggle-switch').removeClass('hidden');
				$('#DCTReference').removeClass('accNos');


			}
			
			//Modified by Onduso on 13/5/2020 start
			
			// if (val == "UDCTB" || val == "UDCTC") {
			// 	//$('#DCTReference').removeAttr('readonly');
			// 	$('#myDropzone').removeClass('hidden');
			// 	$('#DCT_div').removeClass('hidden');

			// 	//get the transaction date
			// 	var date_val = ($('#TDate').val());

			// 	var url="<?=base_url();?>ifms.php/partner/generate_dct_reference_number/" + date_val;

            //     //Make the ajax call
			// 	$.get(
			// 		url,
			// 		date_val,
			// 		function(responseText) {
						
			// 			if (responseText.status === 'error') {
			// 				$('#error_msg').html('<p> Error:'+responseText.message +'</p>');
			// 			}
						
			// 			else{
	
			// 			}
			// 		}
			// 	);

			// }
			// if (val == 'BCHG' || val == 'CR' || val == 'PC' || val == 'PCR') {
			// 	$('#DCTReference').removeClass('accNos');
			// }
			//Modified by Onduso on 13/5/2020 End

		});

		$('#reversal').click(function() {
			if ($(this).prop('checked') === false) {
				$('#ChqNo').val('');
				$('#error_msg').html('');
			} else if ($('#ChqNo').val().length === 0) {
				$('#error_msg').html('<?php echo get_phrase("enter_the_cheque_number_to_reverse"); ?>');
				$(this).prop('checked', false);
			} else {

				var chqno = $('#ChqNo').val();
				var reversal = 'no';
				if ($('#reversal').prop('checked')) {
					reversal = 'yes';
				}

				var url = "<?php echo base_url(); ?>ifms.php/partner/chqIntel/" + chqno;

				$.ajax({
					url: url,
					success: function(response) {
						//alert(response);
						if (response === '1' && reversal === 'no') {
							$('#error_msg').html('<?php echo get_phrase('cheque_number'); ?> ' + chqno + ' <?php echo get_phrase('has_already_been_used_or_invalid_input'); ?>');
							$('#hidden').val(1);
						} else if (response === '1' && reversal === 'yes') {
							$('#hidden').val(0);
							$('#error_msg').html('<?php echo get_phrase("you_are_reversing_cheque_number"); ?> ' + chqno);
						} else if (response === '2' && reversal === 'yes') {
							$('#hidden').val(1);
							$('#error_msg').html('<?php echo get_phrase("you_cannot_reverse_cheque_number"); ?> ' + chqno);
						} else {
							$('#hidden').val(0);
							$('#error_msg').html('');
						}
					}
				});
			}
		});



		$('#ChqNo').change(function() {
			//alert('Hello');
			var chqno = $(this).val();
			var reversal = 'no';
			if ($('#reversal').prop('checked')) {
				reversal = 'yes';
			}
			
			var url = "<?php echo base_url(); ?>ifms.php/partner/chqIntel/" + chqno;

			$.ajax({
				url: url,
				success: function(response) {
					//alert(response);
					if(response === '-1'){
						$('#error_msg').html('<?php echo get_phrase('missing_bank_details'); ?>');
						$('#hidden').val(1);
					}else if (response === '1' && reversal === 'no') {
						$('#error_msg').html('<?php echo get_phrase('cheque_number'); ?> ' + chqno + ' <?php echo get_phrase('has_already_been_used_or_invalid_input'); ?>');
						$('#hidden').val(1);
					} else if (response === '1' && reversal === 'yes') {
						$('#hidden').val('');
						$('#error_msg').html('<?php echo get_phrase("you_are_reversing_cheque_number"); ?> ' + chqno);
						$('#ChqNo').css({
							'border': '1px solid gray'
						});

					} else if (response === '2' && reversal === 'yes') {
						$('#hidden').val(1);
						$('#error_msg').html('<?php echo get_phrase("cheque_has_already_been_reversed"); ?>');
						$('#ChqNo').css({
							'border': '1px solid red'
						});
					} else {
						$('#hidden').val('');
						$('#error_msg').html('');

					}
				}
			});
		});

		//Added by Onduso 22/5/2020
		/** Remove rows */
		$('#bodyTable').on('click', 'a', function() {
			$(this).closest('tr').remove();
		});

		/** Add a row */
		$('#addrow,#addrow_footer').click(function(e) {
			//alert($('#reversal').val());
			var vtype = $('#VTypeMain').val();
			var reverse = $('#reversal').prop('checked');
			if (vtype === '#') {
				$('#error_msg').html('<?php echo get_phrase('voucher_type_empty'); ?>');
				exit();
			} else {
				$('#error_msg').html('');
			}


			if (reverse === true) {
				//Check if Date has been selected

				if ($('#TDate').val().length === 0) {
					$('#error_msg').html('<?php echo get_phrase("choose_a_date_then_click_new_item_row_button"); ?>');
					exit();
				} else {
					$('#error_msg').html('');
				}

				var chqno = $('#ChqNo').val();

				url2 = '<?php echo base_url(); ?>ifms.php/partner/reverse_cheque/' + chqno;

				$.ajax({
					url: url2,
					success: function(response) {
						//Onduso modified 5/22/2020 start
						if (response == 0) {
							$('#error_msg').html('<?php echo get_phrase('error:_cheque_number_for_reversal_action_does_exist'); ?>');
							$('#ChqNo').val(chqno);
							$('#ChqNo').css({
								'border': '2px solid red'
							});
							return;
						}
						//Onduso modified End
						var obj_2 = JSON.parse(response);
						//alert(obj_2['0'].TDate);

						//Header
						$('#Payee').val('<?php echo $this->session->userdata('center_id'); ?>');
						$('#Address').val('<?php echo $this->session->userdata('center_id'); ?>');
						$('#TDescription').val('<?php echo get_phrase("reversal_of_cheque_number"); ?> ' + chqno + ' (<?php echo get_phrase('voucher_number'); ?>: ' + obj_2['0'].VNumber + ')');

						//Readonly all inputs 
						$('input').each(function() {
							$(this).attr('readonly', 'readonly');
						});

						//Details

						var table = document.getElementById('bodyTable').children[1];
						var totals = 0;
						//alert(obj_2.length);

						for (var i = 0; i < obj_2.length; i++) {

							var rowCount = table.rows.length;
							var row = table.insertRow(rowCount);
							var rw = rowCount + 1;
							//Delete button cell
							var cell0 = row.insertCell(0);
							var element0 = document.createElement("a");
							element0.type = "a";
							element0.setAttribute('disabled', "disabled");
							element0.className = "btn btn-default glyphicon glyphicon-trash form-control";
							cell0.appendChild(element0);

							//Quantity Column
							var cell1 = row.insertCell(1);
							var element1 = document.createElement("input");
							element1.type = "number";
							element1.name = "qty[]";
							element1.value = obj_2[i].Qty;
							element1.className = "qty accNos form-control";
							element1.id = "qty" + rowCount;
							element1.setAttribute('readonly', 'readonly');
							cell1.appendChild(element1);

							//Details Column
							var cell2 = row.insertCell(2);
							var element2 = document.createElement("input");
							element2.type = "text";
							element2.name = "desc[]";
							element2.className = "desc accNos form-control";
							element2.id = "desc" + rowCount;
							element2.setAttribute('readonly', 'readonly');
							element2.value = obj_2[i].Details;
							cell2.appendChild(element2);

							//Unit Cost Column
							var cell3 = row.insertCell(3);
							var element3 = document.createElement("input");
							element3.type = "number";
							element3.name = "unit[]";
							element3.className = "unit accNos form-control";
							element3.id = "unit" + rowCount;
							element3.setAttribute('readonly', 'readonly');
							element3.value = -obj_2[i].UnitCost;
							cell3.appendChild(element3);

							//Cost Column
							var cell4 = row.insertCell(4);
							var element4 = document.createElement("input");
							element4.type = "text";
							element4.name = "cost[]";
							element4.setAttribute('readonly', 'readonly');
							element4.className = "cost accNos form-control";
							element4.id = "cost" + rowCount;
							element4.setAttribute('readonly', 'readonly');
							element4.value = -obj_2[i].Cost;
							cell4.appendChild(element4);

							//Accounts Column
							var cell5 = row.insertCell(5);
							var element5 = document.createElement("input");
							element5.type = "text";
							element5.name = "acc[]";
							element5.setAttribute('readonly', 'readonly');
							element5.className = "cost accNos form-control";
							element5.id = "acc" + rowCount;
							element5.setAttribute('readonly', 'readonly');
							element5.value = obj_2[i].AccNo;
							cell5.appendChild(element5);

							//CIV Code Column
							var cell6 = row.insertCell(6);
							var element6 = document.createElement("input");
							element6.type = "text";
							element6.name = "civaCode[]";
							element6.setAttribute('readonly', 'readonly');
							element6.className = "civaCode form-control";
							element6.id = "civaCode" + rowCount;
							element6.value = obj_2[i].civaCode;
							cell6.appendChild(element6);

							totals = parseFloat(totals) + parseFloat(obj_2[i].Cost);

						}

						$('#totals').val(-totals);

						//document.getElementById('totals').value=accounting.formatMoney(sum, { symbol: "<?php //echo get_phrase('Kes.');
																											?>",  format: "%v %s" }); 
					}
				});

				$(this).css("display", "none");
				$("#ChqNo").val('0');

			} else {
				var support_mode = $("#support_mode").val() > 0?$("#support_mode").val():0;
				var url = '<?php echo base_url(); ?>ifms.php/partner/voucher_accounts/' + vtype + "/" + support_mode;
				//alert(url);
				$.ajax({
					url: url,
					success: function(response) {
						//alert(response);
						create_voucher_row(response);

					}
				});

			}
		});




	});

	function create_voucher_row(response){


						var obj_voucher_item_type = response.item_types;
						var obj = response.acc;
						var voucher_type_effect = response.voucher_type_effect;
						var obj_support_mode = response.support_modes;

						//alert(obj_support_mode.length);
						var show_voucher_item_type = voucher_type_effect == 'expense' && obj_support_mode.length > 0 ? true : false;

						var table = document.getElementById('bodyTable').children[1];
						var rowCount = table.rows.length;
						var row = table.insertRow(rowCount);


						// //Check box Column
						// var cell0 = row.insertCell(0);
						// var element0 = document.createElement("input");
						// element0.type = "checkbox";
						// element0.className = "chkbx form-control";
						// cell0.appendChild(element0);

						//Delete row cell added by onduso on 5/22/2020

						var cell0 = row.insertCell(0);
						var element0 = document.createElement("a");
						element0.type = "a";
						if (rowCount != 0) { //only provide delete btn if only rows >1
							element0.className = "btn btn-default glyphicon glyphicon-trash form-control";
						}
						//element0.className = "btn btn-default glyphicon glyphicon-trash form-control";
						cell0.appendChild(element0);

						//Quantity Column
						var cell1 = row.insertCell(1);
						var element1 = document.createElement("input");
						element1.type = "number";
						element1.step = "0.01"
						element1.name = "qty[]";
						element1.className = "qty accNos form-control";
						element1.id = "qty" + rowCount;
						element1.setAttribute('required', 'required');
						element1.onkeyup = function() {
							var x = this.value;
							var y = document.getElementById('unit' + rowCount).value;
							document.getElementById('cost' + rowCount).value = x * y;

							var sum = 0;
							$('.cost').each(function() {
								sum += parseFloat(this.value);
							});
							document.getElementById('totals').value = accounting.formatMoney(sum, {
								symbol: "<?php echo get_phrase('Kes.'); ?>",
								format: "%v %s"
							});

						};
						cell1.appendChild(element1);

						// Voucher Item Type
						var cell2 = row.insertCell(2);
						cell2.className = 'td_voucher_item_type';
						var x = document.createElement("select");
						x.name = "voucher_item_type[]";
						x.setAttribute('required', 'required');
						show_voucher_item_type ? '' : x.setAttribute('disabled', 'disabled');
						x.className = 'form-control voucher_item_type';
						var option1 = document.createElement("option");
						option1.text = "Select ...";
						option1.value = "";
						x.add(option1, x[0]);

						for (i = 0; i < obj_voucher_item_type.length; i++) {
							var option = document.createElement("option");

								option.text = obj_voucher_item_type[i].voucher_item_type_name;
								option.value = obj_voucher_item_type[i].voucher_item_type_id;
								x.add(option, x[i]);

						}
						x.onchange = function() {

						};

						cell2.appendChild(x);

						//Details Column
						var cell3 = row.insertCell(3);
						var element3 = document.createElement("input");
						element3.type = "text";
						element3.name = "desc[]";
						element3.className = "desc accNos form-control";
						element3.id = "desc" + rowCount;
						element3.setAttribute('required', 'required');
						cell3.appendChild(element3);

						//Unit Cost Column
						var cell4 = row.insertCell(4);
						var element4 = document.createElement("input");
						element4.type = "number";
						element4.step = "0.01"
						element4.name = "unit[]";
						element4.className = "unit accNos form-control";
						element4.id = "unit" + rowCount;
						element4.onkeyup = function() {
							var x = this.value;
							var y = document.getElementById('qty' + rowCount).value;
							document.getElementById('cost' + rowCount).value = x * y;

							var sum = 0;
							$('.cost').each(function() {
								sum += parseFloat(this.value);
							});
							document.getElementById('totals').value = accounting.formatMoney(sum, {
								symbol: "<?php echo get_phrase('Kes.'); ?>",
								format: "%v %s"
							});

						};
						element4.setAttribute('required', 'required');
						cell4.appendChild(element4);

						//Cost Column
						var cell5 = row.insertCell(5);
						var element5 = document.createElement("input");
						element5.type = "number";
						element5.step = "0.01"
						element5.name = "cost[]";
						element5.setAttribute('readonly', 'readonly');
						element5.className = "cost accNos form-control";
						element5.id = "cost" + rowCount;
						element5.setAttribute('required', 'required');
						cell5.appendChild(element5);

						//Accounts Column
						var cell6 = row.insertCell(6);
						var x = document.createElement("select");
						x.name = "acc[]";
						x.setAttribute('required', 'required');
						x.className = 'form-control accNos acSelect';
						var option1 = document.createElement("option");
						option1.text = "Select ...";
						option1.value = "";
						x.add(option1, x[0]);

						for (i = 0; i < obj.length; i++) {
							var option = document.createElement("option");
							if (obj[i].AccTextCIVA !== null && obj[i].open === "1") {
								option.text = obj[i].AccNoCIVA;
								option.value = obj[i].AccNo;
							} else {
								option.text = obj[i].AccText + ' - ' + obj[i].AccName;
								option.value = obj[i].AccNo;
							}

							x.add(option, x[i]);

						}
						x.onchange = function() {
							//alert("Hello!");  
							document.getElementById("civaCode" + rowCount).value = obj[this.selectedIndex].civaID;
							//check_pc_other_ac_mix(this);
							build_support_mode_list(this);
						};
						x.setAttribute('required', 'required');
						cell6.appendChild(x);

						//Support Modes Column
						var cell7 = row.insertCell(7);
						cell7.className = 'td_support_mode';
						var x = document.createElement("select");
						x.name = "support_mode[]";
						x.setAttribute('required', 'required');
						x.setAttribute('disabled', 'disabled');
						x.className = 'form-control accNos support_mode';
						var option1 = document.createElement("option");
						option1.text = "Select ...";
						option1.value = "";
						x.add(option1, x[0]);
						x.onchange = function() {
							enable_disabled_voucher_item_type(this);
							show_upload_area(this);
						};
						x.setAttribute('required', 'required');
						cell7.appendChild(x);

						var dct_uploads = document.createElement("i");
						dct_uploads.className = 'badge badge-primary dct_uploads_count_label';
						dct_uploads.innerHTML = 0 + " files";
						dct_uploads.onclick = function(){
							show_upload_area($(this).parent().find('.support_mode'));
						};
						dct_uploads.setAttribute('style','cursor:pointer;');
						cell7.appendChild(dct_uploads);

						//CIV Code Column
						var cell8 = row.insertCell(8);
						var element8 = document.createElement("input");
						element8.type = "text";
						element8.name = "civaCode[]";
						element8.setAttribute('readonly', 'readonly');
						element8.className = "civaCode form-control";
						element8.id = "civaCode" + rowCount;
						cell8.appendChild(element8);

						
	}

	function build_support_mode_list(acSelect){
		var sibling_support_mode_select = $(acSelect).closest('tr').find('.td_support_mode').find('select');

		//sibling_support_mode_select.removeAttr('disabled')
		//alert(sibling_support_mode_select);

		var accno = $(acSelect).val();
		var voucher_type_abbrev = $('#VTypeMain').val();

		var url = "<?=base_url();?>ifms.php/partner/get_support_modes";
		var data = {'accno':accno,'voucher_type_abbrev':voucher_type_abbrev};

		$.post(url,data,function(response){
			var obj = JSON.parse(response);

			var options = "<option value='0'><?=get_phrase('select_support_mode');?></option>";

			if(obj.length > 0){
				sibling_support_mode_select.removeAttr('disabled');

				for(var i=0;i<obj.length;i++){
					options += "<option value='"+obj[i].support_mode_id+"'>"+obj[i].support_mode_name+"</option>";
				}

				sibling_support_mode_select.html(options);
			}else{
				sibling_support_mode_select.prop('disabled','disabled');
			}

			sibling_support_mode_select.html(options);
			
		});

	}

	function enable_disabled_voucher_item_type(modes_select){
		var sibling_voucher_item_type_select = $(modes_select).closest('tr').find('.td_voucher_item_type').find('select');
		
		var options = "<option value='0'><?=get_phrase('select_item_type');?></option>";

		if($(modes_select).val() > 0){
			
			var url = "<?=base_url();?>ifms.php/partner/get_voucher_item_types";
			
				$.get(url,function(response){
					sibling_voucher_item_type_select.removeAttr('disabled');

					var obj = JSON.parse(response);

					for(var i=0;i<obj.length;i++){
						options += "<option value='"+obj[i].voucher_item_type_id+"'>"+obj[i].voucher_item_type_name+"</option>";
					}
					sibling_voucher_item_type_select.html(options);
				});
		}else{		
			sibling_voucher_item_type_select.prop('disabled','disabled');
			sibling_voucher_item_type_select.html(options);
		}
		
	}

	function show_upload_area(modes_select){
		var support_mode_id = $(modes_select).val();
		var voucher_detail_row_number = parseInt($(modes_select).closest('tr').index()) + 1;
		var voucher_number = $("#Generated_VNumber").val();

		var url = "<?=base_url();?>ifms.php/partner/check_if_mode_is_dct/"+support_mode_id;

		$.get(url,function(response){
			if(response == 1){
				$(modes_select).prop('onclick',showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_upload_dct_documents/'+ voucher_number +'/'+voucher_detail_row_number+'/'+support_mode_id));
			}
			
		});
	}

	$(document).on('click',"#btn_save_uploads",function(){
		var temp_session = '<?=$this->session->upload_session?$this->session->upload_session:0;?>';
		var voucher_detail_row_index = $(this).data('row_id');
		var dct_uploads_count_label = $("#bodyTable tr").eq(voucher_detail_row_index).find('td.td_support_mode').find('i.dct_uploads_count_label');

		if(temp_session !== 0){
			var url = "<?=base_url();?>ifms.php/partner/count_files_in_temp_dir/"+voucher_detail_row_index;
			$.get(url,function(response){
				dct_uploads_count_label.html(response + " files [Click here to Update]");
			});
		}		
		
	});
</script>