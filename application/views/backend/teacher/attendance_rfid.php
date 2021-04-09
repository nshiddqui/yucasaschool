<?php $activeTab = "daily_attendance"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Student</a></li>
        <li class="active">Attendance Report</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>



    <div class="row">
     
           <div class="col-md-4 p0 text-center col-md-offset-4 mt-4" >
            
            <div class="col-md-12">

              <div class="form-group rfid-active-btn" >
                <div class="col-md-6 form-control round btn btn-default ">Click to mark attendance via rfid</div>
              </div>
              <div class="form-group rfid-active-input ">
                 <input type="text" class="col-md-6 form-control round"  maxlength="10" name="card_code" id="rfid_input"  placeholder="Tap RFID card.."autocomplete="off" autofocus />
             </div>

             <div class="clearfix"></div>

             <div class="row  mt-3" id="student_rfid_info_class_section">
             <div class="col-sm-4 current-class text-left"><strong>Class : </strong><span></span></div> 
         <div class="col-sm-4 current-period"><strong>Period : </strong><span></span></div>
             <div class="col-sm-4 marked-status"><strong>Marked : </strong><span></span></div> 
             </div>
            </div>

           </div>

           <div class="col-sm-12 mt-2">


	
            <div id="student_rfid_info" class="col-md-4 col-md-offset-4 p0">
            <div class="student_rfid_info_blank col-12 text-center">
              <h4 class="mt-4 text-white">ID PREVIEW</h4>
            </div>

            </div>

          </div>

          <div class="col-sm-4 text-center col-md-offset-4 mt-2">
            
            <div>
              <a href="" class="btn-default btn">Attendance Complete</a>
            </div>
          </div>

          </div>

          <div class="row mt-4">
              <div class="col-md-8 col-md-offset-2">
                  <blockquote class="blockquote-blue">
                      <p>
                          <strong>Please follow the instruction for marking attendance through RFID. </strong>
                      </p>
                      <div class="col-12">
                          <ol>
                            <li>Ensure that the reader device is plugged in.</li>
                            <li>Click the start button</li>
                            <li>Start tapping the ID cards on the reader and you will see the preview of card tapped pop up.</li>
                            <li>All markings will be uploaded instantly.</li>
                            <li>Note that once attendance complete is clicked all umarked ids will be marked absent. </li>
                          </ol>
                      </div>
                  </blockquote>
              </div>
          </div>
        <script>
          $(document).ready(function () {
            //setup before functions
          let typingTimer;                //timer identifier
          let doneTypingInterval = 500;  //time in ms (0.2 seconds)
          var myInput = document.getElementById('rfid_input');

          //on keyup, start the countdown
          myInput.addEventListener('keyup', () => {
              clearTimeout(typingTimer);
              if (myInput.value) {
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
              }
          });

            function doneTyping() {

                if(($("#rfid_input").val()).length >= 9){
                 //alert(($(this).val()).length);
                 $.ajax({
                  type: "GET",
                  url: "<?php echo site_url('teacher/rfid_search');?>",
                  data: 'card_code=' + $("#rfid_input").val(),
                    success: function (data) {
                     $("#student_rfid_info").show();
                     $("#student_rfid_info").html(data);
                     $('#student_rfid_info').removeClass('hidden');
                     get_attendence_data();
                     $("#rfid_input").val('');
                     rfid_close();
                     if(data.length <= 1){
                         toastr.error('RFID number not alloted to any student. Please check and try again!')
                     }
            
                    }
                 });
               }

               else{
                toastr.error('Please enter valid rfid number');
                $("#rfid_input").val('');
               }

               function rfid_close(){
                $('.rfid_close').click(function(){
                    $('#student_rfid_info').addClass('hidden');
                    $('#student_rfid_info').hide();
                 });
               }
  
      }
      });


    </script>

	
	
<script>
          $(document).ready(function () {
            //setup before functions
          let typingTimer;                //timer identifier
          let doneTypingInterval1 = 500;  //time in ms (0.2 seconds)
          var myInput = document.getElementById('rfid_input');

          //on keyup, start the countdown
          myInput.addEventListener('keyup', () => {
              clearTimeout(typingTimer);
              if (myInput.value) {
                  typingTimer = setTimeout(doneTyping1, doneTypingInterval1);
              }
          });

            function doneTyping1() {

                if(($("#rfid_input").val()).length >= 9){
                
                 $.ajax({
                  type: "GET",
                  url: "<?php echo site_url('teacher/rfid_search_class_student');?>",
                  data: 'card_code=' + $("#rfid_input").val(),
                    success: function (data) {
                     $("#student_rfid_info_class_section").show();
                     $("#student_rfid_info_class_section").html(data);
                     $('#student_rfid_info_class_section').removeClass('hidden');
                     get_attendence_data();
                     $("#rfid_input").val('');
                     rfid_close();
                    
            
                    }
                 });
               }
      }
      });


    </script>
	
	
    </div>


    <hr />


    
<script type="text/javascript">

   $(window).load(() => {
       setTimeout(function(){
        $('#my_table tbody tr td:not(:first-child)').click((e)=>{
            $('.attendancePopup').show();
            let current  = e.currentTarget;
            let gateAtt  = current.getAttribute('gateAtt');
            let classAtt = current.getAttribute('classAtt');
            let busAtt   = current.getAttribute('busAtt');
            let student_name = current.getAttribute('student_name');
            let attendanceid = current.getAttribute('attendanceid');
            
            $('.stdnt_nam').html(student_name);
            $('#attendanceid').val(attendanceid);

            //alert(attendanceid);
            if(gateAtt == 1){
                $('.gAtt').html('Present');
                $('.gp').prop("checked", true);
            } else{
                $('.gAtt').html('Absent');
                $('.ga').prop("checked", true);
            }  
            
            if(classAtt == 1){
                $('.cAtt').html('Present');
                $('.cp').prop("checked", true);
            } else{
                $('.cAtt').html('Absent');
                $('.ca').prop("checked", true);
            }   

            if(busAtt == 1){
                $('.bAtt').html('Present');
                $('.bp').prop("checked", true);
            } else{
                $('.bAtt').html('Absent');
                $('.ba').prop("checked", true);
            }   
        });
       },2000);
    });

   $('.closePopup').click(()=> $('.attendancePopup').hide());

    // ajax form plugin calls at each modal loading,
    $(document).ready(function() {
         
    $.ajax({
        url: '<?php echo site_url('admin/get_ajax_attendence/'); ?>',
        type: "POST",
        data: {'class_id':"<?php echo $class_id;?>",'section_id':"<?php echo $section_id;?>",'month':"<?php echo $month;?>",'sessional_year':"<?php echo $sessional_year;?>"},
        success: function (response)
        {
            $('#attendance_data').html(response);
        }
    });


    // SelectBoxIt Dropdown replacement
    if($.isFunction($.fn.selectBoxIt))
        {
        $("select.selectboxit").each(function(i, el)
         {
            var $this = $(el),
                opts  = {
                    showFirstOption: attrDefault($this, 'first-option', true),
                    'native': attrDefault($this, 'native', false),
                    defaultText: attrDefault($this, 'text', ''),
                };
            $this.addClass('visible');
            $this.selectBoxIt(opts);
         });
        }
    });
    
    function get_attendence_data(){
        $.ajax({
            url: '<?php echo site_url('admin/get_ajax_attendence/'); ?>',
            type: "POST",
            data: {'class_id':"<?php echo $class_id;?>",'section_id':"<?php echo $section_id;?>",'month':"<?php echo $month;?>",'sessional_year':"<?php echo $sessional_year;?>"},
            success: function (response)
            {
                console.log(response);
                $('#attendance_data').html(response);
            }
        });
    }
</script>

<script type="text/javascript">

    function select_section(class_id) {

        $.ajax({
            url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
            success: function (response)
            {

                jQuery('#section_holder').html(response);
            }
        });
    }

    

   $(document).ready(function(){
     $("#ajax_updateAttendance").validate({
        rules :{
        }, submitHandler: function(form) {
         // do other things for a valid form
          var data;
          data =  $("#ajax_updateAttendance").serialize();
           // data.append( 'file', $( '#file' )[0].files[0] );
          console.log(data);
          //alert("Submitted! " + $('#is_temporary').val());
          
           $.ajax({
                url: "<?php echo site_url('admin/ajax_updateAttendance/'); ?>",
                data: data,
                type: 'POST',
                success: function (data) {
                    if(data == 1){
                        $('#msgg').html('Update_data_successfully !');
                    }
                    
                    $('.attendancePopup').hide();
                    //$("#ajax_updateAttendance")[0].reset(); 
                   

                }
            });
        //form.preventDefault();
       }
    });
});


$('.rfid-active-btn').click(()=>{
  $('.rfid-active-btn').hide();
  $('.rfid-active-input').show();
});

</script>
