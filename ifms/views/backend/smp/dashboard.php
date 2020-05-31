<?php

print_r($dct_expenses_per_cluster_in_region);
echo '<br>';
echo '<br>';
$region_all_expenses=[];
$region_expense_totals=[];
//$expense_acc_codesr=[];
foreach($dct_expenses_per_cluster_in_region as $cluster){
	$region_all_expenses[$cluster['regionId']][$cluster['region']][$cluster['AccText']]=$cluster['Cost'];
	
}
$region_names=[];
foreach($region_all_expenses as $key=> $region_expense){
	
	echo '<br>';
	foreach ($region_expense as $k=> $expense){
		
		$region_names[$key.'-'.$k]=$expense;
	}
}
print_r($region_names);


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
		/*
		  Create the array of format: 
			Array ( [3-Central Region] => Array ( [E15] => 1052.00 [E30] => 6166.00 ) [4-Nairobi Region] => Array ( [E15] => 4.00 [E30] => 2.00 ) [1-Western Region] => Array ( [E15] => 2000.00 ) )
		*/
		$region_expenses=[];
		$region_names_and_ids=[];
		 foreach($dct_expenses_per_cluster_in_region as $dct_expenses_in_aregion){
			$region_expenses[$dct_expenses_in_aregion['regionId']][$dct_expenses_in_aregion['region']][$dct_expenses_in_aregion['AccText']]=$dct_expenses_in_aregion['Cost'];
			
		}
		foreach($region_expenses as $key=> $region_expense){
			foreach ($region_expense as $k=> $expense){
				
				$region_names_and_ids[$key.'-'.$k]=$expense;
			}
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
				    $expense_account_codes=[];
					foreach($region_names_and_ids as $region_name_and_id){

						foreach($region_name_and_id as $exp_code=> $expense_code){
							if(!in_array($exp_code,$expense_account_codes)){
								$expense_account_codes[]=$exp_code;?>
                                <!-- draw the th for expenses -->
								<th><?=$exp_code;?></th>

							<?php }
						}
					}
				  ?>
				</tr>
		   </thead>
		   <!-- tboady -->
		   <tbody>
			<?php 
			$national_total_dct=0;
			foreach($region_names_and_ids as $region_name_id_key=>$region_name_and_id){
					$national_total_dct+=array_sum($region_name_and_id);
				?>
				
				<tr>
					<!-- Populate region name e.g. Western region and total amount for dct in 
					that region for all dct expenses acc -->
					<td>
						
						<?php 
						//Get the value name and id for a region
						$region_name_and_id_array=explode('-',$region_name_id_key);?>

						<a target='_blank' href='<?=base_url();?>ifms.php/smp/cluster_dct_in_aregion/<?=$tym.'/'.$region_name_and_id_array[0];?>'><?=$region_name_and_id_array[1];?></a>
						<?php 
						
						?>
				
					</td>
					<td><?=number_format(array_sum($region_name_and_id),2)?></td>

					<!-- Populate  the expense amount for each region -->

					<?php foreach($region_name_and_id as $key=> $exp_account_and_totals){
						 $expense_account_codes
						?>
					<td><?=number_format($exp_account_and_totals,2).$key;echo(sizeof($region_name_and_id));?></td>

					<?php } ?>
				
				</tr>

			<?php }?>

			<tr>
				<td><h2><?=get_phrase('nation-wide_total')?></h2></td>
				<td><h2><?= number_format($national_total_dct,2)?></h2></td>

				<?php 
						//loop to populate totals for dct expense accounts in last row of the table
						foreach($expense_account_codes as $expense_account_code)
						{
							$array_column_for_acc_exp=array_column($region_names_and_ids, $expense_account_code);?>

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

  
