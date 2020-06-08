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
            $this->db->where(array('voucher_header.TDate>='=>$month_start_date));
            $this->db->where(array('voucher_header.TDate<='=>$month_end_date));
            $all_udctb_countrywide= $this->db->get('voucher_body')->result_array();
            
            $array_column_cost=array_column($all_udctb_countrywide,'Cost');
            
            $total_udctb_countrywide=array_sum( $array_column_cost);
    
            return $total_udctb_countrywide;
    }
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
     * @date: 5/28/2020
     */
    function cluster_dct_in_aregion($dct_report_month,$region_name){


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

