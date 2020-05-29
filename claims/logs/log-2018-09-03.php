<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-03 18:23:22 --> Query error: Got error 28 from storage engine - Invalid query: SHOW COLUMNS FROM `language`
ERROR - 2018-09-03 18:23:22 --> Severity: error --> Exception: Call to a member function result_array() on boolean /home/compatl8/public_html/tools/system/database/DB_driver.php 1324
ERROR - 2018-09-03 18:23:36 --> Query error: Got error 28 from storage engine - Invalid query: SHOW COLUMNS FROM `language`
ERROR - 2018-09-03 18:23:36 --> Severity: error --> Exception: Call to a member function result_array() on boolean /home/compatl8/public_html/tools/system/database/DB_driver.php 1324
ERROR - 2018-09-03 19:24:07 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-09-03 19:24:07 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
