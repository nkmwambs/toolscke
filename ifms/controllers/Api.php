<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller
{
    private $month = '2016-06-30';
    private $table_prefix = '';

	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->load->library('finance_dashboard');
        $this->load->model('finance_model');
        $this-> load -> model('dashboard_model');
    }

    function fcps_with_risks(){
        // $dashboard_month = "2016-06-30";
        $count_of_fcps = $this->db->get_where('projectsdetails',array('status'=>1))->num_rows();
        $fcp_in_dashboard = $this->db->get_where('dashboard_header',array("month"=>$this->month))->num_rows();

        $result = $this->dashboard_model-> prod_fcps_with_risk_model($this->month,$count_of_fcps,$fcp_in_dashboard);
    
        echo json_encode($result);
    }

    function prod_fcps_with_risk_model(){

        $count_of_fcps = $this->db->get_where('projectsdetails',array('status'=>1))->num_rows();
        $fcp_in_dashboard = $this->db->get_where('dashboard_header',array("month"=>$this->month))->num_rows();
        // Check if there is a run, if so check if there is a change and only pouplate the fcps with change
		// Check if the month has a run and update the dashboard_run table
		//$run_obj = $this->db->get_where('dashboard_run',array("month"=>$this->month));

		// Check if their is a change for the month
		$month_change = $this->db->get_where('dashboard_change',array('status'=>1,'month'=>$this->month));
        
        $columned_fcps_with_change = array_column($month_change->result_array(),'projectsdetails_id');
        
		$fcp_array = array();
		$data = [];
		
		// Check if there are any active FCPs that are not in the dashboard and the dashboard for the month has already run
		if(($count_of_fcps > $fcp_in_dashboard) && $fcp_in_dashboard > 0 && $month_change->num_rows() > 0){
            $this->db->join('dashboard_change','dashboard_change.projectsdetails_id=projectsdetails.ID');
		}

		$data = $this -> db -> get_where($this -> table_prefix . 'projectsdetails',array('projectsdetails.status'=>1)) -> result_array();

		foreach ($data as $fcp) {

			$fcp_array[$fcp['ID']]['fcp_id'] = $fcp['icpNo'];
			$fcp_array[$fcp['ID']]['risk'] = $fcp['risk'];
        }

        $active_fcps_missing_in_dashboard = array_values($this->active_fcps_missing_in_dashboard());

        if(count($active_fcps_missing_in_dashboard) > 0){
            $this->db->select(array('ID','icpNo','risk'));
            $this->db->where_in('ID',$active_fcps_missing_in_dashboard);
            $fcps_missing_in_dashboard = $this -> db -> get($this -> table_prefix . 'projectsdetails') -> result_array();
            
            foreach ($fcps_missing_in_dashboard as $fcp) {

                $fcp_array[$fcp['ID']]['fcp_id'] = $fcp['icpNo'];
                $fcp_array[$fcp['ID']]['risk'] = $fcp['risk'];
            }
        }
        
        
		echo json_encode($fcp_array);
    }

    function active_fcps_missing_in_dashboard(){

        if($this->config->item('fcp_test_loops') > 0) $this->db->limit($this->config->item('fcp_test_loops'),0);

        $active_fcps = $this->db-> select('ID as projectsdetails_id') ->get_where($this -> table_prefix . 'projectsdetails',array('projectsdetails.status'=>1)) -> result_array();
        
        $dashboard_fcps = $this->db-> select('projectsdetails_id')->get_where('dashboard_header',array("month"=>$this->month))->result_array();

        $active_fcps_projectsdetails_id = array_column($active_fcps,'projectsdetails_id');
        $dashboard_fcps_projectsdetails_id = array_column($dashboard_fcps,'projectsdetails_id');

        $active_fcps_missing_in_dashboard = array_diff($active_fcps_projectsdetails_id,$dashboard_fcps_projectsdetails_id);

        //echo json_encode($active_fcps_missing_in_dashboard);
        return $active_fcps_missing_in_dashboard;
    }

    function dashboard_run(){
        $result = $this->db->get_where('dashboard_run',array("month"=>$this->month))->result_array();

        echo json_encode($result);
    }

    function dashboard_parameters(){
        $result = $this->dashboard_model-> switch_environment('', 'test_dashboard_parameters_model', 'prod_dashboard_parameters_model');
        
        echo json_encode($result);
    }

    function build_dashboard_array(){
     
        $count_of_fcps = 430;
        $fcp_in_dashboard = 15;

        $fcps_array_with_risk = $this->dashboard_model-> prod_fcps_with_risk_model($this->month,$count_of_fcps,$fcp_in_dashboard);
        
        $run_obj = $this->db->get_where('dashboard_run',array("month"=>$this->month));

        $parameters_array = $this->dashboard_model-> switch_environment('', 'test_dashboard_parameters_model', 'prod_dashboard_parameters_model');
    
        $final_grid_array['fcps_with_risks'] = array();

		$final_grid_array['parameters'] = array();

		$loops = 1;

		$new_insert_id = 0;
        $fcp_records_run = 0;
        
        $run_data = [];

        $fcp_records_run_array = [];
        
        foreach ($fcps_array_with_risk as $fcp_with_risk) {

            $projectsdetails_id = $this->dashboard_model->get_fcp_primary_key($fcp_with_risk['fcp_id']);

            if($loops == 1 && $run_obj->num_rows() == 0){
				
				$run_data['month'] = $this->month;
				$run_data['run_count'] = 1;
				$run_data['fcp_records_run'] = 1;
				$run_data['run_start_date'] = date('Y-m-d h:i:s');		
                
                $new_insert_id = 1;
            }       
            
            // Break the for loop if looping limit is set in dev_config 
			if($this-> config -> item('fcp_test_loops') > 0 && 
                $loops ==   $this -> config -> item('fcp_test_loops') ){
                break;
                exit();
            }

            // Update fcp_records_run in dashboard_run table if a new run or the run has an update
			$fcp_changes = $this->db->get_where('dashboard_change',array('month'=>$this->month,'projectsdetails_id'=>$projectsdetails_id))->num_rows();
            
            if($new_insert_id > 0 || $fcp_changes > 0 || $count_of_fcps > $fcp_in_dashboard) {
				// $this->CI->db->where(array('month'=>$dashboard_month));
                // $this->CI->db->update('dashboard_run',array('fcp_records_run'=>$fcp_records_run));
				$fcp_records_run++;
            }

            $final_grid_array['fcps_with_risks'][$fcp_with_risk['fcp_id']]['risk'] = $fcp_with_risk['risk'];

            foreach ($parameters_array as $key => $value) {

				if ($value['display_on_dashboard'] == 'yes') {

					$final_grid_array['fcps_with_risks'][$fcp_with_risk['fcp_id']]['params'][$key] = call_user_func(array($this->finance_dashboard, $value['result_method']), $fcp_with_risk['fcp_id'], $this->month);
					
				}
            }
            
            $loops++;
            
        }

        //echo json_encode($final_grid_array); 

        return $final_grid_array;
    }

    function get_fcp_primary_key($fcp_id){
		return $this->db->get_where('projectsdetails',array('icpNo'=>$fcp_id))->row()->ID;
	}  

    function insert_parameters_dashboard_table(){
        
        $grid_array = $this->build_dashboard_array();

        $loop = 1;

        $to_insert_data = [];
        $to_insert_param_data = [];
        $to_update_param_data = [];

        //$dashboard_header_ids = [];
        $fake_id = 1;

        foreach($grid_array['fcps_with_risks'] as $fcp_id => $fcp_data){
            $new_record = true;
            $dashboard_header_id = 0;
            
            $projectsdetails_id = $this->get_fcp_primary_key($fcp_id);

            // Check if the FCP in the month is available before insert. If yes, do nothing

			$fcp_dashboard_header_obj = $this->db->get_where('dashboard_header',
            array('projectsdetails_id'=>$projectsdetails_id,'month'=>$this->month));
            
            if($fcp_dashboard_header_obj->num_rows() == 0){
				// Insert if the record doesn't exist and set the dashboard_header_id to the insert_id	
				$to_insert_data[$fake_id]['projectsdetails_id'] = $projectsdetails_id;
				$to_insert_data[$fake_id]['month'] = $this->month;

				// $this->db->insert('dashboard_header',$to_insert_data);
				
				$dashboard_header_id = $fake_id;//$this->db->insert_id();
			
			}else{
				// Just get the dashboard_header_id if the fcp record for the month exists and set the 
                // new_record variable to false
                
                $dashboard_header_id = $fcp_dashboard_header_obj->row()->dashboard_header_id;
                //$dashboard_header_ids[] = $dashboard_header_id;
				$new_record = false;
            }

            $param_count = 0;
			// $to_insert_param_data = [];
            // $to_update_param_data = [];
            
			foreach($fcp_data['params'] as $param_key=>$param_value){
                

                if($new_record == true){
					$to_insert_param_data[$fake_id][$param_count]['dashboard_header_id'] = $dashboard_header_id;
					$to_insert_param_data[$fake_id][$param_count]['dashboard_parameter_id'] = $param_key;
					$to_insert_param_data[$fake_id][$param_count]['dashboard_parameter_value'] = $param_value;
				}else{
                    $param_record_obj = $this->db->get_where('dashboard_body',array('dashboard_header_id'=>$dashboard_header_id,'dashboard_parameter_id'=>$param_key));
                    
                    $to_update_param_data[$fake_id][$param_count]['dashboard_body_id'] = $param_record_obj->row()->dashboard_body_id;
                    $to_update_param_data[$fake_id][$param_count]['dashboard_header_id'] = $dashboard_header_id;
                    $to_update_param_data[$fake_id][$param_count]['dashboard_parameter_id'] = $param_key;
					$to_update_param_data[$fake_id][$param_count]['dashboard_parameter_value'] = $param_value;
                }
            }
            
            $fake_id++;
        }

        echo json_encode($to_insert_param_data);
    }

    function prod_methods(){
       $this->load->model('dashboard_model');
       $this->load->library('finance_dashboard');
       //$result  = $this->dashboard_model->prod_project_with_pc_guideline_limits_model();
       //$result  = $this->dashboard_model->prod_pc_limit_by_type_model('2018-05-31');
       
       $dashboard_month = "2018-04-30";
       $count_of_fcps = "18";
       $fcp_in_dashboard = 0;

       $result = $this->finance_dashboard->build_dashboard_array($dashboard_month,$count_of_fcps,$fcp_in_dashboard);

        echo json_encode($result);
    }

    function prod_cash_received_in_month_model(){
        $this->load->model('dashboard_model');
        $this->load->library('finance_dashboard');
        $dashboard_month = "2018-04-30";
        $result  = $this->dashboard_model->prod_cash_received_in_month_model($dashboard_month);
        echo json_encode($result);
    }

    function prod_fcps_with_risk_model_keys(){
        $dashboard_month = "2018-04-30";
        $count_of_fcps = "18";
        $fcp_in_dashboard = 0;
        $result = $this->dashboard_model->prod_fcps_numbers_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
        echo json_encode(array_keys($result));
    }

    function display_dashboard(){

        $dashboard_month = strtotime("2018-04-30");

        $result  = $this->dashboard_model->display_dashboard(date('Y-m-t',$dashboard_month));

        echo json_encode($result);
    }

    function prod_bank_statement_uploaded_model(){
        $dashboard_month = "2018-04-30";
        
        $result  = $this->dashboard_model->prod_bank_statement_uploaded_model($dashboard_month);

        echo json_encode($result);
    }

    function prod_total_for_chq_data_model(){
        $dashboard_month = "2018-04-30";
        $count_of_fcps = "18";
        $fcp_in_dashboard = 0;
        $this->dashboard_model-> prod_fcps_numbers_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
       
        $result  = $this->dashboard_model->prod_total_for_chq_data_model($dashboard_month);
        echo json_encode($result);
    }

    function calculate_pc_chqs_totals(){
        $dashboard_month = "2018-04-30";
        $count_of_fcps = "18";
        $fcp_in_dashboard = 0;
        $this->dashboard_model-> prod_fcps_numbers_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
       
        $result  = $this->dashboard_model->calculate_pc_chqs_totals('CHQ',$dashboard_month);
        echo json_encode($result);
    }

    function prod_pc_limit_by_type_model(){
        $dashboard_month = "2018-04-30";
        $count_of_fcps = "18";
        $fcp_in_dashboard = 0;
        $this->dashboard_model-> prod_fcps_numbers_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
       
        $result  = $this->dashboard_model->prod_pc_limit_by_type_model($dashboard_month);
        echo json_encode($result);
    }

    function prod_uncleared_cheques_data_model(){

        $dashboard_month = "2018-04-30";
        $count_of_fcps = "18";
        $fcp_in_dashboard = 0;
        $this->dashboard_model-> prod_fcps_numbers_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
       
        $result  = $this->dashboard_model->prod_uncleared_cheques_data_model($dashboard_month);
        echo json_encode($result);

    }

    function prod_uncleared_cash_recieved_data_model(){

        $dashboard_month = "2018-04-30";
        $count_of_fcps = "18";
        $fcp_in_dashboard = 0;
        $this->dashboard_model-> prod_fcps_numbers_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
       
        $result  = $this->dashboard_model->prod_uncleared_cash_recieved_data_model($dashboard_month);
        echo json_encode($result);

    }

    function calculate_uncleared_cash_recieved_and_chqs(){
        $dashboard_month = "2018-04-30";
        $count_of_fcps = "18";
        $fcp_in_dashboard = 0;
        $this->dashboard_model-> prod_fcps_numbers_with_risk_model($dashboard_month,$count_of_fcps,$fcp_in_dashboard);
       
        $result  = $this->dashboard_model->calculate_uncleared_cash_recieved_and_chqs('CR',$dashboard_month);
        echo json_encode($result);
    }
}    