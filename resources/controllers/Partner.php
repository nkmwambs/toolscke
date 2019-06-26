<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Nicodemus Karisa
 *	date		: 27 April, 2017
 */

class Partner extends CI_Controller
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
            redirect(base_url() . 'exams.php/login', 'refresh');
		
    }

    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'reports.php','refresh');
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('reports_dashboard');
        $this->load->view('backend/index', $page_data);
    }

function external_links($param1="",$param2="")
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'resources.php','refresh');
			
			if($param1=="add"){
				$data = $this->input->post();
				
				array_pop($data);
								
				$this->db->insert('external_links',$data);
				
				$link_id = $this->db->insert_id();
				
				$userlevels = $this->input->post('userlevels');
				
				if(count($userlevels) == 0){
							$data2['external_links_id'] = $link_id;
							$data2['userlevel'] = $this->session->logged_user_level;
							$data2['status'] = '1';
							
							$this->db->insert('links_group_access',$data2);
				}else{
						for($i=0;$i<sizeof($userlevels);$i++){
							$data2['external_links_id'] = $link_id;
							$data2['userlevel'] = $userlevels[$i];
							$data2['status'] = '1';
							
							$this->db->insert('links_group_access',$data2);
						}	
				}
				
				//break;
				$this->session->set_flashdata('flash_message' , get_phrase('link_added')); 
            	redirect(base_url() . 'resources.php/admin/external_links/', 'refresh'); 
			}
			
			if($param1=="edit"){
				$data = $this->input->post();
				
				array_pop($data);
				
				$this->db->update('external_links',$data,array('external_links_id'=>$param2));
				
				$userlevels = $this->input->post('userlevels');
				
				for($i=0;$i<sizeof($userlevels);$i++){
					$data2['external_links_id'] = $param2;
					$data2['userlevel'] = $userlevels[$i];
					$data2['status'] = '1';
					if($this->db->get_where('links_group_access',array('external_links_id'=>$param2,'userlevel'=>$userlevels[$i]))->num_rows() === 0){
						$this->db->insert('links_group_access',$data2);
					}else{
						$this->db->update('links_group_access',$data2,array('external_links_id'=>$param2,'userlevel'=>$userlevels[$i]));
					}

				}
				//break;
				$this->session->set_flashdata('flash_message' , get_phrase('link_editted')); 
            	redirect(base_url() . 'resources.php/admin/external_links/', 'refresh'); 
			}

			if($param1=="delete"){
				
				$chk_link_obj = $this->db->get_where("external_links",array("external_links_id"=>$param2));
				$msg = get_phrase('delete_unsuccessful');
				
				if($chk_link_obj->num_rows() > 0 ){
					$this->db->where(array("external_links_id"=>$param2));
					$this->db->delete("links_group_access");
					
					$this->db->where(array("external_links_id"=>$param2));
					$this->db->delete("external_links");
					
					$msg = get_phrase('link_deleted');
				}
				
				
				$this->session->set_flashdata('flash_message' , $msg); 
            	redirect(base_url() . 'resources.php/admin/external_links/', 'refresh'); 
			}
						
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('external_links');
        $this->load->view('backend/index', $page_data);
    }	

	  function documents($param1="",$param2="")
    	{
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'resources.php','refresh');
			
			if($param1==='add'){
				//if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){
					
								$fld = str_replace(" ", "_", $this->input->post('title'));
	        	
								$uploadPath = 'uploads/document/resources/';
								//Check if group folder exists
								if(!file_exists($uploadPath."/".$fld)){
									mkdir($uploadPath."/".$fld);
								}
								
		        	 $filesCount = count($_FILES['userFiles']['name']);
	            		for($i = 0; $i < $filesCount; $i++){
	            			    $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
				                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
				                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
				                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
				                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
								
								$fullUploadPath = $uploadPath."/".$fld;
				                
				                $config['upload_path'] = $fullUploadPath;
				                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx';
								
								$this->load->library('upload', $config);
				                $this->upload->initialize($config);
				                if($this->upload->do_upload('userFile')){
				                    $fileData = $this->upload->data();
				                    $uploadData['title'] = $fld;
				                    $uploadData['status'] = $this->input->post('status');	
									$uploadData['description'] = $this->input->post('description');				
				                    $uploadData['timestamp'] = date("Y-m-d H:i:s");
				                    $uploadData['owner'] = $this->input->post('owner');	
				                }
						}	
	
					if(!empty($uploadData)){
		                //Insert file information into the database
		                $insert = $this->db->insert('document',$uploadData);
		                $statusMsg = $insert?'Document uploaded successfully.':'Some problem occurred, please try again.';
		                $this->session->set_flashdata('flash_message',$statusMsg);
						//break;
						redirect(base_url() . 'resources.php/admin/documents/', 'refresh');
						
		            }
				//}
			}
		
		    $page_data['page_name']  = __FUNCTION__;
        	$page_data['page_title'] = get_phrase('documents');
        	$this->load->view('backend/index', $page_data);
		}

		function ziparchive($param1="",$param2="",$param3=""){
		
			$fld = $this->db->get_where('document',array('document_id'=>$param1))->row()->title;
			
			if(file_exists($path = 'uploads/document/resources/'.$fld)){
			
				if ($handle = opendir($path)) {
				    while (false !== ($file = readdir($handle))) {
				    	
				        if ('.' === $file) continue;
				        if ('..' === $file) continue;
				
				        // do something with the file
				        $data = file_get_contents($path."/".$file);
					
						$this->zip->add_data($file, $data);
				    }
				    closedir($handle);
				}
				
				
				// Write the zip file to a folder on your server. Name it "my_backup.zip"
				$this->zip->archive('downloads/my_backup.zip');
				
				// Download the file to your desktop. Name it "my_backup.zip"
				
				$backup_file = 'downloads_'.date("Y_m_d_H_i_s").'.zip'; 
				
				$this->zip->download($backup_file);
				
				unlink('downloads/my_backup.zip');
			}else{
					
				$this->session->set_flashdata('flash_message' , get_phrase('file_not_found'));
					
				$page_data['page_name']  = 'documents';
        		$page_data['page_title'] = get_phrase('documents');
        		$this->load->view('backend/index', $page_data);
			}
			
			
		
	}


    

	
		
}