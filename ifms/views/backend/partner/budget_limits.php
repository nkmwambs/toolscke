<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary">
						
		<div class="panel-heading">
			<div class="panel-title"><?=get_phrase('budget_limits')?></div>						
		</div>
								
		<div class="panel-body" style="overflow-y: auto;">
					
					<div id="limit">
					
					<span style="font-weight: bold;font-size: 15pt;"><?=get_phrase('budget_limits');?></span>
					
					<table class="table table-striped display">
						<thead>
							<tr>
								<th><?=get_phrase('revenue_account');?></th>
								<th><?=get_phrase('financial_year');?></th>
								<th><?=get_phrase('limit');?></th>
								<th><?=get_phrase('new');?></th>
								<th><?=get_phrase('submitted');?></th>
								<th><?=get_phrase('approved');?></th>
								<th><?=get_phrase('declined');?></th>
								<th><?=get_phrase('total');?></th>
								<th><?=get_phrase('status');?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$limits = $this->db->get_where('plans_limits',array('fy'=>$fyr,'icpNo'=>$this->session->center_id))->result_object();
								//print_r($limits);
								foreach($limits as $limit):
									
									$rev_rec = $this->db->get_where('accounts',array('accID'=>$limit->revenue_id))->row();
									
							?>
								<tr>
									<td><?=$rev_rec->AccText;?> - <?=$rev_rec->AccName;?></td>
									<td><?=$limit->fy;?></td>
									<td style="text-align: right;"><?=number_format($limit->amount,2);?></td>
									<?php
										$chk_limit = $this->finance_model->limits_status_check($limit->revenue_id,$this->session->center_id,$limit->fy);
									?>
									<td style="text-align: right;"><?=number_format($this->finance_model->plans_annual_totals($limit->fy,$this->session->center_id,$limit->revenue_id,0),2);?></td>
									<td style="text-align: right;"><?=number_format($this->finance_model->plans_annual_totals($limit->fy,$this->session->center_id,$limit->revenue_id,1),2);?></td>
									<td style="text-align: right;"><?=number_format($this->finance_model->plans_annual_totals($limit->fy,$this->session->center_id,$limit->revenue_id,2),2);?></td>
									<td style="text-align: right;"><?=number_format($this->finance_model->plans_annual_totals($limit->fy,$this->session->center_id,$limit->revenue_id,3),2);?></td>
									<td style="text-align: right;"><?=number_format($this->finance_model->plans_annual_totals($limit->fy,$this->session->center_id,$limit->revenue_id),2);?></td>
									<td><span class="label label-<?=$chk_limit->color?>"><?=$chk_limit->msg.' - ['.number_format($chk_limit->dif,2).']';?></span></td>
								</tr>
							<?php
								endforeach;
							?>
						</tbody>
					</table>
					</div>
				
		</div>
	</div>
</div>	
</div>	

<script>
	$('.scroll-fy').click(function(){
		var fy = $(this).siblings('input').val();
		
		if($(this).attr('id')==='next_fy'){
			$(this).siblings('input').val(parseInt(fy)+1); 
		}else{
			$(this).siblings('input').val(parseInt(fy)-1);
		}
		
		
		$(this).attr('href','<?php echo base_url();?>ifms.php/partner/scroll_budget_summary/'+$(this).siblings('input').val());
		
	});
	
function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: ".",             
		    removeInline: false,        
		    printDelay: 333,            
		   	header:null,            
		    formValues: true          
		});
    }
</script>