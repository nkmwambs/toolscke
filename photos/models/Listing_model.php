<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing_model extends CI_Model {

	var $table = 'files';
	var $column_order = array(null, 'file_name','group','created','modified','status'); //set column field database for datatable orderable
	var $column_search = array('file_name','group','created','modified','status'); //set column field database for datatable searchable 
	var $order = array('id' => 'id'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		/**Add custom filters**/
		if($this->input->post('status')){
			$this->db->where('status',$this->input->post('status'));
		}
		
		if($this->session->login_type==='partner'){
			$this->db->where('group',$this->session->project_id);
		}	
		
		if($this->session->login_type==='facilitator'){
			$this->db->join('projects','projects.num=files.group');	
			$this->db->where('facilitator',$this->session->login_user_id);
		}
		
		if($this->session->login_type==='sdsa'){
			$this->db->join('projects','projects.num=files.group');	
			$this->db->where('sdsa',$this->session->login_user_id);
		}
		

		/**End of custom filters**/
		 
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	
	function search_datatables($filter="")
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$this->db->where($filter);
		$query = $this->db->get();
		return $query->result();
	}	

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

}
