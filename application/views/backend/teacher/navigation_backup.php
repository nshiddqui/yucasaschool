<div class="sidebar-menu">
    <header class="logo-env">

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>uploads/edurama-logo.png" style="max-height:90px;"/>
            </a>
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
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <li id="search">
  				<form class="" action="<?php echo site_url($account_type.'/student_details') ?>" method="post">
  					<input type="text" class="search-input" name="student_identifier" placeholder="<?php echo get_phrase('student_name').' / '.get_phrase('code').' ...'; ?>" value="" required style="font-family: 'Poppins', sans-serif !important; background-color: #2C2E3E !important; color: #868AA8; border-bottom: 1px solid #3F3E5F;">
  					<button type="submit">
  						<i class="entypo-search"></i>
  					</button>
  				</form>
			  </li>

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/dashboard'); ?>">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_add' ||
            $page_name == 'student_information' ||
            $page_name == 'student_marksheet')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('student'); ?></span>
            </a>
            <ul>

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_marksheet' || $page_name == 'student_profile') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                    <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo site_url($account_type.'/student_information/'.$row['class_id']); ?>">
                                    <span><?php echo get_phrase('class'); ?><?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

            </ul>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/teacher_list'); ?>">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>


        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
            <ul>
                <?php $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo site_url($account_type.'/subject/'.$row['class_id']); ?>">
                            <span><?php echo get_phrase('class'); ?><?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine' ||
            $page_name == 'class_routine_print_view')
            echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if ($page_name == 'class_routine' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo site_url($account_type.'/class_routine/'.$row['class_id']); ?>">
                            <span><?php echo get_phrase('class'); ?><?php echo $row['name']; ?></span>
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
                        <a href="<?php echo site_url('teacher/assignment/' . $row['class_id']); ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <!-- Leave Management  -->
        <li class="<?php if ($page_name == 'teacher_leave_request' || $page_name == 'teacher_leaves_past_record' || $page_name == 'student_leave_record' || $page_name == 'student_leave_schedule') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-pencil"></i>
                <span><?php echo get_phrase('leave_management'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'teacher_leave_request') echo 'active'; ?> ">
                    <a href="<?php echo site_url('teacher/teacher_leave_request'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('leave_request'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'teacher_leaves_past_record') echo 'active'; ?> ">
                    <a href="<?php echo site_url('teacher/teacher_leaves_past_record'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('leaves_past_record'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'student_leave_record') echo 'active'; ?> ">
                    <a href="<?php echo site_url('teacher/student_leave_record'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('student_leave_record'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'student_leave_schedule') echo 'active'; ?> ">
                    <a href="<?php echo site_url('teacher/student_leave_schedule'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('student_leave_schedule'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Dormitory  -->
        <!-- <li class="<?php if ($page_name == 'room_change_request' || $page_name == 'teacher_attendance_report' || $page_name == 'visitors_list') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-home"></i>
                <span><?php echo get_phrase('dormitory'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'room_change_request') echo 'active'; ?> ">
                    <a href="<?php echo site_url('teacher/room_change_request'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('room_change_request'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'teacher_attendance_report') echo 'active'; ?> ">
                    <a href="<?php echo site_url('teacher/teacher_attendance_report'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('attendance_report'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'visitors_list') echo 'active'; ?> ">
                    <a href="<?php echo site_url('teacher/visitors_list'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('visitors_list'); ?></span>
                    </a>
                </li>
            </ul>
        </li> -->
        <!-- Canteen -->
        <!-- <li class="<?php //if ($page_name == 'card_recharge') echo 'active'; ?> ">
            <a href="<?php //echo site_url('teacher/card_recharge'); ?>">
                <i class="entypo-archive"></i>
                <span><?php //echo get_phrase('canteen'); ?></span>
            </a>
        </li> -->
        <!-- Tearcher Daily Attendance  -->
        <!-- <li class="<?php //if ($page_name == 'all_teacher_attendance') echo 'active'; ?> ">
            <a href="<?php //echo site_url('teacher/all_teacher_attendance'); ?>">
                <i class="entypo-chart-area"></i>
                <span><?php //echo get_phrase('teacher_daily_attendance'); ?></span>
            </a>
        </li> -->
        <!-- STUDY MATERIAL -->
        <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/study_material'); ?>">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('study_material'); ?></span>
            </a>
        </li>
        <!-- ACADEMIC SYLLABUS -->
        <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/academic_syllabus'); ?>">
                <i class="entypo-doc"></i>
                <span><?php echo get_phrase('academic_syllabus'); ?></span>
            </a>
        </li>

        <!-- DAILY ATTENDANCE -->
       <!-- <li class="<?php if ($page_name == 'manage_attendance' ||
            $page_name == 'manage_attendance_view')
            echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('daily_attendance'); ?></span>
            </a>
            <ul>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li class="<?php if (($page_name == 'manage_attendance' || $page_name == 'manage_attendance_view') && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo site_url($account_type.'/manage_attendance/'.$row['class_id']); ?>">
                            <span><?php echo get_phrase('class'); ?><?php echo $row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>-->
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
                        <a href="<?php echo site_url('teacher/manage_attendance'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('daily_atendance'); ?></span>
                        </a>
                    </li>

            </ul>
            <ul>

                    <li class="<?php if (( $page_name == 'attendance_report' || $page_name == 'attendance_report_view')) echo 'active'; ?>">
                        <a href="<?php echo site_url('teacher/attendance_report'); ?>">
                            <span><i class="entypo-dot"></i><?php echo get_phrase('attendance_report'); ?></span>
                        </a>
                    </li>

            </ul>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'manage_attendance_rfid') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/manage_attendance_rfid'); ?>">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('daily_attendance_rfid'); ?></span>
            </a>
        </li>


        <!-- EXAMS -->
        <li class="<?php if ($page_name == 'marks_manage' || $page_name == 'marks_manage_view' || $page_name == 'question_paper') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'marks_manage' || $page_name == 'marks_manage_view') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/marks_manage'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'question_paper') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/question_paper'); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('question_paper'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Re-Exam -->
        <li class="<?php if ($page_name == 'create_re_exam') echo 'active'; ?> ">
            <a href="<?php echo site_url('teacher/create_re_exam'); ?>">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('re_exam'); ?></span>
            </a>
        </li>
        <!-- LIBRARY -->
        <li class="<?php if ($page_name == 'book' || $page_name == 'book_request') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/book'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('book_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'book_request') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/book_request'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('my_book_requests'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- TRANSPORT -->
        <!-- <li class="<?php //if ($page_name == 'transport') echo 'active'; ?> ">
            <a href="<?php //echo site_url($account_type.'/transport'); ?>">
                <i class="entypo-location"></i>
                <span><?php //echo get_phrase('transport'); ?></span>
            </a>
        </li> -->

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/noticeboard'); ?>">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message' || $page_name == 'group_message') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/message'); ?>">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>
        <!-- Salary Dashboard  -->
        <li class="<?php if ($page_name == 'salary_details' || $page_name == 'salary_deduction' || $page_name == 'salary_payslips') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('salary_dashboard'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'salary_details') echo 'active'; ?> ">
                    <a href="<?php echo site_url('teacher/salary_details'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('salary_details'); ?></span>
                    </a>
                </li>
              <!--   <li class="<?php //if ($page_name == 'salary_deduction') echo 'active'; ?> ">
                    <a href="<?php //echo site_url('teacher/salary_deduction'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php //echo get_phrase('salary_deduction'); ?></span>
                    </a>
                </li>
                <li class="<?php //if ($page_name == 'salary_payslips') echo 'active'; ?> ">
                    <a href="<?php //echo site_url('teacher/salary_payslips'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php //echo get_phrase('salary_payslips'); ?></span>
                    </a>
                </li> -->
            </ul>
        </li>
        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/manage_profile'); ?>">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
