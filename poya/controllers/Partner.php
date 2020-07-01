<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

include_once 'vendor/autoload.php';

define('LS_BASEURL', 'https://www.compassionkenya.com/surveys/index.php');
define('LS_USER', 'admin');
define('LS_PASSWORD', '@Compassion123');

/*
 *	@author 	: Nicodemus Karisa
 *	date		: 25 July, 2018
 *	Compassion International
 *	https://www.compassion-africa.org
 *	support@compassion-africa.org
 */

class Partner extends CI_Controller {

	private $sessionKey = null;
	private $rpcClient = null;

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> library('session');
		$this -> load -> model('poya_model');
		//$this -> load -> config('poya');

		/*cache control*/
		$this -> output -> set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this -> output -> set_header('Pragma: no-cache');
		
		$appConfigOptions = $this->PoyaConfigModel->get_configurations();
 	
	    if($appConfigOptions) {
	        
	        foreach($appConfigOptions as $appConfigOption)
	        {
	 
	            $this->config->set_item($appConfigOption->key,$appConfigOption->value);
	 
	        }
	 
	    }

	}
	
	private function nomination_level_condition($nomination_level){
		
		$cluster_id = $this -> session -> cluster_id;
			
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

	private function get_projects_from_db() {

		$nomination_level = $this -> poya_model->get_nomination_level();
		

		$this -> db -> select(array('icpNo', 'email'));
		$this -> db -> where(array('email<>' => "", 'status' => 1));
		
		$this->nomination_level_condition($nomination_level);

		$projects = $this -> db -> get('projectsdetails') -> result_array();

		$fcp_id_array = array_column($projects, 'icpNo');
		$email_array = array_column($projects, 'email');

		$fcp_with_email = array_combine($fcp_id_array, $email_array);

		return $fcp_with_email;
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

	private function nomination_viable_projects() {

		$nomination_level = $this -> poya_model->get_nomination_level();
		$participants = $this -> filter_participants_with_complete_responses();

		$fcp_with_email = $this -> get_projects_from_db();

		$update_participants = array();

		foreach ($participants as $token => $participant_email) {
			if (in_array($participant_email, $fcp_with_email) && !empty($this->survey_groups_with_questions($token))) {
				$update_participants[array_search($participant_email, $fcp_with_email)] = $token;
			}
		}

		return $update_participants;
	}

	private function create_write_data_file($data_files) {

		$survey_id = $this -> poya_model -> active_for_voting_limesurvey_id();

		foreach ($data_files['data'] as $file => $method) {
			if (!file_exists(APPPATH . 'data/' . $survey_id)) {
				mkdir(APPPATH . 'data/' . $survey_id);
			}

			if (!file_exists(APPPATH . 'data/' . $survey_id . '/' . $file . '.json')) {
				file_put_contents(APPPATH . "data/" . $survey_id . '/' . $file . ".json", $this -> $method($data_files['survey_id']));
			}
		}
	}

	private function reorder_json_responses_from_data_file() {

		$survey_id = $this -> poya_model -> active_for_voting_limesurvey_id();
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

	private function reorder_json_groups_from_data_file() {

		$survey_id = $this -> poya_model -> active_for_voting_limesurvey_id();
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
		$survey_id = $this -> poya_model -> active_for_voting_limesurvey_id();

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

	private function reorder_json_participants_from_data_file() {
		$survey_id = $this -> poya_model -> active_for_voting_limesurvey_id();
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

	private function get_vote_score($survey_id, $token) {

		$nomination_level = $this -> poya_model->get_nomination_level();

		$poya_vote_obj = $this -> db -> select(array('question_group_id', 'score')) -> get_where('poya_vote', 
		array('token' => $token, 'limesurvey_id' => $survey_id, 'voting_user_id' => $this -> session -> login_user_id, 'nomination_level' => $nomination_level));

		$group_by_group_id = array();

		if ($poya_vote_obj -> num_rows() > 0) {

			$poya_votes = $poya_vote_obj -> result_object();

			foreach ($poya_votes as $poya_vote) {
				$group_by_group_id[$poya_vote -> question_group_id] = $poya_vote -> score;
			}

		}

		return $group_by_group_id;
	}

	private function survey_groups_with_questions($token) {

		$grid_array = array();
		$nomination_level = $this -> poya_model->get_nomination_level();

		$survey_id = $this -> poya_model -> active_for_voting_limesurvey_id();
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

	
	function dashboard() {
		if ($this -> session -> userdata('admin_login') != 1)
			redirect(base_url(), 'refresh');

		//Set the survey_id
		$survey_id = $this -> poya_model -> active_for_voting_limesurvey_id();

		//Write data json
		$data_files['survey_id'] = $survey_id;
		$data_files['data']['responses'] = 'export_responses';
		$data_files['data']['groups'] = 'list_groups';
		$data_files['data']['questions'] = 'list_questions';
		$data_files['data']['participants'] = 'list_participants';
		$data_files['data']['files'] = 'list_participants';

		$this -> create_write_data_file($data_files);

		//Prepare page_data array for view output

		$voting_user = $this -> session -> login_user_id;
		//$nomination_level = $this->get_nomination_level();

		$page_data['votes_cast'] = $this -> get_vote_cast($voting_user, $this -> input -> post('fcp'));
		$page_data['question_groups'] = $this -> reorder_json_groups_from_data_file();
		$page_data['nomination_levels'] = $this->poya_model->nomination_levels();//array('1' => 'Cluster Level', '2' => 'Regional Level', '3' => 'National Level');
		$page_data['current_nomination_level'] = $this->poya_model->get_nomination_level();
		
		$page_data['projects'] = array_chunk($this -> nomination_viable_projects(), $this -> config -> item('projects_per_row'), true);
		$page_data['page_name'] = 'dashboard';
		$page_data['page_title'] = get_phrase('nominate');
		$this -> load -> view('backend/index', $page_data);
	}

	private function get_rpc_client() {
		// instantiate a new client
		$this -> rpcClient = new \org\jsonrpcphp\JsonRPCClient(LS_BASEURL . '/admin/remotecontrol');

		return $this -> rpcClient;
	}

	private function get_limesurvey_session() {
		$this -> get_rpc_client();

		// receive session key
		$this -> sessionKey = $this -> rpcClient -> get_session_key(LS_USER, LS_PASSWORD);

		return $this -> sessionKey;
	}

	private function rpc_client_session_instantiate() {
		header('Content-Type: text/html; charset=utf-8');

		//Instatiate rpc client
		$this -> get_rpc_client();

		//Instatiate lime session key
		$this -> get_limesurvey_session();

	}

	private function export_responses($survey_id) {

		$this -> rpc_client_session_instantiate();

		// receive surveys responses of the given survey id
		$aResult = $this -> rpcClient -> export_responses($this -> sessionKey, $survey_id, 'json', null, 'complete', 'code', 'long', null, null);

		// release the session key
		$this -> rpcClient -> release_session_key($this -> sessionKey);

		//Decode base64 string to a json object
		$answers_decoded = base64_decode($aResult);

		return $answers_decoded;
	}

	private function list_groups($survey_id) {

		$this -> rpc_client_session_instantiate();

		$aResult = $this -> rpcClient -> list_groups($this -> sessionKey, $survey_id);

		// release the session key
		$this -> rpcClient -> release_session_key($this -> sessionKey);

		return json_encode($aResult);
	}

	private function list_questions($survey_id) {

		$this -> rpc_client_session_instantiate();

		$aResult = $this -> rpcClient -> list_questions($this -> sessionKey, $survey_id);

		// release the session key
		$this -> rpcClient -> release_session_key($this -> sessionKey);

		return json_encode($aResult);

	}

	private function list_participants($survey_id) {
		$this -> rpc_client_session_instantiate();

		$aResult = $this -> rpcClient -> list_participants($this -> sessionKey, $survey_id, 0, 1000, false, false);

		// release the session key
		$this -> rpcClient -> release_session_key($this -> sessionKey);

		return json_encode($aResult);
	}

	private function get_all_response_uploaded_files($survey_id, $token) {

		$this -> rpc_client_session_instantiate();

		$aResult = $this -> rpcClient -> get_uploaded_files($this -> sessionKey, $survey_id, $token);

		// release the session key
		$this -> rpcClient -> release_session_key($this -> sessionKey);

		return json_encode($aResult);
	}

	/**Ajax call methods**/

	function post_a_score() {
		$post_data = $this -> input -> post();
		$groups = $this -> reorder_json_groups_from_data_file();

		$data['nomination_level'] = $post_data['nominationLevel'];
		$data['limesurvey_id'] = $post_data['surveyId'];
		$data['question_group_id'] = $post_data['questionGroupId'];
		$data['question_group_name'] = $groups[$post_data['questionGroupId']];
		$data['token'] = $post_data['token'];
		$data['fcp_id'] = $post_data['fcp'];
		$data['voting_user_id'] = $this -> session -> login_user_id;

		//Check if vote exists
		$this -> db -> where($data);
		$poya_votes = $this -> db -> get('poya_vote');

		$msg = "";

		if ($poya_votes -> num_rows() == 0) {
			$data['score'] = $post_data['score'];
			$this -> db -> insert('poya_vote', $data);
			$msg = "Insert";
		} else {
			$data['score'] = $post_data['score'];
			$poya_vote_id = $poya_votes -> row() -> poya_vote_id;
			$this -> db -> where(array('poya_vote_id' => $poya_vote_id));
			$this -> db -> update('poya_vote', $data);
			$msg = "Update";
		}

		// if($this->db->affected_rows()>0){
		// echo "Successful ".$msg;
		// }else{
		// echo "Failed ".$msg;
		// }
		echo $this -> retrieve_profiles($post_data['token']);
	}

	private function get_vote_cast($voting_user, $fcp_id) {

		$nomination_level = $this -> poya_model->get_nomination_level();

		$user_votes = $this -> db -> get_where('poya_vote', array('voting_user_id' => $voting_user, 'nomination_level' => $nomination_level));

		if ($user_votes -> num_rows() > 0) {
			return $user_votes -> result_object();
		} else {
			return array();
		}
	}

	function retrieve_profiles($token) {

		$survey_id = $this -> poya_model -> active_for_voting_limesurvey_id();
		$nomination_level = $this -> poya_model->get_nomination_level();
		$fcp_id = $this -> input -> post('fcp');
		$poya_nomination_progress = $this->poya_model->poya_nomination_progress();
		
		$data['poya_nomination_progress'] = $poya_nomination_progress[$fcp_id];
		$data['grid'] = $this -> survey_groups_with_questions($token);
		$data['survey_id'] = $survey_id;
		$data['nomination_level'] = $nomination_level;
		$data['token'] = $token;
		$data['fcp'] = $fcp_id;//$this -> input -> post('fcp');
		$data['question_groups'] = $this -> reorder_json_groups_from_data_file();
		$data['nomination_levels'] = $this -> poya_model -> nomination_levels();

		$voting_user = $this -> session -> login_user_id;

		$data['votes_cast'] = $this -> get_vote_cast($voting_user, $this -> input -> post('fcp'));

		echo $this -> load -> view('backend/loaded/profiles.php', $data, true);
	}

}
