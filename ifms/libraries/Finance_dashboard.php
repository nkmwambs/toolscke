<?php
class Finance_dashboard{

	private $testModels;
	private $CI;
	private $table_prefix = '';
		
	function __construct() {

		$this->CI =& get_instance();
		// $this -> load -> config('dev_config');
		// $this -> get_table_prefix();
		$this -> CI-> load -> model('finance_model');
// 
		// $this -> testModels = new Finance_testData();
		
	}

	//General Methods

	private function get_table_prefix() {

		$this -> CI-> table_prefix = $this -> config -> item('table_prefix');

		return $this -> table_prefix;
	}

	private function group_data_by_fcp_id($database_results) {

		$group_by_fcp_id_array = array();

		foreach ($database_results as $row) {

			if (isset($row['fcp_id'])) {
				$group_by_fcp_id_array[$row['fcp_id']] = $row;
			}

		}

		return $group_by_fcp_id_array;
	}

	//Callback Methods

	private function callback_mfr_submitted($fcp, $month_submitted) {

		$mfr_submitted_data = $this -> CI ->finance_model-> switch_environment($month_submitted, 'test_mfr_submission_data_model', 'prod_mfr_submission_data_model');

		$group = $this -> group_data_by_fcp_id($mfr_submitted_data);

		$yes_no_flag = 'No';

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			if ($group[$fcp]['closure_date'] == $month_submitted && $group[$fcp]['submitted'] == 1) {
				$yes_no_flag = 'Yes';
			}

		}
		return $yes_no_flag;
	}

	private function callback_bank_statement_uploaded($fcp, $month_uploaded) {

		$bank_statement_submitted = $this -> CI ->finance_model-> switch_environment($month_uploaded, 'test_bank_statement_uploaded_model', 'prod_bank_statement_uploaded_model');

		$group = $this -> group_data_by_fcp_id($bank_statement_submitted);

		$yes_no_flag = 'No';

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp]['closure_date'])) {
			if ($group[$fcp]['closure_date'] == $month_uploaded) {

				$yes_no_flag = $group[$fcp]['file_exists'] ? 'Yes' : 'No';
			}
		}

		return $yes_no_flag;
	}

	private function callback_book_bank_balance($fcp, $month_computed) {

		$bank_cash_balance_data = $this -> CI ->finance_model-> switch_environment($month_computed, 'test_book_bank_cash_balance_data_model', 'prod_book_bank_cash_balance_data_model');

		$group = $this -> group_data_by_fcp_id($bank_cash_balance_data);

		$balance_amount = 0.00;

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			if ($group[$fcp]['closure_date'] == $month_computed && $group[$fcp]['account_type'] == 'BC') {

				$balance_amount = $group[$fcp]['balance_amount'];
			}
		}

		return number_format($balance_amount, 2);
	}

	private function callback_statement_bank_balance($fcp, $month_computed) {

		$statement_bank_balance_data = $this -> CI ->finance_model->switch_environment($month_computed, 'test_statement_bank_balance_data_model', 'prod_statement_bank_balance_data_model');

		$statement_bank_balance_amount = 0.00;

		$group = $this -> group_data_by_fcp_id($statement_bank_balance_data);

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			if ($group[$fcp]['closure_date'] == $month_computed) {

				$statement_bank_balance_amount = $group[$fcp]['statement_amount'];
			}
		}

		return number_format($statement_bank_balance_amount, 2);
	}

	private function callback_outstanding_cheques($fcp, $month) {

		$outstanding_cheques_data = $this -> CI ->finance_model-> switch_environment($month, 'test_outstanding_cheques_data_model', 'prod_outstanding_cheques_data_model');

		$outstanding_cheques_amount = 0.00;

		//$group = $this -> group_data_by_fcp_id($outstanding_cheques_data);

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($outstanding_cheques_data[$fcp])) {
			if ($outstanding_cheques_data[$fcp]['closure_date'] == $month) {

				$outstanding_cheques_amount = $outstanding_cheques_data[$fcp]['outstanding_cheque_amount'];
			}
		}

		return number_format($outstanding_cheques_amount, 2);
	}

	private function callback_deposit_in_transit($fcp, $month) {

		$deposit_in_transit_data = $this -> CI ->finance_model-> switch_environment($month, 'test_deposit_in_transit_data_model', 'prod_deposit_in_transit_data_model');

		$deposit_in_transit_amount = 0.00;

		//$group = $this -> group_data_by_fcp_id($deposit_in_transit_data);

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($deposit_in_transit_data[$fcp])) {
			if ($deposit_in_transit_data[$fcp]['closure_date'] == $month) {

				$deposit_in_transit_amount = $deposit_in_transit_data[$fcp]['deposit_in_transit_amount'];
			}
		}

		return number_format($deposit_in_transit_amount, 2);
	}

	private function callback_bank_reconcile_correct($fcp, $month) {

		$book_bank_balance = str_replace(',', '', $this -> callback_book_bank_balance($fcp, $month));

		$statement_balance = str_replace(',', '', $this -> callback_statement_bank_balance($fcp, $month));

		$outstanding_cheques = str_replace(',', '', $this -> callback_outstanding_cheques($fcp, $month));

		$deposit_in_transit = str_replace(',', '', $this -> callback_deposit_in_transit($fcp, $month));

		$compute_bank_reconcile = ($book_bank_balance + $outstanding_cheques) - $deposit_in_transit;

		$yes_no_flag = 'No';

		if (round($compute_bank_reconcile, 2) == round($statement_balance, 2) && $this -> callback_mfr_submitted($fcp, $month) == "Yes") {
			$yes_no_flag = 'Yes';
		}

		return $yes_no_flag;
	}
	
	//Main render array methods

	public function build_dashboard_array($dashboard_month) {

		//$test = new Finance_testData();

		$fcps_array_with_risk = '';

		if ($this -> CI->config -> item('environment') == 'test') {
			$fcps_array_with_risk = $this -> CI-> finance_model -> test_fcps_with_risk_model();
		} elseif ($this -> CI-> config -> item('environment') == 'prod') {
			$fcps_array_with_risk = $this ->CI->finance_model-> prod_fcps_with_risk_model();
		}

		$parameters_array = $this -> CI ->finance_model-> switch_environment('', 'test_dashboard_parameters_model', 'prod_dashboard_parameters_model');

		$final_grid_array = array();

		$final_grid_array['fcps_with_risks'] = array();

		$final_grid_array['parameters'] = array();

		foreach ($fcps_array_with_risk as $fcp_with_risk) {

			$final_grid_array['fcps_with_risks'][$fcp_with_risk['fcp_id']]['risk'] = $fcp_with_risk['risk'];

			foreach ($parameters_array as $key => $value) {

				if ($value['display_on_dashboard'] == 'yes') {

					$final_grid_array['fcps_with_risks'][$fcp_with_risk['fcp_id']]['params'][$key] = call_user_func(array($this, $value['result_method']), $fcp_with_risk['fcp_id'], $dashboard_month);
				}
			}

		}

		foreach ($parameters_array as $key => $value) {
			if ($value['display_on_dashboard'] == 'yes') {
				$final_grid_array['parameters'][$value['is_requested']][$key] = $value['dashboard_parameter_name'];
			}

		}

		return $final_grid_array;
	}

}
