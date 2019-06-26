<div class="btn-group">
     <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                <?php echo get_phrase('action');?> <span class="caret"></span>
     </button>
         		<ul class="dropdown-menu dropdown-default pull-right" role="menu">
           				<li>
			                 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>photos.php/modal/popup/modal_full_photo/<?php echo $id;?>');">
			                        <i class="fa fa-eye"></i>
										<?php echo get_phrase('view');?>
			                 </a>
			            </li> 
			            
			           <li class="divider"></li>
			            
			            <li>
			                 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>photos.php/modal/popup/modal_reject_reason/<?php echo $id;?>');">
			                        <i class="fa fa-address-card-o"></i>
										<?php echo get_phrase('comments');?>
			                 </a>
			            </li>
				</ul>
</div>
					