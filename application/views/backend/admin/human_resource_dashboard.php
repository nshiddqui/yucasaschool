<?php $activeTab = "human_resource_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Human Resource</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/human_resource_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="container-fluid">

  <?php 
$number_of_certificate_apply_current_session = $this->db->get_where('apply_certificates', array('year'=>$running_year))->num_rows();
$number_of_leave_pending = $this->db->get_where('leave_request', array('status' =>'pending','year'=>$running_year))->num_rows();
$total_of_leave_accepted = $this->db->get_where('leave_request', array('year'=>$running_year))->num_rows();
$number_of_total_employee = $this->db->get_where('designation_users')->num_rows();
$number_of_total_accountant = $this->db->get_where('accountant')->num_rows();
$number_of_total_librarian = $this->db->get_where('librarian')->num_rows();
 $total_emp_list=$number_of_total_employee + $number_of_total_accountant + $number_of_total_librarian;
?>

 <!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="1646"><?php echo $total_emp_list ?></span>
            
          </div>
          <div class="indicator-value-title">Total Employees</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="857"><?php echo $total_of_leave_accepted ?></span>
            
          </div>
          <div class="indicator-value-title">Total Leave Requests</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17"><?php echo $number_of_certificate_apply_current_session ?></span>
            
          </div>
          <div class="indicator-value-title">Certificate Requests</div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
           <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="540" data-prefix="$"><?php echo $number_of_leave_pending ?></span>
            
          </div>
          <div class="indicator-value-title">Pending Leave Requests</div>

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
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Leave Request Graph <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span></a> </h4>

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

  <?php $month = date('m');?>
    new Chart(document.getElementById("bar-chart"), {
        type: 'pie',
        data: {
          labels: ["Accepted","Rejected","Pending"],
          datasets: [
            {
              label: "Leave Requests",
              backgroundColor: ["#48C5FF", "#C4ECFF","#48C5FF"],
              data: [<?php
$number_of_leave_accepted_current_session = $this->db->get_where('leave_request', array('status' =>'approved','year'=>$running_year))->num_rows();
echo $number_of_leave_accepted_current_session;
?>,<?php
$number_of_leave_reject_current_session = $this->db->get_where('leave_request', array('status' => 'reject','year'=>$running_year))->num_rows();
echo $number_of_leave_reject_current_session;
?>,<?php
$number_of_leave_pending_current_session = $this->db->get_where('leave_request', array('status' =>'pending','year'=>$running_year))->num_rows();
echo $number_of_leave_pending_current_session;
?>]
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
            text: 'Leave Requests',
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