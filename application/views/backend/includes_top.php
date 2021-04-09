<style>
  /* here you can change main color*/
    :root {
      --main-bg-color: #234F1E;
      --main-light-color: #00a651;
      --main-nav-bg: #fff;
    }
</style>
<script src="<?php echo base_url('assets/js/pace.js');?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/stroke7.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/pace-theme-flash.css');?>">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/font-icons/entypo/css/entypo.css');?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/neon-core.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/neon-theme.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/neon-forms.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/md-style.css');?>">


<!-- Owl Stylesheets -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css');?>">

<link rel="stylesheet" href="<?php echo base_url('assets/css/owl.theme.default.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css');?>">
<?php
    $skin_colour = $this->db->get_where('settings' , array('type' => 'skin_colour'))->row()->description;
    if ($skin_colour != ''):?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/' . $skin_colour . '.css');?>">

<?php endif;?>

<?php if ($text_align == 'right-to-left') : ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/neon-rtl.css');?>">
    
<?php endif; ?>

<script src="<?php echo base_url('assets/js/jquery-1.11.0.min.js');?>"></script>

<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/font-icons/font-awesome/css/font-awesome.min.css');?>">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> 
<link rel="stylesheet" href="<?php echo base_url('assets/js/vertical-timeline/css/component.css');?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/dataTables/css/dataTables.bootstrap.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/buttons/css/buttons.bootstrap.css');?>"/>

<link rel="stylesheet" href="<?php echo base_url('assets/js/wysihtml5/bootstrap-wysihtml5.css');?>">

<!--<link rel="stylesheet" href="<?php echo base_url('assets/css/icon-7/pe-icon-7-stroke.css');?>">-->
<link rel="stylesheet" href="<?php echo base_url('assets/css/custom_css_dashboard.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/full-calendar-custom.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/new-custom.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/style-dark.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/style-light.css');?>">

<!-- TICKER CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/ticker.css');?>">


<!-- DATETIMEPICKER CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">


<!--Amcharts-->
<script src="<?php echo base_url('assets/js/amcharts/amcharts.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/pie.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/serial.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/gauge.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/funnel.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/radar.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/exporting/amexport.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/exporting/rgbcolor.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/exporting/canvg.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/exporting/jspdf.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/exporting/filesaver.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/amcharts/exporting/jspdf.plugin.addimage.js');?>" type="text/javascript"></script>

 <!--Plugin CSS file with desired skin-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    
<!-- SLICK CSS CDN -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>

<link rel="stylesheet" href="<?php echo base_url('assets/css/new_custom_style.css');?>">

<script>
    function checkDelete()
    {
        var chk=confirm("Are You Sure To Delete This !");
        if(chk)
        {
          return true;
        }
        else{
            return false;
        }
    }
</script>
