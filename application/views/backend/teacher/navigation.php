<div class="sidebar-menu">
    <header class="logo-env" ><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- logo -->
        <div class="container" style="width:80%">
            <div class="row">
                <div class="logo col-md-12" style="">
                    <a href="<?php echo site_url('login'); ?>">
                        <img src="<?php echo base_url('uploads/edurama-logo.png'); ?>"  style="max-height:70px;width:100%;object-fit:contain;object-position: left;"/>
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
                <input type="text" class="search-input" name="student_identifier" placeholder="<?php echo get_phrase('student_name') . ' / ' . get_phrase('code') . '...'; ?>" value="" required >
                <button type="submit">
                    <i class="entypo-search"></i>
                </button>
            </form>
        </li>
    </div>
    <!-- SEARCH INPUT -->
    <!-- SEARCH INPUT -->
	
	<!-- MAIN MENU HERE -->
	<div class="main-menu-wrapper">
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

            <!-- School Staff Detail -->
            <li class="<?php if ($page_name == 'teacher' || $page_name == 'index') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('parents/teacher/'); ?>">
                    <i class="entypo-gauge"></i><span><?php echo get_phrase('School Staff Detail'); ?></span>
                </a>
                <ul>
                        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                            <a href="<?php echo site_url('admin/teacher'); ?>">
                                <i class="entypo-dot"></i>
                                <span><?php echo get_phrase('View Teacher'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if ($page_name == 'index') echo 'active'; ?> ">
                            <a href="<?php echo site_url('/employee/index'); ?>">
                                <i class="entypo-dot"></i>
                                <span><?php echo get_phrase('View Staff'); ?></span>
                            </a>
                        </li>
                </ul>
            </li>
    <li class="root-level has-sub">
        <a href="#">
            <span class="s7-add-user"></span>
            <span>Admission</span>
        </a>

        <ul>
           <li class="" active_link="admin/student_add">
                        <a href="<?= site_url('admin/student_add'); ?>">
                            <span><i class="entypo-dot"></i>Student Registration</span>
                        </a>
                    </li>

                    <li class="" active_link="admin/student_information">
                        <a href="#">
                            <span><i class="entypo-dot"></i>All Student List</span>
                        </a>
                        <ul>
                            <li class="" active_link="admin/student_information">
                                <a href="<?= site_url('admin/student_information'); ?>">
                                    <span><i class="entypo-dot"></i>Active Students</span>
                                </a>
                            </li>
                            <li class="" active_link="admin/student_information_inactive">
                                <a href="<?= site_url('admin/student_information_inactive'); ?>">
                                    <span><i class="entypo-dot"></i>Drop Out Students</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="" active_link="admin/student_information/view">
                        <a href="<?= site_url('admin/student_information?action=profile'); ?>">
                            <span><i class="entypo-dot"></i>Student Profile</span>
                        </a>
                    </li>

            
		
        </ul>
    </li>

<!-- TEACHER DASHBOARD -->       
     <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Attendance</span>
                </a>

                <ul>
                    <li class="" active_link="admin/manage_attendance">
                        <a href="<?= site_url('admin/manage_attendance'); ?>">
                            <span><i class="entypo-dot"></i>Student Attendance (Manually)</span>
                        </a>
                    </li>

                    <li class="" active_link="admin/attendance_by_rfid">
                        <a href="<?= site_url('admin/attendance_by_rfid'); ?>">
                            <span><i class="entypo-dot"></i>Attendance By Rfid</span>
                        </a>
                    </li>

                    <li class="" active_link="admin/attendance_report">
                        <a href="<?= site_url('admin/attendance_report'); ?>">
                            <span><i class="entypo-dot"></i>Student Attendance Report</span>
                        </a>
                    </li>


                    <!-- PRE EXAM  -->

                
                </ul>
            </li>





<!-- TEACHER DASHBOARD -->
<li class="<?php if ($page_name == 'academic_dashboard' || $page_name == 'academic_syllabus' || $page_name == 'assignment' || $page_name == 'teacher_list' || $page_name == 'class_timetable' || $page_name == 'study_material')
{
    echo 'opened active active';
} ?> ">

        <a href="#">
            <span class="s7-study"></span>
            <span>Homework</span>
        </a>
        <ul>
            <li class="<?php if (($page_name == 'assignment')) echo 'active'; ?>">
                <a href="<?php echo site_url('assignment/index/1'); ?>">
                    <span><i class="entypo-dot"></i>Homework</span>
                </a>
            </li>
            <li class="<?php if (($page_name == 'add_assignment')) echo 'active'; ?>">
                <a href="<?php echo site_url('assignment/add_assignment'); ?>">
                    <span><i class="entypo-dot"></i>Assign homework</span>
                </a>
            </li>
            <li class="<?php if (($page_name == 'view_assignment')) echo 'active'; ?>">
                <a href="<?php echo site_url('assignment/view_assignment'); ?>">
                    <span><i class="entypo-dot"></i>View homework</span>
                </a>
            </li>
            <li class="<?php if (($page_name == 'add_indiv_assignment')) echo 'active'; ?>">
                <a href="<?php echo site_url('assignment/add_indiv_assignment'); ?>">
                    <span><i class="entypo-dot"></i>Assign Homework Individual</span>
                </a>
            </li>
            <li class="<?php if (($page_name == 'view_indiv_assignment')) echo 'active'; ?>">
                <a href="<?php echo site_url('assignment/view_indiv_assignment'); ?>">
                    <span><i class="entypo-dot"></i>View Homework individual child</span>
                </a>
            </li>
            </ul>
        <li>
            
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-notebook"></span>
                    <span>Examinations &amp; Results</span>
                </a>

                <ul>
                    <li class=" " active_link="examination_results_dashboard">
                        <a href="<?php echo site_url(); ?>admin/examination_results_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Examination Results Dashboard</span>
                        </span></a>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Exam</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="exam">
                                <a href="<?= site_url('admin/exam'); ?>">
                                    <span><i class="entypo-dot"></i>Manage Exam</span>
                                </a>
                            </li>
                            
                            <li class="" active_link="exam_schedule">
                                <a href="<?= site_url('admin/exam_schedule'); ?>">
                                    <span><i class="entypo-dot"></i>Exam Schedule</span>
                                </a>
                            </li> 

                            <li class=" " active_link="tabulation_sheet">
                                <a href="<?= site_url('admin/tabulation_sheet'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Create Result</span>
                                    </span></a>
                            </li>  
                            
                            <li class=" " active_link="admin_grade">
                                <a href="<?= site_url('admin/grade'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Add Mark/Grade/Number</span>
                                    </span></a>
                            </li>  
                            <li class=" " active_link="question_paper">
                                <a href="<?= site_url('admin/question_paper'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Question Paper</span>
                                    </span></a>
                            </li> 
                            
                            <li class=" " active_link="marks_manage">
                                <a href="<?= site_url('admin/marks_manage'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Manage Marks</span>
                                    </span></a>
                            </li> 
                            
                             


                            

                            <li class=" " active_link="exam_marks_sms">
                                <a href="<?= site_url('admin/exam_marks_sms'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Exam Mark SMS</span>
                                    </span></a>
                            </li>  

                        </ul>
                    </li>
                    

                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Online Exam</span>
                        </span></span></a>

                        <ul>
                                <li class=" " active_link="create_online_exam">
                                    <a href="<?php echo site_url(); ?>admin/create_online_exam">
                                        <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                        <span>Create Online Exam</span>
                                    </span></a>
                                </li>

                                <li class=" " active_link="manage_online_exam">
                                    <a href="<?php echo site_url(); ?>admin/manage_online_exam">
                                        <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                        <span>Manage Online Exam</span>
                                    </span></a>
                                </li> 

                                <li class=" " active_link="expired">
                                    <a href="<?php echo site_url(); ?>admin/manage_online_exam/expired">
                                        <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                        <span>Expired Exam</span>
                                    </span></a>
                                </li>

                                
                        </ul>
                    </li>

                    <li class=" " active_link="reexam_and_cancellation">
                        <a href="<?php echo site_url(); ?>admin/reexam_and_cancellation">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Re Exam And Cancellation</span>
                        </span></a>
                    </li>
                </ul>
            </li>
    <!-- Guardian desk DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-map"></span>
                    <span>Guardian desk</span>
                </a>

                <ul>
                    <li class=" " active_link="transport_dashboard">
                        <a href="<?= site_url('guardian'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Guardian List</span>
                            </span>
                        </a>
                    </li>

                    <li class=" " active_link="vehicle">
                        <a href="<?= site_url('admin/parent'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Parent</span>
                            </span></a>
                    </li>




                </ul>
            </li>
            <!-- Guardian desk DASHBOARD -->
              <!-- Transport  report -->
            <li class="<?php if ($page_name == 'transport_dashboard') echo 'opened active'; ?> ">
                <a href="<?php echo site_url('admin/transport_dashboard'); ?>">
                    <i class="entypo-gauge"></i>
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
    
     <!-- EXTRA CURRICULAR DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-medal"></span>
                    <span>Events and holidays</span>
                </a>

                <ul>
                    <li class=" " active_link="extra_curricular_dashboard">
                        <a href="<?= site_url('admin/extra_curricular_dashboard'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Extra Curricular Dashboard</span>
                            </span></a>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Events and holidays</span>
                                </span></span></a>

                        <ul>
                            <li class="" active_link="event?action=add">
                                <a href="<?= site_url('event?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Events</span>
                                </a>
                            </li>
                            <li class="" active_link="event">
                                <a href="<?= site_url('event') ?>">
                                    <span><i class="entypo-dot"></i>Events List</span>
                                </a>
                            </li> 
                            <li class="" active_link="holiday/add?action=add">
                                <a href="<?= site_url('holiday/add?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Holidays</span>
                                </a>
                            </li> 
                            <li class="" active_link="event">
                                <a href="<?= site_url('holiday') ?>">
                                    <span><i class="entypo-dot"></i>Holidays List</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Notice Board</span>
                                </span></span></a>

                        <ul>
                            <li class="" active_link="noticeboard#add">
                                <a href="<?= site_url('admin/noticeboard?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add/Upload Notice</span>
                                </a>
                            </li> 
                            <li class="" active_link="noticeboard#list">
                                <a href="<?= site_url('admin/noticeboard'); ?>">
                                    <span><i class="entypo-dot"></i>Notice List</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            <!-- EXTRA CURRICULAR DASHBOARD -->
            
            
            <!-- Achievement DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-map"></span>
                    <span>Achievements</span>
                </a>

                <ul>
                    <li class=" " active_link="achievement/add">
                        <a href="<?= site_url('achievement/add'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Create Achivement</span>
                            </span>
                        </a>
                    </li>
                    <li class=" " active_link="achievement">
                        <a href="<?= site_url('achievement'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Achivement List</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Achievement DASHBOARD -->
            
            <li class="<?php if ($page_name == 'teacher_dashboard' || $page_name == 'manage_profile')
{
    echo 'opened active active';
} ?> ">

        <a href="#">
                    <span class="s7-home"></span>
                    <span>Birthday</span>
                </a>

                <ul>
                    <li class="" active_link="manage_attendance">
                                    <a href="<?php echo site_url(); ?>employee/staff">
                                        View Staff Birthday
                                    </a>
                                </li>
                                <li class="" active_link="teacher">
                                    <a href="<?= site_url('admin/birthday_list?user=teacher'); ?>">
                                        View Teacher Birthday
                                    </a>
                                </li>
                                <li class="" active_link="attendance_report">
                                    <a href="<?php echo site_url('admin/birthday_list'); ?>">
                                        View Student Birthday
                                    </a>
                                </li>
                                
                                
                    <!-- PRE EXAM  -->

                
                </ul>
    </li>
<!---->
<?php /* <li class="root-level has-sub">-->

<!--                <a href="#">-->
<!--                    <span class="s7-map"></span>-->
<!--                    <span>Transport</span>-->
<!--                </a>-->

<!--                <ul>-->
<!--                    <li class=" " active_link="transport_dashboard">-->
<!--                        <a href="<?php echo site_url(); ?>admin/transport_dashboard">-->
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
<!--                            <span>Transport Dashboard</span>-->
<!--                        </span></a>-->
<!--                    </li>-->
                  <!--    <li class="">
<!--                    <a href="<?php echo site_url(); ?>transport/travel/report">-->
<!--                        <span><i class="entypo-dot"></i>View expenses report</span>-->
<!--                    </a>-->
<!--                </li> -->-->
               <!--       <li class="">
<!--                    <a href="<?php echo site_url(); ?>transport/travel/">-->
<!--                        <span><i class="entypo-dot"></i>View vehicle status</span>-->
<!--                    </a>-->
<!--                </li> -->-->

<!--                <li class="">-->
<!--                    <a href="<?php echo site_url(); ?>transport/travel/add">-->
<!--                        <span><i class="entypo-dot"></i>Add vehicle -->
<!--                        Form</span>-->
<!--                    </a>-->
<!--                </li>-->
                
<!--                <li class="">-->
<!--                    <a href="<?php echo site_url(); ?>transport/travel/add_travel">-->
<!--                        <span><i class="entypo-dot"></i>Add diesel/mobil</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                 <li class="">-->
<!--                    <a href="<?php echo site_url(); ?>transport/travel/add_vehicle_service">-->
<!--                        <span><i class="entypo-dot"></i>Add Service Expenditure</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="">-->
<!--                    <a href="<?php echo site_url(); ?>transport/travel/index_vehicle_service">-->
<!--                        <span><i class="entypo-dot"></i>List Service Expenditure</span>-->
<!--                    </a>-->
<!--                </li>-->
                    

               
                    

<!--                    <li class=" " active_link="vehicle">-->
<!--                        <a href="<?php echo site_url(); ?>transport/vehicle">-->
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
<!--                            <span>Vehicle Information</span>-->
<!--                        </span></a>-->
<!--                    </li>-->

<!--                    <li class=" " active_link="route">-->
<!--                        <a href="<?php echo site_url(); ?>transport/route">-->
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
<!--                            <span>Vehicle tracking</span>-->
<!--                        </span></a>-->
<!--                    </li>-->
                    
<!--                    <li class=" " active_link="route">-->
<!--                        <a href="<?php echo site_url(); ?>admin/manage_travel_report">-->
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
<!--                            <span>Transport report</span>-->
<!--                        </span></a>-->
<!--                    </li>-->



                    <!--<li class="has-sub">-->
                    <!--    <a href="#">-->
                    <!--        <span><i class="entypo-dot"></i><span>-->
                    <!--        <span>Member</span>-->
                    <!--    </span></span></a>-->

                    <!--    <ul>-->
                    <!--            <li class="" active_link="member">-->
                    <!--                <a href="<?php echo site_url(); ?>transport/member">-->
                    <!--                    <span><i class="entypo-dot"></i>Member List</span>-->
                    <!--                </a>-->
                    <!--            </li>-->

                    <!--            <li class="" active_link="transport_member_add">-->
                    <!--                <a href="<?php echo site_url(); ?>transport/member/add">-->
                    <!--                    <span><i class="entypo-dot"></i>Add Member</span>-->
                    <!--                </a>-->
                    <!--            </li>-->

                                
                    <!--    </ul>-->
                    <!--</li>-->


<!--                </ul>-->
<!--            </li> */ ?>
                
<!--MESSAGE DASHBOARD -->
<li class="<?php if ($page_name == 'message_dashboard') echo 'active'; ?> ">
    <a href="<?php echo site_url('teacher/message_dashboard'); ?>">
        <span class="s7-anchor"></span>
        <span><?php echo get_phrase('message'); ?></span>
    </a>
</li>
       </ul>
    </div>
	<!-- MAIN MENU ENDS HERE -->
</div>
