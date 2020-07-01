<?php
//$tym = strtotime('last day of last month',$tym); 

$tot_icps = $this->db->get_where('users',array('userlevel'=>'1','department'=>'0','cname!='=>'Kenya'))->num_rows();

$tot_mfr = $this->finance_model->count_mfr_submitted(date('Y-m-t',$tym));

$per = ($tot_mfr/$tot_icps)*100;

$tot_validated = $this->finance_model->count_validated_mfr(date('Y-m-t',$tym));

$per_validated = ($tot_validated/$tot_mfr)*100;

?>
<div class="row">
   <div class="col-sm-6">
   		<h3>
	  		<?php
	   			echo get_phrase('financial_reports').": ".date('F Y',$tym);
	   		?>
	   	</h3>
    </div>
     	
    <div class="col-sm-6">
       <div class="btn btn-default pull-right col-sm-6"><a href="#" class="fa fa-backward scroll" id="prev"></a> <?=get_phrase('you_are_in');?> <?=date('F Y',$tym);?> <input type="text" class="form-control col-sm-1" id="cnt" placeholder="<?=get_phrase('enter_number_of_months');?>"/> <a href="#" class="fa fa-forward scroll" id="next"></a></div>
    </div>
     	
</div>

<hr />
     	
<div class="row">
     <div class="col-sm-12">
     	<div class="row">
            <div class="col-md-3">
     			<div class="tile-stats tile-red">
     				<div class="icon"><i class="fa fa-book"></i></div>
                    <div class="num" data-start="0" data-end="<?=number_format($per);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('submitted_reports');?></h3>
                   
        		</div>
        	</div>
        	
        	 <div class="col-md-3">
     			<div class="tile-stats tile-red">
     				<div class="icon"><i class="fa fa-book"></i></div>
                    <div class="num" data-start="0" data-end="<?=number_format($per_validated);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('validate_reports');?></h3>
                   
        		</div>
        	</div>
        	
        </div>
     </div>
</div>
                    	
<div class="row">
	<div class="col-md-12">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-gauge"></i> 
                            <?php echo get_phrase('dashboard');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                    	
                    	<div class="form-group" style="margin-top: 10px;">
		                    		<div class="col-sm-12">
		                    			<div style='margin-bottom:5px;' class="btn-group right-dropdown">
									<button type="button" id="" class="btn btn-blue"><?=get_phrase("field_office_report");;?></button>
										<button type="button" id="" class="btn btn-blue dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
										</button>
																	
											<ul class="dropdown-menu dropdown-blue" role="menu">
												<li  style="">
													<a href="<?=base_url();?>ifms.php/accountant/fo_fund_balance_report/<?=$tym;?>" target="__blank"><?php echo get_phrase('fund_balance_report');?></a>
												</li>
																		
												<li  style="" class="divider"></li>
												
												<li  style="">
													<a href="<?=base_url();?>ifms.php/accountant/fo_expense_report/<?=$tym;?>" target="__blank"><?php echo get_phrase('expense_report');?></a>
												</li>
																		
												<li  style="" class="divider"></li>
												
												<li  style="">
													<a href="#" onclick=""><?php echo get_phrase('financial_ratios');?></a>
												</li>
																		
												<li  style="" class="divider"></li>
												
												<li  style="">
													<a href="#" onclick=""><?php echo get_phrase('validation_report');?></a>
												</li>
																		
												<li  style="" class="divider"></li>
		                    			</ul>
		                    		</div>	
                    		</div>
                    	</div>
                    	
                    	<hr />
                    	
                    	<div class="row">
                    		<div class="col-sm-12">
                    			<table class="table table-striped">
                    				<thead>
                    					<tr>
                    						<th><?=get_phrase('cluster');?></th>
                    						<th><?=get_phrase('financial_reports');?></th>
                    						<th>% <?=get_phrase('submitted_reports');?></th>
                    					</tr>
                    				</thead>
                    				<tbody>
                    					<?php
				                    		$clusters = $this->db->order_by('cname','asc')->get_where('users',array('userlevel'=>'2',"cname!="=>'Kenya'))->result_object();
											foreach($clusters as $row):
				                    	?>
											<tr>
												<td><?=$row->cname;?></td>
										<?php
												$icps = $this->db->get_where('users',array('userlevel'=>'1','department'=>'0','cname'=>$row->cname))->result_object();
										?>		
												<td>
													<?php
														$submit_cnt = 0;
														$validate_cnt = 0;
														foreach($icps as $rw):
																													
														$mfr_submitted = $this->finance_model->mfr_submitted($rw->fname,date('Y-m-t',$tym));	
														
														$tab_color = "btn-primary";
														if($mfr_submitted==='1'){
															$tab_color = "btn-success";
															$submit_cnt++;
														}
														
														$mfr_validated = $this->finance_model->mfr_validated($rw->fname,date('Y-m-t',$tym));
														
														//$tab_border = "style='border:2px red solid;'";
														if($mfr_validated ==='0' && $mfr_submitted==='1'){
															$tab_color = "btn-danger";
															$validate_cnt++;
														}
													?>
														<!--<button style='margin-bottom:5px;' class="btn btn-primary"><?=$rw->fname;?></button>-->
														<div style='margin-bottom:5px;' class="btn-group right-dropdown">
															<button type="button" id="" class="btn <?=$tab_color;?>"><?=$rw->fname;?></button>
															<button type="button" id="" class="btn <?=$tab_color;?> dropdown-toggle" data-toggle="dropdown">
																<span class="caret"></span>
															</button>
															
															<ul class="dropdown-menu dropdown-blue" role="menu">
							
																<li  style="">
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_outstanding_cheques/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('outstanding_cheques');?></a>
																</li>
																
																<li  style="" class="divider"></li>
																
																<li style="">
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_transit_deposits/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('deposits_in_transit');?></a>
																</li>
																
																<li style="" class="divider"></li>
																
																<li  style="">
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_cleared_effects/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('cleared_effects');?></a>
																	
																</li>
																
																<li style="<" class="divider"></li>
																
																<li style="">
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_bank_reconcile/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('bank_reconciliation');?></a>
																</li>
																
																<li style="" class="divider"></li>
																
																<li>
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_variance_explanation/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('variance_explanation');?></a>
																</li>
																
																<li class="divider"></li>
																
																<li style="">
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_proof_of_cash/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('proof_of_cash');?> </a>
																	
																</li>
																
																<li style="" class="divider"></li>
																
																<li>
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_fund_balances/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('fund_balance_report');?></a>
																	
																</li>
																
																<li class="divider"></li>
																
																<li>
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_expense_report/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('expense_report');?></a>
																	
																</li>
																
																<li class="divider"></li>
																
																<li>
																	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>ifms.php/modal/popup/modal_fund_ratios/<?php echo date('Y-m-t',$tym);?>/<?=$rw->fname;?>')"><?php echo get_phrase('financial_ratios');?></a>
																	
																</li>
																
																
																
																<li class="divider"></li>
																
																<li style="">
																	<a href="<?php echo base_url();?>ifms.php/accountant/cash_journal/<?php echo $tym;?>/<?=$rw->fname;?>"><?php echo get_phrase('cash_journal');?></a>
																</li>
	                        									
	                        									<li class="divider"></li>
																
																
																<li style="">
																	<a href="<?php echo base_url();?>ifms.php/accountant/plans/<?=$tym;?>/<?=$rw->fname;?>"><?php echo get_phrase('budget');?></a>
																</li>
																
																<li class="divider"></li>
									
																	
									
															</ul>
														</div>		
													<?php
														endforeach;
													?>
												</td>
												<td><?php
													//$icp_count = $this->db->get_where('users',array('userlevel'=>'1','department'=>'0','cname'=>$row->cname))->num_rows();
													
													echo $per_cluster = $submit_cnt."/".count($icps)."(";
													
													echo number_format(($submit_cnt/count($icps))*100)."%)";
												
													?>
												</td>
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
    </div>
  </div>
    
  <div class="row">  
	<div class="col-md-12">
		<div class="row">
            <div class="col-md-3">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->get_where('ci_sessions')->num_rows();?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('logged_users');?></h3>

                </div>
                
            </div>
            
    	</div>
    </div>
	
</div>



    <script>
	$(document).ready(function(){
		var datatable = $('.table').DataTable({
			stateSave: true,
			"bSort" : false 
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
	
	$('.scroll').click(function(ev){
	
	var cnt = $('#cnt').val();
	
	if(cnt===""){
		cnt = "1";
	}
	
	var dt = '<?php echo $tym;?>';
	
	var flag = $(this).attr('id');
	
	var url = '<?php echo base_url();?>ifms.php/accountant/dashboard/'+dt+'/'+cnt+'/'+flag;
	
	$(this).attr('href',url);
});
  </script>

  
