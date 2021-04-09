<div class="row">
         <div class="col-md-12">
             <style>
             #myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}

#my_table {
  border-collapse: collapse; /* Collapse borders */
  width: 100%; /* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 11px; /* Increase font-size */
  margin-bottom:60px;
}

.container table th,td{
    /*border: 2px solid grey;*/
    min-width: 55px;
    height:38px;
}

.attendance{
    border-radius: 39px;
    height: 38px;
    padding: 9px 2px;
    color:#fff;
}
.container table tbody td, .container table thead td{
    
}
#my_table tr.header, #my_table tr:hover {
  /* Add a grey background color to the table header and on hover */
  background-color: #f1f1f1;
}
             </style>
             <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
             
             <table class="table table-bordered my_table" id="my_table">
                 <thead>
                     
                     <tr>
                        <td style="text-align: center;">
                          <?php echo get_phrase('Employees'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
                        <td style="width:930px;float:left;"><div class="container" style="overflow-x:auto; width:100%"> <table>
                            <thead>
                                </thead></table></div></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $data = array();
                    if($class_id != 'all'){
                        $this->db->where('designation_id',$class_id);
                    }
                     $designations_data = $this->db->get_where('employees')->result_array();

                     
                    $primary_id = "id";

                   
                      foreach ($designations_data as $row):
                          $class_id = $row['designation_id']

                    ?>
                    <tr>
                        <td style="text-align: center;">
                        <?php echo $st_name = $row['name']; ?>
                        </td>
                         <td style="width:930px;float:left;"><div class="container" style="overflow-x:auto; width:100%;margin-top:-8px"> <table class="attendaceoveride">
                            <tbody>
                        <?php
                            $status      = 0;
                            $bus_status  = 0;
                            $gate_status = 0;
                            $attendence_by_status=0;
                            $start    = new DateTime($from);
                            $end      = (new DateTime($to))->modify('+1 day');
                            $interval = new DateInterval('P1D');
                            $period   = new DatePeriod($start, $interval, $end);
                            
                            foreach ($period as $dt) {
                                 $month=explode('-',$dt->format("d-m-Y"));
                                 $date = $month[0] . '-' . $month[1] . '-' . $month[2];
                               
 
                                 $timestamp = strtotime($date);

                                
                                //$this->db->group_by('timestamp');
                                $query = $this->db->get_where('attendance_employee', array( 'designation_id' => $class_id, 'timestamp' => $timestamp, 'employee_id' => $row[$primary_id]));

                               
                                $attendance= $query->result_array();
                                $numberrow = $query->num_rows();
                                $attendence_by_status = 0;
                                $status      = 0;
                                $bus_status  = 0;
                                $gate_status = 0;
                                $attendence_idd=  0 ;


                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);
                                    if ($month[0] == $month_dummy)
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
                                        $employee_id=  $row1['employee_id'];
                                   
                            endforeach;
                        ?>
                        <td style="text-align: center;" onclick="attendance(this)" attendanceid = "<?php echo $attendence_idd;?>" student_name = "<?php echo  $st_name; ?>" employee_id="<?= $row[$primary_id] ?>" designation_id="<?php echo  $class_id; ?>" timestamp="<?php echo  $timestamp; ?>" classAtt="<?php echo  $status; ?>">
                             <?php
                             $colorCode = '#FBC150;color:#000;';
                             if ($status == 1 && $bus_status==1 && $gate_status==1) { 

                                if($attendence_by_status == 1) {
                                  $colorCode="#09B6BD";
                                 
                                }elseif($attendence_by_status == 0){
                                    $colorCode = "#00a651";
                                }
                              }else if($status == 2 && $bus_status==2 && $gate_status==2)  { 
                                 $colorCode="#ee4749";
                                }else if($status == 1 && $bus_status!=1 && $gate_status != 1) {
							     $colorCode="#00a651";
							 }elseif($status != 1 && $bus_status==1 && $gate_status != 1){ 
							     $colorCode="#00a651";
							 } elseif($status != 1 && $bus_status==1 && $gate_status == 1){ 
							     $colorCode="#00a651";
							  } elseif($status == 1 && $bus_status != 1 && $gate_status == 1){
							  $colorCode ="#00a651";
							  } elseif($status == 1 && $bus_status== 1 && $gate_status != 1){ 
							  $colorCode = "#00a651";
                              }else if($status == 2){
                                $colorCode="#ee4749";
                              } $status = 0;?>
                             <span class="attendance" style="background:<?= $colorCode?>">
                                <?php echo $dt->format("d-m"); ?>
                            </span>
                        </td>
						
						
                    <?php } ?>
                    </tbody></table></div></td>
                <?php endforeach; ?>
            </tr>
        <?php ?>
        </tbody>
    </table>
   <center>
   </center>
 </div>
</div>
<script>
function attendance(ev){
            $('.attendancePopup').show();
            let current  = ev;
            let timestamp  = current.getAttribute('timestamp');
            let gateAtt  = current.getAttribute('gateAtt');
            let classAtt = current.getAttribute('classAtt');
            let busAtt   = current.getAttribute('busAtt');
            let designation_id   = current.getAttribute('designation_id');
            let student_name = current.getAttribute('student_name');
            let employee_id = current.getAttribute('employee_id');
            let attendanceid = current.getAttribute('attendanceid');
            
            $('.stdnt_nam').html(student_name);
            $('#attendanceid').val(attendanceid);
            $('#designation_id').val(designation_id);
            $('#employee_id').val(employee_id);
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
            } else if(classAtt == 2){
                $('.cAtt').html('Absent');
                $('.ca').prop("checked", true);
            } else {
                $('.cAtt').html('Not Marked');
                $('.ca').prop("checked", true);
            }   

            if(busAtt == 1){
                $('.bAtt').html('Present');
                $('.bp').prop("checked", true);
            } else{
                $('.bAtt').html('Absent');
                $('.ba').prop("checked", true);
            }   
        }

function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("my_table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
  $(".attendaceoveride tr").show();
  
}
</script>