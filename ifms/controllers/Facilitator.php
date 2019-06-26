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

class Facilitator extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->load->library('zip');
		//$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		//$this->db->cache_delete_all();
		//$this->output->cache(60); 
		
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
		
		if($flag!==""){
			$sign = '+';
		
			if($flag==='prev'){
				$sign = '-';
			}
			
			$page_data['tym']  = strtotime($sign.$cnt.' months',$date);	
		}else{
			$page_data['tym']  = $date;	
		}
		
		$page_data['project'] = 	$project;
        $page_data['page_name']  = 'cash_journal';
        $page_data['page_title'] = get_phrase('cash_journal');
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
		
		$this->db->delete('voucher_body',array('hID'=>$voucher_id));
		
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

function remove_duplicate($project="",$voucher_id="",$month=""){
	$mfr_submitted = $this->finance_model->mfr_submitted($project,date('Y-m-t',$month));
	
	$voucher_number  = $this->db->get_where('voucher_header',array('hID'=>$voucher_id))->row()->VNumber;
	
	//Check duplicates
	
	$duplicates = $this->db->get_where('voucher_header',array('VNumber'=>$voucher_number,'icpNo'=>$project))->num_row();
	
	$msg = "Could not delete the voucher number " .$voucher_number;

	
	if($mfr_submitted=== '0' && $duplicates > 0){
		
		$this->db->delete('voucher_header',array('hID'=>$voucher_id));
		
		$this->db->delete('voucher_body',array('hID'=>$voucher_id));
		
		$msg = "Voucher ".$voucher_number." deleted";
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
	function bank_statements($param1="",$param2="",$param3=""){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
					
        $page_data['page_name']  = 'bank_statements_upload';
		$page_data['tym'] = $param1;
		$page_data['project'] = $param2;;
        $page_data['page_title'] = get_phrase('bank_statements');
        $this->load->view('backend/index', $page_data);		
	}	

	public function bank_statement_download($param1,$param2,$param3){
		force_download('uploads/bank_statements/'.$param3.'/'.date('Y-m',$param2).'/'.$param1,NULL);
	}	
    
function ziparchive($param1="",$param2=""){
		
             if(file_exists('uploads/bank_statements/'.$param1.'/'.date('Y-m',$param2).'/')){
             	$map = directory_map('uploads/bank_statements/'.$param1.'/'.date('Y-m',$param2).'/', FALSE, TRUE);
							
             		foreach($map as $row): 

						$path = 'uploads/bank_statements/'.$param1.'/'.date('Y-m',$param2).'/'.$row;
					
						$data = file_get_contents($path);
				
						$this->zip->add_data($row, $data);
                	endforeach;

			
			// Write the zip file to a folder on your server. Name it "my_backup.zip"
			$this->zip->archive('downloads/my_backup.zip');
			
			// Download the file to your desktop. Name it "my_backup.zip"
			
			$backup_file = 'downloads_'.date("Y_m_d_H_i_s").'.zip'; 
			
			$this->zip->download($backup_file);
			
			unlink('downloads/'.$backup_file);
			
					
	}
}			 	
	
function plans($param1='',$param2='',$param3='',$param4=''){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		 
		 if($param3==='approve'){
			
			$data['approved'] = '2';
			
			$this->db->where(array('scheduleID'=>$param4))->update('plansschedule',$data);
			
			if($this->db->affected_rows()>0){
				$this->session->set_flashdata('flash_message',get_phrase('item_approval_successful'));
			}else{
				$this->session->set_flashdata('flash_message',get_phrase('approval_failure'));
			}
	
			redirect(base_url().'ifms.php/facilitator/plans/'.$param1.'/'.$param2,'refresh');
		}
		 

		$page_data['fyr'] = get_fy(date('Y-m-d',$param1),$param2);
		$page_data['tym'] = $param1;
		$page_data['project'] = $param2;
        $page_data['page_name']  = 'plans';
        $page_data['page_title'] = get_phrase('project_budget');
		$this->load->view('backend/index', $page_data);	        	
	}

function action_item($param1=''){
	
			$param_arr = explode("-", $param1);
			
			$action = $param_arr['0'];
			
			$item = $param_arr['1'];
			
			$msg = "";
			
			$content = array();
			
			$approval = array('New','Submitted','Approved','Declined/allow review','Reinstated','Unacceptable');
			
			$data = array();
			
			if($action === 'app'){
				$data['approved'] = '2';
			
				$this->db->where(array('scheduleID'=>$item))->update('plansschedule',$data);
				
				$msg = get_phrase('approval_failure');
				
				if($this->db->affected_rows()>0){
					$msg = get_phrase('item_approval_successful');
				}

				$content['msg'] = $msg;
				$data['btn'] = 'btn-success';
				$content['status'] = $approval['2'];
			}
			
			if($action === 'dec'){
				
				$data['approved'] = '3';
			
				$this->db->where(array('scheduleID'=>$item))->update('plansschedule',$data);
				
				$msg = get_phrase('decline_failure');
				
				if($this->db->affected_rows()>0){
					$msg = get_phrase('item_declined_successful');
				}

				$content['msg'] = $msg;
				$data['btn'] = 'btn-danger';
				$content['status'] = $approval['3'];
			}
			
			if($action === 'unc'){
				$data['approved'] = '5';
			
				$this->db->where(array('scheduleID'=>$item,'approved<>'=>'2'))->update('plansschedule',$data);
				
				//btn-default
				
				$msg = get_phrase('unacceptable_flag_failure');
				
				if($this->db->affected_rows()>0){
					$msg = get_phrase('unacceptable_item');
				}

				$content['msg'] = $msg;
				$data['btn'] = 'btn-default';
				$content['status'] = $approval['5'];
			}

			
			$data['scheduleID'] = $item;
			$content['action'] = $action;
			$content['view'] = $this->load->view('backend/facilitator/load_plans_buttons',$data,true);
			
			echo json_encode($content);
		}

function action_comment($param1=""){

	$content = array();
				//Add Comment 
				
				$data2['recid'] = $param1;
				$data2['userid'] = $this->session->login_user_id;
				$data2['rson'] = $this->input->post('rson');
				$data2['app_name'] = $this->session->app_name;
				
				$this->db->insert('detail',$data2);
				
				$msg = get_phrase('item_commented_successful');

	$data['scheduleID'] = $param1;
	
	$content['msg'] = $msg;
	$content['view'] = $this->load->view('backend/facilitator/load_body_comments',$data,true);
	
	echo json_encode($content);
}

function budget_comments(){
	$arr = explode("-", $_POST['id']);
	$action = $arr[0];
	$id = $arr[1];
	

	$data['scheduleID'] = $id;
	echo $this->load->view('backend/facilitator/load_comments',$data,true);
}
function budget_notes(){
	$arr = explode("-", $_POST['id']);
	$action = $arr[0];
	$id = $arr[1];
	

	$data['scheduleID'] = $id; 
	echo $this->load->view('backend/facilitator/load_budget_notes',$data,true);
}
function decline_budget_item($param1="",$param2="",$param3=""){
			
			if($this->db->get_where('plansschedule',array('scheduleID'=>$param3))->num_rows()>0){
				$data['approved'] = '3';
			
				$this->db->where(array('scheduleID'=>$param3))->update('plansschedule',$data);


				//Add Comment 
				
				$data2['recid'] = $param3;
				$data2['userid'] = $this->session->login_user_id;
				$data2['rson'] = $this->input->post('rson');
				$data2['app_name'] = $this->session->app_name;
				
				$this->db->insert('detail',$data2);
				
				$this->session->set_flashdata('flash_message',get_phrase('item_declined_successful'));
			}else{
				$this->session->set_flashdata('flash_message',get_phrase('decline_failure'));
			}
	
			redirect(base_url().'ifms.php/facilitator/plans/'.$param1.'/'.$param2,'refresh');	
}

function modal_unacceptable_budget_item($param1="",$param2="",$param3=""){
			
			if($this->db->get_where('plansschedule',array('scheduleID'=>$param3,'approved<>'=>'2'))->num_rows()>0){
				$data['approved'] = '5';
			
				$this->db->where(array('scheduleID'=>$param3,'approved<>'=>'2'))->update('plansschedule',$data);
				
				$data2['recid'] = $param3;
				$data2['userid'] = $this->session->login_user_id;
				$data2['rson'] = $this->input->post('rson');
				$data2['app_name'] = $this->session->app_name;
				
				$this->db->insert('detail',$data2);
				
				$this->session->set_flashdata('flash_message',get_phrase('unacceptable_item'));
			}else{
				$this->session->set_flashdata('flash_message',get_phrase('unacceptable_flag_failure'));
			}
	
			redirect(base_url().'ifms.php/facilitator/plans/'.$param1.'/'.$param2,'refresh');	
}

function add_budget_item_comments($param1="",$param2="",$param3=""){
		$data2['recid'] = $param3;
		$data2['userid'] = $this->session->login_user_id;
		$data2['rson'] = $this->input->post('rson');
		$data2['app_name'] = $this->session->app_name;
				
		$this->db->insert('detail',$data2);	
				
		$this->session->set_flashdata('flash_message',get_phrase('comment_added_successful'));
				
		redirect(base_url().'ifms.php/facilitator/plans/'.$param1.'/'.$param2,'refresh');
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
    function civ_report($param1=""){
	if ($this->session->userdata('admin_login') != 1)
	      redirect(base_url(), 'refresh');
	
	$page_data['page_name']  = 'civ_report';
	
	if($param1==="closed"){
		$page_data['page_name']  = 'closed_civs_report';
	}
	//$page_data['page_name']  = 'civ_report';
    $page_data['page_title'] = get_phrase('interventions_report');
    $this->load->view('backend/index', $page_data);	 	
 } 
}