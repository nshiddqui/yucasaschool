  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'noticeboard'){echo "active";}?>"><a href="#noticeboard" class=""  role="tab" data-toggle="tab" aria-expanded="true">Extra</a></li>
        <li class="<?php if ($activeTab == 'certification'){echo "active";}?>"><a href="#certification" class=""  role="tab" data-toggle="tab" aria-expanded="true">Certification</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
	<div  class="tab-pane fade <?php if ($activeTab == 'noticeboard'){echo " active in";}?>" id="noticeboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/event" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/event"><i class="fa fa-list-ol"></i>Event</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/noticeboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/noticeboard"><i class="fa fa-list-ol"></i>Noticeboard</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'certification'){echo " active in";}?>" id="certification">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/view_all_certificates" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/view_all_certificates"><i class="fa fa-list-ol"></i>View All Certificate</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/apply_for_certificates" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/apply_for_certificates"><i class="fa fa-list-ol"></i>Apply For Certificate</a></li>
      </ul>
    </div>
  </div>