<div class="sidebar-menu" style="min-height: 2113px;">
    <header class="logo-env" ><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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

    <div style=""></div>	
    <div class="main-menu-wrapper">
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('accountant/dashboard'); ?>">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
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
                            <?php /*<li class=" " active_link="exphead">
                                <a href="<?= site_url('admin/expense_category'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Create Expenses</span>
                                    </span></a>
                            </li> */ ?>
                            <li class=" " active_link="exphead">
                                <a href="<?= site_url('exphead'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Create Expenditure Head</span>
                                    </span></a>
                            </li>
                            <?php /*
                            <li class=" " active_link="exphead">
                                <a href="<?= site_url('expenditure/expenditure_add'); ?>">
                                    <span><i class="entypo-dot"></i> 
                                        <span>Add Daily/Monthly Expanses</span>
                                    </span></a>
                            </li>  */ ?>
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
                            <?php /*
                            <li class="" active_link="payment">
                                <a href="<?= site_url('payroll/payment'); ?>">
                                    <span><i class="entypo-dot"></i>Payment Made</span>
                                </a>
                            </li> */ ?>

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
                           <?php /* <!--li class="" active_link="payment">
                                <a href="<?= site_url('employee'); ?>">
                                    <span><i class="entypo-dot"></i>Staff List</span>
                                </a>
                            </li--> */ ?>
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
    
    </ul>
    </div>

</div>