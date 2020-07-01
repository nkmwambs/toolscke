<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-06 07:11:19 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-06 07:11:19 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-09-06 08:00:10 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-06 09:52:49 --> Query error: Duplicate entry 'b9057897ca166b2b1baf7ec8e64a51c44b3e824c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b9057897ca166b2b1baf7ec8e64a51c44b3e824c', '105.160.134.64', 1536227569, '__ci_last_regenerate|i:1536227569;admin_login|i:1;admin_id|s:4:\"2385\";login_user_id|s:4:\"2385\";name|s:7:\"Dotieno\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE261\";cluster|s:7:\"Homabay\";app_name|s:6:\"claims\";')
ERROR - 2018-09-06 09:52:49 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-06 09:52:51 --> Query error: Duplicate entry 'b9057897ca166b2b1baf7ec8e64a51c44b3e824c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b9057897ca166b2b1baf7ec8e64a51c44b3e824c', '105.160.134.64', 1536227571, '__ci_last_regenerate|i:1536227571;')
ERROR - 2018-09-06 09:52:51 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-06 09:53:05 --> Query error: Duplicate entry 'b9057897ca166b2b1baf7ec8e64a51c44b3e824c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b9057897ca166b2b1baf7ec8e64a51c44b3e824c', '105.160.134.64', 1536227585, '__ci_last_regenerate|i:1536227585;admin_login|i:1;admin_id|s:4:\"2385\";login_user_id|s:4:\"2385\";name|s:7:\"Dotieno\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE261\";cluster|s:7:\"Homabay\";app_name|s:6:\"claims\";')
ERROR - 2018-09-06 09:53:05 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-06 09:53:06 --> Query error: Duplicate entry 'b9057897ca166b2b1baf7ec8e64a51c44b3e824c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b9057897ca166b2b1baf7ec8e64a51c44b3e824c', '105.160.134.64', 1536227586, '__ci_last_regenerate|i:1536227586;')
ERROR - 2018-09-06 09:53:06 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-06 09:53:33 --> Query error: Duplicate entry 'b9057897ca166b2b1baf7ec8e64a51c44b3e824c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b9057897ca166b2b1baf7ec8e64a51c44b3e824c', '105.160.134.64', 1536227613, '__ci_last_regenerate|i:1536227613;admin_login|i:1;admin_id|s:4:\"2385\";login_user_id|s:4:\"2385\";name|s:7:\"Dotieno\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE261\";cluster|s:7:\"Homabay\";app_name|s:6:\"claims\";')
ERROR - 2018-09-06 09:53:33 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-06 09:53:34 --> Query error: Duplicate entry 'b9057897ca166b2b1baf7ec8e64a51c44b3e824c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b9057897ca166b2b1baf7ec8e64a51c44b3e824c', '105.160.134.64', 1536227614, '__ci_last_regenerate|i:1536227614;')
ERROR - 2018-09-06 09:53:34 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-06 09:54:25 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-06 09:55:21 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE261'
AND `rmks` = -1
ERROR - 2018-09-06 09:55:21 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 09:55:43 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE261'
AND `rmks` = -1
ERROR - 2018-09-06 09:55:43 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 09:55:47 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE261'
AND `rmks` = -1
ERROR - 2018-09-06 09:55:47 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 09:55:50 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE261'
AND `rmks` = -1
ERROR - 2018-09-06 09:55:50 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 09:55:53 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE261'
AND `rmks` = -1
ERROR - 2018-09-06 09:55:53 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 10:05:55 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-06 10:35:34 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-06 10:35:34 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-09-06 10:37:17 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-06 10:37:17 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-09-06 13:28:15 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE465'
AND `rmks` = -1
ERROR - 2018-09-06 13:28:15 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 13:29:22 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE465'
AND `rmks` = -1
ERROR - 2018-09-06 13:29:22 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 13:30:20 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE465'
AND `rmks` = -1
ERROR - 2018-09-06 13:30:20 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 13:30:27 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE465'
AND `rmks` = -1
ERROR - 2018-09-06 13:30:27 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 13:30:33 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE465'
AND `rmks` = -1
ERROR - 2018-09-06 13:30:33 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 13:30:50 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE465'
AND `rmks` = -1
ERROR - 2018-09-06 13:30:50 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:32:25 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:36:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:39:59 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE465'
AND `rmks` = -1
ERROR - 2018-09-06 13:39:59 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 13:42:16 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:37 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:50:52 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:06 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-06 16:51:22 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
