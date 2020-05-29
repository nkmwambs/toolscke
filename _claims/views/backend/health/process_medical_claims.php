<hr />

<div id="process_panel"></div>	

<div class="row">
	<div class="col-xs-12" style="text-align: center;">
		<div class="btn btn-default fa fa-refresh" id="refresh"></div>
	</div>
</div>
	
<script>
	
	$(document).ready(function(){
		var url = "<?=base_url();?>claims.php/health/update_processing/";
		
		$.ajax({
			url:url,
			success:function(resp){
				$("#process_panel").html(resp);
				$("#overlay").css('display','none'); 
			}
		});
		
	});
	
	
	$("#refresh").on('click',function(){
		
		var url = '<?=base_url();?>claims.php/health/update_processing'
		
		$.ajax({
			url:url,
			success:function(resp){
				$("#process_panel").html(resp);
				$("#overlay").css('display','none'); 
			}
		});
		
	});
</script>