<?php
//echo count($claims);
?>
<div class="row">
	<div class="col-xs-12">
		<span id="json_debug"></span>
	</div>
</div>
<div class="row">
			<div class="col-sm-3">
			
				<div class="tile-title tile-primary">
					
					<div class="icon">
						<i class="glyphicon glyphicon-leaf"></i>
					</div>
					
					<div class="title">
						<h3><?=$processed;?></h3>
						<p>Processed claims so far in our system.</p>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-red">
					
					<div class="icon">
						<i class="glyphicon glyphicon-lock"></i>
					</div>
					
					<div class="title">
						<h3><?=$queued;?></h3>
						<p>claims queued for processing so far in our system.</p>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-blue">
					
					<div class="icon">
						<i class="glyphicon glyphicon-link"></i>
					</div>
					
					<div class="title">
						<h3><?=$submitted;?></h3>
						<p>claims submitted so far in our system.</p>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-aqua">
					
					<div class="icon">
						<i class="glyphicon glyphicon-random"></i>
					</div>
					
					<div class="title">
						<h3><?=$reinstated?></h3>
						<p>claims reinstated so far in our system.</p>
					</div>
				</div>
				
			</div>
		</div>

<?php $claim = array_shift($claims);?>

<div id="member-entry_<?=$claim['details']->rec;?>" class="member-entry">
			
			<div class="row">
				<div id="entry_<?=$claim['details']->rec;?>" class="col-xs-12 member-details">
					<h4>
						<a href="extra-timeline.html"><?=$claim['details']->childNo.' : '.$claim['details']->childName;?> (<?=$claim['details']->status;?>)</a>
					</h4>
				</div>	
			</div>				
			
			<hr />
				<!-- Details with Icons -->
				<div class="row info-list">
					
					<div class="col-xs-6">
						
						<div class="panel minimal minimal-gray">
					
							<div class="panel-heading">
								<div class="panel-title"><h4>Receipts and Approval Document</h4></div>
								<div class="panel-options">
									
									<ul class="nav nav-tabs">
										<li class="active"><a href="#receipt" data-toggle="tab">Receipt</a></li>
										<?php
											if(isset($claim['docs']['approval'])){
										?>
											<li><a href="#approvaldoc" data-toggle="tab">Approval Document <span class="badge badge-secondary badge-roundless">1</span> </a></li>
										<?php
											}
										?>
									</ul>
								</div>
							</div>
							
							<div class="panel-body">
								
								<div class="tab-content">
									<div class="tab-pane active" id="receipt">
										<?php
											echo "<iframe style=\"height:400px;\" src=\"".base_url()."/uploads/document/medical/claims/".$claim['details']->rec."/".$claim['docs']['receipt']."\" width=\"100%\" style=\"height:150%\"></iframe>";
										?>
									</div>
									<?php
										if(isset($claim['docs']['approval'])){
									?>
										<div class="tab-pane" id="approvaldoc">
											<?php
												echo "<iframe style=\"height:400px;\" src=\"".base_url()."/uploads/document/medical/claims/".$claim['details']->rec."/".$claim['docs']['approval']."\" width=\"100%\" style=\"height:100%\"></iframe>";
											?>
										</div>
									<?php			
										}
									?>
									
									
								</div>
							</div>
						</div>			
							

					</div>
					
					<div class="col-xs-6">
						<div class="panel panel-gray" data-collapsed="0">	
							<div class="panel-heading">
								<div class="panel-title">Claim Details: <?=$claim['details']->rec;?></div>
							</div>
								
							<!-- panel body -->
							<div class="panel-body">
								<?php echo form_open('' , array('id'=>'','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

									<div class="form-group">
										<label class="control-label col-xs-3">Claimed Amount::</label>
										<div class="col-xs-3">
											<?=number_format($claim['details']->totAmt,2);?>
										</div>
										
										<label class="control-label col-xs-3">Contribution:</label>
										<div class="col-xs-3">
											 <?=$claim['details']->careContr;?>
										</div>
										
									</div>
									
									<div class="form-group">
										<label class="control-label col-xs-3">Rembursable Amount:</label>
										<div class="col-xs-3">
											<?=number_format($claim['details']->amtReim,2);?> 
										</div>
										
										<label class="control-label col-xs-3">Rembursable Amount:</label>
										<div class="col-xs-3">
											<?=number_format($claim['details']->amtReim,2);?> 
										</div>
										
									</div>
									
									<div class="form-group">
										<div class="col-xs-12">
											<div class="btn btn-default">Approve <i class="fa fa-check"></i></div>
											<div class="btn btn-default" id="decline_btn">Decline <i class="fa fa-times"></i></div>
											<div class="btn btn-default" id="">Claim Notes <i class="entypo-chat"></i></div>
										</div>
									</div>
									
									<div class="form-group hide decline_related_elements">
										<div class="col-xs-12">
											<textarea placeholder="Reason for declining" class="form-control"></textarea>
										</div>
									</div>
									
									<div class="form-group hide notes_related_elements">
										<div class="col-xs-12">
											Test
										</div>
									</div>	
									
									<div class="form-group hide decline_related_elements">
										<div class="col-xs-12">
											<div class="btn btn-default">Complete Decline <i class="fa fa-times"></i></div>
										</div>
									</div>	

								</form>	
							</div>
						</div>	
							
					</div>
					
					
					
				</div>
			
			
		</div>
<?php
echo count($claims);
?>		
	
<script>
	
	$(document).ready(function(){
		var claims_json_string = <?=$json_claims;?>;
		
		$("#json_debug").html(claims_json_string['1010']['details'].rec);
	});
	
	$("#decline_btn").on('click',function(){
		$(".decline_related_elements").removeClass('hide');
		$(this).addClass('hide');
	});
	
	$(".approve_btn, .decline_btn").on('click',function(){
		var rec = $(this).attr('id').split("_")[1];
		
		var color;
		
		var url;
		
		if($(this).hasClass('approve_btn')){
			color = 'green';
			
			url = "<?=base_url();?>claims.php/health/process_claim_no_redirect/"+rec;
			
		}  else {
			color = 'red';
		}
		
		$.ajax({
				url:url,
				success:function(resp){
					$("#overlay").css('display','none'); 
					//alert(resp);
					if(resp == 1) {
						$('#member-entry_'+rec).css('border','solid '+color+' 2px');
					}else{
						alert('Action failed');
					}
					
				}
		})
		
		
		
	});
	

</script>