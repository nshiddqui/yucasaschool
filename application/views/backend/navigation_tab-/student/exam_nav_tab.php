  
  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'exam_schedule'){echo "active";}?>"><a href="#exam_schedule" class="" role="tab" data-toggle="tab" aria-expanded="true" >Exam Schedule</a></li>
        <li class="<?php if ($activeTab == 'exam_marks'){echo "active";}?>"><a href="#exam_marks" class="" role="tab" data-toggle="tab" aria-expanded="true" >Exam Marks</a></li>
        <li class="<?php if ($activeTab == 'online_exam'){echo "active";}?>"><a href="#online_exam" class="" role="tab" data-toggle="tab" aria-expanded="true" >Online Exam</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    
	<div  class="tab-pane fade <?php if ($activeTab == 'exam_schedule'){echo " active in";}?>" id="exam_schedule">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/exam_schedule" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/exam_schedule"><i class="fa fa-desktop"></i> Exam Schedule</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'exam_marks'){echo " active in";}?>" id="exam_marks">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/student_marksheet/<?php echo $this->session->userdata('login_user_id');?>" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/student_marksheet/9"><i class="fa fa-desktop"></i> Exam Marks</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 'online_exam'){echo " active in";}?>" id="online_exam">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/online_exam" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/online_exam"><i class="fa fa-desktop"></i> Online Exam</a></li>
      </ul>
    </div>
  </div>