<div class="sidebar-menu" style="min-height: 2113px;">
    <header class="logo-env">
        <!-- logo -->
        <div class="container" style="width:80%">
            <div class="row">
                <div class="logo col-md-12" style="">
                    <a href="<?php echo site_url(); ?>login">
                        <img src="<?php echo site_url(); ?>uploads/logo.jpg" style="max-height:70px;width:100%;object-fit:contain;object-position: left;">
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
            <form class="" action="<?php echo site_url(); ?>admin/student_details" method="post">
                <input type="text" class="search-input" name="student_identifier" placeholder="Student Name / Code..." value="" required="">
                <button type="submit">
                    <i class="entypo-search"></i>
                </button>
            </form>
        </li>
    </div>
    <!-- SEARCH INPUT -->
    <!-- SEARCH INPUT -->


    <div class="main-menu-wrapper">
        <ul id="main-menu" class="" style="">
           
            <!-- ADMISSION DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Admission</span>
                </a>

                <ul>
                    <li class="" active_link="admission_dashboard">
                        <a href="<?php echo site_url(); ?>admin/admission_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Admission Dashboard</span>
                        </span></a>
                    </li>

                    <!-- ADD STUDENT -->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Student</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="student_add">
                                    <a href="<?php echo site_url(); ?>admin/student_add">
                                        <span><i class="entypo-dot"></i>Admit Student</span>
                                    </a>
                                </li>

                                <!--<li class="" active_link="student_bulk_add">
                                    <a href="<?php echo site_url(); ?>admin/student_bulk_add">
                                        <span><i class="entypo-dot"></i>Admit Bulk Students</span>
                                    </a>
                                </li>-->
                        </ul>
                    </li>
                    <!-- ADD STUDENT -->
                    
                    <!-- PRE EXAM -->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Pre Exam</span>
                        </span></span></a>
                        <ul>
                                <li class="" active_link="pre_exam_student_registration">
                                    <a href="<?php echo site_url(); ?>admin/pre_exam_student_registration">
                                        <span><i class="entypo-dot"></i>Student Registration</span>
                                    </a>
                                </li>

                                <li class="" active_link="pre_exam_student_information">
                                    <a href="<?php echo site_url(); ?>admin/pre_exam_student_information">
                                        <span><i class="entypo-dot"></i>Student Information</span>
                                    </a>
                                </li>

                                <li class="" active_link="pre_exam_online_create">
                                    <a href="<?php echo site_url(); ?>admin/pre_exam_online_create">
                                        <span><i class="entypo-dot"></i>Create Online Exam</span>
                                    </a>
                                </li>

                                <li class="" active_link="pre_exam_online_manage">
                                    <a href="<?php echo site_url(); ?>admin/pre_exam_online_manage">
                                        <span><i class="entypo-dot"></i>Manage Online Exam</span>
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
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-id"></span>
                    <span>Student</span>
                </a>

                <ul>
                    <li class="" active_link="student_dashboard">
                        <a href="<?php echo site_url(); ?>admin/student_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Student Dashboard</span>
                        </span></a>
                    </li>

                    <!--STUDENT INFORMATION-->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Student Information</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="student_information">
                                    <a href="<?php echo site_url(); ?>admin/student_information">
                                        <span><i class="entypo-dot"></i>Student Information</span>
                                    </a>
                                </li>

                                <li class="" active_link="student_promotion">
                                    <a href="<?php echo site_url(); ?>admin/student_promotion">
                                        <span><i class="entypo-dot"></i>Student Promotion</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- STUDENT INFORMATION-->
                    
                    <!-- DAILY ATTENDANCE -->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Daily Attendance</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="manage_attendance">
                                    <a href="<?php echo site_url(); ?>admin/manage_attendance">
                                        <span><i class="entypo-dot"></i>Manage Attendance</span>
                                    </a>
                                </li>

                                <li class="" active_link="attendance_report">
                                    <a href="<?php echo site_url(); ?>admin/attendance_report">
                                        <span><i class="entypo-dot"></i>Attendance Report</span>
                                    </a>
                                </li>
                                
                                <li class="" active_link="attendance_by_rfid">
                                    <a href="<?php echo site_url(); ?>admin/attendance_by_rfid">
                                        <span><i class="entypo-dot"></i>Attendance By Rfid</span>
                                    </a>
                                </li>
                                
                                
                        </ul>
                    </li>
                    <!-- DAILY ATTENDANCE  -->


                    <li class=" " active_link="canteen_card_recharge">
                        <a href="<?php echo site_url(); ?>admin/canteen_card_recharge">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Canteen Recharge</span>
                        </span></a>
                    </li>



                    <!-- DAILY ATTENDANCE -->
                    <li class="has-sub" >
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>House Information</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="house_information">
                                    <a href="<?php echo site_url(); ?>admin/house_information#list">
                                        <span><i class="entypo-dot"></i>House Information</span>
                                    </a>
                                </li>

                                <li class="" active_link="add_house">
                                    <a href="<?php echo site_url(); ?>admin/house_information#add">
                                        <span><i class="entypo-dot"></i>Add House</span>
                                    </a>
                                </li>


                                <li class="" active_link="assign_house">
                                    <a href="<?php echo site_url(); ?>admin/house_information/assign">
                                        <span><i class="entypo-dot"></i>Student Assigned List</span>
                                    </a>
                                </li>

                                <li class="" active_link="unassign_house">
                                    <a href="<?php echo site_url(); ?>admin/house_information/non_member_list">
                                        <span><i class="entypo-dot"></i>Unassigned Memeber</span>
                                    </a>
                                </li>

                        </ul>
                    </li>
                    
                    
                      <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Parent &amp; Guardian</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="parent">
                                    <a href="<?php echo site_url(); ?>admin/parent">
                                        <span><i class="entypo-dot"></i>Parent</span>
                                    </a>
                                </li>

                                <li class="" active_link="guardian">
                                    <a href="<?php echo site_url(); ?>guardian">
                                        <span><i class="entypo-dot"></i>Guardian</span>
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
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-add-user"></span>
                    <span>Teacher</span>
                </a>

                <ul>
                    <li class=" " active_link="teacher_dashboard">
                        <a href="<?php echo site_url(); ?>admin/teacher_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Teacher Dashboard</span>
                        </span></a>
                    </li>

                    <!--TEACHER INFORMATION-->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Tecahers</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="teacher">
                                    <a href="<?php echo site_url(); ?>admin/teacher">
                                        <span><i class="entypo-dot"></i>All Teachers</span>
                                    </a>
                                </li>

                                <li class="" active_link="teacher_add">
                                    <a href="<?php echo site_url(); ?>admin/teacher_add">
                                        <span><i class="entypo-dot"></i>Add Teacher</span>
                                    </a>
                                </li>


                                <li class="" active_link="teacher_manage_attendance">
                                    <a href="<?php echo site_url(); ?>admin/teacher_manage_attendance">
                                        <span><i class="entypo-dot"></i>Manage Teacher Attendance</span>
                                    </a>
                                </li>

                                <li class="" active_link="teacher_attendance_report">
                                    <a href="<?php echo site_url(); ?>admin/teacher_attendance_report">
                                        <span><i class="entypo-dot"></i>Teacher Attendance Report</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- TEACHER INFORMATION-->
                    
                    <!-- DAILY ATTENDANCE -->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Teacher Feedback</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="teacher_feedback">
                                    <a href="<?php echo site_url(); ?>admin/teacher_feedback">
                                        <span><i class="entypo-dot"></i>Add Feedback Form</span>
                                    </a>
                                </li>

                                <li class="" active_link="teacher_feedback_list">
                                    <a href="<?php echo site_url(); ?>admin/teacher_feedback_list">
                                        <span><i class="entypo-dot"></i>Feedback Form List</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- DAILY ATTENDANCE  -->                    

                </ul>
            </li>
            <!-- TEACHER DASHBOARD -->
            
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Hostel</span>
                </a>

                <ul>
                    <li class=" " active_link="hostel_dashboard">
                        <a href="<?php echo site_url(); ?>admin/hostel_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Hostel Dashboard</span>
                        </span></a>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Hostel Management</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="hostel">
                                    <a href="<?php echo site_url(); ?>hostel">
                                        <span><i class="entypo-dot"></i>Hostel List</span>
                                    </a>
                                </li>

                                <li class="" active_link="hostel#tab_add_hostel">
                                    <a href="<?php echo site_url(); ?>hostel#tab_add_hostel">
                                        <span><i class="entypo-dot"></i>Add Hostel</span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Hostel Members</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="member">
                                <a href="<?php echo site_url(); ?>member">
                                    <span><i class="entypo-dot"></i>Member List</span>
                                </a>
                            </li>

                            <li class="" active_link="member_add">
                                <a href="<?php echo site_url(); ?>member/add">
                                    <span><i class="entypo-dot"></i>Non Member List</span>
                                </a>
                            </li>  
                        </ul>
                    </li>

                    <li class=" " active_link="manage_hostel_attendance">
                        <a href="<?php echo site_url(); ?>admin/manage_hostel_attendance">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Hostel Attendance</span>
                        </span></a>
                    </li>

                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Hostel Rooms</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="room">
                                <a href="<?php echo site_url(); ?>room">
                                    <span><i class="entypo-dot"></i>Room List</span>
                                </a>
                            </li>

                            <li class="" active_link="room#tab_add_room">
                                <a href="<?php echo site_url(); ?>room#tab_add_room">
                                    <span><i class="entypo-dot"></i>Add Room</span>
                                </a>
                            </li>  
                        </ul>
                    </li>


                    <li class=" " active_link="roomswitch_request">
                        <a href="<?php echo site_url(); ?>admin/roomswitch_request">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Room Switch Request</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="visitor">
                        <a href="<?php echo site_url(); ?>visitor">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Visitors Info</span>
                        </span></a>
                    </li>

                </ul>
            </li>
            <!-- HOSTEL DASHBOARD -->
             
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-study"></span>
                    <span>Academic</span>
                </a>

                <ul>
                    <li class=" " active_link="academic_dashboard">
                        <a href="<?php echo site_url(); ?>admin/academic_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Academic Dashboard</span>
                        </span></a>
                    </li>

                    <!-- MANAGE CLASSES -->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Manage Classes</span>
                        </span></span></a>
                        <ul>
                                <li class="" active_link="classes">
                                    <a href="<?php echo site_url(); ?>admin/classes">
                                        <span><i class="entypo-dot"></i>Class</span>
                                    </a>
                                </li>

                                <li class="" active_link="admin_section">
                                    <a href="<?php echo site_url(); ?>admin/section">
                                        <span><i class="entypo-dot"></i>Section</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- MANAGE CLASSES -->
                    
                    <!-- CLASS ROUTINE -->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Class Routine</span>
                        </span></span></a>
                        <ul>
                                <li class="" active_link="timetable_template">
                                    <a href="<?php echo site_url(); ?>admin/timetable_template">
                                        <span><i class="entypo-dot"></i>Timetable Template</span>
                                    </a>
                                </li>

                                <li class="" active_link="class_timetable">
                                    <a href="<?php echo site_url(); ?>admin/class_timetable">
                                        <span><i class="entypo-dot"></i>Class Timetable</span>
                                    </a>
                                </li>

                                <li class="" active_link="class_dailytimetable">
                                    <a href="<?php echo site_url(); ?>admin/class_dailytimetable">
                                        <span><i class="entypo-dot"></i>Class Dailytimetable</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- CLASS ROUTINE -->

                    <!-- CLASS SYLLABUS -->
                    <li class=" " active_link="academic_syllabus">
                        <a href="<?php echo site_url(); ?>admin/academic_syllabus">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Academic Syllabus</span>
                        </span></a>
                    </li>
                    <!-- CLASS SYLLABUS -->

                    <!-- CLASS SUBJECT -->
                    <li class=" " active_link="admin_subject">
                        <a href="<?php echo site_url(); ?>admin/subject">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Subject</span>
                        </span></a>
                    </li>
                    <!-- CLASS SUBJECT -->

                    <!-- CLASS ASSIGNMENTS -->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Assignments</span>
                        </span></span></a>
                        <ul>
                                <li class="" active_link="assignment_index">
                                    <a href="<?php echo site_url(); ?>assignment/index">
                                        <span><i class="entypo-dot"></i>Assignment List</span>
                                    </a>
                                </li>

                                <li class="" active_link="1#tab_add_assignment">
                                    <a href="<?php echo site_url(); ?>assignment/index/1#tab_add_assignment">
                                        <span><i class="entypo-dot"></i>Add Assignment</span>
                                    </a>
                                </li>

                                <li class="" active_link="1#tab_view_assignment">
                                    <a href="<?php echo site_url(); ?>assignment/index/1#tab_view_assignment">
                                        <span><i class="entypo-dot"></i>View Assignment</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <!-- CLASS ASSIGNMENTS -->

                    <!-- STUDY MATERIAL -->
                    <li class=" " active_link="study_material">
                        <a href="<?php echo site_url(); ?>admin/study_material">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Study Material</span>
                        </span></a>
                    </li>
                    <!-- STUDY MATERIAL -->

                </ul>
            </li>
            <!-- ACADEMIC DASHBOARD -->

            <!-- TRANSPORT DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-map"></span>
                    <span>Transport</span>
                </a>

                <ul>
                    <li class=" " active_link="transport_dashboard">
                        <a href="<?php echo site_url(); ?>admin/transport_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Transport Dashboard</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="vehicle">
                        <a href="<?php echo site_url(); ?>transport/vehicle">
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>All Vehicle</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="route">
                        <a href="<?php echo site_url(); ?>transport/route">
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>All Route</span>
                        </span></a>
                    </li>



                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Member</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="member">
                                    <a href="<?php echo site_url(); ?>transport/member">
                                        <span><i class="entypo-dot"></i>Member List</span>
                                    </a>
                                </li>

                                <li class="" active_link="transport_member_add">
                                    <a href="<?php echo site_url(); ?>transport/member/add">
                                        <span><i class="entypo-dot"></i>Add Member</span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>


                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->
        
            <!-- HUMAN RESOURCE DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-users"></span>
                    <span>Human Resource</span>
                </a>

                <ul>
                    <li class=" " active_link="human_resource_dashboard">
                        <a href="<?php echo site_url(); ?>admin/human_resource_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>HR Dashboard</span>
                        </span></a>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>User Management</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="designation">
                                <a href="<?php echo site_url(); ?>designation">
                                    <span><i class="entypo-dot"></i>Designation</span>
                                </a>
                            </li>

                            <li class="" active_link="employee">
                                <a href="<?php echo site_url(); ?>employee">
                                    <span><i class="entypo-dot"></i>Employee</span>
                                </a>
                            </li> 

                            <li class=" " active_link="librarian">
                                <a href="<?php echo site_url(); ?>admin/librarian">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Librarian</span>
                                </span></a>
                            </li>

                            <li class=" " active_link="accountant">
                                <a href="<?php echo site_url(); ?>admin/accountant">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Accountant</span>
                                </span></a>
                            </li>                               
                        </ul>
                    </li>
                    

                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Leave Management</span>
                        </span></span></a>

                        <ul>
                               <!-- <li class="">
                                    <a href="<?php echo site_url(); ?>admin/leave_request">
                                        <span><i class="entypo-dot"></i>Leave Request</span>
                                    </a>
                                </li>-->

                                <li class="" active_link="leaves_report">
                                    <a href="<?php echo site_url(); ?>admin/leaves_report">
                                        <span><i class="entypo-dot"></i>Leaves Report</span>
                                    </a>
                                </li>
                                
                                <li class="" active_link="leaves_report_employee">
                                    <a href="<?php echo site_url(); ?>admin/leaves_report_employee">
                                        <span><i class="entypo-dot"></i>Leaves Report Employee</span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Certificate Management</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="type">
                                    <a href="<?php echo site_url(); ?>type">
                                        <span><i class="entypo-dot"></i>Type</span>
                                    </a>
                                </li>

                                <li class="" active_link="certificate">
                                    <a href="<?php echo site_url(); ?>certificate">
                                        <span><i class="entypo-dot"></i>Certificate</span>
                                    </a>
                                </li>

                                <li class="" active_link="certificate_requests">
                                    <a href="<?php echo site_url(); ?>certificate/certificate_requests">
                                        <span><i class="entypo-dot"></i>Certificate Requests</span>
                                    </a>
                                </li>
  
                        </ul>
                    </li>


                </ul>
            </li>
            <!-- HUMAN RESOURCE DASHBOARD -->
          
            <!-- ASSETS MANAGEMENT DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-display2"></span>
                    <span>Assets</span>
                </a>

                <ul>
                    

                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Assets Management</span>
                        </span></span></a>

                        <ul>

                            <li class="" active_link="assets_management_dashboard">
                                <a href="<?php echo site_url(); ?>admin/assets_management_dashboard">
                                    <span><i class="entypo-dot"></i>Assets Management Dashboard</span>
                                </a>
                            </li> 

                            <li class=" " active_link="add_asset">
                                <a href="<?php echo site_url(); ?>admin/add_asset">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Asset List</span>
                                </span></a>
                            </li>

                            <li class=" " active_link="asset_report">
                                <a href="<?php echo site_url(); ?>admin/asset_report">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Asset Report</span>
                                </span></a>
                            </li>    

                            <li class=" " active_link="add_bulk_asset">
                                <a href="<?php echo site_url(); ?>admin/add_bulk_asset">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Add Bulk Asset</span>
                                </span></a>
                            </li>    

                        </ul>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>User Management</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="add_asset_category">
                                <a href="<?php echo site_url(); ?>admin/add_asset_category">
                                    <span><i class="entypo-dot"></i>All Category</span>
                                </a>
                            </li>

                            <li class="" active_link="add_bulk_category">
                                <a href="<?php echo site_url(); ?>admin/add_bulk_category">
                                    <span><i class="entypo-dot"></i>Add Bulk Category</span>
                                </a>
                            </li> 

                        </ul>
                    </li>

                </ul>
            </li>
            <!-- ASSETS MANAGEMENT DASHBOARD -->
    
            <!-- ACCOUNTS PAYROLL DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-graph3"></span>
                    <span>Accounts And Payroll</span>
                </a>

                <ul>
                    <li class=" " active_link="accounts_payroll_dashboard">
                        <a href="<?php echo site_url(); ?>admin/accounts_payroll_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Accounts Payroll Dashboard</span>
                        </span></a>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Accounting</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="feetype">
                                <a href="<?php echo site_url(); ?>feetype">
                                    <span><i class="entypo-dot"></i>Fee Type</span>
                                </a>
                            </li>

                            <li class="" active_link="discount">
                                <a href="<?php echo site_url(); ?>discount">
                                    <span><i class="entypo-dot"></i>Discount</span>
                                </a>
                            </li> 

                            <li class=" " active_link="invoice">
                                <a href="<?php echo site_url(); ?>invoice">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Manage Invoice</span>
                                </span></a>
                            </li>

                            <li class=" " active_link="invoice_due">
                                <a href="<?php echo site_url(); ?>invoice/due">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Due Fees</span>
                                </span></a>
                            </li>    

                            <li class=" " active_link="duefeeemail">
                                <a href="<?php echo site_url(); ?>duefeeemail">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Due Fee Email</span>
                                </span></a>
                            </li>    

                            <li class=" " active_link="duefeesms">
                                <a href="<?php echo site_url(); ?>duefeesms">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Due Fee Sms</span>
                                </span></a>
                            </li>   

                            <li class=" " active_link="incomehead">
                                <a href="<?php echo site_url(); ?>incomehead">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Income Head</span>
                                </span></a>
                            </li> 

                            <li class=" " active_link="income">
                                <a href="<?php echo site_url(); ?>income">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Income</span>
                                </span></a>
                            </li>   

                            <li class=" " active_link="exphead">
                                <a href="<?php echo site_url(); ?>exphead">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Expenditure Head</span>
                                </span></a>
                            </li>  

                            <li class=" " active_link="expenditure">
                                <a href="<?php echo site_url(); ?>expenditure">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Expenditure</span>
                                </span></a>
                            </li>   

                        </ul>
                    </li>
                    

                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Payroll</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="payment">
                                    <a href="<?php echo site_url(); ?>payroll/payment">
                                        <span><i class="entypo-dot"></i>Payment</span>
                                    </a>
                                </li>

                                <li class="" active_link="grade">
                                    <a href="<?php echo site_url(); ?>payroll/grade">
                                        <span><i class="entypo-dot"></i>Grade</span>
                                    </a>
                                </li>

                                <li class="" active_link="history">
                                    <a href="<?php echo site_url(); ?>payroll/history">
                                        <span><i class="entypo-dot"></i>History</span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- ACCOUNTS PAYROLL DASHBOARD -->
     
            <!-- EXAMINATION DASHBOARD -->       
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
                                <a href="<?php echo site_url(); ?>admin/exam">
                                    <span><i class="entypo-dot"></i>Exam</span>
                                </a>
                            </li>

                            <li class="" active_link="exam_schedule">
                                <a href="<?php echo site_url(); ?>admin/exam_schedule">
                                    <span><i class="entypo-dot"></i>Exam Schedule</span>
                                </a>
                            </li> 

                            <li class=" " active_link="admin_grade">
                                <a href="<?php echo site_url(); ?>admin/grade">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Exam Grade</span>
                                </span></a>
                            </li>

                            <li class=" " active_link="marks_manage">
                                <a href="<?php echo site_url(); ?>admin/marks_manage">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Manage Marks</span>
                                </span></a>
                            </li>    

                            <li class=" " active_link="exam_marks_sms">
                                <a href="<?php echo site_url(); ?>admin/exam_marks_sms">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Exam Marks Sms</span>
                                </span></a>
                            </li>  

                            <li class=" " active_link="tabulation_sheet">
                                <a href="<?php echo site_url(); ?>admin/tabulation_sheet">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Tabulation Sheet</span>
                                </span></a>
                            </li>  

                            <li class=" " active_link="question_paper">
                                <a href="<?php echo site_url(); ?>admin/question_paper">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Question Paper</span>
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
                            <span>Reexam And Cancellation</span>
                        </span></a>
                    </li>
                </ul>
            </li>
            <!-- EXAMINATION DASHBOARD -->
         
            <!-- EXTRA CURRICULAR DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-medal"></span>
                    <span>Extra Curricular</span>
                </a>

                <ul>
                    <li class=" " active_link="extra_curricular_dashboard">
                        <a href="<?php echo site_url(); ?>admin/extra_curricular_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Extra Curricular Dashboard</span>
                        </span></a>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Event</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="event#tab_event_list">
                                <a href="<?php echo site_url(); ?>event#tab_event_list">
                                    <span><i class="entypo-dot"></i>Event List</span>
                                </a>
                            </li>

                            <li class="" active_link="event#tab_add_event">
                                <a href="<?php echo site_url(); ?>event#tab_add_event">
                                    <span><i class="entypo-dot"></i>Add Event</span>
                                </a>
                            </li> 
                        </ul>
                    </li>
                    

                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Noticeboard</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="noticeboard#list">
                                <a href="<?php echo site_url(); ?>admin/noticeboard#list">
                                    <span><i class="entypo-dot"></i>Notice List</span>
                                </a>
                            </li>

                            <li class="" active_link="noticeboard#add">
                                <a href="<?php echo site_url(); ?>admin/noticeboard#add">
                                    <span><i class="entypo-dot"></i>Noticeboard</span>
                                </a>
                            </li> 
                        </ul>
                    </li>

                </ul>
            </li>
            <!-- EXTRA CURRICULAR DASHBOARD -->
         
            <!-- SCHOLAR MANAGEMENT DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                   <span class="s7-study"></span>
                    <span>Scholarship Management</span>
                </a>

                <ul>
                    <li class=" " active_link="scholarship_management_dashboard">
                        <a href="<?php echo site_url(); ?>admin/scholarship_management_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Scholarship Management Dashboard</span>
                        </span></a>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Scholarship</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="scholarship_exam_student_regsitration">
                                <a href="<?php echo site_url(); ?>admin/scholarship_exam_student_regsitration">
                                    <span><i class="entypo-dot"></i>Student Registration</span>
                                </a>
                            </li>

                            <li class="" active_link="scholarship_exam_student_information">
                                <a href="<?php echo site_url(); ?>admin/scholarship_exam_student_information">
                                    <span><i class="entypo-dot"></i>Student Information</span>
                                </a>
                            </li>

                            <li class="" active_link="scholarship_exam_online_create">
                                <a href="<?php echo site_url(); ?>admin/scholarship_exam_online_create">
                                    <span><i class="entypo-dot"></i>Create Online Exams</span>
                                </a>
                            </li>

                            <li class="" active_link="scholarship_exam_online_manage">
                                <a href="<?php echo site_url(); ?>admin/scholarship_exam_online_manage">
                                    <span><i class="entypo-dot"></i>Manage Online Exams</span>
                                </a>
                            </li>

                            <li class="" active_link="scholarship_exam_expired">
                                <a href="<?php echo site_url(); ?>admin/scholarship_exam_online_manage/expired">
                                    <span><i class="entypo-dot"></i>Exams Expired</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    

                </ul>
            </li>
            <!-- SCHOLAR MANAGEMENT DASHBOARD -->
  
            <!-- FACILITIES DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-anchor"></span>
                    <span>Facilities</span>
                </a>

                <ul>
                    <li class=" " active_link="facilities_dashboard">
                        <a href="<?php echo site_url(); ?>admin/facilities_dashboard">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Facilities Dashboard</span>
                        </span></a>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Library</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="book">
                                <a href="<?php echo site_url(); ?>admin/book">
                                    <span><i class="entypo-dot"></i>Book</span>
                                </a>
                            </li>

                            <li class="" active_link="books_bulk_add">
                                <a href="<?php echo site_url(); ?>admin/books_bulk_add">
                                    <span><i class="entypo-dot"></i>Books Bulk Add</span>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li class=" " active_link="canteen_inventory">
                        <a href="<?php echo site_url(); ?>admin/canteen_inventory">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Canteen Inventory</span>
                        </span></a>
                    </li>
                    

                </ul>
            </li>
            <!-- FACILITIES DASHBOARD -->
         
            <!-- SYSTEM SETTINGS DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-settings"></span>
                    <span>Settings</span>
                </a>

                <ul>
                    <li class=" " active_link="system_settings">
                        <a href="<?php echo site_url(); ?>admin/system_settings">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>System Settings</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="sms_settings">
                        <a href="<?php echo site_url(); ?>admin/sms_settings">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Sms Settings</span>
                        </span></a>
                    </li>
                    

                    <li class=" " active_link="payment_settings">
                        <a href="<?php echo site_url(); ?>admin/payment_settings">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Payment Settings</span>
                        </span></a>
                    </li>
                    

                    <li class=" " active_link="card_settings">
                        <a href="<?php echo site_url(); ?>admin/card_settings">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Card Settings</span>
                        </span></a>
                    </li>
                    

                    <li class=" " active_link="form_settings">
                        <a href="<?php echo site_url(); ?>admin/form_settings">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Form Settings</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="facebook_settings">
                        <a href="<?php echo site_url(); ?>admin/facebook_settings">
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Facebook Settings</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="theme">
                        <a href="<?php echo site_url(); ?>theme">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Theme Settings</span>
                        </span></a>
                    </li>
                    
                    

                </ul>
            </li>
            <!-- SYSTEM SETTINGS DASHBOARD -->
            <!-- SYSTEM SETTINGS DASHBOARD -->
            
            <li class="<?php if ($page_name == 'message' || $page_name == 'group_message') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/message'); ?>">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
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