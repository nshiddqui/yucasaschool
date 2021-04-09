  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'facilities_dashboard'){echo "active";}?>"><a href="#facilities_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Facilities Dasboard</a></li>
        <li class="<?php if ($activeTab == 'library'){echo "active";}?>"><a href="#library" class=""  role="tab" data-toggle="tab" aria-expanded="true">Library</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'facilities_dashboard'){echo " active in";}?>" id="facilities_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/facilities_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/facilities_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'library'){echo " active in";}?>" id="library">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/book" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/book"><i class="fa fa-list-ol"></i>Book List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/book_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/book_request"><i class="fa fa-list-ol"></i>My Book Requests</a></li>
      </ul>
    </div>
  </div>