<hr />

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
           	<div class="panel-title" >
           		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('payment_voucher');?>
           	</div>
        </div>
	<div class="panel-body"  style="max-width:50; overflow: auto;">	
		
		<div class="row">
			<div class="col-sm-12">
				<a href="#"   id="resetBtn" class="btn btn-default btn-icon icon-left hidden-print pull-left">
				      <?php echo get_phrase('reset');?>
				     <i class="entypo-plus-circled"></i>
				</a>
						
				<button type="submit" id="btnPostVch" class="btn btn-default btn-icon icon-left hidden-print pull-left">
				     <?php echo get_phrase('post');?>
				     <i class="entypo-thumbs-up"></i>
				</button>
				
		
				<div style="display: none" id='btnDelRow' class="btn btn-default btn-icon icon-left hidden-print pull-left">
				      <?php echo get_phrase('remove_item_row');?>
				     <i class="entypo-minus-circled"></i>
				</div>					
						
				<div id='addrow' class="btn btn-default btn-icon icon-left hidden-print pull-left">
				      <?php echo get_phrase('new_item_row');?>
				     <i class="entypo-plus-circled"></i>
				</div>
					
			</div>
		
		</div>
		
		<?php echo form_open("" , array('id'=>'frm_voucher','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
		
			<div class="row">	
			<div class="col-sm-12">		
			            <input type="hidden" value="<?php echo $this->session->userdata('center_id');?>" id="KENo" name="KENo"/>
			            
			            <table id='tblVch' class='table'>
			            	<thead>
				                <tr>
				                    <th colspan="8"  style="text-align: center;"><?php echo $this->session->userdata('center_id'); ?><br><?php echo get_phrase('payment_voucher');?></th>
				                </tr>
							</thead>
							
							<tbody>
								<tr>
									<td id="error_msg" style="color:red;text-align: center;">
										<?php
											if(isset($msg)) echo $msg;
										?>
									</td>
								</tr>
			                <tr>		               
					            <td colspan="3">
					            	<div class="form-group">
										<label class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('date');?>: </span></label>
										
											<div class="input-group">
												<input type="text" name="TDate" id="TDate" class="form-control datepicker accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
													data-format="yyyy-mm-dd" data-start-date="" 
														data-end-date="" readonly="readonly">
												
												<div class="input-group-addon">
													<a href="#"><i class="entypo-calendar"></i></a>
												</div>
											</div>
										
									</div>
					            </td>
					            <td colspan="2">&nbsp;</td>
					            <td colspan="3">
					            	<div class="form-group">
					            		<label for='VNumber' class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('voucher_number');?></span></label>	
					            		<input type="text" class="form-control accNos" id="VNumber" name="VNumber" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $this->finance_model->next_voucher($this->session->userdata('center_id'))->vnum;?>" readonly/>
					            	</div>
					            </td>
			
			                </tr>
			                <tr>
			                    <td colspan="8">
			                    	<div class="form-group">
			                    		<label for="Payee" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('payee_/_vendor');?>: </span></label>
			                    		<input type="text" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="Payee" name="Payee"/>
			                    	</div>
			                    </td>
			                </tr>
			                <tr>
			                   <td colspan="8">
			                    	<div class="form-group">
			                    			<label for="Address" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('address');?>: </span></label>
			                    		<input type="text" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="Address" name="Address"/>
			                    	</div>
			                    </td>
			                </tr>    
			                <tr>
			                    
			                    <td colspan="4">
			                    	<div class="col-sm-10 form-group" id='VType'>
			                    		<label for="VTypeMain" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('voucher_type');?>:</span></label>
					                        <select name="VTypeMain" id="VTypeMain" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
					                            <option value="#"><?php echo get_phrase('select_voucher_type');?></option>
					                            <option value="PC"><?php echo get_phrase('payment_by_cash');?></option>
					                            <option value="CHQ"><?php echo get_phrase('payment_by_cheque');?></option>
					                            <option value="BCHG"><?php echo get_phrase('bank_adjustments');?></option>
					                            <option value="CR"><?php echo get_phrase('cash_received');?></option>					                            
					                            <option value="PCR"><?php echo get_phrase('petty_cash_rebanking');?></option>
					                        </select>
			                        </div>
			                    </td>
			                    
			                    
			                    <td colspan="2">
			                    	<div class="col-sm-10 form-group">
			                    		<label for="ChqNo" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('cheque_number');?>:</span></label>
			                    			<input class="form-control" type="text" id="ChqNo" name="ChqNo" data-validate="number,minlength[2]"  readonly="readonly"/>
			                    	</div>
			                    </td>
			                    
			                 	<td colspan="2">
			                    	<div id="label-toggle-switch" for="reversal" class="col-sm-6"><span style="font-weight: bold;"><?php echo get_phrase('cheque_reversal');?></span> 
										<div class="make-switch switch-small" data-on-label="Yes" data-off-label="No">
												<input type="checkbox" id="reversal" name="reversal"/>
										</div>
									</div>		
			                    </td>
			                    
			                </tr>
			                
			                <tr>
			                   
			                    <td colspan="8">
			                    	<div class="form-group">
			                    			<label for="TDescription" class="control-label"><span style="font-weight: bold;"><?php echo get_phrase('description');?></span></label>
			                    		<input type="text" class="form-control accNos" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="TDescription" name="TDescription"/>
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
				                <th><?php echo get_phrase('check');?></th><th><?php echo get_phrase('quantity');?></th><th><?php echo get_phrase('items_purchased_/_services_received');?></th><th><?php echo get_phrase('unit_cost');?></th><th><?php echo get_phrase('cost');?></th><th><?php echo get_phrase('account');?></th><th><?php echo get_phrase('civ_code');?></th>
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
			            			<input class="form-control" type="text" id="totals" name="totals" readonly/>
			            		</div>
			            	</td>
			            </tr>
			        </table>
			    </div> 
		   </div>
		        <INPUT type="hidden" id="hidden" value=""/>
		    
				

		</form>    
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-12">
					
				<div data-toogle="modal" data-target=""  id="resetBtn"  class="btn btn-default btn-icon icon-left hidden-print pull-left">
				      <?php echo get_phrase('reset');?>
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

$(document).ready(function(){
	$("#go_btn").click(function(){
		var VNum = $("#VNumber").val();
		
		showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_search_voucher/'+VNum);
	});
	
	
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		startDate:'<?php echo $this->finance_model->next_voucher($this->session->userdata('center_id'))->current_voucher_date;?>',
		endDate:'<?php echo $this->finance_model->next_voucher($this->session->userdata('center_id'))->end_month_date;?>'
	});
	

$('#btnPostVch,#btnPostVch_footer').click(function(e){
		
		if($('#ChqNo').val()<1  &&  $("#totals").val()!=="0.00 Kes." && $('#VTypeMain').val()==='CHQ' && $('#reversal').prop('checked') === false){
			//alert("Here 1");
			$('#error_msg').html('<?php echo get_phrase('error:_invalid_cheque_number');?>');
			e.preventDefault();
		}else if($("#bodyTable > tbody").children().length===0){
			//alert("Here 2");
			$('#error_msg').html('<?php echo get_phrase('error:_voucher_missing_details');?>');
			e.preventDefault();			
		}else if($('#hidden').val().length>0 && $('#reversal').prop('checked') === false){
			//alert($('#hidden').val());
			//alert("Here 3");
			$('#error_msg').html('<?php echo get_phrase("cheque_numbers_cannot_be_re-used");?>');
			e.preventDefault();		
		}else if($('.accNos').length>0){
			//alert("Here 4");
			var cnt_empty = 0;
			$('.accNos').each(function(i){
				if($(this).val().length===0){
						cnt_empty++;
				}
			});
			
			if(cnt_empty>0){
				$('#error_msg').html(cnt_empty+' <?php echo get_phrase("empty_fields");?>');
				e.preventDefault();
			}else{
					var frm = $("#frm_voucher");
				    var postData = frm.serializeArray();
				    var formURL = "<?=base_url()?>ifms.php/partner/post_voucher/";
				    //alert(formURL);
				    $.ajax(
				    {
				        url : formURL,
				        type: "POST",
				        data : postData,
				        beforeSend:function(){
				        	$('#error_msg').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url();?>uploads/preloader4.gif" /></div>');
				        },
				        success:function(data, textStatus, jqXHR) 
				        {

				            //$('#modal_ajax').modal('toggle');
				            $('#load_voucher').html(data);
				            //$('#voucher_count').html(parseInt($('#voucher_count').html())+1);
				            
				        },
				        error: function(jqXHR, textStatus, errorThrown) 
				        {
				            //if fails
				            alert(textStatus);      
				        }
				    });				
				
			}
		}else{
					//alert("Here 5");
					var frm = $("#frm_voucher");
				    var postData = frm.serializeArray();
				    var formURL = "<?=base_url()?>ifms.php/partner/post_voucher/";
				    alert(formURL);
				    $.ajax(
				    {
				        url : formURL,
				        type: "POST",
				        data : postData,
				        beforeSend:function(){
				        	$('#error_msg').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url();?>uploads/preloader4.gif" /></div>');
				        },
				        success:function(data, textStatus, jqXHR) 
				        {

				           //$('#modal_ajax').modal('toggle');
				            $('#load_voucher').html(data);
				            //$('#voucher_count').html(parseInt($('#voucher_count').html())+1);
				            
				        },
				        error: function(jqXHR, textStatus, errorThrown) 
				        {
				            //if fails
				            alert(textStatus);      
				        }
				    });

		}
			e.preventDefault(); //STOP default action
			e.unbind(); //unbind. to stop multiple form submit.
	});	
	
	$("#resetBtn").click(function(){

				    var formURL = "<?=base_url()?>ifms.php/partner/reset_voucher/";
				    $.ajax(
				    {
				        url : formURL,

				        beforeSend:function(){
				        	$('#error_msg').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url();?>uploads/preloader4.gif" /></div>');
				        },
				        success:function(data, textStatus, jqXHR) 
				        {

				           //$('#modal_ajax').modal('toggle');
				            $('#load_voucher').html(data);
				            //$('#voucher_count').html(parseInt($('#voucher_count').html())+1);
				            
				        },
				        error: function(jqXHR, textStatus, errorThrown) 
				        {
				            //if fails
				            alert(textStatus);      
				        }
				    });
	});
	
	
	$('#VTypeMain').change(function(){
		var val = $(this).val();
		$(this).remove();
		$('#VType').append('<INPUT TYPE="text" VALUE="'+val+'" name="VTypeMain" id="VTypeMain" class="form-control" readonly/>');
		
					var url = '<?php echo base_url();?>ifms.php/partner/voucher_accounts/'+val;
						//alert(url);
						$.ajax({
								url: url,
								success: function(response)
								{
									//alert(response);
									obj = jQuery.parseJSON(response);// Global Accounts Variable
								}
						});
		
		if(val==='CHQ'){
			$('#ChqNo').removeAttr('readonly');
		}
	});
	
	
	
		$('#reversal').click(function(){
		if($(this).prop('checked')===false){
			$('#ChqNo').val('');
			$('#error_msg').html('');
		}else if($('#ChqNo').val().length===0){
			$('#error_msg').html('<?php echo get_phrase("enter_the_cheque_number_to_reverse");?>');
			$(this).prop('checked',false);
		}else{
							
				var chqno = $('#ChqNo').val();
				var reversal = 'no';
				if($('#reversal').prop('checked')){
					reversal='yes';
				}
				
				var url = "<?php echo base_url();?>ifms.php/partner/chqIntel/"+chqno;
				
				$.ajax(
					{
						url:url,
						success:function(response){
								//alert(response);
								if(response==='1' && reversal==='no'){
									$('#error_msg').html('<?php echo get_phrase('cheque_number');?> '+chqno+' <?php echo get_phrase('has_already_been_used_or_invalid_input');?>');
									$('#hidden').val(1);
								}else if(response==='1' && reversal==='yes'){
									$('#hidden').val(0);
									$('#error_msg').html('<?php echo get_phrase("you_are_reversing_cheque_number");?> '+chqno);
								}else if(response==='2' && reversal==='yes'){
									$('#hidden').val(1);
									$('#error_msg').html('<?php echo get_phrase("you_cannot_reverse_cheque_number");?> '+chqno);
								}else{
									$('#hidden').val(0);
									$('#error_msg').html('');
								}
						}
					}
				);
		}
	});
	
	
	
	$('#ChqNo').keyup(function(){
		//alert('Hello');
		var chqno = $(this).val();
		var reversal = 'no';
		if($('#reversal').prop('checked')){
			reversal='yes';
		}
		
		var url = "<?php echo base_url();?>ifms.php/partner/chqIntel/"+chqno;
		
		$.ajax(
			{
				url:url,
				success:function(response){
					
						if(response==='1' && reversal==='no'){
							$('#error_msg').html('<?php echo get_phrase('cheque_number');?> '+chqno+' <?php echo get_phrase('has_already_been_used_or_invalid_input');?>');
							$('#hidden').val(1);
						}else if(response==='1' && reversal==='yes'){
							$('#hidden').val('');
							$('#error_msg').html('<?php echo get_phrase("you_are_reversing_cheque_number");?> '+chqno);
						}
						else if(response==='2' && reversal==='no'){
							$('#hidden').val(1);
							$('#error_msg').html('<?php echo get_phrase("cheque_has_already_been_reversed");?>');
						}else{
							$('#hidden').val('');
							$('#error_msg').html('');
							
						}
				}
			}
		);
	});
	
	
	
	
	
	
	$('#addrow,#addrow_footer').click(function(){
			
			var vtype = $('#VTypeMain').val();
			var reverse = $('#reversal').prop('checked');
				if(vtype==='#'){
					$('#error_msg').html('<?php echo get_phrase('voucher_type_empty');?>');
					exit();
				}else{
					$('#error_msg').html('');
				}
				
				
				if(reverse===true){
					//Check if Date has been selected
					
					if($('#TDate').val().length===0){
						$('#error_msg').html('<?php echo get_phrase("choose_a_date_then_click_new_item_row_button");?>');
						exit();
					}else{
						$('#error_msg').html('');
					}
					
					var chqno = $('#ChqNo').val();
					
					url2 = '<?php echo base_url();?>ifms.php/partner/reverse_cheque/'+chqno;
					$.ajax({
						url:url2,
						success:function(response){			
								var obj_2 = JSON.parse(response); 
								//alert(obj_2['0'].TDate);
										
							//Header
							$('#Payee').val('<?php echo $this->session->userdata('center_id');?>');
							$('#Address').val('<?php echo $this->session->userdata('center_id');?>');
							$('#TDescription').val('<?php echo get_phrase("reversal_of_cheque_number");?> '+chqno+' (<?php echo get_phrase('voucher_number');?>: '+obj_2['0'].VNumber+')');
							
							//Readonly all inputs 
							$('input').each(function(){
								$(this).attr('readonly','readonly');
							});
					
							//Details
							
							var table = document.getElementById('bodyTable').children[1];
							var totals = 0;
							//alert(obj_2.length);
							
							for(var i=0;i<obj_2.length;i++){
							
							var rowCount = table.rows.length;
			            	var row = table.insertRow(rowCount);
			            	var rw = rowCount+1;
			            			//Check box Column
			                        var cell0 = row.insertCell(0);
			                        var element0 = document.createElement("input");
			                        element0.type = "checkbox";
			                        element0.setAttribute('disabled',"disabled");
			                        element0.className="chkbx form-control";
			                        cell0.appendChild(element0);	
			                        
			                        //Quantity Column
									var cell1 = row.insertCell(1);
									var element1 = document.createElement("input");
									element1.type = "number";
									element1.name = "qty[]";
									element1.value = obj_2[i].Qty;
									element1.className = "qty accNos form-control";
			                        element1.id="qty"+rowCount;   
			                        element1.setAttribute('readonly','readonly');		                        
			                        cell1.appendChild(element1);  			                        							

			                        //Details Column
									var cell2 = row.insertCell(2);
									var element2 = document.createElement("input");
									element2.type = "text";
									element2.name = "desc[]";
									element2.className = "desc accNos form-control";
			                        element2.id="desc"+rowCount;  
			                        element2.setAttribute('readonly','readonly');
			                        element2.value = obj_2[i].Details;
			                        cell2.appendChild(element2);
			                        
			                        //Unit Cost Column
									var cell3 = row.insertCell(3);
									var element3 = document.createElement("input");
									element3.type = "number";
									element3.name = "unit[]";
									element3.className = "unit accNos form-control";
			                        element3.id="unit"+rowCount;  			                        
			                        element3.setAttribute('readonly','readonly');
			                        element3.value = -obj_2[i].UnitCost;
			                        cell3.appendChild(element3);                 			                        

			                        //Cost Column
									var cell4 = row.insertCell(4);
									var element4 = document.createElement("input");
									element4.type = "text";
									element4.name = "cost[]";
									element4.setAttribute('readonly','readonly');
									element4.className = "cost accNos form-control";
			                        element4.id="cost"+rowCount;  
			                        element4.setAttribute('readonly','readonly');
			                        element4.value = -obj_2[i].Cost;
			                        cell4.appendChild(element4);

			                        //Accounts Column
									var cell5 = row.insertCell(5);
									var element5 = document.createElement("input");
									element5.type = "text";
									element5.name = "acc[]";
									element5.setAttribute('readonly','readonly');
									element5.className = "cost accNos form-control";
			                        element5.id="acc"+rowCount;  
			                        element5.setAttribute('readonly','readonly');
			                        element5.value = obj_2[i].AccNo;
			                        cell5.appendChild(element5);
			                        
			                        //CIV Code Column
									var cell6 = row.insertCell(6);
									var element6 = document.createElement("input");
									element6.type = "text";
									element6.name = "civaCode[]";
									element6.setAttribute('readonly','readonly');
									element6.className = "civaCode form-control";
			                        element6.id="civaCode"+rowCount;  
			                        element6.value = obj_2[i].civaCode;
			                        cell6.appendChild(element6);		
			                        
			                        totals = parseFloat(totals) + parseFloat(obj_2[i].Cost);
			                                                
							}
							
							$('#totals').val(-totals);	
							
							//document.getElementById('totals').value=accounting.formatMoney(sum, { symbol: "<?php //echo get_phrase('Kes.');?>",  format: "%v %s" }); 
						}
					});
					
					$(this).css("display","none");
					$("#ChqNo").val('0');
					
				}else{
						var url = '<?php echo base_url();?>ifms.php/partner/voucher_accounts/'+vtype;
						//alert(url);
						$.ajax({
								url: url,
								success: function(response)
								{
									//alert(response);
									var obj = response; 
									//var obj = JSON.parse(response);
									//alert(obj[1].AccNo);
									var table = document.getElementById('bodyTable').children[1];
			            			var rowCount = table.rows.length;
			            			var row = table.insertRow(rowCount);
			            
			            			//Check box Column
			                        var cell0 = row.insertCell(0);
			                        var element0 = document.createElement("input");
			                        element0.type = "checkbox";
			                        element0.className="chkbx form-control";
			                        cell0.appendChild(element0);
			                        
			                        //Quantity Column
									var cell1 = row.insertCell(1);
									var element1 = document.createElement("input");
									element1.type = "number";
									element1.step="0.01"
									element1.name = "qty[]";
									element1.className = "qty accNos form-control";
			                        element1.id="qty"+rowCount;   
			                        element1.setAttribute('required','required');
									element1.onkeyup=function(){
                                             var x=this.value;
                                             var y=document.getElementById('unit'+rowCount).value;
                                             document.getElementById('cost'+rowCount).value=x*y;
                                                        
                                             var sum = 0;
                                             $('.cost').each(function(){
                                                  sum += parseFloat(this.value);
                                             });
                                               document.getElementById('totals').value=accounting.formatMoney(sum, { symbol: "<?php echo get_phrase('Kes.');?>",  format: "%v %s" });   
                                                                                                              
                                             };			                        
			                        cell1.appendChild(element1);  
			                        
			                        //Details Column
									var cell2 = row.insertCell(2);
									var element2 = document.createElement("input");
									element2.type = "text";
									element2.name = "desc[]";
									element2.className = "desc accNos form-control";
			                        element2.id="desc"+rowCount;  
			                        element2.setAttribute('required','required');
			                        cell2.appendChild(element2);  
			                        
			                        //Unit Cost Column
									var cell3 = row.insertCell(3);
									var element3 = document.createElement("input");
									element3.type = "number";
									element3.step="0.01"
									element3.name = "unit[]";
									element3.className = "unit accNos form-control";
			                        element3.id="unit"+rowCount;  
		            				element3.onkeyup=function(){
		            		                    var x = this.value;
		                                        var y = document.getElementById('qty'+rowCount).value;
		                                        document.getElementById('cost'+rowCount).value= x*y;  
		                                                       
		                                        var sum = 0;
		                                         $('.cost').each(function(){
		                    	                      sum += parseFloat(this.value);
		                                           });
		                                        document.getElementById('totals').value=accounting.formatMoney(sum, { symbol: "<?php echo get_phrase('Kes.');?>",  format: "%v %s" });                                                             
		                                                        
		                                       };			                        
			                        element3.setAttribute('required','required');
			                        cell3.appendChild(element3);                                           
			
			                        //Cost Column
									var cell4 = row.insertCell(4);
									var element4 = document.createElement("input");
									element4.type = "number";
									element4.step="0.01"
									element4.name = "cost[]";
									element4.setAttribute('readonly','readonly');
									element4.className = "cost accNos form-control";
			                        element4.id="cost"+rowCount;  
			                        element4.setAttribute('required','required');
			                        cell4.appendChild(element4);
			
			                        //Accounts Column
									var cell5 = row.insertCell(5);
									var x = document.createElement("select");
									x.name ="acc[]";
									x.setAttribute('required','required');
						            x.className = 'form-control accNos acSelect';        
						            	 var option1 = document.createElement("option");
											option1.text = "Select ...";
											option1.value = "";
							            	x.add(option1,x[0]);
							                        
							                        for (i=0;i<obj.length;i++){
							                        var option = document.createElement("option");
							                        if(obj[i].AccTextCIVA!==null&&obj[i].open==="1"){
							                            option.text = obj[i].AccNoCIVA;
							                            option.value = obj[i].AccNo;
							                        }else{
							                            option.text = obj[i].AccText;
							                            option.value = obj[i].AccNo;                        
							                        }                                                 
										
							                        x.add(option,x[i]);
							
							                        } 
							                        x.onchange=function(){
							                          //alert("Hello!");  
							                          document.getElementById("civaCode"+rowCount).value=obj[this.selectedIndex].civaID;
							                          check_pc_other_ac_mix(this);
							                        };
			                        x.setAttribute('required','required');
						            cell5.appendChild(x);
			
			                        //CIV Code Column
									var cell6 = row.insertCell(6);
									var element6 = document.createElement("input");
									element6.type = "text";
									element6.name = "civaCode[]";
									element6.setAttribute('readonly','readonly');
									element6.className = "civaCode form-control";
			                        element6.id="civaCode"+rowCount;  
			                        cell6.appendChild(element6);
			
								}
							});
							
				}
	});
		
	
	
 	
});	
	
	
</script>