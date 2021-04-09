  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'scholarship_dashboard'){echo "active";}?>"><a href="#scholarship_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Scholarships</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'scholarship_dashboard'){echo " active in";}?>" id="scholarship_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/scholarship_exam_schedule" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/scholarship_exam_schedule"><i class="entypo-chart-area"></i> Apply for scholarship</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/student/scholarship_exam_online" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/scholarship_exam_online"><i class="entypo-chart-area"></i> Exam Schedule</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/student/scholarship_exam_result" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/scholarship_exam_result"><i class="entypo-chart-area"></i> Exam marks</a></li>
      </ul>
    </div>
  </div>