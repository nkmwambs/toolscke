<style>
.blink {
  animation: blink-animation 1s steps(5, start) infinite;
  -webkit-animation: blink-animation 1s steps(5, start) infinite;
}
@keyframes blink-animation {
  to {
    visibility: hidden;
  }
}
@-webkit-keyframes blink-animation {
  to {
    visibility: hidden;
  }
}
</style>

<div class="row">
	<div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">

			<h2 style="font-weight:200; margin:0px;"><?php echo $system_name;?></h2>
    	
    </div>
</div> 

<hr /> 
	<!-- Raw Links -->
	<?php
		$switch_user_state = "";
		if($this->session->userdata('primary_user_id')!== $this->session->userdata('login_user_id')){
			$switch_user_state = "(".get_phrase('switched').")";
		}

	?>
<div class="row">	
	<div class="col-sm-6 pull-left">
		
       <?php
			$user_image = '<i class="entypo-user"></i>';
			if($this->db->get_where('users',array('ID'=>$this->session->login_user_id))->row()->picture_url!==""){
				$user_image = '<img width="25" class="img-circle" src="'.$this->db->get_where('users',array('ID'=>$this->session->login_user_id))->row()->picture_url.'" />';
			}
		?>
       <div class="btn-group">
          <button type="button" class="btn btn-default btn-sm dropdown-toggle <?php if($switch_user_state!=="") echo 'btn-danger';?>" data-toggle="dropdown">
                  <?=$user_image;?> <?php echo $this->session->userdata('name');?> - <?php echo $this->session->userdata('center_id');?> <?php echo $switch_user_state;?> 
                 <span class="caret"></span>
          </button>
              <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					<li>
						<a href="<?php echo base_url();?>admin.php/admin/manage_profile#list">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>                    	
					<li class='divider'></li>
					<li>
						<a href="<?php echo base_url();?>admin.php/admin/manage_profile#password">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
					<?php
						if($this->db->get_where('users',array('ID'=>$this->session->userdata('primary_user_id')))->row()->admin==="1"){
					?>
					<li class='divider'></li>
					<li>
						<a href="<?php echo base_url();?>admin.php/<?php echo $this->session->login_type;?>/users_list">
                        	<i class="fa fa-exchange"> </i>
							<span><?php echo get_phrase('switch_user');?></span>
						</a>
					</li>
					<li class='divider'></li>
					<li>
						<a href="<?php echo base_url();?>admin.php/admin/announcement">
                        	<i class="fa fa-bullhorn"> </i>
							<span><?php echo get_phrase('add_announcement');?></span>
						</a>
					</li>

					<?php
						}
					?>
               </ul>
       </div>
        
     </div>  
     
     <div class="col-sm-6"> 
		<ul class="list-inline links-list  pull-right">
			
			<li>
				<a href="<?php echo base_url();?>admin.php/login/logout">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
	</div>
	
</div>

<hr style="margin-top:0px;" />


<div class="row">
	<div class="col-xs-12">
	<?php 
		
		//print_r($announcements);
		if(count($active_announcements) > 0){
	?>
		<div class="panel panel-info" data-collapsed="1">
					
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title" style="border:4px #0066CC solid;font-size:12pt;color:#0066CC;border-radius: 5px;">
							<span class="blink" style="font-weight:bolder;"><?=get_phrase('announcements');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-danger"><?=count($active_announcements);?></span></span>
						</div>
						
						<div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div>
					</div>
					
					<!-- panel body -->
					<div class="panel-body">
						
							<?php 
								echo form_open('', array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
								
								foreach($active_announcements as $announcement){
							?>
									<div class='form-group'>
										<label class='col-xs-12'><?=$announcement['announcement_title'];?></label>
										<div class='col-xs-12'><?=$announcement['announcement_detail'];?></div>
									</div>
							<?php 
								}
							?>	
						</form>					
					</div>
					
				</div>
	</div>

	<?php 
		}
	?>
</div>
<hr style="margin-top:0px;" />
