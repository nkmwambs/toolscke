<?php
//$tym = strtotime('last day of last month',$tym); 

$tot_icps = $this->db->get_where('users',array('userlevel'=>'1','department'=>'0','cname!='=>'Kenya'))->num_rows();

$tot_mfr = $this->finance_model->count_mfr_submitted(date('Y-m-t',$tym));

$per = ($tot_mfr/$tot_icps)*100;

$tot_validated = $this->finance_model->count_validated_mfr(date('Y-m-t',$tym));

$per_validated = $tot_mfr == 0 ? 0 :($tot_validated/$tot_mfr)*100;

$month_start_date = date('Y-m-01',$tym);

$month_end_date = date('Y-m-t',$tym);

echo $month_start_date;

$total_dct_expense = $this->db->select_sum('Cost')->get_where('voucher_body',
array('TDate>='=>$month_start_date,'TDate<='=>$month_end_date))->row()->Cost;

$total_dct_beneficiaries = 0;

?>
<div class="row">
   <div class="col-sm-6">
   		<h3>
	  		<?php
	   			echo get_phrase('financial_reports').": ".date('F Y',$tym);
	   		?>
	   	</h3>
    </div>
     	
    <div class="col-sm-6">
       <div class="btn btn-default pull-right col-sm-6"><a href="#" class="fa fa-backward scroll" id="prev"></a> <?=get_phrase('you_are_in');?> <?=date('F Y',$tym);?> <input type="text" class="form-control col-sm-1" id="cnt" placeholder="<?=get_phrase('enter_number_of_months');?>"/> <a href="#" class="fa fa-forward scroll" id="next"></a></div>
    </div>
     	
</div>

<hr />
     	
<div class="row">
     <div class="col-sm-12">
     	<div class="row">
            <div class="col-md-3">
     			<div class="tile-stats tile-teal">
     				<div class="icon"><i class="fa fa-book"></i></div>
                    <div class="num" data-start="0" data-end="<?=number_format($per);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('submitted_reports');?></h3>
                   
        		</div>
        	</div>
        	
        	 <div class="col-md-3">
     			<div class="tile-stats tile-plum">
     				<div class="icon"><i class="fa fa-thumbs-up"></i></div>
                    <div class="num" data-start="0" data-end="<?=number_format($per_validated);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('validate_reports');?></h3>
                   
        		</div>
        	</div>

			<div class="col-md-3">
     			<div class="tile-stats tile-green">
     				<div class="icon"><i class="fa fa-money"></i></div>
                    <div class="num" data-start="0" data-end="<?=number_format($total_dct_expense);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('total_dct_expenses');?></h3>
                   
        		</div>
        	</div>

			<div class="col-md-3">
     			<div class="tile-stats tile-red">
     				<div class="icon"><i class="fa fa-user"></i></div>
                    <div class="num" data-start="0" data-end="<?=number_format($total_dct_beneficiaries);?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('total_dct_beneficiaries');?></h3>
                   
        		</div>
        	</div>
        	
        </div>
     </div>
</div>
                    	

    <script>
	$(document).ready(function(){
		var datatable = $('.table').DataTable({
			stateSave: true,
			"bSort" : false 
		});
	});	
		
	
	$('.scroll').click(function(ev){
	
	var cnt = $('#cnt').val();
	
	if(cnt===""){
		cnt = "1";
	}
	
	var dt = '<?php echo $tym;?>';
	
	var flag = $(this).attr('id');
	
	var url = '<?php echo base_url();?>ifms.php/mop/dashboard/'+dt+'/'+cnt+'/'+flag;
	
	$(this).attr('href',url);
});
  </script>

  
