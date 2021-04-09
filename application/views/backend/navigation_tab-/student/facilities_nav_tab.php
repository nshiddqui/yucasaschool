  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'library'){echo "active";}?>"><a href="#library" class=""  role="tab" data-toggle="tab" aria-expanded="true">Library</a></li>
        <li class="<?php if ($activeTab == 'dormitory'){echo "active";}?>"><a href="#dormitory" class=""  role="tab" data-toggle="tab" aria-expanded="true">Dormitory</a></li>
        <li class="<?php if ($activeTab == 'transport'){echo "active";}?>"><a href="#transport" class=""  role="tab" data-toggle="tab" aria-expanded="true">Transport</a></li>
        <li class="<?php if ($activeTab == 'card'){echo "active";}?>"><a href="#card" class=""  role="tab" data-toggle="tab" aria-expanded="true">Card</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'library'){echo " active in";}?>" id="library">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/book" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/book"><i class="fa fa-list-ol"></i>Book List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/student/book_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/book_request"><i class="fa fa-list-ol"></i>My Book Requests</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'dormitory'){echo " active in";}?>" id="dormitory">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/student_roomchange_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/student_roomchange_request"><i class="entypo-chart-area"></i> Room Change Request</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'transport'){echo " active in";}?>" id="transport">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/transport" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/transport"><i class="entypo-chart-area"></i> Transport</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'card'){echo " active in";}?>" id="card">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/rf_id_card_block" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/rf_id_card_block"><i class="fa fa-list-ol"></i>RFID Card Block</a></li>
      </ul>
    </div>
  </div>