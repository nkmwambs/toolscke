<?php

class PoyaConfigModel extends CI_Model {
	protected $table;

	public function __construct() {
		$this -> table = 'poya_config_option';
	}

	public function get_configurations() {
		$query = $this -> db -> get($this -> table);
		return $query -> result_object();
	}

}
