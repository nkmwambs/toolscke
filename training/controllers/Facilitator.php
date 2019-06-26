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
		$page_data['participants'] = $this->db->select("participant_id,users_id,event_id,confirmed,attended")->join("users","users.ID=participant.users_id")->get_where("participant",array("event_id"=>$param1,"cname"=>$this->session->cluster))->result_object();
        $this->load->view('backend/index', $page_data);
    }
 
    function manage_register($param1="",$param2=""){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
			$page_data['participants'] = $this->db->select("participant_id,users_id,event_id,confirmed,attended")->join("users","users.ID=participant.users_id")->get_where("participant",array("event_id"=>$param1,"cname"=>$this->session->cluster))->result_object();
			
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
				$page_data['participants'] = $this->db->select("participant_id,users_id,event_id,confirmed,attended")->join("users","users.ID=participant.users_id")->get_where("participant",array("event_id"=>$param2,"cname"=>$this->session->cluster))->result_object();
			}
			
			if($param1==="add_participants"){
				
				$selected_participants = $this->input->post("selected_participants");
				
				foreach($selected_participants as $row){
						$page_data['participants'] = $this->db->select("participant_id,users_id,event_id,confirmed,attended")->join("users","users.ID=participant.users_id")->get_where("participant",array("event_id"=>$param2,"cname"=>$this->session->cluster))->result_object();
					if($this->db->get_where("participant",array('event_id'=>$param2,"users_id"=>$row))->num_rows() == 0){
						
						$data['users_id'] = $row;
						$data['event_id'] = $param2;
						
						$this->db->insert("participant",$data);
						
					}
					
				}
				
				
				$this->session->set_flashdata('flash_message',get_phrase('operation_success'));
				
				redirect(base_url().'training.php/facilitator/register/'.$param2,'refresh');
				
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
}
