<?php
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	//$system_title       =	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	$text_align         =	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;
 	 $account_type       =	$this->session->userdata('login_type');
	$skin_colour        =   $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description;
	$active_sms_service =   $this->db->get_where('settings' , array('type'=>'active_sms_service'))->row()->description;
	$running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
    $theme_colorcode 	=   $this->db->get_where('themes' , array('is_active'=>'1'))->result();
?>
<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl';?>">
<head>

	<title><?php echo $page_title;?> | <?php echo $system_name;?></title>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Ekattor School Manager Pro - Creativeitem" />
	<meta name="author" content="Creativeitem" />
    <?php include 'includes_top.php';?>
   
  </head>


    <body class="style-light page-body" >
	  <div class="page-container <?php if ($text_align == 'right-to-left') echo 'right-sidebar';?>
		" >

	      
	      
        <?php
        //echo $account_type.'/navigation.php';die;
        
        //include $account_type.'/navigation.php'; 
        ?>
		 <div class="main-content">
    
		   <?php //include 'header.php';
		   ?>
            <!--h3>
           	<i class="entypo-right-circled"></i>
				<?php echo $page_title;?>
           </h3-->
            <div class="col-sm-12">
			<?php //echo $account_type.'/'.$page_name.'.php';
			include $account_type.'/'.$page_name.'.php';
			?>
			</div>
              <?php include 'bottom_block.php'; ?>
        			<?php //include 'footer.php';
        			?>
              
              <div class="quick-info" style="display: none;">
                <?php include 'quick-info.php';?>
              </div>
              
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
		<?php //include 'chat.php';?>
    </div>

    

    <!-- BOTTOM CSS JS INCLUDE -->
    <?php include 'includes_bottom.php';?>
    <!-- BOTTOM CSS JS INCLUDE -->


</body>
</html>


<!-- linear-gradient(94deg, rgba(252, 190, 71, 1) 2%, rgba(250, 194, 85, 1) 47%, rgba(255, 209, 122, 1) 100%) 
linear-gradient(94deg, rgba(1, 174, 180, 1) 2%, rgba(15, 189, 196, 1) 47%, rgba(30, 209, 214, 1) 100%)
linear-gradient(94deg, rgba(240, 96, 139, 1) 2%, rgba(245, 111, 144, 1) 47%, rgba(251, 133, 157, 1) 100%)
linear-gradient(94deg, rgba(49, 62, 106, 1) 2%, rgba(57, 72, 115, 1) 47%, rgba(68, 85, 129, 1) 100%)-->