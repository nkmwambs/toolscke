<div class="row">
	<div class="col-sm-12">
			
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('bank_statements');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
				
								<!--<a href="#" class="btn btn-icon btn-green" onclick="confirm_action('<?php echo base_url();?>index.php?admin/system_reset/backup');"><i class="fa fa-compress" ></i><?= get_phrase('back_up');?></a>-->
          	<button class="btn btn-icon btn-red" id="deleting"><i class="entypo-cancel-squared"></i><?= get_phrase('delete');?></button>
          	<hr>
                <?php
                	$map = directory_map('./uploads/bank_statements/'.$this->session->icp_no.'/'.date('Y-m',strtotime($param2)).'/', FALSE, TRUE);
                ?>
                <table class="table table-hover table-striped">
                	<thead>
                		<tr>
                			<th><?= get_phrase('select');?></th>
                			<th><?= get_phrase('bank_statement');?></th>
                			<th><?= get_phrase('upload_date');?></th>
                			<th><?= get_phrase('file_size');?></th>
                		</tr>
                	</thead>
                	<tbody>
                		<?php foreach($map as $row): $prop = (object)get_file_info('uploads/bank_statements/'.$this->session->icp_no.'/'.date('Y-m',strtotime($param2)).'/'.$row);?>
                		<tr>
                			<td><input type="checkbox" class="chk"/></td>
                			<td><a href="#" onclick="confirm_action('<?php echo base_url();?>icp/bank_statement_download/<?= $row;?>/<?= strtotime($param2);?>');"><?= $row;?></a></td>
                			<td><?= date('d-m-Y',$prop->date);?></td>
                			<td><?= number_format(($prop->size/1000000),2).' MB';?></td>
                		</tr>
                		<?php endforeach;?>
                	</tbody>
                </table>								
			
			</div>
	</div>
			
	</div>
	
</div>

