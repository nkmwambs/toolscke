<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function get_supervisory_group_details($group_id){
		return $this->db->get_where('clusters',array('clusters_id'=>$group_id))->row();
	}
	
	    ////////BACKUP RESTORE/////////
    function create_backup($tbls=array(),$tag="all") {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if (sizeof($tbls) === 0) {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => $tbls);
            $file_name = 'backup_' . $tag."_".date('Y-m-d H:m:s');
        }

        //$backup =& $this->dbutil->backup(array_merge($options, $tables));
		$backup =& $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/database_backup/backup.sql');
        $this->load->dbutil();


        //$prefs = array(
          //  'filepath' => 'uploads/database_backup/backup.sql',
            //'delete_after_upload' => TRUE,
            //'delimiter' => ';'
        //);
        //$restore =& $this->dbutil->restore($prefs);
        
        $filepath = 'uploads/database_backup/backup.sql';
        $sql = file_get_contents($filepath);
        $sqls = explode(';', $sql);
		array_pop($sqls);
		
		foreach($sqls as $statement){
		    $statment = $statement . ";";
		    $this->db->query($statement);   
		}
		
        //unlink($prefs['filepath']);
		
		unlink($filepath);
    }
	

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type=array()) {
            foreach($type as $table){
            	$this->db->truncate($table);
            }
       
    }
	
}

