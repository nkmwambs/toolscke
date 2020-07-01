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


if ( ! function_exists('get_fy'))
{
	function get_fy($date = '',$project="") {
		
		$CI =& get_instance();
		
		$CI->load->database();
		
		$start_date = $CI->db->get_where('settings',array('type'=>'system_start_date'))->row()->description;
		
		if($project!==""){
			$start_date = $CI->db->select_max('closureDate')->get_where('opfundsbalheader',array('icpNo'=>$project))->row()->closureDate;			
		}
		
		$fy_start_month = date('n',strtotime($start_date));//9
		
		$range = range($fy_start_month,12);//9,10,11,12
		
		$fy = date('y',strtotime($date));//17
		
		$mark_by = $CI->db->get_where('settings',array('type'=>'mark_fy_by'))->row()->description;//upper_year
		
		//if(in_array(date('n',strtotime($date)), $range)&&date('n',strtotime($start_date))>1&&$mark_by==='upper_year'){
			$fy = number_format(date('y',strtotime($date)))+1;
		//}
		
		//if(!in_array(date('n',strtotime($date)), $range)&&date('n',strtotime($start_date))>1&&$mark_by==='lower_year'){
			//$fy = number_format(date('y',strtotime($date)))-1;
		//}  
		
		/**
		$months = range(1,12);
        $qtrs = array_chunk($months,3);
        $chk = array(3,4,1,2);
        $cb = array_combine($chk,$qtrs);
        
        foreach ($cb as $q => $m){
	        $month = date('m',strtotime($date));
	        $year = date('y',strtotime($date));
		       
			    if(in_array($month,$m)){
			        $qtr = $q;
					
			        $fy = ($qtr===1 || $qtr===2)?$year+1:$year;
			        
			        return $fy;                                               
		        }
        }
		
	**/
		return $fy; 
	}
}

if ( ! function_exists('fy_start_date'))
{
	function fy_start_date($date = '',$project="") {
				$fy = get_fy($date,$project)-1;
					
				$fy_start_date = '20'.$fy."-07-01";
			    return $fy_start_date;                                               
        	}
 }

if ( ! function_exists('fy_end_date'))
{
	function fy_end_date($date = '',$project="") {
				$fy = get_fy($date,$project);
					
				$fy_end_date = '20'.$fy."-06-30";
			    return $fy_end_date;                                               
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