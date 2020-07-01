<?php 

	$data = array(
               3  => 'http://localhost/tools/competency.php/admin/dashboard/2006/03/',
               7  => 'http://localhost/tools/competency.php/admin/dashboard/2006/07/',
               13 => 'http://localhost/tools/competency.php/admin/dashboard/2006/13/',
               26 => 'http://localhost/tools/competency.php/admin/dashboard/2006/26/'
             );
			 
	//echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4),$data);
	
	//echo $this->config->item('system_name');
	
	//echo $this->config->site_url();
	
	//$msg = 'My secret message';
	//$key = 'super-secret-key';

	//echo $this->encrypt->encode($msg).'<br/>';
	
	//$msg2 = 'tMwvKjaSuuSId1GmHF20C7lhHqBWrqAfWUIWeEwkceFy5UDeYU9BiL+uzS8+RDVcug1BlavrwlbGg1hO6SnvdA==';
	//$key = 'super-secret-key';

	//echo $this->encrypt->decode($msg2);
	


$query = $this->db->query("SELECT * FROM users");

echo $this->table->generate($query);
	
?>
<?php //echo $this->benchmark->memory_usage();?>