<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>uploads/edurama-logo.png"  style="max-height:60px;"/>
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
            <a href="<?php echo site_url($account_type.'/dashboard'); ?>">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- Pre Admission -->
        <li class="<?php if ($page_name == 'pre_admission_exam_schedule' || $page_name == 'pre_admission_student_registraion' || $page_name == 'pre_admission_admit_card' || $page_name == 'online_exam' || $page_name == 'online_exam_result' || $page_name == 'pre_admission_exam_answer_sheet') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-arrows-ccw"></i>
                <span><?php echo get_phrase('pre_exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'pre_admission_exam_schedule') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/pre_admission_exam_schedule'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('exam_schedule'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pre_admission_admit_card') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/pre_admission_admit_card'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('admit_card'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'online_exam') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/online_exam'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('online_exam'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'online_exam_result') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/online_exam_result'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('exam_result'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
