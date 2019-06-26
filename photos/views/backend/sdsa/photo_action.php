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
			                 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>photos.php/modal/popup/modal_add_comment/<?php echo $id;?>');">
			                        <i class="fa fa-vcard"></i>
										<?php echo get_phrase('comments');?>
			                 </a>
			            </li> 
			            
			            <li class="divider"></li>
			            <?php
			           		if($status==='1'){
			           	?>
			            <li>
			                 <a href="#" onclick="confirm_action('<?php echo base_url();?>photos.php/sdsa/accept_photo/<?php echo $id;?>');">
			                        <i class="fa fa-check"></i>
										<?php echo get_phrase('accept');?>
			                 </a>
			            </li>
			            
			           <li class="divider"></li>
			           <?php
							}
			           ?>
			           <?php
			           		if($status==='1' || $status==='2'){
			           	?>
			           <li>
			                 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>photos.php/modal/popup/modal_reject_reason/<?php echo $id;?>');">
			                        <i class="fa fa-close"></i>
										<?php echo get_phrase('decline');?>
			                 </a>
			            </li>
			            
			           <li class="divider"></li>
			           <?php
							}
			           	?>
			           <?php
			           	if($status==='3'){
			           ?>
			           <li>
			                 <a href="#" onclick="confirm_action('<?php echo base_url();?>photos.php/sdsa/reinstate_photo/<?php echo $id;?>');">
			                        <i class="fa fa-refresh"></i>
										<?php echo get_phrase('reinstate');?>
			                 </a>
			            </li>
			            
			           <li class="divider"></li>
			            
			            <?php
						}
			            ?>
			            <?php
			           		if($downloaded==='1'){
			           	?>
			            <li>
			                 <a href="#" onclick="confirm_action('<?php echo base_url();?>photos.php/sdsa/delete_photo/<?php echo $id;?>');">
			                        <i class="fa fa-trash-o"></i>
										<?php echo get_phrase('delete');?>
			                 </a>
			            </li>
			            <?php
			           		}
			           	?>
				</ul>
</div>
					