  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'hostel_dashboard'){echo "active";}?>"><a href="#hostel-dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Hostel Dasboard</a></li>
        <li class="<?php if ($activeTab == 'hostel'){echo "active";}?>"><a href="#hostel_manage_tab" class=""  role="tab" data-toggle="tab" aria-expanded="true">Hostel Management</a></li>
        <li class="<?php if ($activeTab == 'memebers'){echo "active";}?>"><a href="#hostel_members" class="" role="tab" data-toggle="tab" aria-expanded="true">Hostel Members</a></li>
        <li class="<?php if ($activeTab == 'attendance'){echo "active";}?>"><a href="#manage_hostel_attendance" class="" role="tab"  data-toggle="tab" aria-expanded="true">Hostel Attendance</a></li>
        <li class="<?php if ($activeTab == 'rooms'){echo "active";}?>"><a href="#hostel_rooms" class="" role="tab"  data-toggle="tab" aria-expanded="true">Hostel Rooms</a></li>
        <li class="<?php if ($activeTab == 'switch_request'){echo "active";}?>"><a href="#roomswitch_request" class="" role="tab"  data-toggle="tab" aria-expanded="true">Rooms Switch Request</a></li>
        <li class="<?php if ($activeTab == 'visitor'){echo "active";}?>"><a href="#visitor" class="" role="tab"  data-toggle="tab" aria-expanded="true">Visitor</a></li>
      </ul>
    </div>
  </div>

  <div class="tab-content">
    
    <!-- Hostel Dashboard Tab -->
    <div  class="tab-pane fade <?php if ($activeTab == 'hostel_dashboard'){echo " active in";}?>" id="hostel-dashboard" >
      <ul class="list-inline ajax-sub-nav">
		<li><a href="<?php echo base_url(); ?>index.php/admin/hostel_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/hostel_dashboard"><i class="fa fa-desktop"></i> Dashboard</a></li>
      </ul>
    </div>
    <!-- Hostel Management Tab -->
    <div  class="tab-pane fade <?php if ($activeTab == 'hostel'){echo " active in";}?>" id="hostel_manage_tab" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/hostel" class="url-link" data-url="<?php echo base_url(); ?>index.php/hostel"><i class="fa fa-list"></i> Hostel List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/hostel#tab_add_hostel" class="url-link" data-url="<?php echo base_url(); ?>index.php/hostel#tab_add_hostel"><i class="fa fa-plus"></i> Add Hostel</a></li>
      </ul>
    </div>
    <!-- Hostel Members Tab -->
    <div  class="tab-pane fade <?php if ($activeTab == 'memebers'){echo " active in";}?>" id="hostel_members" >
      <ul class="list-inline ajax-sub-nav">
		<li><a href="<?php echo base_url(); ?>index.php/member" class="url-link" data-url="<?php echo base_url(); ?>index.php/member"><i class="fa fa-address-book"></i> Member List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/member/add/" class="url-link" data-url="<?php echo base_url(); ?>index.php/member/add/"><i class="fa fa-address-book-o"></i> Non Member List</a></li>
      </ul>
    </div>
    
    <!-- Hostel Attendance Tab -->
    <div  class="tab-pane fade <?php if ($activeTab == 'attendance'){echo " active in";}?>" id="manage_hostel_attendance" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/manage_hostel_attendance" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/manage_hostel_attendance"><i class="fa fa-line-chart"></i>Attendance Report</a></li>
      </ul>
    </div>
    
    <!-- Hostel Rooms Tab -->
    <div  class="tab-pane fade <?php if ($activeTab == 'rooms'){echo " active in";}?>" id="hostel_rooms" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/room" class="url-link" data-url="<?php echo base_url(); ?>index.php/room"><i class="fa fa-list-ol"></i> Room List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/room/add" class="url-link" data-url="<?php echo base_url(); ?>index.php/room/add"><i class="entypo-chart-area"></i> Add Room</a></li>
      </ul>
    </div>
    
    <!-- Hostel Room Switch Tab -->
    <div  class="tab-pane fade <?php if ($activeTab == 'switch_request'){echo " active in";}?>" id="roomswitch_request" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/roomswitch_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/roomswitch_request"><i class="fa fa-list-ol"></i> Request List</a></li>
      </ul>
    </div>
    <!-- Visitor Tab -->
    <div  class="tab-pane fade <?php if ($activeTab == 'visitor'){echo " active in";}?>" id="visitor" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/visitor" class="url-link" data-url="<?php echo base_url(); ?>index.php/visitor"><i class="fa fa-users"></i> Visitor</a></li>
      </ul>
    </div>
  </div>