<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-07 11:29:09 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `rec` = '4174'
ERROR - 2018-10-07 11:29:09 --> Severity: error --> Exception: Call to a member function row() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 256
ERROR - 2018-10-07 11:29:30 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT *
FROM `app_medical_claims`
WHERE `rec` = '4174'
ERROR - 2018-10-07 11:29:30 --> Severity: error --> Exception: Call to a member function row() on boolean /home/compatl8/public_html/tools/claims/controllers/Medical.php 256
ERROR - 2018-10-07 11:30:20 --> Severity: Warning --> file_get_contents(uploads/document/medical/claims/11123/PAYMENT_RECEIPT_FOR_PAMELA.pdf): failed to open stream: No such file or directory /home/compatl8/public_html/tools/claims/controllers/Partner.php 560
ERROR - 2018-10-07 19:06:46 --> Query error: Table 'compatl8_mvc.app_medical_claims' doesn't exist - Invalid query: SELECT `name`, `incident_sub_category_id`, SUM(amtReim) as Cost
FROM `app_medical_claims`
JOIN `illness_sub_category` ON `illness_sub_category`.`illness_sub_category_id`=`app_medical_claims`.`incident_sub_category_id`
GROUP BY `incident_sub_category_id`
ERROR - 2018-10-07 19:06:46 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/claims/views/backend/facilitator/dashboard.php 111
