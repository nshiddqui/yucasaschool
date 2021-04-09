<?php $activeTab = "teacher"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Teachers</a></li>
        <li class="active">Teacher Attendance Report</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


<?php echo form_open(site_url('admin/attendance_report_selector')); ?>
<div class="row">


    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control selectboxit" id="month">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'january';
                    else if ($i == 2)
                        $m = 'february';
                    else if ($i == 3)
                        $m = 'march';
                    else if ($i == 4)
                        $m = 'april';
                    else if ($i == 5)
                        $m = 'may';
                    else if ($i == 6)
                        $m = 'june';
                    else if ($i == 7)
                        $m = 'july';
                    else if ($i == 8)
                        $m = 'august';
                    else if ($i == 9)
                        $m = 'september';
                    else if ($i == 10)
                        $m = 'october';
                    else if ($i == 11)
                        $m = 'november';
                    else if ($i == 12)
                        $m = 'december';
                    ?>
                    <option value="<?php echo $i; ?>"
                            <?php if ($month == $i) echo 'selected'; ?>  >
                                <?php echo get_phrase($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
            <select class="form-control selectboxit" name="sessional_year">
                <?php
                $sessional_year_options = explode('-', $running_year); ?>
                <option value="<?php echo $sessional_year_options[0]; ?>" <?php if($sessional_year == $sessional_year_options[0]) echo 'selected'; ?>>
                    <?php echo $sessional_year_options[0]; ?></option>
                <option value="<?php echo $sessional_year_options[1]; ?>" <?php if($sessional_year == $sessional_year_options[1]) echo 'selected'; ?>>
                    <?php echo $sessional_year_options[1]; ?></option>
            </select>
        </div>
    </div>

    <input type="hidden" name="year" value="<?php echo $running_year; ?>">

    <div class="col-md-2 top-first-btn">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('show_report'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>


<?php if ( $month != '' && $sessional_year != ''): ?>

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
          <div id="teacher_rfid_info" class="col-md-4 hidden">

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
                  url: "<?php echo site_url('admin/teacher_rfid_search');?>",
                  data: 'card_code=' + $("#rfid_input").val(),
                  beforeSend: function () {
                    $("#teacher_rfid_info").css("background", "#FFF url(" +  + "<?php echo base_url();?>assets/load-ring.gif) no-repeat 165px");
                  },
                    success: function (data) {
                     $("#teacher_rfid_info").show();
                     $("#teacher_rfid_info").html(data);
                     $("#teacher_rfid_info").css("background", "none");
                     $('#teacher_rfid_info').removeClass('hidden');
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

                    $('#teacher_rfid_info').addClass('hidden');
                    $('#teacher_rfid_info').hide();
                 });
               };
               
      }
      });
    </script>


    </div>


    <hr />

     <div class="row" id="attendance_data">
    
    </div>
  
  
<?php endif; ?>

<script type="text/javascript">

    // ajax form plugin calls at each modal loading,
    $(document).ready(function() {
         
    $.ajax({
        url: '<?php echo site_url('admin/teacher_get_ajax_attendence/'); ?>',
        type: "POST",
        data: {'month':"<?php echo $month;?>",'sessional_year':"<?php echo $sessional_year;?>"},
        success: function (response)
        {
            console.log(response);
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
            url: '<?php echo site_url('admin/teacher_get_ajax_attendence/'); ?>',
            type: "POST",
            data: {'month':"<?php echo $month;?>",'sessional_year':"<?php echo $sessional_year;?>"},
            success: function (response)
            {
                console.log(response);
                $('#attendance_data').html(response);
            }
        });
    }
</script>


