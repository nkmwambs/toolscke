<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-17 08:04:20 --> Query error: Duplicate entry 'ad7c42c5711a5f2cccd8b90818b0d0dc560dc9e8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ad7c42c5711a5f2cccd8b90818b0d0dc560dc9e8', '154.123.99.108', 1537171460, '__ci_last_regenerate|i:1537171460;admin_login|i:1;admin_id|s:4:\"1824\";login_user_id|s:4:\"1824\";name|s:7:\"Mndunda\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE742\";cluster|s:15:\"Isinya-Machakos\";app_name|s:8:\"training\";')
ERROR - 2018-09-17 08:04:20 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-17 08:04:21 --> Query error: Duplicate entry 'ad7c42c5711a5f2cccd8b90818b0d0dc560dc9e8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ad7c42c5711a5f2cccd8b90818b0d0dc560dc9e8', '154.123.99.108', 1537171461, '__ci_last_regenerate|i:1537171461;')
ERROR - 2018-09-17 08:04:21 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-17 10:33:37 --> Query error: Table 'compatl8_mvc.lemresponse' doesn't exist - Invalid query: SELECT *
FROM `lemresponse`
WHERE `user_id` = '2017'
AND `event_id` = ''
AND `status` = '0'
ERROR - 2018-09-17 10:33:37 --> Severity: error --> Exception: Call to a member function row() on boolean /home/compatl8/public_html/tools/training/controllers/Partner.php 239
