<?php
 //Closed CIVs
 
 $statement = "SELECT civa.civaID as civaID, civa.accID as accID,civa.AccNoCIVA as AccNoCIVA,civa.AccTextCIVA as AccTextCIVA,civa.allocate as allocate,civa.closureDate as closureDate FROM civa LEFT JOIN accounts ON civa.accID=accounts.accID WHERE accounts.AccGrp='1' AND civa.open='0'";
 $closed_civs = $this->db->query($statement)->result_object();
 
?>

<hr />

<div class="row">
	<div class="col-sm-12">
		<a href="<?=base_url();?>ifms.php/civa/dashboard"  class="btn btn-info"><?=get_phrase('open_accounts');?></a>
		<button class="btn btn-success"><?=get_phrase('civ_reports');?></button>
		<button class="btn btn-danger"><?=get_phrase('close_overdue');?></button>
	</div>
</div>

<hr />	

<div class="row">
								<div class="col-md-12">
							    	<div class="row">
							            <!-- CALENDAR-->
							            <div class="col-md-12 col-xs-12">    
							                <div class="panel panel-danger" data-collapsed="0">
							                    <div class="panel-heading">
							                        <div class="panel-title">
							                            <i class="entypo-gauge"></i> 
							                            <?php echo get_phrase('closed_interventions');?>
							                        </div>
							                    </div>
							                    <div class="panel-body" style="padding:0px;overflow: auto;">
							                    	
							                    	<table class="table table striped datatable">
							                    		<thead>
							                    			<tr>
							                    				<th><?=get_phrase('action');?></th>
							                    				<th><?=get_phrase('intervention_code');?></th>
							                    				<th><?=get_phrase('projects_allocated');?></th>
							                    				<th><?=get_phrase('closure_date');?></th>
							                    			</tr>
							                    		</thead>
							                    		<tbody>
							                    			<?php
							                    				foreach($closed_civs as $row):
							                    			?>
							                    				<tr>
							                    					<td>
							                    						<div class="btn-group">
													                    	<button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
													                        	<?php echo get_phrase('action');?> <span class="caret"></span>
													                    	</button>
													                    		<ul class="dropdown-menu dropdown-default pull-left" role="menu">
													                      
																                    <li>
																                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_edit_intervention/<?php echo $row->civaID;?>');">
																                           	<i class="fa fa-pencil"></i>
																								<?php echo get_phrase('edit');?>
																                        </a>
																                    </li>
																							
																					<li  style="" class="divider"></li>
																					
																					<li>
																                        <a href="#" onclick="confirm_action('<?php echo base_url();?>ifms.php/civa/interventions/open/dashboard/<?php echo $row->AccNoCIVA;?>');">
																                           	<i class="fa fa-thumbs-up"></i>
																								<?php echo get_phrase('open');?>
																                        </a>
																                    </li>
																							
																					<li  style="" class="divider"></li>
																			</ul>
																		</div>			
							                    					</td>
							                    					<td><?=$row->AccNoCIVA;?></td>
							                    					<td><?=$row->allocate;?></td>
							                    					<td><?=$row->closureDate;?></td>
							                    				</tr>
							                    			<?php
							                    				endforeach;
							                    			?>
							                    		</tbody>
							                    	</table>           	
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							  </div>
							  
<script>
		$(document).ready(function(){
		var datatable = $('.table').DataTable({
			stateSave: true,
			"bSort" : false,
			lengthMenu: [[25,50, 100, 150,-1], [25,50 ,100,150 ,"All"]],
			pageLength: 25,
			dom: '<"row"l><Bf><"col-sm-12"rt><ip>',
		       //sDom:'r',
		    pagingType: "full_numbers",
		    buttons: [
		           'csv', 'excel', 'print'
		       ] 
		});
		
		
		    if (location.hash) {
			        $("a[href='" + location.hash + "']").tab("show");
			    }
			    $(document.body).on("click", "a[data-toggle]", function(event) {
			        location.hash = this.getAttribute("href");
			    });
			});
			
			$(window).on("popstate", function() {
			    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
			    $("a[href='" + anchor + "']").tab("show");
		
	});
</script>