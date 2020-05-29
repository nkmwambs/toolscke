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
            redirect(base_url().'exams.php','refresh');
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('exams_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function kcse()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'exams.php','refresh');
			
        $crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('kcse');
				
		$acYr = date('Y');
		
		if(isset($_POST['acYr'])){
			$acYr = $this->input->post('acYr');
		}
		$crud->where(array('pNo'=>$this->session->center_id,'acYr'=>$acYr));		
		
		$crud->display_as('cstName','Cluster')
			->display_as('pNo','Project')
			->display_as('childNo','Beneficiary Number')
			->display_as('childName','Beneficiary Name')
			->display_as('sex','Gender')
			->display_as('indx','Index Number')
			->display_as('eng','English')
			->display_as('kis','Kiswahili')
			->display_as('maths','Mathematics')
			->display_as('chem','Chemistry')
			->display_as('bio','Biology')
			->display_as('phy','Physics')
			->display_as('grade','Mean Grade')
			->display_as('dob','Date Of Birth')
			->display_as('acYr','Academic Year');	

		//$crud->unset_add();
		//$crud->unset_edit();
		//$crud->unset_delete();	
		$crud->field_type('eng', 'dropdown',array('12'=>'A','11'=>'A-','10'=>'B+','9'=>'B','8'=>'B-','7'=>'C+','6'=>'C','5'=>'C-','4'=>'D+','3'=>'D','2'=>'D-','1'=>'E'));		
		$crud->field_type('kis', 'dropdown',array('12'=>'A','11'=>'A-','10'=>'B+','9'=>'B','8'=>'B-','7'=>'C+','6'=>'C','5'=>'C-','4'=>'D+','3'=>'D','2'=>'D-','1'=>'E'));		
		$crud->field_type('maths', 'dropdown',array('12'=>'A','11'=>'A-','10'=>'B+','9'=>'B','8'=>'B-','7'=>'C+','6'=>'C','5'=>'C-','4'=>'D+','3'=>'D','2'=>'D-','1'=>'E'));		
		$crud->field_type('eng', 'dropdown',array('12'=>'A','11'=>'A-','10'=>'B+','9'=>'B','8'=>'B-','7'=>'C+','6'=>'C','5'=>'C-','4'=>'D+','3'=>'D','2'=>'D-','1'=>'E'));		
		$crud->field_type('chem', 'dropdown',array('12'=>'A','11'=>'A-','10'=>'B+','9'=>'B','8'=>'B-','7'=>'C+','6'=>'C','5'=>'C-','4'=>'D+','3'=>'D','2'=>'D-','1'=>'E'));		
		$crud->field_type('bio', 'dropdown',array('12'=>'A','11'=>'A-','10'=>'B+','9'=>'B','8'=>'B-','7'=>'C+','6'=>'C','5'=>'C-','4'=>'D+','3'=>'D','2'=>'D-','1'=>'E'));		
		$crud->field_type('phy', 'dropdown',array('12'=>'A','11'=>'A-','10'=>'B+','9'=>'B','8'=>'B-','7'=>'C+','6'=>'C','5'=>'C-','4'=>'D+','3'=>'D','2'=>'D-','1'=>'E'));		
		$crud->field_type('grade', 'dropdown',array('12'=>'A','11'=>'A-','10'=>'B+','9'=>'B','8'=>'B-','7'=>'C+','6'=>'C','5'=>'C-','4'=>'D+','3'=>'D','2'=>'D-','1'=>'E'));		
		
		$years = array_combine(range('2012', '2030'), range('2012', '2030'));
		
		$crud->field_type('acYr', 'dropdown',$years);
		$crud->field_type('dob', 'numeric');
		
		$crud->required_fields('cstName','pNo','childNo','childName','dob','sex','indx','eng','maths','eng','chem','bio','phy','grade','acYr');	
		
		$crud->unset_fields('stmp');
		
		$crud->callback_field('cstName',array($this,'field_callback_cluster'));
		$crud->callback_field('pNo',array($this,'field_callback_pNo'));	
		$crud->callback_before_insert(array($this,'insert_result_callback'));	
		
		$output = $crud->render();			
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('KCSE_results');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);	
    }

    function kcpe()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url().'exams.php','refresh');
			
        $crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('kcpe');
		
		$acYr = date('Y');
		
		if(isset($_POST['acYr'])){
			$acYr = $this->input->post('acYr');
		}
		$crud->where(array('pNo'=>$this->session->center_id,'acYr'=>$acYr));
		
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
			->display_as('dob','Date Of Birth')
			->display_as('sstd','Social Studies');	
		
		$crud->required_fields('cstName','pNo','childNo','childName','dob','sex','indx','eng','kis','sci','mat','sstd','totMrk','acYr');	
		
		$crud->callback_field('cstName',array($this,'field_callback_cluster'));
		$crud->callback_field('pNo',array($this,'field_callback_pNo'));
		
		$years = array_combine(range('2012', '2030'), range('2012', '2030'));
		
		$crud->field_type('acYr', 'dropdown',$years);
		$crud->field_type('dob', 'numeric');
		
		$crud->callback_before_insert(array($this,'insert_result_callback'));
		
		$crud->unset_fields(array('stmp'));
		//$crud->unset_edit();	
		//$crud->unset_delete();			
		
		
		$output = $crud->render();			
        $page_data['page_name']  = __FUNCTION__;
        $page_data['page_title'] = get_phrase('KCPE_results');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);		
    }	

	function insert_result_callback($post_array){
		
		$yr = range('2012', '2030');
		
		$post_array['acYr'] =  $yr[$post_array['acYr']];
		
		return $post_array;
		
	}

	function field_callback_cluster(){
		return "<INPUT type='text' maxlength='20' class='form-control' readonly='readonly' id='field-cstName' name='cstName' value='".$this->session->cluster."'>";
		
	}

	function field_callback_pNo(){
		return "<INPUT type='text' maxlength='20' class='form-control' readonly='readonly' id='field-pNo' name='pNo' value='".$this->session->center_id."'>";
		
	}
	
	function get_childNo($benNo){
		
		switch (strlen($benNo)):
			
			case '1':
				$benNo = $this->session->center_id.'-000'.$benNo;
				break;
			
			case '2':
				$benNo = $this->session->center_id.'-00'.$benNo;
				break;
				
			case '3':	
				$benNo = $this->session->center_id.'-0'.$benNo;
				break;
			
			default:
				$benNo = $this->session->center_id.'-'.$benNo;
				
		endswitch;
		
		echo json_encode($this->db->get_where('childdetails',array('childNo'=>$benNo))->row());
	}
		
}