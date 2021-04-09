  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="active"><a href="#hostel-dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Hostel Dasboard</a></li>
        <li class=""><a href="#hostel_manage_tab" class=""  role="tab" data-toggle="tab" aria-expanded="true">Hostel Management</a></li>
        <li class=""><a href="#hostel_members" class="" role="tab" data-toggle="tab" aria-expanded="true">Hostel Members</a></li>
        <li class=""><a href="#manage_hostel_attendance" class="" role="tab"  data-toggle="tab" aria-expanded="true">Hostel Attendance</a></li>
        <li class=""><a href="#hostel_rooms" class="" role="tab"  data-toggle="tab" aria-expanded="true">Hostel Rooms</a></li>
        <li class=""><a href="#roomswitch_request" class="" role="tab"  data-toggle="tab" aria-expanded="true">Rooms Switch Request</a></li>
      </ul>
    </div>
  </div>

  <div class="tab-content">
    <div  class="tab-pane fade in active" id="hostel-dashboard" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/hostel_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/hostel_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade" id="hostel_manage_tab" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/hostel#tab_hostel_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/hostel#tab_hostel_list"><i class="fa fa-list-ol"></i> Hostel List</a></li>
        <li><a href="" class="url-link" data-url="<?php echo base_url(); ?>index.php/hostel#tab_add_hostel"><i class="entypo-chart-area"></i> Add Hostel</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade" id="hostel_members" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/member" class="url-link" data-url="<?php echo base_url(); ?>index.php/member"><i class="fa fa-list-ol"></i>Member List</a></li>
        <li><a href="" class="url-link" data-url="<?php echo base_url(); ?>index.php/member/add/"><i class="entypo-chart-area"></i>Non Member List</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade" id="manage_hostel_attendance" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/manage_hostel_attendance" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/manage_hostel_attendance"><i class="fa fa-list-ol"></i>Attendance Report</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade" id="hostel_rooms" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/room" class="url-link" data-url="<?php echo base_url(); ?>index.php/room"><i class="fa fa-list-ol"></i>Room List</a></li>
        <li><a href="" class="url-link" data-url="<?php echo base_url(); ?>index.php/room#tab_add_room"><i class="entypo-chart-area"></i>Add Room</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade" id="roomswitch_request" >
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/roomswitch_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/roomswitch_request"><i class="fa fa-list-ol"></i>Request List</a></li>
      </ul>
    </div>
  </div>