<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div class="row">
	<div class="col-sm-12">
		<?php 
			echo form_open(base_url() . 'exams.php/partner/kcpe/', array('id'=>'frm_user_add','class' => 'form-horizontal form-groups-bordered validate',"autocomplete"=>"off",'enctype' => 'multipart/form-data'));
		?>
						
			<div id="_acYr" class="form-group">
				<label for="" class="col-xs-4 control-label"><?php echo get_phrase('academic_year');?></label>
					<div class="col-xs-6">
						<select class="form-control" name="acYr" id="acYr">
							<option><?=get_phrase('select');?></option>
							<?php
								$yrs = $this->db->select('DISTINCT(acYr)')->get_where('kcpe',array("pNo"=>$this->session->center_id))->result_object();
								
								foreach($yrs as $row):
									if($row->acYr > 0){
							?>
								<option value="<?=$row->acYr;?>"><?=$row->acYr;?></option>
								
							<?php
									}
								endforeach;
							?>
								<option value="<?=date('Y')?>"><?=date('Y')?></option>
						</select>
					</div>
					<div class="col-xs-2">
						<button class="btn btn-primary"><?=get_phrase('search');?></button>
					</div>	
			</div>
		</form>	
						
	</div>
</div>
<hr />
<div class="row">
	<div class="col-sm-12">
		<?php echo $output; ?>
	</div>
</div>
 
 
<script>

$(document).ready(function(){
	$('#field-childName').prop('readonly',true);
	$('#field-totMrk').prop('readonly',true);
	$('#field-dob').prop('readonly',true);
	$('#field-sex').prop('readonly',true);
	
	$.each($('input:text'),function(i,el){
		if(i>6 && i< 13){
			$(el).val('0');
		}
	});
});


$('input:text').change(function(){
	var totMrks = 0;
	
	$.each($('input:text'),function(i,el){
		if(i>6 && i< 12){
			totMrks+=parseInt($(el).val());
		}
	});
	
	$('#field-totMrk').val(totMrks);	
	
});

$('#field-childNo').focus(function(){
	$('#field-childNo').val("");
	$('#field-dob').val("");
	$('#field-sex').val("");
	$('#field-childName').val("");
});

$('#field-childNo').change(function(){
		
		var benNo = $('#field-childNo').val();
		
		if($('#field-childNo').val().length === 1){
			
			$('#field-childNo').val('<?=$this->session->center_id;?>-000'+benNo);
			
		}else if($('#field-childNo').val().length === 2){
			
			$('#field-childNo').val('<?=$this->session->center_id;?>-00'+benNo);
		
		}else if($('#field-childNo').val().length === 3){
			
			$('#field-childNo').val('<?=$this->session->center_id;?>-0'+benNo);
		
		}else{
		
			$('#field-childNo').val('<?=$this->session->center_id;?>-'+benNo);
		}
		
		var url = '<?=base_url();?>exams.php/partner/get_childNo/'+benNo;
		
		$.ajax({
			url:url,
			success:function(response){
				var obj = JSON.parse(response);
				
				$('#field-childName').val('Name Not Found');
				//alert(response);
				if(typeof obj =='object'){
					$('#field-childName').val(obj.childName);
					$('#field-dob').val(obj.dob);
					$('#field-sex').val(obj.sex);
				}
				
			}
		});
	});
	
	
</script> 

 