  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'academic_dashboard'){echo "active";}?>"><a href="#academic_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Academic Dasboard</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'academic_dashboard'){echo " active in";}?>" id="academic_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/student/academic_syllabus/9" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/academic_syllabus/9"><i class="entypo-chart-area"></i> Academic Syllabus</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/student/assignment/1/9" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/assignment/1/9"><i class="entypo-chart-area"></i> Class Assignment</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/student/teacher_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/teacher_list"><i class="entypo-chart-area"></i> All Teacher</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/student/class_timetable" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/class_timetable"><i class="entypo-chart-area"></i> Time Table</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/student/study_material" class="url-link" data-url="<?php echo base_url(); ?>index.php/student/study_material"><i class="entypo-chart-area"></i> Study Material</a></li>
      </ul>
    </div>
  </div>