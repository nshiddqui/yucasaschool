  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'profile'){echo "active";}?>"><a href="#profile" class="" role="tab" data-toggle="tab" aria-expanded="true" >Profile</a></li>
        <li class="<?php if ($activeTab == 'leave'){echo "active";}?>"><a href="#leave" class="" role="tab" data-toggle="tab" aria-expanded="true" >Leave</a></li>
      </ul>
    </div> 
  </div>
  <div class="tab-content">
	<div  class="tab-pane fade <?php if ($activeTab == 'profile'){echo " active in";}?>" id="profile">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/manage_profile" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/manage_profile"><i class="fa fa-desktop"></i> Account</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'leave'){echo " active in";}?>" id="leave">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/student_leave_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/student_leave_request"><i class="fa fa-desktop"></i> Leave Request</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/student/student_leaves_report" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/student_leaves_report"><i class="fa fa-desktop"></i> Leaves Past Record</a></li>
      </ul>
    </div>
  </div>