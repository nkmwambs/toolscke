<?php
	$condition = "Month(`TDate`)='".date('m',$tym)."' AND Fy='".get_fy(date('d-m-Y',$tym))."' AND icpNo='".$this->session->userdata('icp_no')."'";
	$records = $this->db->where($condition)->get('voucher_header')->result_array();
?>
<div class = "row">
	
	<div class="panel panel-primary" data-collapsed="0">
      	<div class="panel-heading">
           	<div class="panel-title" >
          		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('vouchers_for_');?><?=date('M-Y',$tym);?>
            	</div>
        </div>
		<div class="panel-body">	
 
		 <?php
		 	foreach($records as $row):
		 ?>
		   
		   <div class = "col-sm-6 col-md-3">
		      <div class = "thumbnail">
		         <?php
		         	$data['row'] = $row;
		          	$this->load->view('backend/icp/ifms/single_voucher',$data);
		          ?>
		      </div>
		      
		   </div>
		   
		 <?php
		 	endforeach;
		 ?>
		</div>
	</div>
</div>
		