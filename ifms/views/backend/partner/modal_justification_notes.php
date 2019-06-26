<div class="panel panel-primary">
						
		<div class="panel-heading">
			<div class="panel-title"><?=get_phrase('budget_notes').': '.$param3;?></div>						
		</div>
								
		<div class="panel-body">
				<?=$this->db->get_where('plansschedule',array('scheduleID'=>$param2))->row()->notes;;?>
		</div>	
</div>

