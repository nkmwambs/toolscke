<?php
//print_r($fcps);

?>
<div class='row'>
    <div class='col-xs-12'>
        <table class='table table-striped datatable'>
            <thead>
                <tr>
                    <th><?=get_phrase('fcp_number');?></th>
                    <th><?=get_phrase('month_direct_cash_transfers');?></th>
                    
                    <?php foreach($direct_cash_transfers['dct_accounts'] as $account){?>
                        <th><?=$account;?></th>
                    <?php }?>

                </tr>
            </thead>
            <tbody>
            
            <?php foreach($direct_cash_transfers['dct_records'] as $fcp_number => $fcp_record){?>
                <tr>
                    <td><?=$fcp_number;?></td>
                    <td><a target='__blank' href='<?php echo base_url();?>ifms.php/facilitator/direct_cash_transfer_vouchers/<?=$tym;?>/<?=$fcp_number;?>' class='btn btn-default'><i class='fa fa-eye'></i></a> <?=number_format($fcp_record['total_dct_expense'],2);?> </td>
                    
                    <?php foreach($direct_cash_transfers['dct_accounts'] as $account){?>
                        <td><?=number_format($direct_cash_transfers['dct_records'][$fcp_number]['spread'][$account]??0,2);?></td>
                    <?php }?>

                </tr>
            <?php }?>

            </tbody>
        </table>
    </div>
</div>

<script>
    $('.datatable').DataTable();
</script>