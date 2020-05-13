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
              <ul class="dropdown-menu dropdown-default pull-left" role="menu">
					<!-- <li>
						<a href="<?php echo base_url();?>admin.php/admin/manage_profile#list">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>  -->                   	

					<li>
						<a href="<?php echo base_url();?>admin.php/admin/manage_profile#password">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
					<?php
						if($this->db->get_where('users',array('ID'=>$this->session->userdata('primary_user_id')))->row()->admin==="1"){
					?>
					<li>
						<a href="<?php echo base_url();?>admin.php/<?php echo $this->session->login_type;?>/users_list">
                        	<i class="fa fa-exchange"> </i>
							<span><?php echo get_phrase('switch_user');?></span>
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
	<div class="col-sm-12">
	
	</div>
</div>
<hr style="margin-top:0px;" />

<script>
	function track_clicks(link_id){
		//alert(link_id);
		var url = '<?=base_url();?>admin.php/admin/track_clicks/'+link_id;
		$.ajax({
			url:url,
			success:function(resp){
				//alert(resp);
			}
		});
	}
</script>