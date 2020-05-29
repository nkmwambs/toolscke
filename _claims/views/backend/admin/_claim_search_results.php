<?php
//echo $arr;
?>
<table class="table table-striped table-hover" id="table_export"  style="white-space: nowrap;">
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
							echo "<a href='".base_url()."medical/add_claim_rct/".$rows->rec."' class='btn btn-orange btn-icon'><i class='fa fa-cloud-upload'></i>".get_phrase('attach_receipt')."</a>";
						}else{
							echo "<a href='".base_url()."medical/add_claim_rct/".$rows->rec."' class='btn btn-green btn-icon'><i class='fa fa-cloud-download'></i>".get_phrase('download')."</a>";
						}
						

					?>
				</td>
				<td>
					<?php
						if(count($this->db->get_where('apps_files',array('file_group'=>$rows->rec,'upload_type'=>"approval"))->result_object())=== 0){
							echo "<a href='".base_url()."medical/add_claim_docs/".$rows->rec."' class='btn btn-orange btn-icon'><i class='fa fa-cloud-upload'></i>".get_phrase('attach_approval')."</a>";
						}else{
							echo "<a href='".base_url()."medical/add_claim_docs/".$rows->rec."' class='btn btn-green btn-icon'><i class='fa fa-cloud-download'></i>".get_phrase('download')."</a>";
						}
					?>
				</td>
				<td>
					<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- Submit Claim -->
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>medical/single_submit/<?php echo $rows->rec;?>');">
                            	<i class="fa fa-send"></i>
									<?php echo get_phrase('submit');?>
                               	</a>
                        </li>
                        <li class="divider"></li>
                        
                        <!-- Approve -->
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>medical/process_claim/<?php echo $rows->rec;?>');">
                            	<i class="fa fa-thumbs-o-up"></i>
									<?php echo get_phrase('process');?>
                               	</a>
                       	</li>
                       	
                       	<li class="divider"></li>
                       
                       <!-- Decline -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_decline_claim/<?php echo $rows->rec;?>');">
                            	<i class="fa fa-times-rectangle"></i>
									<?php echo get_phrase('decline');?>
                               	</a>
                       	</li>
                       	
                       	<li class="divider"></li>
                       	
                       	<!--View Comments-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_view_comments/<?php echo $rows->rec;?>');">
                            	<i class="fa fa-eye"></i>
									<?php echo get_phrase('view_comments');?>
                               	</a>
                       	</li> 
                       	
                       	<li class="divider"></li>
                       	
                       	<!--Edit-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>medical/edit_medical_claim/<?php echo $rows->rec;?>">
                            	<i class="fa fa-pencil-square-o"></i>
									<?php echo get_phrase('edit');?>
                               	</a>
                       	</li> 

                       	<li class="divider"></li>
                       	                       	
                       	<!--Delete-->
                       	
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>medical/delete_claim/<?php echo $rows->rec;?>');">
                            	<i class="fa fa-trash-o"></i>
									<?php echo get_phrase('delete');?>
                               	</a>
                       	</li>     
                       	
                       
                       <li class="divider"></li>
                       	                       	
                       	<!--Reinstate-->
                       	
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>medical/reinstate_claim/<?php echo $rows->rec;?>');">
                            	<i class="fa fa-reply"></i>
									<?php echo get_phrase('reinstate');?>
                               	</a>
                       	</li>                         	                       	                 	
                        
                                 	
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

<script>
		$(document).ready(function(){
		
		$("#table_export").tableHeadFixer({'left' : 7}); 
		
		$('#mass_submit').css('display','none');
		
	});
</script>