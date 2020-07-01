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
            redirect(base_url() . 'login', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard($param1="",$param2="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
		
			if($param1==='edit_event'){
				$data2['event_title'] = $this->input->post('event_title');
				$data2['event_start_date'] = $this->input->post('event_start_date');
				$data2['event_end_date'] = $this->input->post('event_end_date');
				$data2['color_code'] = $this->input->post('color_code');
				$data2['allDay'] = 'false';
				if($this->input->post('allDay')){
					$data2['allDay'] = 'true';	
				}
				$data2['event_description'] = $this->input->post('event_description');
				
				$this->db->where(array('event_id'=>$param2));
				
				$this->db->update('event',$data2);
				
				$this->session->set_flashdata('flash_message',get_phrase('event_edited_successfully'));
				
				redirect(base_url().'training.php/admin/dashboard','refresh');
			}
			
			if($param1==='add_event'){
				$data['event_title'] = $this->input->post('event_title');
				$data['event_start_date'] = $this->input->post('event_start_date');
				$data['event_end_date'] = $this->input->post('event_end_date');
				$data['event_end_date'] = $this->input->post('event_end_date');
				$data['color_code'] = $this->input->post('color_code');
				$data['allDay'] = 'false';
				if($this->input->post('allDay')){
					$data['allDay'] = 'true';	
				}
				$data['event_description'] = $this->input->post('event_description');
				
				$this->db->insert('event',$data);
				
				$this->session->set_flashdata('flash_message',get_phrase('event_created_successfully'));
				
				redirect(base_url().'training.php/admin/dashboard','refresh');
			}	
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('training_calendar');
        $this->load->view('backend/index', $page_data);
    }
	
	function view_event($param1=""){
		$this->db->like('event_id', $param1);
		echo json_encode($this->db->get('event')->row()); 
	}
  
  	function event_edit(){

				$data2['event_start_date'] = $_POST['event_start_date'];
				$data2['event_end_date'] = $_POST['event_end_date'];

				
				$this->db->where(array('event_title'=>$_POST['event_title']));
				
				$this->db->update('event',$data2);
				
				echo get_phrase('event_moved_successful');
  	}
	
	function delete_event(){
		
		$msg = "Event Deleted";
		
		$this->db->where(array('event_title'=>$_POST['title']));
		
		$query = $this->db->delete('event');
		
		if($this->db->affected_rows() === 0 ) $msg = "Event Not Deleted";
		
		echo $msg;
		
	}
	
	function lms($param1="",$param2="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
        $page_data['page_name']  = 'lms';
        $page_data['page_title'] = get_phrase('learning_manager');
        $this->load->view('backend/index', $page_data);
    }
	
	function training_projects($param1="",$param2="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
        $page_data['page_name']  = 'training_projects';
        $page_data['page_title'] = get_phrase('training_projects');
        $this->load->view('backend/index', $page_data);
    }

	function register($param1="",$param2="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
        $page_data['page_name']  = 'register';
        $page_data['page_title'] = get_phrase('register');
		$page_data['event'] = $this->db->get_where("event",array("event_id"=>$param1))->row();
		$page_data['participants'] = $this->db->get_where("participant",array("event_id"=>$param1))->result_object();
        $this->load->view('backend/index', $page_data);
    }
	
	
	function manage_register($param1="",$param2=""){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
			$page_data['participants'] = $this->db->get_where("participant",array("event_id"=>$param1))->result_object();
			
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
				$page_data['participants'] = $this->db->get_where("participant",array("event_id"=>$param2))->result_object();
			}
			
			if($param1==="add_participants"){
				
				$selected_participants = $this->input->post("selected_participants");
				
				foreach($selected_participants as $row){
						
					if($this->db->get_where("participant",array('event_id'=>$param2,"users_id"=>$row))->num_rows() == 0){
						
						$data['users_id'] = $row;
						$data['event_id'] = $param2;
						
						$this->db->insert("participant",$data);
						
					}
					
				}
				
				
				$this->session->set_flashdata('flash_message',get_phrase('operation_success'));
				
				redirect(base_url().'training.php/admin/register/'.$param2,'refresh');
				
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

	function evaluation($param1="",$param2="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
        $page_data['page_name']  = 'evaluation';
        $page_data['page_title'] = get_phrase('training_evaluation');
        $this->load->view('backend/index', $page_data);
    }    
}
