<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-09 05:49:51 --> 404 Page Not Found: Partner/assets
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:05:15 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 06:42:21 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-10-09 06:42:21 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-10-09 07:10:28 --> Query error: Duplicate entry '545b1fda66684813bb0d2d3051b7570c78c5e859' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('545b1fda66684813bb0d2d3051b7570c78c5e859', '154.122.81.139', 1539069028, '')
ERROR - 2018-10-09 07:10:28 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 07:10:31 --> Query error: Duplicate entry '545b1fda66684813bb0d2d3051b7570c78c5e859' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('545b1fda66684813bb0d2d3051b7570c78c5e859', '154.122.81.139', 1539069031, 'flash_message|s:28:\"Claim submitted Successfully\";__ci_vars|a:1:{s:13:\"flash_message\";s:3:\"new\";}')
ERROR - 2018-10-09 07:10:31 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 07:10:37 --> Query error: Duplicate entry '545b1fda66684813bb0d2d3051b7570c78c5e859' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('545b1fda66684813bb0d2d3051b7570c78c5e859', '154.122.81.139', 1539069037, '__ci_last_regenerate|i:1539069037;admin_login|i:1;admin_id|s:4:\"2860\";login_user_id|s:4:\"2860\";name|s:7:\"Pnzioki\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE912\";cluster|s:12:\"Nairobi West\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 07:10:37 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 07:10:38 --> Query error: Duplicate entry '545b1fda66684813bb0d2d3051b7570c78c5e859' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('545b1fda66684813bb0d2d3051b7570c78c5e859', '154.122.81.139', 1539069038, '__ci_last_regenerate|i:1539069038;')
ERROR - 2018-10-09 07:10:38 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 07:49:46 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/compatl8/public_html/tools/claims/views/backend/index.php 50
ERROR - 2018-10-09 07:49:46 --> Severity: Warning --> include(/navigation.php): failed to open stream: No such file or directory /home/compatl8/public_html/tools/claims/views/backend/index.php 50
ERROR - 2018-10-09 07:49:46 --> Severity: Warning --> include(): Failed opening '/navigation.php' for inclusion (include_path='.:/opt/cpanel/ea-php70/root/usr/share/pear') /home/compatl8/public_html/tools/claims/views/backend/index.php 50
ERROR - 2018-10-09 07:49:46 --> Severity: Warning --> include(/edit_medical_claim.php): failed to open stream: No such file or directory /home/compatl8/public_html/tools/claims/views/backend/index.php 60
ERROR - 2018-10-09 07:49:46 --> Severity: Warning --> include(/edit_medical_claim.php): failed to open stream: No such file or directory /home/compatl8/public_html/tools/claims/views/backend/index.php 60
ERROR - 2018-10-09 07:49:46 --> Severity: Warning --> include(): Failed opening '/edit_medical_claim.php' for inclusion (include_path='.:/opt/cpanel/ea-php70/root/usr/share/pear') /home/compatl8/public_html/tools/claims/views/backend/index.php 60
ERROR - 2018-10-09 08:24:42 --> Query error: Duplicate entry 'b077e5ffb9365e8f792feafb7866eea6c60e2ce5' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b077e5ffb9365e8f792feafb7866eea6c60e2ce5', '196.107.186.220', 1539073482, '__ci_last_regenerate|i:1539073482;')
ERROR - 2018-10-09 08:24:42 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 08:26:20 --> Query error: Duplicate entry 'b077e5ffb9365e8f792feafb7866eea6c60e2ce5' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b077e5ffb9365e8f792feafb7866eea6c60e2ce5', '196.107.186.220', 1539073580, '__ci_last_regenerate|i:1539073580;admin_login|i:1;admin_id|s:4:\"2897\";login_user_id|s:4:\"2897\";name|s:10:\"PatienceNG\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE252\";cluster|s:8:\"Marsabit\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 08:26:20 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 08:26:20 --> Query error: Duplicate entry 'b077e5ffb9365e8f792feafb7866eea6c60e2ce5' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b077e5ffb9365e8f792feafb7866eea6c60e2ce5', '196.107.186.220', 1539073580, '__ci_last_regenerate|i:1539073580;')
ERROR - 2018-10-09 08:26:20 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:15:55 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:24:38 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 09:26:18 --> Query error: Duplicate entry '6e13f143a0c17a622e6cbec03dc71d5b4e328bb0' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6e13f143a0c17a622e6cbec03dc71d5b4e328bb0', '196.105.61.3', 1539077178, '__ci_last_regenerate|i:1539077178;admin_login|i:1;admin_id|s:4:\"2511\";login_user_id|s:4:\"2511\";name|s:6:\"JKakio\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE284\";cluster|s:8:\"Laikipia\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 09:26:18 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 09:26:18 --> Query error: Duplicate entry '6e13f143a0c17a622e6cbec03dc71d5b4e328bb0' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6e13f143a0c17a622e6cbec03dc71d5b4e328bb0', '196.105.61.3', 1539077178, '__ci_last_regenerate|i:1539077178;')
ERROR - 2018-10-09 09:26:18 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 09:35:15 --> Query error: Duplicate entry '6e13f143a0c17a622e6cbec03dc71d5b4e328bb0' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6e13f143a0c17a622e6cbec03dc71d5b4e328bb0', '105.61.82.16', 1539077715, '__ci_last_regenerate|i:1539077715;admin_login|i:1;admin_id|s:4:\"2511\";login_user_id|s:4:\"2511\";name|s:6:\"JKakio\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE284\";cluster|s:8:\"Laikipia\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 09:35:15 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 09:35:16 --> Query error: Duplicate entry '6e13f143a0c17a622e6cbec03dc71d5b4e328bb0' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6e13f143a0c17a622e6cbec03dc71d5b4e328bb0', '105.61.82.16', 1539077716, '__ci_last_regenerate|i:1539077716;')
ERROR - 2018-10-09 09:35:16 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 09:55:11 --> Query error: Duplicate entry '4f4c1b079369e51cfb148299379a1efcb403b9ba' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('4f4c1b079369e51cfb148299379a1efcb403b9ba', '154.77.128.191', 1539078911, '__ci_last_regenerate|i:1539078911;admin_login|i:1;admin_id|s:4:\"2578\";login_user_id|s:4:\"2578\";name|s:7:\"Kimuyuc\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE727\";cluster|s:12:\"Nairobi East\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 09:55:11 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 09:55:11 --> Query error: Duplicate entry '4f4c1b079369e51cfb148299379a1efcb403b9ba' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('4f4c1b079369e51cfb148299379a1efcb403b9ba', '154.77.128.191', 1539078911, '__ci_last_regenerate|i:1539078911;')
ERROR - 2018-10-09 09:55:11 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 10:05:59 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-10-09 10:05:59 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
ERROR - 2018-10-09 12:23:34 --> Query error: Duplicate entry 'ab8964cb41f8f65df03dec350ad7d80433bf239e' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ab8964cb41f8f65df03dec350ad7d80433bf239e', '197.232.61.208', 1539087814, '__ci_last_regenerate|i:1539087814;admin_login|i:1;admin_id|s:4:\"2412\";login_user_id|s:4:\"2412\";name|s:6:\"Samson\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE500\";cluster|s:16:\"Kaloleni-Mombasa\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 12:23:34 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 12:23:35 --> Query error: Duplicate entry 'ab8964cb41f8f65df03dec350ad7d80433bf239e' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ab8964cb41f8f65df03dec350ad7d80433bf239e', '197.232.61.208', 1539087815, '__ci_last_regenerate|i:1539087815;')
ERROR - 2018-10-09 12:23:35 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:08:46 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:35 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:11:59 --> Query error: Duplicate entry '67d7ae5582d58d8e834e026c6762fc5f20ddd781' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('67d7ae5582d58d8e834e026c6762fc5f20ddd781', '154.79.115.79', 1539090719, '__ci_last_regenerate|i:1539090719;admin_login|i:1;admin_id|s:4:\"1875\";login_user_id|s:4:\"1875\";name|s:10:\"Mutukujose\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE372\";cluster|s:12:\"Nairobi East\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 13:11:59 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 13:12:00 --> Query error: Duplicate entry '67d7ae5582d58d8e834e026c6762fc5f20ddd781' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('67d7ae5582d58d8e834e026c6762fc5f20ddd781', '154.79.115.79', 1539090720, '__ci_last_regenerate|i:1539090720;')
ERROR - 2018-10-09 13:12:00 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 13:12:17 --> Query error: Duplicate entry '67d7ae5582d58d8e834e026c6762fc5f20ddd781' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('67d7ae5582d58d8e834e026c6762fc5f20ddd781', '154.79.115.79', 1539090737, '__ci_last_regenerate|i:1539090737;admin_login|i:1;admin_id|s:4:\"1875\";login_user_id|s:4:\"1875\";name|s:10:\"Mutukujose\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE372\";cluster|s:12:\"Nairobi East\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 13:12:17 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 13:12:18 --> Query error: Duplicate entry '67d7ae5582d58d8e834e026c6762fc5f20ddd781' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('67d7ae5582d58d8e834e026c6762fc5f20ddd781', '154.79.115.79', 1539090738, '__ci_last_regenerate|i:1539090738;')
ERROR - 2018-10-09 13:12:18 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 13:12:23 --> 404 Page Not Found: Partner/assets
ERROR - 2018-10-09 13:18:38 --> Query error: Duplicate entry '67d7ae5582d58d8e834e026c6762fc5f20ddd781' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('67d7ae5582d58d8e834e026c6762fc5f20ddd781', '154.79.115.79', 1539091118, '__ci_last_regenerate|i:1539091118;admin_login|i:1;admin_id|s:4:\"1875\";login_user_id|s:4:\"1875\";name|s:10:\"Mutukujose\";logged_user_level|s:1:\"1\";login_type|s:7:\"partner\";center_id|s:5:\"KE372\";cluster|s:12:\"Nairobi East\";app_name|s:6:\"claims\";')
ERROR - 2018-10-09 13:18:38 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 13:18:38 --> Query error: Duplicate entry '67d7ae5582d58d8e834e026c6762fc5f20ddd781' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('67d7ae5582d58d8e834e026c6762fc5f20ddd781', '154.79.115.79', 1539091118, '__ci_last_regenerate|i:1539091118;')
ERROR - 2018-10-09 13:18:38 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 13:22:17 --> Query error: Duplicate entry 'aefb8fb660436d7b19d653ccfb99ca1b4e6b974e' for key 'PRIMARY' - Invalid query: INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('aefb8fb660436d7b19d653ccfb99ca1b4e6b974e', '41.80.23.38', 1539091337, '__ci_last_regenerate|i:1539091337;')
ERROR - 2018-10-09 13:22:17 --> Severity: Warning --> session_write_close(): Failed to write session data (user). Please verify that the current setting of session.save_path is correct (ci_sessions) Unknown 0
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:29:17 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:36:17 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE372'
AND `rmks` = -1
ERROR - 2018-10-09 13:36:17 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-10-09 13:36:35 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE372'
AND `rmks` = -1
ERROR - 2018-10-09 13:36:35 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-10-09 13:36:40 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE372'
AND `rmks` = -1
ERROR - 2018-10-09 13:36:40 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-10-09 13:36:43 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `proNo` = 'KE372'
AND `rmks` = -1
ERROR - 2018-10-09 13:36:43 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 227
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:00 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:38:51 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 13:39:11 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 14:56:08 --> 404 Page Not Found: Partner/assets
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:03 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 15:04:04 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given /home/compatl8/public_html/tools/system/libraries/Email.php 1125
ERROR - 2018-10-09 18:34:07 --> 404 Page Not Found: Partner/assets
ERROR - 2018-10-09 18:34:45 --> 404 Page Not Found: Partner/assets
ERROR - 2018-10-09 18:35:46 --> 404 Page Not Found: Partner/assets
