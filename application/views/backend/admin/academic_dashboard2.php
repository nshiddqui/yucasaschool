<?php $activeTab = "academic_dashboard"; ?>

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
<?php include base_path().'application/views/backend/navigation_tab/academic_nav_tab.php'; ?> 
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
  <div class="row">
    <div class="col-sm-7 pl0">
      <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?> " id="hostel-info" >
        <div class="panel-group ">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" > <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span>Academic Dashboard </a> </h4>
            </div>
            <div id="hostel_info_chart" class="panel-collapse collapse in" data-expanded="true">
              <canvas id="bar-chart" width="800" height="450"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-5 p0">
      <div class="widget-indicators">
        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><span class="s7-home"></span></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="36">13</span>
            <div class="indicator-value-title">Average Class Strength</div>
          </div>
        </div>
        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><span class="s7-users"></span></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="157">157</span>
            <div class="indicator-value-title">No. Of Syllabus Delayed</div>
          </div>
        </div>
        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><span class="s7-id"></span></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17.9">25</span>
            <div class="indicator-value-title">Assignment Issued Currently</div>
          </div>
        </div>
        
        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><span class="s7-home"></span></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="78,450" data-prefix="$">20</span>
            <div class="indicator-value-title">Student With Less Than 50%</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<!-- <div>
    <a href="" onclick="loadpage(); return false;">Load Page</a>
</div> -->
</div>

<!-- CHART JS FILES --> 
<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script> 
<script>
    var speed = 250;

  
    new Chart(document.getElementById("bar-chart"), {
      type: 'horizontalBar',
        data: {
          labels: ["Nursery", "1", "2", "3", "4","5","6","7","8","9","10","11","12"],
          datasets: [
            {
              label: "Present",
              backgroundColor: "#3e95cd",
              data: [25,29,34,16,34,25,32,19,26,24,32,26,25]
            }, {
              label: "Absent",
              backgroundColor: "#8e5ea2",
              data: [25,32,19,26,24,25,29,34,16,34,32,26,25]
            }
          ]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: 'Pass Fail Comparison - Classwise'
          },
           animation: {
                duration: speed * 1.5,
                easing: 'linear'
              }


        }
    });
</script>