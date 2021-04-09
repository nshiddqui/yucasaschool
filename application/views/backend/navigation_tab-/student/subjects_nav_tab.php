  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'subjects_dashboard'){echo "active";}?>"><a href="#subjects_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Subjects</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'subjects_dashboard'){echo " active in";}?>" id="subjects_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/subject" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/subject"><i class="fa fa-desktop"></i> Subject Information</a></li>
      </ul>
    </div>
  </div>