<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function online_user_count(){
		return $this->db->get_where('users',array("online"=>'1'))->num_rows();
	}

}
