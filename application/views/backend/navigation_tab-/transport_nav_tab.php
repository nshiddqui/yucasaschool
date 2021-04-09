  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'transport_dashboard'){echo "active";}?>"><a href="#transport_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Transport Dasboard</a></li>
        <li class="<?php if ($activeTab == 'vehicle'){echo "active";}?>"><a href="#vehicle" class=""  role="tab" data-toggle="tab" aria-expanded="true">Vehicle</a></li>
        <li class="<?php if ($activeTab == 'route'){echo "active";}?>"><a href="#route" class=""  role="tab" data-toggle="tab" aria-expanded="true">Route</a></li>
        <li class="<?php if ($activeTab == 'member'){echo "active";}?>"><a href="#member" class=""  role="tab" data-toggle="tab" aria-expanded="true">Member</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'transport_dashboard'){echo " active in";}?>" id="transport_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/transport_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/transport_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'vehicle'){echo " active in";}?>" id="vehicle">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/transport/vehicle" class="url-link" data-url="<?php echo base_url(); ?>index.php/transport/vehicle"><i class="fa fa-list-ol"></i>All Vehicle</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'route'){echo " active in";}?>" id="route">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/transport/route" class="url-link" data-url="<?php echo base_url(); ?>index.php/transport/route"><i class="fa fa-list-ol"></i>Route</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'member'){echo " active in";}?>" id="member">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/transport/member" class="url-link" data-url="<?php echo base_url(); ?>index.php/transport/member"><i class="fa fa-list-ol"></i>Member</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/transport/member/add" class="url-link" data-url="<?php echo base_url(); ?>index.php/transport/member/add"><i class="fa fa-list-ol"></i>Add Member</a></li>
      </ul>
    </div>
  </div>