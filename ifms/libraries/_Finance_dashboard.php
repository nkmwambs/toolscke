<?php

/**
 * This file is part of the version 2.0 finance enhancements in Compassion Kenya Toolkit
 */

/**
 * This is a class used to render the finance dashboard array intended to populate the finance dashboard grid.
 *
 * @author 	: Nicodemus Karisa and Livingstone Onduso
 *	@since		: June, 2019
 *	@package	: Compassion Kenya Toolkit
 *	@copyright	: Copyright (c) 2019
 *	@version    : Version 1.0.0
 *
 */

class Finance_dashboard {

	/**
	 * A private property to hold a reference to the CI controller
	 *
	 * @property object $CI
	 */

	private $CI;

	/**
	 * Holds the config item related to the finance dashboard feature
	 *
	 * @property string $table_prefix
	 */

	private $table_prefix = '';

	/**
	 * This is a class contruct instatiating class properties and loading the finance model
	 *
	 * @return void
	 */

	function __construct() {

		$this -> CI = &get_instance();

		$this -> CI -> load -> model('finance_model');

	}

	//General Methods

	private function get_table_prefix() {

		$this -> CI -> table_prefix = $this -> config -> item('table_prefix');

		return $this -> table_prefix;
	}

	private function group_data_by_fcp_id($database_results) {
		$this->CI->benchmark->mark('group_data_by_fcp_id_start');
		$group_by_fcp_id_array = array();

		foreach ($database_results as $row) {

			if (isset($row['fcp_id'])) {
				$group_by_fcp_id_array[$row['fcp_id']] = $row;
			}

		}
		$this->CI->benchmark->mark('group_data_by_fcp_id_end');
		return $group_by_fcp_id_array;
	}

	//Callback Methods

	/*
	 This callback method helps check following parameters
	 * 1) Param 4: 'If MFR has been submitted or not'
	 * 2) Param 10: 'If the previous/beginning balance agree  with last month ending balance.

	 */

	//private $pc_local_guideline_flags = array();

	private function callback_pc_local_guideline_compliance($fcp, $month){
		$pc_per_withdrawal_limit_flag = $this->callback_pc_per_withdrawal_limit($fcp,$month);
		$per_transaction_pc_limit = $this->callback_pc_per_expense_transaction_limit($fcp,$month);
		$per_month_pc_expenses = $this->callback_pc_per_month_expense_limit($fcp,$month);

		$set_flag = 'Yes';

		if(
			$pc_per_withdrawal_limit_flag == "No" || $per_transaction_pc_limit == 'No' || $per_month_pc_expenses == "No" ||
			$pc_per_withdrawal_limit_flag == "Not Set" || $per_transaction_pc_limit == 'Not Set' || $per_month_pc_expenses == "Not Set"
		){
					$set_flag = 'No';
		}

		return $set_flag;
	}

	private function callback_pc_per_withdrawal_limit($fcp, $month){

		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->finance_model->pc_limit_by_type['per_withdrawal'][$fcp])?$this->CI->finance_model->pc_limit_by_type['per_withdrawal'][$fcp]:"";
		
		if(is_array($pc_per_withdrawal_limit)){
			$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		}
		
		return $flag;
	}

	private function callback_pc_per_expense_transaction_limit($fcp, $month = ""){

		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->finance_model->pc_limit_by_type['per_transaction'][$fcp])?$this->CI->finance_model->pc_limit_by_type['per_transaction'][$fcp]:"";
		
		if(is_array($pc_per_withdrawal_limit)){
			$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		}
		
		return $flag;
	}

	 function callback_pc_per_month_expense_limit($fcp, $month = ""){
		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->finance_model->pc_limit_by_type['per_month'][$fcp])?$this->CI->finance_model->pc_limit_by_type['per_month'][$fcp]:"";
		
		if(is_array($pc_per_withdrawal_limit)){
			$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		}
		
		return $flag;
	}

	private function callback_mfr_submitted($fcp, $month_submitted) {

		$mfr_submitted_data = $this -> CI -> finance_model -> switch_environment($month_submitted, 'test_mfr_submission_data_model', 'prod_mfr_submission_data_model');

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

	private function callback_total_for_pc($fcp, $month_submitted) {

		$total_pc_data = $this -> CI -> finance_model -> switch_environment($month_submitted, 'test_total_for_pc_data_model', 'prod_total_for_pc_data_model');

		$group = $this -> group_data_by_fcp_id($total_pc_data);

		$total_pc = 0.00;

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			$total_pc = $group[$fcp]['cost'];
		}
		return number_format($total_pc, 2);
	}

	private function callback_total_for_chq($fcp, $month_submitted) {

		$total_chq_data = $this -> CI -> finance_model -> switch_environment($month_submitted, 'test_total_for_pc_data_model', 'prod_total_for_chq_data_model');

		$group = $this -> group_data_by_fcp_id($total_chq_data);

		$total_chq = 0.00;

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			$total_chq = $group[$fcp]['cost'];
		}
		return number_format($total_chq, 2);
	}

	private function callback_uncleared_cash_received($fcp, $month) {

		$uncleared_cash_recieved_data = $this -> CI -> finance_model -> switch_environment($month, 'test_uncleared_cash_recieved_data_model', 'prod_uncleared_cash_recieved_data_model');

		$group = $this -> group_data_by_fcp_id($uncleared_cash_recieved_data);

		$uncleared_cash_recieved = 0.00;

		//Check if the FCP is set and get the totals
		if (isset($group[$fcp])) {
			$uncleared_cash_recieved = $group[$fcp]['totals'];
		}
		//return number_format($uncleared_cash_recieved, 2);
		
		return $uncleared_cash_recieved>0?"No":"Yes";
	}

	private function callback_uncleared_cheques($fcp, $month) {

		$uncleared_cheques_data = $this -> CI -> finance_model -> switch_environment($month, 'test_uncleared_cheques_data_model', 'prod_uncleared_cheques_data_model');

		$group = $this -> group_data_by_fcp_id($uncleared_cheques_data);

		$uncleared_cheques = 0.00;

		//Check if the fcp
		if (isset($group[$fcp])) {
			$uncleared_cheques = $group[$fcp]['totals'];
		}
		//return number_format($uncleared_cheques, 2);
		return $uncleared_cheques>0?"No":"Yes";
	}

	// private function callback_caculate_transactions_from_petty_cash($fcp, $month) {
// 
		// //get the total transactions from Petty cash and bank
		// $total_transactions_from_pc = floatval(str_replace(',', '', $this -> callback_total_for_pc($fcp, $month)));
// 
		// $total_transactions_from_chq = floatval(str_replace(',', '', $this -> callback_total_for_chq($fcp, $month)));
// 
		// //Compute denominater and percentage of petty cash transactions
		// $compute_denominator = bcadd($total_transactions_from_pc, $total_transactions_from_chq, 2);
// 
		// $compute_percentage = 0.0;
// 
		// //Avoid divide by zero
		// if ($total_transactions_from_pc > 0) {
			// $compute_percentage = number_format((($total_transactions_from_pc / $compute_denominator) * 100), 2);
		// }
		// return $compute_percentage;
	// }

	// private function callback_fcp_local_pc_guideline($fcp, $month) {
// 
		// $fcp_local_pc_guideline = $this -> CI -> finance_model -> switch_environment($month, 'test_fcp_local_pc_guideline_data_model', 'prod_fcp_local_pc_guideline_data_model');
// 
		// $group_data_by_fcp = $this -> group_data_by_fcp_id($fcp_local_pc_guideline);
// 
		// $fcp_guideline_set_percentage = 0.00;
		// if (isset($group_data_by_fcp[$fcp])) {
			// $fcp_guideline_set_percentage = $group_data_by_fcp[$fcp]['pc_local_month_expense_limit'];
		// }
		// return $fcp_guideline_set_percentage;
	// }

	// private function callback_is_fcp_following_local_guideline($fcp, $month) {
// 
		// $fcp_follows_local_guideline='No';
// 
		// $fcp_follows_local_guideline_array=array();
// 
		// $fcp_local_guidline_set=$this->callback_fcp_local_pc_guideline($fcp, $month);
// 
		// $computed_percentage_of_pc_transaction=$this->callback_caculate_transactions_from_petty_cash($fcp, $month);
// 
		// //$fcp_local_guidlines_followed = $this -> CI -> finance_model -> switch_environment($month, 'test_is_fcp_following_local_guideline_data_model', 'prod_is_fcp_following_local_guideline_data_model');
// 
		// //Avoided to use prod_is_fcp_following_local_guideline_data_model
		// //Source for data from projectsdatails to use it in the group_data_by_fcp_id function
// 
		// $this -> CI->db -> cache_on();
		// $fcp_local_guidlines_followed = $this ->CI->db -> select(array('icpNo')) -> get('projectsdetails') -> result_array();
// 
		// $this -> CI->db -> cache_off();
// 
		// foreach ($fcp_local_guidlines_followed as $fcp_local_guidline)
		// {
			// $fcp_follows_local_guideline_array[$fcp_local_guidline['icpNo']]['fcp_id'] = $fcp_local_guidline['icpNo'];
		// }
		// $group_data_by_fcp = $this -> group_data_by_fcp_id($fcp_follows_local_guideline_array);
// 
		// //Compute if the FCP follows local guideline
		// if (isset($group_data_by_fcp[$fcp])) {
// 
			// if($computed_percentage_of_pc_transaction <= $fcp_local_guidline_set){
// 
				// $fcp_follows_local_guideline='Yes';
			// }
// 
		// }
		// //Return the 'Yes' or No concanating it with the computed percentage of pc transactions and append %
		// return $fcp_follows_local_guideline. ' ( '.$computed_percentage_of_pc_transaction.'%)';
	// }

	private function callback_mfr_submitted_date($fcp, $month_submitted)
	{

		$mfr_submitted_data = $this -> CI -> finance_model -> switch_environment($month_submitted, 'test_mfr_submission_data_model', 'prod_mfr_submission_data_model');

		$group = $this -> group_data_by_fcp_id($mfr_submitted_data);

		$submission_date = '';

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			if ($group[$fcp]['closure_date'] == $month_submitted && $group[$fcp]['submitted'] == 1) {
				$submission_date = $group[$fcp]['submission_date'];
			}

		}
		return $submission_date;
	}

	private function callback_bank_statement_uploaded($fcp, $month_uploaded) {

		$bank_statement_submitted = $this -> CI -> finance_model -> switch_environment($month_uploaded, 'test_bank_statement_uploaded_model', 'prod_bank_statement_uploaded_model');

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

		$bank_cash_balance_data = $this -> CI -> finance_model -> switch_environment($month_computed, 'test_book_bank_cash_balance_data_model', 'prod_book_bank_cash_balance_data_model');

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

		$statement_bank_balance_data = $this -> CI -> finance_model -> switch_environment($month_computed, 'test_statement_bank_balance_data_model', 'prod_statement_bank_balance_data_model');

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

		$outstanding_cheques_data = $this -> CI -> finance_model -> switch_environment($month, 'test_outstanding_cheques_data_model', 'prod_outstanding_cheques_data_model');

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

		$deposit_in_transit_data = $this -> CI -> finance_model -> switch_environment($month, 'test_deposit_in_transit_data_model', 'prod_deposit_in_transit_data_model');

		$deposit_in_transit_amount = 0.00;

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

		if (round($compute_bank_reconcile, 2) == round($book_bank_balance, 2) && $this -> callback_mfr_submitted($fcp, $month) == "Yes") {
			$yes_no_flag = 'Yes';
		}

		return $yes_no_flag;
	}

	private function callback_cash_received_in_month($fcp,$month) {
		$cash_received_in_month = $this -> CI ->finance_model-> switch_environment($month, 'test_cash_received_in_month_model', 'prod_cash_received_in_month_model');

		$cash_received_in_month_amount = 0.00;

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($cash_received_in_month[$fcp])) {
			$cash_received_in_month_amount = $cash_received_in_month[$fcp]['cash_received_in_month_amount'];
		}

		return number_format($cash_received_in_month_amount, 2);
	}


	//Main render array methods

	public function build_dashboard_array($dashboard_month, $vtype = '') {

		$this->CI->benchmark->mark('build_dashboard_array_start');

		$fcps_array_with_risk = '';
		$this->CI->benchmark->mark('build_dashboard_array_switch_environ_start');
		if ($this -> CI -> config -> item('environment') == 'test') {
			$fcps_array_with_risk = $this -> CI -> finance_model -> test_fcps_with_risk_model();
		} elseif ($this -> CI -> config -> item('environment') == 'prod') {
			$fcps_array_with_risk = $this -> CI -> finance_model -> prod_fcps_with_risk_model();
		}
		
		$parameters_array = $this -> CI -> finance_model -> switch_environment('', 'test_dashboard_parameters_model', 'prod_dashboard_parameters_model');

		$this->CI->benchmark->mark('build_dashboard_array_switch_environ_end');
		
		$final_grid_array = array();
		
		$final_grid_array['fcps_with_risks'] = array();

		$final_grid_array['parameters'] = array();
		
		$this->CI->benchmark->mark('build_dashboard_array_fcp_loop_start');
		
		foreach ($fcps_array_with_risk as $fcp_with_risk) {

			$final_grid_array['fcps_with_risks'][$fcp_with_risk['fcp_id']]['risk'] = $fcp_with_risk['risk'];

			foreach ($parameters_array as $key => $value) {

				if ($value['display_on_dashboard'] == 'yes') {
					$this->CI->benchmark->mark($value['result_method'].'_start');
						$final_grid_array['fcps_with_risks'][$fcp_with_risk['fcp_id']]['params'][$key] = call_user_func(array($this, $value['result_method']), $fcp_with_risk['fcp_id'], $dashboard_month, $vtype);
					$this->CI->benchmark->mark($value['result_method'].'_end');
					
				}
			}

		}
		$this->CI->benchmark->mark('build_dashboard_array_fcp_loop_end');
		
		$this->CI->benchmark->mark('build_dashboard_array_param_loop_start');	
		foreach ($parameters_array as $key => $value) {
			if ($value['display_on_dashboard'] == 'yes') {
				$final_grid_array['parameters'][$value['is_requested']][$key] = $value['dashboard_parameter_name'];
			}

		}
		$this->CI->benchmark->mark('build_dashboard_array_param_loop_end');
		
		$this->CI->benchmark->mark('build_dashboard_array_end');
		return $final_grid_array;
	}

}
