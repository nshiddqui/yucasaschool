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
</div>
<style>
.page-container.sidebar-collapsed {
    padding-left: 323px;
}
</style>


<?php echo form_open(site_url('admin/attendance_report_view')); ?>
<div class="row">

    <?php
    $query = $this->db->get('class');
    if ($query->num_rows() > 0):
        $class = $query->result_array();
        ?>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php foreach ($class as $row): ?>
                        <option value="<?php echo $row['class_id']; ?>"<?php if ($class_id == $row['class_id']) echo 'selected'; ?> ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

    <?php
    $query = $this->db->get_where('section', array('class_id' => $class_id));
    if ($query->num_rows() > 0):
        $sections = $query->result_array();
        ?>
        <div id="section_holder">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                    <select class="form-control selectboxit" name="section_id">
                        <?php foreach ($sections as $row): ?>
                            <option value="<?php echo $row['section_id']; ?>"
                                    <?php if ($section_id == $row['section_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    <?php endif; ?>
   <div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">From</label>
			<input type="text" class="form-control datepicker" name="from" data-format="dd-mm-yyyy" value="<?= $from ?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">To</label>
			<input type="text" class="form-control datepicker" name="to" data-format="dd-mm-yyyy" value="<?= $to ?>">
		</div>
	</div>

    <input type="hidden" name="year" value="<?php echo $running_year; ?>">

    <div class="col-md-2 top-first-btn">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('show_report'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>


<?php if ($class_id != '' && $section_id != '' && $to != '' && $from != ''): ?>

    <br>
    <div class="row">
        <!-- <div class="col-md-4"></div> -->
        <!-- <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;">
                    <?php
                    $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
                    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                    if ($month == 1)
                        $m = 'January';
                    else if ($month == 2)
                        $m = 'February';
                    else if ($month == 3)
                        $m = 'March';
                    else if ($month == 4)
                        $m = 'April';
                    else if ($month == 5)
                        $m = 'May';
                    else if ($month == 6)
                        $m = 'June';
                    else if ($month == 7)
                        $m = 'July';
                    else if ($month == 8)
                        $m = 'August';
                    else if ($month == 9)
                        $m = 'Sepetember';
                    else if ($month == 10)
                        $m = 'October';
                    else if ($month == 11)
                        $m = 'November';
                    else if ($month == 12)
                        $m = 'December';
                    echo get_phrase('attendance_sheet');
                    ?>
                </h3>
                <h4 style="color: #696969;">
    <?php echo get_phrase('class') . ' ' . $class_name; ?> : <?php echo get_phrase('section');?> <?php echo $section_name; ?><br>
    <?php echo $m . ', ' . $sessional_year; ?>
                </h4>
            </div>
        </div> -->
       <!-- <div class="col-md-4"></div> -->
           
               
           
           <div class="col-md-3 p0" >
            
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label" style="margin-bottom:5px;color:#333;font-size:12px;">Attendance BY RFID</label>         
                <input type="text" class="col-md-6 form-control round"  maxlength="10" name="card_code" id="rfid_input"  placeholder="<?php echo $this->lang->line('Enter Customer Name'); ?> "autocomplete="off" autofocus />
             </div>
            </div>
           </div>


<div class="clearfix"></div>
<div class="clearfix"></div>
		   <div style="float: left; margin-left: 10px !important; font-weight: 600; color:#333;">
		    <i class="entypo-record" style="color: #00a651;"></i> <span>Present</span>
            <i class="entypo-record" style="color: #ee4749;"></i> <span>Absent</span>
			<i class="entypo-record" style="color: #FBC150;"></i> <span>Not Marked</span>  
		   </div>
          <div id="student_rfid_info" class="col-md-4 hidden">

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
                  url: "<?php echo site_url('admin/rfid_search');?>",
                  data: 'card_code=' + $("#rfid_input").val(),
                  beforeSend: function () {
                    $("#student_rfid_info").css("background", "#FFF url(" +  + "<?php echo base_url();?>assets/load-ring.gif) no-repeat 165px");
                  },
                    success: function (data) {
                     $("#student_rfid_info").show();
                     $("#student_rfid_info").html(data);
                     $("#student_rfid_info").css("background", "none");
                     $('#student_rfid_info').removeClass('hidden');
                     get_attendence_data();
                     $("#rfid_input").val('');
                     rfid_close_function();
                     //$("#my_table").ajax.reload();
                    }
                 });
               }

               else{
                toastr.error('Please enter valid rfid number');
                $("#rfid_input").val('');
               }

               function rfid_close_function(){
                $('.rfid_close').click(function(){

                    $('#student_rfid_info').addClass('hidden');
                    $('#student_rfid_info').hide();
                 });
               };
               
      }
      });


    </script>

    </div>


    <hr />

     <div class="row" id="attendance_data">
        <?php /* <div class="col-md-12">
            <table class="table table-bordered" id="my_table">
                <thead>
                    <tr>
                        <td style="text-align: center;">
    <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
    <?php
    $year = explode('-', $running_year);
    $month_to = explode('-', $from);
    $month_from = explode('-', $to);
    //print_r($month_to);
    $d1 = strtotime($to);
    $d2 = strtotime($from);
     $min_date = min($d1, $d2);
     $max_date = max($d1, $d2);
    $j = 0;
    
    while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
        $j++;
    }
     $month_count = $j;
     //$days = cal_days_in_month(CAL_GREGORIAN, $month_to[1], $month_to[2]);
     //$days_to = cal_days_in_month(CAL_GREGORIAN, $month_from[1], $month_from[2]);
     
     
     $start    = new DateTime($from);
$end      = (new DateTime($to))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);

foreach ($period as $dt) {
    ?>
    <td style="text-align: center;">&nbsp;</td>
    <?php
}
     
 ?>
                    </tr>
                </thead>

                <tbody>
                            <?php
                            $data = array();

                            $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
//echo $this->db->last_query();
                            foreach ($students as $row):
                                ?>
                        <tr>
                            <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <td>
                            <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . $sessional_year);
                                //$this->db->group_by('timestamp');
                                $minvalue=$to;
                                $maxvalue=$from;
                                $attendance=$this->db->select('*')->from('attendance')
                ->where(array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'student_id' => $row['student_id']))
                        ->where('defult_date>=', $minvalue)->where('defult_date<=', $maxvalue)
->get()->result_array();
                                           
                                //$attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->where("default_date BETWEEN $minvalue AND $maxvalue")->result_array();
//echo $this->db->last_query();die;

                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);

                                    if ($i == $month_dummy)
                                     echo $status = $row1['status'];


                                endforeach;
                                ?>
                               </td>

        <?php } ?>
    <?php endforeach; ?>

                    </tr>

    <?php ?>

                </tbody>
            </table>
		
			
            <center>
                <a href="<?php echo site_url('admin/attendance_report_print_view/' . $class_id . '/' . $section_id . '/' . $month . '/' . $sessional_year); ?>"
                   class="btn btn-primary" target="_blank">
    <?php echo get_phrase('print_attendance_sheet'); ?>
                </a>
            </center>
    <br>
    <br>
    <br>
        </div> */ ?>
    </div> 
    </div> 
	
	<div class="attendancePopup" >
    <div class="closePopup"><i class="fas fa-times"></i></div>
        <div class=" text-center"><h2>Attendance Report (<span class="stdnt_nam"> </span>)</h2></div>
        <div class="data">
            <h6 style="color: red;text-align: center;" id="msgg"></h6>
        <form action="" id="ajax_updateAttendance">
            <table class="table table-stripped">
                <thead>
                    <th>Attendance Type</th>
                    <th>Status</th>
                    <th>Option</th>
                </thead>
                
                <tbody>
                    <tr style="display:none;">

                        <td>Gate Attendance</td>
                        <td class="gAtt">Present</td>
                        <td>
                            
                        <input type="hidden" id="attendanceid" name="attendanceid"  value="">
                        <input type="hidden" id="class_id" name="class_id"  value="">
                        <input type="hidden" id="year" name="year"  value="">
                        <input type="hidden" id="timestamp" name="timestamp"  value="">
                        <input type="hidden" id="section_id" name="section_id"  value="">
                        <input type="hidden" id="student_id" name="student_id"  value="">
                        <input type="radio" class="gp" name="gate_att" data-value="1" value="1"> Present &nbsp;

                        <input type="radio" class="ga" name="gate_att" data-value="2" value="2"> Absent<br>
                        </td>   
                        
                    </tr>
                    <tr>
                        <td>Class Attendance</td>
                        <td class="cAtt">Absent</td>
                        <td>
                         <input type="radio" class="cp" name="class_att" data-value="1" value="1"> Present &nbsp;

                            <input type="radio" class="ca" name="class_att" data-value="2" value="2"> Absent<br>
                        </td>
                       
                    </tr>
                    <tr style="display:none;">
                        <td>Bus Attendance</td>
                        <td class="bAtt">Present</td>
                        <td>
                         <input type="radio" class="bp" name="bus_att" data-value="1" value="1"> Present &nbsp;

                            <input type="radio" class="ba" name="bus_att" data-value="2" value="2"> Absent<br>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <button type="submit" class="btn btn-success">Update Attendance</button>
        </form>
        </div>
    </div>
<?php endif; ?>
</div>

<script type="text/javascript">

   $(window).load(() => {
       setTimeout(function(){
        /*$('#my_table tbody tr td[gateAtt]').click((e)=>{
            $('.attendancePopup').show();
            let current  = e.currentTarget;
            let gateAtt  = current.getAttribute('gateAtt');
            let classAtt = current.getAttribute('classAtt');
            let busAtt   = current.getAttribute('busAtt');
            let student_name = current.getAttribute('student_name');
            let attendanceid = current.getAttribute('attendanceid');
            let class_id = current.getAttribute('class_id');
            let year = current.getAttribute('year');
            let section_id = current.getAttribute('section_id');
            let timestamp = current.getAttribute('timestamp');
            let student_id = current.getAttribute('student_id');
            console.log(student_id);
            console.log(current);
            $('.stdnt_nam').html(student_name);
            $('#attendanceid').val(attendanceid);
            $('#class_id').val(class_id);
            $('#section_id').val(section_id);
            $('#year').val(year);
            $('#student_id').val(student_id);
            $('#timestamp').val(timestamp);

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
        });*/
       },2000);
    });

   $('.closePopup').click(()=> $('.attendancePopup').hide());

    // ajax form plugin calls at each modal loading,
    $(document).ready(function() {
         
    $.ajax({
        url: '<?php echo site_url('admin/get_ajax_attendence/'); ?>',
        type: "POST",
        data: {'class_id':"<?php echo $class_id;?>",'section_id':"<?php echo $section_id;?>",'from':"<?php echo $from;?>",'to':"<?php echo $to;?>",'month':"<?php echo $month;?>",'sessional_year':"<?php echo $sessional_year;?>"},
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
        data: {'class_id':"<?php echo $class_id;?>",'section_id':"<?php echo $section_id;?>",'from':"<?php echo $from;?>",'to':"<?php echo $to;?>",'month':"<?php echo $month;?>",'sessional_year':"<?php echo $sessional_year;?>"},
        success: function (response)
        {
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
                        //$('#msgg').html('Update_data_successfully !');
                    }
                    get_attendence_data();
                    $('.closePopup').click();
                    $("#ajax_updateAttendance")[0].reset(); 
                    
                    //  location.reload();
                    // $('.attendancePopup').hide();
                    //$("#ajax_updateAttendance")[0].reset(); 
                   

                }
            });
        //form.preventDefault();
       }
    });
});


</script>
