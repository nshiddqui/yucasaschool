<?php $activeTab = "scholarship_management_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Scholarship Management Dashboard</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/scholarship_management_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="container-fluid">
<!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="1646">1646</span>
            
          </div>
          <div class="indicator-value-title">Total Students Registered</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
         <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="857">857</span>
            
          </div>
          <div class="indicator-value-title">Total Student (2018)</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17">17</span>
            
          </div>
          <div class="indicator-value-title">Total Pre Exam Registration</div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="540" data-prefix="$">540</span>
            
          </div>
          <div class="indicator-value-title">Total Pre Exam</div>

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
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Events Information <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span></a> </h4>

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
<script>
    var speed = 250;



    new Chart(document.getElementById("bar-chart"), {
      type: 'line',
        data: {
          labels: ["2015","2016", "2017", "2018", "2019"],
          datasets: [
            {
              label: "Student Registered For Scholarship Exams",
              borderColor: "#48C5FF",
              data: [115,93,165,75,122],
              fill: false
            },

            {
              label: "Students Recieved Scholarship",
              borderColor: "#F0904F",
              data: [15,18,7,26,36],
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
            text: 'Student Registered Vs Student Recieved',
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