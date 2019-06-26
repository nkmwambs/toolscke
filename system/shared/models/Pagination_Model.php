<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_Model extends CI_Model {
function __construct() {
	parent::__construct();
}
// Count all record of table "contact_info" in database.
public function record_count($param1) {
return $this->db->count_all("files");
//return $this->db->get_where("files",array('group'=>$param1))->num_rows();
}

// Fetch data according to per_page limit.
public function fetch_data($limit, $page,$group,$status="") {
	//$offset = ($limit*$page)-$limit;
	$this->db->limit($limit,$page);
	
	//if($status!==""){
		$this->db->where(array('group'=>$group,'status'=>$status));
	//}else{
		//$this->db->where(array('group'=>$group,'status'=>'1'));
	//}
	
	$query = $this->db->get("files");
	if ($query->num_rows() > 0) {
	foreach ($query->result() as $row) {
	$data[] = $row;
	}
	
	return $data;
	}
	return false;
}

}
?>