  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'leaves'){echo "active";}?>"><a href="#leaves" class="" role="tab" data-toggle="tab" aria-expanded="true" >Leave Dashboard</a></li>
       
      </ul>
    </div>
  </div>
  <div class="tab-content payroll_tab">
    <div  class="tab-pane fade <?php if ($activeTab == 'leaves'){echo " active in";}?>" id="leaves">
      <ul class="list-inline ajax-sub-nav">
          <li><a href="<?php echo base_url(); ?>index.php/designation_users/leave_request" class="url-link" data-url="<?php echo base_url(); ?>index.php/designation_users/leave_request"><i class="entypo-chart-area"></i> Leave Request</a></li>
          
        <li><a href="<?php echo base_url(); ?>index.php/designation_users/leaves_past_record" class="url-link" data-url="<?php echo base_url(); ?>index.php/designation_users/leaves_past_record"><i class="entypo-chart-area"></i> Leave History</a></li>
      </ul>
    </div>

  </div>