<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
	function __construct() {
		$this->tableName = 'users';
		$this->primaryKey = 'ID';
	}
	public function checkUser($data = array()){
		$userArr = array();
		$this->db->select($this->primaryKey);
		$this->db->from($this->tableName);
		$this->db->where(array('userfirstname'=>$data['userfirstname'],'email'=>$data['email']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
		
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['ID']));
			$userArr = $this->db->get_where('users',array('userfirstname'=>$data['userfirstname'],'email'=>$data['email']))->row();		
			
		}
		
		return $userArr;
    }
}
