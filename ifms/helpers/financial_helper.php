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


if ( ! function_exists('valid_date'))
{
 
 	function valid_date($date) {
    	return (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date));
	}
 
}
// if ( ! function_exists('get_fy'))
// {
		// function get_fy($date = '',$project="") {
// 		
		// $CI =& get_instance();
// 		
		// $CI->load->database();
// 		
		// $fy_start_month = $CI->db->get_where('settings',array('type'=>'fy_start_month'))->row()->description; 
// 		
		// $months = range(1,12);
// 		
		// $range['first'] = range($fy_start_month,12);
		// $range['second'] = range(1,$fy_start_month-1);
// 		
		// $fy = date('y',strtotime($date));
// 		
		// if(in_array(date('n',strtotime($date)), $range['first'])){
			// $fy = date('y',strtotime($date))+1;
		// }
// 
		// return $fy; 
	// }
// }

if ( ! function_exists('get_fy'))
{
	function get_fy($date) {
		
		$CI =& get_instance();
		
		$CI->load->database();
		
		$fy = "";
		
		$mark_by = $CI->db->get_where('settings',array('type'=>'mark_fy_by'))->row()->description;
		
		$fy_start_month = $CI->db->get_where('settings',array('type'=>'fy_start_month'))->row()->description;
				
		$year = date('y',strtotime($date));
		
		$month = date('m',strtotime($date));
		
		$range_to_december_from_start_of_fy = range($fy_start_month, 12);
		
		if($mark_by == 'upper_year'){
			if(in_array($month, $range_to_december_from_start_of_fy)){
				$fy = $year + 1;
			}else{
				$fy = $year;
			}
		}else{
			if(in_array($month, $range_to_december_from_start_of_fy)){
				$fy = $year;
			}else{
				$fy = $year - 1;
			}
		}
		
		return $fy; 
	}
}

if ( ! function_exists('fy_start_date'))
{
	function fy_start_date($date) {
		
		$CI =& get_instance();
		
		$CI->load->database();
		
		$fy_start_month = $CI->db->get_where('settings',array('type'=>'fy_start_month'))->row()->description;
		
		$fy_start_month = strlen($fy_start_month) == 1?"0".$fy_start_month:$fy_start_month;
		
		$fy = get_fy($date)-1;
					
		$fy_start_date = '20'.$fy."-".$fy_start_month."-01";
		
		return $fy_start_date;                                               
    }
 }

if ( ! function_exists('fy_end_date'))
{
	function fy_end_date($date) {
		$CI =& get_instance();
		
		$CI->load->database();
			
		$fy_start_month = $CI->db->get_where('settings',array('type'=>'fy_start_month'))->row()->description;
		
		$fy_end_month = $fy_start_month -1;
		
		$fy_end_month = strlen($fy_end_month) == 1?"0".$fy_end_month:$fy_end_month;
		
		$fy = get_fy($date);
					
		$fy_end_date = '20'.$fy."-".$fy_end_month."-".date('t',strtotime('20'.$fy."-".$fy_end_month."-01"));
		return $fy_end_date;                                               
    }
 }


if( ! function_exists('months_in_year')){
		function months_in_year($date, $show_year = false){
		
		$months = array();
		
		$start_month = fy_start_date($date);
		
		$month_num_range = range(0, 11);
		
		if(!$show_year){
			foreach($month_num_range as $num){
				$add_num = $num + 1;
				if($num == 0) $months['month_'.$add_num.'_amount'] 	= date('M',strtotime($start_month));
				else $months['month_'.$add_num.'_amount'] 	= date('M',strtotime('+'.$num.' month',strtotime($start_month)));		
			}		
		}else{
			foreach($month_num_range as $num){
				$add_num = $num + 1;
				if($num == 0) $months['month_'.$add_num.'_amount'] 	= date('M Y',strtotime($start_month));
				else $months['month_'.$add_num.'_amount'] 	= date('M Y',strtotime('+'.$num.' month',strtotime($start_month)));		
			}
				
		}
		
		return $months;
	}
}


if( ! function_exists('months_elapsed'))
{
	function months_elapsed($date1, $date2)
	{
		$datetime1 = date_create($date1);
		$datetime2 = date_create($date2);
		$interval = date_diff($datetime1, $datetime2);
		
		return $interval->format('%m');
	}	
}

if(! function_exists('validateDate')){
	function validateDate($date)
		{
		    $d = DateTime::createFromFormat('Y-m-d', $date);
		    return $d && $d->format('Y-m-d') === $date;
		}
}

if(! function_exists('checkIsAValidDate')){
	function checkIsAValidDate($myDateString){
    	return (bool)strtotime($myDateString);
	}
}
// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */