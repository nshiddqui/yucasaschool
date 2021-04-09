<?php
  $login_user_id = $this->session->userdata('login_user_id'); 
  $login_role_id = $this->session->userdata('role_id'); 
?>
<style>

    .skiptranslate{
        display:none !important;
    }
    <?php if(isset($_COOKIE['googtrans']) && $_COOKIE['googtrans']==='/en/hi'){ ?>
    
    .m-35{
        margin-top:-35px;
    }
    <?php } ?>
</style>
<div class="m-35" style="">
	<!-- Raw Links -->
	<div class="col-md-12 col-sm-12 clearfix top_header_bar">
        <ul class="list-inline links-list pull-left">
        <!-- Language Selector -->
        	<a href="<?php echo base_url();?>/index.php/login">
                <img src="<?php echo base_url();?>uploads/logo.png" style="max-height:40px;">
            </a> 
        </ul>
	

        <ul class="list-inline links-list pull-right right-info-bar">
                    <li class="dropdown language-selector">
        			 <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">
                        
        					                    		<span style="margin-left: 5px;padding-left: 5px;border-left: 1px solid #eee;">Select Language</span>
            </a>
        
        							<ul class="dropdown-menu pull-left translation-links">
        							    <li>
                    						<a href="#" class="english" data-lang="English">English</a>
                    					</li>
                    					<li>
                    						<a href="#" class="hindi" data-lang="Hindi">Hindi</a>
                    					</li>
        				</ul>
        									</li>
                    <!-- Code provided by Google -->
                    <div id="google_translate_element" style="display:none"></div>
                    <script type="text/javascript">
                      function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
                      }
                    </script>
                    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
                    
                    <!-- Flag click handler -->
                    <script type="text/javascript">
                        $('.translation-links a').click(function() {
                          var lang = $(this).data('lang');
                          if(lang=='Hindi'){
                              $('.m-35').css('margin-top','-35');
                          }
                          var $frame = $('.goog-te-menu-frame:first');
                          if (!$frame.size()) {
                            alert("Error: Could not find Google translate frame.");
                            return false;
                          }
                          $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
                          return false;
                        });
                    </script>
			<li id="session_static">
	           	<h4>
       			<a href="#" style="color: #696969;"
       				<?php if($account_type == 'admin'):?>
       				onclick="get_session_changer()"
       			    <?php endif;?>>
       				<?php echo get_phrase('running_session');?> : <?php echo $running_year.' ';?><i class="entypo-down-dir"></i>
       			</a>
           		</h4>
       		</li>
		<li class="dropdown language-selector">
            			 <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                            <i class="entypo-user"></i>
            					<?php
            					if($account_type == 'designation_users'){
            						$name = $this->db->get_where('employees', array('user_id' => $login_user_id))->row()->name;
            						echo $name;
            					}
            					?>
                    <?php   $_rolesdata=$this->session->userdata('role_id')?>
                        <?php
                            $roless = $this->db->get_where('roles' , array(
                                'id' => $_rolesdata
                            ))->result_array();
                         foreach ($roless as $row):
            			 $role_name=$row['name'];
            			 endforeach
                        ?>
            		<span style="margin-left: 5px;padding-left: 5px;border-left: 1px solid #eee;"><?php echo $role_name;?></span>
                </a>

			<?php if ($account_type != 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo site_url($account_type . '/manage_profile');?>">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo site_url($account_type . '/manage_profile');?>">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>

					<li>
						<a href="<?php echo site_url('login/logout');?>">
							<i class="entypo-logout right"></i> <?php echo get_phrase('log_out'); ?>
						</a>
					</li>
				</ul>
			<?php endif;?>
			<?php if ($account_type == 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo site_url('parents/manage_profile');?>">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('parents/manage_profile');?>">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>

					<li>
						<a href="<?php echo site_url('login/logout');?>">
							<?php echo get_phrase('log_out'); ?><i class="entypo-logout right"></i>
						</a>
					</li>

				</ul>
				<?php endif;?>
			</li>
	</div>

</div>

<script type="text/javascript">
	function get_session_changer()
	{
		$.ajax({
            url: '<?php echo site_url('admin/get_session_changer');?>',
            success: function(response)
            {
                jQuery('#session_static').html(response);
            }
        });
	}
	$(document).ready(function(){
	    $.fn.dataTable.ext.errMode = 'throw';
	});
</script>


