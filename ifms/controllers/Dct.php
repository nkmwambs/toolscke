<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	DEFINE('DS', DIRECTORY_SEPARATOR);		

/*	
 *	@author 	: Nicodemus Karisa
 *	date		: 25 July, 2018
 *	Compassion International 
 *	https://www.compassion-africa.org
 *	support@compassion-africa.org
 */

class Dct extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('dct_model');
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');

		
    }
    

    function create_uploads_temp($voucher_number){

		//Folder for temp and call the upload_files method to temperarily hold files on server
		$storeFolder = 'uploads' . DS . 'temps' . DS . $this->dct_model->temp_folder_hash($voucher_number);

		if (
			is_array($this->upload_files($storeFolder)) &&
			count($this->upload_files($storeFolder)) > 0
		) {
			echo json_encode($this->upload_files($storeFolder));
		} else {
			echo 0;
		}
    }

    function upload_files($storeFolder)
	{
		//uploads/DCT documents/FCPID/month/voucher/files
		$path_array = explode(DS, $storeFolder);

		$path = [];

		for ($i = 0; $i < count($path_array); $i++) {

			array_push($path, $path_array[$i]);

			$modified_path = implode(DS, $path);

			if (!file_exists($modified_path)) {
				mkdir($modified_path, 0777);
			}
		}

		if (!empty($_FILES)) {

			for ($i = 0; $i < count($_FILES['fileToUpload']['name']); $i++) {
				$tempFile = $_FILES['fileToUpload']['tmp_name'][$i];

				$targetPath = BASEPATH . DS . '..' . DS . $storeFolder . DS;
				$targetFile =  $targetPath . $_FILES['fileToUpload']['name'][$i];

				move_uploaded_file($tempFile, $targetFile);
			}

			return $_FILES;
		}
	}

	function remove_dct_files_in_temp($voucher_number)
	{

		//Folder path
		$storeFolder = BASEPATH . DS . '..' . DS . 'uploads' . DS . 'temps' . DS . $this->dct_model->temp_folder_hash($voucher_number);

		//Loop the $hash directory and delete the selected file
		$data = $this->input->post('file_name');

		foreach (new DirectoryIterator($storeFolder) as $fileInfo) {
			if ($fileInfo->isDot()) continue;

			if ($fileInfo->getFilename() == $data) {

				unlink($storeFolder . DS . $fileInfo);

				echo $fileInfo->getFilename(); //for ajax use
			}
		}

		//$this->delete_empty_folder($storeFolder);
	}
	
	private function get_bank_code()
	{

		if ($this->db->get_where('projectsdetails', array('icpNo' => $this->session->center_id))->num_rows() > 0) {

			return $bank_code = $this->db->get_where('projectsdetails', array('icpNo' => $this->session->center_id))->row()->bankID;
		} else {

			return $bank_code = 0;
		}
	}

	function is_reference_number_exist($ref_number_from_post, $voucher_number_from_post)
	{

		$bank_code = $this->get_bank_code();
		$reference_number_in_db = trim($ref_number_from_post) . '-' . $bank_code;
		$voucher_number_in_db = trim($voucher_number_from_post);

		/*
		   Get the reference number and voucher numbers and then:
		   -Return 1 if ref_no and voucher_number exist
		   -Return 2 if ref_no exists and voucher_number does not exist
		   -Return 3 if ref_no does not exist and voucher number exists
		   -Return 0 if ref_no and voucher_number do not exist
		*/
		$result_reference_no = $this->db->select(array('ChqNo'))->get_where('voucher_header', array('ChqNo' => $reference_number_in_db, 'icpNo' => $this->session->center_id))->row_array('ChqNo');
		$result_voucher_no = $this->db->select(array('VNumber'))->get_where('voucher_header', array('VNumber' => $voucher_number_in_db, 'icpNo' => $this->session->center_id))->row_array('VNumber');

		if ((!empty($result_reference_no)) && (!empty($result_voucher_no))) {
			echo '1';
		} else if (!empty($result_reference_no) && empty($result_voucher_no)) {
			echo '2';
		} else if (!empty($result_voucher_no) && empty($result_reference_no)) {
			echo '3';
		} else {
			echo '0';
		}
	}

	function delete_empty_folder($storeFolder)
	{
		$iterator = new \FilesystemIterator($storeFolder);

		if (!$iterator->valid()) {
			rmdir($storeFolder);
		} else {
			foreach (new DirectoryIterator($storeFolder) as $fileInfo) {
				if ($fileInfo->isDot()) continue;

				if ($fileInfo->isFile()) {
					unlink($storeFolder . DS . $fileInfo);
				}
			}

			rmdir($storeFolder);
		}
	}



	function check_if_temp_session_is_empty($voucher_number)
	{

		$storeFolder = BASEPATH . DS . '..' . DS . 'uploads' . DS . 'temps' . DS . $this->dct_model->temp_folder_hash($voucher_number);

		if (file_exists($storeFolder)) {
			
			$this->delete_empty_folder($storeFolder);
		}

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