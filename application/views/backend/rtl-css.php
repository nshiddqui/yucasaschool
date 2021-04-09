<style type="text/css">
      <?php
         if($this->session->userdata('theme') == 'light-theme'){ ?>
    
            .nav.side-menu>li.current-page, 
            .nav.side-menu>li.active,
            .nav-sm .nav.side-menu li.active-sm {
                border-left: 5px solid #9eff8b;
            }
            .nav-md ul.nav.child_menu li:after {
                 border-right: 1px solid #9eff8b;
             }  

             body .page-container .sidebar-menu{
                background-color:#32CD32 !important;
             }           

        <?php }elseif($this->session->userdata('theme') == 'dark-theme'){ ?>
                
            .nav.side-menu>li.current-page, 
            .nav.side-menu>li.active,
            .nav-sm .nav.side-menu li.active-sm {
                border-left: 5px solid #000000;
            }               
            .nav-md ul.nav.child_menu li:after {
                border-right: 1px solid #ffffff;
            }
             body .page-container .sidebar-menu{
                background-color:#23282d !important;
             }  
                
  
            
        <?php }elseif($theme_colorcode != '' && $this->session->userdata('theme') == ""){ ?>
            .nav.side-menu>li.current-page, 
            .nav.side-menu>li.active,
            .nav-sm .nav.side-menu li.active-sm {
                border-left: 5px solid #c3c3c3;
            }
            .nav-md ul.nav.child_menu li:after {
                border-right: 1px solid #ffffff;
            }
            body .page-container .sidebar-menu{
               background-color:<?php echo $theme_colorcode;?> !important;
            }

        <?php } ?>
         
        
   

</style>
