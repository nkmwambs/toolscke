<?php //print_r($options);
if(empty($result)) {echo "<div class='well' style='text-align:center;'>Data not Found</div>";}else{ 
?>
<div class="row">
	<div class="col-sm-12">
		<?php if(!empty($result)){?>
		<table class="table table-striped datatable">
			<thead>
				<tr>
					<?php 
						$row_one = array_keys((array)$result[0]);
						foreach($row_one as $th){
					?>
						<th><?=get_phrase($th);?></th>
					<?php		
						}
					?>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($result as $row):
				?>
					<tr>
						<?php 
							foreach($row as $key=>$value){
						?>
							<td>
								<?php 
									
									if(in_array($key, $options)){
										if($value === '1') echo "True"; else echo "False";  
									}else{
										echo $value;
									}
									
								?>
							</td>
						<?php 
							}
						?>
					</tr>
				<?php
					endforeach;
				?>
			</tbody>
		</table>
		<?php }else{ ?>
			<div>Dataset Empty</div>
		<?php } ?>	
	</div>
</div>
<?php }?>
<script>
	$(document).ready(function(){
		var datatable = $('.datatable').DataTable({
			stateSave: true,
			"bSort" : true ,
			lengthMenu: [[25,50, 100, 150,-1], [25,50 ,100,150 ,"All"]],
			pageLength: 25,
			dom: '<"row"l><Bf><"col-sm-12"rt><ip>',
		    pagingType: "full_numbers",
		    buttons: [
		           'csv', 'excel', 'print'
		       ]  
		});
	})
</script>