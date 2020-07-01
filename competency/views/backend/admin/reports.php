<?php 
$benchmark_id = $this->uri->segment(3, 0);
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
 
<hr />
<div class="row">
	<div class="col-sm-12">
        <a href='<?php echo site_url('admin/dashboard')?>'><?=get_phrase('dashboard');?></a> | 
        <a href='<?php echo site_url('admin/benchmarks')?>'><?=get_phrase('benchmarks');?></a> |


 
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
		$('#field-benchmark_id').val('<?=$benchmark_id;?>');
	});
</script>

 
