  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'message_dashboard'){echo "active";}?>"><a href="#message_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Messages</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'message_dashboard'){echo " active in";}?>" id="message_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/message_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/message_dashboard"><i class="fa fa-desktop"></i> Messages</a></li>
      </ul>
    </div>
  </div>