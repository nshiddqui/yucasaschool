  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'exam_schedule'){echo "active";}?>"><a href="#exam_schedule" class="" role="tab" data-toggle="tab" aria-expanded="true" >Exam Schedule</a></li>
        <li class="<?php if ($activeTab == 'exam_marks'){echo "active";}?>"><a href="#exam_marks" class="" role="tab" data-toggle="tab" aria-expanded="true" >Exam Result</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    
	<div  class="tab-pane fade <?php if ($activeTab == 'exam_schedule'){echo " active in";}?>" id="exam_schedule">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/exam_schedule" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/exam_schedule"><i class="fa fa-desktop"></i> Exam Schedule</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'exam_marks'){echo " active in";}?>" id="exam_marks">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/exam_result" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/exam_result"><i class="fa fa-desktop"></i> Exam Result</a></li>
      </ul>
    </div>
  </div>