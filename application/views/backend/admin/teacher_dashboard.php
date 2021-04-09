<?php $activeTab = "teacher_dashboard"; ?>
<?php  $month = date('m');?>
<?php $year = date('Y');?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Teacher Dashboard</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/teacher_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="container-fluid">
<!-- WIDGET SECTION STARTS HERE -->
<?php
  $number_of_student_in_current_session = $this->db->get_where('teacher',array('status' =>1))->num_rows();

$number_of_teacher_in_current_session = $this->db->get_where('emp_attendance', array('status' => 2,'role_id'=>5,'MONTH(default_time)' =>$month,'YEAR(default_time)' =>$year))->num_rows();

  ?>

  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="<?php echo $number_of_student_in_current_session; ?>">
                                               <?php echo $number_of_student_in_current_session; ?>
                                 </span>
          </div>
          <div class="indicator-value-title">TOTAL NO. OF TEACHERS</div>

        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="<?php echo $number_of_teacher_in_current_session; ?>"><?php echo $number_of_teacher_in_current_session; ?></span>
          </div>
          <div class="indicator-value-title">Teachers Absent Average (Per Week)</div>

        </div>

        

        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
           <?php 
       $academic_year = $this->db->get_where('settings' , array('type' => 'school_start_time'))->row()->description;
   
          $number_of_teacher= $this->db->query("SELECT * FROM `emp_attendance` where  DATE_FORMAT(`default_time`, '%H:%i:%s') < '$academic_year'  AND default_time >= (NOW() - INTERVAL 1 MONTH) AND status=1")->num_rows();
      ?>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17"><?php  echo $number_of_teacher; ?></span>
           
          </div>
           <div class="indicator-value-title">Teacher Arriving Late( %)</div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
         <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="540" data-prefix="$">
        
<?php $query= $this->db->query("SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(default_time))) AS avg_time FROM emp_attendance where MONTH(default_time) = MONTH(CURDATE()) AND status=1");
 $result  = $query->result_array();
  foreach ($result as $row) {
      $avg_teacher_time=$row['avg_time'];
      echo date("h:i", strtotime("$avg_teacher_time"));
     }?>
     </span>
            
          </div>

          <div class="indicator-value-title">Average Entry Time (<?php echo date("a", strtotime("$avg_teacher_time")); ?>)</div>

        </div>



      </div>
    </div>
  </div>
  
  <!-- WIDGET SECTION ENDS HERE -->

  <!-- CHART SECTION BEGINS HERE -->
      <div class="row">
    <div class="col-sm-12 p0">
      <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?> " id="hostel-info" >
        <div class="panel-group ">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Admission Information <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span></a> </h4>

            </div>
            <div id="hostel_info_chart" class="panel-collapse collapse in" data-expanded="true">
              <canvas id="bar-chart" style="width:80vw;height:60vh;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- CHART SECTION BEGINS HERE -->

</div>

<?php

$total_no_of_teachers = $this->db->get_where('teacher', array('status' => 1))->num_rows();

$number_of_teacher_present_privious_month = $this->db->get_where('emp_attendance', array('status' => 1,'role_id'=>5,'MONTH(default_time)' =>$month))->num_rows();

?>
<?php
$number_of_teacher_absent_privious_month = $this->db->get_where('emp_attendance', array('status' => 2,'role_id'=>5,'MONTH(default_time)' =>$month))->num_rows();

?>
<!-- CHART JS FILES --> 
<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script> 
<script>
    var speed = 250;


    new Chart(document.getElementById("bar-chart"), {
        type: 'pie',
		responsive:true,
        data: {
          labels: ["Present","Absent"],
          datasets: [
            {
              label: "Teacher Attendance ",
              backgroundColor: ["#437D84", "#7FC5AB"],
              data: [<?php echo $number_of_teacher_present_privious_month ?>,<?php echo $number_of_teacher_absent_privious_month ?>]
            }
          ]
        },
        options: {
          legend: { 
              display: true,
              labels: {
              fontSize:16
              }
        },
          title: {
            display: true,
            text: 'Last Month Attendance By Teacher ',
            fontSize:16
          },
           animation: {
                duration: speed * 1.5,
                easing: 'linear'
              },
            scales: {
                yAxes: [{
                    ticks: {
                        fontSize: 16
                    }
                }],
                
                xAxes: [{
                    ticks: {
                        fontSize: 16
                    }
                }]
            }


        }
    });
</script>