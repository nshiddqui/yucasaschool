<div class="sidebar-menu">
    <header class="logo-env" >
        <!-- logo -->
        <div class="container" style="width:80%">
            <div class="row">
                <div class="logo col-md-12" style="">
                    <a href="<?php echo site_url('login'); ?>">
                        <img src="<?php echo base_url('uploads/edurama-logo.png');?>"  style="max-height:70px;width:100%;object-fit:contain;object-position: left;"/>
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
    
    <!-- SEARCH INPUT -->
    <!-- SEARCH INPUT -->
    <div class="search-wrapper">
        <li id="search">
            <form class="" action="<?php echo site_url($account_type . '/student_details'); ?>" method="post">
                <input type="text" class="search-input" name="student_identifier" placeholder="<?php echo get_phrase('student_name').' / '.get_phrase('code').'...'; ?>" value="" required >
                <button type="submit">
                    <i class="entypo-search"></i>
                </button>
            </form>
        </li>
    </div>
    <!-- SEARCH INPUT -->
    <!-- SEARCH INPUT -->


    <!-- MAIN MENU START HERE -->
    <!-- MAIN MENU START HERE -->
    
    <div class="main-menu-wrapper">
        <ul id="main-menu" class="">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
           

            <!-- ADMISSION DASHBOARD -->
            <!-- ADMISSION DASHBOARD -->       
            <li class="<?php if ($page_name == 'admission_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-home"></span>
                    <span><?php echo get_phrase('admission'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'admission_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/admission_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('admission_dashboard'); ?></span>
                        </a>
                    </li>

                    <!-- ADD STUDENT -->
                    <li class="<?php if ($page_name == 'student_add' ||
                                    $page_name == 'student_bulk_add')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('student'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'student_add')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/student_add'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('admit_student'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'student_bulk_add')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/student_bulk_add'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('admit_bulk_students'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- ADD STUDENT -->
                    
                    <!-- PRE EXAM -->
                    <li class="<?php if ($page_name == 'pre_exam_student_registration' ||
                                    $page_name == 'class_timetable' ||
                                    $page_name == 'pre_exam_online_create'||
                                    $page_name == 'pre_exam_online_manage')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('pre_exam'); ?></span>
                        </a>
                        <ul>
                                <li class="<?php if (($page_name == 'pre_exam_student_registration')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/pre_exam_student_registration'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('student_registration'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'pre_exam_student_information')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/pre_exam_student_information'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('student_information'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'pre_exam_online_create')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/pre_exam_online_create'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('create_online_exam'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'pre_exam_online_manage')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/pre_exam_online_manage'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('manage_onlone_exam'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- PRE EXAM  -->

                
                </ul>
            </li>
            <!-- ADMISSION DASHBOARD -->
            <!-- ADMISSION DASHBOARD -->


            <!-- STUDENT DASHBOARD -->
            <!-- STUDENT DASHBOARD -->       
            <li class="<?php if ($page_name == 'student_dashboard' || $page_name == 'student_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-id"></span>
                    <span><?php echo get_phrase('student'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'student_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/student_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('student_dashboard'); ?></span>
                        </a>
                    </li>

                    <!--STUDENT INFORMATION-->
                    <li class="<?php if ($page_name == 'student_information' ||
                                    $page_name == 'student_promotion')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('student_information'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'student_information')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/student_information'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('student_information'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'student_promotion')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/student_promotion'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('student_promotion'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- STUDENT INFORMATION-->
                    
                    <!-- DAILY ATTENDANCE -->
                    <li class="<?php if ($page_name == 'manage_attendance' ||
                                    $page_name == 'attendance_report')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('daily_attendance'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'manage_attendance')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/manage_attendance'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('manage_attendance'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'attendance_report')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/attendance_report'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('attendance_report'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- DAILY ATTENDANCE  -->


                    <li class="<?php if ($page_name == 'canteen_card_recharge') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/canteen_card_recharge'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('canteen_recharge'); ?></span>
                        </a>
                    </li>



                    <!-- DAILY ATTENDANCE -->
                    <li class="<?php if ($page_name == 'house_information')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('house_information'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'house_information')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/house_information#list'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('house_information'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'house_information')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/house_information#add'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('add_house'); ?></span>
                                    </a>
                                </li>


                                <li class="<?php if (($page_name == 'house_information')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/house_information#studentlist'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('student_assigned_list'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'house_information')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/house_information#assign'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('unassigned_memeber'); ?></span>
                                    </a>
                                </li>

                        </ul>
                    </li>
                    <!-- DAILY ATTENDANCE  -->

                    

                </ul>
            </li>
            <!-- STUDENT DASHBOARD -->
            <!-- STUDENT DASHBOARD -->


            <!-- TEACHER DASHBOARD -->
            <!-- TEACHER DASHBOARD -->       
            <li class="<?php if ($page_name == 'teacher_dashboard' || $page_name == 'teacher_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-add-user"></span>
                    <span><?php echo get_phrase('teacher'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'teacher_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/teacher_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('teacher_dashboard'); ?></span>
                        </a>
                    </li>

                    <!--TEACHER INFORMATION-->
                    <li class="<?php if ($page_name == 'student_information' ||
                                    $page_name == 'student_promotion')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('tecahers'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'teacher')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/teacher'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('all_teachers'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'teacher_add')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/teacher_add'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('add_teacher'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'teacher_add_bulk')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/teacher_add_bulk'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('add_bulk_teacher'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'teacher_manage_attendance')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/teacher_manage_attendance'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('manage_teacher_attendance'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'teacher_attendance_report')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/teacher_attendance_report'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('teacher_attendance_report'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- TEACHER INFORMATION-->
                    
                    <!-- DAILY ATTENDANCE -->
                    <li class="<?php if ($page_name == 'teacher_feedback' ||
                                    $page_name == 'teacher_feedback')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('teacher_feedback'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'teacher_feedback')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/teacher_feedback'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('add_feedback_form'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'teacher_feedback_list')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/teacher_feedback_list'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('feedback_form_list'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- DAILY ATTENDANCE  -->                    

                </ul>
            </li>
            <!-- TEACHER DASHBOARD -->
            <!-- TEACHER DASHBOARD -->

            <!-- HOSTEL DASHBOARD -->
            <!-- HOSTEL DASHBOARD -->       
            <li class="<?php if ($page_name == 'hostel_dashboard' || $page_name == 'hostel_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-home"></span>
                    <span><?php echo get_phrase('hostel'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'hostel_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/hostel_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('hostel_dashboard'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'hostel' ||
                                    $page_name == 'hostel')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('hostel_management'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'hostel')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('hostel'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('hostel_list'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'hostel')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('hostel#tab_add_hostel'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('add_hostel'); ?></span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>


                    <li class="<?php if ($page_name == 'member' ||
                                    $page_name == 'member')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('hostel_members'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'member')) echo 'active'; ?>">
                                <a href="<?php echo site_url('member'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('member_list'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'member')) echo 'active'; ?>">
                                <a href="<?php echo site_url('member/add'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('non_member_list'); ?></span>
                                </a>
                            </li>  
                        </ul>
                    </li>

                    <li class="<?php if ($page_name == 'manage_hostel_attendance') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/manage_hostel_attendance'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('hostel_attendance'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'member' ||
                                    $page_name == 'member')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('hostel_members'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'member')) echo 'active'; ?>">
                                <a href="<?php echo site_url('member'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('member_list'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'member')) echo 'active'; ?>">
                                <a href="<?php echo site_url('member/add'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('non_member_list'); ?></span>
                                </a>
                            </li>  
                        </ul>
                    </li>


                    <li class="<?php if ($page_name == 'room' ||
                                    $page_name == 'room')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('hostel_rooms'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'room')) echo 'active'; ?>">
                                <a href="<?php echo site_url('room'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('room_list'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'room')) echo 'active'; ?>">
                                <a href="<?php echo site_url('room#tab_add_room'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('add_room'); ?></span>
                                </a>
                            </li>  
                        </ul>
                    </li>


                    <li class="<?php if ($page_name == 'roomswitch_request') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/roomswitch_request'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('room_switch_request'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'visitor') echo 'active'; ?> ">
                        <a href="<?php echo site_url('visitor'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('visitors_info'); ?></span>
                        </a>
                    </li>

                </ul>
            </li>
            <!-- HOSTEL DASHBOARD -->
            <!-- HOSTEL DASHBOARD -->

             
            <!-- ACADEMIC DASHBOARD -->
            <!-- ACADEMIC DASHBOARD -->       
            <li class="<?php if ($page_name == 'academic_dashboard' || $page_name == 'academic_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-study"></span>
                    <span><?php echo get_phrase('academic'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'academic_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/academic_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('academic_dashboard'); ?></span>
                        </a>
                    </li>

                    <!-- MANAGE CLASSES -->
                    <li class="<?php if ($page_name == 'classes' ||
                                    $page_name == 'section')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('manage_classes'); ?></span>
                        </a>
                        <ul>
                                <li class="<?php if (($page_name == 'classes')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/classes'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('class'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'section')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/section'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('section'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- MANAGE CLASSES -->
                    
                    <!-- CLASS ROUTINE -->
                    <li class="<?php if ($page_name == 'timetable_template' ||
                                    $page_name == 'class_timetable' ||
                                    $page_name == 'class_dailytimetable')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('class_routine'); ?></span>
                        </a>
                        <ul>
                                <li class="<?php if (($page_name == 'timetable_template')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/timetable_template'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('timetable_template'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'class_timetable')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/class_timetable'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('class_timetable'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'class_dailytimetable')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/class_dailytimetable'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('class_dailytimetable'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- CLASS ROUTINE -->

                    <!-- CLASS SYLLABUS -->
                    <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/academic_syllabus'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('academic_syllabus'); ?></span>
                        </a>
                    </li>
                    <!-- CLASS SYLLABUS -->

                    <!-- CLASS SUBJECT -->
                    <li class="<?php if ($page_name == 'subject') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/subject'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('subject'); ?></span>
                        </a>
                    </li>
                    <!-- CLASS SUBJECT -->

                    <!-- CLASS ASSIGNMENTS -->
                    <li class="<?php if ($page_name == '/assignment/index' ||
                                    $page_name == 'assignment/index/1#tab_add_assignment' ||
                                    $page_name == 'assignment/index/1#tab_view_assignment')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('Assignments'); ?></span>
                        </a>
                        <ul>
                                <li class="<?php if (($page_name == '/assignment/index')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('assignment/index'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('assignment_list'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'assignment/index/1#tab_add_assignment')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('assignment/index/1#tab_add_assignment'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('add_assignment'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'assignment/index/1#tab_view_assignment')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('assignment/index/1#tab_view_assignment'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('view_assignment'); ?></span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- CLASS ASSIGNMENTS -->

                    <!-- STUDY MATERIAL -->
                    <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/study_material'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('study_material'); ?></span>
                        </a>
                    </li>
                    <!-- STUDY MATERIAL -->

                </ul>
            </li>
            <!-- ACADEMIC DASHBOARD -->
            <!-- ACADEMIC DASHBOARD -->


            <!-- TRANSPORT DASHBOARD -->
            <!-- TRANSPORT DASHBOARD -->       
            <li class="<?php if ($page_name == 'transport_dashboard' || $page_name == 'transport_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-map"></span>
                    <span><?php echo get_phrase('transport'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'transport_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/transport_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('transport_dashboard'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'vehicle') echo 'active'; ?> ">
                        <a href="<?php echo site_url('transport/vehicle'); ?>">
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('all_vehicle'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'route') echo 'active'; ?> ">
                        <a href="<?php echo site_url('transport/route'); ?>">
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('all_route'); ?></span>
                        </a>
                    </li>



                    <li class="<?php if ($page_name == 'member' ||
                                    $page_name == 'member')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('member'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'member')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('transport/member'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('member_list'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'member')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('transport/member/add'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('add_member'); ?></span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>


                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->
            <!-- TRANSPORT DASHBOARD -->


            <!-- HUMAN RESOURCE DASHBOARD -->
            <!-- HUMAN RESOURCE DASHBOARD -->       
            <li class="<?php if ($page_name == 'human_resource_dashboard' || $page_name == 'human_resource_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-users"></span>
                    <span><?php echo get_phrase('human_resource'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'human_resource_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/human_resource_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('HR_dashboard'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'designation' ||
                                    $page_name == 'designation')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('user_management'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'designation')) echo 'active'; ?>">
                                <a href="<?php echo site_url('designation'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('designation'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'employee')) echo 'active'; ?>">
                                <a href="<?php echo site_url('employee'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('employee'); ?></span>
                                </a>
                            </li> 

                            <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/librarian'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('librarian'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/accountant'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('accountant'); ?></span>
                                </a>
                            </li>                               
                        </ul>
                    </li>
                    

                    <li class="<?php if ($page_name == 'leave_request' ||
                                    $page_name == 'leaves_report')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('leave_management'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'leave_request')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/leave_request'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('leave_request'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'leaves_report')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('admin/leaves_report'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('leaves_report'); ?></span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>


                    <li class="<?php if ($page_name == 'type' ||
                                    $page_name == 'certificate' || $page_name == 'certificate_requests')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('certificate_management'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'type')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('type'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('type'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'certificate')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('certificate'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('certificate'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'certificate_requests')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('certificate/certificate_requests'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('certificate_requests'); ?></span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>


                </ul>
            </li>
            <!-- HUMAN RESOURCE DASHBOARD -->
            <!-- HUMAN RESOURCE DASHBOARD -->
           

            <!-- ASSETS MANAGEMENT DASHBOARD -->
            <!-- ASSETS MANAGEMENT DASHBOARD -->       
            <li class="<?php if ($page_name == 'assets_management_dashboard' || $page_name == 'assets_management_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-display2"></span>
                    <span><?php echo get_phrase('assets'); ?></span>
                </a>

                <ul>
                    

                    <li class="<?php if ($page_name == 'designation' ||
                                    $page_name == 'designation')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('assets_management'); ?></span>
                        </a>

                        <ul>

                            <li class="<?php if (($page_name == 'assets_management_dashboard')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/assets_management_dashboard'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('assets_management_dashboard'); ?></span>
                                </a>
                            </li> 

                            <li class="<?php if ($page_name == 'add_asset') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/add_asset'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('add_asset'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if ($page_name == 'asset_report') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/asset_report'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('asset_report'); ?></span>
                                </a>
                            </li>    

                            <li class="<?php if ($page_name == 'add_bulk_asset') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/add_bulk_asset'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('add_bulk_asset'); ?></span>
                                </a>
                            </li>    

                        </ul>
                    </li>


                    <li class="<?php if ($page_name == 'add_asset_category' ||
                                    $page_name == 'add_bulk_category')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('user_management'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'add_asset_category')) echo 'active'; ?>">
                                <a href="<?php echo site_url('add_asset_category'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('all_category'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'add_bulk_category')) echo 'active'; ?>">
                                <a href="<?php echo site_url('add_bulk_category'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('add_bulk_category'); ?></span>
                                </a>
                            </li> 

                        </ul>
                    </li>

                </ul>
            </li>
            <!-- ASSETS MANAGEMENT DASHBOARD -->
            <!-- ASSETS MANAGEMENT DASHBOARD -->

            <!-- ACCOUNTS PAYROLL DASHBOARD -->
            <!-- ACCOUNTS PAYROLL DASHBOARD -->       
            <li class="<?php if ($page_name == 'accounts_payroll_dashboard' || $page_name == 'accounts_payroll_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-graph3"></span>
                    <span><?php echo get_phrase('accounts_and_payroll'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'accounts_payroll_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/accounts_payroll_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('accounts_payroll_dashboard'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'feetype' ||
                                    $page_name == 'feetype')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('accounting'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'feetype')) echo 'active'; ?>">
                                <a href="<?php echo site_url('feetype'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('fee_type'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'discount')) echo 'active'; ?>">
                                <a href="<?php echo site_url('discount'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('discount'); ?></span>
                                </a>
                            </li> 

                            <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                                <a href="<?php echo site_url('invoice'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('manage_invoice'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if ($page_name == 'due') echo 'active'; ?> ">
                                <a href="<?php echo site_url('invoice/due'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('due_fees'); ?></span>
                                </a>
                            </li>    

                            <li class="<?php if ($page_name == 'duefeeemail') echo 'active'; ?> ">
                                <a href="<?php echo site_url('duefeeemail'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('due_fee_email'); ?></span>
                                </a>
                            </li>    

                            <li class="<?php if ($page_name == 'duefeesms') echo 'active'; ?> ">
                                <a href="<?php echo site_url('duefeesms'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('due_fee_sms'); ?></span>
                                </a>
                            </li>   

                            <li class="<?php if ($page_name == 'incomehead') echo 'active'; ?> ">
                                <a href="<?php echo site_url('incomehead'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('income_head'); ?></span>
                                </a>
                            </li> 

                            <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                                <a href="<?php echo site_url('income'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('income'); ?></span>
                                </a>
                            </li>   

                            <li class="<?php if ($page_name == 'exphead') echo 'active'; ?> ">
                                <a href="<?php echo site_url('exphead'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('expenditure_head'); ?></span>
                                </a>
                            </li>  

                            <li class="<?php if ($page_name == 'expenditure') echo 'active'; ?> ">
                                <a href="<?php echo site_url('expenditure'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('expenditure'); ?></span>
                                </a>
                            </li>   

                        </ul>
                    </li>
                    

                    <li class="<?php if ($page_name == 'payment' ||
                                    $page_name == 'grade' || $page_name == 'history')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('payroll'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if (($page_name == 'payment')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('payroll/payment'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('payment'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'grade')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('payroll/grade'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('grade'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if (($page_name == 'history')) echo 'active'; ?>">
                                    <a href="<?php echo site_url('payroll/history'); ?>">
                                        <span><i class="entypo-dot"></i><?php echo get_phrase('history'); ?></span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- ACCOUNTS PAYROLL DASHBOARD -->
            <!-- ACCOUNTS PAYROLL DASHBOARD -->

            <!-- EXAMINATION DASHBOARD -->
            <!-- EXAMINATION DASHBOARD -->       
            <li class="<?php if ($page_name == 'examination_results_dashboard' || $page_name == 'examination_results_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-notebook"></span>
                    <span><?php echo get_phrase('examinations_&_results'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'examination_results_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/examination_results_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('examination_results_dashboard'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'exam' ||
                                    $page_name == 'exam_schedule' ||
                                    $page_name == 'grade'||
                                    $page_name == 'manage_marks'||
                                    $page_name == 'exam_marks_sms'||
                                    $page_name == 'tabulation_sheet'||
                                    $page_name == 'question_paper')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('exam'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'exam')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/exam'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('exam'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'exam_schedule')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/exam_schedule'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('exam_schedule'); ?></span>
                                </a>
                            </li> 

                            <li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/grade'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('exam_grade'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if ($page_name == 'manage_marks') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/manage_marks'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('manage_marks'); ?></span>
                                </a>
                            </li>    

                            <li class="<?php if ($page_name == 'exam_marks_sms') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/exam_marks_sms'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('exam_marks_sms'); ?></span>
                                </a>
                            </li>  

                            <li class="<?php if ($page_name == 'tabulation_sheet') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/tabulation_sheet'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('tabulation_sheet'); ?></span>
                                </a>
                            </li>  

                            <li class="<?php if ($page_name == 'question_paper') echo 'active'; ?> ">
                                <a href="<?php echo site_url('admin/question_paper'); ?>">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span><?php echo get_phrase('question_paper'); ?></span>
                                </a>
                            </li>  

                        </ul>
                    </li>
                    

                    <li class="<?php if ($page_name == 'create_online_exam' ||
                                    $page_name == 'manage_online_exam' || $page_name == 'expired')
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('online_exam'); ?></span>
                        </a>

                        <ul>
                                <li class="<?php if ($page_name == 'create_online_exam') echo 'active'; ?> ">
                                    <a href="<?php echo site_url('admin/create_online_exam'); ?>">
                                        <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                        <span><?php echo get_phrase('create_online_exam'); ?></span>
                                    </a>
                                </li>

                                <li class="<?php if ($page_name == 'manage_online_exam') echo 'active'; ?> ">
                                    <a href="<?php echo site_url('admin/manage_online_exam'); ?>">
                                        <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                        <span><?php echo get_phrase('manage_online_exam'); ?></span>
                                    </a>
                                </li> 

                                <li class="<?php if ($page_name == 'expired') echo 'active'; ?> ">
                                    <a href="<?php echo site_url('admin/manage_online_exam/expired'); ?>">
                                        <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                        <span><?php echo get_phrase('expired_exam'); ?></span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>

                    <li class="<?php if ($page_name == 'reexam_and_cancellation') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/reexam_and_cancellation'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('reexam_and_cancellation'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- EXAMINATION DASHBOARD -->
            <!-- EXAMINATION DASHBOARD -->


            <!-- EXTRA CURRICULAR DASHBOARD -->
            <!-- EXTRA CURRICULAR DASHBOARD -->       
            <li class="<?php if ($page_name == 'extra_curricular_dashboard' || $page_name == 'extra_curricular_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-medal"></span>
                    <span><?php echo get_phrase('extra_curricular'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'extra_curricular_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/extra_curricular_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('extra_curricular_dashboard'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'event' ||
                                    $page_name == 'event'
                                    )
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('event'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'event')) echo 'active'; ?>">
                                <a href="<?php echo site_url('event#tab_event_list'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('event_list'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'event')) echo 'active'; ?>">
                                <a href="<?php echo site_url('event#tab_add_event'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('add_event'); ?></span>
                                </a>
                            </li> 
                        </ul>
                    </li>
                    

                    <li class="<?php if ($page_name == 'noticeboard' ||
                                    $page_name == 'noticeboard' 
                                    )
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('noticeboard'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'noticeboard')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/noticeboard#list'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('notice_list'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'noticeboard')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/noticeboard#add'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('noticeboard'); ?></span>
                                </a>
                            </li> 
                        </ul>
                    </li>

                </ul>
            </li>
            <!-- EXTRA CURRICULAR DASHBOARD -->
            <!-- EXTRA CURRICULAR DASHBOARD -->


                        <!-- SCHOLAR MANAGEMENT DASHBOARD -->
            <!-- SCHOLAR MANAGEMENT DASHBOARD -->       
            <li class="<?php if ($page_name == 'scholarship_management_dashboard' || $page_name == 'scholarship_management_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                   <span class="s7-study"></span>
                    <span><?php echo get_phrase('scholarship_management'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'scholarship_management_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/scholarship_management_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('scholarship_management_dashboard'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'scholarship_exam_student_regsitration' ||
                                    $page_name == 'scholarship_exam_student_information' ||
                                    $page_name == 'scholarship_exam_online_create' ||
                                    $page_name == 'scholarship_exam_online_manage' ||
                                    $page_name == 'expired'
                                    )
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('scholarship'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'scholarship_exam_student_regsitration')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/scholarship_exam_student_regsitration'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('student_registration'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'scholarship_exam_student_information')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/scholarship_exam_student_information'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('student_information'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'scholarship_exam_online_create')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/scholarship_exam_online_create'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('create_online_exams'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'scholarship_exam_online_manage')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/scholarship_exam_online_manage'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('manage_online_exams'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'expired')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/scholarship_exam_online_manage/expired'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('exams_expired'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    

                </ul>
            </li>
            <!-- SCHOLAR MANAGEMENT DASHBOARD -->
            <!-- SCHOLAR MANAGEMENT DASHBOARD -->


                        <!-- FACILITIES DASHBOARD -->
            <!-- FACILITIES DASHBOARD -->       
            <li class="<?php if ($page_name == 'facilities_dashboard' || $page_name == 'facilities_dashboard'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-anchor"></span>
                    <span><?php echo get_phrase('facilities'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'facilities_dashboard') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/facilities_dashboard'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('facilities_dashboard'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'book' ||
                                    $page_name == 'books_bulk_add'
                                    )
                                        echo 'opened'; ?> ">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span><?php echo get_phrase('library'); ?></span>
                        </a>

                        <ul>
                            <li class="<?php if (($page_name == 'book')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/book'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('book'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if (($page_name == 'books_bulk_add')) echo 'active'; ?>">
                                <a href="<?php echo site_url('admin/books_bulk_add'); ?>">
                                    <span><i class="entypo-dot"></i><?php echo get_phrase('books_bulk_add'); ?></span>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li class="<?php if ($page_name == 'canteen_inventory') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/canteen_inventory'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('canteen_inventory'); ?></span>
                        </a>
                    </li>
                    

                </ul>
            </li>
            <!-- FACILITIES DASHBOARD -->
            <!-- FACILITIES DASHBOARD -->


            <!-- SYSTEM SETTINGS DASHBOARD -->
            <!-- SYSTEM SETTINGS DASHBOARD -->       
            <li class="<?php if ($page_name == 'system_settings' || $page_name == 'system_settings'  )
                {echo 'opened';} ?> ">

                <a href="#">
                    <span class="s7-settings"></span>
                    <span><?php echo get_phrase('settings'); ?></span>
                </a>

                <ul>
                    <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/system_settings'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('system_settings'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/sms_settings'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('sms_settings'); ?></span>
                        </a>
                    </li>
                    

                    <li class="<?php if ($page_name == 'payment_settings') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/payment_settings'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('payment_settings'); ?></span>
                        </a>
                    </li>
                    

                    <li class="<?php if ($page_name == 'card_settings') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/card_settings'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('card_settings'); ?></span>
                        </a>
                    </li>
                    

                    <li class="<?php if ($page_name == 'form_settings') echo 'active'; ?> ">
                        <a href="<?php echo site_url('admin/form_settings'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('form_settings'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'theme') echo 'active'; ?> ">
                        <a href="<?php echo site_url('theme'); ?>">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span><?php echo get_phrase('theme_settings'); ?></span>
                        </a>
                    </li>
                    
                    

                </ul>
            </li>
            <!-- SYSTEM SETTINGS DASHBOARD -->
            <!-- SYSTEM SETTINGS DASHBOARD -->

            <li class="">
                <a href="#" onclick="login_form();">
                    <span class="s7-calculator"></span>
                    <span><?php echo get_phrase('POS'); ?></span>
                </a>
                <form action="<?php echo base_url();?>edurama_pos/user/checklogin" id="myForm" method="POST">

                    <input type="hidden" class="form-control form-control-lg input-lg" name="username" placeholder="Your Email" value="<?php echo $this->session->userdata('email');?>">
                    <input type="hidden" class="form-control form-control-lg input-lg" name="password" placeholder="Your Password" value="Admin@123">
                </form>
             </li>
             
            
        </ul>

        <!-- MAIN MENU ENDS HERE -->
        <!-- MAIN MENU ENDS HERE -->
        <!-- MAIN MENU ENDS HERE -->
    </div>

</div>
<script type="text/javascript">
    function login_form(){
        document.getElementById("myForm").submit();
    }
</script>
