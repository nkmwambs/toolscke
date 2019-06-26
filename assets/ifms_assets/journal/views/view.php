<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-sm-12">
		<div class="well">Cash Journal</div>
		
		<table class="table table-striped" id="ifms_journal_view">
			<thead>
				<tr>
					<?php
	
						$i=0;
						foreach($records as $vnumber=>$row){
							foreach($row as $th=>$values){
					?>	
								<th><?=$th;?></th>	
					<?php
							}
							if($i == 0) break;
							
						}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($records as $details){
				?>
					<tr>
						<?php
							foreach($details as $field=>$detail){
								if($field=='VNumber'){
						?>
								<td><div class="btn btn-default"><input type="checkbox" id="" /> <?=$detail;?></div></td>
						<?php			
								}else{
						?>
									<td><?=$detail;?></td>
						<?php
								}
							}
						?>
					</tr>
				<?php
					}
				?>
				
			</tbody>
		</table>
		
	</div>
</div>

<?php
//print_r($records);
?>

<script>
	var datatable = $("#ifms_journal_view").DataTable(
		{
				"ordering": false,
		        dom: 'Bfrtip',
		        buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdfHtml5'
		        ]
		    }
	);
</script>