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
		$this->load->model('listing_model','listing');
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'photos.php/login', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('project_dashboard');
        $this->load->view('backend/index', $page_data);
    }
function upload_zone(){
        if ($this->session->userdata('admin_login') != 1)
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
				
				$img_count = 0;

				if($this->upload->do_upload('file')){
					$fileData = $this->upload->data();
					$uploadData['file_name'] = $fileData['file_name'];
					$uploadData['created'] = date("Y-m-d H:i:s");
					$uploadData['modified'] = date("Y-m-d H:i:s");
					$uploadData['group'] = substr($fileData['file_name'], 0,6);
					
					$img_count++;
				}
							


			if(!empty($uploadData)){
				//Insert files data into the database
				$insert = $this->file->insert($uploadData);

				//$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				//$this->session->set_flashdata('flash_message' , $statusMsg);
			}
			
			
			if($img_count==='0'){
				
				/**$this->load->library('email');

				$config['protocol']    = 'smtp';

				$config['smtp_host']    = 'ssl://smtp.gmail.com';

				$config['smtp_port']    = '465';

				$config['smtp_timeout'] = '7';
	
				$config['smtp_user']    = 'nkmwambs@gmail.com';

				$config['smtp_pass']    = '@Biotech2014';

				$config['charset']    = 'utf-8';

				$config['newline']    = "\r\n";

				$config['mailtype'] = 'text'; // or html

				$config['validation'] = TRUE; // bool whether to validate email or not      

				$this->email->initialize($config);


				$this->email->from('nkmwambs@gmail.com', 'Nicodemus Karisa');
				
				$this->email->to('NKarisa@ke.ci.org');


				$this->email->subject('Email Test');

				$this->email->message('Testing the email class.');  

				$this->email->send();
			**/
				upload_mail();
			}
		
		thumbnail('uploads/photos/'.$project.'/'.$_FILES['file']['name'], 100, 100);

       
	}
	
	function photo_notification($project=""){
			//$headers = 'From: Photo Manager <admin@compassionkenya.com' . "\r\n";
			//mail('NKarisa@ke.ci.org','Test','Test Mail',$headers);
				$config = Array(
				    'mailtype' => 'html'
				);
				
				$this->email->initialize($config);
				
				$from_email = 'admin@compassionkenya.com';//$this->db->get_where('users',array('users_id'=>$this->session->login_user_id))->row()->email;
				$from_name = 'Photo Manager';//$this->db->get_where('users',array('users_id'=>$this->session->login_user_id))->row()->name;
				
				$icp_email = $this->db->get_where('users',array('ID'=>$this->session->login_user_id))->row()->email;
				
				$sdsa_users_id = $this->db->get_where('projects',array('num'=>$project))->row()->sdsa;
				$sdsa_email = $this->db->get_where('users',array('ID'=>$sdsa_users_id))->row()->email;
				
				$facilitator_users_id = $this->db->get_where('projects',array('num'=>$project))->row()->facilitator;
				$facilitator_email = $this->db->get_where('users',array('ID'=>$facilitator_users_id))->row()->email;				 
				
				$this->email->from($from_email, $from_name);
				$this->email->to($sdsa_email);
				$this->email->cc(array($facilitator_email,$icp_email));
				//$this->email->bcc($icp_email);
				
				$this->email->subject('Beneficiary Photos from '.$project);
				
				//Get new Files for the ICP
				
				$new_files = $this->db->get_where('files',array('group'=>$project,'status'=>1));
				
				?>
				
				<style>
					.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#ffffff; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
				</style>
				
				<?php
				
				$body_str = "<p>You have received ".$new_files->num_rows()." beneficiary images from ".$project." as listed below:<br/>";
				
				$body_str .="</p><div class='datagrid'><table border='1' style='border-collapse:collapse;width:100%;'>";
				
				$body_str .="<thead><tr><th>File Name</th><th>Created Date</th><th>Type</th><th>File Size</th><th>Height</th><th>Width</th></tr></thead><tbody>";
				
				foreach($new_files->result_object() as $file){
					$file_path = base_url().'uploads/photos/'.$project.'/'.$file->file_name;
					$image = getimagesize($file_path);
					$type = explode("/",$image['mime']);
					$file_name = basename(base_url().'uploads/photos/'.$project.'/'.$file->file_name);
					$file_arr = explode('.', $file_name);
					
					$height = $image['1'];
					$width = $image['0'];
					$size = human_filesize(filesize('uploads/photos/'.$project.'/'.$file->file_name));
					$type = $type['1'];
							
					$body_str .="<tr><td>".$file->file_name."</td><td>".$file->created."</td><td>".$type."</td><td>".$size."</td><td>".$height."</td><td>".$width."</td></tr>";
				}
				
				$body_str .="</tbody></table></div>";
				
				
				$body_str .="<p>Regards,</p> Photo Manager Admin";
				
				$this->email->message($body_str);
				
				$this->email->send();
			
			echo 'Mail sent successfully';
		}

	function search_photo(){
   	$photos = $this->listing->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		$photo_status = array("","New","Accepted","Rejected","Reinstated");
		foreach ($photos as $photo) {
			
			$row = array();
			$action_data['id'] = $photo->id ;
			$row[] = $this->load->view("backend/partner/photo_action",$action_data,TRUE);
			$row[] = '<a href="#" onclick="showAjaxModal(\''.base_url().'photos.php/modal/popup/modal_full_photo/'.$photo->id.'\');"><img src="'.base_url().'uploads/thumbnails/'.$photo->file_name.'"/></a>';
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
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
	
			
        $page_data['page_name']  = 'gallery';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('backend/index', $page_data);		
	}
	
	function manage_profile($param1="",$param2="",$param3=""){
		if ($this->session->userdata('admin_login') != 1)
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
			
			redirect(base_url() . 'photos.php/sdsa/manage_profile/', 'refresh');	
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
			
			redirect(base_url() . 'photos.php/sdsa/manage_profile/', 'refresh');
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
				
				redirect(base_url() . 'photos.php/sdsa/manage_profile/', 'refresh');	
		}
		
		$page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $this->load->view('backend/index', $page_data);
	}
    function users_list(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
        $page_data['page_name']  = 'users_list';
        $page_data['page_title'] = get_phrase('users_list');
        $this->load->view('backend/index', $page_data);  		
  	}
}
