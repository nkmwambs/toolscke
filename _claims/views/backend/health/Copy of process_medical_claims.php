<hr />

<div id="process_panel">
<div class="row">
			<div class="col-sm-3">
			
				<div class="tile-title tile-primary">
					
					<div class="icon">
						<i class="glyphicon glyphicon-leaf"></i>
					</div>
					
					<div class="title">
						<h3>Big Center Tile</h3>
						<p>so far in our blog, and our website.</p>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-red">
					
					<div class="icon">
						<i class="glyphicon glyphicon-lock"></i>
					</div>
					
					<div class="title">
						<h3>Big Center Tile</h3>
						<p>so far in our blog, and our website.</p>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-blue">
					
					<div class="icon">
						<i class="glyphicon glyphicon-link"></i>
					</div>
					
					<div class="title">
						<h3>Big Center Tile</h3>
						<p>so far in our blog, and our website.</p>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-3">
			
				<div class="tile-title tile-aqua">
					
					<div class="icon">
						<i class="glyphicon glyphicon-random"></i>
					</div>
					
					<div class="title">
						<h3>Big Center Tile</h3>
						<p>so far in our blog, and our website.</p>
					</div>
				</div>
				
			</div>
		</div>

<?php foreach($claims as $claim): ?>

<div id="member-entry_<?=$claim['details']->rec;?>" class="member-entry">
				
			<a href="#entry_<?=$claim['details']->rec;?>" class="member-img">
				<div class="row">
					<div class="col-xs-12">
						<div class="btn-group">
							<?php if(isset($claim['docs']['receipt'])){?> 
								<div class="btn btn-default fa fa-money" onclick="showAjaxModal('<?=base_url();?>claims.php/modal/popup/modal_document_review/<?=$claim['details']->rec;?>/<?=$claim['docs']['receipt'];?>/receipt');"></div>
							<?php }?>
							
							<?php if(isset($claim['docs']['approval'])){?> 
								<div class="btn btn-default fa fa-book" onclick="showAjaxModal('<?=base_url();?>claims.php/modal/popup/modal_document_review/<?=$claim['details']->rec;?>/<?=$claim['docs']['approval'];?>/approval');"></div>
							<?php }?>
						</div>
					</div>
				</div>
				
				<br />
				
				<div class="row">
					<div class="col-xs-12">
						<div class="btn-group">
							<div id="approve_<?=$claim['details']->rec;?>" class="btn btn-default fa fa-thumbs-up approve_btn"></div>
							<div id="declined_<?=$claim['details']->rec;?>" class="btn btn-default fa fa-thumbs-down decline_btn"></div>
						</div>
					</div>
				</div>
				
				<br />
				
				<div class="row">
					<div class="col-xs-12">
						<div class="btn btn-default fa fa-plus"></div>
					</div>
				</div>		
				
			</a>
			
			<div id="entry_<?=$claim['details']->rec;?>" class="member-details">
				<h4>
					<a href="extra-timeline.html"><?=$claim['details']->childNo.' : '.$claim['details']->childName;?> (<?=$claim['details']->status;?>)</a>
				</h4>
				
				<!-- Details with Icons -->
				<div class="row info-list">
					
					<div class="col-sm-4">
						<i class="entypo-star"></i>
						# Record ID: <a href="#"><?=number_format($claim['details']->rec);?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-home"></i>
						Facility: <a href="#"><?=$claim['details']->facName.' ('.$claim['details']->facClass.')';?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-calendar"></i>
						<a href="#">Claim Date: <?=date('jS F Y',strtotime($claim['details']->claimDate));?></a>
					</div>
					
					<div class="clear"></div>
					
					<div class="col-sm-4">
						<i class="entypo-briefcase"></i>
						Reimbursed Amount <a href="#"><?=number_format($claim['details']->amtReim,2);?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-reply"></i>
						Reimbursed Claimed <a href="#"><?=number_format($claim['details']->totAmt,2);?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-switch"></i>
						Contribution: <a href="#"><?=number_format($claim['details']->careContr,2);?></a>
					</div>
					
					<div class="clear"></div>
					
					<div class="col-sm-4">
						<i class="entypo-location"></i>
						Cluster: <a href="#"><?=$claim['details']->cluster;?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-mail"></i>
						Diagnosis: <a href="#"><?=$claim['details']->diagnosis;?></a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-linkedin"></i>
						Incident ID: <a href="#"><?=$claim['details']->incidentID;?></a>
					</div>
					
					<div class="clear"></div>
					
					<div class="col-sm-12" style="font-size: 25pt;text-align: right;">
						<i class="entypo-chat"></i>
						
					</div>
					
				</div>
			</div>
			
		</div>
	<?php endforeach;?>	

</div>	

<div class="row">
	<div class="col-xs-12" style="text-align: center;">
		<div class="btn btn-default fa fa-refresh" id="refresh"></div>
	</div>
</div>


	
<script>
	
	$(".approve_btn, .decline_btn").on('click',function(){
		var rec = $(this).attr('id').split("_")[1];
		
		var color;
		
		var url;
		alert(rec);
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
		};)
		
		
		
	});
	
	$("#refresh").on('click',function(){
		
		var url = '<?=base_url();?>claims.php/health/update_processing'
		
		$.ajax({
			url:url,
			success:function(resp){
				$("#process_panel").html(resp);
				$("#overlay").css('display','none'); 
			}
		});
		
	});
</script>