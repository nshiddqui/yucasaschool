  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'teacher'){echo "active";}?>"><a href="#teacher" class="" role="tab" data-toggle="tab" aria-expanded="true" >Teacher</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'teacher'){echo " active in";}?>" id="teacher">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/teacher_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/teacher_list"><i class="fa fa-desktop"></i> Teacher List</a></li>
      </ul>
    </div>
  </div>