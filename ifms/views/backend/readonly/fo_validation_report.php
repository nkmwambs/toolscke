<?php
//echo date('Y-m-d',$tym);
?>
<div class="row">
	<div class="col-sm-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?=get_phrase('cluster');?></th>
					<th><?=get_phrase('project');?></th>
					<th><?=get_phrase('bank_reconcile_error');?></th>
					<th><?=get_phrase('validated');?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($result as $row){
				?>
					<tr>
						<td><?=$this->db->get_where('users',array('fname'=>$row->icpNo))->row()->cname;?></=?></td>
						<td><?=$row->icpNo;?></td>
						<td align="right"><?=number_format($this->finance_model->bank_reconciled($row->icpNo,date('Y-m-t',$tym)),2);?></td>
						<td>
							<?php
								$validate = 'Yes';
								if($row->allowEdit==='1'){
									$validate = 'No';
								}
								
								echo $validate;
							?>
						</td>
					</tr>
				<?php
					}
				?>
				
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		var datatable = $('.table').DataTable({
			stateSave: true,
			lengthMenu: [[25,50, 100, 150,-1], [25,50 ,100,150 ,"All"]],
			pageLength: 25,
			dom: '<"row"l><Bf><"col-sm-12"rt><ip>',
		       //sDom:'r',
		    pagingType: "full_numbers",
		    buttons: [
		           'csv', 'excel', 'print'
		       ]
		});
	});
</script>