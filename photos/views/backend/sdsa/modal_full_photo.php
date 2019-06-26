<?php
$photo = $this->file->getRows($param2);
?>
<style>
	.panel-body img {

    width:100%;
    height:100%;
}
</style>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('photo');?></div>						
				</div>
										
				<div class="panel-body">
				<?php
				
				$all_images = json_decode($this->session->photos);
				
				$prev=$param3-1;
				$cur=$param3;
				$next=$param3+1;
				
				// echo "Previous: ".$all_images[$prev]->id."- ".$all_images[$prev]->file_name."<br/>";
				// echo "Current: ".$all_images[$cur]->id."- ".$all_images[$cur]->file_name."<br/>";
				// echo "Next: ".$all_images[$next]->id."- ".$all_images[$next]->file_name."<br/>";
				
				if(file_exists('uploads/photos/'.$photo['group'].'/'.$photo['file_name'])){
				?>
					<img src="<?php echo base_url();?>uploads/photos/<?php echo $photo['group'];?>/<?php echo $photo['file_name'];?>" alt="<?php echo $photo['file_name'];?> Photo" >
					
				<?php
				}else{
					echo thumbnail('uploads/photos/'.$photo['file_name'].'/'.$rows->file_name, 100, 100 );
				}
				?>	
				</div>
				
				<div class="panel-footer">
						<?php
							if($photo['status']==='1' || $photo['status']==='4'){
						?>
					        <div class="btn btn-success btn-icon" onclick="return accept_photo('<?php echo $param2;?>');"><i class="fa fa-thumbs-o-up"></i>Accept</div>
                        	<div class="btn btn-danger btn-icon" onclick="showAjaxModal('<?php echo base_url();?>photos.php/modal/popup/modal_reject_reason/<?php echo $param2;?>')"><i class="fa fa-close"></i>Reject</div>
                        	
						<?php
							}elseif($photo['status']==='2'){
								
						?>
							<div class="btn btn-danger btn-icon" onclick="showAjaxModal('<?php echo base_url();?>photos.php/modal/popup/modal_reject_reason/<?php echo $param2;?>')"><i class="fa fa-close"></i>Reject</div>
								
						<?php		
							}elseif($photo['status']==='3'){
						?>		
							<div class="btn btn-success btn-icon" onclick="return accept_photo('<?php echo $param2;?>');"><i class="fa fa-thumbs-o-up"></i>Accept</div>
						<?php		
							}
						?>
						
						<!--<div class="btn btn-info btn-icon"><i class="fa fa-rotate-left"></i><?=get_phrase('left_rotate');?></div>
						
						<div class="btn btn-info btn-icon"><i class="fa fa-rotate-right"></i><?=get_phrase('right_rotate');?></div>-->
						<?php if(isset($all_images[$prev]->id)){?>
							<div class="btn btn-icon" onclick="showAjaxModal('<?=base_url();?>photos.php/modal/popup/modal_full_photo/<?=$all_images[$prev]->id;?>/<?=$prev?>');"><i class="fa fa-backward"></i></div>
						<?php }?>
						
						<?php if(isset($all_images[$next]->id)){?>
							<div class="btn btn-icon" onclick="showAjaxModal('<?=base_url();?>photos.php/modal/popup/modal_full_photo/<?=$all_images[$next]->id;?>/<?=$next?>');"><i class="fa fa-forward"></i></div>
						<?php }?>
				</div>
				
						<?php
							$file_path = base_url().'uploads/photos/'.$photo['group'].'/'.$photo['file_name'];
							$image = getimagesize($file_path);
							$type = explode("/",$image['mime']);
							$file_name = basename(base_url().'uploads/photos/'.$photo['group'].'/'.$photo['file_name']);
							$file_arr = explode('.', $file_name);
							$file_base = $file_arr['0'];
						?>
						
						<div class="col-sm-6">
							<table class="table" width="50">
								<tr><td><?php echo get_phrase('height');?></td><td><?php echo $image['1'];?></td></tr>
								<tr><td><?php echo get_phrase('width');?></td><td><?php echo $image['0'];?></td></tr>
								<tr><td><?php echo get_phrase('size');?></td><td><?php echo human_filesize(filesize('uploads/photos/'.$photo['group'].'/'.$photo['file_name']));?></td></tr>
								<tr><td><?php echo get_phrase('type');?></td><td><?php echo $type['1'];?></td></tr>
								<tr><td><?php echo get_phrase('file');?></td><td><?php echo $file_base;?></td></tr>
								<tr><td><?php echo get_phrase('date');?></td><td><?php echo date("j M Y",strtotime($photo['created'])); ?></td></tr>
							</table>
						</div>
			
		</div>
	</div>
	
</div>

<script>
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
</script>