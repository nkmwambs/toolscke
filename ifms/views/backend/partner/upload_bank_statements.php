<div class="btn btn-primary" id="monkey">Monkey Modal</div>

<script>
	$('#monkey').click(function(){
		
		var opts = {
				title:'Greetings',
            	message: 'Hi Apple!',
            	buttons:[
            		{
            			label:'Label 1',
            			action:function(dialog){
            				dialog.setTitle('Checking....');
            			}
            		},
            		{
            			label:'Label 2',
            			action:function(dialog){
            				dialog.setTitle('Encouragement');
            			}
            		}
            	]
        	}
		
		BootstrapDialog.show(opts);
	});
		
	
</script>