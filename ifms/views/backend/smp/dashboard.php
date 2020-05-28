<?php
//$tym = strtotime('last day of last month',$tym); 

// $tot_icps = $this->db->get_where('users',array('userlevel'=>'1','department'=>'0','cname!='=>'Kenya'))->num_rows();

// $tot_mfr = $this->finance_model->count_mfr_submitted(date('Y-m-t',$tym));

// $per = ($tot_mfr/$tot_icps)*100;

// $tot_validated = $this->finance_model->count_validated_mfr(date('Y-m-t',$tym));

// $per_validated = ($tot_validated/$tot_mfr)*100;

print_r($regions);
echo('<br>');

echo('<br>');

print_r($clusters);

echo $this->session->cluster;

?>

<style>
.remove_decoration{
	text-decoration: none;
}
</style>
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
     			<div class="tile-stats tile-red">
     				<div class="icon"><i class="fa fa-book"></i></div>
					<div class="num" data-start="0" data-end="<?=$total_dct_expense;?>" 
					
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('total_dct_expense');?></h3>
                   
        		</div>
        	</div>
        	
        	 <div class="col-md-3">
				 <a href="#" class="remove_decoration">
     			<div class="tile-stats tile-red">
     				<div class="icon"><i class="fa fa-book"></i></div>
                    <div class="num" data-start="0" data-end="<?=$total_dct_beneficiaries;?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>% <?=get_phrase('total_dct_beneficiaries');?></h3>
                   
				</div>
				</a>
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
	
	var url = '<?php echo base_url();?>ifms.php/smp/dashboard/'+dt+'/'+cnt+'/'+flag;
	
	$(this).attr('href',url);
});
  </script>

  
