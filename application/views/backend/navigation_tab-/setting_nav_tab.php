  <div class="container-fluid">
    <div class="row"> 
      <ul class="list-inline nav nav-tabs ed ajax-navigation" style="padding-left: 0;">
        
        <li class="<?php if ($activeTab == 'system_setting'){echo "active";}?>"><a href="#system_setting" class="" role="tab" data-toggle="tab" aria-expanded="true" >System Settings</a></li>
		
        <li class="<?php if ($activeTab == 'assignment_setting'){echo "active";}?>"><a href="#assignment_setting" class="" role="tab" data-toggle="tab" aria-expanded="true" >Assignment Settings</a></li>
		
        <li class="<?php if ($activeTab == 'sms_settings'){echo "active";}?>"><a href="#sms_settings" class=""  role="tab" data-toggle="tab" aria-expanded="true">SMS Settings</a></li>

        <li class="<?php if ($activeTab == 'payment_settings'){echo "active";}?>"><a href="#payment_settings" class=""  role="tab" data-toggle="tab" aria-expanded="true">Payment Settings</a></li>

        <li class="<?php if ($activeTab == 'card_settings'){echo "active";}?>"><a href="#card_settings" class=""  role="tab" data-toggle="tab" aria-expanded="true">Card Setting</a></li>

        <li class="<?php if ($activeTab == 'form_settings'){echo "active";}?>"><a href="#form_settings" class=""  role="tab" data-toggle="tab" aria-expanded="true">Registration Form</a></li>

        <li class="<?php if ($activeTab == 'facebook_settings'){echo "active";}?>"><a href="#facebook_settings" class=""  role="tab" data-toggle="tab" aria-expanded="true">Facebook Settings</a></li>

        <li class="<?php if ($activeTab == 'theme'){echo "active";}?>"><a href="#theme" class=""  role="tab" data-toggle="tab" aria-expanded="true">Theme</a></li>

        

      </ul>
    </div>
  </div>


  <div class="tab-content">

    <div  class="tab-pane fade <?php if ($activeTab == 'system_setting'){echo " active in";}?>" id="system_setting">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/system_settings" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/system_settings"><i class="entypo-chart-area"></i> System Settings</a></li>
      </ul>
    </div>
      <div  class="tab-pane fade <?php if ($activeTab == 'assignment_setting'){echo " active in";}?>" id="assignment_setting">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/assignment_setting" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/assignment_setting"><i class="entypo-chart-area"></i> Assignment Settings</a></li>
      </ul>
       </div>
    <div  class="tab-pane fade <?php if ($activeTab == 'sms_settings'){echo " active in";}?>" id="sms_settings">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/sms_settings" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/sms_settings"><i class="fa fa-list-ol"></i>SMS Settings</a></li>
      </ul>
    </div>


	<div  class="tab-pane fade <?php if ($activeTab == 'payment_settings'){echo " active in";}?>" id="payment_settings">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/payment_settings" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/payment_settings"><i class="fa fa-list-ol"></i>Payment Settings</a></li>
      </ul>
    </div>


	<div  class="tab-pane fade <?php if ($activeTab == 'theme'){echo " active in";}?>" id="theme">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/theme" class="url-link" data-url="<?php echo base_url(); ?>index.php/theme"><i class="fa fa-list-ol"></i>Theme Settings</a></li>
      </ul>
    </div>

  <div  class="tab-pane fade <?php if ($activeTab == 'card_settings'){echo " active in";}?>" id="card_settings">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/card_settings" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/card_settings"><i class="fa fa-list-ol"></i>Card Settings</a></li>
      </ul>
    </div>

    <div  class="tab-pane fade <?php if ($activeTab == 'form_settings'){echo " active in";}?>" id="form_settings">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/form_settings" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/form_settings"><i class="fa fa-list-ol"></i>Registration Form Settings (Student/ Parent)</a></li>
      </ul>
    </div>

    <div  class="tab-pane fade <?php if ($activeTab == 'facebook_settings'){echo " active in";}?>" id="facebook_settings">
      <ul class="list-inline ajax-sub-nav">
        <li><a href="<?php echo base_url(); ?>index.php/admin/facebook_settings" class="url-link" data-url="<?php echo base_url(); ?>index.php/admin/facebook_settings"><i class="fa fa-list-ol"></i>Facebook Settings</a></li>
      </ul>
    </div>


  </div>