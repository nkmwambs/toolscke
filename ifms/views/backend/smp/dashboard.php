<?php

//print_r($total_dct_expense);
// //print_r($regions);
// echo('<br>');

// echo('<br>');

print_r($clusters);
echo '<br>';
echo '<br>';
$array=[];
$last_arr=[];
//$test_arr=[];
foreach($clusters as $cluster){
	

	$array[$cluster['region']][$cluster['AccText']]=$cluster['Cost'];
	//$test_arr[$cluster['region']][]=$cluster;
	//$cluster['region'][$cluster['AccText]']]=$cluster['Cost'];


	//$array=$cluster['region'][$cluster['AccText]']];
}
foreach($array as $key=>$arr){
	$last_arr[$key]=array_sum($arr);
	

}
print_r($array);
echo '<br>';
echo '<br>';
print_r($last_arr);
// echo '<br>';
// echo '<br>';
// print_r($test_arr);


//echo $this->session->cluster;

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
     			<div class="tile-stats tile-red">
					 <div class="icon"><i class="fa fa-book"></i></div>
					 <div class="num" data-start="0" data-end="<?=$total_dct_expense;?>" 
					
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?=get_phrase('total_dct_expense');?></h3>
                   
        		</div>
        	</div>
        	
        	 <div class="col-md-3">
				 <a href="#"  style="text-decoration: none;">
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

  
