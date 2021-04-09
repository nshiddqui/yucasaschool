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


<!--   <?php print_r($theme_colorcode );?> -->
	
    <body class="style-light page-body <?php if ($skin_colour != '') echo 'skin-' . $skin_colour;?>" >
	<div class="registration-header"><a href="<?php echo base_url();?>/index.php/login">
        <img src="<?php echo base_url();?>uploads/logo.png" style="max-height:40px;">
</a> <span class="regsitration-school-name pull-right">Cambridge School, Sector-7, Rohini, Delhi - 110085 | Phone : 011 - 26413625 | help@cambridgeschool.com</span></div>
	  <div class="container" >
	
		 <div class="col-12">


            <!--h3>
           	<i class="entypo-right-circled"></i>
				<?php echo $page_title;?>
           </h3-->

			<?php //echo $account_type.'/'.$page_name.'.php';
			include 'admin/registration_form.php';
			?>




		</div>
		<?php //include 'chat.php';?>
    </div>
    <?php include 'modal.php';?>
    <?php include 'includes_bottom.php';?>
    
    <div id="modalEvent" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="event_title">Event information</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <p id="event_date"></p>
            <p id="event_description"></p>

          </div>
          <div class="modal-footer">
            <a id="event_url" href="" target="_blank" class="btn btn-default" style="background: #2EC4B6;">Open Link</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>




</body>
</html>
