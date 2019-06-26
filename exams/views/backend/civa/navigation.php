<div class="sidebar-menu">
    <header class="logo-env" >
    	
        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url();?>uploads/logo.png"  style="max-height:60px;"/>
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

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>exams.php/civa/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        
        <li class="<?php
        if ($page_name == 'kcpe' ||
                $page_name == 'kcse')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('exam_results'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'kcpe') echo 'active'; ?> ">
                    <a href="<?php echo base_url("exams.php/civa/kcpe"); ?>">
                        <span><i class="entypo-cog"></i> <?php echo get_phrase('KCPE_results'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'kcse') echo 'active'; ?> ">
                    <a href="<?php echo base_url("exams.php/civa/kcse"); ?>">
                        <span><i class="entypo-mobile"></i> <?php echo get_phrase('KCSE_results'); ?></span>
                    </a>
                </li>
               
				               
            </ul>
        </li>
        
       

    </ul>

</div>