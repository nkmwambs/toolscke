
<script>
    function dct_scripts_voucher_type_on_change(elem){
        var cheque_number = $('#ChqNo');
 
        // Change the title for the cheque number to reference number
        cheque_number.prev().find('span').html('<?=get_phrase('reference_number');?>')

        // Make the reference number field not readonly
        cheque_number.removeAttr('readonly');

        // Remove reversal control and add upload area
        $("#td_reversal").remove();
		
        $("#td_voucher_type").closest('tr').append('<td colspan="2" id="td_dropzone">'+create_upload_area()+'</td>');

        // Dropzone api code
        dropzoneLoad('myDropzone');
        
        // Change the cheque number id,name to reference_number - This should be last change to do
        //cheque_number.attr('id') = 'DCTReference';
		$('#DCT_div').removeClass('hidden');
        //cheque_number.prop('name','DCTReference');
        
        
    }


    // $("#ChqNo").on('change',function(){
    //     alert('DCTReference');
    // });

    function dct_upload_zone_on_change(){

    }

    function create_upload_area(){
        var upload_area = '<div id="myDropzone" class="dropzone">'+
						    '<div class="dropzone-previews"></div>'+
								'<div class="fallback">'+
								    '<input name="fileToUpload" type="file" multiple />'+
								'</div>'+
                            '</div>';
                            
        return upload_area;                    
    }

    function dropzoneLoad(myDropzoneId){
        
        var myDropzone = new Dropzone("#"+myDropzoneId, {
			url: "<?= base_url() ?>ifms.php?/dct/create_uploads_temp/"+$("#VNumber").val(),
			paramName: "fileToUpload", // The name that will be used to transfer the file
			maxFilesize: 5, // MB
			uploadMultiple: true,
			addRemoveLinks: true,
			acceptedFiles: 'image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv',
		});

        myDropzone.on("success", function(file, response) {
				if (response == 0) {
					alert('Error in uploading files');
					return false;
				}else{
                    alert(response);
                }
				$('#myDropzone').css({
					'border': '2px solid gray'
				});
				$('#error_msg').html('');

			}



		);
		myDropzone.on('removedfile', function(file) {

			/* here do AJAX call to the server ... */
			var url = "<?= base_url() ?>ifms.php/dct/remove_dct_files_in_temp/"+$("#VNumber").val();
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
					alert('This file ' + response + ' has been removed');
				},

			});

		});
    }
    
</script>
