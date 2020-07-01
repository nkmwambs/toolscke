<?php
//print_r($claims);
?>
<div class="well">	
	<div class="row">
	<?php echo form_open(base_url() . 'claims.php/medical/search_claim/' , array('id'=>'frm_search','class' => 'form-vertical form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
		
		<div class="col-sm-8" id="filters">
				<table class="table" id="table_search">
					<thead>
						<tr>
							<th><?=get_phrase("search_by");?></th>
							<th><?=get_phrase("operator");?></th>
							<th><?=get_phrase("value");?></th>
							<th><?=get_phrase("action");?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="filters">
								<select class="form-control" name="field[]" id="" onchange="return selected_option(this)">
									<option value=""><?=get_phrase('select');?></option>
									<option value="connect_incident_id"><?=get_phrase('connect_incident_id');?></option>
									<option value="claimCnt"><?=get_phrase('claim_count');?></option>
									<option value="proNo"><?=get_phrase('ke_no');?></option>
									<option value="cluster"><?=get_phrase('cluster');?></option>
									<option value="childNo"><?=get_phrase('child_number');?></option>
									<option value="childName"><?=get_phrase('child_name');?></option>
									<option value="date"><?=get_phrase('claim_date');?></option>
									<option value="treatDate"><?=get_phrase('treatment_date');?></option>
									<option value="diagnosis"><?=get_phrase('diagnosis');?></option>
									<option value="reinstatementdate"><?=get_phrase('reinstatement_date');?></option>
									<option value="stmp"><?=get_phrase('last_action_date');?></option>
									<option value="totAmt"><?=get_phrase('amount_incurred');?></option>
									<option value="careContr"><?=get_phrase('contribution');?></option>
									<option value="nhif"><?=get_phrase('N.H.I.F_number');?></option>
									<option value="amtReim"><?=get_phrase('amount_reimbursed');?></option>
									<option value="facName"><?=get_phrase('facility_name');?></option>
									<option value="facClass"><?=get_phrase('facility_type');?></option>
									<option value="vnum"><?=get_phrase('voucher_number');?></option>
									<option value="rmks"><?=get_phrase('status');?></option>

								</select>
							</td>
							<td>
								<select class="form-control" name="operator[]" id="">
									<option value=""><?=get_phrase('select');?></option>
									<option value="="><?=get_phrase('equals_to');?></option>
									<option value="!="><?=get_phrase('not_equal_to');?></option>
									<option value="LIKE"><?=get_phrase('contains');?></option>
									<option value=">"><?=get_phrase('greater_than');?></option>
									<option value="<"><?=get_phrase('less_than');?></option>
									<option value=">="><?=get_phrase('greater_than_or_equal_to');?></option>
									<option value="<="><?=get_phrase('less_than_or_equal_to');?></option>
								</select>
							</td>
							<td class="val"><input type="text" class="form-control" name="val[]" id=""/></td>
							<td><div class="fa fa-plus" onclick="return add_filter();"></div>&nbsp;<div class="fa fa-minus" onclick="return remove_filter(this)"></div></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3">
								<button type="submit" id="btn_search" class="btn btn-primary btn-icon"><i class="fa fa-search"></i><?=get_phrase('search');?></button>
								<!--<div class="btn btn-red" id="reset"><?=get_phrase('reset');?></div>-->
							</td>
						</tr>
					</tfoot>
				</table>
		</div>
		
		<div class="col-sm-4">
			<label class="control-label col-sm-12">
				<?php echo get_phrase('apply_date_range_in_claim_date_field');?>
				<input type="checkbox" class="pull-right" name="date_range" value="1" onclick="get_date_range(this);"/>	
			</label>
			
			
			
			<div class="col-sm-12">	
				<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
							<input class="form-control" type="text" name="daterange" readonly="readonly" value="" onchange="show_range(this);"/>
				</div>
				
				<input type="hidden" id="start_date" name="start_date">
				<input type="hidden" id="end_date" name="end_date">
			
			</div>	
			
		</div>
				
	<form/>
	
	</div>			
	

</div>


<hr/>
<?php
	if($this->session->userdata('logged_user_level')==="1"){
?>
	<a href="<?php echo base_url(); ?>claims.php/medical/new_medical_claim" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i><?=get_phrase('new_claim');?></a>

	<button style="display: none;" id="mass_submit" class="btn btn-orange btn-icon pull-right"><i class="fa fa-thumbs-o-up"></i><?=get_phrase("submit_claim");?></button>
	
	<hr/>
<?php
	}
?>



<div class="col-sm-12 wrapper" id="wrapper">
	
<table class="table table-striped table-hover" id="table_export"  style="white-space: nowrap;" width="100%">
	<thead>
		<tr>
			<th><input type='checkbox' id='chkAll' onclick='return chkAll();'/></th>
			<th><?=get_phrase('incident_ID');?></th>
			<th><?=get_phrase('ke_no');?></th>
			<th><?=get_phrase('cluster');?></th>
			<th><?=get_phrase('child_no');?></th>
			<th><?=get_phrase('child_name');?></th>
			<th><?=get_phrase('payment_date');?></th>
			<th><?=get_phrase('claim_date');?></th>			
			<th><?=get_phrase('diagnosis');?></th>
			<th><?=get_phrase('total_amount');?></th>
			<th><?=get_phrase('caregiver_contribution');?></th>
			<th><?=get_phrase('N.H.I.F');?></th>
			<th><?=get_phrase('amount_reimbursable');?></th>
			<th><?=get_phrase('facility_name');?></th>
			<th><?=get_phrase('facility_type');?></th>
			<th><?=get_phrase('claim_type');?></th>
			<th><?=get_phrase('voucher_no');?></th>
			<th><?=get_phrase('receipt');?></th>
			<th><?=get_phrase('request_approval_document');?></th>
			<th><?=get_phrase('action');?></th>
			<th><?=get_phrase('claim_count');?></th>
			<th><?=get_phrase('status');?></th>
			<th><?=get_phrase('last_action_time_stamp');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($claims as $rows):
		?>
			<tr>
				<td><input class="chkbox" type='checkbox' id='<?=$rows->rec;?>'/></td>
				<td><?=$rows->connect_incident_id;?></td>
				<td><?=$rows->proNo;?></td>
				<td><?=$rows->cluster;?></td>
				<td><?=$rows->childNo;?></td>				
				<td><?=$rows->childName;?></td>
				<td><?=$rows->treatDate;?></td>
				<td><?=$rows->date;?></td>				
				<td><?=$rows->diagnosis;?></td>
				<td><?=$rows->totAmt;?></td>
				<td><?=$rows->careContr;?></td>
				<td><?=$rows->nhif;?></td>
				<td><?=$rows->amtReim;?></td>
				<td><?=$rows->facName;?></td>
				<td><?=$rows->facClass;?></td>
				<td><?=$rows->type;?></td>
				<td><?=$rows->vnum;?></td>
				<td>
					<?php
					
						if(count($this->db->get_where('apps_files',array('file_group'=>$rows->rec,'upload_type'=>"receipt"))->result_object())=== 0){
							echo "<a href='".base_url()."claims.php/medical/add_claim_rct/".$rows->rec."' class='btn btn-orange btn-icon'><i class='fa fa-cloud-upload'></i>".get_phrase('attach_receipt')."</a>";
						}else{
							echo "<a href='".base_url()."claims.php/medical/add_claim_rct/".$rows->rec."' class='btn btn-green btn-icon'><i class='fa fa-cloud-download'></i>".get_phrase('download')."</a>";
						}
						

					?>
				</td>
				<td>
					<?php
						if(count($this->db->get_where('apps_files',array('file_group'=>$rows->rec,'upload_type'=>"approval"))->result_object())=== 0){
							echo "<a href='".base_url()."claims.php/medical/add_claim_docs/".$rows->rec."' class='btn btn-orange btn-icon'><i class='fa fa-cloud-upload'></i>".get_phrase('attach_approval')."</a>";
						}else{
							echo "<a href='".base_url()."claims.php/medical/add_claim_docs/".$rows->rec."' class='btn btn-green btn-icon'><i class='fa fa-cloud-download'></i>".get_phrase('download')."</a>";
						}
					?>
				</td>
				<td>
					<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <?php 
                        	$userlevel = $this->session->userdata('logged_user_level');
                        	
							switch($userlevel):
								
								case "1":
							?>
									<!-- Submit Claim -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/single_submit/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-send"></i>
												<?php echo get_phrase('submit');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>	
						
									<!--View Comments-->
			                       	
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_view_comments/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-eye"></i>
												<?php echo get_phrase('view_comments');?>
			                               	</a>
			                       	</li> 
			                       	
			                       	<li class="divider"></li>
						
			                       	<!--Edit-->
			                       	
			                        <li>
			                        	<a href="<?php echo base_url();?>claims.php/medical/edit_medical_claim/<?php echo $rows->rec;?>">
			                            	<i class="fa fa-pencil-square-o"></i>
												<?php echo get_phrase('edit');?>
			                               	</a>
			                       	</li> 
			
			                       	<li class="divider"></li>						
						
									<!--Delete-->
			                       	
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/delete_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-trash-o"></i>
												<?php echo get_phrase('delete');?>
			                               	</a>
			                       	</li>     
			                       	
			                       
			                       <li class="divider"></li>						
						
									<!--Reinstate-->
                       	
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/reinstate_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-reply"></i>
												<?php echo get_phrase('reinstate');?>
			                               	</a>
			                       	</li>       			
			                       	
			                       	<li class="divider"></li>			
						
							<?php
								break;
								case "2":
							?>
									<!-- Approve -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/process_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-thumbs-o-up"></i>
												<?php echo get_phrase('process');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
						
									<!-- Decline -->
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_decline_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-times-rectangle"></i>
												<?php echo get_phrase('decline');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>

									<!--View Comments-->
			                       	
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_view_comments/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-eye"></i>
												<?php echo get_phrase('view_comments');?>
			                               	</a>
			                       	</li> 
			                       	
			                       	<li class="divider"></li>
							
							<?php	
								break;
								case "5":		
							?>							
									<!-- Approve -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/process_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-thumbs-o-up"></i>
												<?php echo get_phrase('process');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
						
									<!-- Decline -->
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_decline_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-times-rectangle"></i>
												<?php echo get_phrase('decline');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
			                       	
			                       	<!--View Comments-->
			                       	
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_view_comments/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-eye"></i>
												<?php echo get_phrase('view_comments');?>
			                               	</a>
			                       	</li> 
			                       	
			                       	<li class="divider"></li>
							<?php
								break;
								default:
							?>
							
									<!-- Submit Claim -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/single_submit/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-send"></i>
												<?php echo get_phrase('submit');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>	
						
									<!--View Comments-->
			                       	
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_view_comments/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-eye"></i>
												<?php echo get_phrase('view_comments');?>
			                               	</a>
			                       	</li> 
			                       	
			                       	<li class="divider"></li>
						
			                       	<!--Edit-->
			                       	
			                        <li>
			                        	<a href="<?php echo base_url();?>claims.php/medical/edit_medical_claim/<?php echo $rows->rec;?>">
			                            	<i class="fa fa-pencil-square-o"></i>
												<?php echo get_phrase('edit');?>
			                               	</a>
			                       	</li> 
			
			                       	<li class="divider"></li>						
						
									<!--Delete-->
			                       	
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/delete_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-trash-o"></i>
												<?php echo get_phrase('delete');?>
			                               	</a>
			                       	</li>     
			                       	
			                       
			                       <li class="divider"></li>						
						
									<!--Reinstate-->
                       	
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/reinstate_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-reply"></i>
												<?php echo get_phrase('reinstate');?>
			                               	</a>
			                       	</li>       			
			                       	
			                       	<li class="divider"></li>			

									<!-- Approve -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/medical/process_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-thumbs-o-up"></i>
												<?php echo get_phrase('process');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
						
									<!-- Decline -->
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_decline_claim/<?php echo $rows->rec;?>');">
			                            	<i class="fa fa-times-rectangle"></i>
												<?php echo get_phrase('decline');?>
			                               	</a>
			                       	</li>
							
						<?php			
							endswitch;	
                        ?>
                       
                                 	
                    </ul>
                </div>
				</td>
				<td><?=$rows->claimCnt;?></td>
				<td>
					<?php
						
						switch($rows->rmks):
						
							case "-1":
								echo get_phrase("new");
								break;
							case "0":
								echo  get_phrase("submitted");
								break;
							case "1":
								echo   get_phrase("declined_by_PF");
								break;
							case "2":
								echo   get_phrase("checked_by_PF");
								break;
							case "3":
								echo   get_phrase("declined_by_HS");
								break;
							case "4":
								echo   get_phrase("approved_by_HS");
								break;				
							default:
								echo  get_phrase("paid");		
						
						endswitch;
						
						if($rows->reinstatementdate!="0000-00-00"){
							echo " (".get_phrase('reinstated').")";
						}
							
					?>
					
				</td>
				<td><?=$rows->stmp;?></td>
			</tr>
		<?php
			endforeach;
		?>
		
	</tbody>
</table>
</div>

<script>
function show_range(el){
	
}

function get_date_range(el){
	//alert($(el).is(":checked"));
	
	if($(el).is(":checked")===true && $('#start_date').val()===""){
		
		alert('Please select a date range');
		
		$(el).prop('checked','');
	}
}

$(document).ready(function(){
		
		$('input[name="daterange"]').daterangepicker(
		{
			"showDropdowns": true,
			"ranges": {
        	"Today": [
            	"<?php echo date('Y-m-d');?>",
            	"<?php echo date('Y-m-d');?>"
        		],
        	"Yesterday": [
            		"<?php echo date('Y-m-d',strtotime('yesterday'));?>",
            		"<?php echo date('Y-m-d',strtotime('yesterday'));?>"
        		],
        	"Last 7 Days": [
            		"<?php echo date('Y-m-d',strtotime('-7 days'));?>",
            		"<?php echo date('Y-m-d');?>"
        		],
        	"Last 30 Days": [
            		"<?php echo date('Y-m-d',strtotime('-30 days'));?>",
            		"<?php echo date('Y-m-d');?>"
        		],
        	"This Month": [
            		"<?php echo date('Y-m-01');?>",
            		"<?php echo date('Y-m-t');?>"
        		],
        	"Last Month": [
            		"<?php echo date('Y-m-01',strtotime('-1 months'));?>",
            		"<?php echo date('Y-m-t',strtotime('-1 months'));?>"
        		]
    		},
    		
		    locale: {
		      format: 'YYYY-MM-DD'
		    },
		    startDate: '<?php echo date('Y-m-01');?>',
		    endDate: '<?php echo date('Y-m-t');?>'
		}, 
		function(start, end, label) {
		    //alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		    
		    $('#start_date').val(start.format('YYYY-MM-DD'));
       		
       		$('#end_date').val(end.format('YYYY-MM-DD'));
		});
		
		
		$("#table_export").tableHeadFixer({'left' : 7}); 
		
		$('#mass_submit').css('display','none');
		
		
		var datatable = $('#table_export,table.display').DataTable({
		       dom: '<Bfr><"col-sm-12"t><ip>',
		       pagingType: "full_numbers",
		       buttons: [
		           'csv', 'excel', 'print'
		       ],
		       stateSave: true
		   });
			    
		//$('#table_export tbody').on('click', 'tr', function () {
		  //    var data = datatable.row(this).data();
		    //  alert( 'You clicked on '+data[5]+'\'s row' );
		//} );
		    				    	
		
	});
	
	
	$('#mass_submit').click(function(e){
		
		var url = "<?php echo base_url();?>claims.php/medical/mass_submit_claims/";
		var postData;
		
		postData = new FormData();
 
    	
    	$('.chkbox').each(function(){
    		if($(this).is(':checked')){
    			postData.append( 'claim[]', $(this).attr('id'));
    		}
    	});
		
		$.ajax({
			url:url,
			type:"POST",
			data:postData,
			processData: false,
			contentType: false,
			success:function(data){
				alert(data);
				location.reload();
			},
			error:function(error){
				
			}
		});
		
		e.preventDefault();
	});
	
	$('#chkAll').click(function(){
		if($(this).is(':checked')){
			$('.chkbox').prop('checked',true);
		}else{
			$('.chkbox').prop('checked',false);
		}
		
		count_checked_boxes();
	});
	
	$('.chkbox').click(function(){
		count_checked_boxes();
		
	});

	function count_checked_boxes(){
		var cnt_checked = 0;
		$('.chkbox').each(function(){
			if($(this).is(':checked')){
				++cnt_checked;
			}
		});
		
		if(cnt_checked>0){
			$('#mass_submit').css('display','block');
		}else{
			$('#mass_submit').css('display','none');	
		}
	}
	
	function add_filter(){

		  $("#table_search tr").eq(1).clone().find(".form-control").each(function() {
		    $(this).attr({
		      //'id': function(_, id) { return id + i },
		      'name': function(_, name) { return name + [] }
		      //'value': ''               
		    });
		  }).end().appendTo("#table_search");
	}
	
	function remove_filter(el){
		if($('.filters').length>1){
			$(el).parent().parent().remove();
		}else{
			alert("At least one filter is required");
		}
	}
	
	function selected_option(el){
		var sel = $(el).val();
		
		if(sel==="rmks"){
			$(el).parent().siblings(".val").html($("#status").html());
		}else if(sel==="facClass"){
			$(el).parent().siblings(".val").html($("#factype").html());
		}else if(sel==="date" || sel==="treatDate" || sel==="reinstatementdate" || sel === "stmp"){
			$(el).parent().siblings(".val").children(0).attr("readonly","readonly");
			$(el).parent().siblings(".val").children(0).datepicker({format: 'yyyy-mm-dd'});
		}else{
			$(el).parent().siblings(".val").html($("#default").html());
		}
	}
	
	$("#btn_search").click(function(ev){
		var url = $("#frm_search").attr('action')
		var postData = $("#frm_search").serializeArray();
		$.ajax({
			url:url,
			data:postData,
			type:"POST",
			success:function(data, textStatus, jqXHR) 
		        {
		         	$("#wrapper").html(data);   
		        },
		    error: function(jqXHR, textStatus, errorThrown) 
		        {
		            alert(textStatus+' - '+ errorThrown);      
		        }
		});
		ev.preventDefault();
	});
	
	$("#reset").click(function(ev){
		var url = "<?php echo base_url();?>claims.php/medical/reset_filter";
		
		$.ajax({
			url:url,
			success:function(data, textStatus, jqXHR) 
		        {
		         	$("#filters").html(data);   
		        }
		});
		
		ev.preventDefault();
	});
	

	
</script>

<div id="status" style="display: none;">
    <select class="form-control" name="val[]">
    	<option value=""><?=get_phrase('select');?></option>
    	<option value="-1"><?=get_phrase('new');?></option>
    	<option value="0"><?=get_phrase('submitted');?></option>
    	<option value="2"><?=get_phrase('check_by_PF');?></option>
    	<option value="1"><?=get_phrase('declined_by_PF');?></option>
    	<option value="4"><?=get_phrase('processed_by_HS');?></option>
    	<option value="3"><?=get_phrase('declined_by_HS');?></option>
    	<option value="7"><?=get_phrase('paid');?></option>
    </select>
</div>


<div id="factype" style="display: none;">
    <select class="form-control" name="val[]">
    	<option value=""><?=get_phrase('select');?></option>
    	<option value="public"><?=get_phrase('public');?></option>
    	<option value="private"><?=get_phrase('private');?></option>
    	<option value="missionary"><?=get_phrase('missionary');?></option>
    </select>
</div>


<div id="default" style="display: none;">
	<input type="text" class="form-control" name="val[]" id=""/>
</div>
