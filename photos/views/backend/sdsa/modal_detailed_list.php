<style>
	img{
		width: 44px;
	}
</style>

<div class="row">
	<div class="col-sm-12">
	 <div class="panel panel-info " data-collapsed="0">
          <div class="panel-heading">
               <div class="panel-title">
                    <i class="fa fa-info"></i>
                        <?php echo get_phrase('photo_detailed_list');?>
               </div>
          </div>
             <div class="panel-body" style="padding:0px;">
				<table class="table table-striped">
					<thead>
						<tr>
							<th><?php echo get_phrase('Photo');?></th>
							<th><?php echo get_phrase('Filename');?></th>
							<th><?php echo get_phrase('Created_Date');?></th>
							<th><?php echo get_phrase('Modified_Date');?></th>
							<th><?php echo get_phrase('Status');?></th>
						</tr>
					</thead>
					<?php
						$status = array('none','new','accepted','rejected','reinstated');
						$photos = $this->db->get_where('files',array('group'=>$param3,'status'=>array_search($param2, $status)))->result_object();
					?>
					<tbody>
					<?php
						foreach($photos as $rows):
					?>
						<tr>
							<!--<td><img src="<?php echo base_url();?>uploads/photos/thumbnails/<?php echo $rows->file_name;?>" class="img-circle" width="44"></td>-->
							<td><?php echo thumbnail('uploads/photos/'.$param3.'/'.$rows->file_name, 100, 100 );?></td>
							<td><?php echo $rows->file_name;?></td><!--<?php echo thumbnail('uploads/photos/'.$project_num.'/'.$file->file_name, 100, 100 ); ?>-->
							<td><?php echo $rows->created;?></td>
							<td><?php echo $rows->modified;?></td>
							<td><?php echo ucfirst($param2);?></td>
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