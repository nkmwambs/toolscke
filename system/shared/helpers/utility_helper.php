<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('asset_url')) {
	function asset_url() {
		return base_url() . '../assets/';
	}

}

if (!function_exists('create_config_items')) {
	function create_config_items() {

		$CI = &get_instance();

		//Load dynamic config items

		$system_config = $CI -> db -> get('system_config');

		if ($system_config -> result_object()) {
			foreach ($system_config->result_object() as $config_item) {
				$CI -> config -> set_item($config_item -> config_type, $config_item -> config_value);
			}
		}
	}

}

if (!function_exists('months_elapsed')) {
	function months_elapsed($date1, $date2) {
		$datetime1 = date_create($date1);
		$datetime2 = date_create($date2);
		$interval = date_diff($datetime1, $datetime2);

		return $interval -> format('%m');
	}

}

if (!function_exists('days_elapsed')) {
	function days_elapsed($date1, $date2) {
		$datetime1 = date_create($date1);
		$datetime2 = date_create($date2);
		$interval = date_diff($datetime1, $datetime2);

		return $interval -> format('%a');
	}

}
