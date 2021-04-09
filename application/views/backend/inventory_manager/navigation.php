<?php 
//print_r($this->session->userdata());die;
?>
<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>uploads/logo.png"  style="max-height:60px;"/>
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

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>
       <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/dashboard'); ?>">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?> </span>
            </a>
        </li>


        <?php if($this->session->userdata('role_id') == 9){ ?>
      
        <!-- MESSAGE -->
      
		    <li class="<?php if ($page_name == 'route_list') echo 'active'; ?> ">
            <a href="<?php echo site_url('Designation_users/route_list'); ?>">
                <i class="fa fa-bus"></i>
                <span><?php echo get_phrase('route_list'); ?></span>
            </a>
           </li>

      <?php } ?>

      <?php if($this->session->userdata('role_id') == 13){ ?>
       
        
        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message' || $page_name == 'group_message') echo 'active'; ?> ">
            <a href="<?php //echo site_url('admin/message'); ?>">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>
          <!-- Hostel -->
        <li class="<?php
        if ($page_name == 'hostel' ||
                $page_name == 'member' ||
                    $page_name == 'room')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-hotel"></i>
                <span><?php echo get_phrase('hostel'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
                    <a href="<?php echo site_url('designation_users/hostel'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_hostel'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'member') echo 'active'; ?> ">
                    <a href="<?php echo site_url('designation_users/member'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('hostel_member'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'room') echo 'active'; ?> ">
                    <a href="<?php echo site_url('designation_users/room'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_room'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'roomswitch_request') echo 'active'; ?> ">
                    <a href="<?php echo site_url('designation_users/roomswitch_request'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('room_switch_request'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
		    <!-- Visitor Info -->
        <li class="<?php if ($page_name == 'visitor') echo 'active'; ?> ">
            <a href="<?php echo site_url('designation_users/visitor'); ?>">
                <i class="fa fa-male"></i>
                <span><?php echo get_phrase('visitor_info'); ?></span>
            </a>
        </li>  
     
      <?php } ?>

 <?php if($this->session->userdata('role_id') == 16){ ?>
      <!-- Visitor Info -->
        <li class="<?php if ($page_name == 'visitor') echo 'active'; ?> ">
            <a href="<?php echo site_url('designation_users/visitor'); ?>">
                <i class="fa fa-male"></i>
                <span><?php echo get_phrase('visitor_info'); ?></span>
            </a>
        </li>


 <?php } ?>
 
 <?php if($this->session->userdata('role_id') == 17 ){ ?>
      
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
                <li class="">
                    <a href="<?php echo site_url('admin/manage_inventory_report/'); ?>">
                        <span><i class="entypo-dot"></i>Inventory report</span>
                    </a>
                </li>
                 
            </ul>
        </li>


 <?php } ?>


     <li class="root-level has-sub">

        <a href="#">
                    <span class="s7-home"></span>
                    <span>Birthday</span>
                </a>

                <ul class="" style="">
                    <li class="" active_link="manage_attendance">
                                    <a href="<?php echo site_url('parents/staff'); ?>">
                                        Staff
                                    </a>
                                </li>

                                <li class="" active_link="attendance_report">
                                    <a href="<?php echo site_url('parents/student_information/1'); ?>">
                                        Student
                                    </a>
                                </li>
                                
                                
                    <!-- PRE EXAM  -->

                
                </ul>
       <!-- <a href="#">
            <span class="s7-add-user"></span>
            <span>Admission</span>
        </a>

        <ul>
           <li class="" active_link="pre_exam_student_registration">
                                    <a href="http://digitalflares.com/college_erp/admin/pre_exam_student_registration">
                                        Student Registration
                                    </a>
                                </li>

                                <li class="" active_link="pre_exam_student_information">
                                    <a href="http://digitalflares.com/college_erp/admin/pre_exam_student_information">
                                        Student Information>
                                    </a>
                                </li>

            
		
        </ul>-->
    </li>  
     

        <!-- Route Info -->
    
  <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/noticeboard'); ?>">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- Salary Dashboard  -->
        <li class="<?php if ($page_name == 'salary_details' || $page_name == 'salary_deduction' || $page_name == 'salary_payslips') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('salary_dashboard'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'salary_details') echo 'active'; ?> ">
                    <a href="<?php echo site_url('designation_users/salary_details'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('salary_details'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Leave Dashboard  -->
        <li class="<?php if ($page_name == 'leave_request' || $page_name == 'leaves_past_record') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('leave'); ?></span>
            </a>
            <ul>
                <li class="<?php if (($page_name == 'leave_request')) echo 'active'; ?>">
                    <a href="<?php echo site_url('designation_users/leave_request'); ?>">
                        <span><i class="entypo-dot"></i><?php echo get_phrase('leave_request'); ?></span>
                    </a>
                </li>
                
                 <li class="<?php if (($page_name == 'leaves_past_record')) echo 'active'; ?>">
                    <a href="<?php echo site_url('designation_users/leaves_past_record'); ?>">
                        <span><i class="entypo-dot"></i><?php echo get_phrase('leaves_past_record'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
	

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/manage_profile'); ?>">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
