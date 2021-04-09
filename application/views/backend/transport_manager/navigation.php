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
       <?php if($this->session->userdata('role_id') == 18){ ?>
     
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

 <?php } ?>
  <!-- DASHBOARD -->
       <?php if($this->session->userdata('role_id') == 17){ ?>
     
         <!-- INVENTORY panel -->       
            <li class="">
                <a href="#">
                    <i class="entypo-credit-card"></i>
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
                            <span><i class="entypo-dot"></i>Distribute Inventory</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= site_url('inventory/add_asset?title=Add Asset'); ?>">
                            <span><i class="entypo-dot"></i>Add Asset</span>
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

 <?php } ?>
   
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
            <?php if($this->session->userdata('role_id') != 18){ ?>
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
            <?php } ?>
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
