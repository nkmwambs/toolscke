         <?php
         $freq = array('1'=>'Weekly','2'=>'Monthly','3'=>'Quarterly','4'=>'Annually');
		 
			//$diff =  date_difference(date('Y-m-d'),$date);
         ?>        
             
	                 
	                 <div class="row">
						<div class="col-md-12">
					    
					    	<!------CONTROL TABS START------>
							<ul class="nav nav-tabs bordered">
					
								<li class="active">
					            	<a href="#due" data-toggle="tab"><i class="fa fa-calendar"></i> 
										<?php echo get_phrase('due');?> <span class="badge badge-orange badge-roundless"><?=count($benchmarks);?></span>
					                    	</a>
					            </li>
								
								<li class="">
					            	<a href="#high" data-toggle="tab"><i class="fa fa-check"></i> 
										<?php echo get_phrase('high');?> <span class="badge badge-green badge-roundless"><?=count($high);?></span>
					                    	</a>
					            </li>
					                        
					    	
					            <li class="">
					            	<a href="#low" data-toggle="tab"><i class="fa fa-low-vision"></i> 
										<?php echo get_phrase('low');?> <span class="badge badge-red badge-roundless"><?=count($low);?></span>
					                    	</a>
					            </li>        	            
					 
							</ul>
					    	<!------CONTROL TABS END------>
					        
						
							<div class="tab-content">
								
								<div class="tab-pane box active" id="due" style="padding: 5px">
					                <div class="box-content">
										<table class="table table-striped">
											<thead>
												<tr>
													<th><?=get_phrase('benchmark');?></th>
													<th><?=get_phrase('reports_available');?></th>
													<th><?=get_phrase('frequency');?></th>
													<th><?=get_phrase('next_assessment_date');?></th>
													<th><?=get_phrase('action');?></th>
												</tr>
											</thead>
											<tbody>
												<?php
													
													
													foreach($benchmarks as $row):
														
														
												?>
													<tr>
														<td><?=$row->name;?></td>
														<td>
															<?php
																echo $this->db->get_where('report',array('benchmark_id'=>$row->benchmark_id))->num_rows();
															?>
														</td>
														<td><?=$freq[$row->frequency];?></td>
														<td>
															<?php
																$next = '0000-00-00';															
																
																if(!empty($this->db->get_where('next_assessment',array('benchmark_id'=>$row->benchmark_id,'users_id'=>$this->session->login_user_id))->row())){
																	$next =  $this->db->get_where('next_assessment',array('benchmark_id'=>$row->benchmark_id,'users_id'=>$this->session->login_user_id))->row()->next_assessment_date;
																}
																
																echo $next;
																
																$color ="";
															
																if(date_difference($date,$next) >= 7 && $next !=='0000-00-00'){
																	$color = "background-color:red;";
																}
																
																//$disabled = "";
																
																if(strtotime(date('Y-m-d')) > strtotime($next) && $next !=='0000-00-00'){
																	$disabled = "";	
																}
															
															?>
														</td>
														<td>
															<div class="btn-group">
													                    	<button id="" style="<?=$color;?>" type="button" class="btn btn-primary btn-sm dropdown-toggle <?=$disabled?>" data-toggle="dropdown">
													                        	<?php echo get_phrase('action');?> <span class="caret"></span>
													                    	</button>
													                    		<ul class="dropdown-menu dropdown-default pull-left" role="menu">
													                      			<?php
													                      			if(date_difference($date,$next) < 7 || $next==='0000-00-00'){
													                      			?>
																                    <li>
																                        <a href="<?php echo base_url();?>competency.php/facilitator/view_reports/<?php echo $row->benchmark_id;?>/<?=strtotime($date);?>">
																                           	<i class="fa fa-list"></i>
																								<?php echo get_phrase('assess');?>
																                        </a>
																                    </li>
																							
																					<li  style="" class="divider"></li>
																					<?php
																					}else{
													                      			?>
																					<li>
																                        <a href="#" onclick="confirm_action('<?php echo base_url();?>competency.php/facilitator/send_a_request/<?php echo $row->benchmark_id;?>/<?=strtotime($date);?>');">
																                           	<i class="fa fa-reply"></i>
																								<?php echo get_phrase('send_a_request');?>
																                        </a>
																                    </li>
																							
																					<li  style="" class="divider"></li>
																					<?php
																					}
													                      			?>
																			</ul>
																		</div>
														</td>
													</tr>
												
												<?php
													endforeach;
												?>
											</tbody>
										</table>
					                </div>
								</div>
								
							
								
								<div class="tab-pane box" id="high" style="padding: 5px">
					                <div class="box-content padded">
										
										<table class="table table-striped">
											<thead>
												<tr>
													<th><?=get_phrase('benchmark');?></th>
													<th><?=get_phrase('reports_available');?></th>
													<th><?=get_phrase('frequency');?></th>
													<th><?=get_phrase('assessment_date');?></th>
													<th><?=get_phrase('next_assessment_date');?></th>
													<th><?=get_phrase('action');?></th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach($high as $rst):
												?>
													<tr>
														<td><?=$rst->name;?></td>
														<td>
															<?php
																echo $this->db->get_where('report',array('benchmark_id'=>$rst->benchmark_id))->num_rows();
															?>
														</td>
														<td><?=$freq[$rst->frequency];?></td>
														<td><?=$rst->period;?></td>
														<td><?=$rst->next_assessment_date;?></td>
														<td>&nbsp;</td>
													</tr>
												<?php
												endforeach;
												?>
											</tbody>
										</table>
												
					                </div>
								</div>
					            
					           
					            <div class="tab-pane box" id="low" style="padding: 5px">
									<div class="box-content padded">
										
										<table class="table table-striped">
											<thead>
												<tr>
													<th><?=get_phrase('benchmark');?></th>
													<th><?=get_phrase('reports_available');?></th>
													<th><?=get_phrase('frequency');?></th>
													<th><?=get_phrase('assessment_date');?></th>
													<th><?=get_phrase('next_assessment_date');?></th>
													<th><?=get_phrase('action');?></th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach($low as $rst):
												?>
													<tr>
														<td><?=$rst->name;?></td>
														<td>
															<?php
																echo $this->db->get_where('report',array('benchmark_id'=>$rst->benchmark_id))->num_rows();
															?>
														</td>
														<td><?=$freq[$rst->frequency];?></td>
														<td><?=$rst->period;?></td>
														<td><?=$rst->next_assessment_date;?></td>
														<td>&nbsp;</td>
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
		var datatable = $('.table').DataTable();
		
		
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
	              	