 <?php
 // Open CIVs
 $statement = "SELECT civa.civaID as civaID, civa.accID as accID,civa.AccNoCIVA as AccNoCIVA,civa.AccTextCIVA as AccTextCIVA,civa.allocate as allocate,civa.closureDate as closureDate FROM civa LEFT JOIN accounts ON civa.accID=accounts.accID WHERE accounts.AccGrp='1' AND civa.open='1' AND civa.allocate LIKE '%".$this->session->center_id."%' ORDER BY civa.closureDate ASC";
 $open_civs = $this->db->query($statement)->result_object();
 
 //Closed CIVs
 
  $closed_civs = $this->db->get_where("civa",array('open'=>'0'))->result_object();
 
 ?>
 
							<div class="row">
							     <div class="col-sm-12">
							     	<div class="row">
							            <div class="col-md-3">
							     			<div class="tile-stats tile-red">
							     				<div class="icon"><i class="fa fa-book"></i></div>
							                    <div class="num" data-start="0" data-end="<?=$this->db->get_where("civa",array('open'=>'1'))->num_rows();?>" 
							                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
							                    
							                    <h3><?=get_phrase('open_intervention');?></h3>
							                   
							        		</div>
							        	</div>
							        	
							        	 <div class="col-md-3">
							     			<div class="tile-stats tile-red">
							     				<div class="icon"><i class="fa fa-book"></i></div>
							                    <div class="num" data-start="0" data-end="<?=$this->db->get_where("civa",array('open'=>'0'))->num_rows();;?>" 
							                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
							                    
							                    <h3><?=get_phrase('overdue_interventions');?></h3>
							                   
							        		</div>
							        	</div>
							        	
							        </div>
							     </div>
							</div> 

<hr />

<div class="row">
	<div class="col-sm-12">
		<!--<button onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_new_intervention/<?=$page_name?>');" class="btn btn-primary"><?=get_phrase('new_account');?></button>-->
		<a href="<?=base_url();?>ifms.php/partner/closed_interventions"  class="btn btn-info"><?=get_phrase('closed_accounts');?></a>
		<a href="<?=base_url();?>ifms.php/partner/civ_report" class="btn btn-success"><?=get_phrase('civ_report');?></a>
		<button class="btn btn-danger"><?=get_phrase('close_overdue');?></button>
	</div>
</div>

<hr />	

<div class="row">
								<div class="col-md-12">
							    	<div class="row">
							            <!-- CALENDAR-->
							            <div class="col-md-12 col-xs-12">    
							                <div class="panel panel-primary " data-collapsed="0">
							                    <div class="panel-heading">
							                        <div class="panel-title">
							                            <i class="entypo-gauge"></i> 
							                            <?php echo get_phrase('open_interventions');?>
							                        </div>
							                    </div>
							                    <div class="panel-body" style="padding:0px;overflow: auto;">
							                    	
							                    	<table class="table table striped datatable">
							                    		<thead>
							                    			<tr>
							                    				
							                    				<th class="col-sm-1"><?=get_phrase('intervention_code');?></th>
							                    				<th class="col-sm-8"><?=get_phrase('projects_allocated');?></th>
							                    				<th class="col-sm-2"><?=get_phrase('closure_date');?></th>
							                    			</tr>
							                    		</thead>
							                    		<tbody>
							                    			<?php
							                    				foreach($open_civs as $row):
							                    				
																$color = "btn-default";
																
																if(strtotime($row->closureDate)<strtotime(date('Y-m-d'))){  
																	$color = "btn-danger";
																}
							                    			?>
							                    				<tr>
							                    					
							                    					<td class="col-sm-1"><?=$row->AccNoCIVA;?></td>
							                    					<td class="col-sm-8"><?=$row->allocate;?></td>
							                    					<td class="col-sm-2"><?=$row->closureDate;?></td>
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
 


    <script>
	$(document).ready(function(){
		var datatable = $('.table').DataTable({
			stateSave: true,
			"bSort" : false ,
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

  
