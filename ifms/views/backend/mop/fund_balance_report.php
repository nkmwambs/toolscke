<?php

//print_r($this->finance_model->months_expense_per_revenue_account_for_centers('2015-10-31'));
//print_r($revenue_accounts);
//print_r($result);

//echo count($this->uri->segment_array());

?>

<hr/>

<div class="row">
	
		<div class="col-xs-4">
		
			<a href="#" id='btn_last_month' class='btn btn-success pull-left'><i class='fa fa-angle-left'></i> Previous Month</a>
			
		</div>
		
	   <div class="col-xs-4" style="text-align: center;">
			<span><h4><?php echo date('F Y', $month); ?></h4> </span>
			
	   </div>
	   	<div class="col-xs-4">
			
			<a id='btn_next_month' href="#" class='btn btn-success pull-right'>Next Month <i class='fa fa-angle-right'></i></a>
			
		</div>
	
	
</div>

<hr/>

<div class='row'>
    <form action='<?=base_url();?>ifms.php/readonly/fund_balance_report/<?=$month;?>/' method='post'>
        <div class='col-xs-10'>
            <select class='form-control' name='balance_type' id="balance_type">
                <option value=''><?=get_phrase('select_balance_type');?></option>
                <option value='revenue_account_opening_balance' <?php if($balance_type=='revenue_account_opening_balance') echo "selected";?> ><?=get_phrase('revenue_account_opening_balance_report');?></option>
                <option value='revenue_account_income'  <?php if($balance_type=='revenue_account_income') echo "selected";?> ><?=get_phrase('revenue_account_income_report');?></option>
                <option value='revenue_account_expense'  <?php if($balance_type=='revenue_account_expense') echo "selected";?> ><?=get_phrase('revenue_account_expense_report');?></option>
                <option value='revenue_account_closing_balance'  <?php if($balance_type=='revenue_account_closing_balance') echo "selected";?> ><?=get_phrase('revenue_account_closing_balance_report');?></option>
            </select>
        </div>
        <div class='col-xs-2'>
            <button type='submit' id='run_report' class='btn btn-default'><?=get_phrase('run_report');?></button>
        </div>
    </form>
</div>

<hr/>

<table class='table table-striped datatable'>
    <thead>
     <tr>
        <th><?=get_phrase('centers');?></th>
        <?php foreach($revenue_accounts as $revenue_account){?>
            <th onmouseover="get_account_title(this);" id="<?=$revenue_account;?>" title="">R<?=$revenue_account;?></th>
        <?php }?>
     </tr>
    </thead>
    <tbody>
    <?php foreach($result as $fcp_id => $center_fund_record){?>
        <tr>
            <td><?=$fcp_id;?></td>
            <?php foreach($revenue_accounts as $revenue_account){?>
                <td><?=isset($center_fund_record[$revenue_account][$balance_type])?number_format($center_fund_record[$revenue_account][$balance_type],2):0.00;?></td>
            <?php }?>
        </tr>
    <?php }?>
    </tbody>
</table>

<script>
jQuery(document).ready(function($) {

    var datatable = $(".datatable").dataTable({
        dom : 'lBfrtip',
        buttons : ['pdf', 'csv', 'excel', 'copy'],
        lengthMenu: [[25,50, 100, 150,-1], [25,50 ,100,150 ,"All"]],
        pageLength: 25
    });

    $(".dataTables_wrapper select").select2({
        minimumResultsForSearch : -1
    });
});

function get_account_title(elem){
    var id = $(elem).attr('id');

    //$(elem).prop('title',$(elem).attr('id'));

    var url = "<?=base_url();?>ifms.php/accountant/get_account_title";
    var data = {'account_number':id};

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        beforeSend:function(){
            $(elem).prop('title',"Loading ...");
        },
        success:function(response){
            $(elem).prop('title',response);
        },
        error:function(error){
            alert('Error occurred!');
        }
    });
}

$('#btn_last_month ,#btn_next_month').on('click',function(ev){
	
	if($(this).attr('id')=='btn_last_month')
	{
		 var href='<?=base_url();?>ifms.php/readonly/fund_balance_report/<?=strtotime('last day of previous month',$month);?>';
		 
		 window.location.href=href;
	}
	else
	{
		var href='<?=base_url();?>ifms.php/readonly/fund_balance_report/<?=strtotime('last day of next month',$month);?>';
		 
		 window.location.href=href;
	}
	
	ev.preventDefault();
	
});

$("#run_report").on('click',function(ev){
    
    var href='<?=base_url();?>ifms.php/readonly/fund_balance_report/<?=$month;?>/'+$("#balance_type").val();
    
    window.location.href=href;
    ev.preventDefault();
});
</script>