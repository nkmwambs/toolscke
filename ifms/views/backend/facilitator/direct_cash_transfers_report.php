<?php
//print_r($direct_cash_transfers);

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
            
            <?php 
                $sum_dct_amount = 0;
                $account_sum = [];
                foreach($direct_cash_transfers['dct_records'] as $fcp_number => $fcp_record){?>
                <tr>
                    <td><?=$fcp_number;?></td>
                    <?php 
                        $dct_amount = $fcp_record['total_dct_expense'];
                        $sum_dct_amount += $dct_amount;
                    ?>
                    <td><a target = '_blank' href='<?php echo base_url();?>ifms.php/facilitator/direct_cash_transfer_vouchers/<?=$tym;?>/<?=$fcp_number;?>' class='btn btn-default'><i class='fa fa-eye'></i></a> <?=number_format($dct_amount,2);?> </td>
                    
                    <?php
                         
                        foreach($direct_cash_transfers['dct_accounts'] as $account){?>
                        <td><?php
                            $account_dct_amount = $direct_cash_transfers['dct_records'][$fcp_number]['spread'][$account]??0;
                            $account_sum[$account][] = $account_dct_amount;
                            echo number_format($account_dct_amount,2);
                        ?></td>
                    <?php }?>

                </tr>
            <?php }?>

            </tbody>
            <tfoot>
                <tr>
                    <td><?=get_phrase('total');?></td>
                    <td style='font-weight:bold;'><?=number_format($sum_dct_amount,2);?></td>
                    <?php foreach($direct_cash_transfers['dct_accounts'] as $account){?>
                        <td style='font-weight:bold;'><?=number_format(array_sum($account_sum[$account]),2);?></td>
                    <?php }?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $('.datatable').DataTable();
</script>