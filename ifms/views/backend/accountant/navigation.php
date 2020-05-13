<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');?>
    
<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('uploads/logo.png');?>"  class="" width="200"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>ifms.php/accountant/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        
        <li class="<?php
        		if (
	        			$page_name == 'fund_balance_report' ||
	                    $page_name == 'expense_report'||
						$page_name == 'budget_variance_report'
					)
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-money"></i>
                <span><?php echo get_phrase('financial_reports'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'fund_balance_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url("ifms.php/readonly/fund_balance_report"); ?>">
                        <span><i class="fa fa-bell-o"></i> <?php echo get_phrase('fund_balance_report'); ?></span>
                    </a>
                </li>

                <!-- <li class="<?php if ($page_name == 'expense_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url("ifms.php/accountant/expense_report"); ?>">
                        <span><i class="entypo-briefcase"></i> <?php echo get_phrase('expense_report'); ?></span>
                    </a>
                </li> 
                
                <li class="<?php if ($page_name == 'budget_variance_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url("ifms.php/accountant/budget_variance_report"); ?>">
                        <span><i class="fa fa-adjust"></i> <?php echo get_phrase('budget_variance_report'); ?></span>
                    </a>
                </li>  -->
             
            </ul>
        </li>
        
        <!-- Switch Board 
        <li class="<?php if ($page_name == 'switchboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>ifms.php/partner/switchboard">
                <i class="entypo-retweet"></i>
                <span><?php echo get_phrase('switchboard'); ?></span>
            </a>
        </li>-->
        
        
        <!-- CHART OF ACCOUNTS 
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>ifms.php/partner/finance_settings">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('accounts_chart'); ?></span>
            </a>
        </li>
        -->
			
        


    </ul>

</div>
