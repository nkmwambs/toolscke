<?php
class Finance_dashboard{
	/**
	 * A public property to hold a reference to the CI controller
	 *
	 * @property object $CI
	 */

	public $CI;

	/**
	 * Holds the config item related to the finance dashboard feature
	 *
	 * @property string $table_prefix
	 */

	public $table_prefix = '';

	/**
	 * This is a class contruct instatiating class properties and loading the finance model
	 *
	 * @return void
	 */

	function __construct() {

		$this -> CI = &get_instance();

		$this -> CI -> load -> model('dashboard_model');

	}

	//General Methods

	public function get_table_prefix() {

		$this -> CI -> table_prefix = $this -> config -> item('table_prefix');

		return $this -> table_prefix;
	}

	public function group_data_by_fcp_id($database_results) {
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

	//public $pc_local_guideline_flags = array();

	public function callback_pc_local_guideline_compliance($fcp, $month){
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

	public function callback_pc_per_withdrawal_limit($fcp, $month){

		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_withdrawal'][$fcp])?$this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_withdrawal'][$fcp]:"";
		
		if(is_array($pc_per_withdrawal_limit)){
			$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		}
		
		return $flag;
	}

	public function callback_pc_per_expense_transaction_limit($fcp, $month = ""){

		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_transaction'][$fcp])?$this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_transaction'][$fcp]:"";
		
		if(is_array($pc_per_withdrawal_limit)){
			$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		}
		
		return $flag;
	}

	 function callback_pc_per_month_expense_limit($fcp, $month = ""){
		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_month'][$fcp])?$this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_month'][$fcp]:"";
		
		if(is_array($pc_per_withdrawal_limit)){
			$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		}
		
		return $flag;
	}

	public function callback_mfr_submitted($fcp, $month_submitted) {

		$mfr_submitted_data = $this -> CI -> dashboard_model -> switch_environment($month_submitted, 'test_mfr_submission_data_model', 'prod_mfr_submission_data_model');

		$group = $this -> group_data_by_fcp_id($mfr_submitted_data);

		$yes_no_flag = 'No';

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			if ($group[$fcp]['closure_date'] == $month_submitted && $group[$fcp]['submitted'] == 1) {
				$yes_no_flag = 'Yes ('.$group[$fcp]['submission_date'].')';
			}

		}
		return $yes_no_flag;
	}

	public function callback_total_for_pc($fcp, $month_submitted) {

		$total_pc_data = $this -> CI -> dashboard_model -> switch_environment($month_submitted, 'test_total_for_pc_data_model', 'prod_total_for_pc_data_model');

		$group = $this -> group_data_by_fcp_id($total_pc_data);

		$total_pc = 0.00;

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			$total_pc = $group[$fcp]['cost'];
		}
		return number_format($total_pc, 2);
	}

	public function callback_total_for_chq($fcp, $month_submitted) {

		$total_chq_data = $this -> CI -> dashboard_model -> switch_environment($month_submitted, 'test_total_for_pc_data_model', 'prod_total_for_chq_data_model');

		$group = $this -> group_data_by_fcp_id($total_chq_data);

		$total_chq = 0.00;

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($group[$fcp])) {
			$total_chq = $group[$fcp]['cost'];
		}
		return number_format($total_chq, 2);
	}

	public function callback_uncleared_cash_received($fcp, $month) {

		$uncleared_cash_recieved_data = $this -> CI -> dashboard_model -> switch_environment($month, 'test_uncleared_cash_recieved_data_model', 'prod_uncleared_cash_recieved_data_model');

		$group = $this -> group_data_by_fcp_id($uncleared_cash_recieved_data);

		$uncleared_cash_recieved = 0.00;

		//Check if the FCP is set and get the totals
		if (isset($group[$fcp])) {
			$uncleared_cash_recieved = $group[$fcp]['totals'];
		}
		//return number_format($uncleared_cash_recieved, 2);
		
		return $uncleared_cash_recieved>0?"No":"Yes";
	}

	public function callback_uncleared_cheques($fcp, $month) {

		$uncleared_cheques_data = $this -> CI -> dashboard_model -> switch_environment($month, 'test_uncleared_cheques_data_model', 'prod_uncleared_cheques_data_model');

		$group = $this -> group_data_by_fcp_id($uncleared_cheques_data);

		$uncleared_cheques = 0.00;

		//Check if the fcp
		if (isset($group[$fcp])) {
			$uncleared_cheques = $group[$fcp]['totals'];
		}
		//return number_format($uncleared_cheques, 2);
		return $uncleared_cheques>0?"No":"Yes";
	}

	// public function callback_caculate_transactions_from_petty_cash($fcp, $month) {
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

	// public function callback_fcp_local_pc_guideline($fcp, $month) {
// 
		// $fcp_local_pc_guideline = $this -> CI -> dashboard_model -> switch_environment($month, 'test_fcp_local_pc_guideline_data_model', 'prod_fcp_local_pc_guideline_data_model');
// 
		// $group_data_by_fcp = $this -> group_data_by_fcp_id($fcp_local_pc_guideline);
// 
		// $fcp_guideline_set_percentage = 0.00;
		// if (isset($group_data_by_fcp[$fcp])) {
			// $fcp_guideline_set_percentage = $group_data_by_fcp[$fcp]['pc_local_month_expense_limit'];
		// }
		// return $fcp_guideline_set_percentage;
	// }

	// public function callback_is_fcp_following_local_guideline($fcp, $month) {
// 
		// $fcp_follows_local_guideline='No';
// 
		// $fcp_follows_local_guideline_array=array();
// 
		// $fcp_local_guidline_set=$this->callback_fcp_local_pc_guideline($fcp, $month);
// 
		// $computed_percentage_of_pc_transaction=$this->callback_caculate_transactions_from_petty_cash($fcp, $month);
// 
		// //$fcp_local_guidlines_followed = $this -> CI -> dashboard_model -> switch_environment($month, 'test_is_fcp_following_local_guideline_data_model', 'prod_is_fcp_following_local_guideline_data_model');
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

	public function callback_mfr_submitted_date($fcp, $month_submitted)
	{

		$mfr_submitted_data = $this -> CI -> dashboard_model -> switch_environment($month_submitted, 'test_mfr_submission_data_model', 'prod_mfr_submission_data_model');

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

	public function callback_bank_statement_uploaded($fcp, $month_uploaded) {

		$bank_statement_submitted = $this -> CI -> dashboard_model -> switch_environment($month_uploaded, 'test_bank_statement_uploaded_model', 'prod_bank_statement_uploaded_model');

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

	public function callback_book_bank_balance($fcp, $month_computed) {

		$bank_cash_balance_data = $this -> CI -> dashboard_model -> switch_environment($month_computed, 'test_book_bank_cash_balance_data_model', 'prod_book_bank_cash_balance_data_model');

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

	public function callback_statement_bank_balance($fcp, $month_computed) {

		$statement_bank_balance_data = $this -> CI -> dashboard_model -> switch_environment($month_computed, 'test_statement_bank_balance_data_model', 'prod_statement_bank_balance_data_model');

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

	public function callback_outstanding_cheques($fcp, $month) {

		$outstanding_cheques_data = $this -> CI -> dashboard_model -> switch_environment($month, 'test_outstanding_cheques_data_model', 'prod_outstanding_cheques_data_model');

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

	public function callback_deposit_in_transit($fcp, $month) {

		$deposit_in_transit_data = $this -> CI -> dashboard_model -> switch_environment($month, 'test_deposit_in_transit_data_model', 'prod_deposit_in_transit_data_model');

		$deposit_in_transit_amount = 0.00;

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($deposit_in_transit_data[$fcp])) {
			if ($deposit_in_transit_data[$fcp]['closure_date'] == $month) {

				$deposit_in_transit_amount = $deposit_in_transit_data[$fcp]['deposit_in_transit_amount'];
			}
		}

		return number_format($deposit_in_transit_amount, 2);
	}

	public function callback_bank_reconcile_correct($fcp, $month) {

		$book_bank_balance = str_replace(',', '', $this -> callback_book_bank_balance($fcp, $month));

		$statement_balance = str_replace(',', '', $this -> callback_statement_bank_balance($fcp, $month));

		$outstanding_cheques = str_replace(',', '', $this -> callback_outstanding_cheques($fcp, $month));

		$deposit_in_transit = str_replace(',', '', $this -> callback_deposit_in_transit($fcp, $month));

		$compute_bank_reconcile = ($book_bank_balance + $outstanding_cheques) - $deposit_in_transit;

		$yes_no_flag = 'No';

		if (round($compute_bank_reconcile) == round($statement_balance) && $this -> callback_mfr_submitted($fcp, $month) == "Yes") {
			$yes_no_flag = 'Yes';
		}

		return $yes_no_flag;
	}

	public function callback_cash_received_in_month($fcp,$month) {
		$cash_received_in_month = $this -> CI ->dashboard_model-> switch_environment($month, 'test_cash_received_in_month_model', 'prod_cash_received_in_month_model');

		$cash_received_in_month_amount = 0.00;

		//Check if the fcp has an Mfr submitted in the $month_submitted
		if (isset($cash_received_in_month[$fcp])) {
			$cash_received_in_month_amount = $cash_received_in_month[$fcp]['cash_received_in_month_amount'];
		}

		return number_format($cash_received_in_month_amount, 2);
	}	
	//Main render array methods
	
	public function build_dashboard_array($dashboard_month,$count_of_fcps,$fcp_in_dashboard) {

		$fcps_array_with_risk = '';

		if ($this -> CI->config -> item('environment') == 'test') {
			$fcps_array_with_risk = $this -> CI-> dashboard_model -> test_fcps_with_risk_model();
		} elseif ($this -> CI-> config -> item('environment') == 'prod') {
			$fcps_array_with_risk = $this ->CI->dashboard_model-> prod_fcps_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
		}

		$run_obj = $this->CI->db->get_where('dashboard_run',array("month"=>$dashboard_month));

		$parameters_array = $this -> CI ->dashboard_model-> switch_environment('', 'test_dashboard_parameters_model', 'prod_dashboard_parameters_model');

		//$final_grid_array = array();

		$final_grid_array['fcps_with_risks'] = array();

		$final_grid_array['parameters'] = array();

		$loops = 1;

		$new_insert_id = 0;
		$fcp_records_run = 0;
		foreach ($fcps_array_with_risk as $fcp_with_risk) {
			
			$projectsdetails_id = $this->CI->dashboard_model->get_fcp_primary_key($fcp_with_risk['fcp_id']);

			if($loops == 1 && $run_obj->num_rows() == 0){
				// Insert a new run if not existing
				$run_data['month'] = $dashboard_month;
				$run_data['run_count'] = 1;
				$run_data['fcp_records_run'] = 1;
				$run_data['run_start_date'] = date('Y-m-d h:i:s');

				$this->CI->db->insert('dashboard_run',$run_data);	
				$new_insert_id = $this->CI->db->insert_id();		
			
			}

			// Break the for loop if looping limit is set in dev_config 
			if($this -> CI-> config -> item('fcp_test_loops') > 0 && 
				$loops ==   $this -> CI-> config -> item('fcp_test_loops') ){
				break;
				exit();
			}
				
			// Update fcp_records_run in dashboard_run table if a new run or the run has an update
			$fcp_changes = $this->CI->db->get_where('dashboard_change',array('month'=>$dashboard_month,'projectsdetails_id'=>$projectsdetails_id))->num_rows();
			if($new_insert_id > 0 || $fcp_changes > 0 || $count_of_fcps > $fcp_in_dashboard) {
				$fcp_records_run++;
				$this->CI->db->where(array('month'=>$dashboard_month));
				$this->CI->db->update('dashboard_run',array('fcp_records_run'=>$fcp_records_run));
			}


			$final_grid_array['fcps_with_risks'][$fcp_with_risk['fcp_id']]['risk'] = $fcp_with_risk['risk'];

			foreach ($parameters_array as $key => $value) {

				if ($value['display_on_dashboard'] == 'yes') {

					$final_grid_array['fcps_with_risks'][$fcp_with_risk['fcp_id']]['params'][$key] = call_user_func(array($this, $value['result_method']), $fcp_with_risk['fcp_id'], $dashboard_month);
					//$this->loops = $this->CI->dashboard_model->insert_parameters_dashboard_table($dashboard_month, $final_grid_array);
					$this->loops = $this->CI->dashboard_model->insert_parameters_dashboard_table($dashboard_month, $final_grid_array);
				}
			}

			$loops++;

		}


		return $final_grid_array;
	}

}
