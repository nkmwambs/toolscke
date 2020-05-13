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

	public function callback_pc_per_withdrawal_limit($month){

		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_withdrawal'][$fcp])?$this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_withdrawal'][$fcp]:"";
		
		// if(is_array($pc_per_withdrawal_limit)){
		// 	$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		// }
		
		return $pc_per_withdrawal_limit;
	}

	public function callback_pc_per_expense_transaction_limit($month = ""){

		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_transaction'][$fcp])?$this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_transaction'][$fcp]:"";
		
		// if(is_array($pc_per_withdrawal_limit)){
		// 	$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		// }
		
		return $pc_per_withdrawal_limit;
	}

	 function callback_pc_per_month_expense_limit($month = ""){
		$flag = "Yes";
		
		$pc_per_withdrawal_limit = isset($this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_month'][$fcp])?$this->CI->dashboard_model->prod_pc_limit_by_type_model($month)['per_month'][$fcp]:"";
		
		// if(is_array($pc_per_withdrawal_limit)){
		// 	$flag = $pc_per_withdrawal_limit['limit_compliance_flag'];	
		// }
		
		return $pc_per_withdrawal_limit;
	}

	public function callback_mfr_submitted($month_submitted) {

		$mfr_submitted_data = $this -> CI -> dashboard_model -> switch_environment($month_submitted, 'test_mfr_submission_data_model', 'prod_mfr_submission_data_model');

		$final_array = [];

		foreach($mfr_submitted_data as $value){
			$final_array[$value['fcp_id']] = "Yes (".$value['submission_date'].")";
		}

		return $final_array;
	}

	public function callback_total_for_pc($month_submitted) {

		$total_pc_data = $this -> CI -> dashboard_model -> switch_environment($month_submitted, 'test_total_for_pc_data_model', 'prod_total_for_pc_data_model');

		$final_array = [];

		foreach($total_pc_data as $key => $value){
			$final_array[$key] = $value['cost'];
		}

		return $final_array;
	}

	public function callback_total_for_chq($month_submitted) {

		$total_chq_data = $this -> CI -> dashboard_model -> switch_environment($month_submitted, 'test_total_for_pc_data_model', 'prod_total_for_chq_data_model');

		return $total_chq_data;
	}

	public function callback_uncleared_cash_received($month) {

		$uncleared_cash_recieved_data = $this -> CI -> dashboard_model -> switch_environment($month, 'test_uncleared_cash_recieved_data_model', 'prod_uncleared_cash_recieved_data_model');

		$final_array = [];

		foreach($uncleared_cash_recieved_data as $key => $value){
			$final_array[$key] = $value>0?"No":"Yes";;
		}

		return $final_array;
	}

	public function callback_uncleared_cheques($month) {

		$uncleared_cheques_data = $this -> CI -> dashboard_model -> switch_environment($month, 'test_uncleared_cheques_data_model', 'prod_uncleared_cheques_data_model');

		$final_array = [];
		
		foreach($uncleared_cheques_data as $key => $value){
			$final_array[$key] = $value>0?"No":"Yes";;
		}

		return $final_array;
	}

	public function callback_mfr_submitted_date($month_submitted)
	{

		$mfr_submitted_data = $this -> CI -> dashboard_model -> switch_environment($month_submitted, 'test_mfr_submission_data_model', 'prod_mfr_submission_data_model');

		$final_array = [];

		foreach($mfr_submitted_data as $value){
			$final_array[$value['fcp_id']] = $value['submission_date'];
		}

		return $final_array;
	}

	public function callback_bank_statement_uploaded($month_uploaded) {

		$bank_statement_submitted = $this -> CI -> dashboard_model -> switch_environment($month_uploaded, 'test_bank_statement_uploaded_model', 'prod_bank_statement_uploaded_model');

		return $bank_statement_submitted;
	}

	public function callback_book_bank_balance($month_computed) {

		$bank_cash_balance_data = $this -> CI -> dashboard_model -> switch_environment($month_computed, 'test_book_bank_cash_balance_data_model', 'prod_book_bank_cash_balance_data_model');

		$final_array = [];

		foreach($bank_cash_balance_data as $value){
			$final_array[$value['fcp_id']] = $value['balance_amount'];
		}

		return $final_array;
	}

	public function callback_statement_bank_balance($month_computed) {

		$statement_bank_balance_data = $this -> CI -> dashboard_model -> switch_environment($month_computed, 'test_statement_bank_balance_data_model', 'prod_statement_bank_balance_data_model');

		$final_array = [];

		foreach($statement_bank_balance_data as $value){
			$final_array[$value['fcp_id']] = $value['statement_amount'];
		}
		
		return $final_array;
	}

	public function callback_outstanding_cheques($month) {

		$outstanding_cheques_data = $this -> CI -> dashboard_model -> switch_environment($month, 'test_outstanding_cheques_data_model', 'prod_outstanding_cheques_data_model');
		
		$final_array = [];

		foreach($outstanding_cheques_data as $value){
			$final_array[$value['fcp_id']] = $value['outstanding_cheque_amount'];
		}

		return $final_array;
	}

	public function callback_deposit_in_transit($month) {

		$deposit_in_transit_data = $this -> CI -> dashboard_model -> switch_environment($month, 'test_deposit_in_transit_data_model', 'prod_deposit_in_transit_data_model');

		$final_array = [];

		foreach($deposit_in_transit_data as $value){
			$final_array[$value['fcp_id']] = $value['deposit_in_transit_amount'];
		}

		return $final_array;
	}

	public function callback_bank_reconcile_correct($month) {

		//$this->CI->db->cache_on();

		$book_bank_balance = $this -> callback_book_bank_balance($month);
		$statement_balance = $this -> callback_statement_bank_balance($month);
		$outstanding_cheques = $this -> callback_outstanding_cheques($month);
		$deposit_in_transit = $this -> callback_deposit_in_transit($month);
		
		//$this->CI->db->cache_off();

		$book_bank_balance_fcps = array_keys($book_bank_balance);
		$statement_balance_fcps = array_keys($statement_balance);
		$outstanding_cheques_fcps = array_keys($outstanding_cheques);
		$deposit_in_transit_fcps = array_keys($deposit_in_transit);

		$fcp_numbers =  array_merge($book_bank_balance_fcps,$statement_balance_fcps,$outstanding_cheques_fcps,$deposit_in_transit_fcps);
		
		$final_array = [];

		foreach(array_unique($fcp_numbers) as $fcp_id){
			$statement_bal = isset($statement_balance[$fcp_id])?$statement_balance[$fcp_id]:0;

			$bank = isset($book_bank_balance[$fcp_id])?$book_bank_balance[$fcp_id]:0;
			$os_chq = isset($outstanding_cheques[$fcp_id])?$outstanding_cheques[$fcp_id]:0;
			$dep_trans = isset($deposit_in_transit[$fcp_id])?$deposit_in_transit[$fcp_id]:0;

			$compute_bank_reconcile = round(($bank + $os_chq) - $dep_trans,2);
			
			$yes_no_flag = 'No';

			//if (round($compute_bank_reconcile) == round($statement_bal) && isset($this -> callback_mfr_submitted_date($month)[$fcp_id])) {
			if (round($compute_bank_reconcile) == round($statement_bal) ) {
				$yes_no_flag = "Yes";
			}

			$final_array[$fcp_id] = $yes_no_flag;
		}

		return $final_array;
	}

	public function callback_cash_received_in_month($month) {
		$cash_received_in_month = $this -> CI ->dashboard_model-> switch_environment($month, 'test_cash_received_in_month_model', 'prod_cash_received_in_month_model');
		
		$final_array = [];

		foreach($cash_received_in_month as $key => $value){
			$final_array[$key] = $value['Cost'];
		}

		return $final_array;
	}	

	//Main render array methods

	public function build_dashboard_array($dashboard_month,$count_of_fcps,$fcp_in_dashboard){
		
		// Checks if a dashboard run for the month exists and update it or creates a new one
		$dashboard_run_id = $this->CI->dashboard_model->check_dashboard_run_on_initialization($dashboard_month);

		$run_start_date = date('Y-m-d h:i:s');

		$fcps_array_with_risk = [];

		if ($this -> CI->config -> item('environment') == 'test') {
			$fcps_array_with_risk = $this -> CI-> dashboard_model -> test_fcps_with_risk_model();
		} elseif ($this -> CI-> config -> item('environment') == 'prod') {
			$fcps_array_with_risk = $this ->CI->dashboard_model-> prod_fcps_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
			$this ->CI->dashboard_model-> prod_fcps_numbers_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);

		}

		$parameters_array = $this -> CI ->dashboard_model-> switch_environment('', 'test_dashboard_parameters_model', 'prod_dashboard_parameters_model');

		$final_grid_array = [];

		$fcps_to_update = [];
		// Adopt a batch functionality to process this piece in the future to build the $final_grid_array and inserting in table

		foreach($parameters_array as $parameter){

			if(!method_exists($this,$parameter['result_method']) || $parameter['display_on_dashboard'] == 'no') continue;
			
			$callback_results  = call_user_func(array($this, $parameter['result_method']), $dashboard_month);

			foreach($fcps_array_with_risk as $projectsdetails_id => $risk_detail){
				$final_grid_array[$projectsdetails_id][$parameter['dashboard_parameter_id']] = isset($callback_results[$risk_detail['fcp_id']])?$callback_results[$risk_detail['fcp_id']]:$parameter['parameter_value_when_null'];
				$fcps_to_update[] = $projectsdetails_id;  
			}
			
		}

		$this->CI->dashboard_model->insert_grid_params($final_grid_array,$dashboard_month);

		$fcps_to_update = array_unique($fcps_to_update);

		$this->CI->dashboard_model->update_change_and_run_stats_tables($dashboard_month,$fcps_to_update,$dashboard_run_id,$run_start_date);

		// End of batch processing

		return $final_grid_array;
		
	}
	
}
