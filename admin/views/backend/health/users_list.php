<hr/>
<div class="row">
	<div class="col-sm-12">
		<?php
		
		$users = $this->db->get_where('users',array('auth'=>'1'))->result_object();
		
		$cond = " pstID ='1' OR pstID='2'";
		
		$userlevels = $this->db->where($cond)->get('positions')->result_object();
		
		//print_r($userlevels);
		
		echo form_open(base_url() . 'admin.php/health/switch_user/' , array('id'=>'frm_search','class' => 'form-vertical form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
		
		?>
		
		<div class="form-group">
			<label class="control-label col-sm-2"><?php echo get_phrase('choose_a_user');?></label>
			<div class="col-sm-6">
				<select class="form-control select2"  name="users_list" id="users_list" placeholder="<?php echo get_phrase('select_user');?>">
					<?php
						foreach($userlevels as $groups):
					?>	
						<optgroup label="<?php echo $groups->dsgn;?>">
						<?php
							foreach($users as $row):
								if($groups->pstID===$row->userlevel){
						?>
									<option value="<?php echo $row->ID;?>"><?php echo $row->userfirstname;?>
										
										<?php
											if($row->userlevel==='1' || $row->userlevel==='2'){
												echo  "("; 
												
										 			echo $row->cname;
										 		
										 		if($row->userlevel==='1'){
											 		echo  "-";
											 		
														echo $row->fname;
												}
										 		
										 		echo  ")";
											}
										?>
										
										</option>
						<?php
								}
							endforeach;
						?>
						</optgroup>
												
					<?php
						endforeach;
					?>
				</select>
			</div>
			
			<div class="col-sm-2">
				<button class="btn btn-success btn-icon"><i class="fa fa-exchange"></i><?php echo get_phrase('switch_user');?></button>
			</div>
		</div>
		
		</form>
		
		
	</div>
</div>

<script>

</script>