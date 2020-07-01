<?php 
$announcement = $this->db->get_where('announcement',array('announcement_id'=>$param2))->row();
?>

<div class='row'>
    <div class='col-xs-12'>
        <?php 
            echo form_open(base_url().'admin.php/admin/edit_announcement/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate','enctype' => 'multipart/form-data'));
        ?>
            <div class='form-group'>
                <label class='col-xs-12'><?=get_phrase('announcement_title');?></label>
                <div class='col-xs-12'>
                    <input type='text' value='<?=$announcement->announcement_title;?>' class='form-control' required='required' name='announcement_title' id='announcement_title'/>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-xs-12'><?=get_phrase('announcement_detail');?></label>
                <div class='col-xs-12'>
                    <textarea class='form-control ckeditor' required='required' name='announcement_detail' id='announcement_detail' rows='15'><?=$announcement->announcement_detail;?></textarea>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-xs-12'><?=get_phrase('announcement_end_date');?></label>
                <div class='col-xs-12'>
                    <input type='text' value='<?=$announcement->announcement_end_date;?>' class='form-control datepicker' data-format='yyyy-mm-dd' required='required' readonly='readonly' name='announcement_end_date' id='announcement_end_date'/>
                </div>
            </div>

            <div class='form-group'>
                <div class='col-xs-12'>
                    <button type='submit' class='btn btn-default'><?=get_phrase('edit');?></button>
                </div>
            </div>

        </form>
    </div>
</div> 