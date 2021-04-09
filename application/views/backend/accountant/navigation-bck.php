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

    <div style=""></div>	
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
        
        <!-- ACCOUNTING -->
        <li class="active">
            <a href="#">
                    <span class="s7-graph3"></span>
                    <span>Accounting</span>
                </a>
        <ul>
        <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Fee deposition</span>
                        </span></span></a>

                        <ul>
                                 <li class="" active_link="feetype">
                                <a href="<?php echo site_url(); ?>feetype">
                                    <span><i class="entypo-dot"></i>Fee Type</span>
                                </a>
                            </li>

                            <li class=" " active_link="exphead">
                                <a href="<?php echo site_url(); ?>invoice">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Fee paid</span>
                                </span></a>
                            </li>  

                            <li class=" " active_link="expenditure">
                                <a href="<?php echo site_url(); ?>invoice/invoice_unpaid">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Fee unpaid</span>
                                </span></a>
                            </li> 
                            <li class=" " active_link="expenditure">
                                <a href="<?php echo site_url(); ?>income">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Total fee deposited</span>
                                </span></a>
                            </li> 
                            <li active_link="<?php if (($page_name == 'invoice')) echo 'active'; ?>">
                                <a href="<?php echo site_url('invoice/add/'); ?>">
                                    <span><i class="entypo-dot"></i>Create invoice</span>
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
                                <a href="<?php echo site_url(); ?>expenditure/expenditure_add">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Add daily/monthly expenses</span>
                                </span></a>
                            </li>  
<li class=" " active_link="exphead">
                                <a href="<?php echo site_url(); ?>exphead">
                                     <span><i class="entypo-dot"></i> 
                                    <span>Expenditure Head</span>
                                </span></a>
                            </li> 
                            <li class=" " active_link="expenditure">
                                <a href="<?php echo site_url(); ?>expenditure">
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                                    <span>Daily/Monthly expenses</span>
                                </span></a>
                            </li> 
                           <li class="" active_link="payment">
                                    <a href="<?php echo site_url(); ?>payroll/payment">
                                        <span><i class="entypo-dot"></i>Payment</span>
                                    </a>
                                </li>

                                  <li class="" active_link="manage_account_expenses_report">
                                    <a href="<?php echo site_url(); ?>admin/manage_account_expenses_report">
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
                                    <a href="<?php echo site_url(); ?>admin/school_income">
                                        <span><i class="entypo-dot"></i>School Income report</span>
                                    </a>
                                </li>
                                <li class="" active_link="member">
                                    <a href="<?php echo site_url(); ?>admin/staff_salary_paid">
                                        <span><i class="entypo-dot"></i>School Expenses report</span>
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
                                    <a href="<?php echo site_url(); ?>employee">
                                        <span><i class="entypo-dot"></i>Staff List</span>
                                    </a>
                                </li>
                                <li class="" active_link="payment">
                                    <a href="<?php echo site_url(); ?>admin/staff_salary_paid">
                                        <span><i class="entypo-dot"></i>Paid month salary</span>
                                    </a>
                                </li>
                                <li class="" active_link="payment">
                                    <a href="<?php echo site_url(); ?>admin/staff_salary_unpaid">
                                        <span><i class="entypo-dot"></i>Unpaid month salary</span>
                                    </a>
                                </li>
                               
     <!--               
                                <li class="has-sub">
                        <a href="#">
                            <span><i class="entypo-dot"></i><span>
                            <span>Income report</span>
                        </span></span></a>

                        <ul>
                                <li class="" active_link="member">
                                    <a href="<?php echo site_url(); ?>admin/staff">
                                        <span><i class="entypo-dot"></i>Monthly income report</span>
                                    </a>
                                </li>
                                <li class="" active_link="member">
                                    <a href="<?php echo site_url(); ?>admin/staff">
                                        <span><i class="entypo-dot"></i>Half yearly income report</span>
                                    </a>
                                </li>
                                <li class="" active_link="transport_member_add">
                                    <a href="<?php echo site_url(); ?>admin/staff">
                                        <span><i class="entypo-dot"></i>Yearly income report</span>
                                    </a>
                                </li>

                                
                        </ul>
                    </li>
                         -->    <!--    <li class="" active_link="grade">-->
                            <!--        <a href="<?php echo site_url(); ?>payroll/grade">-->
                            <!--            <span><i class="entypo-dot"></i>Grade</span>-->
                            <!--        </a>-->
                            <!--    </li>-->

                            <!--    <li class="" active_link="history">-->
                            <!--        <a href="<?php echo site_url(); ?>payroll/history">-->
                            <!--            <span><i class="entypo-dot"></i>History</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                           

                            <!--<li class="" active_link="discount">-->
                            <!--    <a href="<?php echo site_url(); ?>discount">-->
                            <!--        <span><i class="entypo-dot"></i>Discount</span>-->
                            <!--    </a>-->
                            <!--</li> -->

                            <!--<li class=" " active_link="invoice">-->
                            <!--    <a href="<?php echo site_url(); ?>invoice">-->
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <!--        <span>Manage Invoice</span>-->
                            <!--    </span></a>-->
                            <!--</li>-->

                            <!--<li class=" " active_link="invoice_due">-->
                            <!--    <a href="<?php echo site_url(); ?>invoice/due">-->
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <!--        <span>Due Fees</span>-->
                            <!--    </span></a>-->
                            <!--</li>    -->

                            <!--<li class=" " active_link="duefeeemail">-->
                            <!--    <a href="<?php echo site_url(); ?>duefeeemail">-->
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <!--        <span>Due Fee Email</span>-->
                            <!--    </span></a>-->
                            <!--</li>    -->

                            <!--<li class=" " active_link="duefeesms">-->
                            <!--    <a href="<?php echo site_url(); ?>duefeesms">-->
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <!--        <span>Due Fee Sms</span>-->
                            <!--    </span></a>-->
                            <!--</li>   -->

                            <!--<li class=" " active_link="incomehead">-->
                            <!--    <a href="<?php echo site_url(); ?>incomehead">-->
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <!--        <span>Income Head</span>-->
                            <!--    </span></a>-->
                            <!--</li> -->

                            <!--<li class=" " active_link="income">-->
                            <!--    <a href="<?php echo site_url(); ?>income">-->
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <!--        <span>Income</span>-->
                            <!--    </span></a>-->
                            <!--</li>   -->

                            <!--<li class=" " active_link="exphead">-->
                            <!--    <a href="<?php echo site_url(); ?>exphead">-->
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <!--        <span>Expenditure Head</span>-->
                            <!--    </span></a>-->
                            <!--</li>  -->

                            <!--<li class=" " active_link="expenditure">-->
                            <!--    <a href="<?php echo site_url(); ?>expenditure">-->
                                    <!-- <i class="entypo-gauge"></i> --><span><i class="entypo-dot"></i> 
                            <!--        <span>Expenditure</span>-->
                            <!--    </span></a>-->
                            <!--</li> -->

                                
                        </ul>
                    </li>

                <li class="<?php if (($page_name == 'add_advance_pay')) echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/add_advance_pay/'); ?>">
                        <span><i class="entypo-dot"></i>Add Advance Payment</span>
                    </a>
                </li>

                <li class="<?php if (($page_name == 'manage_account_report')) echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/manage_account_report/'); ?>">
                        <span><i class="entypo-dot"></i>Account Report</span>
                    </a>
                </li>

                


                </ul>
            </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'salary_payslips_request') echo 'active'; ?> ">
            <a href="<?php echo site_url('accountant/salary_payslips_request'); ?>">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('salary_payslips_request'); ?></span>
            </a>
        </li>


        <li class="<?php if ($page_name == 'salary_details') echo 'active'; ?> ">
                    <a href="<?php echo site_url('accountant/salary_details'); ?>">
                         <i class="entypo-suitcase"></i>
                        <span><?php echo get_phrase('salary_details'); ?></span>
                    </a>
                </li>
                        
        <!-- Leave Dashboard  -->
        <li class="<?php if ($page_name == 'leave_request' || $page_name == 'leaves_past_record') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('leave'); ?></span>
            </a>
            <ul>
                <li class="<?php if (($page_name == 'leave_request')) echo 'active'; ?>">
                    <a href="<?php echo site_url('accountant/leave_request'); ?>">
                        <span><i class="entypo-dot"></i><?php echo get_phrase('leave_request'); ?></span>
                    </a>
                </li>
                
                 <li class="<?php if (($page_name == 'leaves_past_record')) echo 'active'; ?>">
                    <a href="<?php echo site_url('accountant/leaves_past_record'); ?>">
                        <span><i class="entypo-dot"></i><?php echo get_phrase('leaves_past_record'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
	

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo site_url('accountant/manage_profile'); ?>">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>