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

class Admin extends CI_Controller
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
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('finance_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
  
  public function opening_balances($param1='',$param2=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		//$start_date = $this->input->post('closure_date');
		
		$project_id = $this->input->post('icpNo');
		$balance_type = $this->input->post('balance_type');
		$start_date = date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->project_system_start_date($project_id))));
				
		if($this->input->post('closure_date')!=NULL){
			$start_date = $this->input->post('closure_date');
		}
		
		$page_data['page_name']  = 'opening_balances';
		
		if($this->input->post('balance_type')){
			
			redirect(base_url().'ifms.php/admin/'.$this->input->post('balance_type').'/open/'.$project_id.'/'.$balance_type.'/'.$start_date,'refresh');
		}
		
		
		
        $page_data['page_title'] = get_phrase('opening_balances');
		$page_data['projects'] = $this->db->get_where('users',array('userlevel'=>'1','department'=>'0'))->result_object();
        $this->load->view('backend/index', $page_data);		
	}

  
  function opening_deposit_in_transit($param1="",$param2="",$param3="",$param4="",$param5=""){
  	  if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh'); 

		/**
		 * param1 = check
		 * param2 = project
		 * param3 = balance_type
		 */

		$project_id = $param2;
			
		if($this->input->post('icpNo')){
			$project_id = $this->input->post('icpNo');	
		}

		$view_name = $param3;
		
		if($this->input->post('balance_type')){
			$view_name = $this->input->post('balance_type');	
		}

		if($param1==='add'){
			$this->db->insert('transitfundsbf',$this->input->post());
			
			$this->session->set_flashdata('flash_message' , get_phrase('record_added_successfully'));
			redirect(base_url().'ifms.php/admin/'.__FUNCTION__.'/open/'.$this->input->post('icpNo').'/'.__FUNCTION__,'refresh');								
		
		}
			  
		if($param1==='edit'){
			$this->db->where(array('transitBfID'=>$param2));
			
			$this->db->update('transitfundsbf',$this->input->post());
		
			$this->session->set_flashdata('flash_message' , get_phrase('record_edited_successfully'));
			redirect(base_url().'ifms.php/admin/'.__FUNCTION__.'/open/'.$this->input->post('icpNo').'/'.__FUNCTION__,'refresh');								
		
		}
		
		if($param1==='delete'){
			$this->db->where(array('transitBfID'=>$param2));
			
			$this->db->delete('transitfundsbf');
			
			$this->session->set_flashdata('flash_message' , get_phrase('record_deleted_successfully'));
			redirect(base_url().'ifms.php/admin/'.__FUNCTION__.'/open/'.$param3.'/'.__FUNCTION__,'refresh');								
					
		}

		$page_data['balance_type'] = __FUNCTION__;
		$page_data['project_id'] = $project_id;			
	    $page_data['page_name']  = __FUNCTION__;
	    $page_data['page_title'] = get_phrase('opening_balances');
	    $this->load->view('backend/index', $page_data);		   	
  }
  
  function opening_outstanding_cheques($param1="",$param2="",$param3="",$param4="",$param5=""){
  	  if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');	  		
		/**
		 * param1 = check
		 * param2 = project
		 * param3 = balance_type
		 */

		$project_id = $param2;
			
		if($this->input->post('icpNo')){
			$project_id = $this->input->post('icpNo');	
		}

		$view_name = $param3;
		
		if($this->input->post('balance_type')){
			$view_name = $this->input->post('balance_type');	
		}

		if($param1==='add'){
			$chqNo = $this->input->post('chqNo');
			$chqDate = $this->input->post('chqDate');
			$Details = $this->input->post('Details');
			$amount = $this->input->post('amount');
			
			for($i=0;$i<sizeof($amount);$i++):
				
				$data['icpNo'] = $this->input->post('icpNo');
				$data['chqNo'] = $chqNo[$i];
				$data['TDate'] = $chqDate[$i];
				$data['TDescription'] = $Details[$i];
				$data['totals'] = $amount[$i];
				
				$this->db->insert('oschqbf',$data);

			endfor;
			
			$this->session->set_flashdata('flash_message' , get_phrase('records_added_successfully'));
			redirect(base_url().'ifms.php/admin/'.__FUNCTION__.'/open/'.$this->input->post('icpNo').'/'.__FUNCTION__,'refresh');				
				
		}
		
		if($param1==='delete'){
			
			$project_id = $this->db->get_where('oschqbf',array('osBfID'=>$param2))->row()->project_id;
						
			$this->db->where(array('osBfID'=>$param2));
			
			$this->db->delete('oschqbf');
			

			$this->session->set_flashdata('flash_message' , get_phrase('records_deleted_successfully'));
			redirect(base_url().'ifms.php/admin/'.__FUNCTION__.'/open/'.$project_id.'/'.__FUNCTION__,'refresh');				
						
		}
		
		if($param1==='edit'){
			$project_id = $this->db->get_where('oschqbf',array('osBfID'=>$param2))->row()->icpNo;
			
			$this->db->where(array('osBfID'=>$param2));
			
			$data['TDate'] = $this->input->post('TDate');
			$data['ChqNo'] = $this->input->post('ChqNo');
			$data['TDescription'] = $this->input->post('TDescription');
			$data['chqState'] = $this->input->post('chqState');
			$data['clrMonth'] = $this->input->post('clrMonth');
			$data['totals'] = $this->input->post('totals');

			$this->db->update('oschqbf',$data);
			
			$this->session->set_flashdata('flash_message' , get_phrase('records_deleted_successfully'));
			redirect(base_url().'ifms.php/admin/'.__FUNCTION__.'/open/'.$project_id.'/'.__FUNCTION__,'refresh');			
		}
		
		$page_data['balance_type'] = __FUNCTION__;
		$page_data['project_id'] = $project_id;			
	    $page_data['page_name']  = __FUNCTION__;
	    $page_data['page_title'] = get_phrase('opening_balances');
	    $this->load->view('backend/index', $page_data);			  	
  }
  
  function opening_cash_balance($param1="",$param2="",$param3="",$param4="",$param5=""){
  	  if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');	  		
		/**
		 * param1 = check
		 * param2 = project
		 * param3 = balance_type
		 */

		 	$project_id = $param2;
			
			if($this->input->post('icpNo')){
				$project_id = $this->input->post('icpNo');	
			}

			$view_name = $param3;
			
			if($this->input->post('balance_type')){
				$view_name = $this->input->post('balance_type');	
			}

		if($param1==='add'){
			
			$start_date = date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->system_start_date($param2))));
			$rmk = get_phrase('record_added_successfully');	
			$accNo = array('BC','PC');		
			
			if($this->db->get_where('cashbal',array('month'=>$start_date,'icpNo'=>$project_id))->num_rows()>0){
				
				$rmk=get_phrase('balance_already_exists._please_use_the_edit_action');
				
				if(!$this->db->get_where('cashbal',array('month'=>$start_date,'accNo'=>'BC','icpNo'=>$project_id))->row()){
					
					$amt_arr = $this->input->post('accNo');
					
					$data['month'] = $start_date;
					$data['icpNo'] = $param2;
					$data['accNo'] = 'BC';
					$data['amount'] = $amt_arr[0];
					
					$this->db->insert('cashbal',$data);
					
					$rmk = get_phrase('bank_cash_balance_added_successfully');	
				
				}
				
				elseif(!$this->db->get_where('cashbal',array('month'=>$start_date,'accNo'=>'PC','icpNo'=>$project_id))->row()){
					
					$amt_arr = $this->input->post('accNo');
					
					$data['month'] = $start_date;
					$data['icpNo'] = $param2;
					$data['accNo'] = 'PC';
					$data['amount'] = $amt_arr[1];
					
					$this->db->insert('cashbal',$data);
					
					$rmk = get_phrase('petty_cash_balance_added_successfully');		
				}
				
					
			}else{
				
				foreach($this->input->post('accNo') as $key => $amt):
					$data['month'] = $start_date;
					$data['icpNo'] = $param2;
					$data['accNo'] = $accNo[$key];
					$data['amount'] = $amt;
					
					$this->db->insert('cashbal',$data);
				endforeach;					
			}
			

			//break;
			$this->session->set_flashdata('flash_message' , $rmk);
			redirect(base_url().'ifms.php/admin/opening_cash_balance/open/'.$param2.'/'.$param3,'refresh');
		}
		if($param1==='edit'){
			
			$data['amount'] = $this->input->post('amount');
			
			$this->db->where(array('balID'=>$param4));
			
			$this->db->update('cashbal',$data);
			
			$this->session->set_flashdata('flash_message' , get_phrase('record_edited_successfully'));
			redirect(base_url().'ifms.php/admin/opening_cash_balance/open/'.$param2.'/'.$param3,'refresh');
		}
		
		if($param1==='delete'){
					/**
					 * param1 = check
					 * param2 = project
					 * param3 = balance_type
					 */
			$rec = $this->db->get_where('cashbal',array('balID'=>$param2))->row();	
			
			$this->db->where(array('balID'=>$param2));
			
			$param2 = $rec->project_id;
			
			$this->db->delete('cashbal');
			
			$this->session->set_flashdata('flash_message' , get_phrase('record_deleted_successfully'));
			redirect(base_url().'ifms.php/admin/opening_cash_balance/open/'.$param2.'/opening_cash_balance','refresh');			
			 
		}
		$page_data['closure_date'] = $param4; 	
		$page_data['balance_type'] = __FUNCTION__;
		$page_data['project_id'] = $project_id;			
	    $page_data['page_name']  = __FUNCTION__;
	    $page_data['page_title'] = get_phrase('opening_balances');
	    $this->load->view('backend/index', $page_data);		   	
  }
  
  function opening_fund_balance($param1="",$param2="",$param3="",$param4="",$param5="",$param6=""){
  	  if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');	
		/**
		 * param1 = check
		 * param2 = project
		 * param3 = balance_type
		 */
  			
			$project_id = $param2;
			
			if($this->input->post('icpNo')){
				$project_id = $this->input->post('icpNo');	
			}

			$view_name = $param3;
			
			if($this->input->post('balance_type')){
				$view_name = $this->input->post('balance_type');	
			}

			if($param1==='edit'){
				$data['amount'] = $this->input->post('amount');
				$this->db->where(array('balID'=>$param4));
				
				$this->db->update('opfundsbal',$data);
				
				
				$balHdID = $this->db->get_where('opfundsbal',array('balID'=>$param4))->row()->balHdID;
				$data2['totalBal'] = $this->db->select_sum('amount')->get_where('opfundsbal',array('balHdID'=>$balHdID))->row()->amount;//$system_opening_balance->totalBal+$this->input->post('amount');
				
				$this->db->where(array('balHdID'=>$balHdID));
				
				$this->db->update('opfundsbalheader',$data2);		

				$this->session->set_flashdata('flash_message' , get_phrase('record_edited_successfully'));
				redirect(base_url().'ifms.php/admin/'.$param3.'/open/'.$param2.'/'.$param3.'/'.$param5,'refresh');
			}
			
			if($param1==='delete'){
				$closure_date = $this->db->get_where('opfundsbalheader',array("balHdID"=>$param5))->row()->closureDate;
				
				$this->db->where(array('balID'=>$param4));
				
				$this->db->delete('opfundsbal');
				
				//$balHdID = $this->db->get_where('opfundsbal',array('balID'=>$param4))->row()->balHdID;
				
				$data2['totalBal'] = $this->db->select_sum('amount')->get_where('opfundsbal',array('balHdID'=>$param5))->row()->amount;//$system_opening_balance->totalBal+$this->input->post('amount');
				
				$this->db->where(array('balHdID'=>$param5));
				
				$this->db->update('opfundsbalheader',$data2);				
				//break;
				$this->session->set_flashdata('flash_message' , get_phrase('record_deleted_successfully'));
				redirect(base_url().'ifms.php/admin/'.$param3.'/open/'.$param2.'/'.$param3.'/'.$closure_date,'refresh');
							
				
			}
			
			if($param1==='add'){
				//Check if system opening flag is set

				$system_opening_balance = $this->db->get_where('opfundsbalheader',array('icpNo'=>$param2,'systemOpening'=>1))->row();	
				
				$rmk = get_phrase('balance_added_successfully');
				
				if(!$system_opening_balance){
					
					$data['icpNo'] = $this->input->post('icpNo');
					$data['totalBal'] = 0;
					$data['closureDate'] = $this->input->post('closureDate');
					$data['allowEdit'] = 0;
					$data['submitted'] = 1;
					$data['systemOpening'] = 1;
					
					$this->db->insert('opfundsbalheader',$data);
					
					$balHdID = $this->db->insert_id();
					
					$data2['balHdID'] = $balHdID;
					$data2['funds'] = $this->input->post('funds');
					$data2['amount'] = $this->input->post('amount');
					
					$this->db->insert('opfundsbal',$data2);
					
					//Update Total Balance
					$data3['totalBal'] = $this->db->select_sum('amount')->get_where('opfundsbal',array('balHdID'=>$balHdID))->row()->amount;
					$this->db->where(array('balHdID'=>$balHdID))->update('opfundsbalheader',$data3);	
					
				}else{
					$system_opening_balance = $this->db->get_where('opfundsbalheader',array('icpNo'=>$param2,'closureDate'=>$param3))->row();
					$balHdID = $system_opening_balance->balHdID;
					
					//Check if the account is already set
					
					$chk_balance = $this->db->get_where('opfundsbal',array('balHdID'=>$balHdID,'funds'=>$this->input->post('funds')))->num_rows();
					
					if($chk_balance===0){
						$data2['balHdID'] = $balHdID;
						$data2['funds'] = $this->input->post('funds');
						$data2['amount'] = $this->input->post('amount');	
						
						$this->db->insert('opfundsbal',$data2);
											
						$data['totalBal'] = $this->db->select_sum('amount')->get_where('opfundsbal',array('balHdID'=>$balHdID))->row()->amount;//$system_opening_balance->totalBal+$this->input->post('amount');
						
						$this->db->where(array('balHdID'=>$balHdID))->update('opfundsbalheader',$data);	
						
					}else{
						$rmk = get_phrase('balance_already_exist._Kindly_use_the_edit_or_delete_function');
					}
					
				}
				
				$this->session->set_flashdata('flash_message' , $rmk);
				redirect(base_url().'ifms.php/admin/'.$this->input->post('balance_type').'/open/'.$param2.'/'.$this->input->post('balance_type').'/'.$param3,'refresh');
			
			}

			$page_data['closure_date'] = $param4; 
			$page_data['balance_type'] = __FUNCTION__;
			$page_data['project_id'] = $project_id;			
	        $page_data['page_name']  = __FUNCTION__;
	        $page_data['page_title'] = get_phrase('opening_balances');
	        $this->load->view('backend/index', $page_data);
			
		}

	
	public function finance_settings($param1 = '', $param2 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1=='delete_expense_account'){
			$this->db->where(array('expense_id'=>$param2));
			
			$this->db->delete('expense');

			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'ifms.php/admin/finance_settings/', 'refresh');
		}
		
		if($param1=='edit_sub'){
			
			$data['parentAccID'] = $param2;
			
			$this->db->where(array('accID'=>$this->input->post('accID')));
			$this->db->update('accounts',$data);
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_edited_successfully'));
            redirect(base_url() . 'admin/finance/finance_settings/', 'refresh');
		}
		if($param1=='edit_revenue_account'){
			$data['AccName'] = $this->input->post('AccName');
			$data['AccText'] = $this->input->post('AccText');
			$data['budget']	= $this->input->post('budget');
			$data['Active']	= $this->input->post('Active');
			
			$this->db->where('accID',$param2);
			
			$this->db->update('accounts',$data);

			
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
            redirect(base_url() . 'ifms.php/admin/finance_settings/', 'refresh');				
		}
		if($param1=='add_revenue_account'){
			$data['AccName'] = $this->input->post('AccName');
			$data['AccText'] = $this->input->post('AccText');
			$data['AccNo']	= $this->input->post('AccNo');
			$data['budget']	= $this->input->post('budget');
			$data['Active'] = $this->input->post('Active');
			
			//Check if short code exists
			$msg = "";
			
			if($this->db->get_where('revenue',array('code'=>$this->input->post('code')))->num_rows()>0){
				$msg = get_phrase('short_code_already_exists');
			}else{
				$this->db->insert('revenue',$data);
				$msg = get_phrase('data_updated_successfully');
			}
			
			$this->session->set_flashdata('flash_message' , $msg);
            redirect(base_url() . 'ifms.php/admin/finance_settings/', 'refresh');				
		}
		if($param1==='edit_expense_account'){
			$data['AccName'] = $this->input->post('AccName');
			$data['AccText'] = $this->input->post('AccText');
			
			$this->db->where('accID',$param2);
			
			$this->db->update('accounts',$data);
				
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
            redirect(base_url() . 'ifms.php/admin/finance_settings/', 'refresh');
		}
		if($param1==='add_expense_account'){
			$data['AccName'] = $this->input->post('AccName');
			$data['AccText'] = $this->input->post('AccText');
			$data['parentAccID'] = $param2;	
			$data['AccNo'] = $this->input->post('AccNo');
			$data['Active'] = $this->input->post('Active');
			
			
			$msg = "";
			
			if($this->db->get_where('accounts',array('AccNo'=>$this->input->post('AccNo')))->num_rows()>0){
				$msg = get_phrase('account_already_exists');
			}else{
				$this->db->insert('accounts',$data);					
				$msg = get_phrase('data_added_successfully');
			}
			
	
			$this->session->set_flashdata('flash_message' , $msg);
            redirect(base_url() . 'ifms.php/admin/finance_settings/', 'refresh');
		}

		if($param1==='add_revenue_category'){
			//Add Global Category
			
			$data['parentName'] =$this->input->post('AccName');
			$data['has_sub_accounts'] = $this->input->post('has_sub_accounts');
			$data['budgeted']= $this->input->post('budgeted');
			$data['Active']= $this->input->post('Active');
			
			$this->db->insert('primary_accounts',$data);
					
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'admin/finance/finance_settings/', 'refresh');
		}		
		
		if($param1==="delete_revenue"){//New
			$this->db->where('accID',$param2);
			
			$this->db->delete('accounts');
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'ifms.php/admin/finance_settings/', 'refresh');			
		}
		
        $page_data['page_name']  = 'finance_settings';
        $page_data['page_title'] = get_phrase('finance_accounts_settings');
		//$page_data['primary_revenue_accounts'] = $this->finance_model->global_revenue_accounts();
        $this->load->view('backend/index', $page_data);		
	}

	function new_special_fund(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'add_special_fund';
        $page_data['page_title'] = get_phrase('add_special_fund');
        $this->load->view('backend/index', $page_data);			
	}
	
	function special_fund($param1="",$param2=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='add'){
			
			$partner_id = explode("\r\n", trim($_POST['partner_id']));
			
			$cnt = 0;
			
			foreach($partner_id as $partner){
				
				$check_project_with_fund = $this->db->get_where('revenue_control',array('partner_id'=>$partner,'specific_fund_code'=>$this->input->post('specific_fund_code')))->num_rows();
				
				if($check_project_with_fund===0){
					$data['revenue_id'] = $this->input->post('revenue_id');
					$data['specific_fund_code'] = $this->input->post('specific_fund_code');
					$data['description'] = $this->input->post('description');
					$data['partner_id'] = $partner;
					$data['start_date'] = $this->input->post('start_date');
					$data['end_date'] = $this->input->post('end_date');
					
					$this->db->insert('revenue_control',$data);		
					
					$cnt++;
								
				}				
				
			}
			//exit;
			$this->session->set_flashdata('flash_message' , $cnt.' '.get_phrase('projects').' '.get_phrase('out_of').' '.count($partner_id).' '.get_phrase('added_successfully'));
            redirect(base_url() . 'ifms.php/admin/special_fund/', 'refresh');	
		
		}
			
		if($param1==='edit'){

			$data['specific_fund_code'] = $this->input->post('specific_fund_code');
			$data['description'] = $this->input->post('description');
			$data['start_date'] = $this->input->post('start_date');
			$data['end_date'] = $this->input->post('end_date');

			$this->db->where('specific_fund_code',$param2);
			
			$this->db->update('revenue_control',$data);
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
            redirect(base_url() . 'ifms.php/admin/special_fund/', 'refresh');		
		}

		if($param1==='edit_project'){
			$this->db->where('revenue_control_id',$param2);
			
			$data['start_date'] = $this->input->post('start_date');
			$data['end_date'] = $this->input->post('end_date');
			$data['partner_id'] = $this->input->post('partner_id');
			
			$this->db->update('revenue_control',$data);

			$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
            redirect(base_url() . 'ifms.php/admin/special_fund/', 'refresh');				
		}	
		
		if($param1==="delete_project"){
			$this->db->where('revenue_control_id',$param2);
			
			$this->db->delete('revenue_control');
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'ifms.php/admin/special_fund/', 'refresh');
		}
		
		if($param1==='delete'){
			$this->db->where('specific_fund_code',$param2);
			
			$this->db->delete('revenue_control');

			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'ifms.php/admin/special_fund/', 'refresh');
		}

        $page_data['page_name']  = 'view_special_funds';
        $page_data['page_title'] = get_phrase('view_special_funds');
        $this->load->view('backend/index', $page_data);			
	}
	
	function get_project_start_date($param1=""){
		echo date('Y-m-t',strtotime('-1 month',strtotime($this->finance_model->project_system_start_date($param1))));
	}
	
	public function project_set_up($param1="",$param2=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='edit'){
			$this->db->where(array('ID'=>$param2));
			
			$this->db->update('projectsdetails',$this->input->post());
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_edited_successfully'));
            redirect(base_url() . 'ifms.php/admin/project_set_up/', 'refresh');			
		}
		
		if($param1==='edit_cluster'){
			$this->db->where(array('clusters_id'=>$param2));
			
			$this->db->update('clusters',$this->input->post());
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_edited_successfully'));
            redirect(base_url() . 'ifms.php/admin/project_set_up/', 'refresh');			
		}
		
		
		if($param1==='add_bank'){
				
			$this->db->insert('banks',$this->input->post());
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'ifms.php/admin/project_set_up/', 'refresh');	
		}

		if($param1==='add_cluster'){
				
			$this->db->insert('clusters',$this->input->post());
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'ifms.php/admin/project_set_up/', 'refresh');	
		}

		if($param1==="edit_bank"){
			$this->db->where(array('bankID'=>$param2));
			
			$this->db->update('banks',$this->input->post());
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_edited_successfully'));
            redirect(base_url() . 'ifms.php/admin/project_set_up/', 'refresh');	
		}

		if($param1==='delete_bank'){
			$this->db->where(array('bankID'=>$param2));
			
			$this->db->delete('banks');
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'ifms.php/admin/project_set_up/', 'refresh');				
		}
		
		if($param1==='delete_cluster'){
			$this->db->where(array('clusters_id'=>$param2));
			
			$this->db->delete('clusters');
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'ifms.php/admin/project_set_up/', 'refresh');				
		}
		
        $page_data['page_name']  = 'project_set_up';
        $page_data['page_title'] = get_phrase('project_set_up');
        $this->load->view('backend/index', $page_data);		
	}

	function budget_limits($param1="",$param2="",$param3=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='add'){
			$this->db->insert('plans_limits',$this->input->post());

			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'ifms.php/admin/budget_limits/view/'.$param2, 'refresh');					
		}
		
		if($param1==='edit'){
			$this->db->where(array('plans_limits_id'=>$param3));
			
			$this->db->update('plans_limits',$this->input->post());
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'ifms.php/admin/budget_limits/view/'.$param2, 'refresh');				
		}
		
		if($param1==='delete'){
			$this->db->where(array('plans_limits_id'=>$param3));

			$this->db->delete('plans_limits');
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successfully'));
            redirect(base_url() . 'ifms.php/admin/budget_limits/view/'.$param2, 'refresh');	
		}
		
		$fy = get_fy(date('Y-m-d'));
		
		if($this->input->post('fy')){
			$fy = $this->input->post('fy');
		}
		
		$page_data['revenue_id'] = $param2;
		$page_data['fyr'] = $fy;
        $page_data['page_name']  = 'budget_limits';
        $page_data['page_title'] = get_phrase('budget_limits');
        $this->load->view('backend/index', $page_data);			
	}

	function scroll_plans_limits($param1="",$param2=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

		$page_data['revenue_id'] = $param2;
		$page_data['fyr'] = $param1;
        $page_data['page_name']  = 'budget_limits';
        $page_data['page_title'] = get_phrase('budget_limits');
        $this->load->view('backend/index', $page_data);			
	}
	
	function budget_settings($param1="",$param2="",$param3=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
	

		
		if($param1==='add_plan_limit'){
			
			if($this->db->get_where('plans_limits',array('icpNo'=>$this->input->post('icpNo'),'fy'=>$this->input->post('fy'),'revenue_id'=>$this->input->post('revenue_id')))->num_rows()===0){
				$this->db->insert('plans_limits',$this->input->post());
			
				$this->session->set_flashdata('flash_message',get_phrase('record_added_successfully'));
			}else{
				
				$this->db->where(array('icpNo'=>$this->input->post('icpNo'),'fy'=>$this->input->post('fy'),'revenue_id'=>$this->input->post('revenue_id')));
				
				$this->db->update('plans_limits',$this->input->post());
				
				$this->session->set_flashdata('flash_message',get_phrase('record_updated_successfully'));
			}
			
			
			redirect(base_url().'ifms.php/admin/budget_settings/scroll/'.$this->input->post('fy'),'refresh');				
		}
		
		if($param1==='edit_plan_limit'){
				$this->db->where(array('plans_limits_id'=>$param2));
				
				$this->db->update('plans_limits',$this->input->post());
				
				$this->session->set_flashdata('flash_message',get_phrase('record_updated_successfully'));
				
				redirect(base_url().'ifms.php/admin/budget_settings/scroll/'.$this->input->post('fy'),'refresh');			
		}
		
		if($param1==='add_plan_tag'){
			
			$this->db->insert('plan_item_tag',$this->input->post());

			$this->session->set_flashdata('flash_message',get_phrase('record_added_successfully'));
				
			redirect(base_url().'ifms.php/admin/budget_settings/scroll/'.$param2,'refresh');
		}
		
		if($param1==='edit_plan_tag'){
				$this->db->where(array('plan_item_tag_id'=>$param2));
				
				$this->db->update('plan_item_tag',$this->input->post());
				
				$this->session->set_flashdata('flash_message',get_phrase('record_updated_successfully'));
				
				redirect(base_url().'ifms.php/admin/budget_settings/scroll/'.$param3,'refresh');				
		}
		
		if($param1==='delete_limit'){
			$this->db->where(array('plans_limits_id'=>$param2));
			
			$this->db->delete('plans_limits');
			
			$this->session->set_flashdata('flash_message',get_phrase('record_deleted_successfully'));
				
			redirect(base_url().'ifms.php/admin/budget_settings/scroll/'.$param3,'refresh');			
		}
		
		if($param1==='delete_tag'){
			$this->db->where(array('plan_item_tag_id'=>$param2));
			
			$this->db->delete('plan_item_tag');
			
			$this->session->set_flashdata('flash_message',get_phrase('record_deleted_successfully'));
				
			redirect(base_url().'ifms.php/admin/budget_settings/scroll/'.$param3,'refresh');			
		}		
		
		$page_data['fyr']  = get_fy(date('Y-m-d'));	
		
		if($param2!==""){
			$page_data['fyr']  = $param2;	
		}
		
			
        $page_data['page_name']  = 'budget_settings';
        $page_data['page_title'] = get_phrase('budget_settings');
        $this->load->view('backend/index', $page_data);			
	}
 	
	function opening_uploads($param1=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='import_fundbal'){
				move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/upload_templates/data/fund_balances.xlsx');
				// Importing excel sheet for bulk student uploads
	
				include 'simplexlsx.class.php';
				
				$xlsx = new SimpleXLSX('uploads/upload_templates/data/fund_balances.xlsx');			

				list($num_cols, $num_rows) = $xlsx->dimension();
				$f = 0;
				$balHdID = 0;
				
				foreach( $xlsx->rows() as $r ) 
				{
					// Ignore the inital name row of excel file
					if ($f == 0)
					{
						$f++;
						continue;
					}
					
					
					
					for( $i=0; $i < $num_cols; $i++ )
					{
						if ($i == 0){
							if($this->db->get_where('opfundsbalheader',array('project_id'=>$r[$i]))->num_rows()===0){
								$data1['project_id'] = 	$r[$i];
								$data1['closureDate'] = date('Y-m-t',strtotime('last month',strtotime($this->finance_model->project_system_start_date($r[$i]))));	
								$data1['allowEdit'] = 0;
								$data1['submitted'] = 1;
								$data1['systemOpening'] = 1;
								$this->db->insert('opfundsbalheader',$data1);
								
								$balHdID = $this->db->insert_id();
								
								$data['balHdID'] = $balHdID;
								
							}else{
								$data['balHdID'] = $this->db->get_where('opfundsbalheader',array('project_id'=>$r[$i]))->row()->balHdID;
							}	
						}

						if ($i == 1) $data['funds'] = $r[$i];	
						if ($i == 2) $data['amount'] = $r[$i];
								
					}
					
					$this->db->insert('opfundsbal' , $data);
				}
				
				$data4['totalBal'] = $this->db->select_sum('amount')->get_where('opfundsbal',array('balHdID'=>$balHdID))->row()->amount;
				
				$this->db->where(array('balHdID'=>$balHdID));
				
				$this->db->update('opfundsbalheader',$data4);
				
				$this->session->set_flashdata('flash_message' , get_phrase('records_added_successfully'));
				redirect(base_url() . 'ifms.php/admin/opening_balances/', 'refresh');			
		}
			
		if ($param1 == 'import_cashbal'){
				move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/upload_templates/data/cash_balances.xlsx');
				// Importing excel sheet for bulk student uploads
	
				include 'simplexlsx.class.php';
				
				$xlsx = new SimpleXLSX('uploads/upload_templates/data/cash_balances.xlsx');			

				list($num_cols, $num_rows) = $xlsx->dimension();
				$f = 0;
				foreach( $xlsx->rows() as $r ) 
				{
					// Ignore the inital name row of excel file
					if ($f == 0)
					{
						$f++;
						continue;
					}
					
					
					
					for( $i=0; $i < $num_cols; $i++ )
					{
						if ($i == 0){
							$data['month'] = date('Y-m-t',strtotime('last month',strtotime($this->finance_model->project_system_start_date($r[$i]))));	
							$data['project_id'] = $r[$i];
						}

						if ($i == 1) $data['accNo'] = $r[$i];	
						if ($i == 2) $data['amount'] = $r[$i];
								
					}
					
					$this->db->insert('cashbal' , $data);
				}
				
				$this->session->set_flashdata('flash_message' , get_phrase('records_added_successfully'));
				redirect(base_url() . 'ifms.php/admin/opening_balances/', 'refresh');
		}	
	
		if ($param1 == 'import_budget')
			{
				move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/upload_templates/data/budget_schedule.xlsx');
				// Importing excel sheet for bulk student uploads
	
				include 'simplexlsx.class.php';
				
				$xlsx = new SimpleXLSX('uploads/upload_templates/data/budget_schedule.xlsx');
				
				list($num_cols, $num_rows) = $xlsx->dimension();
				$f = 0;
				foreach( $xlsx->rows() as $r ) 
				{
					// Ignore the inital name row of excel file
					if ($f == 0)
					{
						$f++;
						continue;
					}
					for( $i=0; $i < $num_cols; $i++ )
					{
						//if ($i == 0)	    $data['name']			=	$r[$i];
						
						if ($i == 0){
							if($this->db->get_where('planheader',array('project_id'=>$r[$i],'fy'=>$this->input->post('fy')))->num_rows()===0){
								$data1['project_id'] = 	$r[$i];
								$data1['fy'] = 	$this->input->post('fy');
								$this->db->insert('planheader',$data1);
								$planHeaderID = $this->db->insert_id();
								
								$data['planHeaderID'] = $planHeaderID;
								
							}else{
								$data['planHeaderID'] = $this->db->get_where('planheader',array('project_id'=>$r[$i],'fy'=>$this->input->post('fy')))->row()->planHeaderID;
							}	
						}
						
						else if ($i == 1) 	$data['expense_id']	 	=	$this->db->get_where('expense',array('code'=>$r[$i]))->row()->expense_id;
						else if ($i == 2)	$data['details']		=	$r[$i];
						else if ($i == 3)	$data['qty']		    =	$r[$i];
						else if ($i == 4)	$data['unitCost']		=	$r[$i];
						else if ($i == 5)	$data['often']			=	$r[$i];
						else if ($i == 6)	$data['totalCost']		=	$r[$i];
						else if ($i == 7)	$data['month_1_amount']	=	$r[$i];
						else if ($i == 8)	$data['month_2_amount']	=	$r[$i];
						else if ($i == 9)	$data['month_3_amount']	=	$r[$i];
						else if ($i == 10)	$data['month_4_amount']	=	$r[$i];
						else if ($i == 11)	$data['month_5_amount']	=	$r[$i];
						else if ($i == 12)	$data['month_6_amount']	=	$r[$i];
						else if ($i == 13)	$data['month_7_amount']	=	$r[$i];
						else if ($i == 14)	$data['month_8_amount']	=	$r[$i];
						else if ($i == 15)	$data['month_9_amount']	=	$r[$i];
						else if ($i == 16)	$data['month_10_amount']=	$r[$i];
						else if ($i == 17)	$data['month_11_amount']=	$r[$i];
						else if ($i == 18)	$data['month_12_amount']=	$r[$i];
						else if ($i == 19)	$data['approved']		=	$r[$i];
					}
					
					$this->db->insert('plansschedule' , $data);

				}
				$this->session->set_flashdata('flash_message' , get_phrase('records_added_successfully'));
				redirect(base_url() . 'ifms.php/admin/opening_balances/', 'refresh');
			}
				
        $page_data['page_name']  = 'opening_balances';
        $page_data['page_title'] = get_phrase('opening_balances');
        $this->load->view('backend/index', $page_data);			
	}   
	
	public function download_upload_templates($template){
		force_download('uploads/upload_templates/'.$template.'.xlsx',NULL);
	}
}