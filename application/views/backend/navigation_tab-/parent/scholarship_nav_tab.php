  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'scholarship_exam'){echo "active";}?>"><a href="#scholarship_exam" class="" role="tab" data-toggle="tab" aria-expanded="true" >Scholarship Exam</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'scholarship_exam'){echo " active in";}?>" id="scholarship_exam">
      <ul class="list-inline ajax-sub-nav">
       <!-- <li><a href="<?php echo base_url(); ?>index.php/parents/scholarship_exam_schedule" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/scholarship_exam_schedule"><i class="entypo-chart-area"></i> Apply for scholarship</a></li>-->
        <li><a href="<?php echo base_url(); ?>index.php/parents/scholarship_exam_schedule" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/scholarship_exam_schedule"><i class="entypo-chart-area"></i> Exam Schedule</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/scholarship_exam_result" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/scholarship_exam_result"><i class="entypo-chart-area"></i> Exam Result</a></li>
      </ul>
    </div>
  </div>