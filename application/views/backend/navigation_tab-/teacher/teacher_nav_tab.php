  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'teacher_dashboard'){echo "active";}?>"><a href="#teacher_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Teacher Dashboard</a></li>
        <li class="<?php if ($activeTab == 'profile'){echo "active";}?>"><a href="#profile" class="" role="tab" data-toggle="tab" aria-expanded="true" >Profile</a></li>
        <li class="<?php if ($activeTab == 'salary'){echo "active";}?>"><a href="#salary" class="" role="tab" data-toggle="tab" aria-expanded="true" >Salary</a></li>
        <li class="<?php if ($activeTab == 'leave'){echo "active";}?>"><a href="#leave" class="" role="tab" data-toggle="tab" aria-expanded="true" >Leave</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'teacher_dashboard'){echo " active in";}?>" id="teacher_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/teacher_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/teacher_dashboard"><i class="fa fa-desktop"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'profile'){echo " active in";}?>" id="profile">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/manage_profile" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/manage_profile"><i class="fa fa-pencil-square-o"></i> Account</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'salary'){echo " active in";}?>" id="salary">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/salary_details" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/salary_details"><i class="fa fa-bar-chart"></i> Salary Details</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'leave'){echo " active in";}?>" id="leave">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/teacher_leave_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_leave_request"><i class="fa fa-list"></i> Leave Request</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/teacher_leaves_past_record" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/teacher_leaves_past_record"><i class="fa fa-plus"></i> Leaves Past Record</a></li>
      </ul>
    </div>
  </div>