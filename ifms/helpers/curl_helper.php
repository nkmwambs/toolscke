<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('curl'))
{

	function curl($url,$fields=array()){
		// Get cURL resource
		$curl = curl_init();
		// Set some options
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_POST => 1,
			CURLOPT_CONNECTTIMEOUT => 10,
			CURLOPT_POSTFIELDS => $fields
		));
		
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
								
		if(!$resp && curl_error($curl)){
			
			if(curl_errno($curl) === 6){
				return curl_error($curl);
			}elseif(curl_errno($curl) === 28){
				return curl_error($curl);
			}else{
				return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
			}
		}else{
			return $resp;
		}
								
		//curl_close($curl);
	}
}
?>
