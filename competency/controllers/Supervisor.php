<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Nicodemus Karisa
 *	date		: 27 April, 2017
 */

class Supervisor extends CI_Controller
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
            redirect(base_url().'competency.php','refresh');
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('assessment_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	
	function assessments()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'competency.php','refresh');
			
        $page_data['page_name']  = __FUNCTION__;
		$page_data['result'] = $this->db->get("result")->result_object();
        $page_data['page_title'] = get_phrase('assessment');
        $this->load->view('backend/index', $page_data);
    }
	
	
}