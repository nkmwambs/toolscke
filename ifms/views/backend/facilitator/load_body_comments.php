<?php
	$comments = $this->db->get_where("detail",array('recid'=>$scheduleID,"app_name"=>$this->session->app_name))->result_object();
											
		foreach($comments as $rows):
?>
	<tr>
		<td>
			<?php
				echo $this->db->get_where("users",array('ID'=>$rows->userid))->row()->username;
			?>
		</td>
		<td>
<?php
	echo $rows->rson;
?>
		</td>
		<td>
			<?php
				echo $rows->stamp;
			?>
		</td>
	</tr>
<?php
	endforeach;
?>