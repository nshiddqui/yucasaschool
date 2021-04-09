<hr />

<?php echo form_open(site_url('admin/hostel_attendance_report_selector')); ?>
<div class="row">

    <?php
    $query = $this->db->get('hostels');
    if ($query->num_rows() > 0):
        $hostel = $query->result_array();
        ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                <select class="form-control selectboxit" name="hostel_id">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php foreach ($hostel as $row): ?>
                        <option value="<?php echo $row['id']; ?>"<?php if ($hostel_id == $row['id']) echo 'selected'; ?> ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>
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

    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('show_report'); ?></button>
    </div>

</div>
<?php echo form_close(); ?>


<?php if ($hostel_id != '' &&  $month != '' && $sessional_year != ''): ?>

    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;">
                    <?php
                  
                    $hostel_name = $this->db->get_where('hostels', array('id' => $hostel_id))->row()->name;
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
                  <?php echo get_phrase('hostel') . ' ' . $hostel_name; ?><br>
                  <?php echo $m . ', ' . $sessional_year; ?>
                </h4>
            </div>
        </div>
        <div class="col-md-4"></div>
       <!--  <div class="col-md-6">
            <form method="post" name="sampleForm" id="data_form">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" style="margin-bottom:5px;color:#000;font-size:15px;">Attendance BY RFID</label>         
                <input type="text" class="col-md-6 form-control round"  maxlength="10" name="card_code" id="pos-customer-box"  placeholder="<?php echo $this->lang->line('Enter Customer Name'); ?> "autocomplete="off" autofocus />
             </div>
            </div>
           </form>
           </div>
          <div id="customer-box-result" class="col-md-6">
          </div> -->
    </div>
     <script>
         $(document).ready(function () {
          $("#pos-customer-box").keyup(function () {
            if($(this).val() <= 0){
                return false;
            }
            if(($(this).val()).length > 6){
            /// alert(($(this).val()).length);
             $.ajax({
              type: "GET",
              url: "<?php echo site_url('admin/pos_c_search/hostel');?>",
              data: 'card_code=' + $(this).val(),
              beforeSend: function () {
                $("#customer-box").css("background", "#FFF url(" +  + "<?php echo base_url();?>assets/load-ring.gif) no-repeat 165px");
              },
                success: function (data) {
                 $("#customer-box-result").show();
                 $("#customer-box-result").html(data);
                 $("#customer-box").css("background", "none");
                 get_attendence_data();
                 $("#data_form")[0].reset();
                 //  $("#my_table").ajax.reload();
                }
            });
          }
        });
      });
    </script>

    <hr />

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="my_table">
                <thead>
                    <tr>
                        <td style="text-align: center;">
    <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
    <?php
    $year = explode('-', $running_year);
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);

    for ($i = 1; $i <= $days; $i++) {
        ?>
                            <td style="text-align: center;"><?php echo $i; ?></td>
                    <?php } ?>

                    </tr>
                </thead>

                <tbody>
                            <?php
                            $data = array();
                            $this->db->select('*');
                            $this->db->where('hostel_id',$hostel_id);
                            $this->db->where('year' , $running_year);
                            $this->db->group_by('student_id'); 
                            $hosteldata = $this->db->get('hostel_attendance')->result_array();

                            foreach ($hosteldata as $row):
                                ?>
                        <tr>
                            <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . $sessional_year);
                                //$this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('hostel_attendance', array('hostel_id' => $hostel_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();


                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);

                                    if ($i == $month_dummy)
                                    $status = $row1['status'];


                                endforeach;
                                ?>
                                <td style="text-align: center;">
            <?php if ($status == 1) { ?>
                                        <i class="entypo-record" style="color: #00a651;"></i>
                            <?php  } if($status == 2)  { ?>
                                        <i class="entypo-record" style="color: #ee4749;"></i>
            <?php  } $status =0;?>


                                </td>

        <?php } ?>
    <?php endforeach; ?>

                    </tr>

    <?php ?>

                </tbody>
            </table>
            <center>
                <a href="<?php echo site_url('admin/hostel_attendance_report_print_view/' . $hostel_id .'/' . $month . '/' . $sessional_year); ?>"
                   class="btn btn-primary" target="_blank">
                <?php echo get_phrase('print_attendance_sheet'); ?>
                </a>
            </center>
        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">

    // ajax form plugin calls at each modal loading,
    $(document).ready(function() {

        // SelectBoxIt Dropdown replacement
        if($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        showFirstOption: attrDefault($this, 'first-option', true),
                        'native': attrDefault($this, 'native', false),
                        defaultText: attrDefault($this, 'text', ''),
                    };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
    });

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

</script>
