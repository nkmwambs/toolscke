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

class Protection extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php/login', 'refresh');
    }
    
    /***Load Default Pages***/
    function dashboard($param1="",$param2="",$param3="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

		$page_data['tym']  = strtotime(date('Y-m-d'));
							
		if($param1!=="" && $param2===""){

			$page_data['tym']  = $param1;
		}
		
		if($param3==="prev" || $param3==="next"){
				$sign = '+';
		
				if($param3==='prev'){
					$sign = '-';
				}
				 	
				$page_data['tym']  = strtotime($sign.$param2.' months',$param1);	
		}
		
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('finance_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	
	
	
	function cash_journal($param1 = '', $param2 = '', $param3 = ''){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php', 'refresh');
		
		
		$max_mfr_id = $this->db->select_max('balHdID')->get_where('opfundsbalheader',array('icpNo'=>$param2))->row()->balHdID;
		 	
		$page_data['tym']  = $param1;//strtotime($this->db->select_max('closureDate')->get_where('opfundsbalheader',array('icpNo'=>$param2))->row()->closureDate);//strtotime('+1 month',strtotime($last_mfr->closureDate));		
        $page_data['project'] = $param2;
        $page_data['page_name']  = 'cash_journal';
        $page_data['page_title'] = get_phrase('cash_journal');
		$this->load->view('backend/index', $page_data);
}
  
  function scroll_cash_journal($project,$date="",$cnt="",$flag=""){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php', 'refresh');
		
		
		$max_mfr_id = $this->db->select_max('balHdID')->get_where('opfundsbalheader',array('icpNo'=>$project))->row()->balHdID;
		
		$sign = '+';
		
		if($flag==='prev'){
			$sign = '-';
		}
		 	
		$page_data['tym']  = strtotime($sign.$cnt.' months',$date);	
		$page_data['project'] = 	$project;
        $page_data['page_name']  = 'cash_journal';
        $page_data['page_title'] = get_phrase('cash_journal');
		$this->load->view('backend/index', $page_data);

}

public function fo_fund_balance_report($month){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php', 'refresh');			
		
		$header = $this->db->get_where('opfundsbalheader',array('closureDate'=>date('Y-m-t',strtotime("last day of previous month",$month))))->result_object();	
		
		$append_funds = array();
		
		foreach($header as $row):
			$append_funds[$row->icpNo] = $this->db->get_where('opfundsbal',array('balHdID'=>$row->balHdID))->result_object();
		endforeach;	
			
			
		$page_data['tym']  = $month;
		$page_data['rec']  = $append_funds;	
        $page_data['page_name']  = 'fo_fund_balance_report';
        $page_data['page_title'] = get_phrase('fund_balance_report');
		$this->load->view('backend/index', $page_data);
}

public function fo_expense_report($month){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php', 'refresh');			
		
		$append_funds = array();
		
		$query = "SELECT users.cname as cname,voucher_body.icpNo as icpNo, voucher_body.AccNo as AccNo, SUM(voucher_body.Cost) as Cost  FROM `voucher_body` LEFT JOIN `accounts` ON voucher_body.AccNo=accounts.AccNo LEFT JOIN users ON voucher_body.icpNo=users.fname WHERE accounts.AccGrp=0 AND voucher_body.TDate>='".date('Y-m-01',$month)."' AND voucher_body.TDate<='".date('Y-m-t',$month)."' GROUP BY voucher_body.icpNo,voucher_body.AccNo";
		
		$results = $this->db->query($query)->result_object();
			
		foreach($results as $row){
			$append_funds[$row->cname][$row->icpNo][$row->AccNo] = $row->Cost;
		}
			
			
		$page_data['tym']  = $month;
		$page_data['rec']  = $append_funds;	
        $page_data['page_name']  = 'fo_expense_report';
        $page_data['page_title'] = get_phrase('expense_report');
		$this->load->view('backend/index', $page_data);
}

function fo_validation_report($month){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php', 'refresh');			
		
		$result = $this->db->get_where('opfundsbalheader',array('closureDate'=>date('Y-m-t',$month)))->result_object();
		
		$page_data['tym']  = $month;	
		$page_data['result']  = $result;	
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('validation_report').' : '.date('F-Y',$month);;
		$this->load->view('backend/index', $page_data);	
}

public function delete_voucher($project="",$voucher_id="",$month=""){
	//echo "Voucher ID ".$voucher_id." delete successful";
	
	$mfr_submitted = $this->finance_model->mfr_submitted($project,date('Y-m-t',$month));
	
	$voucher_number  = $this->db->get_where('voucher_header',array('hID'=>$voucher_id))->row()->VNumber;
	
	$this->db->where("hID >= ",$voucher_id);
	$this->db->where("TDate <= ",date('Y-m-t',$month));
	$this->db->where("icpNo",$project);
	
	$set_of_vouchers = $this->db->get('voucher_header')->result_object();
	
	$msg = "Could not delete the voucher number " .$voucher_number;
	
	if($mfr_submitted=== '0'){
		
		$this->db->delete('voucher_header',array('hID'=>$voucher_id));
		
		$deleted_voucher = array_shift($set_of_vouchers);
		
		if(count($set_of_vouchers)>0){
			
			foreach($set_of_vouchers as $rename){
				
				$current_voucher_pointer = $this->db->get_where('voucher_header',array('hID'=>$rename->hID))->row()->VNumber;
				
				$voucher_frame = substr($current_voucher_pointer, 0,4);
				
				$voucher_serial = substr($current_voucher_pointer, 4)-1; 
				
				$new_voucher_pointer =  $voucher_frame.$voucher_serial." ";
				
				$data['VNumber'] = $new_voucher_pointer;
				
				$this->db->update('voucher_header', $data, array('hID' => $rename->hID));
				
				$this->db->update('voucher_body', $data, array('hID' => $rename->hID));
			}			
		}

		$msg = "Voucher ".$deleted_voucher->VNumber." deleted. ".count($set_of_vouchers)." vouchers re-numbered";
	}	
	
	echo $msg;
	
}

public function delete_all_vouchers($project="",$voucher_id="",$month=""){
		
	$mfr_submitted = $this->finance_model->mfr_submitted($project,date('Y-m-t',$month));
	
	$voucher_number  = $this->db->get_where('voucher_header',array('hID'=>$voucher_id))->row()->VNumber;
	
	$msg = "Could not delete the voucher number " .$voucher_number;
	
	if($mfr_submitted=== '0'){
			
		$num_of_vouchers = $this->db->get_where('voucher_header',array('hID>='=>$voucher_id,'icpNo'=>$project))->num_rows();
		
		$this->db->delete('voucher_header',array('hID>='=>$voucher_id,'icpNo'=>$project));
		
		$this->db->delete('voucher_body',array('hID>='=>$voucher_id,'icpNo'=>$project));
		
		$msg = $num_of_vouchers." vouchers deleted successful";	
	}

	echo $msg;
}

public function validate_mfr($project,$tym,$code){
	if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php', 'refresh');
	
	$msg = get_phrase("report_validated");
	
	$data['allowEdit'] = "1";	
	$msg = get_phrase("report_unvalidated");
				 	
	if($code==="1"){
		$data['allowEdit'] = "0";
		$msg = get_phrase("report_validated");
	}
	
	$cond = $this->db->where(array('icpNo'=>$project,'closureDate'=>$tym));
	$this->db->update("opfundsbalheader",$data);
	
	$this->session->set_flashdata('flash_message',$msg);
	
	redirect(base_url().'ifms.php/facilitator/dashboard/'.strtotime($tym),'refresh');	
}

function decline_mfr($month="",$project=""){
	
	$max_mfr = $this->db->select_max('closureDate')->get_where("opfundsbalheader",array("icpNo"=>$project))->row()->closureDate;
	
	//$message = get_phrase("report_declined_successful");
	$msg = "Error Occurred!"; 
	
	//Check if there is a next month MFR present
	
	$next_mfr = $this->db->get_where("opfundsbalheader",array("icpNo"=>$project,"closureDate"=>date('Y-m-t',strtotime('last day of next month',$month))))->num_rows();
	
	$current_mfr = $this->db->get_where("opfundsbalheader",array("icpNo"=>$project,"closureDate"=>date('Y-m-t',$month)))->num_rows();
	
	if($next_mfr!==0){
		$msg = get_phrase("decline_failure._first_decline_the_").$max_mfr." ".get_phrase("report");
	}elseif($current_mfr=== 0){
		$msg = get_phrase("current_month_report_not_submitted");
	}else{	
	
		//Delete Cash Balances
		$this->db->delete('cashbal',array('month'=>date('Y-m-t',$month),'icpNo'=>$project));	
		
		//Delete Statement Balance
		//$this->db->delete('statementbal',array('month'=>date('Y-m-t',$month),'icpNo'=>$project));	
		
		//Unlink Bank Statements
		
		//$this->delete_bank_statement($month, $project);
		
		//Delete Fund Balances
		
		$balHdID = $this->db->get_where('opfundsbalheader',array('icpNo'=>$project,'closureDate'=>date('Y-m-t',$month)))->row()->balHdID;
			
		$this->db->delete('opfundsbalheader',array('balHdID'=>$balHdID));
			
		$this->db->delete('opfundsbal',array('balHdID'=>$balHdID));
		
		
		$msg = date('M Y',$month)." financial report deleted successfully";
	}
	echo $msg;
		
	
}

	public function delete_bank_statement($param1,$param2){
		//$t= $_POST['name'];
		$storeFolder = 'uploads/bank_statements/'.$param2.'/'.date('Y-m',$param1).'/';  
		//unlink($storeFolder);
		foreach (glob($storeFolder."/*.*") as $filename) {
			if (is_file($filename)) {
			       unlink($filename);
			}
		}
	}
    
function plans($param1='',$param2='',$param3=''){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		 

		$page_data['fyr'] = get_fy(date('Y-m-d',$param1),$param2);
		$page_data['tym'] = $param1;
		$page_data['project'] = $param2;
        $page_data['page_name']  = 'plans';
        $page_data['page_title'] = get_phrase('project_budget');
		$this->load->view('backend/index', $page_data);	        	
	}
	
public function multiple_vouchers($tym,$project){
	if ($this->session->userdata('admin_login') != 1)
	      redirect(base_url(), 'refresh');
	
	$post = $this->input->post();

	$page_data['vouchers']= $post;
	
	$page_data['page_name']  = 'multiple_vouchers';
	$page_data['project'] = $project;
	$page_data['tym'] = $tym;
    $page_data['page_title'] = get_phrase('multiple_vouchers');
    $this->load->view('backend/index', $page_data);	

}	
  
}
