	<hr />
		
		<div class="row">
			<div class="col-sm-12">
				<?php
					$this->benchmark->mark('code_end');
				
					echo "Page load time: ". $this->benchmark->elapsed_time('code_start', 'code_end')." seconds";
				
				?>
			</div>
		</div>

<!-- Footer -->
<footer class="main">
	&copy; 2017 <strong>Grants Manager</strong>. 
    Developed by 
	<a href="https://www.compassionkenya.com" 
    	target="_blank">Compassion Kenya</a>
</footer>
