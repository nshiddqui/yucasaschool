  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'exam_dashboard'){echo "active";}?>"><a href="#exam_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Exam Dasboard</a></li>
        <li class="<?php if ($activeTab == 'manage_marks'){echo "active";}?>"><a href="#manage_marks" class="" role="tab" data-toggle="tab" aria-expanded="true" >Manage Marks</a></li>
        </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'exam_dashboard'){echo " active in";}?>" id="exam_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/exam_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/exam_dashboard"><i class="fa fa-desktop"></i>Dasboard</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'manage_marks'){echo " active in";}?>" id="manage_marks">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/teacher/marks_manage" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/marks_manage"><i class="fa fa-desktop"></i> Marks</a></li>
      </ul>
    </div>
	
  </div>