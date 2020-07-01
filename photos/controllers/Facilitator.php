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
        if ($this->session->userdata('facilitator_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('facilitator_login') != 1)
            redirect(base_url(), 'refresh');
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('facilitator_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
  function upload_zone(){
        if ($this->session->userdata('facilitator_login') != 1)
            redirect(base_url(), 'refresh');
	
			
        $page_data['page_name']  = 'upload_zone';
        $page_data['page_title'] = get_phrase('upload_zone');
        $this->load->view('backend/index', $page_data);		
}    
 
 function upload_photo(){

				$project  = substr($_FILES['file']['name'], 0,6);
				
				if(!file_exists('uploads/photos/'.$project.'/')){
					mkdir('uploads/photos/'.$project.'/');
				}
				
				if(file_exists('uploads/photos/'.$project.'/'.$_FILES['file']['name'])){
					unlink('uploads/photos/'.$project.'/'.$_FILES['file']['name']);
				}

				//Check if thumbnail exists
						
				if(file_exists('uploads/thumbnails/'.$_FILES['file']['name'])){
					unlink('uploads/thumbnails/'.$_FILES['file']['name']);
				}

				$uploadPath = 'uploads/photos/'.$project.'/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpeg|jpg';
				//$config['max_size']	= '1024';
				//$config['max_width'] = '800';
				//$config['max_height'] = '1200';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file')){
					$fileData = $this->upload->data();
					$uploadData['file_name'] = $fileData['file_name'];
					$uploadData['created'] = date("Y-m-d H:i:s");
					$uploadData['modified'] = date("Y-m-d H:i:s");
					$uploadData['group'] = substr($fileData['file_name'], 0,6);
				}
							
				
		
			if(!empty($uploadData)){
				//Insert files data into the database
				$insert = $this->file->insert($uploadData);
				//$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				//$this->session->set_flashdata('flash_message' , $statusMsg);
			}
		
		
		
		thumbnail('uploads/photos/'.$project.'/'.$_FILES['file']['name'], 100, 100);

       
	}
    
	function search_photo(){
   	$photos = $this->listing->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		$photo_status = array("","New","Accepted","Rejected","Reinstated");
		foreach ($photos as $photo) {
			
			$row = array();
			$action_data['id'] = $photo->id ;
			$row[] = $this->load->view("backend/project/photo_action",$action_data,TRUE);
			$row[] = '<a href="#" onclick="showAjaxModal(\''.base_url().'index.php?modal/popup/modal_full_photo/'.$photo->id.'\');"><img src="'.base_url().'uploads/thumbnails/'.$photo->file_name.'"/></a>';
			$row[] = $photo->group;
			$row[] = $photo->file_name;
			$row[] = $photo->created;
			$row[] = $photo->modified;
			$row[] = $photo_status[$photo->status];
			
			
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->listing->count_all(),
						"recordsFiltered" => $this->listing->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);		
	}

	function gallery($param1=""){
        if ($this->session->userdata('facilitator_login') != 1)
            redirect(base_url(), 'refresh');
	
			
        $page_data['page_name']  = 'gallery';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('backend/index', $page_data);		
	}
	
	function manage_profile($param1="",$param2="",$param3=""){
		if ($this->session->userdata('facilitator_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='add_user'){
			$data['name'] = $this->input->post('fname');
			$data['email'] = $this->input->post('email');
			$data['level'] = $this->input->post('level');
			$data['password'] = $this->input->post('password');
			
			//Check if email exists
			$e_check = $this->db->get_where('users',array('email'=>$this->input->post('email')))->num_rows();
			
			if($e_check===0){
				$this->db->insert('users',$data);
				
				$this->session->set_flashdata('flash_message',get_phrase('user_created_successfully'));
					
			}else{
				
				$this->session->set_flashdata('flash_message',get_phrase('process_failed_email_exists'));
			}
			
			redirect(base_url() . 'index.php?sdsa/manage_profile/', 'refresh');	
		}
		
		if($param1==='update'){
			
			$this->db->where(array('users_id'=>$param2));
			
			$data['name'] = $this->input->post('fname');
			$data['email'] = $this->input->post('email');
			if($this->input->post('password')!==""){
				$data['password'] = $this->input->post('password');
			}
			$data['level'] = $this->input->post('level');
			
			$this->db->update('users',$data);
			
			$this->session->set_flashdata('flash_message',get_phrase('profile_updated'));
			
			redirect(base_url() . 'index.php?sdsa/manage_profile/', 'refresh');
		}
		
		if($param1==='delete'){
				
			
				//Check if an project is link
				
				$level = array('none','none','sdsa','facilitator');
				
				$link_check = $this->db->get_where('projects',array($level[$param2]=>$param3))->num_rows();
				
				if($link_check===0){
					$this->db->where(array('users_id'=>$param3));
				
					$this->db->delete('users');
					
					$this->session->set_flashdata('flash_message',get_phrase('user_deleted'));
				}else{
					$this->session->set_flashdata('flash_message',get_phrase('user_with_linkage_cannot_delete'));	
				}
				
				redirect(base_url() . 'index.php?sdsa/manage_profile/', 'refresh');	
		}
		
		$page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $this->load->view('backend/index', $page_data);
	}
}
