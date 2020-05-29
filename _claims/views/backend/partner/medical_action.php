<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        <?php echo $name;?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <?php 
                        	$userlevel = $this->session->userdata('logged_user_level');
                        	
							switch($userlevel):
								
								case "1":
							?>
									<!-- Submit Claim -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/partner/single_submit/<?php echo $rec;?>');">
			                            	<i class="fa fa-send"></i>
												<?php echo get_phrase('submit');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>	
						
									<!--View Comments-->
			                       	
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_view_comments/<?php echo $rec;?>');">
			                            	<i class="fa fa-eye"></i>
												<?php echo get_phrase('view_comments');?>
			                               	</a>
			                       	</li> 
			                       	
			                       	<li class="divider"></li>
						
			                       	<!--Edit-->
			                       	
			                        <li>
			                        	<a href="<?php echo base_url();?>claims.php/partner/edit_medical_claim/<?php echo $rec;?>">
			                            	<i class="fa fa-pencil-square-o"></i>
												<?php echo get_phrase('edit');?>
			                               	</a>
			                       	</li> 
			
			                       	<li class="divider"></li>						
						
									<!--Delete-->
			                       	
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/partner/delete_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-trash-o"></i>
												<?php echo get_phrase('delete_or_archive');?>
			                               	</a>
			                       	</li>     
			                       	
			                       
			                       <li class="divider"></li>						
						
									<!--Reinstate-->
                       	
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/partner/reinstate_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-reply"></i>
												<?php echo get_phrase('reinstate');?>
			                               	</a>
			                       	</li>       			
			                       	
			                       	<li class="divider"></li>			
						
							<?php
								break;
								case "2":
							?>
									<!-- Approve -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/facilitator/process_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-thumbs-o-up"></i>
												<?php echo get_phrase('process');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
						
									<!-- Decline -->
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_decline_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-times-rectangle"></i>
												<?php echo get_phrase('decline');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>

									<!--View Comments-->
			                       	
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_view_comments/<?php echo $rec;?>');">
			                            	<i class="fa fa-eye"></i>
												<?php echo get_phrase('view_comments');?>
			                               	</a>
			                       	</li> 
			                       	
			                       	<li class="divider"></li>
							
							<?php	
								break;
								case "5":		
							?>							
									<!-- Approve -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/health/process_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-thumbs-o-up"></i>
												<?php echo get_phrase('process');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
						
									<!-- Decline -->
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_decline_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-times-rectangle"></i>
												<?php echo get_phrase('decline');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
			                       	
			                       	<!--View Comments-->
			                       	
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_view_comments/<?php echo $rec;?>');">
			                            	<i class="fa fa-eye"></i>
												<?php echo get_phrase('view_comments');?>
			                               	</a>
			                       	</li> 
			                       	
			                       	<li class="divider"></li>
							<?php
								break;
								default:
							?>
							
									<!-- Submit Claim -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/partner/single_submit/<?php echo $rec;?>');">
			                            	<i class="fa fa-send"></i>
												<?php echo get_phrase('submit');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>	
						
									<!--View Comments-->
			                       	
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_view_comments/<?php echo $rec;?>');">
			                            	<i class="fa fa-eye"></i>
												<?php echo get_phrase('view_comments');?>
			                               	</a>
			                       	</li> 
			                       	
			                       	<li class="divider"></li>
						
			                       	<!--Edit-->
			                       	
			                        <li>
			                        	<a href="<?php echo base_url();?>claims.php/partner/edit_medical_claim/<?php echo $rec;?>">
			                            	<i class="fa fa-pencil-square-o"></i>
												<?php echo get_phrase('edit');?>
			                               	</a>
			                       	</li> 
			
			                       	<li class="divider"></li>						
						
									<!--Delete-->
			                       	
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/partner/delete_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-trash-o"></i>
												<?php echo get_phrase('delete');?>
			                               	</a>
			                       	</li>     
			                       	
			                       
			                       <li class="divider"></li>						
						
									<!--Reinstate-->
                       	
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/partner/reinstate_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-reply"></i>
												<?php echo get_phrase('reinstate');?>
			                               	</a>
			                       	</li>       			
			                       	
			                       	<li class="divider"></li>			

									<!-- Approve -->
			                        <li>
			                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>claims.php/health/process_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-thumbs-o-up"></i>
												<?php echo get_phrase('process');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
						
									<!-- Decline -->
			                        <li>
			                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>claims.php/modal/popup/modal_decline_claim/<?php echo $rec;?>');">
			                            	<i class="fa fa-times-rectangle"></i>
												<?php echo get_phrase('decline');?>
			                               	</a>
			                       	</li>
							
						<?php			
							endswitch;	
                        ?>
                       
                                 	
                    </ul>
                </div>