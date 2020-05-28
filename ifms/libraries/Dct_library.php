<?php

class Dct_library{
    
    private $CI = null;

    function __construct(){
        
        $this->CI =& get_instance();
        
        $this->CI->load->library('zip');
    }

    function dct_documents_download($fcp_number,$tym,$vnumber){
			
            if(file_exists('uploads/dct_documents/'.$fcp_number.'/'.date('Y-m',$tym).'/'.$vnumber.'/')){
                $map = directory_map('uploads/dct_documents/'.$fcp_number.'/'.date('Y-m',$tym).'/'.$vnumber.'/', FALSE, TRUE);
                        
                    foreach($map as $row): 

                    $path = 'uploads/dct_documents/'.$fcp_number.'/'.date('Y-m',$tym).'/'.'/'.$vnumber.'/'.$row;
                
                    $data = file_get_contents($path);
            
                    $this->CI->zip->add_data($row, $data);
                endforeach;

        
        // Write the zip file to a folder on your server. Name it "my_backup.zip"
        $this->CI->zip->archive('downloads/my_backup_'.$this->session->login_user_id.'.zip');
        
        // Download the file to your desktop. Name it "my_backup.zip"
        
        $backup_file = 'downloads_'.$this->session->login_user_id.date("Y_m_d_H_i_s").'.zip'; 
        
        $this->CI->zip->download($backup_file);
        
        unlink('downloads/'.$backup_file);
            
        }
    }	
}