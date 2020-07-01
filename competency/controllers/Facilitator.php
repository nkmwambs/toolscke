<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Nicodemus Karisa
 *	date		: 27 April, 2017
 */

class Facilitator extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->load->model('file');		
		$this->load->library('zip');

		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
	
	/***default functin, redirects to login page if no admin logged in yet***/
   public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'claims.php/login', 'refresh');
		
    }

    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
		
		$date = date('Y-m-d');
			
        $page_data['page_name']  = 'dashboard';
		$page_data['benchmarks'] = $this->assessment_model->due_benchmarks($this->session->login_user_id,$date);
		$page_data['high'] = $high =  $this->assessment_model->high_benchmarks($this->session->login_user_id,$date);
		$page_data['low'] =  $this->assessment_model->low_benchmarks($this->session->login_user_id,$date);
		$page_data['performance'] = $this->assessment_model->performance($this->session->login_user_id,$date);
		$page_data['date'] = $date;		
        $page_data['page_title'] = get_phrase('assessment_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	
	function assessment($param1="",$param2=""){
        if ($this->session->userdata('admin_login') != 1) 
            redirect(base_url().'admin.php','refresh');	
		
		$date = date('Y-m-d');
		$page_data['disabled']  = '';
		$page_data['benchmarks'] = $this->assessment_model->due_benchmarks($this->session->login_user_id,$date);
		
		if($param1!==""){
			$date = date("Y-m-d",$param1);
			$page_data['disabled']  = 'disabled';
			$page_data['benchmarks'] = $this->assessment_model->due_benchmarks($this->session->login_user_id,$date);
		}
		
		if($param2!==""){
			$page_data['benchmarks'] = $this->assessment_model->due_benchmarks($this->session->login_user_id,$date,$param2);
		}
			
        $page_data['page_name']  = __FUNCTION__;
		$page_data['high'] = $high =  $this->assessment_model->high_benchmarks($this->session->login_user_id,$date);
		$page_data['low'] =  $this->assessment_model->low_benchmarks($this->session->login_user_id,$date);
		$page_data['date'] = $date;
        $page_data['page_title'] = get_phrase('assessment')." ".get_phrase('current_date')." : ".date('d-m-Y',strtotime($date));
        $this->load->view('backend/index', $page_data);	
	}
	
	function mark_assessed($param1="",$param2=""){
			
			$date = date('Y-m-d',$param2);
			
			$freq_array = array("1"=>date('Y-m-d',strtotime('+7 days',strtotime($date))),'2'=>date('Y-m-d',strtotime('+1 month',strtotime($date))),'3'=>date('Y-m-d',strtotime('+4 months',strtotime($date))),'4'=>date('Y-m-d',strtotime('+12 month',strtotime($date))));
			
			$frequency = $this->db->get_where('benchmark',array('benchmark_id'=>$param1))->row()->frequency;
			
			$data['users_id'] = $this->session->login_user_id;
			$data['period'] = $date;//date('Y-m-d',$param2);
			$data['next_assessment_date'] = $freq_array[$frequency];
			$data['benchmark_id'] = $param1;
			$data['score'] = $this->input->post('score');
			
			$this->db->insert('result',$data);
			
			$result_id = $this->db->insert_id();
			
			$data2['result_id'] = $result_id;
			$data2['comment'] = $this->input->post('comment');
			
			$this->db->insert('assessment_comments',$data2);
			
			
			$rating = $this->input->post('rating');
			$report_id = $this->input->post('report_id');
			
			for($i=0;$i<sizeof($rating);$i++):
				$data5['result_id'] = $result_id;
				$data5['report_id'] = $report_id[$i];
				$data5['rating'] =  $rating[$i];
				
				$this->db->insert('result_details',$data5);
			endfor;
						
			if($this->db->get_where('next_assessment',array('benchmark_id'=>$param1,'users_id'=>$this->session->login_user_id))->num_rows()!==0){
				$data4['next_assessment_date'] = $freq_array[$frequency];	
				$this->db->where(array('benchmark_id'=>$param1,'users_id'=>$this->session->login_user_id));
				$this->db->update('next_assessment',$data4);
			}else{
				$data4['users_id'] = $this->session->login_user_id;
				$data4['next_assessment_date'] = $freq_array[$frequency];
				$data4['benchmark_id'] = $param1;
				$this->db->insert('next_assessment',$data4);
			}
			
			
			
			$this->session->set_flashdata('flash_message',get_phrase('parameter_assessed_successful'));
			
			redirect(base_url().'competency.php/facilitator/assessment/', 'refresh');	
		}

	function view_reports($benchmark_id="",$tym=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
        $page_data['page_name']  = __FUNCTION__;
		$page_data['benchmark_id']  = $benchmark_id;
		$page_data['tym']  = $tym;
        $page_data['page_title'] = get_phrase('reports');
        $this->load->view('backend/index', $page_data);			
	}
	
		function view_result($benchmark_id="",$tym=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
        $page_data['page_name']  = __FUNCTION__;
		$page_data['benchmark_id']  = $benchmark_id;
		$page_data['tym']  = $tym;
		$page_data['result_id'] = $this->db->get_where('result',array('users_id'=>$this->session->login_user_id,"benchmark_id"=>$benchmark_id))->row()->result_id;
        $page_data['page_title'] = get_phrase('reports');
        $this->load->view('backend/index', $page_data);			
	}
}