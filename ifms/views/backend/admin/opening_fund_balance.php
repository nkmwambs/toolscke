<?php
//$start_date = $this->finance_model->system_start_date($project_id);

$start_date = $closure_date;
?>

<div class="row">
		<div class="col-md-8">
			<?php if(isset($start_date)){ ?>
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-users"></i>
                            <?php echo get_phrase('fund_balances_for_').$this->db->get_where('users',array('fname'=>$project_id))->row()->fname.' '.get_phrase('as_at').' '.$start_date ;?>
                        </div>
                    </div>
                    <div class="panel-body">
						
						<button onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_new_fund_balance/<?= $project_id;?>/<?= $start_date;?>');" class="btn btn-info btn-icon"><i class="fa fa-plus-square"></i><?=get_phrase('add_fund_balance');?></button>
                    	
                    	<a href="<?php echo base_url();?>ifms.php/admin/opening_balances" class="btn btn-info btn-icon"><i class="fa fa-mail-reply-all"></i><?=get_phrase('back');?></a>
                    	<hr/>
                    	<?php
                    		//if($this->finance_model->check_opening_balances($project_id)===true){
                    	?>
                    	
                    	<table class="table table-stripped datatable">
                    		<thead>
                    			<tr>
                    				<th><?= get_phrase('account');?></th>
                    				<th  style="text-align: right;"><?= get_phrase('amount');?></th>
                    				<th style="text-align: right;"><?= get_phrase('action');?></th>
                    			</tr>
                    		</thead>
							<tbody>
								<?php
									
									//echo date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->project_system_start_date($project_id))));
									
									$last_closure_date = $start_date;
									
									$fund_balances = $this->finance_model->system_opening_fund_balances($last_closure_date,$project_id);
									//print_r($fund_balances);
									$total_funds = 0;
									
									foreach($fund_balances as $row):
								?>
									<tr>
										<td><?= $row->funds;?></td>
										<td style="text-align: right;"><?= number_format($row->amount,2); $total_funds+=$row->amount;?></td>
										<td  style="text-align: right;">
											
										<div class="btn-group">
					                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
					                        Action <span class="caret"></span>
					                    </button>
					                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					                    	
					                        
					                        <li>
					                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_fund_balance/<?php echo $row->balID;?>/<?php echo $project_id;?>');">
					                            	<i class="entypo-pencil"></i>
														<?php echo get_phrase('edit');?>
					                               	</a>
					                        </li>
					                        <li class="divider"></li>
					                       									
											
					                        
					                       <li>
					                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/admin/opening_fund_balance/delete/<?= $project_id;?>/opening_fund_balance/<?= $row->balID;?>/<?= $row->balHdID;?>/');">
					                            	<i class="entypo-trash"></i>
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
								<tr><td style="font-weight: bold;"><?= get_phrase('total');?></td><td style="text-align: right;"><?= number_format($total_funds,2);?></td>
									
									<td>&nbsp;</td></tr>
							</tbody>
                    	</table>                  	
                    	<?php
                    	//}else{
 	
                    		//echo get_phrase('missing_fund_balances');
                    	//}
                    	?>
                    	
					</div>
				</div>
				<?php }else{?>
					<div class="well">Project Start Date Not Set</div>
				<?php }?>	
		</div>
</div>					