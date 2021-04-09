<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>uploads/logo.png"  style="max-height:60px;"/>
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
            <a href="<?php echo site_url('librarian/dashboard'); ?>">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- LIBRARY -->
        <li class="<?php if ($page_name == 'book' || $page_name == 'book_request') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                    <a href="<?php echo site_url('librarian/book'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('book_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'book_request') echo 'active'; ?> ">
                    <a href="<?php echo site_url('librarian/book_request'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('book_requests'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Salary Dashboard  -->
        <li class="<?php if ($page_name == 'salary_details' || $page_name == 'salary_deduction' || $page_name == 'salary_payslips') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('salary_dashboard'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'salary_details') echo 'active'; ?> ">
                    <a href="<?php echo site_url('librarian/salary_details'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('salary_details'); ?></span>
                    </a>
                </li>
               <!-- <li class="<?php if ($page_name == 'salary_deduction') echo 'active'; ?> ">
                    <a href="<?php echo site_url('librarian/salary_deduction'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('salary_deduction'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'salary_payslips') echo 'active'; ?> ">
                    <a href="<?php echo site_url('librarian/salary_payslips'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('salary_payslips'); ?></span>
                    </a>
                </li>-->
            </ul>
        </li>
        
                
        <!-- Leave Dashboard  -->
        <li class="<?php if ($page_name == 'leave_request' || $page_name == 'leaves_past_record') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('leave'); ?></span>
            </a>
            <ul>
                <li class="<?php if (($page_name == 'leave_request')) echo 'active'; ?>">
                    <a href="<?php echo site_url('librarian/leave_request'); ?>">
                        <span><i class="entypo-dot"></i><?php echo get_phrase('leave_request'); ?></span>
                    </a>
                </li>
                
                 <li class="<?php if (($page_name == 'leaves_past_record')) echo 'active'; ?>">
                    <a href="<?php echo site_url('librarian/leaves_past_record'); ?>">
                        <span><i class="entypo-dot"></i><?php echo get_phrase('leaves_past_record'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
	
        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo site_url('librarian/manage_profile'); ?>">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>