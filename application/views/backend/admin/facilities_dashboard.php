<?php $activeTab = "facilities_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Facilities Dashboard</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/facilities_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>
<br>
<div class="container-fluid">
<!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="1646"><?php
          $this->db->select_sum('total_copies');
          $this->db->from('book');
          // $this->db->where('invoice_type' ,'fee' );
          // $this->db->where('paid_status' , 'paid');
          // $this->db->where('year' , $running_year);
          $query=$this->db->get();
          echo $data['total']=$query->row()->total_copies;      
                ?></span>
            
          </div>
          <div class="indicator-value-title">Total Books</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="857"><?php echo $number_of_leave_pending = $this->db->get_where('book_request', array('status' =>'0'))->num_rows();?></span>
           
          </div>
           <div class="indicator-value-title">Pending Book Issue Request</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17"><?php echo $number_of_leave_pending = $this->db->get_where('book_request', array('status' =>'1'))->num_rows();?></span>
           
          </div>
           <div class="indicator-value-title">Total Books Issued</div>

        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="540" data-prefix="$"><?php
          $this->db->select_sum('total');
          $this->db->from('geopos_invoices');
          // $this->db->where('invoice_type' ,'fee' );
          $this->db->where('status' , 'paid');
          // $this->db->where('year' , $running_year);
          $query=$this->db->get();
          $totalSales =  $data['total']=$query->row()->total;     
          $totalSales = accounts_format_number($totalSales);
          echo $totalSales[0];
            ?></span>
            
          </div>
          <div class="indicator-value-title">Total Canteen Sales(Rs)</div>

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
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Sales Information <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span></a> </h4>

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
			$query2    = $this->db->query("SELECT count(*) as total , invoiceduedate from geopos_invoices GROUP BY invoiceduedate Limit 5");
            $result2   = $query2->result_array();
			$query3    = $this->db->query("SELECT count(*) as amount , date from expenditures GROUP BY date Limit 5");
            $result3   = $query3->result_array();
		
		
			$students_num=array();
			$students_session=array();
              foreach ($result2 as $row2) {
				  array_push($students_num,$row2['total']);
				  array_push($students_session,$row2['invoiceduedate']);
           
            }
			$students_num1=array();
			//$students_session1=array();
              foreach ($result3 as $row2) {
		array_push($students_num1,$row2['amount']);
			 
            }
            $var=json_encode($students_num);
			$var1=json_encode($students_session);
			$var_male=json_encode($students_num1);
			$var_female=json_encode($students_num2);
?>
<!-- CHART JS FILES --> 
<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script> 
<script>
    var speed = 250;

    new Chart(document.getElementById("bar-chart"), {
      type: 'line',
        data: {
          labels: <?php echo $var1 ?>,
          datasets: [
            {
              label: "Sales",
              borderColor: "#48C5FF",
              data: <?php echo $var;?>,
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
            text: 'Total Sales ( Last 5 Days)',
             fontSize:16
          },
           animation: {
                duration: speed * 1.5,
                easing: 'linear'
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