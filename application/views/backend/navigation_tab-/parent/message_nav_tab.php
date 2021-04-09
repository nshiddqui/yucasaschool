  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'message'){echo "active";}?>"><a href="#message" class="" role="tab" data-toggle="tab" aria-expanded="true" >Message Dashboard</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'message'){echo " active in";}?>" id="message">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/message" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/message"><i class="fa fa-desktop"></i> Message</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/group_message" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/group_message"><i class="fa fa-desktop"></i>Group Message</a></li>
      </ul>
    </div>
  </div>