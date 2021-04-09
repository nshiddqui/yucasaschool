  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'assets_management_dashboard'){echo "active";}?>"><a href="#assets_management_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Assets Management</a></li>
        <li class="<?php if ($activeTab == 'asset_category'){echo "active";}?>"><a href="#asset_category" class="" role="tab" data-toggle="tab" aria-expanded="true" >Assets Category</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'assets_management_dashboard'){echo " active in";}?>" id="assets_management_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/teacher_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/teacher_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/add_asset" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/add_asset"><i class="entypo-chart-area"></i>Assets list</a></li>
		<!--<li><a href="<?php echo base_url(); ?>index.php/admin/asset_report" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/asset_report"><i class="entypo-chart-area"></i> Assets Report</a></li>-->
		<li><a href="<?php echo base_url(); ?>index.php/admin/add_bulk_asset" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/add_bulk_asset"><i class="entypo-chart-area"></i> Add Bulk Assets</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'asset_category'){echo " active in";}?>" id="asset_category">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/add_asset_category" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/add_asset_category"><i class="fa fa-list-ol"></i>All Category</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/add_bulk_category" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/add_bulk_category"><i class="fa fa-list-ol"></i>Add Bulk Category</a></li>
      </ul>
    </div>
  </div>