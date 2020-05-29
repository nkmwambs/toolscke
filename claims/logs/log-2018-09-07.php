<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 05:04:56 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 06:14:05 --> Severity: Warning --> file_get_contents(uploads/document/medical/claims/9415/KE026100174-Nephy_Amondi.pdf): failed to open stream: No such file or directory /home/compatl8/public_html/tools/claims/controllers/Partner.php 560
ERROR - 2018-09-07 06:23:59 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-07 06:25:12 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `rec` = '837'
ERROR - 2018-09-07 06:25:12 --> Severity: error --> Exception: Call to a member function row() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 256
ERROR - 2018-09-07 06:25:25 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `rec` = '837'
ERROR - 2018-09-07 06:25:25 --> Severity: error --> Exception: Call to a member function row() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 256
ERROR - 2018-09-07 06:25:44 --> Severity: Warning --> file_get_contents(uploads/document/medical/claims/9415/KE026100174-Nephy_Amondi.pdf): failed to open stream: No such file or directory /home/compatl8/public_html/tools/claims/controllers/Partner.php 560
ERROR - 2018-09-07 06:27:29 --> Severity: Warning --> file_get_contents(uploads/document/medical/claims/9415/KE026100174-Nephy_Amondi.pdf): failed to open stream: No such file or directory /home/compatl8/public_html/tools/claims/controllers/Partner.php 560
ERROR - 2018-09-07 07:49:28 --> Query error: Duplicate entry 'fb6b367cb388086f3b30dd7cf3f7c6c487868bfb' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fb6b367cb388086f3b30dd7cf3f7c6c487868bfb', '154.122.198.148', 1536306568, '__ci_last_regenerate|i:1536306568;')
ERROR - 2018-09-07 07:49:28 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-07 07:54:04 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-07 08:32:45 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-07 09:11:38 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-07 09:11:38 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-09-07 09:25:12 --> Severity: Warning --> Invalid argument supplied for foreach() /home/compatl8/public_html/tools/claims/controllers/Medical.php 488
ERROR - 2018-09-07 09:36:52 --> Query error: Duplicate entry '6451b3a68dfd0b47194d7ad16f6dbd4313e0f8b4' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6451b3a68dfd0b47194d7ad16f6dbd4313e0f8b4', '105.54.159.21', 1536313012, '__ci_last_regenerate|i:1536313012;admin_login|i:1;admin_id|s:4:\"1117\";login_user_id|s:4:\"1117\";name|s:7:\"KSerrah\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE762\";cluster|s:15:\"Bamburi-Kanamai\";app_name|s:6:\"claims\";')
ERROR - 2018-09-07 09:36:52 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-07 09:36:53 --> Query error: Duplicate entry '6451b3a68dfd0b47194d7ad16f6dbd4313e0f8b4' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6451b3a68dfd0b47194d7ad16f6dbd4313e0f8b4', '105.54.159.21', 1536313013, '__ci_last_regenerate|i:1536313013;')
ERROR - 2018-09-07 09:36:53 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-07 09:43:32 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-07 09:43:32 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-09-07 09:43:41 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-07 09:43:41 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-09-07 10:27:35 --> Query error: Duplicate entry 'bbbc30474ef80f9c5da34a729fdee53ae00f2e8f' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('bbbc30474ef80f9c5da34a729fdee53ae00f2e8f', '105.55.229.33', 1536316055, '')
ERROR - 2018-09-07 10:27:35 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-07 10:27:38 --> Query error: Duplicate entry 'bbbc30474ef80f9c5da34a729fdee53ae00f2e8f' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('bbbc30474ef80f9c5da34a729fdee53ae00f2e8f', '105.55.229.33', 1536316058, 'flash_message|s:28:\"Claim submitted Successfully\";__ci_vars|a:1:{s:13:\"flash_message\";s:3:\"new\";}')
ERROR - 2018-09-07 10:27:38 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-07 10:27:47 --> Query error: Duplicate entry 'bbbc30474ef80f9c5da34a729fdee53ae00f2e8f' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('bbbc30474ef80f9c5da34a729fdee53ae00f2e8f', '105.55.229.33', 1536316067, '__ci_last_regenerate|i:1536316067;')
ERROR - 2018-09-07 10:27:47 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-07 11:50:50 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:00:36 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-07 12:25:59 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-07 12:28:14 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE900'
AND `rmks` = -1
ERROR - 2018-09-07 12:28:14 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-07 12:28:43 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE900'
AND `rmks` = -1
ERROR - 2018-09-07 12:28:43 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-07 12:31:31 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE900'
AND `rmks` = -1
ERROR - 2018-09-07 12:31:31 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-07 12:31:38 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE900'
AND `rmks` = -1
ERROR - 2018-09-07 12:31:38 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-07 12:36:35 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `rec` = '11278'
ERROR - 2018-09-07 12:36:35 --> Severity: error --> Exception: Call to a member function row() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 443
ERROR - 2018-09-07 12:40:57 --> 404 Page Not Found: Partner/assets
