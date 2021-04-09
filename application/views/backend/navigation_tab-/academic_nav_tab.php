 <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        <li class="<?php if($activeTab == 'academic_dashboard'){echo "active";}?>"><a href="#academic_dashboard" class="" role="tab" data-toggle="tab" aria-expanded="true" >Academic Dasboard</a></li>
        <li class="<?php if($activeTab == 'classess'){echo "active";}?>"><a href="#classess" class=""  role="tab" data-toggle="tab" aria-expanded="true">Manage Classes</a></li>
        <li class="<?php if($activeTab == 'class_routine'){echo "active";}?>"><a href="#class_routine" class=""  role="tab" data-toggle="tab" aria-expanded="true">Class routine</a></li>
        <li class="<?php if($activeTab == 'syllabus'){echo "active";}?>"><a href="#syllabus" class="" role="tab" data-toggle="tab" aria-expanded="true">Syllabus</a></li>
        <li class="<?php if($activeTab == 'subjects'){echo "active";}?>"><a href="#subjects" class="" role="tab" data-toggle="tab" aria-expanded="true">Subjects</a></li>
        <li class="<?php if($activeTab == 'assignments'){echo "active";}?>"><a href="#assignments" class="" role="tab" data-toggle="tab" aria-expanded="true">Homework</a></li>
        <li class="<?php if($activeTab == 'study_material'){echo "active";}?>"><a href="#study_material" class="" role="tab" data-toggle="tab" aria-expanded="true">Study Material</a></li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div  class="tab-pane fade <?php if ($activeTab == 'academic_dashboard'){echo " active in";}?>" id="academic_dashboard">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/academic_dashboard" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/academic_dashboard"><i class="entypo-chart-area"></i> Dashboard</a></li>
      </ul>
    </div>

    <div  class="tab-pane fade <?php if ($activeTab == 'classess'){echo " active in";}?>" id="classess">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/classes" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/classes"><i class="entypo-chart-area"></i> Manage Classess</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/section" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/section"><i class="entypo-chart-area"></i> Manage Section</a></li>
      </ul>
    </div>

    <div  class="tab-pane fade <?php if ($activeTab == 'class_routine'){echo " active in";}?>" id="class_routine">
      <ul class="list-inline ajax-sub-nav">
      <li><a href="<?php echo base_url(); ?>index.php/admin/timetable_template" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/class_timetable"><i class="entypo-chart-area"></i> Timetable Template</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/class_timetable" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/class_timetable"><i class="entypo-chart-area"></i> Class Routine</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/class_dailytimetable" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/class_timetable"><i class="entypo-chart-area"></i> Daily Routine</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'syllabus'){echo " active in";}?>" id="syllabus">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/academic_syllabus" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/academic_syllabus"><i class="entypo-chart-area"></i> Syllabus</a></li>
        <!-- <li><a href="<?php echo base_url(); ?>index.php/admin/syllabus_timeline" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/syllabus_timeline"><i class="entypo-chart-area"></i> Syllabus Timeline</a></li> -->
      </ul>
    </div>

    <div  class="tab-pane fade <?php if ($activeTab == 'subjects'){echo " active in";}?>" id="subjects">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/subject" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/subject"><i class="fa fa-list-ol"></i>Subjects</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/admin/co_scholastic_subject" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/co_scholastic_subject"><i class="fa fa-list-ol"></i>Scholastic Subject</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'assignments'){echo " active in";}?>" id="assignments">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/assignment/index/1" class="url-link" data-url="<?php echo base_url(); ?>index.php/assignment/index/1"><i class="fa fa-list-ol"></i>Homework List</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/assignment/add_assignment" class="url-link" data-url="<?php echo base_url(); ?>index.php/assignment/add_assignment"><i class="fa fa-list-ol"></i>Add Homework</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/assignment/view_assignment" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/assignment/view_assignment"><i class="fa fa-list-ol"></i>View Homeworks</a></li>
      <li><a href="<?php echo base_url(); ?>index.php/assignment/add_indiv_assignment" class="url-link" data-url="<?php echo base_url(); ?>index.php/assignment/add_indiv_assignment"><i class="fa fa-list-ol"></i>Add Individual Homework</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/assignment/view_indiv_assignment" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/assignment/view_indiv_assignment"><i class="fa fa-list-ol"></i>View Individual Homeworks</a></li>
      </ul>
    </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'study_material'){echo " active in";}?>" id="study_material">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/study_material" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/study_material"><i class="fa fa-list-ol"></i>Study Material</a></li>
      </ul>
    </div>
  </div>