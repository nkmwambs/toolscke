<?php
//print_r($records);
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
                    	                    	
                    	<div>
                    		<div class="col-sm-offset-6 col-sm-6">
						       <div class="btn btn-default pull-right col-sm-6"><a href="#" class="fa fa-backward scroll" id="prev"></a> <?=get_phrase('you_are_in');?> <?=date('F Y',$tym);?> <input type="text" class="form-control col-sm-1" id="cnt" placeholder="<?=get_phrase('enter_number_of_months');?>"/> <a href="#" class="fa fa-forward scroll" id="next"></a></div>
						    </div>
                    	</div>
                    	
                    	<hr />
                    	
                    	<table class="table table-striped">
                    		<thead>
                    			<tr>
                    				<td><?=get_phrase('cluster');?></td>
                    				<td><?=get_phrase('project');?></td>
                    				<?php
                    					foreach($records as $clusters=>$icps){
	                    					foreach($icps as $transactions_for_header){
	                    						foreach($transactions_for_header as $account=>$amount){
                    				?>	
                    						<td><?=$account;?></td>	
                    				<?php
											}
                    							break;
											}
											break;	
										}
                    				?>
                    				
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php
                    				foreach($records as $cluster=>$icps){
                    					foreach($icps as $icp=>$transactions){
                    			?>
                    				<tr>
                    					<td><?=$cluster;?></td>
                    					<td><?=$icp;?></td>
                    					<?php
                    						foreach($transactions as $amount){
                    					?>
                    							<td><?=number_format($amount,2);?></td>
                    					<?php
											}
                    					?>
                    					
                    					
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
	
$('.scroll').click(function(ev){
	
	var cnt = $('#cnt').val();
	
	if(cnt===""){
		cnt = "1";
	}
	
	var dt = '<?php echo $tym;?>';
	
	var flag = $(this).attr('id');
	
	var url = '<?php echo base_url();?>ifms.php/accountant/fo_expense_report/'+dt+'/'+cnt+'/'+flag;
	
	$(this).attr('href',url);
});
</script>	           	
						