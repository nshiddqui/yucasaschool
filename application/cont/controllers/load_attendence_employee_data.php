<div class="row">
         <div class="col-md-12">
             <table class="table table-bordered my_table" id="my_table">
                 <thead>
                     <tr>
                        <td style="text-align: center;">
                          <?php echo get_phrase('Employees'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
                        <?php
                        $year = explode('-', $running_year);
                        $days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);
                        for ($i = 1; $i <= $days; $i++) {
                          ?><td style="text-align: center;"><?php echo $i; ?></td>
                           <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $data = array();

                     $designations = $this->db->get('designations')->result_array();

                     print_r($designations);
                     die();


                     $designations_name = $designations[0]['name'];

                     $designations_data = $this->db->get(lcfirst($designations_name))->result_array();



                    $primary_id = lcfirst($designations_name)."_id";

                   
                      foreach ($designations_data as $row):

                    ?>
                    <tr>
                        <td style="text-align: center;">
                        <?php echo $st_name = @$this->db->get_where($designations_name, array($primary_id => $row[$primary_id]))->row()->name; ?>
                        </td>
                        <?php
                            $status      = 0;
                            $bus_status  = 0;
                            $gate_status = 0;
                            $attendence_by_status=0;
                            for ($i = 1; $i <= $days; $i++) {
                                $date = $i . '-' . $month . '-' . $sessional_year;
                               
 
                                $timestamp = strtotime($date);

                                
                                //$this->db->group_by('timestamp');
                                $query = $this->db->get_where('attendance_employee', array( 'designation_id' => $class_id, 'timestamp' => $timestamp, 'employee_id' => $row[$primary_id]));

                               
                                $attendance= $query->result_array();
                                $numberrow = $query->num_rows();
                                $attendence_by_status = 0;
                                $status      = 0;
                                $bus_status  = 0;
                                $gate_status = 0;


                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);
                                if ($i == $month_dummy)
                                    if($row1['status'] =="" || $row1['status'] == null){
                                        $status = 0;
                                    }
                                    else{
                                        $status = $row1['status'];
                                    }
                                    
                                    if($row1['bus_status'] == "" || $row1['bus_status'] == null){
                                        $bus_status = 0;
                                    }
                                    else{
                                        $bus_status = $row1['bus_status'];
                                    }

                                    if($row1['gate_status'] == "" || $row1['gate_status'] == null){
                                        $gate_status = 0;
                                    }
                                    else{
                                        $gate_status = $row1['gate_status'];
                                    }
                                    $attendence_by_status =  $row1['attendence_by']; 
                                    $attendence_idd=  $row1['attendance_id'];
                                   
                            endforeach;
                        ?>
                        <td style="text-align: center;" attendanceid = "<?php echo $attendence_idd;?>" student_name = "<?php echo  $st_name; ?>" busAtt="<?php echo  $bus_status; ?>" gateAtt="<?php echo  $gate_status; ?>" classAtt="<?php echo  $status; ?>">
                             <?php if ($status == 1 && $bus_status==1 && $gate_status==1) { 

                                if($attendence_by_status == 1) {
                                  echo   ' <i class="entypo-record" style="color: #fad839;"></i>';
                                 
                                }elseif($attendence_by_status == 0){
                                    echo ' <i class="entypo-record" style="color: #00a651;"></i>';
                                }

                                ?>
                               
                               
                             <?php  }else if($status == 2 && $bus_status==2 && $gate_status==2)  { 
                                echo 1;?>
                                <i class="entypo-record" style="color: #ee4749;"></i>
							 <?php }else if($status == 1 && $bus_status!=1 && $gate_status != 1) {?>
							 <i class="entypo-record" style="color: #09B6BD;"></i>
							 <?php }elseif($status != 1 && $bus_status==1 && $gate_status != 1){ ?>
							 <i class="entypo-record" style="color: #e48306;"></i>
							 <?php } elseif($status != 1 && $bus_status==1 && $gate_status == 1){ ?>
							  <i class="entypo-record" style="color: #e48306;"></i>
							  <?php } elseif($status == 1 && $bus_status != 1 && $gate_status == 1){  ?>
							  <i class="entypo-record" style="color: #e48306;"></i>
							   <?php } elseif($status == 1 && $bus_status== 1 && $gate_status != 1){ ?>
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
    <a href="<?php echo site_url('admin/attendance_report_employee_print_view/' . $class_id . '/' . $section_id . '/' . $month . '/' . $sessional_year); ?>"
                   class="btn btn-primary" target="_blank">
    <?php echo get_phrase('print_attendance_sheet'); ?>
     </a>
   </center>
 </div>
</div>