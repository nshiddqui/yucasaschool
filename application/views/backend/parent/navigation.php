<style>
     #main-menu span img{
        height:19px;
        margin-top:-5px;
    }
     .entypo-dot{
        background:#00a651 !important;
    }  
</style>
<div class="sidebar-menu">
    <header class="logo-env" ><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- logo -->
        <div class="row">
                <div class="logo col-md-12" style="">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url(); ?>uploads/logo.png"  style="max-height:70px;width:100%;object-fit:contain;object-position: left;"/>
                    </a>
                </div>
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
    <!-------------------------main menu code------------------>
    <div class="main-menu-wrapper">
        <ul id="main-menu" class="">
            <!-- DASHBOARD -->
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo site_url('parents/dashboard'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/home-run.png') ?>"></span>
                    <span><?php echo get_phrase('dashboard'); ?></span>
                </a>
            </li>
            
            <!-- Attendance report -->
            <li class="<?php if ($page_name == 'attendance_report') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('parents/attendance_report'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/attendance.png') ?>"></span>
                    <span><?php echo get_phrase('attendance'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">
                        <a href="<?php echo site_url('parents/attendance_report'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('View Your Child Attendance'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- Account report -->
            <li class="<?php if ($page_name == 'invoice') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('parents/invoice/'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/accounting.png') ?>"></span>
                    <span><?php echo get_phrase('Account'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                        <a href="<?php echo site_url('parents/invoice/?title=paid'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('Paid Month Fee'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                        <a href="<?php echo site_url('parents/invoice/?title=unpaid'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('Unpaid Month Fee'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- HomeWork report -->
            <li class="<?php if ($page_name == 'assignment') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('parents/assignment/1'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/syllabus.png') ?>"></span>
                    <span><?php echo get_phrase('homework'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                        <a href="<?php echo site_url('parents/assignment/1'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('View Homework'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- Exam  -->
            <li class="<?php if ($page_name == 'scholarship_exam_schedule' || $page_name == 'scholarship_exam_result' || $page_name == 'scholarship_exam_answer_sheet') echo 'opened active'; ?> ">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/exam (1).png') ?>"></span>
                    <span><?php echo get_phrase('exams_and_results'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'scholarship_exam_schedule') echo 'active'; ?> ">
                        <a href="<?php echo site_url('parents/scholarship_exam_schedule'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('View Exam Schedule'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'scholarship_exam_result') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/tabulation_sheet'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('View Result'); ?></span>
                        </a>
                    </li>
                    <li class=" " active_link="student_marksheet">
                        <a href="<?php echo site_url(); ?>parents/re_exam_schedule">
                            <span><i class="entypo-dot"></i> 
                            <span>Re Exam and Cacellation</span>
                        </span></a>
                    </li>


                    <li class=" " active_link="online_exam">
                        <a href="<?php echo site_url(); ?>parents/online_exam">
                            
                            <span><i class="entypo-dot"></i> 
                            <span>Online Exams</span>
                        </span></a>
                    </li> 
                    <li class=" " active_link="online_exam">
                        <a href="<?php echo site_url(); ?>parents/academic_syllabus">
                            
                            <span><i class="entypo-dot"></i> 
                            <span>Show Syllabus</span>
                        </span></a>
                    </li>  
                    <!--li class="<?php if ($page_name == 'scholarship_exam_answer_sheet') echo 'active'; ?> ">
                    <a href="<?php echo site_url('parents/scholarship_exam_answer_sheet'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('answer_sheet'); ?></span>
                    </a>
                </li-->
                </ul>
            </li>

            
            <!-- Event And Holiday report -->
            <li class="">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/beach.png') ?>"></span>
                    <span>
                        Events and holidays
                    </span></a>
                <ul>
                    <li class="" active_link="event">
                        <a href="<?= site_url('event') ?>">
                            <span><i class="entypo-dot"></i>View Events</span>
                        </a>
                    </li> 
                    <li class="" active_link="event">
                        <a href="<?= site_url('holiday') ?>">
                            <span><i class="entypo-dot"></i>View Holidays</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- MESSAGE -->
            <li class="<?php if ($page_name == 'message' || $page_name == 'group_message') echo 'active'; ?> ">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/message.png') ?>"></span>
                    <span><?php echo get_phrase('message'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                        <a href="<?php echo site_url('parents/message'); ?>">
                            <i class="entypo-mail"></i>
                            <span><?php echo get_phrase('message'); ?></span>
                        </a>
                    </li>
                    <!--<li class="<?php if ($page_name == 'group_message') echo 'active'; ?> ">-->
                    <!--    <a href="<?php echo site_url('parents/group_message'); ?>">-->
                    <!--        <i class="entypo-mail"></i>-->
                    <!--        <span><?php echo get_phrase('group_message'); ?></span>-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
            </li>
            <!-- MESSAGE Close-->
            
             <!-- Transport  report -->
            <li class="<?php if ($page_name == 'transport_dashboard') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('admin/transport_dashboard'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/transport.png') ?>"></span>
                    <span><?php echo get_phrase('Transport'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'transport_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/transport_dashboard'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('Vehicle Tracking'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
           
           <!-- Birthday -->
            <li class="root-level has-sub">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/birthday.png') ?>"></span>
                    <span>Birthday</span>
                </a>
                <ul>
                    <li class="" active_link="manage_attendance">
                                    <a href="<?php echo site_url(); ?>admin/staff_birthday_list">
                                        View Staff Birthday
                                    </a>
                                </li>
                                <li class="" active_link="attendance_report">
                                    <a href="<?php echo site_url('admin/birthday_list'); ?>">
                                        View Student Birthday
                                    </a>
                                </li>
                </ul>
            </li>
            <!-- End Birthday --> 
            
            <!-- Achivements  report -->
            <li class="<?php if ($page_name == 'student_achievement') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('achievement/student_achievement'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/scholarship.png') ?>"></span>
                    <span><?php echo get_phrase('Achivements '); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'student_achievement') echo 'active'; ?> ">
                        <a href="<?php echo site_url('achievement/student_achievement'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase(' View Your Child Achivements'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            
            <!-- School Staff Detail -->
            <!-- School Staff Detail -->
            <li class="">
                <a href="<?php echo site_url('admin/staff_details'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/teacher.png') ?>"></span>
                    <span><?php echo get_phrase('School Staff Detail'); ?></span>
                </a>
            </li>
            
            
            <!-- Syllabus  -->
            <!--<li class="<?php if ($page_name == 'syllabus') echo 'active'; ?> ">-->
            <!--    <a href="<?php echo site_url('parents/academic_syllabus'); ?>">-->
            <!--        <i class="entypo-gauge"></i><span><?php echo get_phrase('syllabus'); ?></span>-->
            <!--    </a>-->
            <!--</li>-->



            
<!--<li class="<?php if ($page_name == 'event') echo 'active'; ?> ">-->
<!--            <a href="<?php echo site_url('parents/event'); ?>">-->
<!--                <i class="entypo-doc-text-inv"></i>-->
<!--                <span><?php echo get_phrase('event'); ?></span>-->
            <!--            </a>-->
            <!--        </li>-->

        
            
        </ul>
    </div>
</div>