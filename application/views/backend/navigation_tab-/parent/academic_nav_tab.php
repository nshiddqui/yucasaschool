  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if ($activeTab == 'academic'){echo "active";}?>"><a href="#academic" class="" role="tab" data-toggle="tab" aria-expanded="true" >Academic</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'academic'){echo " active in";}?>" id="academic">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/parents/academic_syllabus/9" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/academic_syllabus/9"><i class="entypo-chart-area"></i> Academic Syllabus</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/assignment/1/9" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/assignment/1/9"><i class="entypo-chart-area"></i> Class Assignment</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/class_timetable" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/class_timetable"><i class="entypo-chart-area"></i> Time Table</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/parents/study_material" class="url-link" data-url="<?php echo base_url(); ?>index.php/parents/study_material"><i class="entypo-chart-area"></i> Study Material</a></li>
      </ul>
    </div>
  </div>