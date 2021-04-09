
<div class="container"><?php $activeTab = "daily_attendance"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Employee</a></li>
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


<?php echo form_open(site_url('admin/attendance_report_employee_selector')); ?>
  <div class="row">
    
    <div class="col-md-3">
        <div class="form-group">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Designation');?></label>
            <select name="class_id" class="form-control selectboxit" id = "class_selection">
                <option value=""><?php echo get_phrase('Select Designation');?></option>
                <option value="all" <?= ('all'==$class_id?'selected':'') ?>>All</option>
                <?php
                    $designations = $this->db->get('designations')->result_array();
                    foreach($designations as $row):
                                            
                ?>
                                
                <option value="<?php echo $row['id'];?>" <?= ($row['id']==$class_id?'selected':'') ?>><?php echo $row['name'];?></option>
                                
                <?php endforeach;?>
            </select>
        </div>
    </div>
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
        <input type="hidden" name="operation" value="selection">
        <input type="hidden" name="sessional_year" value="<?php echo $running_year;?>">
    
    	<div class="col-md-2">
    	    <div class="form-group">
    	        <label class="control-label" style="margin-bottom: 5px;">Option</label>
    		    <button type="submit" class="btn btn-info btn-block"><?php echo get_phrase('show_report');?></button>
    		</div>
    	</div>
    </div>
    
    
<?php echo form_close(); ?>


<?php if ($class_id != '' && $from != '' && $to != '' && $sessional_year != ''): ?>

    <br>
    <div class="row">
           
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
                        <input type="radio" class="gp" name="gate_att" data-value="1" value="1"> Present &nbsp;

                        <input type="radio" class="ga" name="gate_att" data-value="2" value="2"> Absent<br>
                        </td>   
                        
                    </tr>
                    <tr>
                        <input type="hidden" id="attendanceid" name="attendanceid"  value="">
                        <input type="hidden" id="employee_id" name="employee_id"  value="">
                        <input type="hidden" id="designation_id" name="designation_id"  value="">
                        <input type="hidden" id="timestamp" name="timestamp"  value="">
                        <td>Attendance</td>
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

   

   $('.closePopup').click(()=> $('.attendancePopup').hide());

    // ajax form plugin calls at each modal loading,
    $(document).ready(function() {
         
    $.ajax({
        url: '<?php echo site_url('admin/get_ajax_employee_attendence/'); ?>',
        type: "POST",
        data: {'class_id':"<?php echo $class_id;?>",'from':"<?php echo $from;?>",'to':"<?php echo $to;?>",'sessional_year':"<?php echo $sessional_year;?>"},
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
            url: '<?php echo site_url('admin/get_ajax_employee_attendence/'); ?>',
            type: "POST",
            data: {'class_id':"<?php echo $class_id;?>",'from':"<?php echo $from;?>",'to':"<?php echo $to;?>",'sessional_year':"<?php echo $sessional_year;?>"},
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
                url: "<?php echo site_url('admin/ajax_updateStaffAttendance/'); ?>",
                data: data,
                type: 'POST',
                success: function (data) {
                    if(data == 1){
                        // $('#msgg').html('Update_data_successfully !');
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
