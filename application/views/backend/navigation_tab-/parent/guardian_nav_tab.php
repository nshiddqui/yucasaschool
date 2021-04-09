  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'guardian_manage'){echo "active";}?>"><a href="#guardian_manage" class="" role="tab" data-toggle="tab" aria-expanded="true" >Guardian Manage</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
	<div  class="tab-pane fade <?php if ($activeTab == 'guardian_manage'){echo " active in";}?>" id="guardian_manage">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/guardian_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/guardian_list"><i class="fa fa-desktop"></i> Guradian List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/assign_guardian" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/assign_guardian"><i class="fa fa-desktop"></i> Assign Guardian</a></li>
      </ul>
    </div>
  </div>