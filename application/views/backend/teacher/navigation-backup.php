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
        <li class="<?php if ($page_name == 'teacher_dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('teacher/teacher_dashboard'); ?>">
                
                <!-- <i class="entypo-gauge"></i> --><i class="fa fa-users"></i> 
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>
		
        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'student_dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('teacher/student_dashboard'); ?>">
                
                <!-- <i class="entypo-gauge"></i> --><i class="fa fa-user"></i> 
                <span><?php echo get_phrase('student'); ?></span>
            </a>
        </li>
		
		<!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'exam_dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('teacher/exam_dashboard'); ?>">
                
                <!-- <i class="entypo-gauge"></i> --><i class="fa fa-graduation-cap"></i> 
                <span><?php echo get_phrase('exam'); ?></span>
            </a>
        </li>
		
		<!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'academic_dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('teacher/academic_dashboard'); ?>">
                
                <!-- <i class="entypo-gauge"></i> --><i class="fa fa-graduation-cap"></i> 
                <span><?php echo get_phrase('academics'); ?></span>
            </a>
        </li>
        
		<!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'extra_curricular_dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('teacher/extra_curricular_dashboard'); ?>">
                
                <!-- <i class="entypo-gauge"></i> --><i class="fa fa-paper-plane-o"></i> 
                <span><?php echo get_phrase('extra_curricular'); ?></span>
            </a>
        </li>
		
		<!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'facilities_dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('teacher/facilities_dashboard'); ?>">
                
                <!-- <i class="entypo-gauge"></i> --><i class="fa fa-cutlery"></i> 
                <span><?php echo get_phrase('facilities'); ?></span>
            </a>
        </li>
		
		<!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'message_dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('teacher/message_dashboard'); ?>">
                
                <!-- <i class="entypo-gauge"></i> --><i class="fa fa-cutlery"></i> 
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

    </ul>

</div>
