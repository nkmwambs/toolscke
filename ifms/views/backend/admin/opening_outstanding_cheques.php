<div class="row">
		<div class="col-md-8">
			
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-users"></i>
                            <?php echo get_phrase('opening_outstanding_cheques_for_').$project_id;?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	
                    	<button onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_add_outstanding_cheques/<?=$project_id;?>');" class="btn btn-primary btn-icon"><i class="fa fa-plus-circle"></i><?= get_phrase('add');?></button>
                    	
                    	<a href="<?php echo base_url();?>ifms.php/admin/opening_balances" class="btn btn-info btn-icon"><i class="fa fa-mail-reply-all"></i><?=get_phrase('back');?></a>
                    	<hr/>
                    	
                    	<table class="table table-stripped datatable">
                    		<thead>
                    			<tr>
                    				<th><?= get_phrase('date');?></th>
                    				<th><?= get_phrase('cheque_number');?></th>
                    				<th><?= get_phrase('details');?></th>
                    				<th><?= get_phrase('cheque_state');?></th>
                    				<th><?= get_phrase('month_cleared');?></th>
                    				<th  style="text-align: right;"><?= get_phrase('amount');?></th>
                    				<th style="text-align: right;"><?= get_phrase('action');?></th>
                    			</tr>
                    		</thead>
							<tbody>
								<?php
									
									$total_funds = 0;
									
									$outstanding_cheques = $this->db->get_where('oschqbf',array('icpNo'=>$project_id))->result_object();
									//print_r($outstanding_cheques);
									foreach($outstanding_cheques as $row):
								?>
									<tr>
										<td><?= $row->TDate;?></td>
										<td><?= $row->ChqNo;?></td>
										<td><?= $row->TDescription;?></td>
										<td><?php if($row->chqState==='1'){echo 'Cleared';}else{echo 'Outstanding';}?></td>
										<td><?= $row->clrMonth;?></td>
										<td style="text-align: right;"><?= number_format($row->totals,2); $total_funds+=$row->totals;?></td>
										<td  style="text-align: right;">
											
										<div class="btn-group">
					                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
					                        Action <span class="caret"></span>
					                    </button>
					                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					                    	
					                        <!-- Edit -->
					                        <li>
					                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_outstanding_cheque/<?php echo $row->osBfID;?>');">
					                            	<i class="entypo-pencil"></i>
														<?php echo get_phrase('edit');?>
					                               	</a>
					                        </li>
					                        <li class="divider"></li>
					                       									
											
					                        <!--Delete-->
					                        <li>
					                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/opening_outstanding_cheques/delete/<?php echo $row->osBfID;?>');">
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
								<tr><td style="font-weight: bold;"><?= get_phrase('total');?></td><td colspan="4">&nbsp;</td><td style="text-align: right;font-weight: bold;"><?= number_format($total_funds,2);?></td>
									
									<td>&nbsp;</td></tr>
							</tbody>
                    	</table>
					</div>
				</div>
		</div>
</div>	