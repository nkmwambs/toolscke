<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('isValidMd5'))
{


	function isValidMd5($md5 ='') {
		//return strlen($md5) == 32 && ctype_xdigit($md5);
  		return preg_match('/^[a-f0-9]{32}$/', $md5);
	}

}

?>