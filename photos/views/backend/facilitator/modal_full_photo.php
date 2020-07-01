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
				if(file_exists('uploads/photos/'.$photo['group'].'/'.$photo['file_name'])){
				?>
					<img src="<?php echo base_url();?>uploads/photos/<?php echo $photo['group'];?>/<?php echo $photo['file_name'];?>" alt="<?php echo $photo['file_name'];?> Photo" >
					
				<?php
				}else{
					echo thumbnail('uploads/photos/'.$photo['file_name'].'/'.$rows->file_name, 100, 100 );
				}
				?>	
				</div>
				

				
					   <?php
							$file_path = base_url().'uploads/photos/'.$this->session->project_id.'/'.$photo['file_name'];
							$image = getimagesize($file_path);
							$type = explode("/",$image['mime']);
							$file_name = basename(base_url().'uploads/photos/'.$this->session->project_id.'/'.$photo['file_name']);
							$file_arr = explode('.', $file_name);
							$file_base = $file_arr['0'];
						?>
						
						<div class="col-sm-6">
							<table class="table" width="50">
								<tr><td><?php echo get_phrase('height');?></td><td><?php echo $image['1'];?></td></tr>
								<tr><td><?php echo get_phrase('width');?></td><td><?php echo $image['0'];?></td></tr>
								<tr><td><?php echo get_phrase('size');?></td><td><?php echo human_filesize(filesize('uploads/photos/'.$this->session->project_id.'/'.$photo['file_name']));?></td></tr>
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