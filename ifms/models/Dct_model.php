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

    /**
     * @author: Onduso
     * @date: 6/27/2020
     */
    function get_accounts_related_voucher_item_type(int $voucher_item_type_id=0){

        
        //return $this->db->select(array('accno','acctext','accname'))->get_where('accounts', array('fk_voucher_item_type_id'=>$voucher_item_type_id))->result_array();
        $this->db->select(array('accno','acctext','accname'));
        $this->db->join('voucher_items_with_accounts','voucher_items_with_accounts.accounts_id=accounts.accID');
        $this->db->join('voucher_item_type','voucher_items_with_accounts.voucher_item_type_id=voucher_item_type.voucher_item_type_id');
        return $this->db->get_where('accounts', array('voucher_item_type.voucher_item_type_id'=>$voucher_item_type_id))->result_array();
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

     function get_voucher_item_types(){
		$this->db->select(array('voucher_item_type_id','voucher_item_type_name'));
		$voucher_item_types = $this->db->get_where('voucher_item_type',array('voucher_type_item_is_active'=>1))->result_array();

		return $voucher_item_types;
	}
}

