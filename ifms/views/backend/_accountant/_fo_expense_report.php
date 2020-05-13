<?php
//echo date('Y-m-t',$tym)."<br/>";
//print_r($rec);
echo $tym;
$exp_acc = $this->finance_model->expense_accounts();
?>

<div class="row">
	<div class="col-md-12">
    	<div class="row">
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-book"></i> 
                            <?php echo get_phrase('expense_report');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;overflow: auto;">
                    	
                    	<div class="row">
                    		<div class="col-sm-3">
                    			<a style="margin: 10px 0px 0px 5px;" href="<?=base_url();?>ifms.php/accountant/dashboard/<?=$tym;?>" class="btn btn-primary btn-icon pull-left"><i class="fa fa-tachometer"></i><?php echo get_phrase('dashboard');?></a>
                    		</div>
                    	</div>
                    	
                    	<hr />
                    	
                    	<table class="table table-striped">
                    		<thead>
                    			<tr>
                    				<th><?=get_phrase('cluster');?></th>
                    				<th><?=get_phrase('project');?></th>
                    				
                    				<?php
                    					foreach($exp_acc as $row):
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
                    				foreach($rec as $key1=>$value1){
                    					foreach($value1 as $key2=>$value2){
                    			?>
		                    				<tr>
		                    					<td><?=$key1;?></td>
		                    					<td><?=$key2;?></td>
		                    					
		                    					<?php
		                    						$total = 0;
		                    						foreach($exp_acc as $rw){
		                    							$amt = 0;
		                    							if(array_key_exists($rw->AccNo, $value2)){
		                    					        	$amt = $value2[$rw->AccNo];
														}
												?>
													<td><?=number_format($amt,2);?></td>
												<?php	
													$total+=$amt;
													}
		                    					?>
		                    					<td style="font-weight: bold;"><?=number_format($total,2);?></td>
		                    				</tr>
                    			<?php
										}
									}
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
                    	