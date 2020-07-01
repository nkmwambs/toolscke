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

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url();?>photos.php/sdsa/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- Gallery -->       
        
        <li class="<?php
        if ($page_name == 'upload_zone' ||
                    $page_name == 'gallery'||
					$page_name == 'trash')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-address-book"></i>
                <span><?php echo get_phrase('gallery'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'upload_zone') echo 'active'; ?> ">
                    <a href="<?php echo base_url("photos.php/sdsa/upload_zone"); ?>">
                        <span><i class="fa fa-bell-o"></i> <?php echo get_phrase('photo_upload'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'gallery') echo 'active'; ?> ">
                			<a href="<?php echo base_url("photos.php/sdsa/gallery"); ?>">
                        <span><i class="entypo-briefcase"></i> <?php echo get_phrase('view_photo'); ?></span>
                        <span class="badge badge-info"><?php echo $new_count;?></span>
                   </a> 
                </li> 
                
                <li class="<?php if ($page_name == 'trash') echo 'active'; ?> ">
                    <a href="<?php echo base_url("photos.php/sdsa/trash"); ?>">
                        <span><i class="fa fa-trash-o"></i> <?php echo get_phrase('trash'); ?></span>
                        <span class="badge badge-info"><?php echo $trash_count;?></span>
                    </a>
                </li>
                
                              
            </ul>
        </li>
		
        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>photos.php/sdsa/manage_profile">
                <i class="entypo-cog"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
        </li>
	
    </ul>

</div>