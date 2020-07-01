<?php
//echo $this->session->login_type;
?>
<div class="row">
	<div class="col-sm-12">
		
		<div class="row">
			<div class="col-sm-12">
				<button data-toggle="collapse" class="btn btn-success" data-target="#panel"><?=get_phrase('show_/_hide_panel');?></button>
				
				<button onclick="showAjaxModal('<?php echo base_url();?>photos.php/modal/popup/modal_download/');"; class="btn btn-info btn-icon"><i class="fa fa-download"></i><?=get_phrase('download_by_status');?></button>
				
				<!--<button class="btn btn-red" id="monkey_dialog"><?php echo get_phrase('delete_by_status');?> <span class="badge badge-success"><?=array_sum($delete_array) ?></span></button>-->
				
				<div class="btn-group pull-right" id="selected_image_action" style="display:none;">
			                    <button id="" style="width: 100px;" type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown">
			                        <?=get_phrase('images_action');?> <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
	
			                        <!-- Accept Selected Images -->
			                        <li>
			                        	<a href="#" id="accept_selected" onclick="image_action('accept_selected');" class="mass_action">
			                            	<i class="fa fa-check"></i>
												<?php echo get_phrase('accept_selected');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>

									
			                        <!--Reject selected Images -->
			                        <li>
			                        	<a href="#" id="reject_selected" onclick='return image_action("reject_selected");'  class="mass_action">
			                            	<i class="fa fa-close"></i>
												<?php echo get_phrase('reject_selected');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
			                       	
			                       	<!-- Reinstate Selected Images -->
			                       	
			                       	  <li>
			                        	<a href="#" id="reinstate_selected" onclick='return image_action("reinstate_selected");'  class="mass_action">
			                            	<i class="fa fa-refresh"></i>
												<?php echo get_phrase('reinstate_selected');?>
			                               	</a>
			                       	</li>
			                       	
			                       	<li class="divider"></li>
			                       	
			                       	<!-- Delete Selected Images -->
			                       	
			                       	  <li>
			                        	<a href="#" id="del_selected" onclick='return image_action("del_selected");'  class="mass_action">
			                            	<i class="fa fa-trash-o"></i>
												<?php echo get_phrase('delete_selected');?>
			                               	</a>
			                       	</li>
			                       	
									<li class="divider"></li>
												                       	
			                       	<!--Download Selected Images -->
			                        <li>
			                        	<a href="#" onclick='return image_action("download_selected");' id="download_selected"  class="">
			                            	<i class="fa fa-download"></i>
												<?php echo get_phrase('download_selected');?>
			                               	</a>
			                       	</li>
			                       	
			                       
			                     </ul>
			                     </div>
	
				
				<div id="panel" class="collapse">
				
				        <div class="row">
				        	  <div class="col-sm-6">
				        	  	<?php echo form_open('', array('id'=>'frm_search','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>				        		
					        		
					        		<div class="form-group">
								        <label class="control-label col-sm-12">Show Status</label>
								        <!--<input type="checkbox" id="rejected_img" data-toggle="toggle" data-size="normal" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" value="0">-->
								         <?php 
								         	$selected = "selected";
											
											if(!isset($select_status)){
												$select_status = $this->session->userdata('status');
											}
								         ?>
								        <div class="col-sm-12">
								        	<select id="status" class="form-control">
								        	  	<option value=""><?php echo get_phrase('select');?></option>
								        	  	<option value="1" selected="selected"><?php echo get_phrase('new');?></option>
								        	  	<option value="2"><?php echo get_phrase('accepted');?></option>
								        	  	<option value="3"><?php echo get_phrase('rejected');?></option>
								        	  	<option value="4"><?php echo get_phrase('reinstated');?></option>
								        	  	<!--<option value="5" <?php if($select_status==='5') echo $selected;?>><?php echo get_phrase('deleted');?></option>-->
								      		</select>
								      </div>
					        	</div>						        		
					        	<div class="form-group">
					                   <div class="col-sm-12">
					                   	 <button class="form-control btn btn-primary"  id="btn-filter"><?=get_phrase('search');?></button>
					                   </div>
					            </div>
					        	
					        	</form>
	
				        	</div>
				        	  
				        	  <div class="col-sm-6">
				        	   	<!-- Extra Panel Components here -->
				        	  </div>
				        </div>
				        
				        
				
				        
				       </div> 
				        <!-- Panel End-->
				        
				        <hr/>

	</div>
			
</div>

	<div class="row">
		<div class="col-sm-12">

			
			<?php echo form_open('' , array('id'=>'frm_image_action','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
			
			<table class="table table-striped" id="table_export">
				<thead>
					<tr>
						<th><input type="checkbox" id="checkAll"/></th>
						<th><?=get_phrase('action');?></th>
						<th><?=get_phrase('photo');?></th>
						<th><?=get_phrase('project');?></th>
						<th><?=get_phrase('beneficiary_id');?></th>
						<th><?=get_phrase('date_created');?></th>
						<th><?=get_phrase('date_modified');?></th>
						<th><?=get_phrase('status');?></th>
					</tr>
				</thead>
			</table>
		</form>
		</div>	
	</div>	
</div>
</div>

<script>
$(document).on('click','.chkPhoto', function() { 

	count_checked_boxes();
 });
	
	$('#checkAll').click(function(){
		if($(this).is(':checked')===true){
			$('.chkPhoto').each(function(){
				$(this).prop('checked',true);
			});
		}else{
			$('.chkPhoto').each(function(){
				$(this).prop('checked',false);
			});
		}
		count_checked_boxes();
	});
	
	
	
	function count_checked_boxes(){
		var cnt_checked = 0;
		$('.chkPhoto').each(function(){
			if($(this).is(':checked')){
				++cnt_checked;
			}
		});
		
		if(cnt_checked>0){
			$('#selected_image_action').css('display','block');
		}else{
			$('#selected_image_action').css('display','none');	
		}
	}
	
	function image_action(id){

		$('#frm_image_action').attr('action','<?php echo base_url();?>photos.php/sdsa/image_action/'+id);
		
		$('#frm_image_action').submit();
		
	}
		
	$(document).ready(function(){
			var datatable = $('#table_export').DataTable({
		      dom: '<"row"l><Bf><"col-sm-12"rt><ip>',
		       //sDom:'r',
		       pagingType: "full_numbers",
		       buttons: [
		           'csv', 'excel', 'print'
		       ],
		       stateSave: true,
		       oLanguage: {
			        sProcessing: "<img src='<?php echo base_url();?>uploads/preloader4.gif'>"
			    },
			   processing: true, //Feature control the processing indicator.
		       serverSide: true, //Feature control DataTables' server-side processing mode.
		       order: [], //Initial no order.
		
		       // Load data for the table's content from an Ajax source
		       "ajax": {
		           "url": "<?php echo base_url();?>photos.php/sdsa/search_photo",
		           "type": "POST",
		           "data": function(data){
		           		data.status = $('#status').val();
		           }
		       },
		
		       //Set column definition initialisation properties.
		       "columnDefs": [
			       	{ 
			           "targets": [ 0,1,2 ], //first column / numbering column
			           "orderable": false //set not orderable
			       	}
		       ],
		       lengthMenu: [[25,50, 100, 150,-1], [25,50 ,100,150 ,"All"]],
			    pageLength: 25
		   });
		   
		     $('#btn-filter').click(function(event){ //button filter event click
		        datatable.ajax.reload(null,false);  //just reload table
		        event.preventDefault();
		    });
		    
		    //$('#btn-reset').click(function(){ //button reset event click
		      //  $('#form-filter')[0].reset();
		        //datatable.ajax.reload(null,false);  //just reload table
		    //});
		    
		   // $('.action').click(function(event){ //button reset event click
		     //   datatable.ajax.reload(null,false);  //just reload table
		       // event.preventDefault();
		    //});
		    		    
	});
	
	//$('#monkey_dialog').click(function(){
		//BootstrapDialog.show();
	//});
</script>