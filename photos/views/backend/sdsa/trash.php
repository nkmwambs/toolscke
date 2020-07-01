<?php
$files = file_list('/uploads/trash/');
?>
<style>
	img{
		width: 30px;
		height: 40px;
	}
</style>
<div class="row">
	<div class="col-sm-10">
		
		<hr>
		
		<div class="btn btn-danger btn-icon" onclick="confirm_action('<?php echo base_url();?>photos.php/sdsa/empty_trash');"><i class="fa fa-trash-o"></i>Empty Trash</div>
		
		<hr>
		
		<table class="table table-striped" id="trash">
			<thead>
				<th>Action</th>
				<th>Image</th>
				<th>File Name</th>
				<th>Last Modified Date</th>
				<th>Size</th>
			</thead>
			<tbody>
				<?php
					foreach($files as $rows):
					
					$abs_path = FCPATH.'/uploads/trash/'.$rows;	
				?>
				<tr>
					<td>
						<div class="btn-group">
			                    <button id="" style="width: 100px;" type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown">
			                        Action <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
	
			                        <!-- Restore -->
			                        <li>
			                        	<a href="#" id="restore" onclick="confirm_action('<?php echo base_url();?>photos.php/sdsa/restore_image/<?php echo $rows;?>');">
			                            	<i class="fa fa-refresh"></i>
												<?php echo get_phrase('restore');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>

									
			                        <!--Clear -->
			                        <li>
			                        	<a href="#" id="clear"  onclick="confirm_action('<?php echo base_url();?>photos.php/sdsa/clear_image/<?php echo $rows;?>');">
			                            	<i class="fa fa-trash-o"></i>
												<?php echo get_phrase('clear');?>
			                               	</a>
			                       	</li>
			                       		                       	
			                       
			                     </ul>
			                     </div>
					</td>
					<td><?php echo thumbnail('uploads/trash/'.$rows, 100, 100 ); ?></td>
					<td><?php echo $rows;?></td>
					<td><?php echo date('d-M-Y',filemtime($abs_path));?></td>
					<td><?php echo human_filesize(filesize('uploads/trash/'.$rows));?></td>
				</tr>
				<?php
					endforeach;
				?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function() {
    $('#trash').DataTable();
} );
</script>