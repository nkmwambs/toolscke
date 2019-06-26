$(document).ready(function(){
		var datatable = $("#ifms_journal_view").DataTable(
		{
				"ordering": false,
		        dom: 'Blftip',
		        stateSave: true,
		        "scrollX": true,
		        buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdfHtml5'
		        ]
		    }
	);
	
	$("#select_btn").click(function(){
		
		if($(".check_voucher:checked").length === 0){
			$(".check_voucher").prop("checked",true);
		}else{
			$(".check_voucher").prop("checked",false);
		}
		
		
	});	
    
    
});
