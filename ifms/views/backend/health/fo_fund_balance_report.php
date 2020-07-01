<?php
//print_r($rec);
$rev_acc = $this->finance_model->revenue_accounts();

$icps = $this->finance_model->projects();//$this->db->select(array('cname','fname'))->get_where('users',array('userlevel'=>'1','department'=>'0','cname!='=>'Kenya'))->result_object();

?>

<div class="row">
	<div class="col-md-12">
    	<div class="row">
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-book"></i> 
                            <?php echo get_phrase('fund_balance_report');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;overflow: auto;">
                    	<div class="row">
                    		<div class="col-sm-3">
                    			<a style="margin: 10px 0px 0px 5px;" href="<?=base_url();?>ifms.php/accountant/dashboard/<?=$tym;?>" class="btn btn-primary btn-icon pull-left"><i class="fa fa-tachometer"></i><?php echo get_phrase('dashboard');?></a>
                    		</div>
                    	</div>
                    	
                    	<hr />
                    	<div class="col-sm-offset-3 col-sm-6 well well-sm" style="text-align: center;"><h4><?=get_phrase('fund_balance_report');?> : <?=date("F Y",strtotime("last day of previous month",$tym));?></h3></div>
                    	<hr />
                    
                    	<table class="table table-striped">
                    		<thead>
                    			<tr>
                    				<th><?=get_phrase('cluster');?></th>
                    				<th><?=get_phrase('project');?></th>
                    				
                    				<?php
                    					foreach($rev_acc as $row):
                    				?>
                    					<th><?=$row->AccText;?></th>
                    				<?php
                    					endforeach;
                    				?>
                    				<th><?=get_phrase('total');?></th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php
                    				foreach($icps as $rw):
                    			?>
                    				<tr>
                    					<td><?=$rw->cname;?></td>
                    					<td><?=$rw->fname;?></td>
                    					
                    					<?php
                    						$total = 0;
                    						foreach($rev_acc as $r):
												
                    					?>	
                    						
                    						<td>
                    							<?php
                    							$val = 0;
                    								if(array_key_exists($rw->fname, $rec)){
                    									$amt = 0;
                    									foreach($rec[$rw->fname] as $funds){
                    										
                    										if($funds->funds===$r->AccNo){
                    											$amt = $funds->amount;
                    										}
																	
                    									}
														$val = $amt;
                    								}else{
                    									$val = 0;
                    								}
												$total+=$val;	
												echo number_format($val,2);
												
                    							?>
                    							
                    						</td>
                    						
                    					<?php
                    						endforeach;
                    					?>
                    					<td style="font-weight: bold;"><?=number_format($total,2)?></td>
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
		