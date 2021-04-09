  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'facilities_dashboard'){echo "active";}?>"><a href="#facilities_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Facilities Dasboard</a></li>
        <li class="<?php if ($activeTab == 'library'){echo "active";}?>"><a href="#library" class=""  role="tab" data-toggle="tab" aria-expanded="true">Library</a></li>
        <li class="<?php if ($activeTab == 'canteen'){echo "active";}?>"><a href="#canteen" class=""  role="tab" data-toggle="tab" aria-expanded="true">Canteen</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'facilities_dashboard'){echo " active in";}?>" id="facilities_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/facilities_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/facilities_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'library'){echo " active in";}?>" id="library">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/book" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/book"><i class="fa fa-list-ol"></i>Book</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/books_bulk_add" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/books_bulk_add"><i class="fa fa-list-ol"></i>Books Bulk Add</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'canteen'){echo " active in";}?>" id="canteen">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/canteen_inventory" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/canteen_inventory"><i class="fa fa-list-ol"></i>Canteen Inventory</a></li>
      </ul>
    </div>
  </div>