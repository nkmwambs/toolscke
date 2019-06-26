<div class="row">
		<div class="col-md-12">
                
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-upload"></i>
                            <?php echo get_phrase('import_budget');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<?php 
							echo form_open(base_url() . 'ifms.php/admin/opening_uploads/import_budget/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
						?>

						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('download_template');?></label>
							<div class="col-sm-8">
								<a href="<?=base_url();?>ifms.php/admin/download_upload_templates/budget_schedule/" ><i class="fa fa-file-excel-o"></i> <?=get_phrase('download_budget_template');?></a>
							</div>
						</div>						
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('fiscal_year');?></label>
							<div class="col-sm-8">
								<?php
									$fiscal = get_fy(date('Y-m-d'));
									
									$fy_range = range($fiscal-5,$fiscal+5);
								?>
								<select class="form-control" name="fy" id="fy">
									<option><?=get_phrase('select');?></option>
								<?php
									foreach($fy_range as $row):
								?>
									<option value="<?=$row;?>"><?=get_phrase('FY');?> <?=$row;?></option>
								<?php
									endforeach;
								?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('upload_file');?></label>
							<div class="col-sm-8">
								<input class="form-control" type="file" name="userfile" id="userfile"/>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-primary btn-icon"><?=get_phrase('upload');?></button>
							</div>
						</div>
						
						</form>
					</div>
				</div>
		</div>
</div>					