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
		<div class="panel panel-info" data-collapsed="1">
					
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title" style="border:4px #0066CC solid;font-size:12pt;color:#0066CC;border-radius: 5px;"><span class="blink" style="font-weight:bolder;"><?=get_phrase('compassion_connect_clean_up_reports');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-warning" style="font-size:25px;color:red"></i></span></div>
						
						<div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div>
					</div>
					
					<!-- panel body -->
					<div class="panel-body">
						
						<table class="table table-striped">
		       			<thead>
		       				<tr>
		       					<th><?=get_phrase('link_name');?></th>
		       					<th><?=get_phrase('description');?></th>
		       					<th><?=get_phrase('your_last_visit');?></th>
		       					<th><?=get_phrase('visits_count');?></th>

		       				</tr>
		       			</thead>
		       			<tbody>
		       				<?php
		       					
		       					$this->db->where(array('links_group_access.status'=>'1','notify'=>'1','external_links.status'=>'1','links_group_access.userlevel'=>$this->session->logged_user_level));
								
								
		       					$links = $this->db->join('links_group_access','links_group_access.external_links_id=external_links.external_links_id')->get('external_links')->result_object();
								
								
								foreach($links as $row):
									
									$visits = $this->db->get_where('visited_notifications',array('link_id'=>$row->external_links_id,'user_id'=>$this->session->login_user_id))->row();
		       				?>
		       					<tr>
		       						<td><a onclick="track_clicks('<?=$row->external_links_id;?>');" href="<?=$row->url;?>" target="__blank"><?=$row->link_name;?></a></td>
		       						<td><?=$row->description;?></td>
		       						<td><?=$visits->visited_date;?></td>
		       						<td><?=$visits->visit_count;?></td>

		       					</tr>
		       				
		       				<?php
		       					endforeach;
		       				?>
		       				
		       			</tbody>
		       			
		       		</table>
						
					</div>
					
				</div>
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