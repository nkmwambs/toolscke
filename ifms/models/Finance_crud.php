<?php 

/**
 * IFMS
 *
 * @package	IFMS
 * @author	Code Cistern Team
 * @copyright	Copyright (c) 2018, compassion-africa.org
 * @link	https://compassion-africa.org
 * @since	Version 3.0.0
 * @filesource
 */
 
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * Finance_crud Class
 *
 * @package		IFMS
 * @subpackage	Models
 * @author		Code Cistern Team
 * @link		https://compassion-africa.org/developer/toolkit/models/finance_crud.html
 */

class Finance_crud extends CI_Model {
	
	/**
	 * Voucher Header Database Table Name  
	 *
	 * @var String Name of the voucher header database table
	 */
	
	protected $voucher_header_table = 'voucher_header';
	
	/**
	 * Voucher Body Database Table Name  
	 *
	 * @var String Name of the voucher body database table
	 */
	
	protected $voucher_body_table = 'voucher_body';
	
	/**
	 * Field Names Variables for Voucher Header
	 * 
	 * @var int voucher header table primary key
	 */
	
	protected $voucher_header_primary_key = 'hID';
	
	/**
	 * @var String Center ID
	 */
	
	protected $voucher_header_center_id = 'icpNo';
	
	protected $voucher_header_transaction_date = 'TDate';
	
	protected $voucher_header_fy= 'Fy';
	
	protected $voucher_header_voucher_number = 'VNumber';
	
	protected $voucher_header_payee = 'Payee';
	
	protected $voucher_header_address = 'Address';
	
	protected $Voucher_header_voucher_type = 'VType';
		
	protected $voucher_header_cheque_number = 'ChqNo';
		
	protected $voucher_header_cheque_state = 'ChqState';
	
	protected $voucher_header_cheque_month_cleared = 'clrMonth';
	
	protected $voucher_header_edit_status = 'editable';
	
	protected $voucher_header_description = 'TDescription';
	
	protected $voucher_header_totals = 'totals';
		
	protected $voucher_header_edit_request = 'reqID';
	
	protected $voucher_header_unix_stamp = 'unixStmp';
	
	protected $voucher_header_time_stamp = 'tmStmp';
	
	/**
	 * Field Names Variables for Voucher Body
	 */
	 
	protected $voucher_body_primary_key = "bID";
	
	protected $voucher_body_header_primary_key = "hID";
	
	protected $voucher_body_center_id = "icpNo";
	
	protected $voucher_body_voucher_number = "VNumber";
	
	protected $voucher_body_transaction_date = 'TDate';
	
	protected $voucher_body_qty = 'Qty';
	
	protected $voucher_body_description = 'Details';
	
	protected $voucher_body_unit_cost = 'UnitCost';
	
	protected $voucher_body_cost = 'Cost';
	
	protected $voucher_body_vote_head = 'AccNo';
	
	protected $voucher_body_civa_code = 'civaCode';
	
	protected $voucher_body_voucher_type = 'VType';
	
	protected $voucher_body_cheque_number = 'ChqNo';
	
	protected $voucher_body_unix_time = 'unixStmp';
	
	protected $voucher_body_time_stamp = 'tmStmp';
	
	
	// --------------------------------------------------------------------

	/**
	 * Constructor
	 * @return	void
	 */
    
    function __construct() {
        parent::__construct();
    }
	
	
	
	function create_voucher_header(){
		
	} 
	
	function create_voucher_body(){
		
	}

	function create_voucherfootnotes(){
		
	}
	
	/**
	 * Read Voucher Header By Center
	 *
	 * @param	string	$select_type Voucher Search Field. Can be tdate for Transaction Date or vnum for Voucher Number IDs in the $voucher_header_table
	 * @param	array	$select_type_array. Values to search for in the search fields. Can be an array of Dates or voucher ids as per the $voucher_header_table
	 * @param	int     $center_id	Center ID. Set it to 0 by default to search vouchers for all centers as per the listed $select_type_array
	 * @param	Bool	$range. If set True, takes the first and last value of the $select_type_array. Where false, no range is applied.
	 * @return	array   Returns an array of vouchers
	 */
	  
	function read_voucher_header_by_center($select_type="",$select_type_array=array(),$center_id="0",$range = false){
		
		$voucher_array = array();
		
		$header_object = "";
		
		if($select_type === "tdate"){
			if($center_id === "0"){
				if($range === false){
					/** Populate the voucher header array here **/
					
								
				}else{
					/** Populate the voucher header array here **/
					
				}	
			}else{
				if($range === false){
					
					/** Check if $select_type_array is empty **/
					$size_of_select_type_array = sizeof($select_type_array);
					
					if($size_of_select_type_array > 0){
						
						/**Check if select_type_array elements are dates **/
						
						$count_date_elements = 0;
						
						foreach($select_type_array as $dates){
							if(valid_date($dates)){
								$count_date_elements++;
							}
						}
						
						if($count_date_elements === $size_of_select_type_array){
								/** Populate the voucher header array here **/
								$header_object = $this->db->get_where($this->voucher_header_table,array($this->voucher_header_center_id=>$center_id));
								
								if($header_object->num_rows() > 0 ){
									foreach($header_object->result_object() as $header){
										$voucher_array['header'] =  $header;
										$voucher_array['body'] = $this->read_voucher_body($header->$this->voucher_header_primary_key);
									}
								}else{
									//Set Error here
								}
						}else{
							/** Set error here **/
						}
						
						
					}else{
						/** Set error message here**/
					}
					
					
					
				}else{
					/** Populate the voucher header array here **/
					
				}
			}
			
			
		}else{
			if($center_id === "0"){
				if($range === false){
					/** Populate the voucher header array here **/
					
				}else{
					/** Populate the voucher header array here **/
					
				}
			}else{
				if($range === false){
					/** Populate the voucher header array here **/
					
				}else{
					/** Populate the voucher header array here **/
					
				}
			}
		}
		
		
		
	}
	
	function read_voucher_body($header_id=""){
		$body_object = $this->db->get_where($this->voucher_body_table,array($this->voucher_body_header_primary_key=>$header_id));
		
		$body_array = array();
		
		if($body_object->num_rows() > 0 ){
			foreach($body_object->result_object() as $body){
				$body_array[] = $body;
			}
		}
		
		return $body_array;
	}
	
	function read_voucherfootnotes(){
		
	}
	
	function update_voucher_header(){
		
	}
	
	function update_voucher_body(){
		
	}
	
	function update_voucherfootnotes(){
		
	}
	
	function delete_voucher_header(){
		
	}
	
	function delete_voucher_body(){
		
	}
	
	function delete_voucherfootnotes(){
		
	}
	
	/**
	 * @return array One element of type "title"=>"title_value","message"=>"message_value","suggestions"=>"suggestions_value"
	 */
	
	function errors($error=array()){
		return error;
	}
}