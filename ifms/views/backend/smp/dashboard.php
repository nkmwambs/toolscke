<?php

print_r($dct_expenses_per_cluster_in_region);
echo '<br>';
echo '<br>';
echo $tym;
$region_all_expenses = [];
$region_expense_totals = [];
//$expense_acc_codesr=[];
foreach ($dct_expenses_per_cluster_in_region as $cluster) {
	$region_all_expenses[$cluster['regionId']][$cluster['region']][$cluster['AccText']] = $cluster['Cost'];
}
$region_names = [];
$expense_accounts[]='Region';

$outer_array=[];
$keys_array=[];

$counter=0;
foreach ($region_all_expenses as $key => $region_expense) {

	echo '<br>';
	foreach ($region_expense as $k => $expense) {
		//print_r($expense);
		$array_keys_of_expenses= array_keys($expense);

		$array_of_unique_accounts=array_unique(array_merge($expense_accounts,$array_keys_of_expenses));
        
		$expense_accounts=$array_of_unique_accounts;
		
		$keys_array[]=$expense_accounts;
		
			//$outer_array[]=$expense_accounts;
	
          
		$result_array=[];
		array_shift($array_of_unique_accounts);

		//print_r($array_of_unique_accounts);


		$result_array=[];
		//foreach (array_values($expense) as $expense_value) {
			//print_r($expense);
			$test=array_diff_key(array_flip($array_of_unique_accounts),$expense);
			if(count($test)>0){
				foreach($test as $w=>$r){
					if($expense[$w]>0)
					{
						$result_array[] = (float) $expense[$w];
					}
					else{
                        $result_array[] = (float) 0;
					}
					
	
				}
			}
			else{
				//$result_array[] = (float) $expense[];
			}
			
			
			
			
			
			
			
		//}
        echo(';;;;<br>');
		print_r(array_diff_key(array_flip($array_of_unique_accounts),$expense));

		echo(' --<br>');
		//print_r($expense);


		
		array_unshift($result_array,$k);
		$outer_array[]=$result_array;
		

	}
	
	
}

$keys[]=end($keys_array);
//print_r(end($keys_array));
echo('<br>');
//[["Region","E15","E30","E415"],["Central Region",3048,6166],["Coast Region",22000],["Nairobi Region",4,2],["Western Region",2000,68000]]
$javascrip_array=str_replace('}',']',str_replace( '{','[',json_encode(array_merge($keys,$outer_array))));
print_r($javascrip_array);



?>
<!-- <head> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>

<script type="text/javascript">
	// Load the Visualization API and the line package.
	google.charts.load('current', {
		'packages': ['corechart']
	});
	// Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);


	function drawChart() {
		
		/*
		Array from the server of format
		[["Region","E15","E30"],["Central Region",3048,6166],["Nairobi Region",4,2],["Western Region",2000,40000]]
		
		*/

        var regions_and_expense_accounts='<?=$javascrip_array;?>';

		alert(regions_and_expense_accounts);
		
        var data = google.visualization.arrayToDataTable(
            //Array of expenses accounts, cost, region
			//JSON.parse(regions_and_expense_accounts),

			[
				["Region","E15","E30","E415"],
				["Central Region",3048,6166,0],
				["Coast Region",0,0,22000],
				["Nairobi Region",4,2,0],
				["Western Region",2000,68000,0]
			]

					
			/*[
		 
				['Region', 'E15', 'E20', 'E25', 'E30', 'E45', 'E60'],
				['Western',  165,      938,         522,             998,           450,      614.6],
				['Nairobi',  135,      1120,        599,             1268,          288,      682],
				['Central',  157,      1167,        587,             807,           397,      623],
				['Costal',  139,      1110,        615,             968,           215,      609.4],
        	]*/
		
		);

        var options = {
          title : 'Direct Cash Transfers per region per expense account',
          vAxis: {title: 'Cost'},
          hAxis: {title: 'Region'},
          seriesType: 'bars',
          //series: {5: {type: 'line'}}        
		  };

        var chart = new google.visualization.ComboChart(document.getElementById('bar_chart'));
        chart.draw(data, options);
      }

	// function drawChart() {
	// 	// alert('<?= base_url(); ?>ifms.php/smp/get_data/'+<?= $tym; ?>);
	// 	$.ajax({
	// 		type: 'GET',
	// 		url: '<?= base_url(); ?>ifms.php/smp/get_data/' + <?= $tym; ?>,
	// 		success: function(data1) {
	// 			alert(data1);
	// 			var data = new google.visualization.DataTable();
	// 			// Add legends with data type
	// 			data.addColumn('string', 'region');
	// 			data.addColumn('string', 'AccText');
	// 			data.addColumn('number', 'Cost');
	// 			//Parse data into Json
	// 			var jsonData = $.parseJSON(data1);
	// 			for (var i = 0; i < jsonData.length; i++) {
	// 				data.addRow([jsonData[i].region, jsonData[i].AccText, parseInt(jsonData[i].Cost)]);
	// 			}

	// 			var options = {
	// 				chart: {
	// 					title: 'DCT Expenses',
	// 					//subtitle: 'Showing total DCT'
	// 				},
	// 				width: 900,
	// 				height: 500,
	// 				axes: {
	// 					x: {
	// 						0: {
	// 							side: 'bottom'
	// 						}
							
	// 					},
	// 					//colors: ['green', 'red']
	// 				}

	// 			};
	// 			var chart = new google.charts.Bar(document.getElementById('bar_chart'));
	// 			chart.draw(data, options);
	// 		}
	// 	});
	//}
</script>

<!-- </head> -->

<div class="row">
	<div class="col-sm-6">
		<h3>
			<?php
			echo get_phrase('direct_cash_transfer_report_for ') . date('F Y', $tym);
			?>
		</h3>
	</div>

	<div class="col-sm-6">
		<div class="btn btn-default pull-right col-sm-6"><a href="#" class="fa fa-backward scroll" id="prev"></a> <?= get_phrase('you_are_in'); ?> <?= date('F Y', $tym); ?> <input type="text" class="form-control col-sm-1" id="cnt" placeholder="<?= get_phrase('enter_number_of_months'); ?>" /> <a href="#" class="fa fa-forward scroll" id="next"></a></div>
	</div>

</div>

<hr />

<!-- <div class="row">
	<div class="col-sm-12">
		<div class="row">

			<div class="col-sm-3">

				<div class="tile-stats tile-primary">
					<div class="icon"><i class="entypo-suitcase"></i></div>
					<h3><?= get_phrase('Nation-wide total_dct_expense'); ?></h3>
					<div class="num" data-start="0" data-end="<?= $total_dct_expense; ?>" data-prefix="Kshs " data-postfix="" data-duration="1500" data-delay="0">0</div>

				</div>

			</div>

			<div class="col-md-3">
				<a href="#" style="text-decoration: none;">
					<div class="tile-stats tile-red">
						<div class="icon"><i class="fa fa-book"></i></div>
						<div class="num" data-start="0" data-end="<?= $total_dct_beneficiaries; ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>

						<h3>% <?= get_phrase('total_dct_beneficiaries'); ?></h3>

					</div>
				</a>
			</div>

		</div>
	</div> -->

	<div class="row">
		<div class="col-sm-12">

			<?php
			/*
		  Create the array of format: 
			Array ( [3-Central Region] => Array ( [E15] => 1052.00 [E30] => 6166.00 ) [4-Nairobi Region] => Array ( [E15] => 4.00 [E30] => 2.00 ) [1-Western Region] => Array ( [E15] => 2000.00 ) )
		*/
			$region_expenses = [];
			$region_names_and_ids = [];
			foreach ($dct_expenses_per_cluster_in_region as $dct_expenses_in_aregion) {
				$region_expenses[$dct_expenses_in_aregion['regionId']][$dct_expenses_in_aregion['region']][$dct_expenses_in_aregion['AccText']] = $dct_expenses_in_aregion['Cost'];
			}
			foreach ($region_expenses as $key => $region_expense) {
				foreach ($region_expense as $k => $expense) {

					$region_names_and_ids[$key . '-' . $k] = $expense;
				}
			}

			?>

			<table class='table-striped table'>
				<!-- thead -->
				<thead>
					<tr>
						<!-- Draw th for region and region-wide -->
						<th><?= get_phrase('region') ?></th>
						<th><?= get_phrase('region-wide_total'); ?></th>
						<?php
						
						$expense_account_codes = [];
						foreach ($region_names_and_ids as $region_name_and_id) {

							foreach ($region_name_and_id as $exp_code => $expense_code) {
								if (!in_array($exp_code, $expense_account_codes)) {
									$expense_account_codes[] = $exp_code; ?>
									<!-- draw the th for expenses -->
									<th><?= $exp_code; ?></th>

						<?php }
							}
						}
						?>
					</tr>
				</thead>
				<!-- tboady -->
				<tbody>
					<?php
					$national_total_dct = 0;
					foreach ($region_names_and_ids as $region_name_id_key => $region_name_and_id) {
						$national_total_dct += array_sum($region_name_and_id);
					?>

						<tr>
							<!-- Populate region name e.g. Western region and total amount for dct in 
					that region for all dct expenses acc -->
							<td>

								<?php
								//Get the value name and id for a region
								$region_name_and_id_array = explode('-', $region_name_id_key); ?>

								<a target='_blank' href='<?= base_url(); ?>ifms.php/smp/cluster_dct_in_aregion/<?= $tym . '/' . $region_name_and_id_array[0]; ?>'><?= $region_name_and_id_array[1]; ?></a>
								<?php

								?>

							</td>
							<td><?= number_format(array_sum($region_name_and_id), 2) ?></td>

							<!-- Populate  the expense amount for each region -->

							<?php foreach ($region_name_and_id as $key => $exp_account_and_totals) {

							?>
								<td><?= number_format($exp_account_and_totals, 2); ?></td>

							<?php } ?>

						</tr>

					<?php } ?>

					<tr>
						<td>
							<h2><?= get_phrase('nation-wide_total') ?></h2>
						</td>
						<td>
							<h2><?= number_format($national_total_dct, 2) ?></h2>
						</td>

						<?php
						//loop to populate totals for dct expense accounts in last row of the table
						foreach ($expense_account_codes as $expense_account_code) {
							$array_column_for_acc_exp = array_column($region_names_and_ids, $expense_account_code); ?>

							<td>
								<h2><?= number_format(array_sum($array_column_for_acc_exp), 2) ?></h2>
							</td>

						<?php
						} ?>
					</tr>

				</tbody>

			</table>
		</div>

	</div>
	<div id='bar_chart'></div>
</div>



<script>
	$(document).ready(function() {

		var datatable = $('.table').DataTable({
			stateSave: true,
			"bSort": false
		});
	});


	$('.scroll').click(function(ev) {
		//drawChart();

		var cnt = $('#cnt').val();

		if (cnt === "") {
			cnt = "1";
		}

		var dt = '<?php echo $tym; ?>';

		var flag = $(this).attr('id');

		var url = '<?php echo base_url(); ?>ifms.php/smp/dashboard/' + dt + '/' + cnt + '/' + flag;

		$(this).attr('href', url);
	});
</script>