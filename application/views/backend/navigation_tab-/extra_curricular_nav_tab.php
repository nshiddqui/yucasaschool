  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'extra_curricular_dashboard'){echo "active";}?>"><a href="#extra_curricular_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Extra Curricular Dasboard</a></li>
        <li class="<?php if ($activeTab == 'event'){echo "active";}?>"><a href="#event" class=""  role="tab" data-toggle="tab" aria-expanded="true">Event</a></li>
        <li class="<?php if ($activeTab == 'noticeboard'){echo "active";}?>"><a href="#noticeboard" class=""  role="tab" data-toggle="tab" aria-expanded="true">Noticeboard</a></li>
        
        <li class="<?php if ($activeTab == 'holidays'){echo "active";}?>"><a href="#holidays" class=""  role="tab" data-toggle="tab" aria-expanded="true">Holidays</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'extra_curricular_dashboard'){echo " active in";}?>" id="extra_curricular_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/extra_curricular_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/extra_curricular_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'event'){echo " active in";}?>" id="event">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/event#tab_event_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/event#tab_event_list"><i class="fa fa-list-ol"></i>Event List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/event#tab_add_event" class="url-link" data-url="<?php echo base_url(); ?>index.php/event#tab_add_event"><i class="fa fa-list-ol"></i>Add Event</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'noticeboard'){echo " active in";}?>" id="noticeboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/noticeboard#list" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/noticeboard#list"><i class="fa fa-list-ol"></i>Noticeboard List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/noticeboard#add" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/noticeboard#add"><i class="fa fa-list-ol"></i>Add Noticeboard</a></li>
      </ul>
    </div>
    
    <div  class="tab-pane fade <?php if ($activeTab == 'holidays'){echo " active in";}?>" id="holidays">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/holidays" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/holidays"><i class="fa fa-list-ol"></i>Holiday List</a></li>
      
      </ul>
    </div>
  </div>