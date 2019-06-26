<div class="btn-group">
     <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                <?php echo get_phrase('action');?> <span class="caret"></span>
     </button>
         		<ul class="dropdown-menu dropdown-default pull-right" role="menu">
           				<li>
			                 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_full_photo/<?php echo $id;?>');">
			                        <i class="fa fa-eye"></i>
										<?php echo get_phrase('view');?>
			                 </a>
			            </li> 
			            
			           <!-- <li class="divider"></li>
			            
			            <li>
			                 <a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?project/process_photo/delete/<?php echo $id;?>');">
			                        <i class="fa fa-trash-o"></i>
										<?php echo get_phrase('delete');?>
			                 </a>
			            </li> -->
				</ul>
</div>
					