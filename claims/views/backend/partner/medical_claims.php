<style>
	td.details-control {
    background: url('<?php echo base_url();?>uploads/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>uploads/details_close.png') no-repeat center center;
}
</style>

<div class="well">	
	<div class="row">
	<?php echo form_open('' , array('id'=>'form-filter','class' => 'form-vertical form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

		<div class="col-sm-8" id="filters">
				<table class="table" id="table_search">
					<thead>
						<tr>
							<th><?=get_phrase("search_by");?></th>
							<!--<th><?=get_phrase("operator");?></th>-->
							<th><?=get_phrase("value");?></th>
							<th><?=get_phrase("action");?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="filters">
								<select class="form-control" name="" id="" onchange="return selected_option(this)">
									<option value=""><?=get_phrase('select');?></option>
									<option value="connect_incident_id"><?=get_phrase('connect_incident_id');?></option>
									<option value="claimCnt"><?=get_phrase('claim_count');?></option>
									<option value="proNo"><?=get_phrase('ke_no');?></option>
									<option value="cluster"><?=get_phrase('cluster');?></option>
									<option value="childNo"><?=get_phrase('child_number');?></option>
									<option value="childName"><?=get_phrase('child_name');?></option>
									<!--<option value="date"><?=get_phrase('claim_date');?></option>-->
									<!--<option value="treatDate"><?=get_phrase('treatment_date');?></option>-->
									<option value="diagnosis"><?=get_phrase('comments');?></option>
									<option value="reinstatementdate"><?=get_phrase('reinstatement_date');?></option>
									<!--<option value="stmp"><?=get_phrase('last_action_date');?></option>-->
									<option value="totAmt"><?=get_phrase('amount_incurred');?></option>
									<option value="careContr"><?=get_phrase('contribution');?></option>
									<option value="nhif"><?=get_phrase('N.H.I.F_number');?></option>
									<option value="amtReim"><?=get_phrase('amount_reimbursed');?></option>
									<option value="facName"><?=get_phrase('facility_name');?></option>
									<option value="facClass"><?=get_phrase('facility_type');?></option>
									<option value="vnum"><?=get_phrase('voucher_number');?></option>
									<option value="rmks"><?=get_phrase('status');?></option>

								</select>
							</td>

							<td class="val"><input type="text" class="form-control" name="" id=""/></td>
							<td><div class="fa fa-plus" onclick="return add_filter();"></div>&nbsp;<div class="fa fa-minus" onclick="return remove_filter(this)"></div></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3">
								<!--<button type="submit" id="btn_search" class="btn btn-primary btn-icon"><i class="fa fa-search"></i><?=get_phrase('search');?></button>-->
								<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                            	<button type="button" id="btn-reset" class="btn btn-default">Reset</button>
							</td>
						</tr>
					</tfoot>
				</table>
		</div>
		
		<div class="col-sm-4">
			
			<label class="control-label col-sm-12">	
				<?php echo get_phrase('select_date_range');?>
				<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
							<input class="form-control" type="text" name="daterange" readonly="readonly" value=""/>
				</div>
				
				<input type="hidden" id="start_date" value="<?=date('Y-m-01');?>" name="start_date">
				<input type="hidden" id="end_date" value="<?=date('Y-m-t');?>" name="end_date">
			
			</label>
			
			
			<label class="control-label col-sm-12">
				<?php echo get_phrase('apply_date_range_to_field');?>
				<select class="form-control pull-right" name="date_range" onclick="get_date_range(this);">
					<option value=""><?php echo get_phrase('select');?></option>
					<option value="date"><?php echo get_phrase('claim_date');?></option>
					<option value="treatDate"><?php echo get_phrase('treatment_date');?></option>
					<option value="stmp"><?php echo get_phrase('last_action_date');?></option>
				</select>
			</label>
			
		
			
		</div>
				

	
	</div>			
	

</div>


<hr/>

<?php
	if($this->session->userdata('logged_user_level')==="1"){
?>
	<a href="<?php echo base_url(); ?>claims.php/medical/new_medical_claim" class="btn btn-primary btn-icon"><i class="fa fa-plus"></i><?=get_phrase('new_claim');?></a>

	<button style="display: none;" id="mass_submit" class="btn btn-orange btn-icon pull-right"><i class="fa fa-thumbs-o-up"></i><?=get_phrase("submit_claim");?></button>

	<hr/>
<?php
	}
?>



<div class="col-sm-12 wrapper" id="wrapper">
	
<table class="table table-striped table-hover" id="table_export"  style="white-space: nowrap;" width="100%">
	<thead>
		<tr>
		
			
			<th><input type='checkbox' id='chkAll' onclick='return chkAll();'/></th><!--0 view-->
			<th><?=get_phrase('incident_ID');?></th><!--1 view-->
			<th><?=get_phrase('ke_no');?></th><!--2 view-->
			<th><?=get_phrase('cluster');?></th><!--3 view-->
			<th><?=get_phrase('child_no');?></th><!--4 view-->
			<th><?=get_phrase('child_name');?></th><!--5-->
			<th><?=get_phrase('payment_date');?></th><!--6 view--> 
			<th><?=get_phrase('claim_date');?></th><!--7-->			
			<th><?=get_phrase('diagnosis');?></th><!--8-->
			<th><?=get_phrase('total_amount');?></th><!--9-->
			<th><?=get_phrase('contribution');?></th><!--10-->
			<th><?=get_phrase('N.H.I.F');?></th><!--11-->
			<th><?=get_phrase('reimbursable');?></th><!--12 view-->
			<th><?=get_phrase('facility_name');?></th><!--13-->
			<th><?=get_phrase('facility_type');?></th><!--14-->
			<th><?=get_phrase('claim_type');?></th><!--15-->
			<th><?=get_phrase('voucher_no');?></th><!--16-->
			<th><?=get_phrase('receipt');?></th><!--17-->
			<th><?=get_phrase('approval');?></th><!--18-->
			<th><?=get_phrase('action');?></th><!--19 view-->
			<th><?=get_phrase('last_action_date');?></th><!--20-->
			<th><?=get_phrase('incident_type');?></th><!--21-->
			<th><?=get_phrase('incident_sub_category');?></th><!--22-->
			<th><?=get_phrase('illness');?></th><!--23-->
			<th><?=get_phrase('status');?></th><!--24-->


		</tr>
	</thead>

</table>
</div>
	</form>
<script>

function get_date_range(el){
	//alert($(el).is(":checked"));
	
	//if($(el).is(":checked")===true && $('#start_date').val()===""){
	if($(el).val()!=="" && $('#start_date').val()===""){	
		alert('Please select a date field');
		
		//remove selected one
		$('option:selected', 'select[name="date_range"]').removeAttr('selected');
		//Using the value
		$('select[name="date_range"]').find('option[value=""]').attr("selected",true);
	}
}

function format ( d ) {
    return '<table class="table" style="border-left: 5px solid red;">'+
    	'<thead>'+
    	'<tr>'+

    	'<th style="font-weight:bold;">Child Name: </th>'+
    	'<th style="font-weight:bold;">claim Date: </th>'+
    	'<th style="font-weight:bold;">Diagnosis: </th>'+
    	'<th style="font-weight:bold;">Receipt: </th>'+
    	'<th style="font-weight:bold;">Approval Documents: </th>'+
    	'<th style="font-weight:bold;">Status: </th>'+
    	
    	'</tr>'+
    	'</thead>'+
    	'<tbody>'+
    	'<tr>'+

        '<td>'+d[5]+'</td>'+
        '<td>'+d[7]+'</td>'+
		'<td>'+d[8]+'</td>'+	
    	'<td>'+d[17]+'</td>'+
    	'<td>'+d[18]+'</td>'+
    	'<td>'+d[24]+'</td>'+
    	
        '</tr>'+
        '</tbody>'+
        '</table>'+

        '<table class="table"  style="border-left: 5px solid red;">'+
    	'<thead>'+
    	'<tr>'+

    	'<th style="font-weight:bold;">Facility Name: </th>'+
    	'<th style="font-weight:bold;">Facility Type: </th>'+
    	'<th style="font-weight:bold;">Voucher Number: </th>'+
    	'<th style="font-weight:bold;">Total Amount: </th>'+
    	'<th style="font-weight:bold;">Contribution: </th>'+    	
    	'<th style="font-weight:bold;">Last Action Date: </th>'+
    	'<th style="font-weight:bold;">NHIF: </th>'+
    	'</tr>'+
    	'</thead>'+
    	'<tbody>'+
    	'<tr>'+

        '<td>'+d[13]+'</td>'+
        '<td>'+d[14]+'</td>'+
        '<td>'+d[16]+'</td>'+
        '<td>'+d[9]+'</td>'+
        '<td>'+d[10]+'</td>'+        
        '<td>'+d[20]+'</td>'+
        '<td>'+d[11]+'</td>'+
        '</tr>'+
        '</tbody>'+
        '</table>';
}

$(document).ready(function() {
	
				$('input[name="daterange"]').daterangepicker(
		{
			"showDropdowns": true,
			"ranges": {
        	"Today": [
            	"<?php echo date('Y-m-d');?>",
            	"<?php echo date('Y-m-d');?>"
        		],
        	"Yesterday": [
            		"<?php echo date('Y-m-d',strtotime('yesterday'));?>",
            		"<?php echo date('Y-m-d',strtotime('yesterday'));?>"
        		],
        	"Last 7 Days": [
            		"<?php echo date('Y-m-d',strtotime('-7 days'));?>",
            		"<?php echo date('Y-m-d');?>"
        		],
        	"Last 30 Days": [
            		"<?php echo date('Y-m-d',strtotime('-30 days'));?>",
            		"<?php echo date('Y-m-d');?>"
        		],
        	"This Month": [
            		"<?php echo date('Y-m-01');?>",
            		"<?php echo date('Y-m-t');?>"
        		],
        	"Last Month": [
            		"<?php echo date('Y-m-01',strtotime('-1 months'));?>",
            		"<?php echo date('Y-m-t',strtotime('-1 months'));?>"
        		]
    		},
    		
		    locale: {
		      format: 'YYYY-MM-DD'
		    },
		    startDate: '<?php echo date('Y-m-01');?>',
		    endDate: '<?php echo date('Y-m-t');?>'
		}, 
		function(start, end, label) {
		    //alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		    
		    $('#start_date').val(start.format('YYYY-MM-DD'));
       		
       		$('#end_date').val(end.format('YYYY-MM-DD'));
		});
		
		
		$("#table_export").tableHeadFixer({'left' : 7}); 
		
		$('#mass_submit').css('display','none');
		
			
 
		var datatable = $('#table_export,table.display').DataTable({
		       dom: '<Bf><"col-sm-12"rt><ip>',
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
		           "url": "<?php echo base_url();?>claims.php/partner/ajax_list",
		           "type": "POST",
		           "data": function(data){
		           		var x = $("#form-filter").serializeArray();

					    $.each(x, function(i, field){
					            data[field.name] = field.value;
					     });
		           }
		       },
		
		       //Set column definition initialisation properties.
		       "columnDefs": [
			       	{ 
			           "targets": [ 0 ], //first column / numbering column
			           "orderable": false, //set not orderable
			           "class": "details-control"
			       	},
			       	{ 
			           "targets": [2,6], //first column / numbering column
			           "orderable": false //set not orderable
			       	},
			       	{
                		"targets": [5,7,8,9,10,11,13,14,15,16,17,18,20,21,22,23,24],
                		"visible": false,
                		//"searchable": false,
                		"class": "hidden_column"
            		}
		       ]
		   });
		   
		   
		   
		  $('#btn-filter').click(function(){ //button filter event click
		        datatable.ajax.reload(null,false);  //just reload table
		    });
		    $('#btn-reset').click(function(){ //button reset event click
		        $('#form-filter')[0].reset();
		        datatable.ajax.reload(null,false);  //just reload table
		    });
		   
		   datatable.columns( '.hidden_column' ).visible( false );
		
		var detailRows = [];
 
	    $('#table_export tbody').on( 'click', 'tr td.details-control', function () {
	        var tr = $(this).closest('tr');
	        var row = datatable.row( tr );
	        var idx = $.inArray( tr.attr('id'), detailRows );
	 		//alert(idx);
	        if ( row.child.isShown() ) {
	            tr.removeClass( 'details' );
	            row.child.hide();
	            tr.removeClass('shown')
	 
	            // Remove from the 'open' array
	            detailRows.splice( idx, 1 );
	            
	            //Change fa-plus to fa-minus
	            //row.child.hide();
	        }
	        else {
	        	//alert(row.data());
	            tr.addClass( 'details' );
	            row.child( format( row.data() ) ).show();
	 			tr.addClass('shown');
	            // Add to the 'open' array
	            if ( idx === -1 ) {
	                detailRows.push( tr.attr('id') );
	            }
	            
	            //Change fa-plus to fa-minus
	            //row.child.hide();
	            
	        }
	    } );
	 
	    // On each draw, loop over the `detailRows` array and show any child rows
	    datatable.on( 'draw', function () {
	        $.each( detailRows, function ( i, id ) {
	            $('#'+id+' td.details-control').trigger( 'click' );
	        } );
	    } );
 
});


$('#mass_submit').click(function(e){
		
		var url = "<?php echo base_url();?>claims.php/medical/mass_submit_claims/";
		var postData;
		
		postData = new FormData();
 
    	
    	$('.chkbox').each(function(){
    		if($(this).is(':checked')){
    			postData.append( 'claim[]', $(this).attr('id'));
    		}
    	});
		
		$.ajax({
			url:url,
			type:"POST",
			data:postData,
			processData: false,
			contentType: false,
			success:function(data){
				alert(data);
				location.reload();
			},
			error:function(error){
				
			}
		});
		
		e.preventDefault();
	});
	
	$('#chkAll').click(function(){
		if($(this).is(':checked')){
			$('.chkbox').prop('checked',true);
		}else{
			$('.chkbox').prop('checked',false);
		}
		
		count_checked_boxes();
	});
	
	$('.chkbox').click(function(){
		count_checked_boxes();
		
	});

	function count_checked_boxes(){
		var cnt_checked = 0;
		$('.chkbox').each(function(){
			if($(this).is(':checked')){
				++cnt_checked;
			}
		});
		
		if(cnt_checked>0){
			$('#mass_submit').css('display','block');
		}else{
			$('#mass_submit').css('display','none');	
		}
	}
	
	function add_filter(){

		  $("#table_search tr").eq(1).clone().find(".form-control").each(function() {
		    $(this).attr({
		      //'id': function(_, id) { return id + i },
		      'name': function(_, name) { return name + [] }
		      //'value': ''               
		    });
		  }).end().appendTo("#table_search");
	}
	
	function remove_filter(el){
		if($('.filters').length>1){
			$(el).parent().parent().remove();
		}else{
			alert("At least one filter is required");
		}
	}
	
	function selected_option(el){
		
		//$(el).attr('name','fld_'+$(el).val());
		
		var sel = $(el).val();
		
		if(sel==="rmks"){
			$(el).parent().siblings(".val").html($("#status").html());
		}else if(sel==="facClass"){
			$(el).parent().siblings(".val").html($("#factype").html());
		}else if(sel==="date" || sel==="treatDate" || sel==="reinstatementdate" || sel === "stmp"){
			$(el).parent().siblings(".val").children(0).attr("readonly","readonly");
			$(el).parent().siblings(".val").children(0).datepicker({format: 'yyyy-mm-dd'});
		}else{
			$(el).parent().siblings(".val").html($("#default").html());
		}
		
		$(el).parent().siblings(".val").children(0).attr('name',$(el).val());
		
		$(el).parent().siblings(".val").children(0).attr('id',$(el).val());
	
	}
	
	$("#btn_search").click(function(ev){
		var url = $("#frm_search").attr('action')
		var postData = $("#frm_search").serializeArray();
		$.ajax({
			url:url,
			data:postData,
			type:"POST",
			success:function(data, textStatus, jqXHR) 
		        {
		         	$("#wrapper").html(data);   
		        },
		    error: function(jqXHR, textStatus, errorThrown) 
		        {
		            alert(textStatus+' - '+ errorThrown);      
		        }
		});
		ev.preventDefault();
	});
	
	$("#reset").click(function(ev){
		var url = "<?php echo base_url();?>claims.php/medical/reset_filter";
		
		$.ajax({
			url:url,
			success:function(data, textStatus, jqXHR) 
		        {
		         	$("#filters").html(data);   
		        }
		});
		
		ev.preventDefault();
	});
	
		   	
	
</script>

<div id="status" style="display: none;">
    <select class="form-control" name="">
    	<option value=""><?=get_phrase('select');?></option>
    	<option value="-1"><?=get_phrase('new');?></option>
    	<option value="15"><?=get_phrase('submitted');?></option>
    	<option value="2"><?=get_phrase('check_by_PF');?></option>
    	<option value="1"><?=get_phrase('declined_by_PF');?></option>
    	<option value="4"><?=get_phrase('processed_by_HS');?></option>
    	<option value="3"><?=get_phrase('declined_by_HS');?></option>
    	<option value="7"><?=get_phrase('paid');?></option>
    	<option value="-2"><?=get_phrase('reinstated_after_declined_by_PF');?></option>
    	<option value="-3"><?=get_phrase('reinstated_after_declined_by_HS');?></option>    
    	<option value="-4"><?=get_phrase('reinstated_after_Archive');?></option>  
    	<option value="-5"><?=get_phrase('all_reinstated');?></option>	
    	<option value="10"><?=get_phrase('archived');?></option>
    </select>
</div>


<div id="factype" style="display: none;">
    <select class="form-control" name="">
    	<option value=""><?=get_phrase('select');?></option>
    	<option value="public"><?=get_phrase('public');?></option>
    	<option value="private"><?=get_phrase('private');?></option>
    	<option value="missionary"><?=get_phrase('missionary');?></option>
    </select>
</div>


<div id="default" style="display: none;">
	<input type="text" class="form-control" name="" id=""/>
</div>
