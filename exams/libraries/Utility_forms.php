<?php
/**
 * 
 * THIS LIBRARY WAS DEVELOPED TO BE USED TO CREATE FORMS IN THE FLY
 * IT IS CAPABLE OF CREATING 2 TYPE OF FORMS THATS IS SINGLE COLUMNED AND
 * MULTI COLUMNED FORM.
 * 
 * IN ORDER TO RUN WELL BOOSTRAP 3 AND JQUERY 2.X SHOULD HAV BEEN INSTALLED
 * IN THE APPLICATION INTENDED TO BE USED.
 * 
 * THIS IS A CODEIGNITER LIBRARY BUILT WITH CODEIGNITER 3.6
 * 
 * 
 * 	@author Nicodemus Karisa Mwambire
 * 	@copyright Compassion Internation Kenya (c) 2019
 *	@package Toolkit
 * 	@version 2019.01.01
 * 	@license https://www.compassion-africa.org/software/license/utility_forms.txt
 * 
 */
 
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility_forms{
	
	/**
	 * Form Fields
	 * 
	 * 
	 * A collection of array elements representing each field in a form group for
	 * single columned forms on a the first row and headers for multi columed
	 * form
	 * 
	 * @var Array
	 * 
	 */
	private $fields = array();
	
	/**
	 *
	 * Form Action
	 * 
	 *This is the value of the action property of the form.
	 * 
	 * @var String
	 *  
	 */
	 
	private $form_action = "";
	
	/**
	 *
	 * Form ID
	 * 
	 * This holds the form's id property. If not provided it is defaulted
	 * to frm
	 * 
	 * @var String
	 *  
	 */
	 
	private $form_id = "frm";
	
	/**
	 * 
	 * Form Output String
	 * 
	 * The whole form is assigned to this variable as plain string.
	 * When echoed the form gets created.
	 * 
	 * @var String
	 * 
	 */
	
	private $form_output_string = "";
	
	/**
	 * 
	 * Multi Column Table ID
	 * 
	 * This is the id ot the multi columned form. It hold the rows of the form.
	 * If not prodived it defaults to tbl_multi_column
	 * 
	 * @var String
	 * 
	 */
	 
	private $multi_column_table_id = 'tbl_multi_column';
	
	/**
	 * 
	 * Initial Row Count
	 * 
	 * This property when set atomatically creates rows equal to the value assigned.
	 * By default it has a value of 1, so only one row will be created.
	 * 
	 * @var Integer
	 * 
	 */
	
	private $initial_row_count = 1;
	
	/**
	 * 
	 * Form Tag
	 * 
	 * The form tag property help in setting whether the fields ought to be encapsulated 
	 * in a form tag of not. By default it is set to true to mean that the form elements
	 * are within a form tag otherwise the value should be false to strip off the form
	 * form elements from the form tag 
	 * 
	 * @var Boolean
	 * 
	 */
	
	private $use_form_tag = true;
	
	private $CI;
	
	function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->helper('url');
		$this->CI->load->helper('form');
	}
	
	/**
	 * 
	 * Set Form Fields
	 * 
	 * @param Array form_elements 
	 * 
	 * This is public setter that enables to set the value of fields propoerty of this
	 * class.
	 * 
	 * The fields property is of array type. This is a multi dimensional array with 
	 * numeric outer keys. The inner arrays are associative arrays with the following 
	 * mandatory keys: label and element. Other fields are properties, a key that hold 
	 * an associative array of keys being the name of the form field propoerty and its 
	 * value e.g. name=>'username', options for select elements which holds an 
	 * associative array of options values as keys and its values an array with 2 keys 
	 * option equaling to option inner html and properties, an associtive array of option
	 * tag properties. The key values is a special propperty of fields that holds an array 
	 * of values which represent dafault values of elements. 
	 * 
	 * 
	 *   $fields[] = array(
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
	 * 
	 * @return Void
	 * 
	 */
	
	public function set_form_fields($form_elements=array()){
		 
		$this->fields = $form_elements;		
	}
	
	/**
	 * 
	 * Get Form Elements
	 * 
	 * This returns an array of the form elements
	 * 
	 * @return Array
	 * 
	 */
	
	private function get_form_elements(){
		return $this->fields;
	}
	
	/**
	 * 
	 * Set Form Action
	 * 
	 * @param String form_action
	 * 
	 * This method set the form' action property.
	 * 
	 * @return Void
	 * 
	 */
	
	public function set_form_action($form_action=""){
		$this->form_action = $form_action;	
	}
	
	/**
	 *Get Form Action 
	 * 
	 * The method returns the action of the form
	 * 
	 * @return String
	 */
	
	private function get_form_action(){
		return $this->form_action;	
	}
	
	
	/**
	 * Set Form ID
	 * 
	 * @param String form_id
	 * 
	 * Sets the ID of the form
	 * 
	 * @return Void
	 */
	
	public function set_form_id($form_id=""){
		$this->form_id = $form_id;
	}
	
	/**
	 * Get form ID
	 * 
	 * Returns the ID of the form
	 * 
	 * @return String
	 */
	
	private function get_form_id(){
		return $this->form_id;
	}
	
	/**
	 * Set form tag
	 * 
	 * @param String use_form_tag
	 * 
	 * Set to true if tag is to be used to false
	 * 
	 * @return Void
	 */
	
	public function set_use_form_tag($use_form_tag = ""){
		$this->use_form_tag = $use_form_tag;
	}
	
	/**
	 * Get Form Tag
	 * 
	 * Return true if form tags is to be used to false if not
	 * 
	 * @return Boolean
	 */
	
	private function get_use_form_tag(){
		return $this->use_form_tag;
	}
	
	/**
	 * Set Initial Row Count
	 * 
	 * Set the number of default rows in a multi columned form.
	 * 
	 * @return Void
	 */
	
	function set_initial_row_count($row_count = ""){
		$this->initial_row_count = $row_count;
	}
	
	/**
	 * Get Initial Row Count
	 * 
	 * This method returns the number of default rows in a multi columned
	 * form. The default value of initial row count is 1.
	 * 
	 * @return Integer
	 */
	
	private function get_initial_row_count(){
		return $this->initial_row_count;
	}
	
	/**
	 * Form Open Tag
	 * 
	 * This method form_output_string to form opening tag. It uses the codeigniter
	 * form_open tag. The form is set to allow multi form data.
	 * 
	 * @return String
	 */
	
	private function form_open_tag(){
		
		if($this->use_form_tag == true){
			$this->form_output_string .= form_open($this->form_action, 
			array('id' => $this->form_id, 'class' => 'form-horizontal 
			form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
		}
		
		return $this->form_output_string;
	}
	
	/**
	 * Form Close Tag
	 * 
	 * Returns the form close tag
	 * 
	 * @return String
	 */
	
	private function form_close_tag(){
		
			if($this->use_form_tag == true){
				
				$this->form_output_string .= form_close();
				
				$this->form_output_string .= "<div class='form-group'>
				<div class='col-xs-12'>
					<button type='submit' class='btn btn-default' id='btnCreate'>Save</button>
				</div>
			</div>";
			
			return $this->form_output_string;	
		}
	}
	
/**
 * Create Select Field
 * 
 * Renders a select form element
 * 
 * @return String
 */	

private function create_select_field($fields = array(),$cnt = 0){
		
		/**
		 * Additonal classes are other classes to the element other 
		 * than the hard coded form-control class. The are part of the properties element
		 * of the fields array.
		 * 
		 * For example 'properties'=>array('class'=>'resettable mandatory')
		 * 
		 * If the properties element has class key in it then it's value will be assigned
		 * to the additional_classes local variable. This variable is appended to the existing
		 * class.  	
		 */
		$additional_classes = "";
		
		if(isset($fields['properties'])){
			if(array_key_exists('class', $fields['properties'])){
				$additional_classes = $fields['properties']['class'];
			}
		}				
		
		
		$this->form_output_string .= "<select class='form-control ".$additional_classes." '";
		
		/**
		 * This part of the code allows for a non key-value paired elements of the properties element.
		 * If such elemeents are found inside properties since they have a numeric key the values will
		 * be used as the key.
		 */
		if(isset($fields['properties'])){
			foreach($fields['properties'] as $property=>$value){
				if(is_numeric($property)){
					$this->form_output_string .= " ".$value." = '".$value."' ";
				}else{
					$this->form_output_string .= " ".$property." = '".$value."' ";
				}
			}
		}											
		
					
		$this->form_output_string .= ">
		<option value=''>Select ... </option>";
			/**
			 * Builds the options html in a select element
			 */			
			if(array_key_exists('options', $fields)){
				foreach($fields['options'] as $option_value=>$option){
					
					$this->form_output_string .="<option value='".$option_value."' ";
					
					
					/**
					 * Sets the selected option in a select element. It uses the key of the values
					 * element of the fields array. 
					 */
					
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
		
		if(isset($fields['properties'])){
			if(array_key_exists('class', $fields['properties'])){
				$additional_classes = $fields['properties']['class'];
			}	
		}		
		
		
		$this->form_output_string .= "<input class='form-control ".$additional_classes."'";
		
		if(isset($fields['properties'])){
			if(!array_key_exists('type', $fields['properties'])){
				$this->form_output_string .= "type='text'";
			}	
		}else{
			$this->form_output_string .= "type='text'";
		}
						
		
		if(isset($fields['properties'])){				
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
		}
						
		$this->form_output_string .= "' />";
		
		return $this->form_output_string;
	}
	
	function create_single_column_form(){
		
		if($this->form_output_string!=="") $this->form_output_string = "";
		
		$this->form_open_tag();
		
		
		foreach($this->fields as $fields){
			$label = isset($fields['label'])?$fields['label']:'Label Not Provided';
			$this->form_output_string .= "<div class='form-group'>
				<label class='control-label col-xs-4'>".$label."</label>
				<div class='col-xs-8'>";
					
					$additional_classes = "";
					
					if(isset($fields['properties'])){
						if(array_key_exists('class', $fields['properties'])){
							$additional_classes = $fields['properties']['class'];
						}
					}
					
					if(!isset($fields['element'])){
						$this->create_input_field($fields);
					}else{
						if($fields['element'] == 'input'){
							$this->create_input_field($fields);
						}elseif($fields['element'] == 'select'){
							$this->create_select_field($fields);
						}
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
									
									
		$this->form_output_string .= "<table class='table table-striped' id='".$this->multi_column_table_id."'>
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
