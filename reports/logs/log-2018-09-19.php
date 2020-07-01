<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-19 13:08:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '=''' at line 1 - Invalid query: SELECT icpNo,totalBal,closureDate,allowEdit,submitted,systemOpening,stmp,funds,amount FROM `opfundsbalheader` LEFT JOIN `opfundsbal` ON `opfundsbalheader`.`balHdID` = `opfundsbal`.`balHdID`    WHERE  =''   
ERROR - 2018-09-19 13:08:39 --> Severity: error --> Exception: Call to a member function result_object() on boolean /home/compatl8/public_html/tools/reports/controllers/Admin.php 52
