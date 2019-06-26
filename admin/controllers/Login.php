<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Joyonto Roy
 * 	30th July, 2014
 * 	Creative Item
 * 	www.freephpsoftwares.com
 * 	http://codecanyon.net/user/joyontaroy
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
		$this->load->library('GoogleAuthenticator');
		$this->load->model('user');
		//$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
				
        /* cache control */
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		//$this->db->cache_on();
		//$this->output->cache(60);
		$this->db->cache_delete_all();
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin.php/'.$this->session->login_type.'/dashboard', 'refresh');
		
		
		
		include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
		include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
		
		// Google Project API Credentials
		$clientId = '1073833704230-clfvc3d133a3osqfdck73out6ua1ap7d.apps.googleusercontent.com';
        $clientSecret = '83-EyPukIshDLdn8DclS2GGx';
        $redirectUrl = base_url();
		
		// Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName('Compassion Kenya Toolkit');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if (isset($_REQUEST['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrl);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }

        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            // Preparing data for database insertion
			$userData['oauth_provider'] = 'google';
			$userData['oauth_uid'] = $userProfile['id'];
            $userData['userfirstname'] = $userProfile['given_name'];
            $userData['userlastname'] = $userProfile['family_name'];
            $userData['email'] = $userProfile['email'];
			//$userData['gender'] = $userProfile['gender'];
			$userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = $userProfile['link'];
            $userData['picture_url'] = $userProfile['picture'];
			// Insert or update user data
			$this->session->set_userdata('picture_url',$userProfile['picture']);
			$this->session->set_userdata('userfirstname',$userProfile['given_name']);
            $userArr = $this->user->checkUser($userData);
			
			$this->validate_google($userArr);
	
	    } else {
            $userData['authUrl'] = $gClient->createAuthUrl();
        }

        $this->load->view('backend/login',$userData);
    }

	//Validate with Google Details
	public function validate_google($prevQuery){
		if(is_object($prevQuery)){
				$credential = array('email' => $prevQuery->email,"auth"=>'1');
				
		        $query = $this->db->get_where('users', $credential);
				
				$mode = $this->db->get_where('settings' , array('type'=>'mode'))->row()->description;
							
		         if (($query->num_rows() > 0 && $mode=="active") || ($query->num_rows() > 0 && $mode=="inactive" && $query->row()->super_admin==1)) {
									
				            $row = $query->row();
				            $this->session->set_userdata('admin_login', 1);
				            $this->session->set_userdata('admin_id', $row->ID);
				            $this->session->set_userdata('login_user_id', $row->ID);
							$this->session->set_userdata('username', $row->username);
				            $this->session->set_userdata('name', $row->userfirstname);
							$this->session->set_userdata('logged_user_level', $row->userlevel);
							$login_type = 'admin';
							if($this->db->get_where('positions',array("pstID"=>$row->userlevel))->row()->short_name!==""){
								$login_type = $this->db->get_where('positions',array("pstID"=>$row->userlevel))->row()->short_name;
							}  
							
							$this->session->set_userdata("super_admin",$row->super_admin);
							
							$this->session->set_userdata('can_switch', $row->admin);
							
				            $this->session->set_userdata('login_type', $login_type);
							$this->session->set_userdata('primary_user_id', $row->ID);  
							
							$this->session->set_userdata('center_id', $row->fname);
		
							$this->session->set_userdata('cluster', $row->cname);
							
							$data['logs_after_register'] = $this->db->get_where('users',array('email' => $row->email))->num_rows()+1;
							
							$this->db->update('users',$data,array('email' => $row->email));
							
							redirect(base_url() . 'admin.php/'.$this->session->login_type.'/dashboard', 'refresh');		
							
					}
		        }//else{
		        	//redirect(base_url() . 'admin.php/login', 'refresh');
		        //}

	}

    //Ajax login function 
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = '';
        }

        //Replying ajax request with validation response
        
        echo json_encode($response);
    }

    //Validating login from ajax request
    function validate_login($email = '', $password = '') {
        //$credential = array('email' => $email, 'password' => $password,"auth"=>'1');


        // Checking login credential for admin
        //$query = $this->db->get_where('users', $credential);
        
        $password = md5($password);
		
		$credential = array('email' => $email, 'password' => $password,"auth"=>'1');
		
		$mode = $this->db->get_where('settings' , array('type'=>'mode'))->row()->description;
		
        $query = $this->db->get_where('users', $credential);
		
        if (($query->num_rows() > 0 && $mode=="active") || ($query->num_rows() > 0 && $mode=="inactive" && $query->row()->super_admin==1)) {
		            $row = $query->row();
		            $this->session->set_userdata('admin_login', 1);
		            $this->session->set_userdata('admin_id', $row->ID);
		            $this->session->set_userdata('login_user_id', $row->ID);
					$this->session->set_userdata('username', $row->username);
		            $this->session->set_userdata('name', $row->userfirstname);
					$this->session->set_userdata('logged_user_level', $row->userlevel);
					$login_type = 'admin';
					if($this->db->get_where('positions',array("pstID"=>$row->userlevel))->row()->short_name!==""){
						$login_type = $this->db->get_where('positions',array("pstID"=>$row->userlevel))->row()->short_name;
					}  
					
					$this->session->set_userdata("super_admin",$row->super_admin);
					
					$this->session->set_userdata('can_switch', $row->admin);
					
		            $this->session->set_userdata('login_type', $login_type);
					$this->session->set_userdata('primary_user_id', $row->ID); 
					
					$this->session->set_userdata('center_id', $row->fname);

					$this->session->set_userdata('cluster', $row->cname);
					
					/**Set Online On and last login time and login count**/
					$data['online'] = '1';
					$data['logs_after_register'] = $row->logs_after_register + 1;
					$data['last_login_time']	 = date("Y-m-d H:i:s");	
					
					$this->db->where(array("ID"=>$row->ID));
					
					$this->db->update("users",$data);
					
            return 'success';
        }

       

        return 'invalid';
    }

		/** Validate Token **/
	
	function validate_token(){
			// get the user's phone code and the secret code that was generated, and verify
			$checkResult = $this->googleauthenticator->verifyCode($this->input->post('secret'), $this->input->post('token'), 2); // 2 = 2*30sec clock tolerance
			
			if ($checkResult) {
				$this->session->set_userdata('token','1');
	            
			} else {
			    $this->session->set_userdata('token','0');
			}
			
			echo $this->session->token;
	}
	
	function verify_token(){
			$secret = $this->db->get_where('users',array('username'=>$this->session->username))->row()->secret_code;
			
			// get the user's phone code and the secret code that was generated, and verify
			$checkResult = $this->googleauthenticator->verifyCode($secret, $this->input->post('token'), 2); // 2 = 2*30sec clock tolerance
			
			if ($checkResult) {
				$this->session->set_userdata('token','1');
				//$this->session->set_flashdata('flash_message' ,'Token accepted successfully');
	            
			} else {
			    $this->session->set_userdata('token','0');
			}
			
			echo $this->session->token;		
	}

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        //$reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('users' , array('email' => $email));
        
        if ($query->num_rows() > 0) 
        {
            //$reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('users' , array('password' => md5($new_password)));
            $resp['status']         = 'true';
        }
       
		$account_type = $this->db->get_where('positions',array("pstID"=>$query->row()->userlevel))->row()->dsgn;
        // send new password to user email  
        $this->email_model->password_reset_email($new_password, $account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
		
		/**Set Online On and last login time and login count**/
		$data['online'] = '0';
					
		$this->db->where(array("ID"=>$this->session->login_user_id));
				
		$this->db->update("users",$data);
					
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'admin.php', 'refresh');
    }


}
