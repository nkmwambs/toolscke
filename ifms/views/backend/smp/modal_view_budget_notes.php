<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary">
						
		<div class="panel-heading">
			<div class="panel-title"><?=get_phrase('view_notes_for')." ".$this->db->get_where('plansschedule',array('scheduleID'=>$param2))->row()->details;?></div>						
		</div>
								
		<div class="panel-body" style="overflow-y: auto;">
				<div class="col-sm-12">
					<?=$this->db->get_where('plansschedule',array('scheduleID'=>$param2))->row()->notes;?>
				</div>
			
		</div>
</div>
	</div>
</div>

		