<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File extends CI_Model{

    public function getRows($id = '',$upload_type=""){
        $this->db->select('id,file_name,file_group,upload_type,created');
        $this->db->from('apps_files');
        if($id){
            $this->db->where(array('file_group'=>$id,'upload_type'=>$upload_type));
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $this->db->order_by('created','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }
    
    public function insert($data = array()){
        $insert = $this->db->insert_batch('apps_files',$data);
        return $insert?true:false;
    }
    
}