<?php
//echo $this->uri->segments['4'];
//echo $this->session->userdata('locate');
//echo $this->session->userdata('status');
//echo $this->session->userdata('per_page');
?>

<style>

	ul.gallery {
    clear: both;
    float: left;
  	width: 100%;
   /**margin-bottom: -10px;**/
    padding-left: 3px;
}
ul.gallery li.item {
    width: 30%;
    height: 200px;
    display: block;
    float: left;
    margin: 0px 15px 55px 0px;
    font-size: 12px;
    font-weight: normal;
    background-color: d3d3d3;
   /**padding: 10px;**/
    box-shadow: 10px 10px 5px #888888;
}

ul.gallery li.item img{
/**max-width:100%;**/
	margin: 15px 5px 5px 20px;
}

ul.gallery li.item .buttons{
	margin-top: 15px;
	display: inline-block;
}


ul.gallery li.item .details{
	width: 50%; 
/**height: 184px;**/
	position: relative;
	float:right;
	padding:10px;
	box-shadow: 10px 10px 5px #888888;
	margin:10px 10px 5px;
	border:1px outset ;
	}



#pagination{
	position: relative;
	padding-top: 40px;
	display: inline-block;
}

ul.tsc_pagination li a
{
	border:solid 1px;
	border-radius:3px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	padding:6px 9px 6px 9px;
}
ul.tsc_pagination li
{
	padding-bottom:1px;
	
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
	color:#FFFFFF;
	box-shadow:0px 1px #EDEDED;
	-moz-box-shadow:0px 1px #EDEDED;
	-webkit-box-shadow:0px 1px #EDEDED;
}
ul.tsc_pagination
{
	margin:4px 0;
	padding:0px;
	height:100%;
	overflow:hidden;
	font:12px 'Tahoma';
	list-style-type:none;
}
ul.tsc_pagination li
{
	float:left;
	margin:0px;
	padding:0px;
	margin-left:5px;
	
}
ul.tsc_pagination li a
{
	color:black;
	display:block;
	text-decoration:none;
	padding:7px 10px 7px 10px;
}
ul.tsc_pagination li a img
{
	border:none;
}
ul.tsc_pagination li a
{
	color:#0A7EC5;
	border-color:#8DC5E6;
	background:#F8FCFF;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
	text-shadow:0px 1px #388DBE;
	border-color:#3390CA;
	background:#58B0E7;
	background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
	background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
}

.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
.toggle.ios .toggle-handle { border-radius: 20px; }
  
</style>

<?php


?>

<button data-toggle="collapse" class="btn btn-success" data-target="#panel">Show/ Hide Panel</button>

<hr>

<div id="panel" class="collapse">

        <div class="row">
        	  <div class="col-sm-6">
        	  	<form action="<?php echo base_url();?>index.php?sdsa/search_photo" method="post" id="frm_search">
	        		<div class="form-group">
	        		<label class="control-label col-sm-12">Search By ICP</label>
	        		
	        		 	<?php
	            			$projects = $this->db->get_where('projects',array('sdsa'=>$this->session->userdata('login_user_id')))->result_object();
	            		?>
	            	<div class="col-sm-12">
	                    <select class="form-control" name="project" id="project_number"/>
	                    	<option><?php echo get_phrase('select');?></option>
	                    <?php foreach($projects as $opts){?>
	                    	<option value="<?php echo $opts->name;?>" <?php if($opts->name===$this->session->userdata('locate')) echo 'selected';?>><?php echo $opts->name;?></option>
	                    <?php }?>
	                    </select>
	                 </div>   
	        		</div>
	        		
	        		
	        		<div class="form-group">
				        <label class="control-label col-sm-12">Show Status</label>
				        <!--<input type="checkbox" id="rejected_img" data-toggle="toggle" data-size="normal" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" value="0">-->
				         <?php 
				         	$selected = "selected";
							
							if(!isset($select_status)){
								$select_status = $this->session->userdata('status');
							}
				         ?>
				        <div class="col-sm-12">
				        	<select name="status" class="form-control">
				        	  	<option value=""><?php echo get_phrase('select');?></option>
				        	  	<option value="1" <?php if($select_status==='1') echo $selected;?>><?php echo get_phrase('new');?></option>
				        	  	<option value="2" <?php if($select_status==='2') echo $selected;?>><?php echo get_phrase('accepted');?></option>
				        	  	<option value="3" <?php if($select_status==='3') echo $selected;?>><?php echo get_phrase('rejected');?></option>
				        	  	<option value="4" <?php if($select_status==='4') echo $selected;?>><?php echo get_phrase('reinstated');?></option>
				        	  	<!--<option value="5" <?php if($select_status==='5') echo $selected;?>><?php echo get_phrase('deleted');?></option>-->
				      		</select>
				      </div>
	        		
	        		<div class="form-group">
	                   <div class="col-sm-12">
	                   	 <input class="form-control btn btn-primary" type="submit" name="search" value="Search"/>
	                   </div>
	                </div>
	        	</form>
	        </div>		
        	</div>
        	  
        	  <div class="col-sm-6">
        	  	
        	  	<div class="row">
        	  		
        	  	<div class="col-sm-6">
        	  		<label class="control-label">Select Photos</label>
        	  		<input type="checkbox" id="select_img" data-toggle="toggle" data-size="normal" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" value="0">
        	  	</div>
        	  	
        	  	<div class="col-sm-6">
        	  		<!--<div id="download_all" class="btn btn-blue btn-icon"><i class="fa fa-download"></i>Action</div>-->
        	  		
        	  		<div class="btn-group">
			                    <button id="" style="width: 100px;" type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown">
			                        Action <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
	
			                        <!-- Accept Selected Images -->
			                        <li>
			                        	<a href="#" id="accept_selected" onclick='return image_action("accept_selected");' class="mass_action">
			                            	<i class="fa fa-check"></i>
												<?php echo get_phrase('accept_selected');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>

									
			                        <!--Reject selected Images -->
			                        <li>
			                        	<a href="#" id="reject_selected" onclick='return image_action("reject_selected");'  class="mass_action">
			                            	<i class="fa fa-close"></i>
												<?php echo get_phrase('reject_selected');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
			                       	
			                       	<!-- Reinstate Selected Images -->
			                       	
			                       	  <li>
			                        	<a href="#" id="reinstate_selected" onclick='return image_action("reinstate_selected");'  class="mass_action">
			                            	<i class="fa fa-refresh"></i>
												<?php echo get_phrase('reinstate_selected');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
			                       	
			                       	<!-- Delete Selected Images -->
			                       	
			                       	  <li>
			                        	<a href="#" id="del_selected" onclick='return image_action("del_selected");'  class="mass_action">
			                            	<i class="fa fa-trash-o"></i>
												<?php echo get_phrase('delete_selected');?>
			                               	</a>
			                       	</li>
			                       	
									<li class="divider"></li>
												                       	
			                       	<!--Download Selected Images -->
			                        <li>
			                        	<a href="#" onclick='return image_action("download_selected");' id="download_selected"  class="">
			                            	<i class="fa fa-download"></i>
												<?php echo get_phrase('download_selected');?>
			                               	</a>
			                       	</li>
			                       	
			                       
			                     </ul>
			                     </div>
        	  		
        	  		
        	  		
        	  	</div>
        	  	
        	  	</div>
        	  	
        	  	<hr>
        	  	
		        <div class="row">
		        		<div class="col-sm-12">
				             <a class="btn btn-success btn-icon" href="<?php echo base_url();?>index.php?sdsa/download_accepted/<?php echo $project_num;?>/2"  id="download_accepted"  class="mass_action">
				                <i class="fa fa-chevron-circle-down"></i>
									<?php echo get_phrase('download_accepted');?>
				             </a>
			             </div> 
		        </div>
        	  	
        	  	
        	  </div>
        </div>
        
        

        
       </div> 
        <!-- Panel End-->
        
        <hr>
        
        <div class="row">
        <div class="col-sm-12">
        	 <?php 
        		if(!empty($results)): 
			?>
        	<div class="row" style="font-weight: bolder;">
        		<div class="well well-sm"><?php echo $project_num.' : '.ucfirst($this->db->get_where('status',array('status_id'=>$this->session->userdata('status')))->row()->name).' '.get_phrase('photos');?>
        			 (Showing <?= count($results);?> Out of <?php echo $this->db->get_where('files',array('group'=>$project_num,'status'=>$this->session->userdata('status')))->num_rows();?>)
        		</div>
        	</div>
            <div class="row">
            
            <!--<form id="frm_image_action" action="" method="post">-->
            <?php echo form_open('' , array('id'=>'frm_image_action','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
			

            			<div class="form-group">
            			<div class="col-sm-2">
            				
            			<?php
            				//$per_page_selected = "selected";
							
							if(!isset($select_per_page)){
								$select_per_page = $this->session->userdata('per_page');
							}
            			?>
            			
            			<select name="per_page" id="per_page" class="form-control" onchange="return change_page();">
            				<option value="3"><?php echo get_phrase('select');?></option>
            				<option value="6" <?php if($select_per_page==='6') echo 'selected';?>>6</option>
            				<option value="12" <?php if($select_per_page==='12') echo 'selected';?>>12</option>
            				<option value="24" <?php if($select_per_page==='24') echo 'selected';?>>24</option>
            				<option value="48" <?php if($select_per_page==='48') echo 'selected';?>>48</option>
            				<option value="96" <?php if($select_per_page==='96') echo 'selected';?>>96</option>
            			</select>
            			</div> 
            			<label class="control-label col-sm-2">Photos Per Page</label>
            			
            		</div>
            		
            		
            		
                <ul class="gallery">
                 	<?php 
                 		foreach($results as $file):
                 	?>
                 
                    <li class="item">
                    	<?php
							$file_path = base_url().'uploads/photos/'.$project_num.'/'.$file->file_name;
							$image = getimagesize($file_path);
							$type = explode("/",$image['mime']);
							$file_name = basename(base_url().'uploads/photos/'.$project_num.'/'.$file->file_name);
							$file_arr = explode('.', $file_name);
							$file_base = $file_arr['0'];
						?>
                        <!--<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_full_photo/<?php echo $file->id;?>');"><img src="<?php echo base_url();?>uploads/photos/<?php echo $project_num;?>/<?php echo $file->file_name;?>" alt="" ></a>-->
                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_full_photo/<?php echo $file->id;?>');"><?php echo thumbnail('uploads/photos/'.$project_num.'/'.$file->file_name, 100, 100 ); ?></a>
                        	<div class="details">
                        		<caption style="font-weight: bold;"><u><?php echo get_phrase('properties');?></u></caption><br>
                        		
                        			<span style="font-weight: bold;"><?php echo get_phrase('Width');?>:</span><?php echo $image['0'];?><br>
                        			<span style="font-weight: bold;"><?php echo get_phrase('Height');?>:</span><?php echo $image['1'];?><br>
                        			<span style="font-weight: bold;"><?php echo get_phrase('Size');?>:</span><?php echo human_filesize(filesize('uploads/photos/'.$project_num.'/'.$file->file_name));?><br>
                        			<span style="font-weight: bold;"><?php echo get_phrase('Type');?>:</span><?php echo $type['1'];?><br>
                        			<span style="font-weight: bold;"><?php echo get_phrase('File');?>:</span><?php  echo $file_base;?><br>
                        			<span style="font-weight: bold;"><?php echo get_phrase('date');?>:</span><?php echo date("j M Y",strtotime($file->created)); ?>
                        		
                        	</div>
                        	<!--<p>Uploaded On <?php echo date("j M Y",strtotime($file->created)); ?></p>-->                        
                        <div class="buttons">
                        	<input style="width: 15px;" name="image[<?php echo $file->id;?>]" class="form-control pull-left get_img" type="checkbox" value="<?php echo $file_name;?>"/> 
                        	
                        	<?php
                        		if($this->session->userdata('status')!=='2'){
                        	?>
                        	<div class="btn btn-success btn-icon btn-sm"  onclick="return accept_photo('<?php echo $file->id;?>');"><i class="fa fa-thumbs-o-up"></i>Accept</div>
                        	
                        	<?php
								}
                        	?>
                        	
                        	<?php
                        		if($this->session->userdata('status')==='3'){
                        	?>
                        		<div class="btn btn-info btn-icon btn-sm" onclick="return reinstate_photo('<?php echo $file->id;?>');"><i class="fa fa-refresh"></i><?php echo get_phrase('reinstate');?></div>
                        	<?php
                        		}else{
                        	?>
                        		<div class="btn btn-danger btn-icon btn-sm" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_reject_reason/<?php echo $file->id;?>')"><i class="fa fa-close"></i>Reject</div>
                        	<?php		
                        		}
                        	?>
                        	
                    		<a href="<?php echo base_url();?>index.php?sdsa/download/<?php echo $file->id;?>" class=" btn btn-sm btn-info btn-icon"><i class="fa fa-download"></i>Download</a>
                    	</div>
                    </li>
                    
                    <?php endforeach;?>




                    <?php else: ?>
                    <div class="well well-sm">File(s) not found.....</div>
                    
                </ul>
                </form>
            </div>
            
			<?php endif; ?>

        </div>
    </div>

						<div class="row">
				           <div class="col-md-12 text-center">
					            <?php echo $pagination; ?>
					        </div>
			            </div>

<script>
	$(function() {
	    $('#select_img').change(function() {
	      
	      if($(this).prop('checked')){
		      	$('.get_img').prop('checked',true);	
	      }else{
	      	$('.get_img').prop('checked',false);	
	      }
	      
	    })
	  })
	  
	  $('#rejected_img').change(function() {
	      if($(this).prop('checked')){
		      	//$('.get_img').prop('checked',true);	
		      	alert('Function not available');
	      }else{
	      		//$('.get_img').prop('checked',false);
	      		alert('Function not available');	
	      }	  	
	  	
	  });
	  
	 $('.mass_action').click(function(){
	 	
	 	var msg = "";
	 	
	 	if($('input.get_img:checked').length>0 && ($(this).prop('id')!=="reject_all"||$(this).prop('id')!=="accept_all")){
	 		msg = 'Are you sure you want to perform this action on the selected images?';
	 	}else{
	 		msg = 'Please select a photo first';
	 	}
	 	
	 	if($(this).attr('id')!=="download_selected" || $(this).attr('id')!=="download_accepted"){
	 		BootstrapDialog.show({
		           title:'<?php echo get_phrase('confirm');?>',
				   message: msg,
				   draggable: true
			});
		}
	 });
	 
	 function accept_photo(id){
	 	var url = '<?php echo base_url();?>index.php?sdsa/accept_photo/'+id;
	 	$.ajax({
	 		url:url,
	 		success:function(){
	 			
	 			window.location.reload();
	 			alert('Photo Accepted');
	 		},
	 		error:function(errorCode,error,msg){
	 			alert(msg);
	 		}
	 	});
	 }
	 
	function reinstate_photo(id){
	 	var url = '<?php echo base_url();?>index.php?sdsa/reinstate_photo/'+id;
	 	$.ajax({
	 		url:url,
	 		success:function(){
	 			
	 			window.location.reload();
	 			alert('Photo Reinstated');
	 		},
	 		error:function(errorCode,error,msg){
	 			alert(msg);
	 		}
	 	});
	 }
	 
	function image_action(id){

		$('#frm_image_action').attr('action','<?php echo base_url();?>index.php?sdsa/image_action/<?php echo $project_num;?>/'+id);
		
		$('#frm_image_action').submit();
		
	}
	
	function change_page(){
		
		var per_page = $('#per_page').val();
		
		$('#frm_search').attr('action','<?php echo base_url();?>index.php?sdsa/set_num_pages/'+per_page);
		
		$('#frm_search').submit();
	}
	
	 
</script>