  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'scholarship_management_dashboard'){echo "active";}?>"><a href="#scholarship_management_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Scholarship Management</a></li>
        <li class="<?php if ($activeTab == 'scholarship'){echo "active";}?>"><a href="#scholarship" class="" role="tab" data-toggle="tab" aria-expanded="true" >Scholarship</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'scholarship_management_dashboard'){echo " active in";}?>" id="scholarship_management_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/scholarship_management_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/scholarship_management_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'scholarship'){echo " active in";}?>" id="scholarship">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/scholarship_exam_student_regsitration" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/scholarship_exam_student_regsitration">Student Registration</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/scholarship_exam_student_information" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/scholarship_exam_student_information">Student Information</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/scholarship_exam_online_create" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/scholarship_exam_online_create">Create Online Exams</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/scholarship_exam_online_manage" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/scholarship_exam_online_manage">Manage Online Exams</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/scholarship_exam_online_manage/expired" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/scholarship_exam_online_manage/expired">Exams Expired</a></li>
      </ul>
    </div>
  </div>