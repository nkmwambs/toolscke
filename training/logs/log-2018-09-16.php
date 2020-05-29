<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-16 18:55:39 --> Query error: Table 'compatl8_mvc.lemresponse' doesn't exist - Invalid query: SELECT *
FROM `lemresponse`
WHERE `user_id` = '848'
AND `event_id` = ''
AND `status` = '0'
ERROR - 2018-09-16 18:55:39 --> Severity: error --> Exception: Call to a member function row() on boolean /home/compatl8/public_html/tools/training/controllers/Partner.php 239
ERROR - 2018-09-16 19:05:11 --> Query error: Duplicate entry '1b211006521f900cd25ac14f11092b0c33cf9e95' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1b211006521f900cd25ac14f11092b0c33cf9e95', '41.90.5.98', 1537124711, '__ci_last_regenerate|i:1537124711;')
ERROR - 2018-09-16 19:05:11 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
