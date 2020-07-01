<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function get_user($user_id=""){
		return $this->db->get_where("users",array("ID"=>$user_id))->row();
	}
	
	function project_per_cluster($cname=""){
		return $this->db->get_where('users',array("cname"=>$cname,"userlevel"=>"1","department"=>"0"))->result_object();
	}
}

