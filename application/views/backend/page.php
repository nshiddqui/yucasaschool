<!-- SYSTEM SETTINGS  -->
<?php
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title       =	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	$text_align         =	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;
	$account_type       =	$this->session->userdata('login_type');
	$skin_colour        =   $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description;
	$active_sms_service =   $this->db->get_where('settings' , array('type'=>'active_sms_service'))->row()->description;
    $running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
?>
 <!-- SYSTEM SETTINGS END HERE -->


<!-- MAIN HTML STARTS FROM HERE -->
<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl';?>">
	<!-- HEAD SECTION -->
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo $page_title;?> | <?php echo $system_name;?></title>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="Ekattor School Manager Pro - Creativeitem" />
		<meta name="author" content="Creativeitem" />
		<!-- TOP CSS JS INCLUDE -->
		<?php include 'includes_top.php';?>
		<!-- TOP CSS JS INCLUDE -->
	</head>
	<!-- HEAD SECTION -->
	<!-- BODY STARTS HERE -->
<body class="style-light page-body <?php if ($skin_colour != '') echo 'skin-' . $skin_colour;?>" >

	<div class="page-container <?php if ($text_align == 'right-to-left') echo 'right-sidebar';?>
		<?php if($page_name == 'attendance_report_view') echo 'sidebar-collapsed';?>" >

		<!-- SIDEBAR -->
		<?php
		if(empty($this->session->userdata('role_id'))){
		    redirect('/login','refresh');
		}
		
		?>
		<?php 
		if($this->session->userdata('student_login') == 1){
	        include 'student/navigation.php';
	    } else if($this->session->userdata('parent_login') == 1){
	        include 'parent/navigation.php';
	    } else {
	        include 'navigation.php';
	    }
		?>
		<!-- SIDEBAR -->

		<!-- MAIN CONTENT -->
		<div class="main-content">
            
    		<!-- HEADER INCLUDE -->
			<?php include 'header.php';?>
			<!-- HEADER INCLUDE -->
            <div class="col-sm-12">
        			<!-- PAGE INCLUDE -->
        			<?php include $folder.'/'.$page_name.'.php';?>
        			<!-- PAGE INCLUDE -->
        				</div>
        
        			<!-- BOTTOM BLOCK INCLUDE -->
        			<?php include 'bottom_block.php'; ?>
        			<!-- BOTTOM BLOCK INCLUDE -->
        
        			<!-- FOOTER INCLUDE -->
        			<?php include 'footer.php';?>
        			<!-- FOOTER INCLUDE -->
    	

		

    		<?php //include 'chat.php';?>
        		
        		
        	<!-- EVENT POPUP INCLUDE -->
        	<?php include 'event_popup.php';?>
        	<!-- EVENT POPUP INCLUDE -->
        
        	<!-- NOTICE POPUP INCLUDE -->
        	<?php include 'notice_popup.php';?>
        	<!-- NOTICE POPUP INCLUDE -->
        
        	<!-- FEEDBACK FORM POPUP INCLUDE -->
        	<?php include 'feedback_form.php';?>
        	<!-- FEEDBACK FORM POPUP INCLUDE -->
        
        	<!-- BOOTSTRAP MODAL INCLUDE -->
            <?php include 'modal.php';?>
            <!-- BOOTSTRAP MODAL INCLUDE -->
        
            
        
        </div>
		<!-- MAIN CONTENT -->
    
    

	</div>

<!-- BOTTOM CSS JS INCLUDE -->
<?php include 'includes_bottom.php';?>
<!-- BOTTOM CSS JS INCLUDE -->

</body>
<!-- BODY ENDS HERE -->

</html>
