<?php 
$list_of_fcps = [$this->session->center_id];
$reporting_month_stamp = $param2;

$dct_accounts = $this->dct_model->fcp_grouped_direct_cash_transfers($list_of_fcps,$reporting_month_stamp);
extract($dct_accounts['dct_records'][$this->session->center_id]);
//print_r($spread);
?>

<div class='row'>
    <div class='col-xs-12'>
    <?php echo form_open(base_url() . 'ifms.php/partner/financial_reports/save_dct_beneficiaries/'.$param2.'/'.$this->session->center_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
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
                                            <td><input type='number' class='form-control' value='0' required='required' /></td>
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