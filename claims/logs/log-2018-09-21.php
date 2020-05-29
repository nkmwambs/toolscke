<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-21 03:42:41 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-21 03:42:41 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-09-21 06:41:29 --> Query error: Duplicate entry '8a0576534d02e981b2671098f71d2834f9d50e14' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8a0576534d02e981b2671098f71d2834f9d50e14', '105.164.110.128', 1537512088, '__ci_last_regenerate|i:1537512088;admin_login|i:1;admin_id|s:4:\"2741\";login_user_id|s:4:\"2741\";name|s:6:\"EKorir\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE276\";cluster|s:8:\"Marsabit\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 06:41:29 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 06:41:29 --> Query error: Duplicate entry '8a0576534d02e981b2671098f71d2834f9d50e14' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8a0576534d02e981b2671098f71d2834f9d50e14', '105.164.110.128', 1537512089, '__ci_last_regenerate|i:1537512089;')
ERROR - 2018-09-21 06:41:29 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 06:49:11 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 06:49:38 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 06:50:08 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 06:50:52 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 06:54:08 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 06:54:21 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 06:57:35 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 06:58:01 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 07:04:05 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 07:14:14 --> Severity: Warning --> Invalid argument supplied for foreach() /home/compatl8/public_html/tools/claims/controllers/Medical.php 488
ERROR - 2018-09-21 07:17:57 --> Severity: Warning --> Invalid argument supplied for foreach() /home/compatl8/public_html/tools/claims/controllers/Medical.php 488
ERROR - 2018-09-21 07:19:13 --> Query error: Duplicate entry 'b5071493f83b24766958762b1c6f826d157c825c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b5071493f83b24766958762b1c6f826d157c825c', '197.182.217.230', 1537514353, '__ci_last_regenerate|i:1537514353;admin_login|i:1;admin_id|s:4:\"2786\";login_user_id|s:4:\"2786\";name|s:8:\"Odhiambo\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE710\";cluster|s:7:\"Kinango\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 07:19:13 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 07:19:14 --> Query error: Duplicate entry 'b5071493f83b24766958762b1c6f826d157c825c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b5071493f83b24766958762b1c6f826d157c825c', '197.182.217.230', 1537514354, '__ci_last_regenerate|i:1537514354;')
ERROR - 2018-09-21 07:19:14 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 07:19:55 --> Query error: Duplicate entry 'b5071493f83b24766958762b1c6f826d157c825c' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b5071493f83b24766958762b1c6f826d157c825c', '197.182.217.230', 1537514395, '__ci_last_regenerate|i:1537514395;')
ERROR - 2018-09-21 07:19:55 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 07:25:30 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 07:25:40 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 07:25:56 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 08:33:36 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 08:36:21 --> Query error: Duplicate entry 'f7e0d84771876b88a5eebf2ab33e365e17acaa33' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f7e0d84771876b88a5eebf2ab33e365e17acaa33', '154.77.140.76', 1537518981, '__ci_last_regenerate|i:1537518981;admin_login|i:1;admin_id|s:4:\"1868\";login_user_id|s:4:\"1868\";name|s:6:\"Kmercy\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE910\";cluster|s:12:\"Nairobi East\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 08:36:21 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 08:36:22 --> Query error: Duplicate entry 'f7e0d84771876b88a5eebf2ab33e365e17acaa33' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f7e0d84771876b88a5eebf2ab33e365e17acaa33', '154.77.140.76', 1537518982, '__ci_last_regenerate|i:1537518982;')
ERROR - 2018-09-21 08:36:22 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 08:36:58 --> Query error: Duplicate entry 'f7e0d84771876b88a5eebf2ab33e365e17acaa33' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f7e0d84771876b88a5eebf2ab33e365e17acaa33', '154.77.140.76', 1537519018, '__ci_last_regenerate|i:1537519018;admin_login|i:1;admin_id|s:4:\"1868\";login_user_id|s:4:\"1868\";name|s:6:\"Kmercy\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE910\";cluster|s:12:\"Nairobi East\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 08:36:58 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 08:37:00 --> Query error: Duplicate entry 'f7e0d84771876b88a5eebf2ab33e365e17acaa33' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f7e0d84771876b88a5eebf2ab33e365e17acaa33', '154.77.140.76', 1537519020, '__ci_last_regenerate|i:1537519020;')
ERROR - 2018-09-21 08:37:00 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 08:45:21 --> Query error: Duplicate entry '15375f5dfeb347351a69ff330045a0c5945ad701' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('15375f5dfeb347351a69ff330045a0c5945ad701', '154.79.77.82', 1537519521, '__ci_last_regenerate|i:1537519521;')
ERROR - 2018-09-21 08:45:21 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 09:19:04 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:19:41 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:20:20 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:21:17 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:21:46 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:22:41 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:23:07 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:23:17 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:51:01 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-21 09:51:01 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-09-21 09:51:22 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:52:16 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE770'
AND `rmks` = -1
ERROR - 2018-09-21 09:52:16 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-21 09:53:32 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 09:57:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 11:29:11 --> Query error: Duplicate entry 'ff1df1bc26996db846dd515dda353228a696ab77' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ff1df1bc26996db846dd515dda353228a696ab77', '197.177.192.95', 1537529351, '')
ERROR - 2018-09-21 11:29:11 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 11:36:57 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 11:41:31 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 11:42:28 --> Severity: Warning --> Invalid argument supplied for foreach() /home/compatl8/public_html/tools/claims/controllers/Medical.php 488
ERROR - 2018-09-21 11:42:48 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 11:43:28 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 11:50:12 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 11:53:45 --> Query error: Duplicate entry 'b2d12b91b8f698cbf913424735bb645e92325b17' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b2d12b91b8f698cbf913424735bb645e92325b17', '105.55.79.158', 1537530825, '__ci_last_regenerate|i:1537530825;admin_login|i:1;admin_id|s:4:\"1613\";login_user_id|s:4:\"1613\";name|s:8:\"Kathenge\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE719\";cluster|s:12:\"Meru-Tharaka\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 11:53:45 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 11:53:46 --> Query error: Duplicate entry 'b2d12b91b8f698cbf913424735bb645e92325b17' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b2d12b91b8f698cbf913424735bb645e92325b17', '105.55.79.158', 1537530826, '__ci_last_regenerate|i:1537530826;')
ERROR - 2018-09-21 11:53:46 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 11:54:09 --> Query error: Duplicate entry 'b2d12b91b8f698cbf913424735bb645e92325b17' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b2d12b91b8f698cbf913424735bb645e92325b17', '105.55.79.158', 1537530849, '__ci_last_regenerate|i:1537530849;admin_login|i:1;admin_id|s:4:\"1613\";login_user_id|s:4:\"1613\";name|s:8:\"Kathenge\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE719\";cluster|s:12:\"Meru-Tharaka\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 11:54:09 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 11:54:10 --> Query error: Duplicate entry 'b2d12b91b8f698cbf913424735bb645e92325b17' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b2d12b91b8f698cbf913424735bb645e92325b17', '105.55.79.158', 1537530850, '__ci_last_regenerate|i:1537530850;')
ERROR - 2018-09-21 11:54:10 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 12:06:27 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 12:06:46 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 12:07:17 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 12:09:19 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE706'
AND `rmks` = -1
ERROR - 2018-09-21 12:09:19 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-21 12:10:12 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE706'
AND `rmks` = -1
ERROR - 2018-09-21 12:10:12 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-09-21 13:25:58 --> Query error: Duplicate entry 'e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8', '196.96.51.161', 1537536358, '__ci_last_regenerate|i:1537536358;admin_login|i:1;admin_id|s:4:\"1117\";login_user_id|s:4:\"1117\";name|s:7:\"KSerrah\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE762\";cluster|s:15:\"Bamburi-Kanamai\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 13:25:58 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:25:59 --> Query error: Duplicate entry 'e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8', '196.96.51.161', 1537536359, '__ci_last_regenerate|i:1537536359;')
ERROR - 2018-09-21 13:25:59 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:30:05 --> Query error: Duplicate entry 'e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8', '197.182.59.113', 1537536605, '__ci_last_regenerate|i:1537536605;admin_login|i:1;admin_id|s:4:\"1117\";login_user_id|s:4:\"1117\";name|s:7:\"KSerrah\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE762\";cluster|s:15:\"Bamburi-Kanamai\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 13:30:05 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:30:36 --> Query error: Duplicate entry '92e80b187a2b4e2e39bddecb16e6c452572ad27b' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('92e80b187a2b4e2e39bddecb16e6c452572ad27b', '197.182.59.113', 1537536636, '__ci_last_regenerate|i:1537536636;admin_login|i:1;admin_id|s:4:\"1117\";login_user_id|s:4:\"1117\";name|s:7:\"KSerrah\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE762\";cluster|s:15:\"Bamburi-Kanamai\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 13:30:36 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:30:38 --> Query error: Duplicate entry 'e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8', '197.182.59.113', 1537536638, '__ci_last_regenerate|i:1537536638;admin_login|i:1;admin_id|s:4:\"1117\";login_user_id|s:4:\"1117\";name|s:7:\"KSerrah\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE762\";cluster|s:15:\"Bamburi-Kanamai\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 13:30:38 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:30:38 --> Query error: Duplicate entry '92e80b187a2b4e2e39bddecb16e6c452572ad27b' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('92e80b187a2b4e2e39bddecb16e6c452572ad27b', '197.182.59.113', 1537536638, '__ci_last_regenerate|i:1537536638;')
ERROR - 2018-09-21 13:30:38 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:30:48 --> Query error: Duplicate entry '92e80b187a2b4e2e39bddecb16e6c452572ad27b' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('92e80b187a2b4e2e39bddecb16e6c452572ad27b', '197.182.59.113', 1537536648, '__ci_last_regenerate|i:1537536648;')
ERROR - 2018-09-21 13:30:48 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:30:48 --> Query error: Duplicate entry 'e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8', '197.182.59.113', 1537536648, '__ci_last_regenerate|i:1537536648;')
ERROR - 2018-09-21 13:30:48 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:34:32 --> Query error: Duplicate entry '92e80b187a2b4e2e39bddecb16e6c452572ad27b' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('92e80b187a2b4e2e39bddecb16e6c452572ad27b', '197.182.59.113', 1537536872, '__ci_last_regenerate|i:1537536872;admin_login|i:1;admin_id|s:4:\"1117\";login_user_id|s:4:\"1117\";name|s:7:\"KSerrah\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE762\";cluster|s:15:\"Bamburi-Kanamai\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 13:34:32 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:34:53 --> Query error: Duplicate entry '92e80b187a2b4e2e39bddecb16e6c452572ad27b' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('92e80b187a2b4e2e39bddecb16e6c452572ad27b', '197.182.59.113', 1537536893, '__ci_last_regenerate|i:1537536893;')
ERROR - 2018-09-21 13:34:53 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:35:59 --> Query error: Duplicate entry 'e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8', '197.182.59.113', 1537536959, '__ci_last_regenerate|i:1537536959;admin_login|i:1;admin_id|s:4:\"1117\";login_user_id|s:4:\"1117\";name|s:7:\"KSerrah\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE762\";cluster|s:15:\"Bamburi-Kanamai\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 13:35:59 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:36:02 --> Query error: Duplicate entry 'e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e97447c9d1eb14b1a3f4be5820b7d0f7fe0f72b8', '197.182.59.113', 1537536962, '__ci_last_regenerate|i:1537536962;')
ERROR - 2018-09-21 13:36:02 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 13:44:53 --> 404 Page Not Found: Partner/assets
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 13:50:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-09-21 14:09:34 --> Query error: Duplicate entry 'fb40f6b383b4820dd6fdad18c794d21817d34b3a' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fb40f6b383b4820dd6fdad18c794d21817d34b3a', '197.177.13.64', 1537538974, '__ci_last_regenerate|i:1537538974;admin_login|i:1;admin_id|s:4:\"2476\";login_user_id|s:4:\"2476\";name|s:10:\"HMwambingu\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE484\";cluster|s:12:\"Taita-Taveta\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 14:09:34 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 14:09:35 --> Query error: Duplicate entry 'fb40f6b383b4820dd6fdad18c794d21817d34b3a' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fb40f6b383b4820dd6fdad18c794d21817d34b3a', '197.177.13.64', 1537538975, '__ci_last_regenerate|i:1537538975;')
ERROR - 2018-09-21 14:09:35 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 14:09:57 --> Query error: Duplicate entry 'fb40f6b383b4820dd6fdad18c794d21817d34b3a' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fb40f6b383b4820dd6fdad18c794d21817d34b3a', '197.177.13.64', 1537538997, '__ci_last_regenerate|i:1537538997;admin_login|i:1;admin_id|s:4:\"2476\";login_user_id|s:4:\"2476\";name|s:10:\"HMwambingu\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE484\";cluster|s:12:\"Taita-Taveta\";app_name|s:6:\"claims\";')
ERROR - 2018-09-21 14:09:57 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-09-21 14:09:57 --> Query error: Duplicate entry 'fb40f6b383b4820dd6fdad18c794d21817d34b3a' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fb40f6b383b4820dd6fdad18c794d21817d34b3a', '197.177.13.64', 1537538997, '__ci_last_regenerate|i:1537538997;')
ERROR - 2018-09-21 14:09:57 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
