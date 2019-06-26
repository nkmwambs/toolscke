<?php
//if (!defined('BASEPATH'))
  //  exit('No direct script access allowed');

/*	
 *	@author 	: Joyonto Roy
 *	date		: 27 september, 2014
 *	FPS School Management System Pro
 *	http://codecanyon.net/user/FreePhpSoftwares
 *	support@freephpsoftwares.com
 */

class Cron extends CI_Controller
{

function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('email');
		
		//if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
		
    }
	
	function mailing(){
		

		$this->email->from('nkmwambs@gmail.com', 'Nicodemus Karisa');
		$this->email->to('NKarisa@ke.ci.org');
		$this->email->cc('ckeptsu@gmail.com');
		//$this->email->bcc('them@their-example.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		$this->email->send();
	}

}
	