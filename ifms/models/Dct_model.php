<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//DEFINE('DS', DIRECTORY_SEPARATOR);	

class Dct_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function post_voucher(){
    
    $message = 1;
    
    $this->db->trans_start();
   
    $data['icpNo']  = $this->input->post('KENo');
    $data['TDate'] = date('Y-m-d', strtotime($this->input->post('TDate')));
    $data['Fy'] = get_fy($this->input->post('TDate'), $this->session->center_id);
    $data['VNumber'] = $this->input->post('VNumber');
    $data['Payee'] = $this->input->post('Payee');
    $data['Address'] = $this->input->post('Address');
    $data['VType'] = $this->input->post('VTypeMain');
    //$data['raiser_id'] = $this->session->login_user_id;

    //Check if Bank Details exists

    if ($this->db->get_where('projectsdetails', array('icpNo' => $this->session->userdata('center_id')))->num_rows() > 0) {

        $bank_code = $this->db->get_where('projectsdetails', array('icpNo' => $this->session->userdata('center_id')))->row()->bankID;
    } else {
        $bank_code = 0;
    }

    //Append Bank Code to ChqNo

    if ($this->input->post('reversal')) {
        $bank_code = $bank_code . "-0";
    }

    $data['ChqNo'] = $this->input->post('ChqNo') . "-" . $bank_code;
    $data['TDescription'] = $this->input->post('TDescription');
    $data['totals'] = array_sum($this->input->post('cost'));
    $data['unixStmp'] = time();

    //Check if voucher already exists
    $chk_obj = $this->db->get_where("voucher_header", array("VNumber" => $this->input->post('VNumber'), "icpNo" => $this->input->post('KENo')));

    if ($chk_obj->num_rows() == 0) {

        $this->db->insert('voucher_header', $data);

        //Last id
        $hID = $this->db->insert_id();

        //Populate body //hID,icpNo,VNumber,TDate,VType,ChqNo,unixStmp     Qty,Details,UnitCost,Cost,AccNo,civaCode //$data2[''][$i]=
        $qty = $this->input->post('qty');
        $details = $this->input->post('desc');
        $unitcost = $this->input->post('unit');
        $cost = $this->input->post('cost');
        $acc = $this->input->post('acc');
        $civ = $this->input->post('civaCode');

        for ($i = 0; $i < sizeof($this->input->post('qty')); $i++) {
            $data2['hID'] = $hID;
            $data2['icpNo'] = $this->input->post('KENo');
            $data2['VNumber'] = $this->input->post('VNumber');
            $data2['TDate'] = $this->input->post('TDate');
            $data2['VType'] = $this->input->post('VTypeMain');
            $data2['ChqNo'] = $this->input->post('ChqNo') . "-" . $bank_code;
            $data2['unixStmp'] = time();
            $data2['Qty'] = $qty[$i];
            $data2['Details'] = $details[$i];
            $data2['UnitCost'] = $unitcost[$i];
            $data2['Cost'] = $cost[$i];
            $data2['AccNo'] = $acc[$i];
            $data2['civaCode'] = $civ[$i];

            $this->db->insert('voucher_body', $data2);
        }

        $this->db->trans_complete();

       
        if ($this->db->trans_status() === false) {
            $message = 0;
        } else {

            // Move file to dct_document folder only when database insert is completed successful
            $voucher_number = $this->input->post('VNumber');
            $voucher_date = $this->input->post('TDate');

            $temp_dir_name = 'uploads' . DS . 'temps' . DS . $this->temp_folder_hash($voucher_number);
           
            $this->move_temp_files_to_dct_document($temp_dir_name, $voucher_date, $voucher_number);

        }
    }

    return $message;
    }

    function temp_folder_hash($voucher_number){
		$hash_folder_name = $this->session->login_user_id . date('Y-m-d') . $voucher_number; //.random_int(10,1000000);
		$hash = md5($hash_folder_name);

		return $hash;
	}

    function move_temp_files_to_dct_document($temp_dir_name, $voucher_date, $voucher_number)
	{

		$month_folder = date('Y-m', strtotime($voucher_date));

		if (!file_exists('uploads' . DS . 'dct_documents'))
			mkdir('uploads' . DS . 'dct_documents');

		if (!file_exists('uploads' . DS . 'dct_documents' . DS . $this->session->center_id))
			mkdir('uploads' . DS . 'dct_documents' . DS . $this->session->center_id);

		if (!file_exists('uploads' . DS . 'dct_documents' . DS . $this->session->center_id . DS . $month_folder))
			mkdir('uploads' . DS . 'dct_documents' . DS . $this->session->center_id . DS . $month_folder);

		$final_file_path = 'uploads' . DS . 'dct_documents' . DS . $this->session->center_id . DS . $month_folder . DS . $voucher_number;

		return rename($temp_dir_name, $final_file_path);
	}
}

