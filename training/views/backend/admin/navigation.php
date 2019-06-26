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
            <a href="<?php echo base_url(); ?>training.php/admin/dashboard">
                <i class="entypo-calendar"></i>
                <span><?php echo get_phrase('training_calendar'); ?></span>
            </a>
        </li>
        
        <!-- Learning Manager -->
        <li class="<?php if ($page_name == 'Learning_Manager') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>training.php/admin/lms">
                <i class="entypo-window"></i>
                <span><?php echo get_phrase('learning_manager'); ?></span>
            </a>
        </li>
        
        <!-- Training Projects -->
        <li class="<?php if ($page_name == 'training_projects') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>training.php/admin/training_projects">
                <i class="entypo-star"></i>
                <span><?php echo get_phrase('training_projects'); ?></span>
            </a>
        </li>
        

    </ul>

</div>