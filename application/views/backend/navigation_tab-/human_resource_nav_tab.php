  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'human_resource_dashboard'){echo "active";}?>"><a href="#human_resource_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Human Resource</a></li>
        <li class="<?php if ($activeTab == 'user_management'){echo "active";}?>"><a href="#user_management" class=""  role="tab" data-toggle="tab" aria-expanded="true">User Management</a></li>
        <li class="<?php if ($activeTab == 'leave_management'){echo "active";}?>"><a href="#leave_management" class=""  role="tab" data-toggle="tab" aria-expanded="true">Leave Management</a></li>
        <li class="<?php if ($activeTab == 'certificate_management'){echo "active";}?>"><a href="#certificate_management" class=""  role="tab" data-toggle="tab" aria-expanded="true">Certificate Management</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'human_resource_dashboard'){echo " active in";}?>" id="human_resource_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/human_resource_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/human_resource_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'user_management'){echo " active in";}?>" id="user_management">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/designation" class="url-link" data-url="<?php echo base_url(); ?>index.php/designation"><i class="fa fa-list-ol"></i>Designation</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/employee" class="url-link" data-url="<?php echo base_url(); ?>index.php/employee"><i class="fa fa-list-ol"></i>Employee</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/librarian" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/librarian"><i class="fa fa-list-ol"></i>Librarian</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/accountant" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/accountant"><i class="fa fa-list-ol"></i>Accountant</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'leave_management'){echo " active in";}?>" id="leave_management">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/leave_requests" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/leave_requests"><i class="fa fa-list-ol"></i>Leave Requests</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/leaves_report" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/leaves_report"><i class="fa fa-list-ol"></i>Leaves Report Student</a></li>
        
        <li><a href="<?php echo base_url(); ?>index.php/admin/leaves_report_employee" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/leaves_report_employee"><i class="fa fa-list-ol"></i>Leaves Report Employee</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'certificate_management'){echo " active in";}?>" id="certificate_management">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/type" class="url-link" data-url="<?php echo base_url(); ?>index.php/type"><i class="fa fa-list-ol"></i>Certificate Type</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/certificate" class="url-link" data-url="<?php echo base_url(); ?>index.php/certificate"><i class="fa fa-list-ol"></i>Certificate</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/certificate/certificate_requests" class="url-link" data-url="<?php echo base_url(); ?>index.php/certificate/certificate_requests"><i class="fa fa-list-ol"></i>Certificate Requests</a></li>
      </ul>
    </div>
  </div>