<?php 
$list_of_fcps = [$this->session->center_id];
$reporting_month_stamp = $param2;

$dct_accounts_and_spread = $this->dct_model->fcp_grouped_direct_cash_transfers($list_of_fcps,$reporting_month_stamp);
extract($dct_accounts_and_spread['dct_records'][$this->session->center_id]);

$dct_account_account_no_and_text = $this->dct_model->get_account_no_and_text($dct_accounts_and_spread['dct_accounts']);
$beneficiary_counts = $this->dct_model->get_beneficiary_counts($reporting_month_stamp,$dct_account_account_no_and_text);

//print_r($this->dct_model->validate_if_beneficiary_count_not_required($reporting_month_stamp));
?>

<div class='row'>
    <div class='col-xs-12'>
    <?php echo form_open(base_url() . 'ifms.php/partner/save_dct_beneficiaries/'.$param2 , array('id'=>'frm_dct_beneficiaries','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
			<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('DCT_beneficiaries');?>
            	</div>
            </div>
			<div class="panel-body"  style="max-width:50; overflow: auto;">	
                <div class='form-group'>
                    <div class='col-xs-12'>
                        <table class='table table-striped datatable'>
                            <thead>
                                <tr>
                                    <th><?=get_phrase('account_number');?></th>
                                    <th><?=get_phrase('amount_spent');?></th>
                                    <th><?=get_phrase('number_beneficiaries');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($spread as $dct_account => $amount){?>
                                        <tr>
                                            <td><?=$dct_account;?></td>
                                            <td><?=$amount;?></td>
                                            <td><input type='number' class='form-control' value='<?=$beneficiary_counts[$dct_account_account_no_and_text[$dct_account]];?>' required='required' name='<?=$dct_account_account_no_and_text[$dct_account];?>' /></td>
                                        </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                    <tr>
                                        <th><?=get_phrase('total');?></th>
                                        <th><?=number_format($total_dct_expense,2);?></th>
                                        <th>&nbsp;</th>
                                    </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class='form-group'>
                    <div class='col-xs-12'>
                        <div class='btn btn-default' id='btn_submit'><?=get_phrase('save');?><div>
                    </div> 
                </div>

                
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    $("#btn_submit").on('click',function(){
        var data = $('#frm_dct_beneficiaries').serializeArray();
        var url = $('#frm_dct_beneficiaries').attr('action');

        $.post(url,data,function(response){
            alert(response);
        });
    }); 
</script>