<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File extends CI_Model{

    public function getRows($id = '',$upload_type=""){
        $this->db->select('document_id,title,description,status,timestamp');
        $this->db->from('document');
        if($id){
            $this->db->where(array('document_id'=>$id));
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $this->db->order_by('timestamp','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }
    
    public function insert($data = array()){
        $insert = $this->db->insert_batch('document',$data);
        return $insert?true:false;
    }
    
}