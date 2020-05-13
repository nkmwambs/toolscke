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
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'exams.php','refresh');
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('exams_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	

    function kcpe()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'exams.php','refresh');
		
			
        $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('kcpe');
		
		$acYr = date('Y');
		
		if(isset($_POST['acYr'])){
			$acYr = $this->input->post('acYr');
		}
		$crud->where(array('acYr'=>$acYr));
		$crud->display_as('cstName','Cluster')
			->display_as('pNo','Project')
			->display_as('childNo','Beneficiary Number')
			->display_as('childName','Beneficiary Name')
			->display_as('sex','Gender')
			->display_as('indx','Index Number')
			->display_as('eng','English')
			->display_as('kis','Kiswahili')
			->display_as('sci','Science')
			->display_as('mat','Maths')
			->display_as('totMrk','Total Marks')
			->display_as('acYr','Academic Year')
			->display_as('stmp','Time Stamp')
			->display_as('sstd','Social Studies');				
		
		$crud->unset_add_fields('stmp');
		$clusters_raw = $this->db->select('cname')->order_by('cname')->get_where('users',array('userlevel'=>'2'))->result_object();
		$clusters = array();
		
		foreach($clusters_raw as $row){
			$clusters[] = $row->cname;
		}
		
		$years = array_combine(range('2012', '2030'), range('2012', '2030'));
		
		$crud->field_type('acYr', 'dropdown',$years);
		
		$crud->field_type('cstName', 'dropdown',$clusters);
		
		$crud->callback_field('pNo',array($this,'field_callback_pNo'));
		
		$crud->unset_add();
		
		$output = $crud->render();			
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('KCPE_results');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);		
    }

	function field_callback_pNo(){
		$options = "<SELECT id='field-pNo' name='pNo' class='chosen-select' data-placeholder='Select Project'>";
		
		$options .= "</SELECT>";
		
		return $options;
	}

	function get_projects($cluster){
		$projects = $this->db->select('fname')->order_by('fname')->get_where('users',array('userlevel'=>'1','department'=>'0','cname'=>$cluster))->result_object();
		
		$options = array();
		
		foreach($projects as $row){
			$options[] = $row->fname;
		}
		
		echo json_encode($options);
	}

    function kcse()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'exams.php','refresh');
			
        $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('kcse');
		
		$acYr = date('Y');
		
		if(isset($_POST['acYr'])){
			$acYr = $this->input->post('acYr');
		}
		$crud->where(array('acYr'=>$acYr));
		
		$years = array_combine(range('2012', '2030'), range('2012', '2030'));
		
		$crud->field_type('acYr', 'dropdown',$years);

		$crud->unset_add();
		//$crud->unset_edit();
		//$crud->unset_delete();			
		
		$output = $crud->render();			
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('KCSE_results');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);	
    }
    
}
