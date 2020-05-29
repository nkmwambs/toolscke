<?php

class Utility_forms{
	
	/**
	 * Requires select2 plugin and bootstrap 3
	 */
	
	private $fields = array();
	private $form_action = "";
	private $form_id = "frm";
	private $form_output_string = "";
	private $multi_column_table_id = 'tbl_multi_column';
	private $initial_row_count = 1;
	//private $row_values = array();
	/**
	 * full = Has both form opening and closing tags with a create button
	 * partial = Lack opening and closing tag and create button
	 */
	private $form_tag = 'full';
	
	function __construct(){
		
	}
	
	public function set_form_fields($form_elements=array()){
		
		/**
		 * For One Columned Form
		 * $fields[] = array(
		  'label'=>'Username',
		  'element'=>'input',
		  'properties' => array('name'=>'username','id'=>'username')
		 );
		 
		 $fields[] = array(
		  'label'=>'Password',
		  'element'=>'input',
		  'properties' => array('name'=>'password','id'=>'password')
		 );
		 
		 $fields[] = array(
		  'label'=>'Days Of Week',
		  'element'=>'select',
		  'properties' => array('name'=>'daysofweek','id'=>'daysofweek'),
		  'options' => array(	
		  						'day1'=>array('option'=>'Monday'),
		  						'day2'=>array('option'=>'Tuesday','properties'=>array('selected'=>'selected')),
		  						'day3'=>array('option'=>'Wednesday')
							)
		 );
		 * 
		 * For Multi columned form
		 * 
		 * 
		 * 
		 */
		 
		$this->fields = $form_elements;		
	}
	
	private function get_form_elements(){
		return $this->fields;
	}
	
	public function set_form_action($form_action=""){
		$this->form_action = $form_action;	
	}
	
	private function get_form_action(){
		return $this->form_action;	
	}
	
	public function set_form_id($form_id=""){
		$this->form_id = $form_id;
	}
	
	private function get_form_id(){
		return $this->form_id;
	}
	
	public function set_form_tag($form_tag = ""){
		$this->form_tag = $form_tag;
	}
	
	private function get_form_tag(){
		return $this->form_tag;
	}
	
	function set_initial_row_count($row_count = ""){
		$this->initial_row_count = $row_count;
	}
	
	private function get_initial_row_count(){
		return $this->initial_row_count;
	}
	
	// function set_row_values_array($multi_row_values = array()){
		// $this->row_values = $multi_row_values;
	// }
// 	
	// private function get_row_values_array(){
		// return $this->row_values;
	// }
	
	private function form_open_tag(){
		
		if($this->form_tag == 'full'){
			$this->form_output_string .= form_open($this->form_action, 
			array('id' => $this->form_id, 'class' => 'form-horizontal 
			form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
		}
		
		return $this->form_output_string;
	}
	
	private function form_close_tag(){
		
			if($this->form_tag == 'full'){
				$this->form_output_string .= "<div class='form-group'>
				<div class='col-xs-12'>
					<button type='submit' class='btn btn-default' id='btnCreate'>Save</button>
				</div>
			</div>";
			
			return $this->form_output_string;	
		}
	}

private function create_select_field($fields = array(),$cnt = 0){
			
		$additional_classes = "";
						
		if(array_key_exists('class', $fields['properties'])){
			$additional_classes = $fields['properties']['class'];
		}
		
		$this->form_output_string .= "<select class='form-control ".$additional_classes." '";
														
		foreach($fields['properties'] as $property=>$value){
			if(is_numeric($property)){
				$this->form_output_string .= " ".$value." = '".$value."' ";
			}else{
				$this->form_output_string .= " ".$property." = '".$value."' ";
			}
		}
					
		$this->form_output_string .= ">
		<option value=''>Select ... </option>";
						
			if(array_key_exists('options', $fields)){
				foreach($fields['options'] as $option_value=>$option){
					
					$this->form_output_string .="<option value='".$option_value."' ";

					if(isset($fields['values'][0]) && $option_value == $fields['values'][$cnt]){
						$this->form_output_string .= " selected = 'selected' ";	
					}
								
					if(array_key_exists('properties', $fields['options'][$option_value])){
						foreach($fields['options'][$option_value]['properties'] as $property=>$value){
							
							if(isset($fields['values']) && $value == 'selected') continue;
												
							if(is_numeric($property)){
								//For property array that is not associative
								$this->form_output_string .= " ".$value." = '".$value."' ";
							}else{
								//For associative property array
								$this->form_output_string .= " ".$property." = '".$value."' ";
							}			
						}
					}
		
									
				$this->form_output_string .= " '>".$option['option']."</option>";
				}
			}		
						
		$this->form_output_string .= "</select>";
		
		return $this->form_output_string;
	}
	
	private function create_input_field($fields = array(),$cnt = 0){
				
		$additional_classes = "";
						
		if(array_key_exists('class', $fields['properties'])){
			$additional_classes = $fields['properties']['class'];
		}
		
		$this->form_output_string .= "<input class='form-control ".$additional_classes."'";
						
		if(!array_key_exists('type', $fields['properties'])){
			$this->form_output_string .= "type='text'";
		}
						
		foreach($fields['properties'] as $property=>$value){
			
			if(isset($fields['values'])){
				
				$this->form_output_string .= " value = '".$fields['values'][$cnt]."' ";
				
				if($property == 'value') continue;
				
			}
			
			if(is_numeric($property)){
				$this->form_output_string .= " ".$value." = '".$value."' ";
			}else{
				$this->form_output_string .= " ".$property." = '".$value."' ";
			}
			
		} 
						
		$this->form_output_string .= "' />";
		
		return $this->form_output_string;
	}
	
	function create_single_column_form(){
		
		if($this->form_output_string!=="") $this->form_output_string = "";
		
		$this->form_open_tag();
		
		
		foreach($this->fields as $fields){
			$this->form_output_string .= "<div class='form-group'>
				<label class='control-label col-xs-4'>".$fields['label']."</label>
				<div class='col-xs-8'>";
					
					$additional_classes = "";
						
					if(array_key_exists('class', $fields['properties'])){
						$additional_classes = $fields['properties']['class'];
					}
					
					if($fields['element'] == 'input'){
						$this->create_input_field($fields);
					}elseif($fields['element'] == 'select'){
						$this->create_select_field($fields);
					}
					
				$this->form_output_string .= "</div>
			</div>";
		}
		

			
		$this->form_close_tag();	
			
		$this->form_output_string .= form_close();
		
		$this->form_output_string .= $this->jquery_script();	
		
		$this->form_output_string .= $this->style_script();
		
		return $this->form_output_string;
	}

	public function create_multi_column_form(){
		
		if($this->form_output_string!=="") $this->form_output_string = "";
		
		$this->form_open_tag();
		
		$this->form_output_string .= '<ul class="nav nav-pills">
										<li>
											<a id="add_row" class="btn btn-default">Add Row</a>	
										</li>
										<li>
											<a id="btnDelRow" class="btn btn-default hidden">Remove Rows</a>	
										</li>
										<li>
											<a id="btnBack" onclick="go_back();" class="btn btn-default">Back</a>	
										</li>
									</ul><hr />';
									
									
		$this->form_output_string .= "<table class='table table-striped' id='tbl_multi_column'>
			<thead><tr>
			<th>Action</th>";
				foreach($this->fields as $headers){
					$this->form_output_string .= "<th>".$headers['label']."</th>";
				}
		$this->form_output_string .= "</tr></thead>
		<tbody>";
		
		for($i=0;$i<$this->get_initial_row_count();$i++){
			
			$this->form_output_string .= "<tr class='tr_clone'>
			<td><input type='checkbox' id='' class='check' /></td>";
			
			
			foreach($this->fields as $fields){
				$this->form_output_string .= "<td>";
				if($fields['element'] == 'select'){
					
					$this->create_select_field($fields,$i);
				
				}elseif($fields['element'] == 'input'){
					$this->create_input_field($fields,$i);
				}
				
				$this->form_output_string .= "</td>";
				
				
			}
			
			$this->form_output_string .= "</tr>";
			
		}	
		
		$this->form_output_string .= "</tbody>
		</table>";							
										
		
		$this->form_close_tag();
		
		$this->form_output_string .= $this->jquery_script();	
		
		$this->form_output_string .= $this->style_script();
		
		return $this->form_output_string;
	}

	private function jquery_script(){
		
		$output_string = '<script>
				
				function go_back(){
					window.history.back();
				}
				
				$("#add_row").on("click",function(){
					clone_last_body_row("'.$this->multi_column_table_id.'","tr_clone");
				});
				
				$(document).on("click",".check",function(){
					show_hide_delete_button_on_check("check","btnDelRow");
				});
				
				$("#btnDelRow").click(function(){
					remove_selected_rows("'.$this->multi_column_table_id.'","btnDelRow","check");
				});
				
				
				$("#resetBtn").on("click",function(){
					remove_all_rows("'.$this->multi_column_table_id.'");
					$(".resetable").val(null);
				});
				
				function clone_last_body_row(table_id,row_class){
					var $tr    = $("#"+table_id+" tbody tr:last").closest("."+row_class);
					var $clone = $tr.clone();
					$clone.find(":checkbox").removeAttr("disabled");
					$clone.find("input[readonly!=readonly]:text").val(null);
					$tr.after($clone);
				}
	
				
				function remove_all_rows(tbl_id,td_hosting_checkbox_postion){
					if (td_hosting_checkbox_postion === undefined) {
				        td_hosting_checkbox_postion = 0;
				    }
					 $("#"+tbl_id+" tbody").find("tr:gt(0)").remove();
					 
					 var elem = $("select,input");
					 
					 //Clear values elements that are not readonly or disabled
					 $.each(elem,function(){
					 	if($(this).is("[readonly]") == false && $(this).is("[disabled]")== false)
					    {
					      $(this).val(null);
					    }
					 });
					
					 //Uncheck the check box of the first row
					 $("#"+tbl_id+" tbody").find("tr:eq(0) td:eq("+td_hosting_checkbox_postion+")").children().prop("checked",false);		 
				}
				
				function show_hide_delete_button_on_check(checkbox_class,delete_button_id){
					var checked = $("."+checkbox_class+":checked").length;
					if(checked>0){
						$("#"+delete_button_id).removeClass("hidden");	
					}else{
						$("#"+delete_button_id).addClass("hidden");
					}
				}
				
				function remove_selected_rows(tbl_id,action_btn_id,checkbox_class){
					var elem = $("#"+tbl_id+" tbody");
					
					$("."+checkbox_class).each(function(){
						if($(this).is(":checked")){
							if(elem.children().length > 1){
								$(this).closest("tr").remove();//Replaced .parent().parent() to .closest()
							}else{
								alert("You need atleast one row in the table");
								
								//Uncheck the check box of the first row
								$("#"+tbl_id+" tbody").find("tr:eq(0) td:eq("+td_hosting_checkbox_postion+")").children().prop("checked",false);
							}
						}
						
						var checked = $(".check:checked").length;
						if(checked>0){
							$("#"+action_btn_id).removeClass("hidden");	
						}else{
							$("#"+action_btn_id).addClass("hidden");
						}
					});		
				}
				
					$("#btnCreate").on("click",function(ev){
						
						var url = $("#'.$this->form_id.'").attr("action");
						var data = $("#'.$this->form_id.'").serializeArray();
						
						$.ajax({
							url:url,
							data:data,
							type:"POST",
							beforeSend:function(){
								$("#overlay").css("display","block");
							},
							success:function(resp){
								alert(resp);
								$("#overlay").css("display","none");
								//remove_all_rows("tbl_subjects");
								go_back();
							},
							error:function(){
								alert("Error Occurred");
							}
						});
						
						ev.preventDefault();
					});
				
		</script>';
		
		return $output_string;
	}

	private function style_script(){
		$output_string = '<style>
				#overlay {
				    position: fixed; /* Sit on top of the page content */
				    display: none; /* Hidden by default */
				    width: 100%; /* Full width (cover the whole page) */
				    height: 100%; /* Full height (cover the whole page) */
				    top: 0; 
				    left: 0;
				    right: 0;
				    bottom: 0;
				    background-color: rgba(0,0,0,0.5); /* Black background with opacity */
				    z-index: 2; /* Specify a stack order in case you\'re using a different order for other elements */
				    cursor: pointer; /* Add a pointer on hover */
				}
				
				#overlay img{
					display: block;
					margin-top:25%;
					margin-left: auto;
				    margin-right: auto;
				} 
				</style>';
				
		$output_string .= '<div id="overlay"><img src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif"/></div>';		
				
		return $output_string;			
	}
	
}
