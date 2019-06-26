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
						$link = $this->db->get_where('external_links',array('external_links_id'=>$param2))->row();
						echo form_open(base_url() . 'resources.php/admin/external_links/edit/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
					?>
					
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('link_name');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="link_name" id="link_name" value="<?=$link->link_name;?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('URL');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="url" id="url" value="<?=$link->url;?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('description');?></label>
							<div class="col-sm-8">
								<textarea class="form-control" name="description" id="description" placeholder="<?=get_phrase('enter_description_here');?>"><?=$link->description;?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('status');?></label>
							<div class="col-sm-8">
								<select class="form-control" name="status" id="status">
									<option value=""><?=get_phrase('select');?></option>
									<option value="0" <?php if($link->status=== '0') echo "selected";?>><?=get_phrase('inactive');?></option>
									<option value="1" <?php if($link->status=== '1') echo "selected";?>><?=get_phrase('active');?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('show_notification');?></label>
							<div class="col-sm-8">
								<select class="form-control" name="notify" id="notify">
									<option value=""><?=get_phrase('select');?></option>
									<option value="0" <?php if($link->notify=== '0') echo "selected";?>><?=get_phrase('no');?></option>
									<option value="1" <?php if($link->notify=== '1') echo "selected";?>><?=get_phrase('yes');?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?=get_phrase('group_access');?></label>
								<div class="col-sm-8">
									<select multiple="multiple" name="userlevels[]" class="form-control multi-select">
										
										<?php
											$userlevels = $this->db->get_where('positions',array('pstID<>'=>'0'))->result_object();
											
											foreach($userlevels as $row):
												
												$access = $this->db->get_where('links_group_access',array('userlevel'=>$row->pstID,'external_links_id'=>$link->external_links_id));
												$selected = "";
												if($access->num_rows()>0 ){
													$selected = "selected";
												}
										?>
											<option value="<?=$row->pstID;?>" <?=$selected;?>><?=$row->dsgn;?></option>
										<?php
											endforeach;
										?>
									</select>
								</div>
						</div>
						
						<div class="form-group">
							<button class="btn btn-primary btn-icon"><i class="fa fa-pencil-square"></i><?=get_phrase('edit');?></button>
						</div>
					
					</form>
		</div>
				
	</div>
	</div>
</div>