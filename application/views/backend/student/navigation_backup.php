<div class="sidebar-menu">
    <header class="logo-env" >
        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>uploads/edurama-logo.png"  style="max-height:60px;"/>
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

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/dashboard'); ?>">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>



        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/teacher_list'); ?>">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>



        <!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo ' active'; ?> ">
            <a href="<?php echo site_url($account_type.'/subject'); ?>">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
        </li>

        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/class_routine'); ?>">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
        </li>

        <!-- Attendance -->
        <li class="<?php if ($page_name == 'manage_attendace') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/manage_attendace'); ?>">
                <i class="fa fa-line-chart"></i>
                <span><?php echo get_phrase('attendance'); ?></span>
            </a>
        </li>
		
		     <!-- CLASS ASSIGNMENT -->
        <li class="<?php if ($page_name == 'assignment' ||
                                $page_name == 'assignment')
                                    echo 'opened active'; ?> ">
			 <?php
				 $children_of_parent = @$this->db->get_where('enroll' , array(
                    'student_id' => $this->session->userdata('student_id')
                ))->row();
                $class_id_n=@$children_of_parent->class_id;
                ?>
              
               
            <a href="<?php echo site_url('student/assignment/' .$class_id_n.'/'.$this->session->userdata('student_id')); ?>">
                <i class="fa fa-file-word-o"></i>
                <span><?php echo get_phrase('class_assignment'); ?></span>
            </a>
			
           <!-- <ul>

                    <li class="<?php if ($page_name == 'assignment' && $class_id == $row['class_id']) echo 'active'; ?>">
                        <a href="<?php echo site_url('student/assignment/' . $row['class_id']); ?>">
                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                        </a>
                    </li>
               
            </ul>-->
        </li>

		
		    <!-- Card block  -->
        <li class="<?php if ($page_name == 'rf_id_card_block' || $page_name == 'rf_id_card_block') echo 'opened active';?> ">
            <a href="<?php echo site_url($account_type.'/rf_id_card_block'); ?>">
                <i class="entypo-vcard"></i>
                <span>RFID Card Block</span>
            </a>
         
        </li>
		
		
        <!-- Leave Management -->
        <li class="<?php if ($page_name == 'student_leave_request' || $page_name == 'student_leaves_report') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-pencil"></i>
                <span><?php echo get_phrase('leave_management'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'student_leave_request') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/student_leave_request'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('leave_request'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'student_leaves_report') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/student_leaves_report'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('leaves_report'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
		<!-- STUDY MATERIAL -->
        <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/study_material'); ?>">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('study_material'); ?></span>
            </a>
        </li>

        <!-- ACADEMIC SYLLABUS -->
        <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/academic_syllabus/'.$this->session->userdata('login_user_id')); ?>">
                <i class="entypo-doc"></i>
                <span><?php echo get_phrase('academic_syllabus'); ?></span>
            </a>
        </li>
        <!-- Canteen -->
        <li class="<?php if ($page_name == 'card_recharge') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/card_recharge'); ?>">
                <i class="entypo-archive"></i>
                <span><?php echo get_phrase('Canteen'); ?></span>
            </a>
        </li>
        <!-- Exam marks -->
<!--         <li class="<?php if ($page_name == 'student_marksheet') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/student_marksheet/'.$this->session->userdata('login_user_id')); ?>">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exam_marks'); ?></span>
            </a>
        </li> -->

        <li class="<?php if ($page_name == 'online_exam' || $page_name == 'online_exam_take') echo 'active'; ?> ">
            <a href="<?php echo site_url('student/online_exam');?>">
                <i class="fa fa-feed"></i>
                <span><?php echo get_phrase('online_exam'); ?></span>
            </a>
        </li>

        <!-- PAYMENT -->
        <!--<li class="<?php if ($page_name == 'invoice' || $page_name == 'pay_with_payumoney') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/invoice'); ?>">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('payment'); ?></span>
            </a>
        </li>-->

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
        <!-- Exam -->
        <li class="<?php if ($page_name == 'exam_schedule' || $page_name == 'exam_result' || $page_name == 'exam_answer_sheet') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'exam_schedule') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/exam_schedule'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('exam_schedule'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'student_marksheet') echo 'active'; ?> ">
                   <a href="<?php echo site_url($account_type.'/student_marksheet/'.$this->session->userdata('login_user_id')); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('exam_result'); ?></span>
                    </a>
                </li>
               <!--  <li class="<?php if ($page_name == 'exam_answer_sheet') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/exam_answer_sheet'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('answer_sheet'); ?></span>
                    </a>
                </li> -->
            </ul>
        </li>
        <!-- Re-Exam -->
        <li class="<?php if ($page_name == 're_exam_schedule' || $page_name == 're_exam_result' || $page_name == 're_exam_answer_sheet') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('re_exam_and_cancellation'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 're_exam_schedule') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/re_exam_schedule'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('re_exam_schedule'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
            
        <!-- Certificate Management -->
        <li class="<?php if ($page_name == 'view_all_certificates' || $page_name == 'apply_for_certificates') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-doc-text"></i>
                <span><?php echo get_phrase('Certificate'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'view_all_certificates') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/view_all_certificates'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('view_all_certificates'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'apply_for_certificates') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/apply_for_certificates'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('apply_for_certificates'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Scholarship Admission -->
        <li class="<?php if ($page_name == 'scholarship_exam_schedule' || $page_name == 'scholarship_exam_online' || $page_name == 'scholarship_exam_result' || $page_name == 'scholarship_exam_answer_sheet') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-trophy"></i>
                <span><?php echo get_phrase('scholarship_admission'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'scholarship_exam_schedule') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/scholarship_exam_schedule'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('exam_schedule'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'scholarship_exam_online') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/scholarship_exam_online'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('online_exams'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'scholarship_exam_result') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/scholarship_exam_result'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('exams_result'); ?></span>
                    </a>
                </li>
                <!-- <li class="<?php if ($page_name == 'scholarship_exam_answer_sheet') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/scholarship_exam_answer_sheet'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('answer_sheet'); ?></span>
                    </a>
                </li> -->
            </ul>
        </li>
        <!-- Pre Admission -->
        <!-- <li class="<?php if ($page_name == 'pre_admission_exam_schedule' || $page_name == 'pre_admission_student_registraion' || $page_name == 'pre_admission_admit_card' || $page_name == 'pre_admission_online_exam' || $page_name == 'pre_admission_exam_result' || $page_name == 'pre_admission_exam_answer_sheet') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-arrows-ccw"></i>
                <span><?php echo get_phrase('pre_admission'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'pre_admission_exam_schedule') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/pre_admission_exam_schedule'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('exam_schedule'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pre_admission_student_registraion') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/pre_admission_student_registraion'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('student_registration'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pre_admission_admit_card') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/pre_admission_admit_card'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('admit_card'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pre_admission_online_exam') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/pre_admission_online_exam'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('online_exam'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pre_admission_exam_result') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/pre_admission_exam_result'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('exam_result'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pre_admission_exam_answer_sheet') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/pre_admission_exam_answer_sheet'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('answer_sheet'); ?></span>
                    </a>
                </li>
            </ul>
        </li> -->
       
        <!-- Dormitory -->
        <li class="<?php if ($page_name == 'student_roomchange_request' || $page_name == 'attendance_report' || $page_name == 'visitors_list' || $page_name == 'manage_hostel_attendace') echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-home"></i>
                <span><?php echo get_phrase('Dormitory'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'student_roomchange_request') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/student_roomchange_request'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('room_change_request'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_hostel_attendace') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/manage_hostel_attendace'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('manage_hostel_attendace'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'visitors_list') echo 'active'; ?> ">
                    <a href="<?php echo site_url($account_type.'/visitors_list'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('visitors_list'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- TRANSPORT -->
        <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/transport'); ?>">
                <i class="entypo-location"></i>
                <span><?php echo get_phrase('transport'); ?></span>
            </a>
        </li>

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

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo site_url($account_type.'/manage_profile'); ?>">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
