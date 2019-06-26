<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-primary " data-collapsed="0">
	   <div class="panel-heading">
	    	<div class="panel-title">
		        <i class="fa fa-plus-circle"></i>
		            <?php echo get_phrase('add_links');?>
		    </div>
		</div>
		        
		<div class="panel-body"  style="max-width:50; overflow: auto;">
				<?php 
						echo form_open(base_url() . 'resources.php/admin/external_links/add/' , array('role'=>'form' ,'class' => 'form-horizontal form-groups-bordered validate form-groups-bordered','enctype' => 'multipart/form-data'));
					?>
					
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('link_name');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="link_name" id="link_name" value="" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('URL');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="url" id="url" value="" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('description');?></label>
							<div class="col-sm-8">
								<textarea class="form-control" name="description" id="description" placeholder="<?=get_phrase('enter_description_here');?>"></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('status');?></label>
							<div class="col-sm-8">
								<select class="form-control" name="status" id="status">
									<option value=""><?=get_phrase('select');?></option>
									<option value="0"><?=get_phrase('inactive');?></option>
									<option value="1" selected="selected"><?=get_phrase('active');?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('show_notification');?></label>
							<div class="col-sm-8">
								<select class="form-control" name="notify" id="notify">
									<option value=""><?=get_phrase('select');?></option>
									<option value="0" selected="selected"><?=get_phrase('no');?></option>
									<option value="1"><?=get_phrase('yes');?></option>
								</select>
							</div>
						</div>

						<input type="hidden" class="" name="owner" id="owner" value="<?=$this->session->login_user_id;?>" />

						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('group_access');?></label>
								<div class="col-sm-8">
									<select multiple="multiple" name="userlevels[]" class="form-control multi-select">
										
										<?php
											$userlevels = $this->db->get_where('positions',array('pstID<>'=>'0'))->result_object();
											
											foreach($userlevels as $row):
										?>
											<option value="<?=$row->pstID;?>" <?php if($this->session->logged_user_level == $row->pstID) echo "selected";?>><?=$row->dsgn;?></option>
										<?php
											endforeach;
										?>
									</select>
								</div>
						</div>
						
						
						<div class="form-group">
							<button class="btn btn-primary btn-icon"><i class="fa fa-plus-square-o"></i><?=get_phrase('add');?></button>
						</div>
					
					</form>
		</div>
				
	</div>
	</div>
</div>