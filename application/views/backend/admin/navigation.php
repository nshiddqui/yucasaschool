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

            <!-- ADMISSION DASHBOARD -->
            <li class="root-level has-sub">

                <a href="<?= site_url('admin/dashboard') ?>">
                    <span class="s7-home"></span>
                    <span>Home</span>
                </a>
            </li>
            <li class="root-level has-sub">
                <a href="#">
                    <span class="s7-home"></span>
                    <span>Staff Management</span>
                </a>
                <ul>
                    <!--<li class="" active_link="designation">-->
                    <!--    <a href="<?= site_url('designation'); ?>">-->
                    <!--        <span><i class="entypo-dot"></i>Create Designation</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="" active_link="employee">
                        <a href="<?= site_url('employee/index'); ?>">
                            <span><i class="entypo-dot"></i> Add User</span>
                        </a>
                    </li>
                    <li class="" active_link="employee/add_user/edit">
                        <a href="<?= site_url('employee/add_user/edit'); ?>">
                            <span><i class="entypo-dot"></i> Edit User</span>
                        </a>
                    </li>
                    <li class="" active_link="employee/add_user/delete">
                        <a href="<?= site_url('employee/add_user/delete'); ?>">
                            <span><i class="entypo-dot"></i> Delete User</span>
                        </a>
                    </li>
                    <!-- PRE EXAM  -->
                </ul>
            </li>
            <!-- Users DASHBOARD -->
            <!-- ADMISSION DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
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


            <!-- ATTENDANCE DASHBOARD -->       
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

                    <li class="" active_link="admin/manage_employee_attendance">
                        <a href="<?= site_url('admin/manage_employee_attendance'); ?>">
                            <span><i class="entypo-dot"></i><span>Staff Attendance (Manually)</span></span>
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


                    <li class="" active_link="attendance_employee_report">
                        <a href="<?= site_url('admin/attendance_employee_report'); ?>">
                            <span><i class="entypo-dot"></i>Staff Attendance Report</span>
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

                            <li active_link="invoice/add/">
                                <a href="<?= site_url('invoice/add/'); ?>">
                                    <span><i class="entypo-dot"></i>Create Invoice</span>
                                </a>
                            </li>

                            <li class="" active_link="feetype">
                                <a href="<?= site_url('feetype'); ?>">
                                    <span><i class="entypo-dot"></i>Fee Type</span>
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
                            <!--<li class=" " active_link="exphead">-->
                            <!--    <a href="<?= site_url('admin/expense_category'); ?>">-->
                            <!--        <span><i class="entypo-dot"></i> -->
                            <!--            <span>Create Expenses</span>-->
                            <!--        </span></a>-->
                            <!--</li>-->
                            <li class=" " active_link="exphead">
                                <a href="<?= site_url('exphead'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Create Expenditure Head</span>
                                    </span></a>
                            </li>
                            <!--<li class=" " active_link="exphead">-->
                            <!--    <a href="<?= site_url('expenditure/expenditure_add'); ?>">-->
                            <!--        <span><i class="entypo-dot"></i> -->
                            <!--            <span>Add Daily/Monthly Expanses</span>-->
                            <!--        </span></a>-->
                            <!--</li>  -->
                            <li class=" " active_link="expenditure">
                                <a href="<?= site_url('expenditure'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Daily/Monthly Expanses</span>
                                    </span></a>
                            </li> 
                            <li class="" active_link="manage_account_expenses_report">
                                <a href="<?= site_url('admin/manage_account_expenses_report'); ?>">
                                    <span><i class="entypo-dot"></i>Expenses Report</span>
                                </a>
                            </li>

                            <!--<li class="" active_link="payment">-->
                            <!--    <a href="<?= site_url('payroll/payment'); ?>">-->
                            <!--        <span><i class="entypo-dot"></i>Payment Made</span>-->
                            <!--    </a>-->
                            <!--</li>-->

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
                            <li class="" active_link="member">
                                <a href="<?= site_url('admin/expense?title=School Expanses Report'); ?>">
                                    <span><i class="entypo-dot"></i>School Expanses Report</span>
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
                            <!--li class="" active_link="payment">
                                <a href="<?= site_url('employee'); ?>">
                                    <span><i class="entypo-dot"></i>Staff List</span>
                                </a>
                            </li-->
                            <li class="" active_link="payment">
                                <a href="<?= site_url('admin/staff_salary_paid?title=Salary Paid'); ?>">
                                    <span><i class="entypo-dot"></i>Salary Paid</span>
                                </a>
                            </li>
                            <li class="" active_link="payment">
                                <a href="<?= site_url('admin/staff_salary_unpaid'); ?>">
                                    <span><i class="entypo-dot"></i>Salary Unpaid</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?= site_url('admin/add_advance_pay/'); ?>">
                                    <span><i class="entypo-dot"></i>Total Advance Payment</span>
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
                        <a href="<?= site_url('admin/manage_account_report/'); ?>">
                            <span><i class="entypo-dot"></i>Account Report</span>
                        </a>
                    </li>




                </ul>
            </li>
            <!-- ACCOUNTS PAYROLL DASHBOARD -->


            <!-- INVENTORY panel -->       
            <li class="">
                <a href="#">
                    <i class="entypo-credit-card"></i>
                    <span>Inventory</span>
                </a>
                <ul>
                    <li class="">
                        <a href="<?= site_url('inventory/add/'); ?>">
                            <span><i class="entypo-dot"></i>Add Inventory/Asset</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="<?= site_url('inventory/add_inventory/'); ?>">
                            <span><i class="entypo-dot"></i>Distribute Inventory</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('inventory/add_asset?title=Add assets of school'); ?>">
                            <span><i class="entypo-dot"></i>Add Assets of School</span>
                        </a>
                    </li>

                    <!--li class="">
                        <a href="<?= site_url('inventory/add_asset_inventory?title=Add Asset Inventory'); ?>">
                            <span><i class="entypo-dot"></i>Add Asset Inventory</span>
                        </a>
                    </li-->
                    <li class="">
                        <a href="<?= site_url('inventory/add_asset_inventory_damaged?title=Add Damaged Inventory'); ?>">
                            <span><i class="entypo-dot"></i>Add Damaged Inventory</span>
                        </a>
                    </li>
                    
                    <li class="">
                        <a href="<?= site_url('inventory/list_asset_inv_damaged_data'); ?>">
                            <span><i class="entypo-dot"></i>List Damage Inventory</span>
                        </a>
                    </li>


                    <li class="">
                        <a href="<?= site_url('admin/manage_inventory_report/'); ?>">
                            <span><i class="entypo-dot"></i>Issue Inventory/Asset Report</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="<?= site_url('inventory/damaged_report/'); ?>">
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
                        <a href="<?= site_url('admin/manage_travel_report?title=Vehicle Travelled'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Travelled</span>
                            </span></a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('transport/travel/add_travel'); ?>">
                            <span><i class="entypo-dot"></i>Fuel Availability</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="<?= site_url('transport/travel/add_vehicle_service'); ?>">
                            <span><i class="entypo-dot"></i>Add Service Expenditure</span>
                        </a>
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

                    
                    <li class=" " active_link="transport_dashboard">
                        <a href="<?= site_url('transport/route'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Vehicle Route</span>
                            </span></a>
                    </li>
                    
                    <li class=" " active_link="route">
                        <a href="<?= site_url('admin/manage_travel_report'); ?>">
                            <span><i class="entypo-dot"></i> 
                                <span>Transport Report</span>
                            </span></a>
                    </li>
                    
                    <li class="">
                        <a href="<?= site_url('admin/manage_travel_report?title=Total Service Expenditure'); ?>">
                            <span><i class="entypo-dot"></i>Total Service Expenditure</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('transport/travel/add'); ?>">
                            <span><i class="entypo-dot"></i>Vehicle Travelled Details</span>
                        </a>
                    </li>

                    <!--<li class="">-->
                    <!--    <a href="<?= site_url('transport/travel/index_vehicle_service'); ?>">-->
                    <!--        <span><i class="entypo-dot"></i>List Service Expenditure</span>-->
                    <!--    </a>-->
                    <!--</li>-->

                </ul>
            </li>
            <!-- TRANSPORT DASHBOARD -->

            <!-- HOSTEL DASHBOARD -->
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-home"></span>
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
                                    <span>Room Change Request </span>
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
                                <span>Hostel Report Download</span>
                            </span></a>
                    </li>
                    <li class=" " active_link="hostel_dashboard">
                        <a href="<?= site_url('admin/hostel_report_staff'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Hostel Report Staff Download</span>
                            </span></a>
                    </li>
                </ul>
            </li>
            <!-- HOSTEL DASHBOARD -->

            <!-- Academic Dashboard -->

            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-study"></span>
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
                    <!-- MANAGE CLASSES -->

                    <!-- CLASS ROUTINE -->
                    <!--<li class="has-sub">-->
                    <!--    <a href="#">-->
                    <!--        <span><i class="entypo-dot"></i><span>-->
                    <!--                <span>Class Routine</span>-->
                    <!--            </span></span></a>-->
                    <!--    <ul>-->
                    <!--        <li class="" active_link="timetable_template">-->
                    <!--            <a href="<?= site_url('admin/timetable_template'); ?>">-->
                    <!--                <span><i class="entypo-dot"></i>Timetable Template</span>-->
                    <!--            </a>-->
                    <!--        </li>-->

                    <!--        <li class="" active_link="class_timetable">-->
                    <!--            <a href="<?= site_url('admin/class_timetable'); ?>">-->
                    <!--                <span><i class="entypo-dot"></i>Class Timetable</span>-->
                    <!--            </a>-->
                    <!--        </li>-->

                    <!--        <li class="" active_link="class_dailytimetable">-->
                    <!--            <a href="<?= site_url('admin/class_dailytimetable'); ?>">-->
                    <!--                <span><i class="entypo-dot"></i>Class Dailytimetable</span>-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                    <!-- CLASS ROUTINE -->

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

                    <!-- CLASS ASSIGNMENTS -->
                    <!--<li class="has-sub">-->
                    <!--    <a href="#">-->
                    <!--        <span><i class="entypo-dot"></i><span>-->
                    <!--                <span>Assignments</span>-->
                    <!--            </span></span></a>-->
                    <!--    <ul>-->
                    <!--        <li class="" active_link="assignment_index">-->
                    <!--            <a href="<?= site_url('assignment/index'); ?>">-->
                    <!--                <span><i class="entypo-dot"></i>Assignment List</span>-->
                    <!--            </a>-->
                    <!--        </li>-->

                    <!--        <li class="" active_link="1#tab_add_assignment">-->
                    <!--            <a href="<?= site_url('assignment/index/1#tab_add_assignment'); ?>">-->
                    <!--                <span><i class="entypo-dot"></i>Add Assignment</span>-->
                    <!--            </a>-->
                    <!--        </li>-->

                    <!--        <li class="" active_link="1#tab_view_assignment">-->
                    <!--            <a href="<?= site_url('assignment/index/1#tab_view_assignment'); ?>">-->
                    <!--                <span><i class="entypo-dot"></i>View Assignment</span>-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                    <!-- CLASS ASSIGNMENTS -->

                    <!-- STUDY MATERIAL -->
                    <li class=" " active_link="study_material">
                        <a href="<?= site_url('admin/study_material'); ?>">

                            <span><i class="entypo-dot"></i> 
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
                        <a href="<?= site_url('admin/examination_results_dashboard'); ?>">

                            <span><i class="entypo-dot"></i> 
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
                            <!--<li class=" " active_link="question_paper">-->
                            <!--    <a href="<?= site_url('admin/question_paper'); ?>">-->
                            <!--        <span><i class="entypo-dot"></i> -->
                            <!--            <span>Question Paper</span>-->
                            <!--        </span></a>-->
                            <!--</li> -->
                            
                            <li class=" " active_link="marks_manage">
                                <a href="<?= site_url('admin/marks_manage'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Manage Marks</span>
                                    </span></a>
                            </li> 
                            
                             


                            

                            <!--<li class=" " active_link="exam_marks_sms">-->
                            <!--    <a href="<?= site_url('admin/exam_marks_sms'); ?>">-->
                            <!--        <span><i class="entypo-dot"></i> -->
                            <!--            <span>Exam Mark SMS</span>-->
                            <!--        </span></a>-->
                            <!--</li>  -->

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
                                        <span>Expired Exam</span>
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

            <!-- MESSAGE DASHBOARD -->
            <li class="">
                <a href="<?= site_url('admin/message'); ?>">
                    <i class="entypo-mail"></i>
                    <span><?= get_phrase('message'); ?></span>
                </a>

                <ul>
                    <li class=" " active_link="message">
                        <a href="<?= site_url('admin/message'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Send Message/Notications</span>
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

            <!-- Guardian desk DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-map"></span>
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

            <!-- Certificate DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-map"></span>
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

                    <li class="" active_link="certificate_requests">
                        <a href="<?= site_url('certificate/certificate_requests'); ?>">
                            Certificate Request
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Certificate DASHBOARD -->

            <!-- EXTRA CURRICULAR DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-medal"></span>
                    <span>Events And Holidays</span>
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

            <!-- STUDENT DASHBOARD -->
            <!-- STUDENT DASHBOARD -->       
            <li class="root-level has-sub">

                <a href="#">
                    <span class="s7-id"></span>
                    <span>Student</span>
                </a>

                <ul>
                    <li class="" active_link="student_dashboard">
                        <a href="<?= site_url('admin/student_dashboard'); ?>">

                            <span><i class="entypo-dot"></i> 
                                <span>Student Dashboard</span>
                            </span></a>
                    </li>

                    <li class="" active_link="student_promotion">
                        <a href="<?= site_url('admin/student_promotion'); ?>">
                            <span><i class="entypo-dot"></i>Student Promotion</span>
                        </a>
                    </li>
                    <li class="" active_link="student_information">
                                <a href="<?= site_url('admin/birthday_list'); ?>">
                                    <span><i class="entypo-dot"></i>Birthday List</span>
                                </a>
                    </li>
                    <?php /*
                    <!--STUDENT INFORMATION-->
                    <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                                    <span>Student Information</span>
                                </span></span></a>

                        <ul>
                            <li class="" active_link="student_information">
                                <a href="<?= site_url('admin/student_information'); ?>">
                                    <span><i class="entypo-dot"></i>Student Information</span>
                                </a>
                            </li>
                            
                            <li class="" active_link="student_information">
                                <a href="<?= site_url('admin/student_information_inactive/1'); ?>">
                                    <span><i class="entypo-dot"></i>Quit Student Information</span>
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
                                <a href="<?= site_url('admin/manage_attendance'); ?>">
                                    <span><i class="entypo-dot"></i>Manage Attendance</span>
                                </a>
                            </li>



                            <li class="" active_link="attendance_report">
                                <a href="<?= site_url('admin/attendance_report'); ?>">
                                    <span><i class="entypo-dot"></i>Attendance Report</span>
                                </a>
                            </li>

                            <li class="" active_link="attendance_by_rfid">
                                <a href="<?= site_url('admin/attendance_by_rfid'); ?>">
                                    <span><i class="entypo-dot"></i>Attendance By Rfid</span>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <!-- DAILY ATTENDANCE  -->
                */ ?>
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

                    <!-- DAILY ATTENDANCE -->
                </ul>
            </li>
            <!-- TEACHER DASHBOARD -->







            <li class="">
                <a href="<?= site_url('admin/message'); ?>">
                    <i class="entypo-mail"></i>
                    <span><?= get_phrase('message'); ?></span>
                </a>
            </li>
        </ul>

        <!-- MAIN MENU ENDS HERE -->
        <!-- MAIN MENU ENDS HERE -->
        <!-- MAIN MENU ENDS HERE -->
    </div>

</div>


<script type="text/javascript">
    function login_form() {
        document.getElementById("myForm").submit();
    }
</script>