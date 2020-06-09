 <?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*	
 *	@author 	: Joyonto Roy
 *	date		: 27 september, 2014
 *	FPS School Management System Pro
 *	http://codecanyon.net/user/FreePhpSoftwares
 *	support@freephpsoftwares.com
 */

class Smp extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->load->library('session');
		$this->load->model('dct_model');

		/*cache control*/
				// $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
				// $this->output->set_header('Pragma: no-cache');

	}

	/***default functin, redirects to login page if no admin logged in yet***/
	public function index()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'admin.php/login', 'refresh');
	}

	/***Load Default Pages***/
	function dashboard($report_month = "", $param2 = "", $param3 = "")
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');

		$page_data['tym']  = strtotime(date('Y-m-d'));

		if ($report_month !== "" && $param2 === "") {

			$page_data['tym']  = $report_month;
		}

		if ($param3 === "prev" || $param3 === "next") {
			$sign = '+';

			if ($param3 === 'prev') {
				$sign = '-';
			}

			$page_data['tym']  = strtotime($sign . $param2 . ' months', $report_month);
		}

		$page_data['page_name']  = 'dashboard';
		//$page_data['active_announcements'] = $this->get_active_announcements();
		$page_data['page_title'] = get_phrase('Unconditional_Direct_Cash_Transfers');
		
		// //$page_data['regions'] = $this->get_regions();
		// $page_data['date']=date('Y-m-d',$this->time_scoller($report_month,$this->uri->segment(4,''),$this->uri->segment(5,'')));//$report_month!=''?date('Y-m-d',$report_month):date('Y-m-d',strtotime('Y-m-d'));
		// $page_data['dct_expenses_per_cluster_in_region'] = $this->get_total_for_a_region($report_month);
		// //$page_data['total_dct_expense'] = !is_numeric($report_month)?$this->get_total_direct_cash_transfers_countrywide(strtotime(date('Y-m-d'))):$this->get_total_direct_cash_transfers_countrywide($report_month);
		// $page_data['total_dct_beneficiaries'] = 54747;
		$this->load->view('backend/index', $page_data);
	}
	function get_active_announcements(){
		$active_announcements = $this->db->order_by('announcement_created_date DESC')->get_where('announcement',array('announcement_end_date>='=>date('Y-m-d')))->result_array();
		
		return $active_announcements;
	}
	
	// // function get_data($report_month){
	// // 	$dct_expenses_per_cluster_in_region=!is_numeric($report_month)? $this->get_total_for_a_region(strtotime(date('Y-m-d'))):$this->get_total_for_a_region($report_month);
	

	// // 	echo json_encode($dct_expenses_per_cluster_in_region);
	// // 	//echo ('Yes');
		
	// // }
	// /**
	//  * @author: Karisa
	//  * @date: 
	//  */

	// function time_scoller($date = "",$cnt = "" ,$flag = ""){
	// 	$tym  = strtotime(date('Y-m-d'));
								
	// 	if($date !== "" && $cnt == ""){
	
	// 		$tym  = $date;
	// 	}
		
	// 	if($flag == "prev" || $flag == "next"){
	// 			$sign = '+';
		
	// 			if($flag == 'prev'){
	// 				$sign = '-';
	// 			}
					 
	// 			$tym  = strtotime($sign.$cnt.' months',$date);	
	// 	}
	
	// 	return $tym;
	//  }
	
	//  /**
	//   * @author: Onduso,
	//    * @date: 2/6/2020
	//   */
	// function get_total_for_a_region($dct_report_month){
	// 	//$current_month=strtotime('-1 months',$dct_report_month);
	// 	$cnt = $this->uri->segment(4,'');
	// 	$flag = $this->uri->segment(5,'');

	// 	$current_month = $this->time_scoller($dct_report_month,$cnt,$flag);

	// 	return $this->dct_model->get_direct_cash_transfer_in_region($current_month);
	// }
	
	// function cluster_fcps()
	// {
	// 	$cluster = $this->session->cluster;

	// 	$this->db->select(array('icpNo'));
	// 	if ($cluster == 'KE') {
	// 		$this->db->where(array('projectsdetails.status' => 1));
	// 	} else {
	// 		$this->db->where(array('clusterName' => $cluster, 'projectsdetails.status' => 1));
	// 	}
	// 	$this->db->where(array('clusterName' => $cluster, 'projectsdetails.status' => 1));
	// 	$this->db->join('clusters', 'clusters.clusters_id=projectsdetails.cluster_id');
	// 	$result = $this->db->get('projectsdetails')->result_array();

	// 	return array_column($result, 'icpNo');
	// }
	// function direct_cash_transfers_report($tym)
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url(), 'refresh');

	// 	$page_data['tym']  = $tym;
	// 	//$page_data['fcps']  = $this->cluster_fcps();
	// 	$page_data['direct_cash_transfers'] = $this->dct_model->region_grouped_direct_cash_transfers($this->cluster_fcps(), $tym);
	// 	$page_data['page_name']  = 'direct_cash_transfers_report';
	// 	$page_data['page_title'] = get_phrase('direct_cash_transfers_report_for') . ' ' . date('F Y', $tym);
	// 	$this->load->view('backend/index', $page_data);
	// }
	// function per_region_dct_report($report_month)
	// {

	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url() . 'admin.php/login', 'refresh');


	// 	$page_data['page_name']  = 'per_region_dct_report';
	// 	$page_data['page_title'] = get_phrase('per_region_dct_report');

	// 	$this->load->view('backend/index', $page_data);
	// }


	// function cash_journal($report_month = '', $param2 = '', $param3 = '')
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url() . 'admin.php', 'refresh');


	// 	$max_mfr_id = $this->db->select_max('balHdID')->get_where('opfundsbalheader', array('icpNo' => $param2))->row()->balHdID;

	// 	$page_data['tym']  = $report_month;//strtotime($this->db->select_max('closureDate')->get_where('opfundsbalheader',array('icpNo'=>$param2))->row()->closureDate);//strtotime('+1 month',strtotime($last_mfr->closureDate));		
	// 	$page_data['project'] = $param2;
	// 	$page_data['page_name']  = 'cash_journal';
	// 	$page_data['page_title'] = get_phrase('cash_journal');
	// 	$this->load->view('backend/index', $page_data);
	// }

	// function scroll_cash_journal($project, $date = "", $cnt = "", $flag = "")
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url() . 'admin.php', 'refresh');


	// 	$max_mfr_id = $this->db->select_max('balHdID')->get_where('opfundsbalheader', array('icpNo' => $project))->row()->balHdID;

	// 	$sign = '+';

	// 	if ($flag === 'prev') {
	// 		$sign = '-';
	// 	}

	// 	$page_data['tym']  = strtotime($sign . $cnt . ' months', $date);
	// 	$page_data['project'] = 	$project;
	// 	$page_data['page_name']  = 'cash_journal';
	// 	$page_data['page_title'] = get_phrase('cash_journal');
	// 	$this->load->view('backend/index', $page_data);
	// }

	// public function fo_fund_balance_report($month)
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url() . 'admin.php', 'refresh');

	// 	if ($month === "") {
	// 		$month = strtotime(date('Y-m-t'));
	// 	}

	// 	$header = $this->db->get_where('opfundsbalheader', array('closureDate' => date('Y-m-t', strtotime("last day of previous month", $month))))->result_object();

	// 	$append_funds = array();

	// 	foreach ($header as $row) :
	// 		$append_funds[$row->icpNo] = $this->db->get_where('opfundsbal', array('balHdID' => $row->balHdID))->result_object();
	// 	endforeach;


	// 	$page_data['tym']  = $month;
	// 	$page_data['rec']  = $append_funds;
	// 	$page_data['page_name']  = 'fo_fund_balance_report';
	// 	$page_data['page_title'] = get_phrase('fund_balance_report');
	// 	$this->load->view('backend/index', $page_data);
	// }

	// function civ_report($report_month = "")
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url(), 'refresh');

	// 	$page_data['page_name']  = 'civ_report';

	// 	if ($report_month === "closed") {
	// 		$page_data['page_name']  = 'closed_civs_report';
	// 	}
	// 	//$page_data['page_name']  = 'civ_report';
	// 	$page_data['page_title'] = get_phrase('interventions_report');
	// 	$this->load->view('backend/index', $page_data);
	// }

	// public function fo_expense_report($month)
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url() . 'admin.php', 'refresh');

	// 	$append_funds = array();

	// 	$query = "SELECT users.cname as cname,voucher_body.icpNo as icpNo, voucher_body.AccNo as AccNo, SUM(voucher_body.Cost) as Cost  FROM `voucher_body` LEFT JOIN `accounts` ON voucher_body.AccNo=accounts.AccNo LEFT JOIN users ON voucher_body.icpNo=users.fname WHERE accounts.AccGrp=0 AND voucher_body.TDate>='" . date('Y-m-01', $month) . "' AND voucher_body.TDate<='" . date('Y-m-t', $month) . "' GROUP BY voucher_body.icpNo,voucher_body.AccNo";

	// 	$results = $this->db->query($query)->result_object();

	// 	foreach ($results as $row) {
	// 		$append_funds[$row->cname][$row->icpNo][$row->AccNo] = $row->Cost;
	// 	}


	// 	$page_data['tym']  = $month;
	// 	$page_data['rec']  = $append_funds;
	// 	$page_data['page_name']  = 'fo_expense_report';
	// 	$page_data['page_title'] = get_phrase('expense_report');
	// 	$this->load->view('backend/index', $page_data);
	// }

	// function fo_validation_report($month)
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url() . 'admin.php', 'refresh');

	// 	$result = $this->db->get_where('opfundsbalheader', array('closureDate' => date('Y-m-t', $month)))->result_object();

	// 	$page_data['tym']  = $month;
	// 	$page_data['result']  = $result;
	// 	$page_data['page_name']  = __FUNCTION__;
	// 	$page_data['page_title'] = get_phrase('validation_report') . ' : ' . date('F-Y', $month);;
	// 	$this->load->view('backend/index', $page_data);
	// }

	// public function delete_voucher($project = "", $voucher_id = "", $month = "")
	// {
	// 	//echo "Voucher ID ".$voucher_id." delete successful";

	// 	$mfr_submitted = $this->finance_model->mfr_submitted($project, date('Y-m-t', $month));

	// 	$voucher_number  = $this->db->get_where('voucher_header', array('hID' => $voucher_id))->row()->VNumber;

	// 	$this->db->where("hID >= ", $voucher_id);
	// 	$this->db->where("TDate <= ", date('Y-m-t', $month));
	// 	$this->db->where("icpNo", $project);

	// 	$set_of_vouchers = $this->db->get('voucher_header')->result_object();

	// 	$msg = "Could not delete the voucher number " . $voucher_number;

	// 	if ($mfr_submitted === '0') {

	// 		$this->db->delete('voucher_header', array('hID' => $voucher_id));

	// 		$deleted_voucher = array_shift($set_of_vouchers);

	// 		if (count($set_of_vouchers) > 0) {

	// 			foreach ($set_of_vouchers as $rename) {

	// 				$current_voucher_pointer = $this->db->get_where('voucher_header', array('hID' => $rename->hID))->row()->VNumber;

	// 				$voucher_frame = substr($current_voucher_pointer, 0, 4);

	// 				$voucher_serial = substr($current_voucher_pointer, 4) - 1;

	// 				$new_voucher_pointer =  $voucher_frame . $voucher_serial . " ";

	// 				$data['VNumber'] = $new_voucher_pointer;

	// 				$this->db->update('voucher_header', $data, array('hID' => $rename->hID));

	// 				$this->db->update('voucher_body', $data, array('hID' => $rename->hID));
	// 			}
	// 		}

	// 		$msg = "Voucher " . $deleted_voucher->VNumber . " deleted. " . count($set_of_vouchers) . " vouchers re-numbered";
	// 	}

	// 	echo $msg;
	// }

	// public function delete_all_vouchers($project = "", $voucher_id = "", $month = "")
	// {

	// 	$mfr_submitted = $this->finance_model->mfr_submitted($project, date('Y-m-t', $month));

	// 	$voucher_number  = $this->db->get_where('voucher_header', array('hID' => $voucher_id))->row()->VNumber;

	// 	$msg = "Could not delete the voucher number " . $voucher_number;

	// 	if ($mfr_submitted === '0') {

	// 		$num_of_vouchers = $this->db->get_where('voucher_header', array('hID>=' => $voucher_id, 'icpNo' => $project))->num_rows();

	// 		$this->db->delete('voucher_header', array('hID>=' => $voucher_id, 'icpNo' => $project));

	// 		$this->db->delete('voucher_body', array('hID>=' => $voucher_id, 'icpNo' => $project));

	// 		$msg = $num_of_vouchers . " vouchers deleted successful";
	// 	}

	// 	echo $msg;
	// }

	// public function validate_mfr($project, $tym, $code)
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url() . 'admin.php', 'refresh');

	// 	$msg = get_phrase("report_validated");

	// 	$data['allowEdit'] = "1";
	// 	$msg = get_phrase("report_unvalidated");

	// 	if ($code === "1") {
	// 		$data['allowEdit'] = "0";
	// 		$msg = get_phrase("report_validated");
	// 	}

	// 	$cond = $this->db->where(array('icpNo' => $project, 'closureDate' => $tym));
	// 	$this->db->update("opfundsbalheader", $data);

	// 	$this->session->set_flashdata('flash_message', $msg);

	// 	redirect(base_url() . 'ifms.php/facilitator/dashboard/' . strtotime($tym), 'refresh');
	// }

	// function decline_mfr($month = "", $project = "")
	// {

	// 	$max_mfr = $this->db->select_max('closureDate')->get_where("opfundsbalheader", array("icpNo" => $project))->row()->closureDate;

	// 	//$message = get_phrase("report_declined_successful");
	// 	$msg = "Error Occurred!";

	// 	//Check if there is a next month MFR present

	// 	$next_mfr = $this->db->get_where("opfundsbalheader", array("icpNo" => $project, "closureDate" => date('Y-m-t', strtotime('last day of next month', $month))))->num_rows();

	// 	$current_mfr = $this->db->get_where("opfundsbalheader", array("icpNo" => $project, "closureDate" => date('Y-m-t', $month)))->num_rows();

	// 	if ($next_mfr !== 0) {
	// 		$msg = get_phrase("decline_failure._first_decline_the_") . $max_mfr . " " . get_phrase("report");
	// 	} elseif ($current_mfr === 0) {
	// 		$msg = get_phrase("current_month_report_not_submitted");
	// 	} else {

	// 		//Delete Cash Balances
	// 		$this->db->delete('cashbal', array('month' => date('Y-m-t', $month), 'icpNo' => $project));

	// 		//Delete Statement Balance
	// 		//$this->db->delete('statementbal',array('month'=>date('Y-m-t',$month),'icpNo'=>$project));	

	// 		//Unlink Bank Statements

	// 		//$this->delete_bank_statement($month, $project);

	// 		//Delete Fund Balances

	// 		$balHdID = $this->db->get_where('opfundsbalheader', array('icpNo' => $project, 'closureDate' => date('Y-m-t', $month)))->row()->balHdID;

	// 		$this->db->delete('opfundsbalheader', array('balHdID' => $balHdID));

	// 		$this->db->delete('opfundsbal', array('balHdID' => $balHdID));


	// 		$msg = date('M Y', $month) . " financial report deleted successfully";
	// 	}
	// 	echo $msg;
	// }

	// public function delete_bank_statement($report_month, $param2)
	// {
	// 	//$t= $_POST['name'];
	// 	$storeFolder = 'uploads/bank_statements/' . $param2 . '/' . date('Y-m', $report_month) . '/';
	// 	//unlink($storeFolder);
	// 	foreach (glob($storeFolder . "/*.*") as $filename) {
	// 		if (is_file($filename)) {
	// 			unlink($filename);
	// 		}
	// 	}
	// }

	// function plans($report_month = '', $param2 = '', $param3 = '')
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url(), 'refresh');


	// 	$page_data['fyr'] = get_fy(date('Y-m-d', $report_month), $param2);
	// 	$page_data['tym'] = $report_month;
	// 	$page_data['project'] = $param2;
	// 	$page_data['page_name']  = 'plans';
	// 	$page_data['page_title'] = get_phrase('project_budget');
	// 	$this->load->view('backend/index', $page_data);
	// }

	// public function multiple_vouchers($tym, $project)
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url(), 'refresh');

	// 	$post = $this->input->post();

	// 	$page_data['vouchers'] = $post;

	// 	$page_data['page_name']  = 'multiple_vouchers';
	// 	$page_data['project'] = $project;
	// 	$page_data['tym'] = $tym;
	// 	$page_data['page_title'] = get_phrase('multiple_vouchers');
	// 	$this->load->view('backend/index', $page_data);
	// }


	// function fund_balance_grid($month)
	// {
	// 	$this->db->select(array('icpNo'));
	// 	$centers = $this->db->get_where('projectsdetails', array('status' => 1))->result_array();

	// 	$opening = $this->finance_model->months_opening_fund_balances_for_centers($month);
	// 	$income = $this->finance_model->months_income_per_revenue_account_for_centers($month);
	// 	$expense = $this->finance_model->months_expense_per_revenue_account_for_centers($month);

	// 	$revenue_accounts = $this->finance_model->ordered_revenue_accounts();

	// 	$return_grid = [];

	// 	foreach ($centers as $center) {
	// 		foreach ($revenue_accounts as $account) {
	// 			$loop_opening = isset($opening[$center['icpNo']][$account]) ? $opening[$center['icpNo']][$account] : 0;
	// 			$loop_income = isset($income[$center['icpNo']][$account]) ? $income[$center['icpNo']][$account] : 0;
	// 			$loop_expense = isset($expense[$center['icpNo']][$account]) ? $expense[$center['icpNo']][$account] : 0;
	// 			$loop_closing = $loop_opening + $loop_income - $loop_expense;

	// 			if ($loop_closing != 0) {
	// 				$return_grid[$center['icpNo']][$account]['revenue_account_opening_balance'] = $loop_opening;
	// 				$return_grid[$center['icpNo']][$account]['revenue_account_income'] = $loop_income;
	// 				$return_grid[$center['icpNo']][$account]['revenue_account_expense'] = $loop_expense;
	// 				$return_grid[$center['icpNo']][$account]['revenue_account_closing_balance'] = $loop_closing;
	// 			}
	// 		}
	// 	}

	// 	return $return_grid;
	// }

	// function fund_balance_report($month = "")
	// {
	// 	if ($this->session->userdata('admin_login') != 1)
	// 		redirect(base_url(), 'refresh');

	// 	$month = $month == "" ? strtotime(date('Y-m-t')) : $month;

	// 	$month_date_format = date('Y-m-t', $month);

	// 	$result = $this->fund_balance_grid($month_date_format);

	// 	$balance_type = "revenue_account_closing_balance";

	// 	if (isset($_POST['balance_type'])) {
	// 		$balance_type = $this->input->post('balance_type');
	// 	}

	// 	$page_data['account_type'] = 'readonly';
	// 	$page_data['result'] = $result;
	// 	$page_data['month'] = $month;
	// 	$page_data['balance_type'] = $balance_type;
	// 	$page_data['revenue_accounts'] = $this->finance_model->ordered_revenue_accounts();
	// 	$page_data['page_name']  = 'fund_balance_report';
	// 	$page_data['page_title'] = get_phrase('fund_balance_report');
	// 	$this->load->view('backend/index', $page_data);
	// }
}
