<?php 

$expense_accounts = $this->db->where(array('revenue_id'=>$param2))->get('expense')->result_object();

?>
<div class="row">
	<div class="col-xs-12">
		
	<div class="panel panel-primary " data-collapsed="0">
       <div class="panel-heading">
           <div class="panel-title">
              <i class="fa fa-binoculars"></i>
                 <?php echo get_phrase('view_exepense_accounts');?>
           </div>
       </div>
        
       <div class="panel-body"  style="max-width:50; overflow: auto;">
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Short Code</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($expense_accounts as $row):?>
						<tr>
							<td><?php echo $row->name;?></td>
							<td><?php echo $row->code;?></td>
							
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

</div>

</div>	

