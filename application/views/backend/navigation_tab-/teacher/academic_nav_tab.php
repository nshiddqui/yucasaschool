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
        <li><a href="<?php echo base_url(); ?>index.php/teacher/academic_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/academic_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/academic_syllabus" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/academic_syllabus"><i class="entypo-chart-area"></i> Academic Syllabus</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/assignment/1" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/assignment/1"><i class="entypo-chart-area"></i> Class Assignment</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/teacher_list" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/teacher_list"><i class="entypo-chart-area"></i> All Teacher</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/class_timetable" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/class_timetable"><i class="entypo-chart-area"></i> Time Table</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/teacher/study_material" class="url-link" data-url="<?php echo base_url(); ?>index.php/teacher/study_material"><i class="entypo-chart-area"></i> Study Material</a></li>
      </ul>
    </div>
  </div>