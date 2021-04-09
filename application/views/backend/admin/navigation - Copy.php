<div class="sidebar-menu">
    <header class="logo-env" >
        <!-- logo -->
        <div class="container" style="width:80%">
            <div class="row">
                <div class="logo col-md-12" style="">
                    <a href="<?php echo site_url('login'); ?>">
                        <img src="<?php echo base_url('uploads/edurama-logo.png');?>"  style="max-height:70px;width:100%;object-fit:contain;object-position: left;"/>
                    </a>
                </div>
               <!--  <div class="school_logo  col-md-6 p0">
                    <a href="<?php echo base_url();?>/index.php/login">
                        <img src="<?php echo base_url();?>uploads/logo.png" style="max-height:40px; width:100%;object-fit:contain;object-position: center;">
                    </a> 
                </div> -->
            </div>
        </div>

           
        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>
        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
    
    <div style=""></div>
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
        <li id="search">
  				<form class="" action="<?php echo site_url($account_type . '/student_details'); ?>" method="post">
  					<input type="text" class="search-input" name="student_identifier" placeholder="<?php echo get_phrase('student_name').' / '.get_phrase('code').'...'; ?>" value="" required >
  					<button type="submit">
  						<i class="entypo-search"></i>
  					</button>
  				</form>
			  </li>

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/dashboard'); ?>">
                
                <!-- <i class="entypo-gauge"></i> --><i class="s7-graph1"></i> 
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php if ($page_name == 'student_add' ||
                                $page_name == 'student_bulk_add' ||
                                    $page_name == 'student_information' ||
                                        $page_name == 'student_marksheet' ||
                                            $page_name == 'student_promotion' ||
                                            	$page_name == 'student_promotion' ||
                                              		$page_name == 'house_information')
                                                echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('student'); ?></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/student_add'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'student_bulk_add') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/student_bulk_add'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_bulk_student'); ?></span>
                    </a>
                </li>

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_marksheet') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id'] || $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                            <!--<li class="<?php if ($page_name == 'student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">-->
                                <a href="<?php echo site_url('admin/student_information/' . $row['class_id']); ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- STUDENT PROMOTION -->
                <li class="<?php if ($page_name == 'student_promotion') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/student_promotion'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_promotion'); ?></span>
                    </a>
                </li>
                <!-- House Information -->
                <li class="<?php if ($page_name == 'house_information') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/house_information'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('house_information'); ?></span>
                    </a>
                </li>

            </ul>
        </li>

         <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'parent' ||
                                $page_name == 'parent_bulk_add')
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('parent_information'); ?></span>
            </a>
            <ul>

                    <li class="<?php if (($page_name == 'parent')) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/parent'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('Parent_List'); ?></span>
                        </a>
                    </li>

            </ul>
            <ul>

                    <li class="<?php if (( $page_name == 'parent_bulk_add' )) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/parent_bulk_add'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('parent_bulk_add'); ?></span>
                        </a>
                    </li>

            </ul>
        </li>
        <!-- ACCOUNTANT -->


        <!-- Guardian -->
        <li class="<?php if ($page_name == 'guardian') echo 'active'; ?> ">
            <a href="<?php echo site_url('/guardian'); ?>">
                <i class="entypo-user"></i>
                <span><?php echo get_phrase('guardian_list'); ?></span>
            </a>
        </li>
        <!-- TEACHER -->
       <!-- <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/teacher'); ?>">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>-->
		
		
		   <li class="<?php if ($page_name == 'teacher' ||
                                $page_name == 'teacher_manage_attendance_view' || $page_name == 'teacher_attendance_report' || $page_name == 'teacher_manage_attendance')
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('teacher_details'); ?></span>
            </a>
		
		   
		   
		      <ul>

                    <li class="<?php if (($page_name == 'teacher' )) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/teacher'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('teacher'); ?></span>
                        </a>
                    </li>

            </ul>
		   
		   
            <ul>

                    <li class="<?php if (($page_name == 'teacher_manage_attendance' || $page_name == 'teacher_manage_attendance')) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/teacher_manage_attendance'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('teacher_daily_atendance'); ?></span>
                        </a>
                    </li>

            </ul>
            <ul>

                    <li class="<?php if (( $page_name == 'teacher_attendance_report' || $page_name == 'attendance_report_view')) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/teacher_attendance_report'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('teacher_attendance_report'); ?></span>
                        </a>
                    </li>

            </ul>
        </li>
		
		
		
		
        <!-- CLASS -->
        <li class="<?php
        if ($page_name == 'class' ||
                $page_name == 'section' ||
                    $page_name == 'academic_syllabus')
            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-slideshare"></i>
                <span><?php echo get_phrase('class'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/classes'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_classes'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/section'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_sections'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/academic_syllabus'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('academic_syllabus'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/subject/' . $row['class_id']); ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine_view' ||
                                $page_name == 'class_routine_add')
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="fa fa-clock-o"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'class_routine_view' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/class_routine_view/' . $row['class_id']); ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>


        <!-- CLASS ASSIGNMENT -->
        <li class="<?php if ($page_name == 'assignment' ||
                                $page_name == 'assignment')
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="fa fa-file-word-o"></i>
                <span><?php echo get_phrase('class_assignment'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'assignment' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo site_url('assignment/index/' . $row['class_id']); ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>


        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance' ||
                                $page_name == 'manage_attendance_view' || $page_name == 'attendance_report' || $page_name == 'attendance_report_view')
                                    echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('daily_attendance'); ?></span>
            </a>
            <ul>

                    <li class="<?php if (($page_name == 'manage_attendance' || $page_name == 'manage_attendance_view')) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/manage_attendance'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('daily_atendance'); ?></span>
                        </a>
                    </li>

            </ul>
            <ul>

                    <li class="<?php if (( $page_name == 'attendance_report' || $page_name == 'attendance_report_view')) echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/attendance_report'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('attendance_report'); ?></span>
                        </a>
                    </li>

            </ul>
        </li>
        <!-- ACCOUNTANT -->
        <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/accountant'); ?>">
                <i class="entypo-briefcase"></i>
                <span><?php echo get_phrase('accountant'); ?></span>
            </a>
        </li>
        <!-- EXAMS -->
        <li class="<?php
        if ($page_name == 'exam' ||
                $page_name == 'grade' ||
                $page_name == 'exam_schedule' ||
                $page_name == 'marks_manage' ||
                    $page_name == 'exam_marks_sms' ||
                        $page_name == 'tabulation_sheet' ||
                            $page_name == 'marks_manage_view' || $page_name == 'question_paper')
                                echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'exam') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/exam'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'exam_schedule') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/exam_schedule'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_schedule'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/grade'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('exam_grades'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'marks_manage' || $page_name == 'marks_manage_view') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/marks_manage'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'exam_marks_sms') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/exam_marks_sms'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('send_marks_by_sms'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'tabulation_sheet') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/tabulation_sheet'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('tabulation_sheet'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'question_paper') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/question_paper'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('question_paper'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Pre Exam -->
        <li class="<?php
        if ($page_name == 'pre_exam_student_registration' ||
                $page_name == 'pre_exam_student_information' ||
                    $page_name == 'pre_exam_online_create' ||
                        $page_name == 'pre_exam_online_manage')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('pre_exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'pre_exam_student_registration') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/pre_exam_student_registration'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_registration'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pre_exam_student_information' || $page_name == 'student_marksheet') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'pre_exam_student_information' && $class_id == $row['class_id'] || $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                            <!--<li class="<?php if ($page_name == 'pre_exam_student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">-->
                                <a href="<?php echo site_url('admin/pre_exam_student_information/' . $row['class_id']); ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="<?php if ($page_name == 'pre_exam_online_create') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/pre_exam_online_create'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('create_online_exam'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pre_exam_online_manage') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/pre_exam_online_manage'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_online_exam'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- ONLINE EXAMS -->
        <li class="<?php if ($page_name == 'manage_online_exam' || $page_name == 'add_online_exam' || $page_name == 'edit_online_exam' || $page_name == 'manage_online_exam_question' || $page_name == 'update_online_exam_question' || $page_name == 'view_online_exam_results') echo 'opened active'; ?> ">
            <a href="#">
                <i class="fa fa-feed"></i>
                <span><?php echo get_phrase('online_exam'); ?></span>
            </a>
            <ul>
            <li class="<?php if ($page_name == 'add_online_exam') echo 'active'; ?> ">
              <a href="<?php echo site_url($account_type.'/create_online_exam'); ?>">
                  <span><i class="entypo-dot"></i> <?php echo get_phrase('create_online_exam'); ?></span>
              </a>
            </li>

            <li class="<?php if ($page_name == 'manage_online_exam' || $page_name == 'edit_online_exam' || $page_name == 'manage_online_exam_question' || $page_name == 'view_online_exam_results') echo 'active'; ?> ">
                <a href="<?php echo site_url($account_type.'/manage_online_exam'); ?>">
                    <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_online_exam'); ?></span>
                </a>
            </li>
            </ul>
        </li>
        <!-- Re-Eaxm and Cancellation -->
        <li class="<?php if ($page_name == 'reexam_and_cancellation') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/reexam_and_cancellation'); ?>">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('re_exam_and_cancellation'); ?></span>
            </a>
        </li>
        <!-- STUDY MATERIAL -->
            <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
                <a href="<?php echo site_url('admin/study_material'); ?>">
                    <i class="entypo-book-open"></i>
                    <span><?php echo get_phrase('study_material'); ?></span>
                </a>
            </li>

        <!-- PAYMENT -->
        <!-- <li class="<?php //if ($page_name == 'invoice') echo 'active'; ?> ">
            <a href="<?php //echo base_url(); ?>index.php?admin/invoice">
                <i class="entypo-credit-card"></i>
                <span><?php //echo get_phrase('payment'); ?></span>
            </a>
        </li> -->

        <!-- LIBRARY -->
        <li class="<?php
        if ($page_name == 'book' ||
                $page_name == 'books_bulk_add')
                    echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/book'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_books'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'books_bulk_add') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/books_bulk_add'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_bulk_books'); ?></span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- LIBRARIAN -->
        <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/librarian'); ?>">
                <i class="fa fa-book"></i>
                <span><?php echo get_phrase('librarian'); ?></span>
            </a>
        </li>
        <!--  TRANSPORT -->
        <li class="<?php
        if ($page_name == 'member' || 
                $page_name == 'vehicle' ||
                   $page_name == 'route' ||
                      $page_name == 'transport_route')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-bus"></i>
                <span><?php echo get_phrase('transport_management'); ?></span>
            </a>
            <ul>
			  <li class="<?php if ($page_name == 'vehicle') echo 'active'; ?> ">
                    <a href="<?php echo site_url('transport/vehicle'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('vehicle'); ?></span>
                    </a>
                </li>
				 <li class="<?php if ($page_name == 'route') echo 'active'; ?> ">
                    <a href="<?php echo site_url('transport/route'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('route'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'member') echo 'active'; ?> ">
                    <a href="<?php echo site_url('transport/member'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('member'); ?></span>
                    </a>
                </li>
               
              
            </ul>
        </li>
        <!--  Human Resource -->
        <li class="<?php
        if ($page_name == 'designation' || $page_name == 'employee')
                    echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('human_resource'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'designation') echo 'active'; ?> ">
                    <a href="<?php echo site_url('designation'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_designation'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'employee') echo 'active'; ?> ">
                    <a href="<?php echo site_url('employee'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_employee'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Hostel -->
        <li class="<?php
        if ($page_name == 'hostel' ||
                $page_name == 'member' ||
                    $page_name == 'room' || 
                    $page_name =='manage_hostel_attendance'|| 
                    $page_name =='hostel_attendance_report')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-hotel"></i>
                <span><?php echo get_phrase('hostel'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
                    <a href="<?php echo site_url('/hostel'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_hostel'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'member') echo 'active'; ?> ">
                    <a href="<?php echo site_url('/member'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('hostel_member'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'manage_hostel_attendance') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/manage_hostel_attendance'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_hostel_attendance'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'hostel_attendance_report') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/hostel_attendance_report'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('hostel_attendance_report'); ?></span>
                    </a>
                </li>

                
                <li class="<?php if ($page_name == 'room') echo 'active'; ?> ">
                    <a href="<?php echo site_url('/room'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_room'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'roomswitch_request') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/roomswitch_request'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('room_switch_request'); ?></span>
                    </a>
                </li>


            </ul>
        </li>
        <!-- Visitor Info -->
        <li class="<?php if ($page_name == 'visitor') echo 'active'; ?> ">
            <a href="<?php echo site_url('visitor'); ?>">
                <i class="fa fa-male"></i>
                <span><?php echo get_phrase('visitor_info'); ?></span>
            </a>
        </li>
        <!-- Event -->
        <li class="<?php if ($page_name == 'event') echo 'active'; ?> ">
            <a href="<?php echo site_url('event'); ?>">
                <i class="fa fa fa-calendar-check-o"></i>
                <span><?php echo get_phrase('event'); ?></span>
            </a>
        </li>
        <!-- Scholarship Management  -->
        <li class="<?php
        if ($page_name == 'scholarship_exam_student_regsitration' ||
                $page_name == 'scholarship_exam_student_information' ||
                    $page_name == 'scholarship_exam_online_create' ||
                        $page_name == 'scholarship_exam_online_manage')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-trophy"></i>
                <span><?php echo get_phrase('scholarship_management'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'scholarship_exam_student_regsitration') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/scholarship_exam_student_regsitration'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_registration'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'scholarship_exam_student_information') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/scholarship_exam_student_information'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'scholarship_exam_online_create') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/scholarship_exam_online_create'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('create_online_exams'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'scholarship_exam_online_manage') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/scholarship_exam_online_manage'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_online_exams'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- ACCOUNTING -->
        <li class="<?php
        if ($page_name == 'income' ||
                $page_name == 'expense' ||
                    $page_name == 'expense_category' ||
                        $page_name == 'student_payment' ||
                        	$page_name == 'feetype' ||
                        	 	$page_name == 'discount' ||
                                $page_name == 'invoice_add' ||
                        			$page_name == 'manage_invoice')
                            		echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-calculator"></i>
                <span><?php echo get_phrase('accounting'); ?></span>
            </a>
            <ul>

               
                <li class="<?php if ($page_name == 'feetype') echo 'active'; ?> ">
                    <a href="<?php echo site_url('feetype'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('fee_type'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'discount') echo 'active'; ?> ">
                    <a href="<?php echo site_url('discount'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('discount'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                    <a href="<?php echo site_url('invoice'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_invoice'); ?></span>
                    </a>
                </li>
                <!-- <li class="<?php if ($page_name == 'invoice_add') echo 'active'; ?> ">
                    <a href="<?php echo site_url('invoice/add'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('fee_collection'); ?></span>
                    </a>
                </li> -->
                <li class="<?php if ($page_name == 'due_fee') echo 'active'; ?> ">
                    <a href="<?php echo site_url('invoice/due'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('due_fee'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'due_fee_email') echo 'active'; ?> ">
                    <a href="<?php echo site_url('duefeeemail/'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('due_fee_email'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'due_fee_sms') echo 'active'; ?> ">
                    <a href="<?php echo site_url('duefeesms/'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('due_fee_sms'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'income_head') echo 'active'; ?> ">
                    <a href="<?php echo site_url('incomehead/'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('income_head'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'income') echo 'active'; ?> ">
                    <a href="<?php echo site_url('income'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('income'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expenditure_head') echo 'active'; ?> ">
                    <a href="<?php echo site_url('exphead/'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expenditure_head'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'expenditure') echo 'active'; ?> ">
                    <a href="<?php echo site_url('expenditure/'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('expenditure'); ?></span>
                    </a>
                </li>
                
            </ul>
        </li>
        <!-- Payroll Management  -->
        <li class="<?php
        if ($page_name == 'payroll_payment' ||
                $page_name == 'payroll_grade' ||
                    $page_name == 'payroll_history')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-dollar"></i>
                <span><?php echo get_phrase('payroll'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'payroll_payment') echo 'active'; ?> ">
                    <a href="<?php echo site_url('payroll/payment'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('payment'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'payroll_grade') echo 'active'; ?> ">
                    <a href="<?php echo site_url('payroll/grade'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('grade'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'payroll_history') echo 'active'; ?> ">
                    <a href="<?php echo site_url('payroll/history'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('history'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Canteen Management  -->
        <li class="<?php
        if ($page_name == 'canteen_card_recharge' ||
                    $page_name == 'canteen_inventory')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-archive"></i>
                <span><?php echo get_phrase('canteen_management'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'canteen_card_recharge') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/canteen_card_recharge'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('card_recharge'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'canteen_inventory') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/canteen_inventory'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('canteen_inventory'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Leave Management -->
        <li class="<?php
        if ($page_name == 'leave_requests' ||
                    $page_name == 'leaves_report')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-pencil"></i>
                <span><?php echo get_phrase('leave_management'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'leave_requests') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/leave_requests'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('leave_requests'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'leaves_report') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/leaves_report'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('leaves_report'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Asset Management  -->
        <li class="<?php
        if ($page_name == 'add_asset_category' ||
                $page_name == 'add_asset' ||
                    $page_name == 'asset_report')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-home"></i>
                <span><?php echo get_phrase('asset_management'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'add_asset_category') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/add_asset_category'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('asset_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'add_asset') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/add_asset'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('add_asset'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'asset_report') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/asset_report'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('asset_report'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!--Certificate -->
        <li class="<?php
        if ($page_name == 'certificate' ||
                $page_name == 'certificate_type')
                            echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-doc-text"></i>
                <span><?php echo get_phrase('certificate_management'); ?></span>
            </a>
            <ul>
               
                <li class="<?php if ($page_name == 'certificate_type') echo 'active'; ?> ">
                    <a href="<?php echo site_url('/type'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('certificate_type'); ?></span>
                    </a>
                </li>

                 <li class="<?php if ($page_name == 'certificate') echo 'active'; ?> ">
                    <a href="<?php echo site_url('certificate'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('generate_certificate'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'certificate') echo 'active'; ?> ">
                    <a href="<?php echo site_url('certificate/certificate_requests'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('certificate_requests'); ?></span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard' || $page_name == 'noticeboard_edit') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/noticeboard'); ?>">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message' || $page_name == 'group_message') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/message'); ?>">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>
        <!--  Administrator  -->
        <li class="<?php
            if ($page_name == 'book' || $page_name == 'books_bulk_add')
                            echo 'opened active';
                ?> ">
            <a href="#">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('Administrator'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'year') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/year'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase(' Academic Year'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'role') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/role'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase(' User Role (ACL)'); ?></span>
                    </a>
                </li>
               <!--  <li class="<?php if ($page_name == 'permission') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/permission'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Role Permission (ACL)'); ?></span>
                    </a>
                </li> -->
               <!--  <li class="<?php if ($page_name == 'user') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/user'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Manage User'); ?></span>
                    </a>
                </li> -->
                <li class="<?php if ($page_name == 'password') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/password'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Reset User Password'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'email') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/email'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Reset User Email'); ?></span>
                    </a>
                </li>
                <!-- <li class="<?php if ($page_name == 'backup') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/backup'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Backup'); ?></span>
                    </a>
                </li> -->
                <li class="<?php if ($page_name == 'emailtemplate') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/emailtemplate'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Email Template'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'smstemplate') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/smstemplate'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('SMS Template'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'activitylog') echo 'active'; ?> ">
                    <a href="<?php echo site_url('administrator/activitylog'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Activity Log'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ||
              $page_name == 'manage_language' ||
                $page_name == 'sms_settings'||
                  $page_name == 'payment_settings')
                    echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-cog"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/system_settings'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/sms_settings'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/manage_language'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'payment_settings') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/payment_settings'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('payment_settings'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'theme') echo 'active'; ?> ">
                    <a href="<?php echo site_url('theme'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('theme'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- FRONTEND SETTINGS -->
        <li class="<?php
        if ($page_name == 'frontend_pages' ||
                $page_name == 'frontend_themes')
                    echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-monitor"></i>
                <span><?php echo get_phrase('frontend'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'frontend_pages') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/frontend_pages'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('pages'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'frontend_themes') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/frontend_themes'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('themes'); ?></span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="">
            <a href="#" onclick="login_form();">
                <i class="entypo-monitor"></i>
                <span><?php echo get_phrase('pos'); ?></span>
            </a>
            <form action="http://desktop-22kuple/edurama_pos_full/edurama_pos/user/checklogin" id="myForm" method="POST">
                <input type="hidden" class="form-control form-control-lg input-lg" name="username" placeholder="Your Email" value="aftab@cyberworx.in">
                <input type="hidden" class="form-control form-control-lg input-lg" name="password" placeholder="Your Password" value="Admin@123">
            </form>
         </li>
    </ul>

</div>
<script type="text/javascript">
    function login_form(){
        document.getElementById("myForm").submit();
    }
</script>
