<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dct_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    private function direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp,$aggregate_by = 'account_number'){

        //aggregate_by = account_number or fcp_number
    
        $month_start_date = date('Y-m-01',$reporting_month_stamp);
        $month_end_date = date('Y-m-t',$reporting_month_stamp);
        
    
        if($aggregate_by == 'fcp_number'){
            $this->db->select(array('voucher_body.icpNo as icpNo','AccText'));
            $this->db->group_by('voucher_body.AccNo','voucher_body.icpNo');
        }else{
            $this->db->select(array('AccText'));
            $this->db->group_by('voucher_body.AccNo');
        }
    
        $this->db->select_sum('Cost');
    
        $this->db->join('voucher_header','voucher_header.hID=voucher_body.hID');
        $this->db->join('accounts','accounts.AccNo=voucher_body.AccNo');
        $this->db->where_in('voucher_header.VType',array('DCTB','DCTC'));
        $this->db->where_in('voucher_header.icpNo',$list_of_fcps);
        $this->db->where(array('voucher_header.TDate>='=>$month_start_date));
        $this->db->where(array('voucher_header.TDate<='=>$month_end_date));
        $result = $this->db->get('voucher_body')->result_array();
    
        return $result;
     }
    
    public function direct_cash_transfers_by_fcp($fcp_number,$reporting_month_stamp){
    
        $month_start_date = date('Y-m-01',$reporting_month_stamp);
        $month_end_date = date('Y-m-t',$reporting_month_stamp);
        
        $this->db->select(array('voucher_header.hID as hID','voucher_header.VNumber as VNumber','voucher_header.VType as VType'));
        $this->db->group_by('voucher_body.VNumber','voucher_body.icpNo');
    
        $this->db->select_sum('Cost');
    
        $this->db->join('voucher_header','voucher_header.hID=voucher_body.hID');
        $this->db->join('accounts','accounts.AccNo=voucher_body.AccNo');
        $this->db->where_in('voucher_header.VType',array('DCTB','DCTC'));
        $this->db->where('voucher_header.icpNo',$fcp_number);
        $this->db->where(array('voucher_header.TDate>='=>$month_start_date));
        $this->db->where(array('voucher_header.TDate<='=>$month_end_date));
        $result = $this->db->get('voucher_body')->result_array();
    
        return $result;
     }
    
     public function fcp_grouped_direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp){
        $raw_data = $this->direct_cash_transfers($list_of_fcps,$reporting_month_stamp,'fcp_number');
    
        $dct_records = [];
    
        $dct_accounts = [];
    
        foreach($raw_data as $account_expense_for_fcp){
            $fcp_no = $account_expense_for_fcp['icpNo'];
            
            unset($account_expense_for_fcp['icpNo']);
    
            $dct_records[$fcp_no]['spread'][$account_expense_for_fcp['AccText']] = $account_expense_for_fcp['Cost'];
            
            $dct_records[$fcp_no]['total_dct_expense'] = array_sum($dct_records[$fcp_no]['spread']);
            
            if(array_search($account_expense_for_fcp['AccText'],$dct_accounts) !== 0 && !array_search($account_expense_for_fcp['AccText'],$dct_accounts)){
                $dct_accounts[] = $account_expense_for_fcp['AccText'];
            }
            
        }
    
        return ['dct_records'=>$dct_records,'dct_accounts'=>$dct_accounts];
     }

}