<div class="sidebar-menu" style="min-height: 2113px;">
    <header class="logo-env"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
        <div class="sidebar-collapse" style="">a
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
                    <span>Users</span>
                </a>

                <ul>
                    <li class="" active_link="admission_dashboard">
                        
                        <a href="<?php echo site_url(); ?>designation">
                            
                            <!-- <i class="entypo-gauge"></i> -->Designation</a>
                    </li>
                    <li class="" active_link="admission_dashboard">
                        <a href="<?php echo site_url(); ?>employee">
                            
                            <!-- <i class="entypo-gauge"></i> -->Staff</a>
                    </li>
                    <li class="" active_link="admission_dashboard">
                        <a href="<?php echo site_url(); ?>admin/accountant">
                            
                            <!-- <i class="entypo-gauge"></i> -->Accountant</a>
                    </li>
                    <!--<li class="" active_link="admission_dashboard">
                        <a href="<?php echo site_url(); ?>admin/librarian">
                            
                            Librarian</a>
                    </li>>-->

                   
                    <!-- PRE EXAM  -->

                
                </ul>
            </li>
            <!-- Users DASHBOARD -->
            <!-- Users DASHBOARD -->




<!-- ADMISSION DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Admission</span>
                </a>

                <ul>
                    <li class="" active_link="pre_exam_student_registration">
                                    <a href="<?php echo site_url(); ?>admin/student_add">
                                        Student Registration
                                    </a>
                                </li>

                                <li class="" active_link="pre_exam_student_information">
                                    <a href="<?php echo site_url(); ?>admin/student_information">
                                        Student Information
                                    </a>
                                </li>

                                <!--<li class="" active_link="pre_exam_online_create">
                                    <a href="<?php echo site_url(); ?>admin/pre_exam_online_create">
                                        Create Online Exam
                                    </a>
                                </li>

                                <li class="" active_link="pre_exam_online_manage">
                                    <a href="<?php echo site_url(); ?>admin/pre_exam_online_manage">
                                        Manage Online Exam
                                    </a>
                                </li>
-->
                   
                    <!-- PRE EXAM  -->

                
                </ul>
            </li>
            <!-- Admission DASHBOARD -->
            <!-- Admission DASHBOARD -->
            
            
            <!-- ATTENDANCE DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
                    <span>Attendance</span>
                </a>

                <ul>
                    <li class="" active_link="manage_attendance">
                                    <a href="<?php echo site_url(); ?>admin/manage_attendance">
                                        Manage Attendance
                                    </a>
                                </li>

                                <li class="" active_link="attendance_report">
                                    <a href="<?php echo site_url(); ?>admin/attendance_report">
                                        Attendance Report
                                    </a>
                                </li>
                                
                                <li class="" active_link="attendance_by_rfid">
                                    <a href="<?php echo site_url(); ?>admin/attendance_by_rfid">
                                        Attendance By Rfid
                                    </a>
                                </li>

                   
                    <!-- PRE EXAM  -->

                
                </ul>
            </li>
            <!-- ATTENDANCE DASHBOARD -->
            <!-- ATTENDANCE DASHBOARD -->



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
            
            
            <!-- INVENTORY panel -->       
             <li class="<?php if ($page_name == 'travel_index' || $page_name == 'travel_index') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span>Inventory</span>
            </a>
            <ul>
                <li class="<?php if (($page_name == 'travel_index')) echo 'active'; ?>">
                    <a href="<?php echo site_url('inventory/add/'); ?>">
                        <span><i class="entypo-dot"></i>Add inventory</span>
                    </a>
                </li>
                
                <li class="<?php if (($page_name == 'travel_index')) echo 'active'; ?>">
                    <a href="<?php echo site_url('inventory/add_inventory/'); ?>">
                        <span><i class="entypo-dot"></i>Distribute</span>
                    </a>
                </li>
                <li class="<?php if (($page_name == 'travel_index')) echo 'active'; ?>">
                    <a href="<?php echo site_url('inventory/add_asset/'); ?>">
                        <span><i class="entypo-dot"></i>Add asset type</span>
                    </a>
                </li>
                
                <li class="<?php if (($page_name == 'travel_index')) echo 'active'; ?>">
                    <a href="<?php echo site_url('inventory/add_asset_inventory/'); ?>">
                        <span><i class="entypo-dot"></i>Add asset inventory</span>
                    </a>
                </li>
                <li class="<?php if (($page_name == 'travel_index')) echo 'active'; ?>">
                    <a href="<?php echo site_url('inventory/add_asset_inventory_damaged/'); ?>">
                        <span><i class="entypo-dot"></i>Add asset damaged</span>
                    </a>
                </li>
                
                <li class="<?php if (($page_name == 'travel_index')) echo 'active'; ?>">
                    <a href="<?php echo site_url('inventory/damaged_report/'); ?>">
                        <span><i class="entypo-dot"></i>Damaged report</span>
                    </a>
                </li>
                
                 
            </ul>
        </li>
            <!-- INVENTORY DASHBOARD -->
            <!-- INVENTORY DASHBOARD -->

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
            
            
            <li class="<?php if ($page_name == 'message' || $page_name == 'group_message') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/message'); ?>">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>
        
        <!-- TRANSPORT DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-map"></span>
                    <span>Guardian desk</span>
                </a>

                <ul>
                    <li class=" " active_link="transport_dashboard">
                        <a href="<?php echo site_url(); ?>guardian">
                            
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Guardian</span>
                        </span></a>
                    </li>

                    <li class=" " active_link="vehicle">
                        <a href="<?php echo site_url(); ?>admin/parent">
                            <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <span>Parent</span>
                        </span></a>
                    </li>

                   


                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->
            <li class="<?php if ($page_name == 'message' || $page_name == 'group_message') echo 'active'; ?> ">
            <a href="<?php echo site_url('employee'); ?>">
                <i class="entypo-mail"></i>
                <span>Staff</span>
            </a>
        </li>

        <!-- TRANSPORT DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-map"></span>
                    <span>Certificate</span>
                </a>

                <ul>
                    <li class="" active_link="type">
                                    <a href="<?php echo site_url(); ?>type">
                                        Type
                                    </a>
                                </li>

                                <li class="" active_link="certificate">
                                    <a href="<?php echo site_url(); ?>certificate">
                                        Certificate
                                    </a>
                                </li>

                                <li class="" active_link="certificate_requests">
                                    <a href="<?php echo site_url(); ?>certificate/certificate_requests">
                                        Certificate Requests
                                    </a>
                                </li>
                   


                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->
            
            <!-- EXTRA CURRICULAR DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-medal"></span>
                    <span>Events and holidays</span>
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
                            <span>Events and holidays</span>
                        </span></span></a>

                        <ul>
                            <li class="" active_link="event#tab_event_list">
                                <a href="<?php echo site_url(); ?>event#tab_event_list">
                                    <span><i class="entypo-dot"></i>Events and holidays List</span>
                                </a>
                            </li>

                            <li class="" active_link="event#tab_add_event">
                                <a href="<?php echo site_url(); ?>event#tab_add_event">
                                    <span><i class="entypo-dot"></i>Add Events and holidays</span>
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


                    <!--<li class=" " active_link="canteen_card_recharge">
                        <a href="<?php echo site_url(); ?>admin/canteen_card_recharge">
                            
                             <i class="entypo-gauge"></i> <span><i class="entypo-dot"></i> 
                            <span>Canteen Recharge</span>
                        </span></a>
                    </li>-->



                    <!-- DAILY ATTENDANCE -->
                    <!--<li class="has-sub" >
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
                    </li>-->
                    
                    
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


                                <!--<li class="" active_link="teacher_manage_attendance">
                                    <a href="<?php echo site_url(); ?>admin/teacher_manage_attendance">
                                        <span><i class="entypo-dot"></i>Manage Teacher Attendance</span>
                                    </a>
                                </li>

                                <li class="" active_link="teacher_attendance_report">
                                    <a href="<?php echo site_url(); ?>admin/teacher_attendance_report">
                                        <span><i class="entypo-dot"></i>Teacher Attendance Report</span>
                                    </a>
                                </li>-->
                        </ul>
                    </li>
                    <!-- TEACHER INFORMATION-->
                    
                    <!-- DAILY ATTENDANCE -->
                   <!-- <li class="has-sub">
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
                    </li>-->
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
<div class="container"><?php $activeTab = "daily_attendance"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Attendance Report</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<style>
.page-container.sidebar-collapsed {
    padding-left: 323px;
}
</style>


<?php echo form_open(site_url('admin/attendance_report_view')); ?>
<div class="row">

    <?php
    $query = $this->db->get('class');
    if ($query->num_rows() > 0):
        $class = $query->result_array();
        ?>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php foreach ($class as $row): ?>
                        <option value="<?php echo $row['class_id']; ?>"<?php if ($class_id == $row['class_id']) echo 'selected'; ?> ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

    <?php
    $query = $this->db->get_where('section', array('class_id' => $class_id));
    if ($query->num_rows() > 0):
        $sections = $query->result_array();
        ?>
        <div id="section_holder">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                    <select class="form-control selectboxit" name="section_id">
                        <?php foreach ($sections as $row): ?>
                            <option value="<?php echo $row['section_id']; ?>"
                                    <?php if ($section_id == $row['section_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    <?php endif; ?>
   <div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">From</label>
			<input type="text" class="form-control datepicker" name="from" data-format="dd-mm-yyyy" value="">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">To</label>
			<input type="text" class="form-control datepicker" name="to" data-format="dd-mm-yyyy" value="">
		</div>
	</div>

    <input type="hidden" name="year" value="<?php echo $running_year; ?>">

    <div class="col-md-2 top-first-btn">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('show_report'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>


<?php if ($class_id != '' && $section_id != '' && $to != '' && $from != ''): ?>

    <br>
    <div class="row">
        <!-- <div class="col-md-4"></div> -->
        <!-- <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;">
                    <?php
                    $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
                    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                    if ($month == 1)
                        $m = 'January';
                    else if ($month == 2)
                        $m = 'February';
                    else if ($month == 3)
                        $m = 'March';
                    else if ($month == 4)
                        $m = 'April';
                    else if ($month == 5)
                        $m = 'May';
                    else if ($month == 6)
                        $m = 'June';
                    else if ($month == 7)
                        $m = 'July';
                    else if ($month == 8)
                        $m = 'August';
                    else if ($month == 9)
                        $m = 'Sepetember';
                    else if ($month == 10)
                        $m = 'October';
                    else if ($month == 11)
                        $m = 'November';
                    else if ($month == 12)
                        $m = 'December';
                    echo get_phrase('attendance_sheet');
                    ?>
                </h3>
                <h4 style="color: #696969;">
    <?php echo get_phrase('class') . ' ' . $class_name; ?> : <?php echo get_phrase('section');?> <?php echo $section_name; ?><br>
    <?php echo $m . ', ' . $sessional_year; ?>
                </h4>
            </div>
        </div> -->
       <!-- <div class="col-md-4"></div> -->
           
               
           
           <div class="col-md-3 p0" >
            
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label" style="margin-bottom:5px;color:#333;font-size:12px;">Attendance BY RFID</label>         
                <input type="text" class="col-md-6 form-control round"  maxlength="10" name="card_code" id="rfid_input"  placeholder="<?php echo $this->lang->line('Enter Customer Name'); ?> "autocomplete="off" autofocus />
             </div>
            </div>
           </div>


<div class="clearfix"></div>
<div class="clearfix"></div>
		   <div style="float: left; margin-left: 10px !important; font-weight: 600; color:#333;">
		    <i class="entypo-record" style="color: #00a651;"></i> <span>Present</span>
            <i class="entypo-record" style="color: #ee4749;"></i> <span>Absent</span>
			<i class="entypo-record" style="color: #FBC150;"></i> <span>Error</span>  
			<i class="entypo-record" style="color: #09B6BD;"></i> <span>Marked Present By Admin</span> 
            <i class="entypo-record" style="color: #e48306;"></i><span>Marked Absent By Admin</span> 
		   </div>
          <div id="student_rfid_info" class="col-md-4 hidden">

          </div>
        <script>

         $(document).ready(function () {
            //setup before functions
          let typingTimer;                //timer identifier
          let doneTypingInterval = 500;  //time in ms (0.2 seconds)
          var myInput = document.getElementById('rfid_input');

          //on keyup, start the countdown
          myInput.addEventListener('keyup', () => {
              clearTimeout(typingTimer);
              if (myInput.value) {
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
              }
          });

            function doneTyping() {

                if(($("#rfid_input").val()).length >= 9){
                 //alert(($(this).val()).length);
                 $.ajax({
                  type: "GET",
                  url: "<?php echo site_url('admin/rfid_search');?>",
                  data: 'card_code=' + $("#rfid_input").val(),
                  beforeSend: function () {
                    $("#student_rfid_info").css("background", "#FFF url(" +  + "<?php echo base_url();?>assets/load-ring.gif) no-repeat 165px");
                  },
                    success: function (data) {
                     $("#student_rfid_info").show();
                     $("#student_rfid_info").html(data);
                     $("#student_rfid_info").css("background", "none");
                     $('#student_rfid_info').removeClass('hidden');
                     get_attendence_data();
                     $("#rfid_input").val('');
                     rfid_close_function();
                     //$("#my_table").ajax.reload();
                    }
                 });
               }

               else{
                toastr.error('Please enter valid rfid number');
                $("#rfid_input").val('');
               }

               function rfid_close_function(){
                $('.rfid_close').click(function(){

                    $('#student_rfid_info').addClass('hidden');
                    $('#student_rfid_info').hide();
                 });
               };
               
      }
      });


    </script>

    </div>


    <hr />

     <div class="row" id="attendance_data">
        <div class="col-md-12">
            <table class="table table-bordered" id="my_table">
                <thead>
                    <tr>
                        <td style="text-align: center;">
    <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
    <?php
    $year = explode('-', $running_year);
    $month_to = explode('-', $from);
    $month_from = explode('-', $to);
    //print_r($month_to);
    $d1 = strtotime($to);
    $d2 = strtotime($from);
     $min_date = min($d1, $d2);
     $max_date = max($d1, $d2);
    $j = 0;
    
    while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
        $j++;
    }
     $month_count = $j;
     //$days = cal_days_in_month(CAL_GREGORIAN, $month_to[1], $month_to[2]);
     //$days_to = cal_days_in_month(CAL_GREGORIAN, $month_from[1], $month_from[2]);
     
     
     $start    = new DateTime($from);
$end      = (new DateTime($to))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);

foreach ($period as $dt) {
    ?>
    <td style="text-align: center;"><?php echo $dt->format("d-m"); ?></td>
    <?php
}
     
 ?>
                    </tr>
                </thead>

                <tbody>
                            <?php
                            $data = array();

                            $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
//echo $this->db->last_query();
                            foreach ($students as $row):
                                ?>
                        <tr>
                            <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <td>
                            <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . $sessional_year);
                                //$this->db->group_by('timestamp');
                                $minvalue=$to;
                                $maxvalue=$from;
                                $attendance=$this->db->select('*')->from('attendance')
                ->where(array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'student_id' => $row['student_id']))
                        ->where('defult_date>=', $minvalue)->where('defult_date<=', $maxvalue)
->get()->result_array();
                                           
                                //$attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->where("default_date BETWEEN $minvalue AND $maxvalue")->result_array();
//echo $this->db->last_query();die;

                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);

                                    if ($i == $month_dummy)
                                     echo $status = $row1['status'];


                                endforeach;
                                ?>
                               </td>

        <?php } ?>
    <?php endforeach; ?>

                    </tr>

    <?php ?>

                </tbody>
            </table>
		
			
            <center>
                <a href="<?php echo site_url('admin/attendance_report_print_view/' . $class_id . '/' . $section_id . '/' . $month . '/' . $sessional_year); ?>"
                   class="btn btn-primary" target="_blank">
    <?php echo get_phrase('print_attendance_sheet'); ?>
                </a>
            </center>
        </div>
    </div> 
    </div> 
	
	<div class="attendancePopup" >
    <div class="closePopup"><i class="fas fa-times"></i></div>
        <div class=" text-center"><h2>Attendance Report (<span class="stdnt_nam"> </span>)</h2></div>
        <div class="data">
            <h6 style="color: red;text-align: center;" id="msgg"></h6>
        <form action="" id="ajax_updateAttendance">
            <table class="table table-stripped">
                <thead>
                    <th>Attendance Type</th>
                    <th>Status</th>
                    <th>Option</th>
                </thead>
                
                <tbody>
                    <tr>

                        <td>Gate Attendance</td>
                        <td class="gAtt">Present</td>
                        <td>
                            
                        <input type="hidden" id="attendanceid" name="attendanceid"  value="">
                        <input type="radio" class="gp" name="gate_att" data-value="1" value="1"> Present &nbsp;

                        <input type="radio" class="ga" name="gate_att" data-value="2" value="2"> Absent<br>
                        </td>   
                        
                    </tr>
                    <tr>
                        <td>Class Attendance</td>
                        <td class="cAtt">Absent</td>
                        <td>
                         <input type="radio" class="cp" name="class_att" data-value="1" value="1"> Present &nbsp;

                            <input type="radio" class="ca" name="class_att" data-value="2" value="2"> Absent<br>
                        </td>
                       
                    </tr>
                    <tr>
                        <td>Bus Attendance</td>
                        <td class="bAtt">Present</td>
                        <td>
                         <input type="radio" class="bp" name="bus_att" data-value="1" value="1"> Present &nbsp;

                            <input type="radio" class="ba" name="bus_att" data-value="2" value="2"> Absent<br>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <button type="submit" class="btn btn-success">Update Attendance</button>
        </form>
        </div>
    </div>
<?php endif; ?>
</div>

<script type="text/javascript">

   $('.closePopup').click(()=> $('.attendancePopup').hide());

    // ajax form plugin calls at each modal loading,
    $(document).ready(function() {
         
    $.ajax({
        url: '<?php echo site_url('admin/get_ajax_attendence/'); ?>',
        type: "POST",
        data: {'class_id':"<?php echo $class_id;?>",'section_id':"<?php echo $section_id;?>",'from':"<?php echo $from;?>",'to':"<?php echo $to;?>",'month':"<?php echo $month;?>",'sessional_year':"<?php echo $sessional_year;?>"},
        success: function (response)
        {
            $('#attendance_data').html(response);
        }
    });


    // SelectBoxIt Dropdown replacement
    if($.isFunction($.fn.selectBoxIt))
        {
        $("select.selectboxit").each(function(i, el)
         {
            var $this = $(el),
                opts  = {
                    showFirstOption: attrDefault($this, 'first-option', true),
                    'native': attrDefault($this, 'native', false),
                    defaultText: attrDefault($this, 'text', ''),
                };
            $this.addClass('visible');
            $this.selectBoxIt(opts);
         });
        }
    });
    
    function get_attendence_data(){
        $.ajax({
            url: '<?php echo site_url('admin/get_ajax_attendence/'); ?>',
            type: "POST",
            data: {'class_id':"<?php echo $class_id;?>",'section_id':"<?php echo $section_id;?>",'month':"<?php echo $month;?>",'sessional_year':"<?php echo $sessional_year;?>"},
            success: function (response)
            {
                console.log(response);
                $('#attendance_data').html(response);
            }
        });
    }
</script>

<script type="text/javascript">

    function select_section(class_id) {

        $.ajax({
            url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
            success: function (response)
            {

                jQuery('#section_holder').html(response);
            }
        });
    }

    

   $(document).ready(function(){
     $("#ajax_updateAttendance").validate({
        rules :{
        }, submitHandler: function(form) {
         // do other things for a valid form
          var data;
          data =  $("#ajax_updateAttendance").serialize();
           // data.append( 'file', $( '#file' )[0].files[0] );
          console.log(data);
          //alert("Submitted! " + $('#is_temporary').val());
          
           $.ajax({
                url: "<?php echo site_url('admin/ajax_updateAttendance/'); ?>",
                data: data,
                type: 'POST',
                success: function (data) {
                    if(data == 1){
                        $('#msgg').html('Update_data_successfully !');
                    }
                     location.reload();
                    $('.attendancePopup').hide();
                    //$("#ajax_updateAttendance")[0].reset(); 
                   

                }
            });
        //form.preventDefault();
       }
    });
});


</script>
