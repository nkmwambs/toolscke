<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-info-circle"></i>
                            <?php echo get_phrase('manage_data');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	
                    	<button onclick="confirm_action('<?php echo base_url();?>admin.php/admin/manage_data/back_up/all/');" class="btn btn-primary btn-icon icon-left"><i class="fa fa-briefcase"></i><?php echo get_phrase('back_up_all');?></button>
                    	
                    	<button onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_data_restore/');" class="btn btn-info btn-icon icon-left"><i class="fa fa-refresh"></i><?php echo get_phrase('restore');?> (SQL)</button>
                    	
                    	<button onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_data_restore_csv/');" class="btn btn-warning btn-icon icon-left"><i class="fa fa-refresh"></i><?php echo get_phrase('restore');?> (CSV)</button>
                    	<hr/>
                    	<table class="table table-striped datatable">
                    		<thead>
                    			<tr>
                    				<th><?=get_phrase('table_group');?></th>
                    				<th><?=get_phrase('number_of_tables');?></th>
                    				<th><?=get_phrase('data_length');?></th>
                    				<th><?=get_phrase('action');?></th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php
                    				foreach($tables as $table):
                    			?>
                    				<tr>
                    					<td><?=str_replace("_", " ", $table->TABLE_NAME);?></td>
                    					<td><?=$table->COUNT_TABLES;?></td>
                    					<td><?=number_format($table->DATA_LENGTH,2);?> KiB</td>
                    					<td>
                    						<div class="btn-group">
							                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
							                        <?php echo get_phrase('action');?> <span class="caret"></span>
							                    </button>
							                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
							                   		<li>
							                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>admin.php/admin/manage_data/back_up/<?php echo $table->TABLE_NAME;?>');">
							                            	<i class="fa fa-cloud-download"></i>
																<?php echo get_phrase('back_up');?>
							                               	</a>
							                        </li>
							             							                        
							                         <li class="divider"></li>
							                        
							                        <li>
							                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>admin.php/admin/manage_data/delete/<?php echo $table->TABLE_NAME;?>');">
							                            	<i class="fa fa-eraser"></i>
																<?php echo get_phrase('erase');?>
							                               	</a>
							                        </li>
							                        
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
        </div>
 </div>              	