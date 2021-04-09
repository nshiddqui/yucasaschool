  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">

        <li class="<?php if ($activeTab == 'admission_dashboard'){echo "active";}?>"><a href="#admission_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Admission Dasboard</a></li>

        <li class="<?php if ($activeTab == 'student'){echo "active";}?>"><a href="#student" class=""  role="tab" data-toggle="tab" aria-expanded="true">Student</a></li>

        <li class="<?php if ($activeTab == 'pre_exam'){echo "active";}?>"><a href="#pre_exam" class="" role="tab" data-toggle="tab" aria-expanded="true">Pre Exam</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'admission_dashboard'){echo " active in";}?>" id="admission_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/admission_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/admission_dashboard"><i class="fa fa-desktop"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'student'){echo " active in";}?>" id="student">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/student_add" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/student_add"><i class="fa fa-user-plus"></i> Admit Student</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/student_bulk_add" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/student_bulk_add"><i class="fa fa-users"></i> Admit Bulk Student</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'pre_exam'){echo " active in";}?>" id="pre_exam">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/pre_exam_student_registration" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/pre_exam_student_registration"><i class="fa fa-pencil-square-o"></i> Student Registration</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/pre_exam_student_information" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/pre_exam_student_information"><i class="fa fa-info"></i> Student Information</a></li>
        <!--<li><a href="<?php echo base_url(); ?>index.php/admin/pre_exam_online_create" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/pre_exam_online_create"><i class="fa fa-clone"></i> Create Online Exam</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/pre_exam_online_manage" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/pre_exam_online_manage"><i class="fa fa-wrench"></i> Manage Online Exam</a></li>-->
        <li><a href="https://www.edurama.in/unityerp/index.php/admission/registration" target_blank class="url-link" data-url="https://www.edurama.in/unityerp/index.php/admission/registration"><i class="fa fa-wrench"></i> Pre Student Form</a></li>
      </ul>
    </div>
  </div>