<?php

include "include_report_queries.php";

//Get All Months Transactions
$this->db->select(array("voucher_header.TDate","voucher_header.VType","voucher_header.Payee","voucher_header.VNumber","voucher_header.ChqNo","voucher_header.TDescription","voucher_body.AccNo"));
$this->db->select_sum("Cost");
$this->db->join("voucher_header","voucher_header.hID=voucher_body.hID");
$this->db->join("accounts","accounts.AccNo=voucher_body.AccNo");
$this->db->where(array("voucher_header.icpNo"=>$icpNo,"voucher_header.TDate>="=>$month_start,"voucher_header.TDate<="=>$month_end));
$this->db->group_by(array("voucher_header.VNumber","AccNo"));
$this->db->order_by("voucher_header.TDate");
$months_transactions_grouped_by_vnum_acc = $this->db->get("voucher_body")->result_array();

/**Vouchers for the Month**/
$months_voucher_numbers = array_unique(array_column($months_transactions_grouped_by_vnum_acc, "VNumber"));

/**Group Transactions with Voucher Number Keys. Separate Main block to Spread **/
$months_transactions_with_main_spread = array();

$i = 0;
foreach($months_voucher_numbers as $vnum){
	foreach($months_transactions_grouped_by_vnum_acc as $value){
		if($value['VNumber'] == $vnum){
			$months_transactions_with_main_spread[$i]['main'] = array_slice($value, 0,6);
			
			$months_transactions_with_main_spread[$i]['main']['bank_inc'] = 0;
			$months_transactions_with_main_spread[$i]['main']['bank_exp'] = 0;
			$months_transactions_with_main_spread[$i]['main']['bank_bal'] = 0;
			$months_transactions_with_main_spread[$i]['main']['petty_inc'] = 0;
			$months_transactions_with_main_spread[$i]['main']['petty_exp'] = 0;
			$months_transactions_with_main_spread[$i]['main']['petty_bal'] = 0;
			$months_transactions_with_main_spread[$i]['spread'][] = array_slice($value, 6,2);

		}
	}
	$i++;
}

/** Add the totals of a voucher after summing the sum of cost of spread **/
 
$cash_balances['cash'] = $proof_of_cash_grid; 
 
function add_totals_to_main($array,$cash_balances){
	if(isset($array['spread'])){
		$sum = array_sum(array_column($array['spread'], "Cost"));
		
		if($array['main']['VType']== "CR" || $array['main']['VType']== "PCR"){
			$array['main']['bank_inc'] = $sum;
		}elseif($array['main']['VType']== "CHQ" || $array['main']['VType']== "BCHG"){
			$array['main']['bank_exp'] = $sum;
			if($array['spread'][0]['AccNo'] === '2000' || $array['spread'][0]['AccNo'] === '2001'){
				$array['main']['petty_inc'] = $sum;
			}
		}elseif($array['main']['VType']== "PC" || $array['main']['VType']== "PCR"){
			$array['main']['petty_exp'] = $sum;
		}
	}
	return $array;
}


$months_transactions_with_main_spread = array_map("add_totals_to_main", $months_transactions_with_main_spread,$cash_balances);

$months_transactions_with_main_spread_acc_keys = array();
$z=0;
foreach($months_transactions_with_main_spread as $row){
	$months_transactions_with_main_spread_acc_keys[$z]['main'] = $row['main'];
	if(isset($row['spread'])){
		foreach($row['spread'] as $spread){
			$months_transactions_with_main_spread_acc_keys[$z]['spread'][$spread['AccNo']] = $spread['Cost'];  
		}
	}
	$z++;
}

//print_r($months_transactions_with_main_spread_acc_keys);
/**Journal Main Section Headers**/
$main_section_header_label = array();
if(isset($months_transactions_with_main_spread[0]['main'])){
	$main_section_header_label = array_keys($months_transactions_with_main_spread[0]['main']);
}


/** Renamed Labels**/
$real_header_labels = array("TDate"=>"Date","VType"=>"Voucher Type","Payee"=>"Payee/Source","VNumber"=>"Voucher Number",
						"TDescription"=>"Description/Details","ChqNo"=>"Cheque Number","bank_inc"=>"Bank eposits",
						"bank_exp"=>"Bank Payments","bank_bal"=>"Bank Balance","petty_inc"=>"Cash Deposit","petty_exp"=>"Cash Payments",
						"petty_bal"=>"Cash Balance");

/**Main Section**/
$main_section =  array_column($months_transactions_with_main_spread, "main");


/**Spread Section**/
$spread_section =  array_column($months_transactions_with_main_spread, "spread");

/** Computed Balances Columns in Journal **/

$bank_bal = $proof_of_cash_grid["BC"]['ob'];
$petty_bal = $proof_of_cash_grid["PC"]['ob'];

$balance_array = array();

$i = 0;
foreach($months_transactions_with_main_spread as $row){
	$bank_bal += $row['main']['bank_inc'] - $row['main']['bank_exp'];
	$petty_bal += $row['main']['petty_inc'] - $row['main']['petty_exp'];
	
	$balance_array[$i]['bank'] = $bank_bal;
	$balance_array[$i]['petty'] = $petty_bal;
	
	$i++;
}


/** Get Months Accounts Utilized **/
$month_accounts_utilized = array();
foreach($months_transactions_with_main_spread as $row){
	if(isset($row['spread'])){
		foreach($row['spread'] as $spreads){
			if($spreads['AccNo'] == 2000 || $spreads['AccNo'] == 2001) continue;
			$month_accounts_utilized[] = $spreads['AccNo'];
		}		
	}
	
}

$month_accounts_utilized = array_values(array_unique($month_accounts_utilized));

/**Order Month Utilized Accounts**/
$ordered_utilized_accounts  = array();
foreach($all_vote_heads as $row){
	foreach($month_accounts_utilized as $utilized){
		if($row['AccNo'] == $utilized){
			$ordered_utilized_accounts[$row['AccGrp']][] = array($row['AccNo'],$row['AccText'],$row['AccName']);
		}
	}	
}


$month_utilized_income_accounts = array();
if(isset($ordered_utilized_accounts[1])){
	foreach($ordered_utilized_accounts[1] as $value){
		$month_utilized_income_accounts[] = array_shift($value);
	}	
}


$month_utilized_expense_accounts = array();
if(isset($ordered_utilized_accounts[0])){
	foreach($ordered_utilized_accounts[0] as $value){
		$month_utilized_expense_accounts[] = array_shift($value);
	}	
}


$all_utilized_acc_in_order = array_merge($month_utilized_income_accounts,$month_utilized_expense_accounts);

