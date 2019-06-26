<style>
	.form-group.required .control-label:after { 
	   content:"*";
	   color:red;
	}
</style>
<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-refresh"></i>
                            <?php echo get_phrase('restore_data');?>
                        </div>
                    </div>
                    <div class="panel-body">
                    	<?php 
							echo form_open(base_url() . 'admin.php/admin/manage_data/restore/', array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
						
						?>
							<div class="form-group required">
								<label class="col-sm-4 control-label"><?=get_phrase('data_file');?></label>
								<div class="col-sm-8">
									<input type="file" class="form-control" name="userfile" id="userfile" required="required" />
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary btn-icon"><i class="fa fa-upload"></i><?=get_phrase('restore');?></button>
								</div>
							</div>
							
						<?php
							echo form_close();
						?>
					</div>
			</div>
		</div>
</div>	

<script>
	$("#userfile").change(function () {
        var fileExtension = ['sql'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            
            $(this).val("")
            		.css('border','1px red solid');
        }
    });
</script>