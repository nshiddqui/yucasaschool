<?php $login_type = $this->session->userdata('login_type'); ?>
<style>
    #main-menu span img{
        height:19px;
        margin-top:-5px;
    }
    
    .entypo-dot{
        background:#00a651 !important;
    }    
</style>
<div class="sidebar-menu" style="min-height: 2113px;">
    <header class="logo-env"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- logo -->
        <div class="container" style="width:80%">
            <div class="row">
                <div class="logo col-md-12" style="">
                    <a href="<?= site_url('login'); ?>">
                        <img src="<?= site_url('uploads/logo.jpg'); ?>" style="max-height:70px;width:100%;object-fit:contain;object-position: left;">
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
            <form class="" action="<?= site_url('admin/student_details'); ?>" method="post">
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

            <?php if(in_array($login_type,['admin','teacher','student'])) { ?>
             <!-- ADMISSION DASHBOARD -->
            <li class="root-level">
                <a href="<?= site_url($login_type.'/dashboard') ?>">
                    <span><img src="<?= site_url('/assets/images/icon/home-run.png') ?>"></span>
                    <span>Home</span>
                </a>
            </li>
             <!-- ADMISSION DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,['inventory_manager','transport_manager','warden','accountant'])) { ?>
             <!-- ADMISSION DASHBOARD -->
            <li class="root-level">
                <a href="<?= site_url('admin/dashboard') ?>">
                    <span><img src="<?= site_url('/assets/images/icon/home-run.png') ?>"></span>
                    <span>Home</span>
                </a>
            </li>
             <!-- ADMISSION DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,[])) { ?>
            <!-- School Staff Detail -->
            <li class="root-level has-sub">
                <a href="<?php echo site_url('parents/teacher/'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/teacher.png') ?>"></span>
                    <span><?php echo get_phrase('School Staff Detail'); ?></span>
                </a>
                <ul>
                        <li>
                            <a href="<?php echo site_url('admin/teacher'); ?>">
                                <i class="entypo-dot"></i>
                                <span><?php echo get_phrase('View Teacher'); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/employee/index'); ?>">
                                <i class="entypo-dot"></i>
                                <span><?php echo get_phrase('View Staff'); ?></span>
                            </a>
                        </li>
                </ul>
            </li>
            <!-- School Staff Detail -->
            <?php } ?>
            
            <?php if(in_array($login_type,['admin'])) { ?>
            <!-- Users DASHBOARD -->
            <li class="root-level has-sub">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/team.png') ?>"></span>
                    <span>Staff Management</span>
                </a>
                <ul>
                    <li class="" active_link="employee">
                        <a href="<?= site_url('employee/index'); ?>">
                            <span><i class="entypo-dot"></i> Add Staff</span>
                        </a>
                    </li>
                    <li class="" active_link="employee/add_user/delete">
                        <a href="<?= site_url('employee/add_user/delete'); ?>">
                            <span><i class="entypo-dot"></i> Delete Staff</span>
                        </a>
                    </li>
                    <!-- PRE EXAM  -->
                </ul>
            </li>
            <!-- Users DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,['admin','teacher'])) { ?>
            <!-- ADMISSION DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/student.png') ?>"></span>
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
                    <!-- PRE EXAM  -->
                </ul>
            </li>
            <!-- Admission DASHBOARD -->
            <?php } ?>

            <?php if(in_array($login_type,['admin','teacher'])) { ?>
            <!-- ATTENDANCE DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/attendance.png') ?>"></span>
                    <span>Attendance</span>
                </a>

                <ul>
                    <li class="" active_link="admin/manage_attendance">
                        <a href="<?= site_url('admin/manage_attendance'); ?>">
                            <span><i class="entypo-dot"></i>Student Attendance (Manually)</span>
                        </a>
                    </li>
                    <?php if(in_array($login_type,['admin'])) { ?>
                    <li class="" active_link="admin/manage_employee_attendance">
                        <a href="<?= site_url('admin/manage_employee_attendance'); ?>">
                            <span><i class="entypo-dot"></i><span>Staff Attendance (Manually)</span></span>
                        </a>
                    </li>
                    <?php } ?>
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

                    <?php if(in_array($login_type,['admin'])) { ?>
                    <li class="" active_link="attendance_employee_report">
                        <a href="<?= site_url('admin/attendance_employee_report'); ?>">
                            <span><i class="entypo-dot"></i>Staff Attendance Report</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <!-- ATTENDANCE DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,['teacher'])) { ?>
            <!-- Homework -->
            <li class="root-level has-sub">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/syllabus.png') ?>"></span>
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
            </li>
            <!-- Homework -->
            <?php } ?>
            
            <?php if(in_array($login_type,['teacher'])) { ?>
            <!-- EXAMINATION DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/exam (1).png') ?>"></span>
                    <span>Examinations &amp; Results</span>
                </a>

                <ul>
                    
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Exams</span>
                                </span></span></a>

                        <ul>
                            <li class="" active_link="exam">
                                <a href="<?= site_url('admin/exam?add=1'); ?>">
                                    <span><i class="entypo-dot"></i>Add Exam</span>
                                </a>
                            </li>
                            <li class="" active_link="exam">
                                <a href="<?= site_url('admin/exam'); ?>">
                                    <span><i class="entypo-dot"></i>Exam List</span>
                                </a>
                            </li>
                            
                            <li class="" active_link="exam_schedule">
                                <a href="<?= site_url('admin/exam_schedule?add=1'); ?>">
                                    <span><i class="entypo-dot"></i>Add Schedule</span>
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
                                <a href="<?= site_url('admin/grade?add=1'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Add Exam Grade</span>
                                    </span></a>
                            </li>
                            <li class=" " active_link="admin_grade">
                                <a href="<?= site_url('admin/grade'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Exam Grade List</span>
                                    </span></a>
                            </li> 
                            
                            <li class=" " active_link="marks_manage">
                                <a href="<?= site_url('admin/marks_manage'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Manage Marks</span>
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
                                <a href="<?= site_url('admin/create_online_exam'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Create Online Exam</span>
                                    </span></a>
                            </li>

                            <li class=" " active_link="manage_online_exam">
                                <a href="<?= site_url('admin/manage_online_exam'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Manage Online Exam</span>
                                    </span></a>
                            </li> 

                            <li class=" " active_link="expired">
                                <a href="<?= site_url('admin/manage_online_exam/expired'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Cancelled Online Exam</span>
                                    </span></a>
                            </li>


                        </ul>
                    </li>

                    <li class=" " active_link="reexam_and_cancellation">
                        <a href="<?= site_url('admin/reexam_and_cancellation'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Re Exam And Cancellation</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- EXAMINATION DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,['teacher'])) { ?>
            <!-- Guardian desk DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/wife.png') ?>"></span>
                    <span>Guardian desk</span>
                </a>

                <ul>
                    <li class=" " active_link="transport_dashboard">
                        <a href="<?= site_url('guardian/add'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Add Guardian</span>
                            </span>
                        </a>
                    </li>
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
            <?php } ?>

            <?php if(in_array($login_type,['admin','accountant'])) { ?>
            <!-- ACCOUNTS PAYROLL DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/accounting.png') ?>"></span>
                    <span>Accounts</span>
                </a>

                <ul>



                    <li class="has-sub">
                        <a href="#">
                            <span>
                                <i class="entypo-dot"></i>
                                <span>
                                    <span>Fee deposition</span>
                                </span>

                            </span>
                        </a>

                        <ul>

                            
                            <li class="" active_link="feetype">
                                <a href="<?= site_url('feetype'); ?>">
                                    <span><i class="entypo-dot"></i>Fee Type</span>
                                </a>
                            </li>
                            
                            <li active_link="invoice/add/">
                                <a href="<?= site_url('invoice/add/'); ?>">
                                    <span><i class="entypo-dot"></i>Create Invoice</span>
                                </a>
                            </li>

                            <li class=" " active_link="exphead">
                                <a href="<?= site_url('invoice'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Fee Paid Classwise</span>
                                    </span></a>
                            </li>  

                            <li class=" " active_link="expenditure">
                                <a href="<?= site_url('invoice/invoice_unpaid'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Fee Unpaid Classwise</span>
                                    </span></a>
                            </li> 
                            <li class=" " active_link="expenditure">
                                <a href="<?= site_url('admin/school_income'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Total Fee Deposied</span>
                                    </span>
                                </a>
                            </li> 
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Expenses</span>
                                </span></span></a>

                        <ul>
                            <li class=" " active_link="exphead">
                                <a href="<?= site_url('exphead'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Create Expenditure Head</span>
                                    </span></a>
                            </li>
                            <li class=" " active_link="expenditure">
                                <a href="<?= site_url('expenditure'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Add Expenses</span>
                                    </span></a>
                            </li> 
                            <li class="" active_link="manage_account_expenses_section_holder">
                                <a href="<?= site_url('admin/manage_account_expenses_section_holder'); ?>">
                                    <span><i class="entypo-dot"></i>Expenses Report</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="has-sub" active_link="payment">
                        <a href="#">
                            <span><i class="entypo-dot"></i>School income</span>
                        </a>
                        <ul>
                            <li class="" active_link="school_income">
                                <a href="<?= site_url('invoice?title=School Income Report'); ?>">
                                    <span><i class="entypo-dot"></i>School Income Report</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Staff salary</span>
                                </span></span></a>

                        <ul>
                            <li class="" active_link="payment">
                                <a href="<?= site_url('admin/manage_account_section_paid_holder'); ?>">
                                    <span><i class="entypo-dot"></i>Salary Paid</span>
                                </a>
                            </li>
                            <li class="" active_link="payment">
                                <a href="<?= site_url('admin/manage_account_section_unpaid_holder'); ?>">
                                    <span><i class="entypo-dot"></i>Salary Unpaid</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?= site_url('admin/add_advance_pay/'); ?>">
                                    <span><i class="entypo-dot"></i>Add Advance Payment</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('admin/list_advance_pay/') ?>">
                                    <span><i class="entypo-dot"></i>Advance Payment Report</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="<?= site_url('admin/manage_account_expenses_section_holder/'); ?>">
                            <span><i class="entypo-dot"></i>Account Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('payroll/grade/') ?>">
                            <span><i class="entypo-dot"></i>Payroll Grades</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ACCOUNTS PAYROLL DASHBOARD -->
            <?php } ?>

            <?php if(in_array($login_type,['admin','inventory_manager'])) { ?>
            <!-- INVENTORY panel -->       
            <li class="">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/exam.png') ?>"></span>
                    <span>Inventory</span>
                </a>
                <ul>
                    <li class="">
                        <a href="<?= site_url('inventory/add/'); ?>">
                            <span><i class="entypo-dot"></i>Add Inventory</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="<?= site_url('inventory/add_inventory/'); ?>">
                            <span><i class="entypo-dot"></i>Issue Inventory</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('inventory/add_asset?title=Add assets of school'); ?>">
                            <span><i class="entypo-dot"></i>Add Assets</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="<?= site_url('inventory/add_asset_inventory_damaged?title=Add Damaged Inventory'); ?>">
                            <span><i class="entypo-dot"></i>Add Damaged Asset</span>
                        </a>
                    </li>
                    
                    <li class="">
                        <a href="<?= site_url('admin/manage_inventory_report/'); ?>">
                            <span><i class="entypo-dot"></i>Inventory Issue Report</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="<?= site_url('inventory/damaged_report/'); ?>">
                            <span><i class="entypo-dot"></i>Asset Damaged Report</span>
                        </a>
                    </li>


                </ul>
            </li>
            <!-- INVENTORY DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,['inventory_manager','accountant'])) { ?>
            <!-- EXTRA CURRICULAR DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/beach.png') ?>"></span>
                    <span>Events And Holidays</span>
                </a>
                <ul>
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Events and holidays</span>
                                </span></span></a>

                        <ul>
                            <?php if(in_array($login_type,['admin'])) { ?>
                            <li class="" active_link="event?action=add">
                                <a href="<?= site_url('event?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Events</span>
                                </a>
                            </li>
                            <?php } ?>
                            <li class="" active_link="event">
                                <a href="<?= site_url('event') ?>">
                                    <span><i class="entypo-dot"></i>Events List</span>
                                </a>
                            </li> 
                            <?php if(in_array($login_type,['admin'])) { ?>
                            <li class="" active_link="holiday/add?action=add">
                                <a href="<?= site_url('holiday/add?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Holidays</span>
                                </a>
                            </li> 
                            <?php } ?>
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
                            <?php if(in_array($login_type,['admin'])) { ?>
                            <li class="" active_link="noticeboard#add">
                                <a href="<?= site_url('admin/noticeboard?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Notice</span>
                                </a>
                            </li> 
                            <?php } ?>
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
            <?php } ?>


            <?php if(in_array($login_type,['teacher'])) { ?>
            <!-- TRANSPORT DASHBOARD -->       
            <li class="root-level has-sub">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/transport.png') ?>"></span>
                    <span>Transport/Vehicle Tracking</span>
                </a>
                <ul>
                     <li class=" " active_link="route">
                        <a href="<?= site_url('admin/transport_dashboard'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Tracking</span>
                            </span></a>
                    </li>
                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,['admin','transport_manager'])) { ?>
            <!-- TRANSPORT DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/transport.png') ?>"></span>
                    <span>Transport</span>
                </a>

                <ul>
                    <li class="">
                        <a href="<?= site_url('transport/travel/add_travel'); ?>">
                            <span><i class="entypo-dot"></i>Add Fuel</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('transport/travel/list_travel'); ?>">
                            <span><i class="entypo-dot"></i>Fuel Report</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('transport/travel/add'); ?>">
                            <span><i class="entypo-dot"></i>Add Vehicle Distance Travel</span>
                        </a>
                    </li>
                    <li class=" " active_link="transport_dashboard">
                        <a href="<?= site_url('admin/manage_travel_report?title=Vehicle Travelled'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Distance Travel Report</span>
                            </span></a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('transport/travel/add_vehicle_service'); ?>">
                            <span><i class="entypo-dot"></i>Add Vehicle Service Expenditure</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('admin/manage_travel_report?title=Total Service Expenditure'); ?>">
                            <span><i class="entypo-dot"></i>Vehicle Service Expenditure Report</span>
                        </a>
                    </li>
                    <li class=" " active_link="transport_dashboard">
                        <a href="<?= site_url('transport/route'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Route</span>
                            </span></a>
                    </li>
                    <li class=" " active_link="vehicle">
                        <a href="<?= site_url('transport/vehicle'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Information</span>
                            </span></a>
                    </li>
                     <li class=" " active_link="route">
                        <a href="<?= site_url('admin/transport_dashboard'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Tracking</span>
                            </span></a>
                    </li>
                    <li class=" " active_link="route">
                        <a href="<?= site_url('admin/manage_travel_report'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Transport Report</span>
                            </span></a>
                    </li>
                    
                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->
            <?php } ?>

            <?php if(in_array($login_type,['admin','warden'])) { ?>
            <!-- HOSTEL DASHBOARD -->
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/hotel.png') ?>"></span>
                    <span>Hostel</span>
                </a>

                <ul>
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Hostel Management</span>
                                </span></span></a>
                        <ul>

                            <li class="" active_link="hostel#tab_add_hostel">
                                <a href="<?= site_url('hostel#tab_add_hostel'); ?>">
                                    <span><i class="entypo-dot"></i>Add Hostel</span>
                                </a>
                            </li>

                            <li class="" active_link="hostel">
                                <a href="<?= site_url('hostel'); ?>">
                                    <span><i class="entypo-dot"></i>Hostel List</span>
                                </a>
                            </li>

                            <li class="" active_link="room#tab_add_room">
                                <a href="<?= site_url('room/add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Room</span>
                                </a>
                            </li>  

                            <li class="" active_link="room">
                                <a href="<?= site_url('room'); ?>">
                                    <span><i class="entypo-dot"></i>Room List</span>
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
                            <li class="" active_link="member_add">
                                <a href="<?= site_url('member/add'); ?>">
                                    <span><i class="entypo-dot"></i>Add New Student</span>
                                </a>
                            </li>

                            <li class="" active_link="member">
                                <a href="<?= site_url('member'); ?>">
                                    <span><i class="entypo-dot"></i>Hostel Student List</span>
                                </a>
                            </li>

                            <li class="" active_link="member">
                                <a href="<?= site_url('admin/manage_attendance_employee_view_hostel/1/'); ?>">
                                    <span><i class="entypo-dot"></i>Add New Staff</span>
                                </a>
                            </li>

                            <li class="" active_link="member_add">
                                <a href="<?= site_url('admin/manage_attendance_employee_view_hostel_member/1/'); ?>">
                                    <span><i class="entypo-dot"></i>Hostel Staff List</span>
                                </a>
                            </li> 
                        </ul>
                    </li>

                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Room Switch Request </span>
                                </span></span></a>

                        <ul>
                            <li class=" " active_link="roomswitch_request">
                                <a href="<?= site_url('admin/roomswitch_request'); ?>">
                                    <span><i class="entypo-dot"></i>Pending Hostel Accomodation Request</span>
                                </a>
                            </li>
                            <li class=" " active_link="hostel_dashboard">
                                <a href="<?= site_url('admin/hostel_roomchange_excel'); ?>">

                                    <span><i class="entypo-dot"></i> 
                                        <span>Hostel Change Report</span>
                                    </span></a>
                            </li>
                        </ul>
                    </li>

                    <li class=" " active_link="hostel_dashboard">
                        <a href="<?= site_url('admin/hostel_dashboard'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Hostel Dashboard</span>
                            </span></a>
                    </li>
                    <li class=" " active_link="hostel_dashboard">
                        <a href="<?= site_url('admin/hostel_report'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Hostel Student Report</span>
                            </span></a>
                    </li>
                    <li class=" " active_link="hostel_dashboard">
                        <a href="<?= site_url('admin/hostel_report_staff'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Hostel Staff Report</span>
                            </span></a>
                    </li>
                </ul>
            </li>
            <!-- HOSTEL DASHBOARD -->
            <?php } ?>

            <?php if(in_array($login_type,['admin'])) { ?>
            <!-- Academic Dashboard -->
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/class.png') ?>"></span>
                    <span>Academic</span>
                </a>

                <ul>
                    <li class=" " active_link="academic_dashboard">
                        <a href="<?= site_url('admin/academic_dashboard'); ?>">

                            <span><i class="entypo-dot"></i> 
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
                                <a href="<?= site_url('admin/classes'); ?>">
                                    <span><i class="entypo-dot"></i>Class</span>
                                </a>
                            </li>

                            <li class="" active_link="admin_section">
                                <a href="<?= site_url('admin/section'); ?>">
                                    <span><i class="entypo-dot"></i>Section</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- CLASS SYLLABUS -->
                    <li class=" " active_link="academic_syllabus">
                        <a href="<?= site_url('admin/academic_syllabus'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Academic Syllabus</span>
                            </span></a>
                    </li>
                    <!-- CLASS SYLLABUS -->

                    <!-- CLASS SUBJECT -->
                    <li class=" " active_link="admin_subject">
                        <a href="<?= site_url('admin/subject'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Subject</span>
                            </span></a>
                    </li>
                    <!-- CLASS SUBJECT -->

                    <!-- CLASS SUBJECT -->
                    <li class=" " active_link="admin_class_report">
                        <a href="<?= site_url('admin/class_report'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Class Report</span>
                            </span></a>
                    </li>
                    <!-- CLASS SUBJECT -->
                    
                </ul>
            </li>
            <!-- ACADEMIC DASHBOARD -->
            <?php } ?>

            <?php if(in_array($login_type,['admin'])) { ?>
            <!-- EXAMINATION DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/exam (1).png') ?>"></span>
                    <span>Examinations &amp; Results</span>
                </a>

                <ul>
                    
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Exam</span>
                                </span></span></a>

                        <ul>
                            <li class="" active_link="exam">
                                <a href="<?= site_url('admin/exam?add=1'); ?>">
                                    <span><i class="entypo-dot"></i>Add Exam</span>
                                </a>
                            </li>
                            <li class="" active_link="exam">
                                <a href="<?= site_url('admin/exam'); ?>">
                                    <span><i class="entypo-dot"></i>Exam List</span>
                                </a>
                            </li>
                            
                            <li class="" active_link="exam_schedule">
                                <a href="<?= site_url('admin/exam_schedule?add=1'); ?>">
                                    <span><i class="entypo-dot"></i>Add Schedule</span>
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
                                <a href="<?= site_url('admin/grade?add=1'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Add Exam Grade</span>
                                    </span></a>
                            </li>
                            <li class=" " active_link="admin_grade">
                                <a href="<?= site_url('admin/grade'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Exam Grade List</span>
                                    </span></a>
                            </li> 
                            
                            <li class=" " active_link="marks_manage">
                                <a href="<?= site_url('admin/marks_manage'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Manage Marks</span>
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
                                <a href="<?= site_url('admin/create_online_exam'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Create Online Exam</span>
                                    </span></a>
                            </li>

                            <li class=" " active_link="manage_online_exam">
                                <a href="<?= site_url('admin/manage_online_exam'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Manage Online Exam</span>
                                    </span></a>
                            </li> 

                            <li class=" " active_link="expired">
                                <a href="<?= site_url('admin/manage_online_exam/expired'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Cancelled Online Exam</span>
                                    </span></a>
                            </li>


                        </ul>
                    </li>

                    <li class=" " active_link="reexam_and_cancellation">
                        <a href="<?= site_url('admin/reexam_and_cancellation'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Re Exam And Cancellation</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- EXAMINATION DASHBOARD -->
            <?php } ?>

            <?php if(in_array($login_type,['admin'])) { ?>
            <!-- MESSAGE DASHBOARD -->
            <li class="">
                <a href="<?= site_url('admin/message'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/message.png') ?>"></span>
                    <span><?= get_phrase('message'); ?></span>
                </a>

                <ul>
                    <li class=" " active_link="message">
                        <a href="<?= site_url('admin/message'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Send Message</span>
                            </span></a>
                    </li>

                    <li class=" " active_link="vehicle">
                        <a href="<?= site_url('admin/message_template'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>SMS Templates</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>

            <?php if(in_array($login_type,['inventory_manager','transport_manager','accountant'])) { ?>
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
            <?php } ?>

            <?php if(in_array($login_type,['admin','inventory_manager','accountant'])) { ?>
            <!-- Guardian desk DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/wife.png') ?>"></span>
                    <span>Guardian desk</span>
                </a>

                <ul>
                    <?php if(in_array($login_type,['admin'])) { ?>
                    <li class=" " active_link="transport_dashboard">
                        <a href="<?= site_url('guardian/add'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Add Guardian</span>
                            </span>
                        </a>
                    </li>
                    <?php } ?>
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
            <?php } ?>
            
            <?php if(in_array($login_type,['inventory_manager','accountant'])) { ?>
            <!-- TRANSPORT DASHBOARD -->       
            <li class="root-level has-sub">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/transport.png') ?>"></span>
                    <span>Transport/Vehicle Tracking</span>
                </a>
                <ul>
                     <li class=" " active_link="route">
                        <a href="<?= site_url('admin/transport_dashboard'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Tracking</span>
                            </span></a>
                    </li>
                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->
            <?php } ?>

            <?php if(in_array($login_type,['admin'])) { ?>
            <!-- Certificate DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/homework.png') ?>"></span>
                    <span>Certificate</span>
                </a>

                <ul>
                    <li class="" active_link="type">
                        <a href="<?= site_url('type'); ?>">
                            Create Certificate Type
                        </a>
                    </li>

                    <li class="" active_link="certificate">
                        <a href="<?= site_url('certificate'); ?>">
                            Issue Certificate
                        </a>
                    </li>

                    <!--<li class="" active_link="certificate_requests">-->
                    <!--    <a href="<?= site_url('certificate/certificate_requests'); ?>">-->
                    <!--        Certificate Request-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
            </li>
            <!-- Certificate DASHBOARD -->
            <?php } ?>

            <?php if(in_array($login_type,['admin','teacher','warden'])) { ?>
            <!-- EXTRA CURRICULAR DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/beach.png') ?>"></span>
                    <span>Events And Holidays</span>
                </a>
                <ul>
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Events and holidays</span>
                                </span></span></a>

                        <ul>
                            <?php if(in_array($login_type,['admin'])) { ?>
                            <li class="" active_link="event?action=add">
                                <a href="<?= site_url('event?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Events</span>
                                </a>
                            </li>
                            <?php } ?>
                            <li class="" active_link="event">
                                <a href="<?= site_url('event') ?>">
                                    <span><i class="entypo-dot"></i>Events List</span>
                                </a>
                            </li> 
                            <?php if(in_array($login_type,['admin'])) { ?>
                            <li class="" active_link="holiday/add?action=add">
                                <a href="<?= site_url('holiday/add?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Holidays</span>
                                </a>
                            </li> 
                            <?php } ?>
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
                            <?php if(in_array($login_type,['admin'])) { ?>
                            <li class="" active_link="noticeboard#add">
                                <a href="<?= site_url('admin/noticeboard?action=add'); ?>">
                                    <span><i class="entypo-dot"></i>Add Notice</span>
                                </a>
                            </li> 
                            <?php } ?>
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
            <?php } ?>
            
            <?php if(in_array($login_type,['warden'])) { ?>
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
            <?php } ?>
            <?php if(in_array($login_type,['warden'])) { ?>
            <!-- Guardian desk DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/wife.png') ?>"></span>
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
            <?php } ?>
            
            <?php if(in_array($login_type,['warden'])) { ?>
            <!-- TRANSPORT DASHBOARD -->       
            <li class="root-level has-sub">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/transport.png') ?>"></span>
                    <span>Transport/Vehicle Tracking</span>
                </a>
                <ul>
                     <li class=" " active_link="route">
                        <a href="<?= site_url('admin/transport_dashboard'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Tracking</span>
                            </span></a>
                    </li>
                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->
            <?php } ?>
            <?php if(in_array($login_type,['teacher'])) { ?>
            <!-- Achievement DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/scholarship.png') ?>"></span>
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
            <?php } ?>

            <?php if(in_array($login_type,['admin','teacher'])) { ?>
            <!-- STUDENT DASHBOARD -->       
            <li class="root-level">

                <a href="<?= site_url('admin/birthday_list'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/student.png') ?>"></span>
                    <span>Student Birthday List</span>
                </a>

                <!--<ul>-->
                    <!--<li class="" active_link="student_promotion">-->
                    <!--    <a href="<?= site_url('admin/student_promotion'); ?>">-->
                    <!--        <span><i class="entypo-dot"></i>Student Promotion</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                <!--</ul>-->
            </li>
            <!-- STUDENT DASHBOARD -->
            <?php } ?>
            <!-- STUDENT DASHBOARD -->
            
            <?php if(in_array($login_type,['admin'])) { ?>
            <!-- STUDENT DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/teacher.png') ?>"></span>
                    <span>School Staff Details / Birthday</span>
                </a>

                <ul>
                    <li class="" active_link="student_promotion">
                        <a href="<?= site_url('admin/staff_details'); ?>">
                            <span><i class="entypo-dot"></i>Staff Details</span>
                        </a>
                    </li>
                    <li class="" active_link="student_information">
                                <a href="<?= site_url('admin/staff_birthday_list'); ?>">
                                    <span><i class="entypo-dot"></i>Staff Birthday</span>
                                </a>
                    </li>
                </ul>
            </li>
            <!-- STUDENT DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,['teacher','inventory_manager','warden','accountant'])) { ?>
            <!-- STUDENT DASHBOARD -->       
            <li class="root-level">

                <a href="<?= base_url('/admin/staff_details') ?>">
                    <span><img src="<?= site_url('/assets/images/icon/teacher.png') ?>"></span>
                    <span>School Staff Details</span>
                </a>
            </li>
            <!-- STUDENT DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,[''])) { ?>
            <!-- TEACHER DASHBOARD -->       
            <li class="root-level has-sub">
                <a href="#">
                    <span><img src="<?= site_url('/assets/images/icon/teacher.png') ?>"></span>
                    <span>Teacher</span>
                </a>
                <ul>
                    <!--TEACHER INFORMATION-->
                    <li class="" active_link="teacher">
                        <a href="<?= site_url('admin/teacher'); ?>">
                            <span><i class="entypo-dot"></i>All Teachers</span>
                        </a>
                    </li>
                    <li class="" active_link="teacher_add">
                        <a href="<?= site_url('admin/teacher_add'); ?>">
                            <span><i class="entypo-dot"></i>Add Teacher</span>
                        </a>
                    </li>
                    <li class="" active_link="teacher">
                        <a href="<?= site_url('admin/birthday_list?user=teacher'); ?>">
                            <span><i class="entypo-dot"></i>Birthday List</span>
                        </a>
                    </li>
                    <!-- TEACHER INFORMATION-->
                    <li class=" " active_link="teacher_dashboard">
                        <a href="<?= site_url('admin/teacher_dashboard'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Teacher Dashboard</span>
                            </span></a>
                    </li>
                </ul>
            </li>
            <!-- TEACHER DASHBOARD -->
            <?php } ?>
            
            <?php if(in_array($login_type,['teacher'])) { ?>
            <!--MESSAGE DASHBOARD -->
            <li class="<?php if ($page_name == 'message_dashboard') echo 'active'; ?> ">
                <a href="<?php echo site_url('teacher/message_dashboard'); ?>">
                    <span><img src="<?= site_url('/assets/images/icon/message.png') ?>"></span>
                    <span><?php echo get_phrase('message'); ?></span>
                </a>
            </li>
            <!--MESSAGE DASHBOARD -->
            <?php } ?>
        </ul>
        <!-- MAIN MENU ENDS HERE -->
    </div>
</div>
<script type="text/javascript">
    function login_form() {
        document.getElementById("myForm").submit();
    }
</script>