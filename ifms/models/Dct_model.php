<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dct_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    /**
     * @author: Onduso
     * @date: 5/28/2020
     */
    function get_total_dct_countrywide($dct_report_month){

        $month_start_date = date('Y-m-01',$dct_report_month);
        $month_end_date = date('Y-m-t',$dct_report_month);

        $this->db->select(array('region.region_name as region_name', 'AccText'));
		$this->db->group_by('voucher_body.AccNo', 'region_name');
		$this->db->join('projectsdetails', 'projectsdetails.icpNo=voucher_body.icpNo');
		$this->db->join('clusters', 'clusters.clusters_id=projectsdetails.cluster_id');
		$this->db->join('region', 'region.region_id=clusters.region_id');

		$this->db->select_sum('Cost');

		$this->db->join('voucher_header', 'voucher_header.hID=voucher_body.hID');
		$this->db->join('accounts', 'accounts.AccNo=voucher_body.AccNo');
		$this->db->where_in('voucher_header.VType', array('UDCTB', 'UDCTC'));
		// $this->db->where_in('voucher_header.icpNo',$list_of_fcps);
		$this->db->where(array('voucher_header.TDate>='=>$month_start_date));
		$this->db->where(array('voucher_header.TDate<='=>$month_end_date));
        $all_udctb_countrywide= $this->db->get('voucher_body')->result_array();
        
        $array_column_cost=array_column($all_udctb_countrywide,'Cost');
        
        $total_udctb_countrywide=array_sum( $array_column_cost);

        return $total_udctb_countrywide;

    }

    function get_direct_cash_transfer_in_region(){
          
            $this->db->select(array('clusters.clusterName as cluster_name','AccText','region.region_name AS region'));
            $this->db->group_by(array('voucher_body.AccNo','region_name'));
            $this->db->join('projectsdetails','projectsdetails.icpNo=voucher_body.icpNo');
            $this->db->join('clusters','clusters.clusters_id=projectsdetails.cluster_id');
            $this->db->join('region','region.region_id=clusters.region_id');    
       
    
        $this->db->select_sum('Cost');
    
        $this->db->join('voucher_header','voucher_header.hID=voucher_body.hID');
        $this->db->join('accounts','accounts.AccNo=voucher_body.AccNo');
        $this->db->where_in('voucher_header.VType',array('UDCTB','UDCTC'));
        //$this->db->where_in('voucher_header.icpNo',$list_of_fcps);
        //$this->db->where(array('voucher_header.TDate>='=>$month_start_date));
        //$this->db->where(array('voucher_header.TDate<='=>$month_end_date));
        $result = $this->db->get('voucher_body')->result_array();
    
        return $result;
    }

    private function direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp,$aggregate_by = 'account_number'){

        //aggregate_by = account_number or fcp_number
    
        $month_start_date = date('Y-m-01',$reporting_month_stamp);
        $month_end_date = date('Y-m-t',$reporting_month_stamp);
        
    
        if($aggregate_by == 'fcp_number'){
            $this->db->select(array('voucher_body.icpNo as icpNo','AccText'));
            $this->db->group_by('voucher_body.AccNo','voucher_body.icpNo');
        }elseif($aggregate_by == 'region'){    
            $this->db->select(array('region.region_name as region_name','AccText'));
            $this->db->group_by('voucher_body.AccNo','region_name');
            $this->db->join('projectsdetails','projectsdetails.icpNo=voucher_body.icpNo');
            $this->db->join('clusters','clusters.clusters_id=projectsdetails.cluster_id');
            $this->db->join('region','region.region_id=clusters.region_id');
        }elseif($aggregate_by == 'cluster'){    
            $this->db->select(array('clusters.clusterName as cluster_name','AccText'));
            $this->db->group_by('voucher_body.AccNo','region_name');
            $this->db->join('projectsdetails','projectsdetails.icpNo=voucher_body.icpNo');
            $this->db->join('clusters','clusters.clusters_id=projectsdetails.cluster_id');
            //$this->db->join('region','region.region_id=clusters.region_id');    
        }else{
            $this->db->select(array('AccText'));
            $this->db->group_by('voucher_body.AccNo');
        }
    
        $this->db->select_sum('Cost');
    
        $this->db->join('voucher_header','voucher_header.hID=voucher_body.hID');
        $this->db->join('accounts','accounts.AccNo=voucher_body.AccNo');
        $this->db->where_in('voucher_header.VType',array('UDCTB','UDCTC'));
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
        $this->db->where_in('voucher_header.VType',array('UDCTB','UDCTC'));
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


     public function region_grouped_direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp){
        $raw_data = $this->direct_cash_transfers($list_of_fcps,$reporting_month_stamp,'region');

        return  $raw_data;
    
    //     $dct_records = [];
    
    //     $dct_accounts = [];
    
    //     foreach($raw_data as $account_expense_for_fcp){
    //         $fcp_no = $account_expense_for_fcp['icpNo'];
            
    //         unset($account_expense_for_fcp['icpNo']);
    
    //         $dct_records[$fcp_no]['spread'][$account_expense_for_fcp['AccText']] = $account_expense_for_fcp['Cost'];
            
    //         $dct_records[$fcp_no]['total_dct_expense'] = array_sum($dct_records[$fcp_no]['spread']);
            
    //         if(array_search($account_expense_for_fcp['AccText'],$dct_accounts) !== 0 && !array_search($account_expense_for_fcp['AccText'],$dct_accounts)){
    //             $dct_accounts[] = $account_expense_for_fcp['AccText'];
    //         }
            
    //     }
    
    //     return ['dct_records'=>$dct_records,'dct_accounts'=>$dct_accounts];
     }

}