<?php
//$start_date = date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->project_system_start_date($project_id))));
?>

<div class="row">
		<div class="col-md-8">
			
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-users"></i>
                            <?php echo get_phrase('opening_deposit_in_transit');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	
                    	<button onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_add_deposit_in_transit/<?=$project_id;?>');" class="btn btn-primary btn-icon"><i class="fa fa-plus-circle"></i><?= get_phrase('add');?></button>
                    	
                    	<a href="<?php echo base_url();?>ifms.php/admin/opening_balances" class="btn btn-info btn-icon"><i class="fa fa-mail-reply-all"></i><?=get_phrase('back');?></a>
                    	<hr/>
                    	
                    	<table class="table table-stripped datatable">
                    		<thead>
                    			<tr>
                    				<th><?= get_phrase('date');?></th>
                    				<th><?= get_phrase('details');?></th>
                    				<th><?= get_phrase('deposit_state');?></th>
                    				<th><?= get_phrase('month_cleared');?></th>
                    				<th  style="text-align: right;"><?= get_phrase('amount');?></th>
                    				<th style="text-align: right;"><?= get_phrase('action');?></th>
                    			</tr>
                    		</thead>
							<tbody>
								<?php
									
									$total_funds = 0;
									
									$deposit_in_transit = $this->db->get_where('transitfundsbf',array('icpNo'=>$project_id))->result_object();
									
									foreach($deposit_in_transit as $row):
								?>
									<tr>
										<td><?= $row->TDate;?></td>
										<td><?= $row->Details;?></td>
										<td><?php if($row->TState==='1'){echo 'Cleared';}else{echo 'Outstanding';}?></td>
										<td><?= $row->clrMonth;?></td>
										<td style="text-align: right;"><?= number_format($row->amount,2); $total_funds+=$row->amount;?></td>
										<td  style="text-align: right;">
											
										<div class="btn-group">
					                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
					                        Action <span class="caret"></span>
					                    </button>
					                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					                    	
					                        <!-- Edit -->
					                        <li>
					                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_deposit_in_transit/<?php echo $row->transitBfID;?>');">
					                            	<i class="entypo-pencil"></i>
														<?php echo get_phrase('edit');?>
					                               	</a>
					                        </li>
					                        <li class="divider"></li>
					                       									
											
					                        <!--Delete-->
					                        <li>
					                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/opening_deposit_in_transit/delete/<?php echo $row->transitBfID;?>/<?=$project_id;?>');">
					                            	<i class="fa fa-eraser"></i>
														<?php echo get_phrase('delete');?>
					                               	</a>
					                       	</li>
					                       	
					                     	
					                     </ul>
					                     </div>
										</td>
									</tr>
								<?php
									endforeach;
								?>
								<tr><td style="font-weight: bold;" colspan="4"><?= get_phrase('total');?></td><td style="text-align: right;"><?= number_format($total_funds,2);?></td>
									
									<td>&nbsp;</td></tr>
							</tbody>
                    	</table>
					</div>
				</div>
		</div>
</div>	