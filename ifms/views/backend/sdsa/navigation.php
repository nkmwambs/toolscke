<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('uploads/logo.png');?>"  style="max-height:60px;"/>
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
        
        <li class="<?php if ($page_name == 'civ_report') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>ifms.php/facilitator/civ_report">
                <i class="entypo-chart-pie"></i>
                <span><?php echo get_phrase('C.I.Vs'); ?></span>
            </a>
        </li>
        
        
        <li class="<?php
        if ($page_name == 'fo_fund_balance_report')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="entypo-layout"></i>
                <span><?php echo get_phrase('financial_reports'); ?></span>
            </a>
            <ul>
                
                <li class="<?php if ($page_name == 'fo_fund_balance_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>ifms.php/readonly/fo_fund_balance_report">
                        <span><i class="fa fa-chart-line" aria-hidden="true"></i> <?php echo get_phrase('fund_balance'); ?></span>
                    </a>
                </li>
			</ul>
		</li>	
			
        


    </ul>

</div>
