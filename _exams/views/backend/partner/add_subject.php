<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-code"></i>
                            <?php echo get_phrase($page_title);?>
                        </div>
                    </div>
                    <div class="panel-body">
						
						<div class="row">
							<div class="col-xs-6">
								<?php echo $build_form;?>
							</div>
							<div class="col-xs-6">
								<table class="table table-striped datatable">
									<thead>
										<tr>
											<th><?=get_phrase('action')?></th>
											<th><?=get_phrase('subject');?></=?></th>
											<th><?=get_phrase('status');?></=?></th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($subjects as $subject){
										?>
											<tr>
												<td>
													<div class="btn-group">
													<button id="" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
														<?php echo get_phrase('action');?> <span class="caret"></span>
													</button>
													
													<ul class="dropdown-menu dropdown-default pull-left" role="menu">

														<li>
															<a href="#">
																 <i class="fa fa-pencil"></i>
																	<?php echo get_phrase('edit');?>
															 </a>
														</li>
																					
														<li  style="" class="divider"></li>
														
														<li>
															<a href="#">
																 <i class="fa fa-times"></i>
																	<?php echo get_phrase('suspend');?>
															 </a>
														</li>
																					
														<li  style="" class="divider"></li>
														
														<li  style="" class="divider"></li>
														
														<li>
															<a href="#">
																 <i class="fa fa-trash"></i>
																	<?php echo get_phrase('delete');?>
															 </a>
														</li>
																					
														<li  style="" class="divider"></li>
														
													</ul>
												</div>		
														
												</td>
												<td><?=$subject->name;?></td>
												<?php
													$status = array('Inactive','Active');
												?>
												<td><?=$status[$subject->status];?></td>
											</tr>
										<?php
											}
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
	$(".datatable").DataTable();
</script>