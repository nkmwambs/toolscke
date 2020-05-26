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
		$prefs = array (
               'start_day'    => 'saturday',
               'month_type'   => 'long',
               'day_type'     => 'short',
               'show_next_prev'=>TRUE,
               'next_prev_url'   => 'http://localhost/tools/competency.php/admin/dashboard/'
             );
		$this->load->library('calendar',$prefs);
		//$this->config->load('techsys');
		$this->load->library('encrypt');
		$this->load->library('table');

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
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
		
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('assessment_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	

  function benchmarks(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
		
		$this->benchmark->mark('code_start');
		
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('benchmark');
		$crud->add_action(get_phrase('reports'), '', 'admin/book', 'ui-icon-plus',array($this,'report_action'));
		$crud->field_type('frequency','dropdown',
		array( "1"  => "Weekly", "2" => "Monthly", "3" => "Quarterly", "4" => "Annually"));
		
		$crud->callback_after_delete(array($this,'benchmarks_reports_after_delete'));
		
		$this->benchmark->mark('code_end');
		
		$output = $crud->render();			
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('benchmarks');
		$page_data['elapsed_time'] = $this->benchmark->elapsed_time('code_start', 'code_end');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);  	
  }

	function benchmarks_reports_after_delete($primary_key){
		return $this->db->delete('report',array('benchmark_id'=>$primary_key));
	}
  
  function report_action($primary_key , $row){
        //return site_url('competency.php/admin/reports').'?country='.$row->country; 	
        return base_url().'competency.php/admin/reports/'.$primary_key;
  }
  
  function reports($param1=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'admin.php','refresh');
			
        $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('report');
		$crud->where('benchmark_id',$param1);
		
		$crud->field_type('benchmark_id', 'hidden');
		
		
		$output = $crud->render();			
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('reports');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);	
  }
    
}
