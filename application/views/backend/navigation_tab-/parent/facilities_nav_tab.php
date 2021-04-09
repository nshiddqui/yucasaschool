  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'library'){echo "active";}?>"><a href="#library" class=""  role="tab" data-toggle="tab" aria-expanded="true">Library</a></li>
        <li class="<?php if ($activeTab == 'dormitory'){echo "active";}?>"><a href="#dormitory" class=""  role="tab" data-toggle="tab" aria-expanded="true">Dormitory</a></li>
        <li class="<?php if ($activeTab == 'transport'){echo "active";}?>"><a href="#transport" class=""  role="tab" data-toggle="tab" aria-expanded="true">Transport</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'library'){echo " active in";}?>" id="library">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/book" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/book"><i class="fa fa-list-ol"></i>Book List</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'dormitory'){echo " active in";}?>" id="dormitory">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/room_change_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/room_change_request"><i class="entypo-chart-area"></i> Room Change Request</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/parent_attendance_report" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/parent_attendance_report"><i class="entypo-chart-area"></i>Parent Attendance Report</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/visitors_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/visitors_list"><i class="entypo-chart-area"></i> Visitors</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'transport'){echo " active in";}?>" id="transport">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/transport" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/transport"><i class="entypo-chart-area"></i> Transport</a></li>
      </ul>
    </div>
  </div>