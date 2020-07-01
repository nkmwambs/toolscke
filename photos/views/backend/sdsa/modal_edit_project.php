<?php
$project = $this->db->get_where('projects',array('projects_id'=>$param2))->row();
?>

<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('add_project');?></div>						
				</div>
										
				<div class="panel-body">
					<?php echo form_open(base_url() . 'photos.php/sdsa/projects/edit_project/'.$param2 , array('id'=>'frm_profile','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('project_name');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pname" id="pname" value="<?=$project->name;?>"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('project_number');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="num" id="num"  value="<?=$project->name;?>"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('link_partner');?></label>
							<div class="col-sm-8">
								<select id="partner" name="partner"  class="form-control">
									<option><?=get_phrase('select');?></option>
									<?php
										$partners = $this->db->get_where('users',array('userlevel'=>'1','department'=>'0'))->result_object();	
										foreach($partners as $rows):
									?>
										<option value="<?=$rows->ID;?>" <?php if($rows->ID===$project->partner) echo "selected";?>><?=$rows->fname.' - '.$rows->lname;?></option>
									<?php
										endforeach;
									?>
								</select>
							</div>
						</div>
						
											
						<div class="form-group">
							<button class="btn btn-success btn-icon col-sm-offset-6"><i class="fa fa-pencil-square-o"></i><?php echo get_phrase('edit_project');?></button>
						</div>
						
					</form>
				</div>
			</div>
		</div>
</div>