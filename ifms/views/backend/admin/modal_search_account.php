<?php

$rst = $this->finance_model->search_account($param2);
?>
<div class="row">
	<div class="col-sm-12">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Account Name</th>
					<th>Account Short Code</th>
					<th>Account Numeric Code</th>
					<th>Parent Account</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($rst as $row):?>
					<tr>
						<td><?php echo $row->AccName;?></td>
						<td><?php echo $row->AccText;?></td>
						<td><?php  echo $row->AccNo;?></td>
						<td><?php  echo $this->db->get_where('accounts',array('accID'=>$row->parentAccID))->row()->AccName;?></td>
						<td>
							<div class="btn-group">
			                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
			                        Action <span class="caret"></span>
			                    </button>		
			                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">	                        
			                        <!--Edit Sub Account -->
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_existing_sub_account/<?php echo $row->accID;?>');">
			                            	<i class="glyphicon glyphicon-edit"></i>
												<?php echo get_phrase('edit_sub_account');?>
			                               	</a>
			                       	</li>
			                     	
			                     </ul>
		                     </div>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>