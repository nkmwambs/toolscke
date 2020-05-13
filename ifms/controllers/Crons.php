<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Crons extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> library('session');
	}

	private function emptyDir($dir) {
		if (is_dir($dir)) {
			$scn = scandir($dir);
			foreach ($scn as $files) {
				if ($files !== '.') {
					if ($files !== '..') {
						if (!is_dir($dir . '/' . $files)) {
							unlink($dir . '/' . $files);
						} else {
							emptyDir($dir . '/' . $files);
							rmdir($dir . '/' . $files);
						}
					}
				}
			}
		}
	}

	private function clear_cached_data() {

		$database_cache_dir = "accountant+dashboard";
		$page_cache_dir = "ifms/cache";
		
		$this -> emptyDir($database_cache_dir);
		$this -> emptyDir($page_cache_dir);
		
		rmdir($database_cache_dir);
	}

	public function minute_jobs() {
		$this -> clear_cached_data();
	}

	public function semi_hourly_jobs() {

	}

	public function hourly_jobs() {

	}

	public function daily_jobs() {

	}

	public function weekly_jobs() {

	}

}
