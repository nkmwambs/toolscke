<?php
if ( ! function_exists('human_filesize'))
{
	function human_filesize($bytes, $decimals = 2) {
	    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
	    $factor = floor((strlen($bytes) - 1) / 3);
	    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .' '. @$size[$factor];
	}
}


if ( ! function_exists('file_list'))
{
	function file_list($path){
			
		$f_array = array();
		
		$dir = FCPATH.$path;
	
		// Open a directory, and read its contents
		if (is_dir($dir)){
		  if ($dh = opendir($dir)){
		    while (($file = readdir($dh)) !== false){
		    
			if($file!=="."&&$file!==".."){
				 //echo "filename:" . $file . "<br>";
				 $f_array[] = $file;
			} 
			 
			}
		    closedir($dh);
		  }
		}
		
		return $f_array;
	
	}
}


if ( ! function_exists('create_zip'))
{			
		/* creates a compressed zip file */
		function create_zip($files = array(),$destination = '',$overwrite = false) {
			//if the zip file already exists and overwrite is false, return false
			if(file_exists($destination) && !$overwrite) { return false; }
			//vars
			$valid_files = array();
			//if files were passed in...
			if(is_array($files)) {
				//cycle through each file
				foreach($files as $file) {
					//make sure the file exists
					if(file_exists($file)) {
						$valid_files[] = $file;
					}
				}
			}
			//if we have good files...
			if(count($valid_files)) {
				//create the archive
				$zip = new ZipArchive();
				if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
					return false;
				}
				//add the files
				foreach($valid_files as $file) {
					$zip->addFile($file,$file);
				}
				//debug
				//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
				
				//close the zip -- done!
				$zip->close();
				
				//check to make sure the file exists
				return file_exists($destination);
			}
			else
			{
				return false;
			}
		}
	
	
}	
?>