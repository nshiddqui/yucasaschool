  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'extra_curricular_dashboard'){echo "active";}?>"><a href="#extra_curricular_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Extra Curricular</a></li>
        <!--li class="<?php if ($activeTab == 'event'){echo "active";}?>"><a href="#event" class=""  role="tab" data-toggle="tab" aria-expanded="true">Event</a></li-->
        <li class="<?php if ($activeTab == 'noticeboard'){echo "active";}?>"><a href="#noticeboard" class=""  role="tab" data-toggle="tab" aria-expanded="true">Noticeboard</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'extra_curricular_dashboard'){echo " active in";}?>" id="extra_curricular_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/extra_curricular_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/extra_curricular_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <!--div  class="tab-pane fade <?php if ($activeTab == 'event'){echo " active in";}?>" id="event">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/event" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/event"><i class="fa fa-list-ol"></i>Event</a></li>
      </ul>
    </div-->
	<div  class="tab-pane fade <?php if ($activeTab == 'noticeboard'){echo " active in";}?>" id="noticeboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/noticeboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/noticeboard"><i class="fa fa-list-ol"></i>Noticeboard</a></li>
      </ul>
    </div>
  </div>