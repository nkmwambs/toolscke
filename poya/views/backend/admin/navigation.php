<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url("uploads/logo.png");?>"  class="img-circle" width="80"/>
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
            <a href="<?php echo base_url('poya.php/admin/dashboard'); ?>">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
     
     	<!--Settings-->   
        <li class="<?php
        if ($page_name == 'manage_survey' ||
                $page_name == 'manage_nominations' ||
                    $page_name == 'manage_projects')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-cog"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
            	<li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url("poya.php/admin/system_settings"); ?>">
                        <span><i class="entypo-traffic-cone"></i> <?php echo get_phrase('system_settings'); ?></span>
                    </a>
                </li>
                
                <li class="<?php if ($page_name == 'manage_survey') echo 'active'; ?> ">
                    <a href="<?php echo base_url("poya.php/admin/manage_survey"); ?>">
                        <span><i class="entypo-cog"></i> <?php echo get_phrase('manage_surveys'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_nominations') echo 'active'; ?> ">
                    <a href="<?php echo base_url("poya.php/admin/manage_nominations"); ?>">
                        <span><i class="entypo-mobile"></i> <?php echo get_phrase('manage_nominations'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_projects') echo 'active'; ?> ">
                    <a href="<?php echo base_url("poya.php/admin/manage_projects"); ?>">
                        <span><i class="entypo-language"></i> <?php echo get_phrase('manage_projects'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_clusters') echo 'active'; ?> ">
                    <a href="<?php echo base_url("poya.php/admin/manage_clusters"); ?>">
                        <span><i class="entypo-star"></i> <?php echo get_phrase('manage_clusters'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_regions') echo 'active'; ?> ">
                    <a href="<?php echo base_url("poya.php/admin/manage_regions"); ?>">
                        <span><i class="entypo-globe"></i> <?php echo get_phrase('manage_regions'); ?></span>
                    </a>
                </li>
				               
            </ul>
        </li>

    </ul>

</div>