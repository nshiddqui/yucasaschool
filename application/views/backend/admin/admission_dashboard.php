<?php $activeTab = "admission_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Admission</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/admission_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
 <?php 
 $graphdata = $this->db->query("SELECT count(*) as student_id , year from enroll GROUP BY year")->row();  ?>
        
  
<div class="container-fluid">

  <!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <div class="indicator-item-value">
            <span class="indicator-value-counter" data-toggle="counter" data-end="<?php echo $student_avrage;?>"><?php
                            $number_of_student_in_current_session = $this->db->get_where('enroll', array('year' => $running_year))->num_rows();
                            echo $number_of_student_in_current_session;
                            
                          ?></span>
          </div>

           <div class="indicator-value-title">New Admission This Session</div>
        </div>
        

        <?php  
     $pre_student_reg=$this->db->get_where('settings' , array('type'=>'registration_fees'))->row()->description;       $number_of_student_in_current_session = $this->db->get_where('pre_enroll', array('year' => $running_year))->num_rows();
    $due_fee=$pre_student_reg * $number_of_student_in_current_session;
    ?>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="157"><?php echo $due_fee ;?></span>
          </div>
           <div class="indicator-value-title">Registration Fees Due</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17.9"><?php echo $number_of_student_in_current_session ?></span>
            
          </div>
          <div class="indicator-value-title">Total Pre Exam Registrations</div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="78,450" data-prefix="$">
              	<?php $school_session_end_date        =	$this->db->get_where('settings' , array('type'=>'school_session_end_date'))->row()->description; ?>
              	
              <?php
              
              $now = time(); // or your date as well
$your_date = strtotime("$school_session_end_date");
$datediff = $your_date -$now ;

echo round($datediff / (60 * 60 * 24));
              ?>
              </span>
           
          </div>
           <div class="indicator-value-title">Days to Next Session</div>

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

<!-- CHART JS FILES --> 
<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script> 
          <?php         
      $query2    = $this->db->query("SELECT count(*) as student_id , year from enroll GROUP BY year");
            $result2   = $query2->result_array();
      
      $query3    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='male' GROUP BY year");
            $result3   = $query3->result_array();
      
      $query4    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='female' GROUP BY year");
            $result4   = $query4->result_array();
      //print_r($result2);
      $students_num=array();
      $students_session=array();
              foreach ($result2 as $row2) {
          array_push($students_num,$row2['student_id']);
          array_push($students_session,$row2['year']);
              // echo  $parent_name = $row2['student_id'];  
              // echo  $year = $row2['year'];  
            }
      $students_num1=array();
      //$students_session1=array();
              foreach ($result3 as $row2) {
          array_push($students_num1,$row2['student_id']);
         // array_push($students_session1,$row2['year']);
              // echo  $parent_name = $row2['student_id'];  
              // echo  $year = $row2['year'];  
            }
      $students_num2=array();
      //$students_session2=array();
              foreach ($result4 as $row2) {
          array_push($students_num2,$row2['student_id']);
          //array_push($students_session3,$row2['year']);
              // echo  $parent_name = $row2['student_id'];  
              // echo  $year = $row2['year'];  
            }
  ?>

<script>
<?php 
            $var=json_encode($students_num);
      $var1=json_encode($students_session);
      $var_male=json_encode($students_num1);
      $var_female=json_encode($students_num2);
?>
    var speed = 250;

    new Chart(document.getElementById("bar-chart"), {
        type: 'line',
        data: {
          labels: <?php echo $var1;?>,
          datasets: [
            {
              label: "Girls",
              borderColor: "#437D84",
              data: <?php echo $var_female;?>,
        backgroundColor: "rgba(240, 144, 79, 0.4)",
        fillOpacity:.5,
        fill:false
        
            },
            {
              label: "Boys",
              borderColor: "#57D1A4",
              data: <?php echo $var_male;?>,
        backgroundColor: "rgba(244, 67, 54, 0.4)",
        fillOpacity:.5,
        fill:false
        
            },
      {
              label: "Total",
              borderColor: "#48C5FF",
              data: <?php echo $var;?>,
        backgroundColor: "rgba(71, 197, 255, 0.4)",
        fillOpacity:.5,
        fill:false
        
            }
          ]
          
        },
        options: {
          legend: { 
              display: true,
              labels: {
                // This more specific font property overrides the global property
                fontSize:16
            }
 
              
          },
          title: {
            display: true,
            text: 'Number of students admitted last 3 years',
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
