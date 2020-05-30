<?php

//print_r($total_dct_expense);
// //print_r($regions);
// echo('<br>');

// echo('<br>');

print_r($dct_expenses_per_cluster_in_region);
echo '<br>';
echo '<br>';
$region_expenses=[];
$region_expense_totals=[];
//$expense_acc_codesr=[];
foreach($dct_expenses_per_cluster_in_region as $cluster){
	$region_expenses[$cluster['region']][$cluster['AccText']]=$cluster['Cost'];
}
foreach($region_expenses as $key=>$arr){
	$region_expense_totals[$key]=array_sum($arr);
	

}
print_r($region_expenses);
echo '<br>';
echo '<br>';
print_r($region_expense_totals);

?>

<div class="row">
   <div class="col-sm-6">
   		<h3>
	  		<?php
	   			echo get_phrase('direct_cash_transfer_report_for ').date('F Y',$tym);
	   		?>
	   	</h3>
    </div>
     	
    <div class="col-sm-6">
       <div class="btn btn-default pull-right col-sm-6"><a href="#" class="fa fa-backward scroll" id="prev"></a> <?=get_phrase('you_are_in');?> <?=date('F Y',$tym);?> <input type="text" class="form-control col-sm-1" id="cnt" placeholder="<?=get_phrase('enter_number_of_months');?>"/> <a href="#" class="fa fa-forward scroll" id="next"></a></div>
    </div>
     	
</div>

<hr />
     	
<div class="row">
     <div class="col-sm-12">
     	<div class="row">

		 <div class="col-sm-3">
			
				<div class="tile-stats tile-primary">
					<div class="icon"><i class="entypo-suitcase"></i></div>
					<h3><?=get_phrase('Nation-wide total_dct_expense');?></h3>
					<div class="num" data-start="0" data-end="<?=$total_dct_expense;?>" data-prefix="Kshs " data-postfix="" data-duration="1500" data-delay="0">0</div>
					
				</div>
				
			</div>
            <!-- <div class="col-md-3">
     			<div class="tile-stats tile-red">
					 <div class="icon"><i class="fa fa-book"></i></div>
					 <div class="num" data-start="0" data-end="<?=$total_dct_expense;?>" 
					
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?=get_phrase('total_dct_expense');?></h3>
                   
        		</div>
        	</div> -->
        	
        	 <div class="col-md-3">
				 <a href="#"  style="text-decoration: none;">
     			<div class="tile-stats tile-red">
     				<div class="icon"><i class="fa fa-book"></i></div>
                    <div class="num" data-start="0" data-end="<?=$total_dct_beneficiaries;?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('total_dct_beneficiaries');?></h3>
                   
				</div>
				</a>
        	</div>
        	
        </div>
	 </div>

	 <div class="row">
   <div class="col-sm-12">
	   <?php
		//for an array for region expenses for dct per account e.g. E15
		$dct_region_expenses=[];
		foreach($dct_expenses_per_cluster_in_region as $dct_expenses_in_acluster){
			$dct_region_expenses[$dct_expenses_in_acluster['region']][$dct_expenses_in_acluster['AccText']]=$dct_expenses_in_acluster['Cost'];
		}
	   
	   ?>
   		<table class='table-striped table'>
			   <!-- thead -->
		   <thead>
				<tr>
					<!-- Draw th for region and region-wide -->
					<th><?=get_phrase('region')?></th>
					<th><?=get_phrase('region-wide_total');?></th>

					<?php
					$expense_acc_codes=[];
					 foreach($dct_region_expenses as $dct_region_expense)
					 {
						foreach($dct_region_expense as $exp_acc_code=>$exp_account_and_totals)
						{
							if(!in_array($exp_acc_code,$expense_acc_codes))
							{
								$expense_acc_codes[]=$exp_acc_code;?>
								<!-- draw the th for expenses -->
								<th><?=$exp_acc_code;?></th>

					  <?php } ?>
						<?php
						}
					 }
					
					?>
				</tr>
		   </thead>
           <!-- tboady -->
		   <tbody>
			   <?php
			    $national_total_dct=0;
				foreach($dct_region_expenses as $region=> $dct_region_expense){
					$national_total_dct+=array_sum($dct_region_expense);
					
					?>
				  <tr>
					  <!-- Populate region name e.g. Western region and total amount for dct in 
					   that region for all dct expenses acc -->

					  <td><a href='<?=base_url();?>ifms.php/smp/<?=$region;?>'><?=$region?></a></td>
					  <td><?=number_format(array_sum($dct_region_expense),2)?></td>

					  <!-- Populate  the expense amount for each region -->
					  <?php foreach($dct_region_expense as $exp_account_and_totals){
													  
						   ?>
                           <td><?=number_format($exp_account_and_totals,2)?></td>

					   <?php } ?>

				   </tr>
				<?php }?>
				<tr>
					<td><h2><?=get_phrase('nation-wide_total')?></h2></td>
					<td><h2><?= number_format($national_total_dct,2)?></h2></td>

					<?php 
					//loop to populate totals for dct expense accounts in last row of the table
					 foreach($expense_acc_codes as $values)
					 {
						 $array_column_for_acc_exp=array_column($dct_region_expenses, $values);?>

						 <td><h2><?= number_format(array_sum($array_column_for_acc_exp),2)?></h2></td>

					<?php 
				     } ?>
				</tr>
		     
		   </tbody>
		   
		 </table>
    </div>
     	
</div>
	 
</div>
              
    <script>
	$(document).ready(function(){
		var datatable = $('.table').DataTable({
			stateSave: true,
			"bSort" : false 
		});
	});	
		
	
	$('.scroll').click(function(ev){
	
	var cnt = $('#cnt').val();
	
	if(cnt===""){
		cnt = "1";
	}
	
	var dt = '<?php echo $tym;?>';
	
	var flag = $(this).attr('id');
	
	var url = '<?php echo base_url();?>ifms.php/smp/dashboard/'+dt+'/'+cnt+'/'+flag;
	
	$(this).attr('href',url);
});
  </script>

  
