<div class="row">
	<div class="col-sm-12">
		
			<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('claim_for_');?> <?=$claim->childName;?> (<?=$claim->incidentID;?>)</div>						
				</div>
										
				<div class="panel-body">
					
				    <div class="col-sm-12">
				        <?php echo form_open(base_url() . 'claims.php/partner/upload_medical_receipts/supportdocs/' , array('id'=>'','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
				            <div class="form-group">
				                <label class="control-label"><?=get_phrase("claim_ID");?></label>
				                <input type="text" class="form-control" readonly="readonly" name="claim_id" value="<?=$claim->rec;?>"/>
				            </div>
				            
				            <div class="form-group">
				                <label class="control-label">Choose Files</label>
				                <input type="file" class="form-control" name="userFiles[]" multiple/>
				            </div>
				            <div class="form-group">
				                <input class="form-control btn btn-primary" type="submit" name="fileSubmit" value="UPLOAD"/>
				            </div>
				        </form>
				 </div>
				 
				 <p></p>
				 
				    <div class="col-sm-12">
				        <ul class="gallery" style="list-style: none;">
				            <?php if(!empty($files)): foreach($files as $file): ?>
				            <li class="item">
				                <a href="<?=base_url();?>claims.php/partner/download/supportdocs/<?=$file['id'];?>" class="fa fa-file">
				                	<span><?php echo $file['file_name'];?></span>
				                </a>
				                
				            </li>
				            <?php endforeach; else: ?>
				            <p>Image(s) not found.....</p>
				            <?php endif; ?>
				        </ul>
				    </div>
				    
				  	<a href="<?=base_url();?>claims.php/medical/medical_claims" class="btn btn-red btn-icon"><i class="fa fa-arrow-left"></i><?=get_phrase('back');?></a>
					
					<a href="<?php echo base_url();?>claims.php/partner/ziparchive/supportdocs/<?php echo $claim->rec;?>/approval" class="btn btn-orange btn-icon"><i class="fa fa-cloud-download"></i>Download All</a>
					
				</div>
			</div>		
	</div>
</div>
<script>

	
</script>