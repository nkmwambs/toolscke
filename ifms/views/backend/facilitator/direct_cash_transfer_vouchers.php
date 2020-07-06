<?php 
//print_r($direct_cash_transfer_vouchers);
?>

<div class='row'>
    <div class='col-xs-12'>
        <table class='table table-striped datatable'>
            <thead>
                <tr>
                    <th><?=get_phrase('voucher_number');?></th>
                    <th><?=get_phrase('voucher_type');?></th>
                    <th><?=get_phrase('voucher_amount');?></th>
                    <th><?=get_phrase('support_documents');?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($direct_cash_transfer_vouchers as $direct_cash_transfer_voucher){?>
                    <tr>
                        <td><a class='btn btn-default' href="#" onclick="showAjaxModal('<?=base_url();?>ifms.php/modal/popup/modal_view_voucher/<?=$direct_cash_transfer_voucher['hID'];?>');" ><?=$direct_cash_transfer_voucher['VNumber'];?></a></td>
                        <td><?=$direct_cash_transfer_voucher['VType'];?></td>
                        <td><?=$direct_cash_transfer_voucher['Cost'];?></td>
                        <td>
                            <?php 
                            $path = 'uploads/dct_documents/'.$fcp.'/'.date('Y-m',$tym).'/'.$direct_cash_transfer_voucher['VNumber'].'/';

                            if(file_exists($path) && (new \FilesystemIterator($path))->valid() ){?>
                            
                                <a href='<?php echo base_url();?>ifms.php/facilitator/dct_documents_download/<?= $fcp;?>/<?=$tym;?>/<?=$direct_cash_transfer_voucher['VNumber'];?>' ><?=get_phrase('download_documents');?></a>
                            <?php }else{?>
                                <span><?=get_phrase('missing_documents');?></span>
                            <?php }?>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('.datatable').DataTable();
</script>