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

class Partner extends CI_Controller
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
            redirect(base_url() . 'login', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard($param1="",$param2="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
		

			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('training_calendar');
        $this->load->view('backend/index', $page_data);
    }
	
	function view_event($param1=""){
		
		echo json_encode($this->db->get_where('event',array('event_title'=>trim($_POST['title'])))->row()); 
	}

	function register($param1="",$param2="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
        $page_data['page_name']  = 'register';
        $page_data['page_title'] = get_phrase('register');
		$page_data['event'] = $this->db->get_where("event",array("event_id"=>$param1))->row();
		$page_data['participants'] = $this->db->select("participant_id,users_id,event_id,confirmed,attended")->join("users","users.ID=participant.users_id")->get_where("participant",array("event_id"=>$param1,'fname'=>$this->session->center_id))->result_object();
        $this->load->view('backend/index', $page_data);
    }
 
    function manage_register($param1="",$param2=""){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
			$page_data['participants'] = $this->db->select("participant_id,users_id,event_id,confirmed,attended")->join("users","users.ID=participant.users_id")->get_where("participant",array("event_id"=>$param1,'fname'=>$this->session->center_id))->result_object();
			
			if($param1==="list_users"){
				$projects = $this->input->post("projects");
			
				$this->db->where_in('fname',$projects);
				$this->db->where('userlevel','1');
				$this->db->where('department > ','0');
				$this->db->where('auth','1');
				$arr = $this->db->select("fname,ID,userfirstname,userlastname,cname")->get("users")->result_array();
				$page_data['users'] = array();
				
				foreach($arr as $row){
					//$fname = array_shift($row);
					$page_data['users'][$row['fname']][] = $row; 	
				}
				
				$page_data['event'] = $this->db->get_where("event",array("event_id"=>$param2))->row();
				$page_data['participants'] = $this->db->select("participant_id,users_id,event_id,confirmed,attended")->join("users","users.ID=participant.users_id")->get_where("participant",array("event_id"=>$param2,'fname'=>$this->session->center_id))->result_object();
			}
			
			if($param1==="add_participants"){
				
				$selected_participants = $this->input->post("selected_participants");
				
				foreach($selected_participants as $row){
						$page_data['participants'] = $this->db->select("participant_id,users_id,event_id,confirmed,attended")->join("users","users.ID=participant.users_id")->get_where("participant",array("event_id"=>$param2,'fname'=>$this->session->center_id))->result_object();
					if($this->db->get_where("participant",array('event_id'=>$param2,"users_id"=>$row))->num_rows() == 0){
						
						$data['users_id'] = $row;
						$data['event_id'] = $param2;
						
						$this->db->insert("participant",$data);
						
					}
					
				}
				
				
				$this->session->set_flashdata('flash_message',get_phrase('operation_success'));
				
				redirect(base_url().'training.php/partner/register/'.$param2,'refresh');
				
			}
			
			if($param1 === 'erase_participants'){
				$cnt = 0;
				foreach($_POST as $users_id){
					if($this->db->get_where("participant",array("users_id"=>$users_id,"attended"=>'1'))->num_rows() === 0){
						$this->db->where(array("users_id"=>$users_id));
						$this->db->delete("participant");
						$cnt++;
					}
				}
				echo $cnt. " ".get_phrase('records_deleted');
				exit;
			}
			
			if($param1==='mark_participation'){
				// if($_POST['marking'] === 'attended') $data['attended'] = $_POST['flag'];		
				// if($_POST['marking'] === 'confirmed') $data['confirmed'] = $_POST['flag'];	
				
				$data['confirmed'] = $_POST['marking']['confirmed'];
				$data['attended'] = $_POST['marking']['attended'];
				
				$users_id = $_POST['users_id'];
				
				$this->db->where(array('users_id'=>$users_id,"event_id"=>$param2));
				
				$this->db->update("participant",$data);
				
				//print_r($_POST);
				exit;
			}
			
			
		$page_data['page_name']  = 'register';
        $page_data['page_title'] = get_phrase('register');
		$page_data['event'] = $this->db->get_where("event",array("event_id"=>$param2))->row();
		
        $this->load->view('backend/index', $page_data); 
	}


	    
	function add_evaluation_comments(){
		//print_r($_POST);			
		$lemresponse_id = $_POST['lemresponse_id'];
		$lemquestions_id = $_POST['lemquestions_id'];
		$data['comment'] = $_POST['comment'];
		
		//if($_POST['trainer_id'] > 0){
			$this->db->where(array("lemresponse_id"=>$lemresponse_id,"lemquestions_id"=>$lemquestions_id,"trainer_id"=>$_POST['trainer_id']));	
		//}else{
			//$this->db->where(array("lemresponse_id"=>$lemresponse_id,"lemquestions_id"=>$lemquestions_id));	
		//}
		
		$this->db->update("lem",$data);	
		
		print_r($_POST);
	}

	function submit_evaluation($param1=""){
		$this->db->where(array("lemresponse_id"=>$param1));
		$data['status'] = 1;
		
		$this->db->update("lemresponse",$data);
		
		echo get_phrase("survey_submitted_successfully");
	}

	function mark_evaluation_scores(){
		if ($this->session->userdata('admin_login') != 1)
	            redirect(base_url().'admin.php','refresh');
				
			//print_r($_POST);	
			$data['lemresponse_id'] = $_POST['lemresponse_id'];
			$data['lemquestions_id'] = $_POST['lemquestions_id'];
			$data['trainer_id'] = $_POST['trainer_id'];
			$_POST['response_type'] == "radio"?$data['score'] = $_POST['score']:$data['score'] = "0";
			$_POST['response_type'] == "text"?$data['suggestion'] = $_POST['suggestion']:$data['suggestion'] = "";
			
			if($this->db->get_where("lem",array("trainer_id"=>$_POST['trainer_id'],"lemresponse_id"=>$_POST['lemresponse_id'],"lemquestions_id"=>$_POST['lemquestions_id']))->num_rows() === 0){
				$this->db->insert("lem",$data);
			}else{
				
				//if($_POST['trainer_id'] > 0 && $this->db->get_where("lem",array("trainer_id"=>$_POST['trainer_id'],"lemresponse_id"=>$_POST['lemresponse_id'],"lemquestions_id"=>$_POST['lemquestions_id']))->num_row() === 0 ){
					//$this->db->insert("lem",$data);
				//}else{
					$this->db->where(array("lemresponse_id"=>$_POST['lemresponse_id'],"lemquestions_id"=>$_POST['lemquestions_id']));
					$this->db->update("lem",$data);
				//}
				
				
			}
	}

	function view_evaluation_result($param1=""){
		$data['responses'] = $this->db->join("lemresponse","lemresponse.lemresponse_id=lem.lemresponse_id")->get_where("lem",array("user_id"=>$this->session->login_user_id,"event_id"=>$param1))->result_object();
	
		echo $this->load->view("backend/evaluation_results",$data,TRUE);
	}

	function evaluation($param1="",$param2="")
	    {
	        if ($this->session->userdata('admin_login') != 1)
	            redirect(base_url().'admin.php','refresh');

				
			$event_key = $param2 ==""?$param1:$param2;
			
			$page_data['results']  = array();
			
			if($param1 === "create_evaluation"){
				
				$data['event_id'] = $event_key;
				$data["user_id"] = $this->session->login_user_id;
				
				if($this->db->get_where("lemresponse",array("user_id"=>$this->session->login_user_id,"event_id"=>$event_key))->num_rows() === 0){
					$this->db->insert("lemresponse",$data);
					$this->session->set_flashdata('flash_message',get_phrase('successful'));
				}
						
								
				redirect(base_url().'training.php/partner/evaluation/','refresh');
				
			}
			
				
			$response = $this->db->get_where("lemresponse",array("user_id"=>$this->session->login_user_id,"event_id"=>$event_key,"status"=>"0"))->row();
			$general_questions = $this->db->get_where("lemquestions",array("status"=>1,"question_target"=>"0"))->result_object();
			$trainer_questions = $this->db->get_where("lemquestions",array("status"=>1,"question_target"=>"1"))->result_object();
			$trainers = $this->db->get_where("trainer",array("event_id"=>$event_key))->result_object();
			
			$page_data['results']['general_questions'] = $general_questions;
			$page_data['results']['trainer_questions'] = $trainer_questions;
			$page_data['results']['response'] = $response;
			$page_data['results']['trainers'] = $trainers;
			$page_data['event'] = $this->db->get_where('event',array("event_id"=>$event_key))->row();
			
			if($this->db->join("lemresponse","lemresponse.lemresponse_id=lem.lemresponse_id")->get_where("lem",array("user_id"=>$this->session->login_user_id,"event_id"=>$event_key))->num_rows() > 0){
				$scores = $this->db->join("lemresponse","lemresponse.lemresponse_id=lem.lemresponse_id")->get_where("lem",array("user_id"=>$this->session->login_user_id,"event_id"=>$event_key))->result_object();
				$page_data['scores'] = $scores;
			}
			
	        $page_data['page_name']  = 'evaluation';
	        $page_data['page_title'] = get_phrase('training_evaluation');
	        $this->load->view('backend/index', $page_data);
	    } 

}
