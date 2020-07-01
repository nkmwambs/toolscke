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


    function pdsreport()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'reports.php','refresh');
		/**	
        $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('pdsreport');			
		
		
		$output = $crud->render();			
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('PDs_report');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);
		 * 
		 */
		$page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('pds_report');
        $this->load->view('backend/index', $page_data);		
    }	

	
		
}