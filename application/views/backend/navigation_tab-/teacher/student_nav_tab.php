  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'student_dashboard'){echo "active";}?>"><a href="#student_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Student Dasboard</a></li>
        <li class="<?php if ($activeTab == 'leave_management'){echo "active";}?>"><a href="#leave_management" class=""  role="tab" data-toggle="tab" aria-expanded="true">Leave Management</a></li>
        <li class="<?php if ($activeTab == 'attendance'){echo "active";}?>"><a href="#attendance" class=""  role="tab" data-toggle="tab" aria-expanded="true">Attendance</a></li>
      </ul>
    </div> 
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'student_dashboard'){echo " active in";}?>" id="student_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/student_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/student_dashboard"><i class="fa fa-desktop"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/student_information/1" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/student_information/1"><i class="fa fa-desktop"></i> Student Information</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/subject/1" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/subject/1"><i class="fa fa-desktop"></i> Subject</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'leave_management'){echo " active in";}?>" id="leave_management">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/student_leave_record" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/student_leave_record"><i class="fa fa-pencil-square-o"></i> Leave Record</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/student_leave_schedule" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/student_leave_schedule"><i class="fa fa-level-up"></i> Leave Schedule</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'attendance'){echo " active in";}?>" id="attendance">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/manage_attendance" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/manage_attendance"><i class="fa fa-bar-chart"></i> Daily Atendance</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/attendance_report" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/attendance_report"><i class="fa fa-line-chart "></i> Attendance Report</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/attendance_by_rfid" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/attendance_by_rfid"><i class="fa fa-line-chart "></i> class Attendance Rfid</a></li>
      </ul>
    </div>
  </div>