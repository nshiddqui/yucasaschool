<?php 
//print_r($this->session->userdata());die;
?>
<div class="sidebar-menu">
    <header class="logo-env" ><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
       
        
          <!-- Hostel -->
        <li class="<?php
        if ($page_name == 'hostel' ||
                $page_name == 'member' ||
                    $page_name == 'room')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('hostel'); ?></span>
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
        
        <!-- Hostel -->
        

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
            
            <!-- Birthday -->
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
            
            <!-- End Birthday-->
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
     
       <li class="<?php if ($page_name == 'inventory' || $page_name == 'inentory') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span>Inventory</span>
            </a>
            <ul>
                <li class="<?php if (($page_name == 'inventory')) echo 'active'; ?>">
                    <a href="<?php echo site_url('inventory/add'); ?>">
                        <span><i class="entypo-dot"></i>Add inventory</span>
                    </a>
                </li>
                
                 <li class="<?php if (($page_name == 'inventory')) echo 'active'; ?>">
                    <a href="<?php echo site_url('inventory/add_inventory'); ?>">
                        <span><i class="entypo-dot"></i>Distribute</span>
                    </a>
                </li>
                <li class="">
                   <a href="<?php echo site_url('inventory/add_asset'); ?>">
                        <span><i class="entypo-dot"></i>Add asset type</span>
                    </a>
                </li>
                
                <li class="">
                    <a href="<?php echo site_url('inventory/add_asset_inventory'); ?>">
                        <span><i class="entypo-dot"></i>Add asset inventory</span>
                    </a>
                </li>
                <li class="">
<a href="<?php echo site_url('inventory/add_asset_inventory_damaged'); ?>">
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




                
         <!-- Birthday -->
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
            
            <!-- End Birthday-->  
                
                 
          





 <?php } ?>


     
     

        
            
            
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
