<!-- 
	 @author: Onduso
	 @date: 29/5/2020

-->
<?php

//print_r($dct_expenses_per_cluster_in_region);
//echo $date;

//Construct an array of region all expenses from the raw data from database
$region_all_expenses = [];

foreach ($dct_expenses_per_cluster_in_region as $cluster) {
	$region_all_expenses[$cluster['regionId']][$cluster['region']][$cluster['AccText']] = $cluster['Cost'];
}
//Construct array keys of expenses
$array_keys_of_expenses = [];
foreach ($region_all_expenses as $region_expense) {

	foreach ($region_expense as $expense) {
		$array_keys_of_expenses = array_unique(array_merge($array_keys_of_expenses, array_keys($expense)));
	}
}
//Costruct array of costs per expense code per region
$region_expense_costs = [];
foreach ($region_all_expenses as $key => $region_expense) {

	foreach ($region_expense as $region_name => $expense) {
		//print_r($region_name);
		$expense_costs = [];
		foreach ($array_keys_of_expenses as $exp_cost) {
			//Check if the expense code is set if so type cast the cost to float otherwise pass 0
			if (isset($expense[$exp_cost])) {

				$expense_costs[] = (float) $expense[$exp_cost];
			} else {
				$expense_costs[] = 0;
			}
		}
		//Add region name to the expense_costs array as the first element of the array
		array_unshift($expense_costs, $region_name);

		$region_expense_costs[$key] = $expense_costs;
	}
}
$expense_accounts[] = 'Region';
$expense_account_codes[] = array_merge($expense_accounts, $array_keys_of_expenses);

//[["Region","E15","E30","E415"],["Central Region",3048,6166],["Coast Region",22000],["Nairobi Region",4,2],["Western Region",2000,68000]]
$javascrip_array = str_replace('}', ']', str_replace('{', '[', json_encode(array_merge($expense_account_codes, $region_expense_costs))));

//print_r($javascrip_array);

?>
<!-- Google Graphs Script-->
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
		var regions_and_expense_accounts = '<?= $javascrip_array; ?>';

		//alert(regions_and_expense_accounts);

		var data = google.visualization.arrayToDataTable(
			//Array of expenses accounts, cost, region
			JSON.parse(regions_and_expense_accounts),

			// [
			// 	["Region","E15","E30","E415",'E45', 'E60'],
			// 	["Central Region",3048,6166,7777,7000,8098],
			// 	["Coast Region",2334,9876,22000,3400,730],
			// 	["Nairobi Region",4100,3000,2000,4000,45000],
			// 	["Western Region",2000,68000,999,4500,9000]
			// ]
		);

		var options = {
			//title: 'Direct Cash Transfers per region per expense account',
			vAxis: {
				title: 'Cost'
			},
			hAxis: {
				title: 'Region'
			},
			seriesType: 'bars',
			//series: {5: {type: 'line'}}        
		};

		var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
		// Hide the div for the the message if graph draws
		google.visualization.events.addListener(chart, 'ready', function() {
			
			$('#message_div').addClass('hidden');
		});
		
		chart.draw(data, options);

	}
</script>

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
<div id='message_div' class='well well-lg'>
	<h4><b>No data to display graphically</b></h4>
</div>
<div id='chart_div'></div>

<br>
<br>
<hr />

<div class="row">
	<div class="col-sm-12">


		<table class='table-striped table'>
			<!-- table head -->
			<thead>
				<tr>
					<th><?= get_phrase('region'); ?></th>
					<?php


					/*Shift to remove get Array of format: array ( [0] => E15 [1] => E30 [2] => E415 )
				     Then loop to draw th for the table for accounts
				    */
					array_shift($expense_account_codes[0]);

					ksort($expense_account_codes[0]);

					foreach ($expense_account_codes[0] as $expense_account_code) { ?>

						<th><?= $expense_account_code; ?></th>

					<?php } ?>
				</tr>
			</thead>

			<!-- table body -->
			<tbody>
				<!-- Array ( 
						 [3] => Array ( [0] => Central Region [1] => 3169 [2] => 6166 [3] => 0 ) 
						 [2] => Array ( [0] => Coast Region [1] => 0 [2] => 0 [3] => 22000 ) 
						 [4] => Array ( [0] => Nairobi Region [1] => 4 [2] => 2 [3] => 0 ) 
						 [1] => Array ( [0] => Western Region [1] => 2000 [2] => 68000 [3] => 0 )
					   ) -->

				<?php
				//Populate each each region with expenses per account codes
				foreach ($region_expense_costs as $region_id => $region_expense_cost) { ?>

					<tr>

						<?php
						foreach ($region_expense_cost as $cost) {
							//Populate the cost of an expense account

							if (is_numeric($cost)) { ?>
								<td><?= number_format($cost, 2); ?></td>

							<?php
							} else { ?>
								<td>
									<a target='_blank' href='<?= base_url(); ?>ifms.php/mop/direct_cash_transfers_report/<?= $tym . '/' . $region_id  ?>'><?= $cost; ?></a>
								</td>
						<?php }
						} ?>
					</tr>

				<?php }
				?>
				<tr>
					<td>
						<h3><?= get_phrase('expense_totals'); ?></h3>
					</td>
					<?php
					//Get expense account codes with their monetary cost
					$expense_acc_codes_with_its_cost = [];
					foreach ($region_all_expenses as $key => $region_all_expense) {
						foreach ($region_all_expense as $exp_acc_code_keys_and_cost) {
							//store the array of expense account codes and cost
							$expense_acc_codes_with_its_cost[] = $exp_acc_code_keys_and_cost;
						}
					}

					//loop to populate totals for dct expense accounts in last row of the table for each expense account code
					foreach ($expense_account_codes[0] as $key => $expense_account_code) {
						$grouped_expenses_per_expense_account = array_column($expense_acc_codes_with_its_cost, $expense_account_code);
						//print_r($grouped_expenses_per_expense_account);

					?>
						<td>
							<!-- Sum up per account codes using array_sum -->
							<h3><?= number_format(array_sum($grouped_expenses_per_expense_account), 2) ?></h3>
						</td>
					<?php }

					?>
				</tr>


			</tbody>

		</table>

		<br>
		<br>


	</div>

</div>

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