<?php $activeTab = "dormitory"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Facilities</a></li>
        <li class="active">Library</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/facilities_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>
<?php echo form_open(site_url('parents/hostel_attendance_report_selector/')); ?>
<div class="row">
     <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('student'); ?></label>
            <select class="form-control selectboxit" name="student_id">
                <?php
                  $this->db->select('H.*, S.name, S.student_id');
                  $this->db->from('hostel_members AS H');
                  $this->db->join('student AS S', 'S.student_id = H.user_id', 'left');
                  $this->db->where('S.parent_id',$this->session->userdata('login_user_id'));
                  $studentDetails  = $this->db->get()->result();
                 
                if(sizeof($studentDetails) > 0){
                  foreach($studentDetails as $dt){ ?>
                     <option value="<?php echo $dt->student_id;?>"   <?php if($student_id == $dt->student_id) echo 'selected'; ?>><?php echo $dt->name; ?></option>
                <?php } }else{ ?>
                    <option value="">data not found !</option>
                <?php } ?>    
            </select>
        </div>
    </div>
    <div class="col-md-2">
         <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control selectboxit">
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
                          <?php if($month == $i) echo 'selected'; ?>  >
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
            <select class="form-control selectboxit" name="sessional_year" readonly>
                <?php
                $sessional_year_options = explode('-', $running_year); ?>
                <option value="<?php echo $sessional_year_options[0]; ?>"><?php echo $sessional_year_options[0]; ?></option>
                <option value="<?php echo $sessional_year_options[1]; ?>"><?php echo $sessional_year_options[1]; ?></option>
            </select>
        </div>
    </div>

    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-2" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>
</div>

<?php echo form_close(); ?>


<!-- Attendance Table starts from here -->
<?php if ($hostel_id != '' && $month != '' && $sessional_year != '' && $student_id != ''): ?>

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
                <?php echo get_phrase('hostel');?> <?php echo $hostel_name; ?> : <?php echo get_phrase('student') . ' ' .$student_name; ?>  <br>
                <?php echo $m . ', ' . $sessional_year; ?>
                </h4>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>


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
                            $this->db->where('student_id' , $student_id);
                            $this->db->group_by('student_id'); 
                            $hosteldata = $this->db->get('hostel_attendance')->result_array();

                            if (sizeof($hosteldata) > 0):
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
                                $attendance = $this->db->get_where('hostel_attendance', array('year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();
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
                 <?php endif; ?>
            </tr>
        <?php ?>
     </tbody>
  </table>
            <center>
                <a href="<?php echo site_url('parents/hostel_attendance_report_print_view/'.$hostel_id.'/'.$month.'/'.$sessional_year.'/'.$student_id); ?>"
                   class="btn btn-primary" target="_blank">
    <?php echo get_phrase('print_attendance_sheet'); ?>
                </a>
            </center>
        </div>
    </div>
<?php endif; ?>
