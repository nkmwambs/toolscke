<!--Dropzone-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">

<?php
//echo $param3;
?>

<div class='row'>
    <div class='col-xs-12'>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?= get_phrase('upload_DCT_reference_document'); ?>
                </div>
            </div>

            <div class="panel-body" style="max-width:50;  overflow: auto;">
                <?php echo form_open("", array('id' => 'frm_dct_documents', 'class' => 'form-vertical form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <!-- <div class='form-group'>
                        <label class='control-label col-xs-12'><?= get_phrase('reference_number'); ?></label>
                        <div class='col-xs-12'>
                            <input type='text' id='modal_dct_reference' class='form-control' value = '<?= $param5; ?>' name = '' />
                        </div>
                    </div>

                    <hr style='margin:25px 0px 25px 0px'/> -->

                <div class='form-group'>
                    <label class='control-label col-xs-12'><?= get_phrase('reference_documents'); ?></label>
                    <div class='col-xs-12'>
                        <div id="myDropzone" class="dropzone">
                            <div class="dropzone-previews"></div>
                            <div class="fallback">
                                <!-- this is the fallback if JS isn't working -->
                                <input name="fileToUpload" type="file" multiple />
                            </div>
                        </div>
                    </div>
                </div>

                <hr style='margin:25px 0px 25px 0px' />

                <div class='form-group'>
                    <label class='control-label col-xs-12'></label>
                    <div class='col-xs-12'>
                        <div data-dismiss='modal' id='btn_save_uploads' data-row_id="<?= $param3; ?>" class='btn btn-default'><?= get_phrase('save'); ?></div>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#btn_save_uploads").on('click', function(ev) {
        // if($("#modal_dct_reference").val() == ""){
        //     alert('Reference number is required');
        //     ev.preventDefault();
        // }

    });

    $(document).ready(function() {
        //$("#modal_dct_reference").val();
    });

    var totalsize = 0.0;
    var myDropzone = new Dropzone("#myDropzone", {
        url: "<?= base_url() ?>ifms.php?/partner/create_uploads_temp",
        paramName: "fileToUpload", // The name that will be used to transfer the file
        //maxFilesize: 2, // MB
        uploadMultiple: true,
        addRemoveLinks: true,
        paralleluploads: 5,
        maxFiles: 5,
        acceptedFiles: 'image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv',

        //Added by Onduso on 7/8/2020 to allow only 2 files
       
        accept: function(file, done) {
            if (totalsize >= 2) {
                file.status = Dropzone.CANCELED;
                this._errorProcessing([file], "Max limit reached", null);
                alert("Max limit reached");
            } else {
                done();
            }
        },
        //End of addition

        init: function() {

            var thisDropzone = this;
            var url = "<?= base_url(); ?>ifms.php/partner/get_uploaded_support_mode_files/<?= $param3; ?>"; //get_uploaded_support_mode_files

            $.get(url, function(data) {
                //alert(data.store_folder);
                $.each(data.uploaded_files, function(key, value) {

                    var mockFile = {
                        name: value.name,
                        size: value.size
                    };

                    thisDropzone.options.addedfile.call(thisDropzone, mockFile);

                    //thisDropzone.options.thumbnail.call(thisDropzone, mockFile, data.store_folder+"/"+value.name);

                });

            });

            /**Added by Onduso on 7/8/2020**/
            
            //[Check max files exceeded]
            this.on("maxfilesexceeded", function(file) {
                alert("No more files please!");
            });

            //[increase the totalsize by adding each file uploaded]
            this.on("addedfile", function(file) {
                totalsize += parseFloat((file.size / (1024 * 1024)).toFixed(2));
            });
            //[Reduce totalsize when file is removed]
            // this.on("removedfile", function(file) {
            //     if (file.upload.progress != 0) {
            //         totalsize -= parseFloat((file.size / (1024 * 1024)).toFixed(2));
            //     }
            // });
            //[On error reduce totalsize]
            this.on("error", function(file) {
                totalsize -= parseFloat((file.size / (1024 * 1024)).toFixed(2));
            });

            // /**End of Onduso addition 7/8/2020 **/
        }


    });



    myDropzone.on('sending', function(file, xhr, formData) {
        formData.append('voucher_number', '<?= $param2; ?>');
        formData.append('voucher_detail_row_number', '<?= $param3; ?>');
        formData.append('support_mode_id', '<?= $param4; ?>');
    });

    myDropzone.on("success", function(file, response) {
        if (response == 0) {
            alert('Error in uploading files');
            return false;
        } else {
            //alert(response);
        }
        $('#myDropzone').css({
            'border': '2px solid gray'
        });
        $('#error_msg').html('');

    });



    myDropzone.on('removedfile', function(file) {

        /* here do AJAX call to the server ... */
        var url = "<?= base_url() ?>ifms.php/partner/remove_dct_files_in_temp/<?= $param2; ?>/<?= $param3; ?>/<?= $param4; ?>";
        var file_name = file.name;
        $.ajax({
            //async: false,
            type: "POST",
            url: url,
            data: {
                'file_name': file_name
            },
            // beforeSend: function() {
            // 	$('#error_msg').html('<div style="text-align:center;"><img style="width:60px;height:60px;" src="<?php echo base_url(); ?>uploads/preloader4.gif" /></div>');
            // },
            success: function(response) {
                //alert('This file'+data+' has been removed');
                var obj = JSON.parse(response);

                alert('This file ' + obj.file_name + ' has been removed');
                var dct_uploads_count_label = $("#bodyTable tr").eq('<?= $param3; ?>').find('td.td_support_mode').find('i.dct_uploads_count_label');
                dct_uploads_count_label.html(obj.count_of_files + " files [Click here to Update]");

                //Added by Onduso 7/8/2020
                var dct_file_size = $("#bodyTable tr").eq('<?= $param3; ?>').find('td.td_support_mode').find('input.dct_file_size');
                dct_file_size.html(totalsize);
                if (file.upload.progress != 0) {
                    totalsize -= parseFloat((file.size / (1024 * 1024)).toFixed(2));
                }
                //End of Onduso addition
            },

        });

    });
</script>