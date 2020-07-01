<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poya_model extends  CI_Model{
	
	function __construct()
    {
        parent::__construct();
    }
	
	/**
	 * 
	 */
	function nomination_viable_projects() {

		$nomination_level = $this ->get_nomination_level();
		$participants = $this -> filter_participants_with_complete_responses();

		$fcp_with_email = $this -> get_projects_from_db();

		$update_participants = array();

		foreach ($participants as $token => $participant_email) {
			if (in_array($participant_email, $fcp_with_email)) {
				$update_participants[array_search($participant_email, $fcp_with_email)] = $token;
			}
		}
		
		return $update_participants;
	}

public function survey_groups_with_questions($token) {

		$grid_array = array();
		$nomination_level = $this->get_nomination_level();

		$survey_id = $this -> active_for_voting_limesurvey_id();
		$votes = $this -> get_vote_score($survey_id, $token);

		$groups = $this -> reorder_json_groups_from_data_file();
		$questions = $this -> reorder_json_questions_from_data_file();
		$responses = $this -> reorder_json_responses_from_data_file();
		
		foreach ($groups as $group_key => $group_name) {
			foreach ($questions[$group_key] as $question) {
				if (($responses[$token][$question['title']] !== "" && $question['type'] !== "U") || (strlen($responses[$token][$question['title']]) > $this -> config -> item('long_text_size') && $question['type'] == "U")) {
					$grid_array[$group_key]['group_name'] = $group_name;

					if ($question['type'] == "|") {
						$uploads = array();
						$response = json_decode($responses[$token][$question['title']]);
						
						if($response){
							foreach ($response as $file_key => $uploaded_file) {
								$grid_array[$group_key]['questions'][$question['title']]['response'][urldecode($uploaded_file -> name)] = "https://www.compassionkenya.com/hardlinks/surveys/" . $survey_id . "/files/" . $uploaded_file -> filename;
							}
						}
						
						

					} else {
						$grid_array[$group_key]['questions'][$question['title']]['response'] = $responses[$token][$question['title']];
					}

					$grid_array[$group_key]['questions'][$question['title']]['question_text'] = $question['question'];
					$grid_array[$group_key]['questions'][$question['title']]['question_type'] = $question['type'];
					$grid_array[$group_key]['questions'][$question['title']]['question_id'] = $question['qid'];
					$grid_array[$group_key]['score'] = isset($votes[$group_key]) ? $votes[$group_key] : 0;
				} else {
					break;
					unset($grid_array[$group_key]);
				}

			}
		}

		return $grid_array;
	}


public function poya_nomination_progress(){
		$projects_with_profiles = $this->poya_model->nomination_viable_projects();	
		
		$fcp_question_groups_submitted = array();
		
		foreach($projects_with_profiles as $fcp_id=>$token){

			$groups = $this->poya_model->survey_groups_with_questions($token);
			
			foreach($groups as $group_id=>$group_fields){
				$current_fcp_nomination_level = 1;
				
				$this->db->join('projectsdetails','projectsdetails.ID=poya_nomination_progress.projectsdetails_id');
				$poya_nomination_progress = $this->db->get_where('poya_nomination_progress',
				array('icpNo'=>$fcp_id,'question_group_id'=>$group_id));
				
				if($poya_nomination_progress->num_rows()>0){
					$current_fcp_nomination_level = $poya_nomination_progress->row()->nomination_level;
				}
				
				$fcp_question_groups_submitted[$fcp_id][$group_id] = array('group_name'=>$group_fields['group_name'],'nomination_level'=>$current_fcp_nomination_level);
					
			}
		}
		
		return $fcp_question_groups_submitted;
	}	
	
public function reorder_json_groups_from_data_file() {

		$survey_id = $this  -> active_for_voting_limesurvey_id();
		$groups_array = array();

		if (file_exists(APPPATH . 'data/' . $survey_id . '/groups.json') && filesize(APPPATH . 'data/' . $survey_id . '/groups.json') > 0) {

			$groups = file_get_contents(APPPATH . 'data/' . $survey_id . '/groups.json');
			$groups = json_decode($groups);

			foreach ($groups as $group) {
				$groups_array[$group -> gid] = $group -> group_name;
			}
		}

		return $groups_array;
	}

	private function reorder_json_questions_from_data_file() {
		$questions_array = array();
		$survey_id = $this ->active_for_voting_limesurvey_id();

		if (file_exists(APPPATH . 'data/' . $survey_id . '/questions.json') && filesize(APPPATH . 'data/' . $survey_id . '/questions.json') > 0) {

			$questions = file_get_contents(APPPATH . 'data/' . $survey_id . '/questions.json');
			$questions = json_decode($questions);

			foreach ($questions as $question) {
				$questions_array[$question -> gid][$question -> qid]['title'] = $question -> title;
				$questions_array[$question -> gid][$question -> qid]['question'] = $question -> question;
				$questions_array[$question -> gid][$question -> qid]['type'] = $question -> type;
				$questions_array[$question -> gid][$question -> qid]['qid'] = $question -> qid;
			}
		}

		return $questions_array;
	}
private function get_vote_score($survey_id, $token) {

		$nomination_level = $this -> get_nomination_level();

		$poya_vote_obj = $this -> db -> select(array('question_group_id', 'score')) -> get_where('poya_vote', array('token' => $token, 'limesurvey_id' => $survey_id, 'voting_user_id' => $this -> session -> login_user_id, 'nomination_level' => $nomination_level));

		$group_by_group_id = array();

		if ($poya_vote_obj -> num_rows() > 0) {

			$poya_votes = $poya_vote_obj -> result_object();

			foreach ($poya_votes as $poya_vote) {
				$group_by_group_id[$poya_vote -> question_group_id] = $poya_vote -> score;
			}

		}

		return $group_by_group_id;
	}

private function get_projects_from_db() {

		$nomination_level = $this->get_nomination_level();
		

		$this -> db -> select(array('icpNo', 'email'));
		$this -> db -> where(array('email<>' => "", 'status' => 1));
		
		if($this->session->logged_user_level == 1){
			$cluster_id = $this -> session -> cluster_id;
			$this->nomination_level_condition($nomination_level);
		}
		

		$projects = $this -> db -> get('projectsdetails') -> result_array();

		$fcp_id_array = array_column($projects, 'icpNo');
		$email_array = array_column($projects, 'email');

		$fcp_with_email = array_combine($fcp_id_array, $email_array);

		return $fcp_with_email;
	}
private function nomination_level_condition($nomination_level){
		
		$cluster_id = $this->session->cluster_id;
		
		if ($nomination_level == 2) {
			
			$this -> db -> join('clusters', 'clusters.clusters_id=projectsdetails.cluster_id');
			$this -> db -> join('region', 'region.region_id=clusters.region_id');
			$this -> db -> join('poya_nomination_progress', 'poya_nomination_progress.projectsdetails_id=projectsdetails.ID');
			
			$this -> db -> where(array('poya_nomination_progress.nomination_level' => 2, 
			'projectsdetails.cluster_id<>' => $this -> session -> cluster_id,
			'clusters.region_id'=>$this->session->region_id));
		
		} elseif ($nomination_level == 3) {
			$this -> db -> join('poya_nomination_progress', 'poya_nomination_progress.projectsdetails_id=projectsdetails.ID');
			$this -> db -> where(array('nomination_level' => 3));
		} else {
			$this -> db -> where(array('cluster_id' => $cluster_id));
			$this -> db -> where(array('icpNo<>' => $this -> session -> center_id));
		}
	}	
	private function filter_participants_with_complete_responses() {
		$participants_in_survey = $this -> reorder_json_participants_from_data_file();

		$tokens_with_responses = array_keys($this -> reorder_json_responses_from_data_file());

		$filtered_list = array();

		foreach ($tokens_with_responses as $token) {
			$filtered_list[$token] = $participants_in_survey[$token];
		}

		return $filtered_list;
	}
	
	private function reorder_json_participants_from_data_file() {
		$survey_id = $this -> active_for_voting_limesurvey_id();
		$participants_array = array();

		if (file_exists(APPPATH . 'data/' . $survey_id . '/participants.json') && filesize(APPPATH . 'data/' . $survey_id . '/participants.json') > 0) {

			$participants = file_get_contents(APPPATH . 'data/' . $survey_id . '/participants.json');
			$participants = json_decode($participants);

			foreach ($participants as $participant) {
				$participants_array[$participant -> token] = $participant -> participant_info -> email;
			}
		}

		return $participants_array;
	}
	
	private function reorder_json_responses_from_data_file() {

		$survey_id = $this  -> active_for_voting_limesurvey_id();
		$responses_array = array();

		if (file_exists(APPPATH . 'data/' . $survey_id . '/responses.json') && filesize(APPPATH . 'data/' . $survey_id . '/responses.json') > 0) {
			$responses = file_get_contents(APPPATH . 'data/' . $survey_id . '/responses.json');
			$responses = json_decode($responses);

			$response_object = $responses -> responses;

			$counter = 0;
			foreach ($response_object as $response) {
				foreach ($response as $response_data) {
					$responses_array[$response_data -> token] = (array)$response_data;
				}
				$counter++;
			}
		}

		return $responses_array;
	}

	/**
	 * 
	 */
	function active_for_voting_limesurvey_id(){
		$survey_id = 0;
		
		$surveys = $this->db->get_where('poya_survey',array('status'=>1));
		
		if($surveys->num_rows()>0){
			$survey_id = $surveys->row()->limesurvey_id;
		}
		
		return $survey_id;
	}
	
	function get_active_survey(){
		$survey = array();
		
		$surveys = $this->db->get_where('poya_survey',array('status'=>1));
		
		if($surveys->num_rows()>0){
			$survey = $surveys->row();
		}
		
		return $survey;
	}
	
	function nomination_levels(){
		return array('1'=>'Cluster Level','2'=>'Regional Level','3'=>'National Level');
	}
	
	function get_all_surveys(){
		return $this->db->get('poya_survey')->result_object();	
	}
	
	function cast_votes_summary_per_level($survey_id, $nom_level= ""){
		
		$nomination_level = ($nom_level == "")?$this->poya_model->get_nomination_level():$nom_level;
		
		$this->db->select(array('limesurvey_id','nomination_level','fcp_id','question_group_name','score','lastmodifieddate'));
		
		$votes_obj = $this->db->get_where('poya_vote',
		array('nomination_level'=>$nomination_level,'limesurvey_id'=>$survey_id));
		
		$voters = array();
		
		if($votes_obj->num_rows()>0){
			$voters = $votes_obj->result_object();
		}
		
		return $voters;
	}
	
	function get_nomination_level() {
		$active_survey = (array)$this -> poya_model -> get_active_survey();

		extract($active_survey);

		$current_date = date('Y-m-d');

		$nomination_level = 0;

		if (strtotime($current_date) < strtotime($cluster_voting_start_date) && $cluster_voting_start_date == "0000-00-00") {
			//Voting has not begun

		} elseif (strtotime($current_date) >= strtotime($cluster_voting_start_date) && strtotime($current_date) < strtotime($cluster_voting_end_date)) {
			//We are cluster nomination level
			$nomination_level = 1;

		} elseif (strtotime($current_date) >= strtotime($regional_voting_start_date) && strtotime($current_date) < strtotime($regional_voting_end_date)) {
			//We are regional voting
			$nomination_level = 2;

		} elseif (strtotime($current_date) >= strtotime($national_voting_start_date) && strtotime($current_date) < strtotime($national_voting_end_date)) {
			//We are national voting
			$nomination_level = 3;

		} else {
			//Survey is closed
		}

		return $nomination_level;
	}
}
