
				<option value="">Select Field</option>
				<?php 
					foreach($fields as $row){
				?>
				<option value="<?=$row;?>"><?=get_phrase($row);?></option>
				<?php 
					}
				?>

