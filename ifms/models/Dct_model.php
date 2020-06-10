<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dct_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // /**
    //  * @author: Onduso
    //  * @date: 5/28/2020
    //  */
    // function get_total_dct_countrywide($dct_report_month){

    //         $month_start_date = date('Y-m-01',$dct_report_month);
    //         $month_end_date = date('Y-m-t',$dct_report_month);
    //         $this->db->select(array('region.region_name as region_name', 'AccText'));
    //         $this->db->group_by('voucher_body.AccNo', 'region_name');
    //         $this->db->join('projectsdetails', 'projectsdetails.icpNo=voucher_body.icpNo');
    //         $this->db->join('clusters', 'clusters.clusters_id=projectsdetails.cluster_id');
    //         $this->db->join('region', 'region.region_id=clusters.region_id');
    
    //         $this->db->select_sum('Cost');
    
    //         $this->db->join('voucher_header', 'voucher_header.hID=voucher_body.hID');
    //         $this->db->join('accounts', 'accounts.AccNo=voucher_body.AccNo');
    //         $this->db->where_in('voucher_header.VType', array('UDCTB', 'UDCTC'));
    //         $this->db->where(array('voucher_header.TDate>='=>$month_start_date));
    //         $this->db->where(array('voucher_header.TDate<='=>$month_end_date));
    //         $all_udctb_countrywide= $this->db->get('voucher_body')->result_array();
            
    //         $array_column_cost=array_column($all_udctb_countrywide,'Cost');
            
    //         $total_udctb_countrywide=array_sum( $array_column_cost);
    
    //         return $total_udctb_countrywide;
    // }
    /**
     * @author: Onduso
     * @date: 5/28/2020
     */
    function get_direct_cash_transfer_in_region($dct_report_month){

        $month_start_date = date('Y-m-01',$dct_report_month);
        $month_end_date = date('Y-m-t',$dct_report_month);
        $this->db->select(array('clusters.clusterName as cluster_name','AccText','region.region_id AS regionId','region.region_name AS region'));
        $this->db->group_by(array('region.region_name','voucher_body.AccNo'));
        $this->db->join('projectsdetails','projectsdetails.icpNo=voucher_body.icpNo');
        $this->db->join('clusters','clusters.clusters_id=projectsdetails.cluster_id');
        $this->db->join('region','region.region_id=clusters.region_id');    
       
    
        $this->db->select_sum('Cost');
    
        $this->db->join('voucher_header','voucher_header.hID=voucher_body.hID');
        $this->db->join('accounts','accounts.AccNo=voucher_body.AccNo');
        $this->db->where_in('voucher_header.VType',array('UDCTB','UDCTC'));
        $this->db->where(array('voucher_header.TDate>='=>$month_start_date));
        $this->db->where(array('voucher_header.TDate<='=>$month_end_date));
        $result = $this->db->get('voucher_body')->result_array();
    
        return $result;
        
    }
    
    
    private function direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp,$aggregate_by = 'account_number'){

        //aggregate_by = account_number or fcp_number
    
        $month_start_date = date('Y-m-01',$reporting_month_stamp);
        $month_end_date = date('Y-m-t',$reporting_month_stamp);
        
        $this->db->join('voucher_header','voucher_header.hID=voucher_body.hID');
        $this->db->join('accounts','accounts.AccNo=voucher_body.AccNo');

        if($aggregate_by == 'fcp_number'){
            $this->db->select(array('voucher_body.icpNo as icpNo','AccText','voucher_body.AccNo'));
            $this->db->group_by(array('voucher_body.AccNo','voucher_body.icpNo'));
        }elseif($aggregate_by == 'cluster'){
            $this->db->select(array('clusters.clusterName as cluster_name','AccText'));
            $this->db->group_by(array('voucher_body.AccNo','clusters.clusterName'));
            
            $this->db->join('projectsdetails','projectsdetails.icpNo=voucher_header.icpNo');
            $this->db->join('clusters','clusters.clusters_id=projectsdetails.cluster_id');
            $this->db->join('region','region.region_id=clusters.region_id');
        }else{

            $this->db->select(array('AccText'));
            $this->db->group_by(array('voucher_body.AccNo'));
        }
    
        $this->db->select_sum('Cost');
    
        
        $this->db->where_in('voucher_header.VType',array('UDCTB','UDCTC'));
        $this->db->where_in('voucher_header.icpNo',$list_of_fcps);
        $this->db->where(array('voucher_header.TDate>='=>$month_start_date));
        $this->db->where(array('voucher_header.TDate<='=>$month_end_date));
        $result = $this->db->get('voucher_body')->result_array();
    
        return $result;
     }

     public function region_fcps($manager_id){
    
        $this->db->select(array('clusters_id','clusterName as cluster_name','icpNo'));
        $this->db->where(array('region.region_manager_id'=>$manager_id,'projectsdetails.status'=>1));
        $this->db->join('clusters','clusters.clusters_id=projectsdetails.cluster_id');
        $this->db->join('region','region.region_id=clusters.region_id');
        $result = $this->db->get('projectsdetails')->result_array();
    
        return array_column($result,'icpNo');
     }
    
     public function cluster_fcps($cluster_name){
    
        $this->db->select(array('icpNo'));
        $this->db->where(array('clusterName'=>$cluster_name,'projectsdetails.status'=>1));
        $this->db->join('clusters','clusters.clusters_id=projectsdetails.cluster_id');
        $result = $this->db->get('projectsdetails')->result_array();
    
        return array_column($result,'icpNo');
     }


     function cluster_grouped_direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp){
        $raw_data = $this->direct_cash_transfers($list_of_fcps,$reporting_month_stamp,'cluster');
        
        $dct_records = [];
    
        $dct_accounts = [];
    
        $cnt = 0;
        foreach($raw_data as $account_expense_for_cluster){
            $cluster_name = $account_expense_for_cluster['cluster_name'];
            
            unset($account_expense_for_cluster['cluster_name']);
    
            $dct_records[$cluster_name]['spread'][$account_expense_for_cluster['AccText']] = $account_expense_for_cluster['Cost'];
            
            $dct_records[$cluster_name]['total_dct_expense'] = array_sum($dct_records[$cluster_name]['spread']);
            
        }
    
        foreach($dct_records as $spread){
            $dct_accounts = array_merge($dct_accounts,array_keys($spread['spread']));
        }
    
        return ['dct_records'=>$dct_records,'dct_accounts'=>array_unique($dct_accounts)];
     }


     public function fcp_grouped_direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp){
        $raw_data = $this->direct_cash_transfers($list_of_fcps,$reporting_month_stamp,'fcp_number');
        // print_r($raw_data);
        // exit;
        $dct_records = [];
    
        $dct_accounts = [];
    
        $cnt = 0;
        foreach($raw_data as $account_expense_for_fcp){
            $fcp_no = $account_expense_for_fcp['icpNo'];
            
            unset($account_expense_for_fcp['icpNo']);
    
            $dct_records[$fcp_no]['spread'][$account_expense_for_fcp['AccText']] = $account_expense_for_fcp['Cost'];
            
            $dct_records[$fcp_no]['total_dct_expense'] = array_sum($dct_records[$fcp_no]['spread']);
            
        }
    
        foreach($dct_records as $spread){
            $dct_accounts = array_merge($dct_accounts,array_keys($spread['spread']));
        }
    
        return ['dct_records'=>$dct_records,'dct_accounts'=>array_unique($dct_accounts)];
     }

    public function get_account_no_and_text($account_text_array = []){
        
        $raw_accounts = [];
        
        if(empty($account_text_array)){
            $account_text_array = $this->db->select(array('AccNo','AccText'))->get_where('accounts',
            array('is_direct_cash_transfer'=>1))->result_array();
        }else{
            $this->db->where_in('AccText',$account_text_array);
            $raw_accounts = $this->db->select(array('AccNo','AccText'))->get('accounts')->result_array();    
        }

       
        $acc_nos = array_column($raw_accounts,'AccNo');
        $acc_text = array_column($raw_accounts,'AccText');

        return array_combine($acc_text,$acc_nos);
    }


    function get_beneficiary_counts($reporting_month_stamp, $account_no_array,$fcps_array){
        
        if(empty($account_no_array)){
            $account_no_array_raw = $this->db->select(array('AccNo'))->get_where('accounts',
            array('is_direct_cash_transfer'=>1))->result_array();

            $account_no_array = array_column($account_no_array_raw,'AccNo');
        }

        $this->db->where_in('account_number',$account_no_array);
        $this->db->where_in('fcp_number',$fcps_array);
        $this->db->where(array('mfr_closure_date'=>date('Y-m-t',$reporting_month_stamp)));
        
        $this->db->select(array('account_number'));
        $this->db->select_sum('beneficiaries_count');
        $this->db->group_by('account_number');

        $this->db->join('dct_beneficiaries','dct_beneficiaries.dct_beneficiaries_id=dct_beneficiaries_counts.dct_beneficiaries_id');
        
        $raw_result = $this->db->get('dct_beneficiaries_counts');

        $return_array = [];

        if($raw_result->num_rows() == 0){
            $flipped_array_of_accounts = array_flip(array_values($account_no_array));
            $return_array = array_map(function($elem){return 0;},$flipped_array_of_accounts);
        }else{
            foreach($account_no_array as $account_no){
                foreach($raw_result->result_array() as $row_of_count_per_account){
                    if($row_of_count_per_account['account_number'] === $account_no){
                        $return_array[$account_no] = $row_of_count_per_account['beneficiaries_count'];
                    }
                }
            }
        }   

        return $return_array;
    }

    function check_if_fcp_has_dct_records($reporting_month_stamp){
        $dct_records = $this->direct_cash_transfers([$this->session->center_id],$reporting_month_stamp);
        
        $fcp_dct_counts = count($dct_records);

        $has_dct_records = $fcp_dct_counts > 0 ? true : false;

        return $has_dct_records;
    }

    function validate_if_beneficiary_count_not_required($reporting_month_stamp){


        // Does FCP contain DCT vouchers in the month
        // $dct_records = $this->direct_cash_transfers([$this->session->center_id],$reporting_month_stamp);
        
        // $fcp_dct_counts = count($dct_records);

        // $has_dct_records = $fcp_dct_counts > 0 ? true : false;
        $has_dct_records = $this->check_if_fcp_has_dct_records($reporting_month_stamp);
        
        // Does the FCP DCT beneficiary count recorded
        $this->db->where(array('fcp_number'=>$this->session->center_id,'mfr_closure_date'=>date('Y-m-t',$reporting_month_stamp)));
        $dct_beneficiary_report_count = $this->db->get_where('dct_beneficiaries')->num_rows();

        $has_dct_beneficiary_report = $dct_beneficiary_report_count > 0 ? true : false;

        return $fcp_dct_counts && !$has_dct_beneficiary_report ? 0 : 1;
    }

    function dct_beneficiary_report_required($account_no_array){
        
        $this->db->where_in('AccNo',$account_no_array);
        $raw_result = $this->db->select(array('AccText','AccNo','is_dct_beneficiary_report_required'))->get('accounts');

        $return_array = [];

        if($raw_result->num_rows() == 0){
            $flipped_array_of_accounts = array_flip(array_values($account_no_array));
            $return_array = array_map(function($elem){return 'report_not_required';},$flipped_array_of_accounts);
        }else{
            foreach($account_no_array as $account_no){
                foreach($raw_result->result_array() as $row_of_account){
                    if($row_of_account['AccNo'] === $account_no){
                        $return_array[$account_no] = $row_of_account['is_dct_beneficiary_report_required']?'report_required':'report_not_required';
                    }
                }
            }
        }   

        return $return_array;
    }

}

