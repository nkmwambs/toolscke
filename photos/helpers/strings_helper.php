<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('beneficiary_id_format'))
{


	function beneficiary_id_format($file_name)
	{
				$file_name = str_replace('-', '', $file_name);
				$file_name = preg_replace("/[^a-zA-Z0-9\/_|+ .-]/", '', $file_name); 
				$len = strlen($file_name);
				
				if($len==='15'){
					$project  = substr($file_name, 0,6);
				}elseif(strpos($file_name, '0')!==2){
					$file_name = substr_replace($file_name, 0, 2,0);
					if(strlen($file_name)<11){
						$file_name = substr_replace($file_name, 0, 6,0);
					}
				}else{
					do {
					    $file_name = substr_replace($file_name, 0, 6,0);
					} while (strlen($file_name)<11);
				}


			return $file_name;
	    
	}

}

?>