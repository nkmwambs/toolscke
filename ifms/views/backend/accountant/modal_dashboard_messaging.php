<style>
/* .chat_holder{
    display:none;
} */

.v-divider{
 margin-left:5px;
 margin-right:5px;
 width:1px;
 height:100%;
 border-left:1px solid gray;
}

.h-divider{
 margin-top:5px;
 margin-bottom:5px;
 height:1px;
 width:100%;
 border-top:1px solid gray;
}

</style>

<?php 
    $projectsdetails_id = $this->db->get_where('projectsdetails',array('icpNo'=>$param3))->row()->ID;

    $this->db->select(array('CONCAT(userfirstname," ",userlastname) as sender_name','message_body as message','dashboard_messaging_detail.last_modified_date as sender_date'));
    $this->db->join('dashboard_messaging','dashboard_messaging.dashboard_messaging_id=dashboard_messaging_detail.dashboard_messaging_id');
    $this->db->join('users','users.ID=dashboard_messaging_detail.message_from');
    $messages = $this->db->order_by('sender_date DESC')->get_where('dashboard_messaging_detail',
    array('projectsdetails_id'=>$projectsdetails_id,'dashboard_month'=>$param2))->result_array(); 

?>

<div class="row">
	<div class="col-sm-12">
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-mail"></i>
					<?php echo get_phrase('messaging');?> Send message for <?=$param3;?> 
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
                <?php echo form_open(base_url() . 'ifms.php/partner/financial_reports/bank_reconcile/'.$param2.'/'.$param3 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
                    <div class='form-group'>
                        <div class='col-xs-12'>
                            <textarea required='required' id='message_box' class='form-control autogrow' data-validate="minlength[10]" placeholder='Enter your message here'></textarea>
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-xs-12'>
                            <button id='btn-send' class='btn btn-default'>Send <i class='fa fa-send'></i></button>
                            <button id='btn-reset' class='btn btn-default'>Reset <i class='fa fa-refresh'></i></button>
                            <div id='show_hide_messages' title='Show/hide Messages' class='btn btn-default' style='border:white 1px solid;'><i class='fa fa-bars'></i></div>
                        </div>
                    </div>

                    <?php 
                        if(count($messages) > 0){
                            foreach($messages as $message){
                    ?>
                            <div class='form-group chat_holder hidden'>
                                <div class='col-xs-6 message_body'><?=$message['message']?></div>
                                <div class='col-xs-5 message_metadata v-divider'><span class='message_metadata_sender'>Sent By <?=$message['sender_name'];?></span> <span class='v-divider message_metadata_send_date' style='padding-left:15px;'>Sent on <?=date('jS M Y',strtotime($message['sender_date']));?><span></div>
                            </div> 
                    <?php 
                           }
                        }else{
                    ?>
                            <div class='form-group chat_holder_default show' id="chat_holder_default">
                                <div class='col-xs-12' style='text-align:center;'>No message history available</div>
                            </div> 
                    <?php        
                        }   
                    ?>

                        <div class='form-group chat_holder_default hidden'>
                            <div class='col-xs-12' style='text-align:center;'>No message history available</div>
                        </div> 
               
<!-- 
                    <div class='form-group chat_holder hidden'>
                        <div class='col-xs-6 message_body'>Message 2</div>
                        <div class='col-xs-5 message_metadata v-divider'><span class='message_metadata_sender'>Sent By Martha Ochieng</span> <span class='v-divider message_metadata_send_date' style='padding-left:15px;'>Sent on 10th February 2020<span></div>
                    </div>

                    <div class='form-group chat_holder hidden'>
                        <div class='col-xs-6 message_body'>Message 3</div>
                        <div class='col-xs-5 message_metadata v-divider'><span class='message_metadata_sender'>Sent By Anthony Baraka</span> <span class='v-divider message_metadata_send_date' style='padding-left:15px;'>Sent on 8th March 2020<span></div>
                    </div> -->


                </form>
            </div>
        </div>
    </div>
</div>

<script>
$("#show_hide_messages").on('click',function(){
    if($(".chat_holder").hasClass('hidden')){
        $(".chat_holder").removeClass('hidden').addClass('show')
    }else{
        $(".chat_holder").removeClass('show').addClass('hidden')
    }
});

$("#btn-send").on('click',function(ev){
    var message = $("#message_box").val();

    if(message == "" || message == null){
        alert('Message cannot be empty');
        return false;
    }

    var url = "<?=base_url();?>ifms.php/accountant/send_dashboard_message";
    var data = {'message':message,'fcp_id':'<?=$param3;?>','month':'<?=$param2;?>'};

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        beforeSend:function(){

        },
        success:function(response){
            //alert(response);

            var obj = JSON.parse(response);

            if(!obj.success){
                alert('Error occurred. Message not posted!');
                return false;
            }

            if($('#chat_holder_default')){
                $("#chat_holder_default").remove();
            }

            var temp_message_holder = $("#chat_holder_temp");
            var message_holder_clone = temp_message_holder.clone();
            
            if(message_holder_clone.hasClass('hidden')){
                message_holder_clone.removeClass('hidden').addClass('chat_holder');
                message_holder_clone.removeAttr('id');
            }

            message_holder_clone.find('.message_body').html(obj.message);
            message_holder_clone.find('.message_metadata_sender').html('Sent By '+obj.sender_name);
            message_holder_clone.find('.message_metadata_send_date').html('Sent On '+obj.send_date);

            if($(".chat_holder").length == 0){
                $(".chat_holder_default").first().before(message_holder_clone);
            }else{
                $(".chat_holder").first().before(message_holder_clone);
            }
            

            // Clear message_box
            reset();
        },
        error:function(xhr){
            alert(xhr.reponseText);
        }
    })

    ev.preventDefault();
})

$("#btn-reset").on('click',function(ev){
    reset();
    ev.preventDefault();
})

function reset(){
    $("#message_box").val(null);
}
</script>


<div class='form-group hidden' id='chat_holder_temp'>
    <div class='col-xs-6 message_body'></div>
    <div class='col-xs-5 message_metadata v-divider'><span class='message_metadata_sender'></span> <span class='v-divider message_metadata_send_date' style='padding-left:15px;'><span></div>
</div>