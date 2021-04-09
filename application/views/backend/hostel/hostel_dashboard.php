<style>
  body .widget-indicators{
          margin-top: 15px;
        }
</style>
<?php $activeTab = "hostel_dashboard"; ?>

<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Hostel</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

  <!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/hostel_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>



<div class="container-fluid hidden" >
        <div class="row">
            <ul  class="nav nav-tabs ed">
                <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#hostel-info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> Hostel Information</a> </li>
                <?php if(has_permission(ADD, 'hostel', 'hostel')){ ?>
                
                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#hostel-attendance"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> Hostel Attendance</a> </li>                          
                <?php } ?>                
            </ul>
        </div>
    </div>

<div class="container-fluid">
<!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">

         <?php
  $number_of_total_hostel = $this->db->get_where('hostels',array('status' =>1))->num_rows();
  $total_no_of_student = $this->db->get_where('student',array('status' =>1))->num_rows();
  $number_of_total_member_in_hostel = $this->db->get_where('hostel_members')->num_rows();
  $room_change_member_no = $this->db->get_where('room_change_request',array('year' =>$running_year,'room_status'=>'pending'))->num_rows();
  $total_hostel_room_capacity = $this->db->get_where('rooms',array('total_seat' =>1))->num_rows();

  ?>
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

         <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="36">
     
        <?php echo $number_of_total_hostel; ?>
      </span>
            
          </div>
          <div class="indicator-value-title">Total Hostels</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
         <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="157">
  
      <?php //echo $total_hostel_room_capacity 
$this->db->select_sum('total_seat');
$this->db->from('rooms');
$query=$this->db->get();
echo $data['total']=$query->row()->total_seat;      
      ?></span>
            
          </div>
          <div class="indicator-value-title"> Total Hostel Capacity</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17.9"><?php echo $number_of_total_member_in_hostel?></span>
           
          </div>
           <div class="indicator-value-title">Total Members</div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
           <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="78,450" data-prefix="$"><?php echo $room_change_member_no ?></span>
           
          </div>
           <div class="indicator-value-title">Pending Room Switch Request</div>

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
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Hostel Information <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span></a> </h4>
            </div>
            <div id="hostel_info_chart" class="panel-collapse collapse in" data-expanded="true">
              <canvas id="bar-chart" style="width:80vw;height:65vh;"></canvas>
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
			$query2    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.is_hostel_member=1 GROUP BY year");
            $result2   = $query2->result_array();
			
			$query3    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='male'  AND student.is_hostel_member=1 GROUP BY year");
            $result3   = $query3->result_array();
			
			$query4    = $this->db->query("SELECT count(*) as student_id , year from enroll left join student on student.student_id=enroll.student_id where student.sex='female' AND student.is_hostel_member=1 GROUP BY year");
            $result4   = $query4->result_array();	
			$students_num=array();
			$students_session=array();
              foreach ($result2 as $row2) {
				  array_push($students_num,$row2['student_id']);
				  array_push($students_session,$row2['year']);              
            }
			$students_num1=array();
              foreach ($result3 as $row2) {
				  array_push($students_num1,$row2['student_id']);				 
            }
			$students_num2=array();
              foreach ($result4 as $row2) {
				  array_push($students_num2,$row2['student_id']);				
            }
	?>



<script>
    var speed = 250;
<?php 
            $var=json_encode($students_num);
			$var1=json_encode($students_session);
			$var_male=json_encode($students_num1);
			$var_female=json_encode($students_num2);
?>
    
    new Chart(document.getElementById("bar-chart"), {
      type: 'line',
        data: {
          labels: <?php echo $var1;?>,
          datasets: [
            {
              label: "Total",
              borderColor: "#568187",
              data: <?php echo $var;?>,
              fill: false
            },

            {
              label: "Females",
              borderColor: "#7FC5AB",
              data: <?php echo $var_female;?>,
              fill: false
            },
            {
              label: "Males",
              borderColor: "#568187",
              data:<?php echo $var_male;?>,
              fill: false
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
            text: 'Hostel Occupancy Rate',
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