<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if ( ! function_exists('clone_record'))
{
	function clone_record ($table, $primary_key_field, $primary_key_val,$drop_fields = array()) 
		{
			$CI	=&	get_instance();
			$CI->load->database();
		   /* generate the select query */
		   $CI->db->where($primary_key_field, $primary_key_val); 
		   $query = $CI->db->get($table);
		  
		    foreach ($query->result() as $row){   
		       foreach($row as $key=>$val){        
		          if($key != $primary_key_field && !in_array($key, $drop_fields)){ 
		          /* $CI->db->set can be used instead of passing a data array directly to the insert or update functions */
		          $CI->db->set($key, $val);               
		          }//endif              
		       }//endforeach
		    }//endforeach
		
		    /* insert the new record into table*/
		    return $CI->db->insert($table); 
		}
}

// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */