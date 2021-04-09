  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'teacher_dashboard'){echo "active";}?>"><a href="#teacher_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Teacher Dasboard</a></li>
        <li class="<?php if ($activeTab == 'teacher'){echo "active";}?>"><a href="#teacher" class=""  role="tab" data-toggle="tab" aria-expanded="true">Teachers</a></li>
        <li class="<?php if ($activeTab == 'teacher_feedback'){echo "active";}?>"><a href="#teacherFeedback" class=""  role="tab" data-toggle="tab" aria-expanded="true">Teachers Feedback</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'teacher_dashboard'){echo " active in";}?>" id="teacher_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/teacher_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_dashboard"><i class="fa fa-desktop"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'teacher'){echo " active in";}?>" id="teacher">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/teacher" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher"><i class="fa fa-users"></i> All Teachers</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/teacher_add" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_add"><i class="fa fa-plus"></i> Add Teacher</a></li>
        <!--<li><a href="<?php echo base_url(); ?>index.php/admin/teacher_add_bulk" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_add_bulk"><i class="fa fa-list-ol"></i> Add Bulk Teacher</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/teacher_manage_attendance" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_manage_attendance"><i class="fa fa-bar-chart"></i> Manage Teacher Attendance</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/teacher_attendance_report" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_attendance_report"><i class="fa fa-line-chart"></i> Teacher Attendance Report</a></li>-->
      </ul>
    </div>

    <div  class="tab-pane fade <?php if ($activeTab == 'teacher_feedback'){echo " active in";}?>" id="teacherFeedback">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/teacher_feedback" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_feedback"><i class="fa fa-plus"></i> Add Feedback Form</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/teacher_feedback_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_feedback_list"><i class="fa fa-list-ol"></i></i> Feedback Form List</a></li>
      </ul>
    </div>
  </div>