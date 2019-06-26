<?php
//print_r($this->session->userdata);

//echo "<br/>";

//print_r($_SESSION);

//echo "<br/>";

?>
<style>
	.switch_to_offline{
		background-color:green;
		color:white;
	}
	
	.switch_to_online{
		background-color:crimson;
		color:white;
	}
	
</style>
<hr />
<div class="row">
	<div class="col-md-8">
	<?php
		$mode	=	$this->db->get_where('settings' , array('type'=>'mode'))->row()->description;
		
		$toggle = get_phrase("switch_to_offline_mode");
		$class = "switch_to_offline";
		
		if($mode==='inactive'){
			$toggle = get_phrase("switch_to_online_mode");
			$class = "switch_to_online";
		}
		
	?>
		<button class="btn btn-icon <?=$class;?>" id="toggle_mode"><i class="fa fa-switch"></i><?=$toggle;?></button>	
	</div>
</div>

<hr />
	
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="panel panel-primary " data-collapsed="0">
		       <div class="panel-heading">
		           <div class="panel-title">
		              <i class="fa fa-gift"></i>
		                 <?php echo get_phrase('accessible_applications_for_').' '.$this->session->userdata('name');?>
		           </div>
		       </div>
		        
		       	<div class="panel-body"  style="max-width:50; overflow: auto;">
				    	<?php

				    		$this->db->join('apps','apps.apps_id=access.apps_id');	
				    		$accessed_apps = $this->db->get_where('access',array('level'=>$this->session->logged_user_level,'access.status'=>'1','apps.status'=>'1'))->result_object();
							
							if($this->db->get_where('users',array('ID'=>$this->session->primary_user_id))->row()->userlevel === '9'){
								$accessed_apps = $this->db->get_where('access',array('level'=>$this->session->logged_user_level))->result_object();
							}
							
							foreach($accessed_apps as $app):
				    		
							$app_key = $this->db->get_where('apps',array('apps_id'=>$app->apps_id))->row()->name;
							//echo $app_key;
							$app_given_name = $this->db->get_where('apps',array('apps_id'=>$app->apps_id))->row()->app_given_name;
							
							$app_desc = $this->db->get_where('apps',array('apps_id'=>$app->apps_id))->row()->app_description;
							
							$apps_id = $this->db->get_where('apps',array('apps_id'=>$app->apps_id))->row()->apps_id;
							
							$icon = $this->db->get_where('apps',array('apps_id'=>$app->apps_id))->row()->icon;//base_url()."uploads/apps/app.png";
							
							//if(file_exists("uploads/apps/".$apps_id.".jpg")){
								//$icon = base_url()."uploads/apps/".$apps_id.".jpg";
							//}
							
				    	?>
				    		
				    		<div class="col-sm-3">
				    			<div class="col-sm-12" >
				    				<a class="btn btn-primary" target="_blank" href="<?php echo base_url();?><?php echo $app_key;?>.php/login/validate_login/<?php echo $this->session->userdata('login_user_id');?>/<?php echo $app_key;?>"><i class="fa fa-<?php echo $icon;?> fa-3x" title="<?=ucfirst($app_desc);?>"></i></a>
				    			</div>
				    			<div class="col-sm-12" style="margin-bottom: 25px;">
				    				<span><?=ucfirst($app_given_name);?></span>
				    			</div>
				    		</div>
				    	
				    	    	
				    	<?php
				    		endforeach;
				    	?>    	
				
				    	
				</div>
				    
			</div>
			
		</div>
	<?php
		
		$accessible=$this->db->get_where('access',array('level'=>$this->session->logged_user_level,'status'=>'1'))->num_rows();
		
		$available = $this->db->get_where('access',array('level'=>$this->session->logged_user_level))->num_rows();
		
		$app_view_dif = $accessible-$available;
		
		if($this->session->logged_user_level==='9' && $app_view_dif!==0){
	?>		
		<!--<div class="row">
			<div class="panel panel-primary " data-collapsed="0">
			      <div class="panel-heading">
			          <div class="panel-title">
			             <i class="fa fa-gift"></i>
			                <?php echo get_phrase('available_applications_for_').' '.$this->session->userdata('name');?>
			         	</div>
				  </div>
				        
				 <div class="panel-body"  style="max-width:50; overflow: auto;">
				       	<?php
				    				
				    		$available_apps = $this->db->get_where('access',array('level'=>$this->session->logged_user_level))->result_object();
				
							foreach($available_apps as $app):
				    		
							$app_key = $this->db->get_where('apps',array('apps_id'=>$app->apps_id))->row()->name;
							
							$apps_id = $this->db->get_where('apps',array('apps_id'=>$app->apps_id))->row()->apps_id;
							
							$icon = $this->db->get_where('apps',array('apps_id'=>$app->apps_id))->row()->icon;//base_url()."uploads/apps/app.png";
							

							
				    	?>
				    	
				    	    	
				    		<div class="col-sm-3">
				    			<div class="col-sm-12" >
				    				<a class="btn btn-primary" target="_blank" href="<?php echo base_url();?><?php echo $app_key;?>.php/login/validate_login/<?php echo $this->session->userdata('login_user_id');?>/<?php echo $app_key;?>"><i class="fa fa-<?php echo $icon;?>" title="<?=ucfirst($app_desc);?>"></i></a>
				    			</div>
				    			<div class="col-sm-12" style="margin-bottom: 25px;">
				    				<span><?=ucfirst($app_given_name);?></span>
				    			</div>
				    		</div>
				    			
				    	<?php
				    		endforeach;
				    	?>
				 </div>	
			</div>	
		</div>-->
	<?php
		}
	?>	

</div>
    
	<div class="col-md-4">
		<div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->admin_model->online_user_count();?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('logged_users');?></h3>

                </div>
                
            </div>

    	</div>
    </div>
	


</div>
  
<script>
	
	
	$('#toggle_mode').on('click',function(e){
		$('#toggle_mode').toggleClass('switch_to_offline switch_to_online');
		
		$('#toggle_mode').html('<?=get_phrase("switch_to_online_mode");?>');
		
		var btn_mode = 'inactive';
		
		if($('#toggle_mode').hasClass('switch_to_offline')){
			$('#toggle_mode').html('<?=get_phrase("switch_to_offline_mode");?>');
			var btn_mode = 'active';
		}
		
		var url ="<?=base_url();?>admin.php/admin/switch_mode/"+btn_mode;
		
		var cfrm = confirm('Are you sure you want to switch the mode?');
		if(!cfrm){
			alert('Process aborted');
			return false;
		}
		$.ajax({
			url:url,
			success:function(response){
				//alert(response);
			}
		});
		
	});
</script>