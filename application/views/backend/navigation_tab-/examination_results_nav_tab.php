  <style>
  #accounting ul li {
    padding-right: 10px;
    padding-left: 10px;
}
  </style>
  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'examination_results_dashboard'){echo "active";}?>"><a href="#examination_results_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Examination & Results</a></li>
        <li class="<?php if ($activeTab == 'exam'){echo "active";}?>"><a href="#exam" class="" role="tab" data-toggle="tab" aria-expanded="true" >Exam</a></li>
        <li class="<?php if ($activeTab == 'online_exam'){echo "active";}?>"><a href="#online_exam" class="" role="tab" data-toggle="tab" aria-expanded="true" >Online Exam</a></li>
        <li class="<?php if ($activeTab == 're_exam_cancellation'){echo "active";}?>"><a href="#re_exam_cancellation" class="" role="tab" data-toggle="tab" aria-expanded="true" >Re-Exam & Cancellation</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'examination_results_dashboard'){echo " active in";}?>" id="examination_results_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/examination_results_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/examination_results_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'exam'){echo " active in";}?>" id="exam">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/exam" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/exam">Exam List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/exam_schedule" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/exam_schedule">Exam Schedule</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/grade" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/grade">Exam Grades</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/marks_manage" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/marks_manage">Manage Marks</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/exam_marks_sms" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/exam_marks_sms">Send Marks By Sms</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/tabulation_sheet" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/tabulation_sheet">Tabulation Sheet</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/question_paper" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/question_paper">Question Paper</a></li>
      </ul>
    </div>
	 <div  class="tab-pane fade <?php if ($activeTab == 'online_exam'){echo " active in";}?>" id="online_exam">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/create_online_exam" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/create_online_exam"><i class="fa fa-list-ol"></i>Create Online Exam</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/manage_online_exam" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/manage_online_exam"><i class="fa fa-list-ol"></i>Manage Online Exam</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/manage_online_exam/expired" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/manage_online_exam/expired"><i class="fa fa-list-ol"></i>Expired Exam</a></li>
      </ul>
    </div>
	<div  class="tab-pane fade <?php if ($activeTab == 're_exam_cancellation'){echo " active in";}?>" id="re_exam_cancellation">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/reexam_and_cancellation" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/reexam_and_cancellation"><i class="fa fa-list-ol"></i>Re-Exam & Cancellation</a></li>
      </ul>
    </div>
  </div>