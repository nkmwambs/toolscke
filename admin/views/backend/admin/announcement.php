<hr/>
<div class='row'>
    <div class='col-xs-6'>
        <?php 
            echo form_open(base_url().'admin.php/admin/post_announcement', array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
        ?>
            <div class='form-group'>
                <label class='col-xs-12'><?=get_phrase('announcement_title');?></label>
                <div class='col-xs-12'>
                    <input type='text' class='form-control' required='required' name='announcement_title' id='announcement_title'/>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-xs-12'><?=get_phrase('announcement_detail');?></label>
                <div class='col-xs-12'>
                    <textarea class='form-control ckeditor' required='required' name='announcement_detail' id='announcement_detail' rows='15'></textarea>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-xs-12'><?=get_phrase('announcement_end_date');?></label>
                <div class='col-xs-12'>
                    <input type='text' class='form-control datepicker' data-format='yyyy-mm-dd' required='required' readonly='readonly' name='announcement_end_date' id='announcement_end_date'/>
                </div>
            </div>

            <div class='form-group'>
                <div class='col-xs-12'>
                    <button type='submit' class='btn btn-default'><?=get_phrase('save');?></button>
                    <div class='btn btn-default'><?=get_phrase('reset');?></div>
                </div>
            </div>

        </form>
    </div>

    <div class='col-xs-6'>
        
        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
					<li class="active">
						<a href="#active_announcements" data-toggle="tab">
							<span class="visible-xs"><i class="fa fa-unlock"></i></span>
							<span class="hidden-xs">Active Announcements</span>
						</a>
					</li>
					<li>
						<a href="#expired_announcements" data-toggle="tab">
							<span class="visible-xs"><i class="fa fa-lock"></i></span>
							<span class="hidden-xs">Expired Announcements</span>
						</a>
					</li>
					
				</ul>
				
				<div class="tab-content">
                    <div class="tab-pane active" id="active_announcements">
                        <table class='table table-striped datatable'>
                            <thead>
                                <tr>
                                    <th><?=get_phrase('action');?></th>
                                    <th><?=get_phrase('title');?></th>
                                    <th><?=get_phrase('created_by');?></th>
                                    <th><?=get_phrase('expiry_date');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($active_announcements as $announcement){?>
                                    <tr>
                                        <td>
                                            <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_view_annnouncement_detail/<?=$announcement['announcement_id'];?>');"><?=get_phrase('view');?></a> &nbsp; 
                                            <a href="javascript:;" onclick="confirm_action('<?php echo base_url();?>admin.php/admin/delete_annnouncement/<?=$announcement['announcement_id'];?>');"><?=get_phrase('delete');?></a>
                                        </td>
                                        <td><?=$announcement['announcement_title'];?></td>
                                        <td><?=$announcement['announcement_created_date'];?></td>
                                        <td><?=$announcement['announcement_end_date'];?></td>
                                    </tr>
                                <?php }?>    
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="expired_announcements">
                    <table class='table table-striped datatable'>
                            <thead>
                                <tr>
                                    <th><?=get_phrase('action');?></th>
                                    <th><?=get_phrase('title');?></th>
                                    <th><?=get_phrase('created_by');?></th>
                                    <th><?=get_phrase('expiry_date');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($expired_announcements as $announcement){?>
                                    <tr>
                                        <td>
                                            <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>admin.php/modal/popup/modal_view_annnouncement_detail/<?=$announcement['announcement_id'];?>');"><?=get_phrase('view');?></a> &nbsp; 
                                            <a href="javascript:;" onclick="confirm_action('<?php echo base_url();?>admin.php/admin/delete_annnouncement/<?=$announcement['announcement_id'];?>');"><?=get_phrase('delete');?></a>
                                        </td>
                                        <td><?=$announcement['announcement_title'];?></td>
                                        <td><?=$announcement['announcement_created_date'];?></td>
                                        <td><?=$announcement['announcement_end_date'];?></td>
                                    </tr>
                                <?php }?>    
                            </tbody>
                        </table>
                    </div>
                </div>    
    </div>
</div>

<script>
    $('.datatable').DataTable();
</script>