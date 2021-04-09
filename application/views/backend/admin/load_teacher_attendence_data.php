<div class="row">
         <div class="col-md-12">
             <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
             <table class="table table-bordered" id="my_table">
                 <thead>
                     <tr>
                        <td style="text-align: center;">
                          <?php echo get_phrase('teacher'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
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
                        $teachers = $this->db->get_where('teacher')->result_array();
                        foreach ($teachers as $row):
                    ?>
                <tr>
                        <td style="text-align: center;">
                    <?php echo $row['name']; ?>
                        </td>
                        <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . $sessional_year);
                                //$this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('emp_attendance', array( 'year' => $running_year, 'timestamp' => $timestamp, 'emp_id' => $row['teacher_id']))->result_array();
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
                             <?php  } $status = 0;?>
                        </td>
                    <?php } ?>
                <?php endforeach; ?>
            </tr>
        <?php ?>
        </tbody>
    </table>
   <center>
    <a href="<?php echo site_url('admin/attendance_report_print_view/' . $month . '/' . $sessional_year); ?>"
                   class="btn btn-primary" target="_blank">
    <?php echo get_phrase('print_attendance_sheet'); ?>
     </a>
   </center>
 </div>
</div>
<script>
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
}
</script>