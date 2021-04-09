  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'profile'){echo "active";}?>"><a href="#profile" class="" role="tab" data-toggle="tab" aria-expanded="true" >Profile</a></li>
        <li class="<?php if ($activeTab == 'attendance'){echo "active";}?>"><a href="#attendance" class="" role="tab" data-toggle="tab" aria-expanded="true" >Attendance Report</a></li>
        <li class="<?php if ($activeTab == 'leave'){echo "active";}?>"><a href="#leave" class="" role="tab" data-toggle="tab" aria-expanded="true" >Leave</a></li>
      </ul>
    </div> 
  </div>
  <div class="tab-content">
	<div  class="tab-pane fade <?php if ($activeTab == 'profile'){echo " active in";}?>" id="profile">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/manage_profile" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/manage_profile"><i class="fa fa-desktop"></i> Account</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'attendance'){echo " active in";}?>" id="attendance">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/attendance_report/1" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/attendance_report/1"><i class="fa fa-desktop"></i> Student Attendance</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'leave'){echo " active in";}?>" id="leave">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/student_leave_requests" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/student_leave_requests"><i class="fa fa-desktop"></i> Leave Request</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/student_leaves_past_record" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/student_leaves_past_record"><i class="fa fa-desktop"></i> Leaves Past Record</a></li>
      </ul>
    </div>
  </div>