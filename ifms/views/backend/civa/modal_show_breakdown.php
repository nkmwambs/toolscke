<?php
$vouchers = $this->db->get_where('voucher_body',array('icpNo'=>$param2,'civaCode'=>$param3))->result_object();

$civ_code = $this->db->get_where('civa',array('civaID'=>$param3))->row()->AccNoCIVA;

?>
<div class="row">
	<div class="col-md-12">
	    	<div class="row">
	            <div class="col-md-12 col-xs-12">    
	                <div class="panel panel-info" data-collapsed="0">
	                    <div class="panel-heading">
	                        <div class="panel-title">
	                           <i class="fa fa-list"></i> 
	                           <?php
	                           		$cost_type = get_phrase('income');
									if($vouchers[0]->VType!=='CR'){
										$cost_type = get_phrase('expense');
									}
	                           ?>
	                            <?=$param2;?> - <?=$civ_code;?> <?=$cost_type;?> <?php echo get_phrase('breakdown');?> 
	                        </div>
	                    </div>
	                 <div class="panel-body" style="padding:0px;overflow: auto;">
	                 	<table class="table table-striped">
	                 		<thead>
	                 			<tr>
	                 				<th><?=get_phrase('intervention_code');?></th>
	                 				<th><?=get_phrase('account');?></th>
	                 				<th><?=get_phrase('Date');?></th>
	                 				<th><?=get_phrase('voucher_number');?></th>
	                 				<th><?=get_phrase('voucher_type');?></th>
	                 				<th><?=get_phrase('amount');?></th>
	                 			</tr>
	                 		</thead>
	                 		<tbody>
	                 			<?php
	                 				$total = 0;
	                 				foreach($vouchers as $row){
	                 					
										$account = $this->db->get_where('accounts',array('AccNo'=>$row->AccNo))->row()->AccText;
	                 			?>
	                 				<tr>
	                 					<td><?=$civ_code;?></td>
	                 					<td><?=$account;?></td>
	                 					<td><?=$row->TDate;?></td>
	                 					<td>
	                 						<a class="btn btn-default" href="#" onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_view_voucher/<?=$row->hID;?>');"><?=$row->VNumber;?></a>
	                 						
	                 					</td>
	                 					<td><?=$row->VType;?></td>
	                 					<td><?=$row->Cost;?></td>
	                 				</tr>
	                 			<?php
	                 				$total +=$row->Cost;
									}
	                 			?>	                 	
	                 			<tr>
	                 				<td colspan="5" style="font-weight: bold;"><?=get_phrase('total');?></td>
	                 				<td style="font-weight: bold;"><?=number_format($total,2);?></td>
	                 			</tr>		
	                 		</tbody>
	                 	</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>					