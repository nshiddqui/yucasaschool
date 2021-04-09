<link rel="stylesheet" href="<?php echo base_url('assets/js/select2/select2-bootstrap.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/select2/select2.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/selectboxit/jquery.selectBoxIt.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css');?>">
<link rel="stylesheet" media="only screen and (min-device-width:2159px)" href="<?php echo base_url('assets/css/4k-responsive.css');?>"/>


<!-- ROUTE MAP SCRIPT -->
<!-- // <script src="<?php echo base_url('assets/js/route_map.js');?>"></script> -->

<!-- Bottom Scripts -->
<script src="<?php echo base_url('assets/js/gsap/main-gsap.js');?>"></script>
<!-- <script src="<?php echo base_url('assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js');?>"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
<script src="<?php echo base_url('assets/js/joinable.js');?>"></script>
<script src="<?php echo base_url('assets/js/resizeable.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-api.js');?>"></script>
<script src="<?php echo base_url('assets/js/toastr.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/fullcalendar/fullcalendar.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js');?>"></script> 
<script src="<?php echo base_url('assets/js/bootstrap-timepicker.min.js');?>"></script>

<script src="<?php echo base_url('assets/js/fileinput.js');?>"></script>

<!-- JS COLOR SCRIPT -->
<script src="<?php echo base_url('assets/js/jscolor.js');?>"></script>

<!-- SCHOOL ERP JS -->

<script src="<?php echo base_url('assets/js/school_erp/jquery.validate.js');?>"></script>
<script src="<?php echo base_url('assets/js/school_erp/jquery.colorbox-min.js');?>"></script>
<!-- SCHOOL ERP JS -->


<script type="text/javascript" src="<?php echo base_url('assets/datatable/dataTables/js/jquery.dataTables.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatable/dataTables/js/dataTables.bootstrap.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatable/buttons/js/dataTables.buttons.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatable/buttons/js/buttons.bootstrap.js');?>"></script>


<!-- ADDED BY BHUVAN SINGH -->
<script type="text/javascript" src="<?php echo base_url('assets/js/datatables/dataTables.buttons.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/datatables/buttons.flash.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/datatables/jszip.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/datatables/pdfmake.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/datatables/vfs_fonts.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/datatables/buttons.html5.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/datatables/
buttons.print.min.js');?>"></script>


<script src="<?php echo base_url('assets/js/select2/select2.min.js');?>"></script>
<!-- <script src="<?php echo base_url('assets/js/selectboxit/jquery.selectBoxIt.min.js');?>"></script> -->


<script src="<?php echo base_url('assets/js/selectBoxIt.js');?>"></script>

<!-- <script src="http://gregfranko.com/jquery.selectBoxIt.js/js/jquery.selectBoxIt.min.js"></script> -->


<script src="<?php echo base_url('assets/js/neon-calendar.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-chat.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-custom.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-demo.js');?>"></script>

<script src="<?php echo base_url('assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/wysihtml5/bootstrap-wysihtml5.js');?>"></script>
<script src="<?php echo base_url('assets/js/owl.carousel.js');?>"></script>

<script src="<?php echo base_url('assets/js/custom_js.js');?>"></script>


<!-- CHART JS FILES -->
<script src="<?php echo base_url('assets/js/moment.js');?>"></script>
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script>
<!-- BOOTSTRAP DATETIMEPICKER -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<!-- SLICK SLIDER JS CDN -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<!-- NEWS TICKER JS -->
<script src="<?php echo base_url('assets/js/ticker.js');?>"></script>


    
    
<!-- INITIALIZING EVENT POPUP -->

<script>

$(window).ready(()=>{
   const active_link = "<?php echo $active_link;?>";
   const active_li = $('#main-menu').find(`[active_link='${active_link}']`);
   console.log(active_link);
   active_li.addClass("active");
   
   const closest_sub = active_li.closest('.has-sub');
   closest_sub.addClass('opened');
   closest_sub.children("ul").addClass('visible');
   
   if(!closest_sub.hasClass('root-level')){
       const root_level = closest_sub.closest('.root-level');
       root_level.addClass('opened');
       root_level.children("ul").addClass('visible');
   }
  
   
});
    
$('.close-event').click(()=> {
    $('.event_popup').hide();
    $('.overlay-event').hide();
});

$('.close-notice').click(()=> {
    $('.notice_popup').hide();
    $('.overlay-notice').hide();
});

</script>
<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">
    toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>

<?php endif;?>

<?php if ($this->session->flashdata('error_message') != ""):?>

<script type="text/javascript">
    toastr.error('<?php echo $this->session->flashdata("error_message");?>');
</script>

<?php endif;?>


<!---  DATA TABLE EXPORT CONFIGURATIONS -->
<script type="text/javascript">

    jQuery(document).ready(function($)
    {
        var datatable = $("#table_export").dataTable();
        
       
    });
    
    // Support Message 

    $('.breadcrumb > a').click(() => {
        $('#feedbackForm').show();
        $('.overlay-feedback').show();
    });

    window.onload = () =>{
        $('.close-feedback').click(() => {
            $('#feedbackForm').hide();
            $('.overlay-feedback').hide();
        });
    }



    $(document).ready(function() {
        $('#datatableEvents').dataTable( {
            "pageLength": 7 
        } );
    });

</script>


<script>
    $('.quickinfo_close').click(function(){
        $('.quick-info').hide();
    });
</script>

<script>
     $(document).ready(function () {
      $(".search-input").keyup(function () {
        if($(this).val() <= 0){
            return false;
        }
        if(($(this).val()).length > 6){
        $('.quick-info').show();
      }

       function rfid_close_function(){
        $('.rfid_close').click(function(){

            $('#customer-box-result').addClass('cbs-b-hidden');
            $('#customer-box-result').hide();
         });
       };
           
    });

    
  });

    $("#tt_datepicker").datepicker({
            beforeShowDay: function(date) {
                return [date.getDay() == 5];
            }
    }); 

  
// Set Calendar Dates
$(window).ready(function(){
Date.prototype.setDateTimeTable = function(start)
{
        //Calcing the starting point
    start = start || 0;
    var today = new Date(this.setHours(0, 0, 0, 0));
    var day = today.getDay() - start;
    var date = today.getDate() - day;

        // Grabbing Start/End Dates
    var StartDate = new Date(today.setDate(date));
    var EndDate = new Date(today.setDate(date + 6));
    return [StartDate, EndDate];
}

// test code
var Dates = new Date().setDateTimeTable();

$('.timetable thead tr th').each(
function(element){
    
});

console.log(Dates[0].toLocaleDateString() + ' to '+ Dates[1].toLocaleDateString());

});

// Set Start Time
$('.start_time').timepicker({
    'defaultTime': '08:00 AM',
    'minTime': '8:00am',
    'maxTime': '11:30pm',
    'showDuration': true
});

// Set Deafult Period Interval
$('.period_interval').val('30');



// Active Tab Pane Via URl


if(window.location.href.indexOf('#') > -1){
    $(window).ready(function(){
    var url = window.location.href;
    var activeTab = url.substring(url.indexOf("#") + 1);

     console.log(activeTab);
     $(".main-tab .tab-pane").removeClass("active in");
     $('a[href="#'+ activeTab +'"]').tab('show')

    });
}

$('.ajax-sub-nav li a').click(function(){
    
    var url = $(this).attr('href');
    console.log(url);
    document.location.replace(url);
    // return false;
});

</script>


<script type="text/javascript">
      function get_subjectid_by_teacher(value){
      $.ajax({       
      type   : "POST",
      url    : "<?php echo site_url('ajax/get_subjectid_by_teacher'); ?>",
      data   : {'subject_id' : value},               
      // async  : false,
      success: function(response){  
        console.log(response);                                                 
        $('#teacher_details').html(response);
       }
     });
   }

   // LIBRARY ISSUE BOOK FUNCTIONS

   $(document).ready(function () {

      $("#book_rfid").keyup(function () {

        if($(this).val() <= 0){
            return false;
        }

        if(($(this).val()).length > 6){
        $('.book-details').show();
       }

    });

    $("#name_rfid").keyup(function () {
        if($(this).val() <= 0){
            return false;
        }
        if(($(this).val()).length > 6){
        $('.student-details').show();
       }

    });

  });
   
</script>

<script>
    let clicked = 0;
    $('.event_item').click(function(){
        if($(this).attr("dash_event") == "true"){
            var currentEvent = $(this);
        }
        else{
            var currentEvent = $(this).find("li");
        }
        
        // alert(currentEvent.attr('event_place'));
        let sliderContent =``;
        let eventImages = JSON.parse(currentEvent.attr('event_images'),false);
        
        if(eventImages.length !=0){
            eventImages.forEach((image)=>{
                sliderContent += `<div class="slide"><img src="<?php echo base_url();?>assets/uploads/event/${image.image}" alt=""></div>`;    
            });

            if(clicked == 1){

                    $('.event_image_slider').slick("unslick");
                    $('.event_image_slider').html("");
                }
                
            $('.event_image_slider').html(sliderContent);
            console.log('after' + sliderContent);
            if(eventImages.length >1){

                
                setTimeout(()=>{
                    $('.event_image_slider').slick({
                  infinite: true,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  arrows:false,
                  navigation:false,
                  dots: true
                });},50);
            } 
        }

        else{
           $('.event_image_slider').html(""); 
        }

        // console.log(sliderContent);
        
        $('.event_popup .event-name label').html(currentEvent.html());
        $('.event_popup .event_place').html(currentEvent.attr('event_place'));
        $('.event_popup .from_date').html(currentEvent.attr('event_from'));
        $('.event_popup .to_date').html(currentEvent.attr('event_to'));
        $('.event_popup .event_note').html(currentEvent.attr('event_note'));

        $('.event_popup').show();
        $('.overlay-event').show();
        clicked = 1;
    });



    // FUNCTION FOREMAIL VALIDATION
    
    function email_validation(emailVal,emailId,userId,userType){
        console.log(validateEmail(emailVal));
        if(validateEmail(emailVal) == false)
        return false;
         
        $.ajax({ 
            type   : "POST",
            url    : "<?php echo site_url('ajax_validation/existing_email_validation'); ?>",
            data   : {'emailVal' : emailVal,'userId':userId,'userType': userType},
            success: function(data){                                                   
            if(data == 0){
 
                toastr.error('This email already exist !');
            }
            else if(data==1){
                toastr.success('Email Id available');
            }
        }
        });
     }
  
    // VALIDATING EMAIL ID
    function validateEmail(email) {
       var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       return re.test(String(email).toLowerCase());
    }
    
    
    // FUNCTION FOR FILE EXTENSION VALIDATION
    
    function file_extension_validation(filename,...types){
        console.log(...types);
        var fileSplit = filename.split(".");
        if( fileSplit.length === 1 || ( fileSplit[0] === "" && fileSplit.length === 2 ) ) {
            return "";
        }
        var fileExtension = fileSplit.pop();
        var fileMatch;
        
        if(types.indexOf(fileExtension)  == -1 ){
             toastr.error('Please upload file with correct extension');
             $(this).val('');
        }
        else{
            toastr.success('File extension supported');
        }
        
    
    }
    
    
    
    // FUNCTION FORNAME VALIDATION
    
    function name_validation(nameVal,emailId,userId,userType,msg){
       
        if(nameVal == "")
          return false;
         
        $.ajax({ 
            type   : "POST",
            url    : "<?php echo site_url('ajax_validation/existing_name_validation'); ?>",
            data   : {'nameVal' : nameVal,'userId':userId,'userType': userType},
            success: function(data){                                                   
            if(data == 0){
 
                toastr.error('This '+msg+' already exist !');
            }
            else if(data==1){
                toastr.success(msg+' available');
            }
          }
        });
     }
     
     // DATE PICKER  
      $(window).ready(


        $('.att_time').datetimepicker({
                    format: 'LT'
                })
        );


      $('.facebook_album_gallery_slider').slick({
          infinite: false,
          slidesToShow: 5,
          slidesToScroll: 1,
          arrows:false,
          navigation:false,
          dots: true
        });



    // NOTICE CLICKED IMAGE
    $('.notice_item').click(function(){
    
        // console.log(sliderContent);
        let img = $(this).attr('notice-image');
        if(img){
            var notice_img = `<div class="slide"><img src="<?php echo base_url();?>assets/uploads/event/${img}" alt=""></div>`;
        }
        else{
            var notice_img ="";
        }
        
        $('.notice_popup .notice-title span').html($(this).attr('notice_title'));
        $('.notice_popup .notice-note span').html($(this).attr('notice'));

        $('.notice_popup').show();
        $('.overlay-notice').show();
    });
    


</script>