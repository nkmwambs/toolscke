<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_model extends CI_Model{
    
    public function due_benchmarks($users_id="",$date="",$id=""){
        $statement =  "SELECT * FROM `benchmark`  WHERE   ";
		
		if($id!==""){
			$statement .= " `benchmark_id`=".$id." ";
		}else{	
			$statement .= " `benchmark_id` NOT IN (SELECT `benchmark_id` FROM `result` WHERE `result`.`users_id`='".$users_id."'  AND  `result`.`next_assessment_date` >=  '".$date."') ";
		}
													
		$benchmarks = $this->db->query($statement)->result_object();
			
		return $benchmarks;
    }
	
	public function high_benchmarks($users_id="",$date=""){
		$statement = "SELECT * FROM `result` LEFT JOIN `benchmark` ON `result`.`benchmark_id`=`benchmark`.`benchmark_id` WHERE `result`.`score` = '1' AND `result`.`users_id`='".$users_id."'  AND `result`.`next_assessment_date` >=  '".$date."'  ";
		
		$benchmarks = $this->db->query($statement)->result_object();
			
		return $benchmarks;
	}
	
	public function low_benchmarks($users_id="",$date=""){
		$statement = "SELECT * FROM `result` LEFT JOIN `benchmark` ON `result`.`benchmark_id`=`benchmark`.`benchmark_id` WHERE `result`.`score` = '0' AND `result`.`users_id`='".$users_id."'  AND  `result`.`next_assessment_date` >=  '".$date."'  ";
		
		$benchmarks = $this->db->query($statement)->result_object();
			
		return $benchmarks;
	}
	
	public function assessed_benchmarks($users_id="",$date=""){
		$statement = "SELECT * FROM `result` LEFT JOIN `benchmark` ON `result`.`benchmark_id`=`benchmark`.`benchmark_id` WHERE `result`.`users_id`='".$users_id."'  AND  `result`.`next_assessment_date` >=  '".$date."' ";
		
		$benchmarks = $this->db->query($statement)->result_object();
			
		return $benchmarks;
	}
	
	public function performance($users_id="",$date=""){
		$benchmarks = $this->due_benchmarks($users_id,$date);
		$high =  $this->high_benchmarks($users_id,$date);
		$low =  $this->low_benchmarks($users_id,$date);
		
		$total = count($benchmarks)+count($high)+count($low);///(count($high)+count($low)+count($benchmarks))
        		
        $total_high = count($high);
        		
        $performance = number_format(($total_high/$total)*100);	
        
        return $performance;
	}
    
}