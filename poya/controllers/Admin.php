<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	date		: 1st July, 2019
 *	Compassion Kenya Toolkit
 * 	@package POYA
 */

class Admin extends CI_Controller {
	
	private $limesurvey_id;
	private $current_nomination_level;
	private $current_poya_survey_id;
	
	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> library('session');
		$this -> load -> model('poya_model');
		$this->load->library('grocery_CRUD');
		
		// Instantiation for limesurvey_id and nomination level
		$this->limesurvey_id = $this->poya_model->active_for_voting_limesurvey_id();
		$this->current_nomination_level = $this->poya_model->get_nomination_level();
		
		/*cache control*/
		$this -> output -> set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this -> output -> set_header('Pragma: no-cache');

	}
	
	private function count_number_of_voters_per_nomination_level($survey_id,$nomination_level){
		
		//$this->db->select('count(*) as count_of_voters');
		$this->db->select(array('fname as fcp_id','cname as cluster'));
		
		$this->db->group_by(array('voting_user_id'));
		$this->db->join('users','users.ID=poya_vote.voting_user_id');		
		
		return $this->db->get_where('poya_vote',
		array('nomination_level'=>$nomination_level,'limesurvey_id'=>$survey_id))->result_object();
	}
	

	/***ADMIN DASHBOARD***/
	function dashboard() {
		if ($this -> session -> userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		
		$page_data['limesurvey_id'] = $this->limesurvey_id;
		$page_data['votes_cast'] = $this->poya_model->cast_votes_summary_per_level($this->limesurvey_id);
		$page_data['nomination_levels'] = $this->poya_model->nomination_levels();
		$page_data['surveys'] = $this->poya_model->get_all_surveys();
		$page_data['active_poya_survey_id'] = $this->poya_model->get_active_survey()->poya_survey_id;
		$page_data['current_nomination_level'] = $this->current_nomination_level;
		$page_data['count_of_voters'] = $this->count_number_of_voters_per_nomination_level($this->limesurvey_id,$this->current_nomination_level);

		$page_data['page_name'] = 'dashboard';
		$page_data['page_title'] = get_phrase('votes_dashboard');
		$this -> load -> view('backend/index', $page_data);
	}
	
	function system_settings(){
		if ($this -> session -> userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('poya_config_option');
		
		$crud->unset_delete();
		$crud->unset_add();
		$crud->unset_columns('key');
		//$crud->unset_edit_fields(array('key'));
		
		$crud->callback_field('key',function($value){
			return "<div>".$value."</div>";
		});
		
		$output = $crud->render();			
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);
	}

	function manage_survey() {
		if ($this -> session -> userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('poya_survey');
		
		$crud->field_type('status', 'dropdown',array('0'=>'Inactive','1'=>'Active'));			
		
		$crud->required_fields(array('limesurvey_id','cluster_voting_start_date','cluster_voting_end_date',
		'regional_voting_start_date','regional_voting_end_date','national_voting_start_date',
		'national_voting_end_date','status'));
		
		$crud->unset_delete();
		
		$output = $crud->render();			
        $page_data['page_name']  = 'manage_survey';
        $page_data['page_title'] = get_phrase('manage_surveys');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);	
	}
	
	
	
	// private function poya_nomination_progress($poya_survey_id){
// 		
		// $this->db->select(array('icpNo','nomination_level','question_group_id'));
		// $this->db->join('projectsdetails','projectsdetails.ID=poya_nomination_progress.projectsdetails_id');
		// $nomination_progress = $this->db->get_where('poya_nomination_progress',
		// array('poya_survey_id'=>$poya_survey_id))->result_array();
// 		
// 		
// 		
		// $refined_progress_array = array();
// 		
		// foreach($nomination_progress as $fcp_progress_by_question_group){
			// $refined_progress_array[$fcp_progress_by_question_group['icpNo']][$fcp_progress_by_question_group['nomination_level']][] = $fcp_progress_by_question_group['question_group_id'];
		// }
// 		
// 		
		// return $refined_progress_array;
	// }
	
	// private function get_fcps_with_nomination_progress(){
		// $poya_survey_id = $this->poya_model->get_active_survey()->poya_survey_id;
		// $fcps_with_tokens =  $this->poya_model->nomination_viable_projects();
		// $fcps_with_nomination_progress_past_cluster_level = $this->poya_nomination_progress($poya_survey_id);
// 		
		// $progress_array = array();
// 		
		// foreach($fcps_with_tokens as $fcp=>$token){
			// if(array_key_exists($fcp, $fcps_with_nomination_progress_past_cluster_level)){
				// $progress_array[$fcp] = $fcps_with_nomination_progress_past_cluster_level[$fcp];
			// }else{
				// $progress_array[$fcp] = 1;
			// }
		// }
// 		
// 		
		// return $progress_array;
	// }
	
	// private function poya_nomination_progress(){
		// $projects_with_profiles = $this->poya_model->nomination_viable_projects();	
// 		
		// $fcp_question_groups_submitted = array();
// 		
		// foreach($projects_with_profiles as $fcp_id=>$token){
// 
			// $groups = $this->poya_model->survey_groups_with_questions($token);
// 			
			// foreach($groups as $group_id=>$group_fields){
				// $current_fcp_nomination_level = 1;
// 				
				// $this->db->join('projectsdetails','projectsdetails.ID=poya_nomination_progress.projectsdetails_id');
				// $poya_nomination_progress = $this->db->get_where('poya_nomination_progress',
				// array('icpNo'=>$fcp_id,'question_group_id'=>$group_id));
// 				
				// if($poya_nomination_progress->num_rows()>0){
					// $current_fcp_nomination_level = $poya_nomination_progress->row()->nomination_level;
				// }
// 				
				// $fcp_question_groups_submitted[$fcp_id][$group_id] = array('group_name'=>$group_fields['group_name'],'nomination_level'=>$current_fcp_nomination_level);
// 					
			// }
		// }
// 		
		// return $fcp_question_groups_submitted;
	// }
		
	function manage_nominations() {
		if ($this -> session -> userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		
		$active_survey = $this->poya_model->get_active_survey()->poya_survey_id;
		
		//$page_data['test'] = $this->test_poya_nomination_progress();
		$page_data['question_groups'] = $this->poya_model->reorder_json_groups_from_data_file();
		$page_data['fcp_progress'] = $this->poya_model->poya_nomination_progress($active_survey);
		$page_data['nomination_levels'] = $this->poya_model->nomination_levels();
		
		//$page_data['fcps_in_progress'] = $this->get_fcps_with_nomination_progress(); 
		$page_data['page_name'] = 'manage_nominations';
		$page_data['page_title'] = get_phrase('manage_nominations');
		$this -> load -> view('backend/index', $page_data);
	}
	
	function change_fcp_nomination_level(){
		$fcp_id = $this->input->post('fcp_id');
		$group_id = $this->input->post('group_id');
		$nomination_level = $this->input->post('nomination_level');
		$question_groups = $this->poya_model->reorder_json_groups_from_data_file();
		
		
		$data['projectsdetails_id'] = $this->db->get_where('projectsdetails',array('icpNo'=>$fcp_id))->row()->ID;
		$data['poya_survey_id'] = $this->poya_model->get_active_survey()->poya_survey_id;
		$data['question_group_id'] = $this->input->post('group_id');
		$data['question_group_name'] = $question_groups[$this->input->post('group_id')];
		
		
		$check_current_level = $this->db->get_where('poya_nomination_progress',$data);
		
		if($check_current_level->num_rows() == 0){
			$data['nomination_level'] = $nomination_level;
			$this->db->insert('poya_nomination_progress',$data);
		}elseif($nomination_level > 1){
			$poya_nomination_progress_id = $check_current_level->row()->poya_nomination_progress_id;
			
			$update_data['nomination_level'] = $nomination_level;
			
			$this->db->where(array('poya_nomination_progress_id'=>$poya_nomination_progress_id));
			
			$this->db->update('poya_nomination_progress',$update_data);	
		}else{
			$poya_nomination_progress_id = $check_current_level->row()->poya_nomination_progress_id;
			$this->db->where(array('poya_nomination_progress_id'=>$poya_nomination_progress_id));
			$this->db->delete('poya_nomination_progress');
		}
		
	}

	function manage_regions() {
		if ($this -> session -> userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('region');
		
		$crud->unset_delete();
		
		$output = $crud->render();			
        $page_data['page_name']  = 'manage_regions';
        $page_data['page_title'] = get_phrase('manage_regions');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);
	}	

	function manage_clusters() {
		if ($this -> session -> userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('clusters');
		
		$crud->set_relation('region_id', 'region', 'region_name');
		
		$crud->display_as('clusterName','Cluster')->display_as('region_id','Region');
		
		$crud->unset_delete();
		
		$output = $crud->render();			
        $page_data['page_name']  = 'manage_clusters';
        $page_data['page_title'] = get_phrase('manage_clusters');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);
	}	
	function manage_projects() {
		if ($this -> session -> userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');
		
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('projectsdetails');
		
		$crud->set_relation('cluster_id', 'clusters', 'clusterName');
		
		$crud->field_type('status', 'dropdown',array('Inactive','Active'));
		
		$crud->columns(array('icpNo','email','cluster_id','status'));
		$crud->fields(array('icpNo','email','cluster_id','status'));
		
		$crud->display_as('icpNo','FCP ID')
		->display_as('cluster_id','Cluster');
		
		$crud->unset_delete();
		
		$output = $crud->render();			
        $page_data['page_name']  = 'manage_projects';
        $page_data['page_title'] = get_phrase('manage_projects');
		$output = array_merge($page_data,(array)$output);

        $this->load->view('backend/index', $output);
	}
	
	function get_nomination_votes(){
		$limesurvey_id = $this->input->post('limesurvey_id');
		$nomination_level = $this->input->post('nomination_level');
		
		$data['count_of_voters'] = $this->count_number_of_voters_per_nomination_level($limesurvey_id,$nomination_level);
		$data['votes_cast'] = $this->poya_model->cast_votes_summary_per_level($limesurvey_id,$nomination_level);
		$data['nomination_levels'] = $this->poya_model->nomination_levels();
		$data['count_of_voters'] = $this->count_number_of_voters_per_nomination_level($limesurvey_id,$nomination_level);
				
		echo $this->load->view('backend/loaded/nomination_results',$data,true);
	}

}
