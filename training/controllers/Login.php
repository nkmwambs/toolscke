<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

	
	public function validate_login($users_id="",$app_name=""){
		 $credential = array('ID' => $users_id);

        // Checking login credential for admin
        $query = $this->db->get_where('users', $credential);
        if ($query->num_rows() > 0) {
		            $row = $query->row();
		            $this->session->set_userdata('admin_login', 1);
		            $this->session->set_userdata('admin_id', $row->ID);
		            $this->session->set_userdata('login_user_id', $row->ID);
		            $this->session->set_userdata('name', $row->username);
					$this->session->set_userdata('logged_user_level', $row->userlevel);

		            $login_type = 'other';
					if($this->db->get_where('positions',array("pstID"=>$row->userlevel))->row()->short_name!==""){
						$login_type = $this->db->get_where('positions',array("pstID"=>$row->userlevel))->row()->short_name;
					} 
					
		            $this->session->set_userdata('login_type', $login_type);
					
					$this->session->set_userdata('center_id', $row->fname);

					$this->session->set_userdata('cluster', $row->cname);
			
					//$access_level = "admin";
					
					//if($this->session->userdata('logged_user_level')==='1'){
						//$access_level = "partner";
					//}	
					
					$this->session->set_userdata('app_name', $app_name);	
					
					
					$access_level = 'other';
					if($this->db->get_where('positions',array("pstID"=>$row->userlevel))->row()->short_name!==""){
						$access_level = $this->db->get_where('positions',array("pstID"=>$row->userlevel))->row()->short_name;
					}
					
            redirect(base_url().$app_name.'.php/'.$access_level.'/dashboard', 'refresh');
        }

       

        redirect(base_url() . 'admin.php', 'refresh');	
		
	}

}