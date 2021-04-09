<style>
     #main-menu span img{
        height:19px;
        margin-top:-5px;
    }
     .entypo-dot{
        background:#00a651 !important;
    }  
</style>
<div class="sidebar-menu" style="min-height: 775px;">
    <header class="logo-env"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- logo -->
        <div class="container" style="width:80%">
            <div class="row">
                <div class="logo col-md-12" style="">
                    <a href="<?php echo site_url(); ?>login">
                        <img src="<?php echo site_url(); ?>uploads/logo.png" style="max-height:70px;width:100%;object-fit:contain;object-position: left;">
                    </a>
                </div>
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
    
    <!-- MAIN MENU START HERE -->
    <!-- MAIN MENU START HERE -->

    <div class="main-menu-wrapper">
        <ul id="main-menu" class="">
            
             <!-- Attendance report -->
            <li class="<?php if ($page_name == 'manage_attendace') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('student/manage_attendace'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/attendance.png') ?>"></span>
                    <span><?php echo get_phrase('attendance'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'manage_attendace') echo 'active'; ?> ">
                        <a href="<?php echo site_url('student/manage_attendace'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('View Your Attendance'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
             <!-- Account report -->
            <li class="<?php if ($page_name == 'invoice') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('student/invoice/'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/accounting.png') ?>"></span>
                    <span><?php echo get_phrase('Account'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                        <a href="<?php echo site_url('student/invoice/?title=paid'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('Paid Month Fee'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                        <a href="<?php echo site_url('student/invoice/?title=unpaid'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('Unpaid Month Fee'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
              <!-- HomeWork report -->
            <li class="<?php if ($page_name == 'assignment') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('student/assignment/1'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/syllabus.png') ?>"></span>
                    <span><?php echo get_phrase('homework'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> ">
                        <a href="<?php echo site_url('student/assignment/'); ?>">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('View your homework'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <!-- EXAMS MENU -->
            <!-- EXAMS MENU -->     
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/exam (1).png') ?>"></span>
                    <span>Exam and Result</span>
                </a>

                <ul style="opacity: 0.2; height: 0px;">
                    <li class=" " active_link="exam_schedule">
                        <a href="<?php echo site_url(); ?>student/exam_schedule">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Exam Schedule</span>
                        </span></a>
                    </li>

                
                    <li class=" " active_link="student_marksheet">
                        <a href="<?php echo site_url(); ?>student/student_marksheet/">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>View Result</span>
                        </span></a>
                    </li>
                    
                    <li class=" " active_link="student_marksheet">
                        <a href="<?php echo site_url(); ?>student/re_exam_schedule">
                            <span><i class="entypo-dot"></i> 
                            <span>Re Exam and Cacellation</span>
                        </span></a>
                    </li>


                    <li class=" " active_link="online_exam">
                        <a href="<?php echo site_url(); ?>student/online_exam">
                            
                            <span><i class="entypo-dot"></i> 
                            <span>Online Exams</span>
                        </span></a>
                    </li> 
                    <li class=" " active_link="online_exam">
                        <a href="<?php echo site_url(); ?>student/academic_syllabus">
                            
                            <span><i class="entypo-dot"></i> 
                            <span>Show Syllabus</span>
                        </span></a>
                    </li>  
                </ul>
            </li>
            <!-- EXAMS MENU -->
            <!-- EXAMS MENU -->
            
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
            
             <!-- EXAMS MENU -->
            <!-- EXAMS MENU -->
            <li class="root-level" active_link="message_dashboard">
                <a href="<?php echo site_url(); ?>student/message_dashboard">
                    <span><img src="<?= site_url('/assets/images/icon/message.png') ?>"></span>
                    <span>Message</span>
                </a>
            </li>
            <!-- EXAMS MENU -->
            <!-- EXAMS MENU -->
            
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
            <li>
                <a href="<?php echo site_url('student/student_roomchange_request'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/hotel.png') ?>"></span>
                    <span><?php echo get_phrase('Room Switch Request'); ?></span>
                </a>
            </li>
            
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
                            <span><?php echo get_phrase('View your achievement'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
             <!-- School Staff Detail -->
            <li class="">
                <a href="<?php echo site_url('admin/staff_details'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/teacher.png') ?>"></span>
                    <span><?php echo get_phrase('School Staff Detail'); ?></span>
                </a>
            </li>            
            <!-- <li class=" " active_link="rf_id_card_block">-->
            <!--    <a href="<?php echo site_url(); ?>student/rf_id_card_block">-->
                    
            <!--        <i class="entypo-gauge"></i> -->
            <!--        <span>RFID Card Block</span>-->
            <!--    </span></a>-->
            <!--</li>-->
            
            <?php /*
            <!-- STUDENT MENU -->
            <!-- STUDENT MENU -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Student</span>
                </a>

                <ul class="" style="opacity: 0.2; height: 0px;">
                    <li class=" " active_link="manage_profile">
                        <a href="<?php echo site_url(); ?>student/manage_profile">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Manage Profile</span>
                        </span></a>
                    </li>

                    <!-- ADD STUDENT -->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Leave</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="student_leave_request">
                                    <a href="<?php echo site_url(); ?>student/student_leave_request">
                                        <span><i class="entypo-dot"></i>Leave Request</span>
                                    </a>
                                </li>

                                <li class="" active_link="student_leaves_report">
                                    <a href="<?php echo site_url(); ?>student/student_leaves_report">
                                        <span><i class="entypo-dot"></i>Leave Past Request</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- ADD STUDENT -->                
                </ul>
            </li>
            <!-- STUDENT MENU -->
            <!-- STUDENT MENU -->
            
            
           
            
            
            
            
            
            
            
            
            

            


            <!-- EXAMS MENU -->
            <!-- EXAMS MENU -->
            <li class="root-level" active_link="subject">
                <a href="<?php echo site_url(); ?>student/subject">
                    <span class="s7-home"></span>
                    <span>Subjects</span>
                </a>
            </li>

            <!-- EXAMS MENU -->
            <!-- EXAMS MENU -->

            <!-- EXAMS MENU -->
            <!-- EXAMS MENU -->     
            <?php /*
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Academics</span>
                </a>

                <ul style="opacity: 0.2; height: 0px;">
                    <li class=" " active_link="academic_syllabus">
                        <a href="<?php echo site_url(); ?>student/academic_syllabus">
                            
                             <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Academic Syllabus</span>
                        </span></a>
                    </li>


                    <li class=" " active_link="assignment">
                        <a href="<?php echo site_url(); ?>student/assignment">
                            
                             <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Assignment</span>
                        </span></a>
                    </li>


                    <li class=" " active_link="teacher_list">
                        <a href="<?php echo site_url(); ?>student/teacher_list">
                            
                             <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Teacher List</span>
                        </span></a>
                    </li>
                    
                    <li class=" " active_link="class_timetable">
                        <a href="<?php echo site_url(); ?>student/class_timetable">
                            
                             <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Class Timetable</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="study_material">
                        <a href="<?php echo site_url(); ?>student/study_material">
                            
                             <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Study Material</span>
                        </span></a>
                    </li>

                                
                </ul>
            </li>  
            <!-- EXAMS MENU -->
            <!-- EXAMS MENU -->


            <!-- SCHOLARSHIP EXAMS MENU -->
            <!-- SCHOLARSHIP EXAMS MENU -->     
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Scholarship Exams</span>
                </a>

                <ul style="opacity: 0.2; height: 0px;">
                    <li class=" " active_link="scholarship_exam_schedule">
                        <a href="<?php echo site_url(); ?>student/scholarship_exam_schedule">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Apply For Scholarship</span>
                        </span></a>
                    </li>


                    <li class=" " active_link="scholarship_exam_online">
                        <a href="<?php echo site_url(); ?>student/scholarship_exam_online">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Exam Schecdule</span>
                        </span></a>
                    </li>


                    <li class=" " active_link="scholarship_exam_result">
                        <a href="<?php echo site_url(); ?>student/scholarship_exam_result">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Exam Result</span>
                        </span></a>
                    </li>

                                
                </ul>
            </li>
            <!-- SCHOLARSHIP EXAMS MENU -->
            <!-- SCHOLARSHIP EXAMS MENU -->

            <!-- EXTRA CURRICULAR MENU -->
            <!-- EXTRA CURRICULAR MENU -->     
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Extra Curricular</span>
                </a>

                <ul style="opacity: 0.2; height: 0px;">
                    <li class=" " active_link="noticeboard">
                        <a href="<?php echo site_url(); ?>student/noticeboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Noticeboard</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="teacher_feedback_list">
                        <a href="<?php echo site_url(); ?>student/teacher_feedback_list">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Teacher Feedback</span>
                        </span></a>
                    </li>

                                
                </ul>
            </li>
            <!-- EXTRA CURRICULAR MENU -->
            <!-- EXTRA CURRICULAR MENU -->

            <li >
                        <a href="#">
                            <span class="s7-home"></span>
                            <span>Certificates</span>
                        </a>

                        <ul>
                            <li class="" active_link="view_all_certificates">
                                <a href="<?php echo site_url(); ?>student/view_all_certificates">
                                    <span><i class="entypo-dot"></i>View All Certificates</span>
                                </a>
                            </li>

                            <li class="" active_link="apply_for_certificates">
                                <a href="<?php echo site_url(); ?>student/apply_for_certificates">
                                    <span><i class="entypo-dot"></i>Apply For Certificates</span>
                                </a>
                            </li>

                        </ul>
                    </li>
            <!-- FACILITIES MENU -->
            <!-- FACILITIES MENU -->     
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Facility</span>
                </a>

                <ul style="opacity: 0.2; height: 0px;">
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Library</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="book">
                                <a href="<?php echo site_url(); ?>student/book">
                                    <span><i class="entypo-dot"></i>Book</span>
                                </a>
                            </li>

                            <li class="" active_link="book_request">
                                <a href="<?php echo site_url(); ?>student/book_request">
                                    <span><i class="entypo-dot"></i>Book Requests</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Dormitory</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="student_roomchange_request">
                                <a href="<?php echo site_url(); ?>student/student_roomchange_request">
                                    <span><i class="entypo-dot"></i>Room Change Request</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class=" " active_link="transport">
                        <a href="<?php echo site_url(); ?>student/transport">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Transport</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="rf_id_card_block">
                        <a href="<?php echo site_url(); ?>student/rf_id_card_block">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>RFID Card Block</span>
                        </span></a>
                    </li>

                                
                </ul>
            </li>
            <!-- FACILITIES MENU -->
            <!-- FACILITIES MENU -->



            <!-- Hostel Room Change --> 

            <li >
                <a href="#">
                    <span class="s7-home"></span>
                    <span>Hostel</span>
                </a>

                <ul>
                    <li class="" active_link="view_all_certificates">
                        <a href="<?php echo site_url('student/student_roomchange_request'); ?>">
                            <span><i class="entypo-dot"></i>Room Change request</span>
                        </a>
                    </li>

                   
                </ul>
            </li>
                */ ?>

        </ul>
    </div>
</div>