<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dct_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function fcp_grouped_direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp){
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


     private function direct_cash_transfers(Array $list_of_fcps,$reporting_month_stamp,$aggregate_by = 'account_number'){

        //aggregate_by = account_number or fcp_number
    
        $month_start_date = date('Y-m-01',$reporting_month_stamp);
        $month_end_date = date('Y-m-t',$reporting_month_stamp);
        
        $this->db->join('voucher_header','voucher_header.hID=voucher_body.hID');
        $this->db->join('accounts','accounts.AccNo=voucher_body.AccNo');

        if($aggregate_by == 'fcp_number'){
            $this->db->select(array('voucher_body.icpNo as icpNo','AccText'));
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

}

