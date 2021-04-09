<?php $activeTab = "student_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Student</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>


  <?php 
      $this->db->select('*');
      $this->db->from('class C');
      //$this->db->join('enroll E','C.class_id = E.class_id','left');
      //$this->db->join('student S','S.student_id = E.student_id','left');
      //$this->db->where('S.student_id = E.student_id');
      $this->db->group_by('C.class_id','ASC');
      $student_details = $this->db->get()->result();
        // echo "<pre>";
        //  print_r($student_details);
        // echo "</pre>";
        $studentdt = array();$count_student=0;$total_student =0;
       foreach ($student_details as $key => $class_dt) {
           $studentdt[] = $class_dt->name;
           $this->db->select('*');
           $this->db->from('attendance A');
           $this->db->where('MONTH(defult_date)', date('m')); //For current month
           $this->db->where('YEAR(defult_date)', date('Y'));
           $this->db->where('DAY(defult_date)', date('d'));
           $this->db->where("A.status = '1' ");
           $this->db->where('A.class_id',$class_dt->class_id);
           $attendace_parsent = $this->db->get()->result();
           $attendace_parsent_val = count($attendace_parsent);
          //print_r($attendace_parsent_val);
           //$parsent[] = $attendace_parsent_val;
           $total_student = $this->db->get_where('enroll',array('class_id'=>$class_dt->class_id,'year'=>$this->year))->result();
           $count_student = count($total_student);
           $parsentval = 0;$resultparsent = "";
           if(!empty($count_student) && !empty($attendace_parsent_val)) {
               $resultparsent    = (($attendace_parsent_val * 100)/ $count_student);
               $parsentval = round($resultparsent,2);

           }
           $parsent[] = $parsentval;
         
           //echo '('.$attendace_parsent_val ."* 100)/". $count_student;
           $absent[] = 100 - round($parsentval,2);
           
       }
     
       $data_['labels'] = $studentdt;
       $data_['datasets'] = array(array('label'=>'Present','backgroundColor'=>"#437D84",'data' => $parsent),array('label'=>'Absent','backgroundColor'=>"#83B8A5",'data' => $absent));
       $graph_data = json_encode($data_);
     
       ?>
       <input type="hidden" value='<?php echo $graph_data;?>' id="graph_data">


<div class="container-fluid" >

  <!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>
          
           <?php 
             $total_student_ = $this->db->get_where('enroll',array('year'=>$this->year))->result();

             $bal_total = 0;

             foreach ($total_student_ as $key => $amount_sum) {
               $balance_val = $this->db->get_where('student',array('student_id'=>$amount_sum->student_id))->row()->balance;
               $bal_total  = $bal_total + $balance_val;
             }
            $total_student_ = count($total_student_);
            $balance_total  = 0;$avrg_amount = 0;

            if(!empty($bal_total) && !empty($total_student_)) {
               $avrg_amount    = (($bal_total)/ $total_student_);
               $avrg_amount = round($avrg_amount,2);
            }


          ?>


          <div class="indicator-item-value">
            <span class="indicator-value-counter" data-toggle="counter" data-end="<?php echo $student_avrage;?>"><?php echo  $total_student_;?></span>
          </div>

           <div class="indicator-value-title">Total Students</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
           <?php 
           $this->db->select('*');
           $this->db->from('attendance A');
           $this->db->where('MONTH(defult_date)', date('m')); //For current month
           $this->db->where('YEAR(defult_date)', date('Y'));
           $this->db->where("A.status = '1' AND A.bus_status = '1' AND A.gate_status = '1'");
           $monthly_parsent = $this->db->get()->result();
           $montly_parsent_val = count($monthly_parsent);
           $monthlyparsent = 0;$monthlyparsent_ = "";
           if(!empty($total_student_) && !empty($montly_parsent_val)) {
               $monthlyparsent    = (($montly_parsent_val * 100)/ $total_student_);
               $monthlyparsent_ = round($monthlyparsent,2);
           }


          ?>

          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="157"><?php echo round($monthlyparsent_);?>%</span>
          </div>
           <div class="indicator-value-title">Average Monthly Attendance</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
           <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="<?php echo $avrg_amount;?>"> <?php echo round($avrg_amount);?></span>
            
          </div>
          <div class="indicator-value-title">Average Card Balance( INR)</div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
           <?php 
             $total_house  = $this->db->get('house_info')->result();
             $total_house_ = count($total_house);
          ?>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="<?php echo $total_house_;?>" data-prefix="$"><?php echo $total_house_;?> </span>
            
          </div>
           <div class="indicator-value-title">Total No of Houses</div>

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
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Student Dashboard <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span></a> </h4>

            </div>
            <div id="hostel_info_chart" class="panel-collapse collapse in" data-expanded="true">
              <canvas id="bar-chart" width="800" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- CHART SECTION BEGINS HERE -->


</div>

 
		<?php 
//       $this->db->select('*');
//       $this->db->from('enroll E');
//       $this->db->join('student S','S.student_id = E.student_id');
//      // $this->db->where('S.student_id','E.student_id');
//       $student_details = $this->db->get()->result();
// echo "<pre>";
//  print_r($student_details);
// echo "</pre>";
//        foreach ( $student_details as $key => $value) {
        
//        }
			 
		 //  $query = $this->db->query("SELECT count(*) as student_id , year from enroll GROUP BY year"); 

   //    $data['click'] = json_encode(array_column($query->result(), 'count'),JSON_NUMERIC_CHECK);
		
		 
			// $query2  = $this->db->query("SELECT count(*) as student_id , year from enroll GROUP BY year");
   //          $result2 = $query2->result_array();
			// $array = json_decode($result2, true);
   //          echo $array['student_id'];
   // 		    print_r($result2);
   //          foreach ($result2 as $row2) {
   //          echo  $parent_name = $row2['student_id'];  
   //         echo  $year = $row2['year'];  
   //     }
	   ?>
				
<!-- CHART JS FILES --> 
<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script> 


<script>
    var speed = 250;

    //var data_click = <?php echo $click; ?>;
    //var data_viewer = <?php echo $viewer; ?>;

    // {
    //       labels: ["Nursery", "1", "2", "3", "4","5","6","7","8","9","10","11","12"],
    //       datasets: [
    //         {
    //           label: "Present",
    //           backgroundColor: "#3e95cd",
    //           data: [25,29,34,16,34,25,32,19,26,24,32,26,25]
    //         }, {
    //           label: "Absent",
    //           backgroundColor: "#8e5ea2",
    //           data: [25,32,19,26,24,25,29,34,16,34,32,26,25]
    //         }
    //       ]
    //     }

     var graph_data = $('#graph_data').val();
     graph_data = JSON.parse(graph_data);
    // console.log(graph_data);

    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: graph_data,
        options: {
          legend: { 
              display: true,
              labels: {
                fontSize:16
              }
          },
          title: {
            display: true,
            text: '% of Attendance of student per grade',
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