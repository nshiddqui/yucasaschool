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
                        $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
                        foreach ($students as $row):
                    ?>
                <tr>
                        <td style="text-align: center;">
                        <?php echo @$this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                        </td>
                        <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . $sessional_year);
                                //$this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();
                            foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);
                                if ($i == $month_dummy)
                                    $status = $row1['status'];
                                     $bus_status = $row1['bus_status'];
                                    $gate_status = $row1['gate_status'];
                            endforeach;
                        ?>
                        <td style="text-align: center;">
                             <?php if ($status == 1 && $bus_status==1 && $gate_status==1) { ?>
                                <i class="entypo-record" style="color: #00a651;"></i>
                               
                             <?php  } if($status == 2 && $bus_status==2 && $gate_status==2)  { ?>
                                <i class="entypo-record" style="color: #ee4749;"></i>
							 <?php } if($status ==1 && $bus_status!=1 && $gate_status!=1) { ?>
							 <i class="entypo-record" style="color: #e48306;"></i>
							 <?php }elseif($status !=1 && $bus_status==1 && $gate_status!=1){?>
							 <i class="entypo-record" style="color: #e48306;"></i>
							 <?php } elseif($status !=1 && $bus_status==1 && $gate_status==1){?>
							  <i class="entypo-record" style="color: #e48306;"></i>
							  <?php } elseif($status ==1 && $bus_status!=1 && $gate_status==1){?>
							  <i class="entypo-record" style="color: #e48306;"></i>
							   <?php } elseif($status ==1 && $bus_status==1 && $gate_status!=1){?>
							  <i class="entypo-record" style="color: #e48306;"></i>
                             <?php } $status = 0;?>
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
 </div>
</div>