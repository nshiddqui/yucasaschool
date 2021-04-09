  <div class="container-fluid" style="display:none;">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'student_dashboard'){echo "active";}?>"><a href="#student_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Student Dasboard</a></li>
        <li class="<?php if ($activeTab == 'student_information'){echo "active";}?>"><a href="#student_information" class=""  role="tab" data-toggle="tab" aria-expanded="true">Student Information</a></li>
        <li class="<?php if ($activeTab == 'daily_attendance'){echo "active";}?>"><a href="#daily_attendance" class=""  role="tab" data-toggle="tab" aria-expanded="true">Daily Attendance</a></li>
        <li class="<?php if ($activeTab == 'card_recharge'){echo "active";}?>"><a href="#card_recharge" class="" role="tab" data-toggle="tab" aria-expanded="true">Card Recharge</a></li>
        <li class="<?php if ($activeTab == 'houses'){echo "active";}?>"><a href="#houses" class="" role="tab" data-toggle="tab" aria-expanded="true">Houses</a></li>
        <li class="<?php if ($activeTab == 'parent_and_gaurdians'){echo "active";}?>"><a href="#parent_and_gaurdians" class="" role="tab" data-toggle="tab" aria-expanded="true">Parent & Guardian</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'student_dashboard'){echo " active in";}?>" id="student_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/student_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/student_dashboard"><i class="fa fa-desktop"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'student_information'){echo " active in";}?>" id="student_information">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/student_information" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/student_information"><i class="fa fa-pencil-square-o"></i> Student Information</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/student_promotion" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/student_promotion"><i class="fa fa-level-up"></i> Student Promotion</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'daily_attendance'){echo " active in";}?>" id="daily_attendance">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/manage_attendance" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/manage_attendance"><i class="fa fa-bar-chart"></i> Manage Attendance</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/attendance_by_rfid" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/attendance_by_rfid"><i class="fa fa-bar-chart"></i> Attendance by RFID</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/attendance_report" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/attendance_report"><i class="fa fa-line-chart "></i> Attendance Report</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'card_recharge'){echo " active in";}?>" id="card_recharge">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/canteen_card_recharge" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/canteen_card_recharge"><i class="fa fa-credit-card "></i> Card Recharge</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'houses'){echo " active in";}?>" id="houses">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/house_information/studentlist" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/house_information#list"><i class="fa fa-list"></i> House List</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/admin/house_information/add" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/house_information#add"><i class="fa fa-plus"></i> Add House</a></li>
		<li><a href="<?php echo base_url(); ?>index.php/admin/house_information/assign" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/house_information/assign"><i class="fa fa-list-ol"></i> Student Assigned List</a></li>

        <li><a href="<?php echo base_url(); ?>index.php/admin/house_information/non_member_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/house_information/non_member_list"><i class="fa fa-check-square-o"></i> Unassigned Members</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'parent_and_gaurdians'){echo " active in";}?>" id="parent_and_gaurdians">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/parent" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/parent"><i class="fa fa-users"></i> Parent List</a></li>
        <!--<li><a href="<?php echo base_url(); ?>index.php/admin/parent_bulk_add" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/parent_bulk_add"><i class="fa fa-user-plus"></i> Add Bulk Parent</a></li>
        --><li><a href="<?php echo base_url(); ?>index.php/guardian" class="url-link" data-url="<?php echo base_url(); ?>index.php/guardian"><i class="fa fa-user-md"></i> Guardian List</a></li>
      </ul>
    </div>
  </div>