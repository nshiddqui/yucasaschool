<style>
body .widget-indicators .indicator-item-value span{
  font-size: 24px;
}
</style>
<?php $activeTab = "accounts_payroll_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Accounts & Payroll</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/accounts_payroll_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="container-fluid">
<!-- WIDGET SECTION STARTS HERE -->
  <?php 
$duefee = $this->db->query("select sum(net_amount) as sum_amount ,count(*) as count from invoices where paid_status = 'unpaid'")->row(); 

$number_of_leave_pending = $this->db->get_where('leave_request', array('status' =>'pending','year'=>$running_year))->num_rows();
$total_of_leave_accepted = $this->db->get_where('leave_request', array('year'=>$running_year))->num_rows();
$number_of_total_employee = $this->db->get_where('designation_users')->num_rows();
$number_of_total_accountant = $this->db->get_where('accountant')->num_rows();
$number_of_total_librarian = $this->db->get_where('librarian')->num_rows();
 $total_emp_list=$number_of_total_employee + $number_of_total_accountant + $number_of_total_librarian;
  
?>
  <div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="1646"><?php
          $this->db->select_sum('net_amount');
          $this->db->from('invoices');
          $this->db->where('invoice_type' ,'fee' );
          $this->db->where('paid_status' , 'paid');
          $this->db->where('year' , $running_year);
          $query=$this->db->get();
          $data['total']=$query->row()->net_amount;
          $fee_recievable =  number_format((float)$data['total'], 0, '.', '');

          $fee_recievable = accounts_format_number($fee_recievable);
          echo $fee_recievable[0];
          ?></span>
          <div class="indicator-value-title">Total Fees Recievable(
            <?php echo $fee_recievable[1]; ?>
           )</div>
          </div>
           
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="857"><?php
            $this->db->select_sum('net_amount');
            $this->db->from('invoices');
             $this->db->where('invoice_type' ,'fee' );
             $this->db->where('paid_status' , 'unpaid');
             $this->db->where('year' , $running_year);
            $query=$this->db->get();
             $data['total']=$query->row()->net_amount;
            $overdue_fee = number_format((float)$data['total'], 0, '.', '');
            $overdue_fee = accounts_format_number($overdue_fee);
            echo $overdue_fee[0];
      ?></span>
            <div class="indicator-value-title">Overdue Fees(<?php echo $overdue_fee[1]; ?>)</div>
          </div>
          
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17"><?php $query = $this->db->select('AVG(amount) as average_amount')->from('expenditures')->get();
             $query->row()->average_amount;
             $data['total']=$query->row()->average_amount;  
            $monthly_avg = number_format((float)$data['total'], 0, '.', '');
            $monthly_avg = accounts_format_number($monthly_avg);
            echo $monthly_avg[0];
            ?></span>
              <div class="indicator-value-title">Monthly Average Expense(<?php echo $monthly_avg[1];?>)</div>
          </div>
        
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="540" data-prefix="$"><?php
          $this->db->select_sum('net_salary');
          $this->db->from('salary_payments');

           $this->db->where('academic_year_id' , $running_year);
          $query=$this->db->get();
           $data['total']=$query->row()->net_salary;  
          $salary_payable =  number_format((float)$data['total'], 0, '.', '');
          $salary_payable = accounts_format_number($salary_payable);
            echo $salary_payable[0];
      ?></span>
            <div class="indicator-value-title">Salary Payable(<?php echo $salary_payable[1]; ?>)</div>
          </div>

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
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Accounts Dashboard <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span></a> </h4>

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
			$query2    = $this->db->query("SELECT count(*) as net_amount , month from invoices GROUP BY month Limit 5");
            $result2   = $query2->result_array();
			$query3    = $this->db->query("select sum(amount) as amount ,count(*) as count from expenditures GROUP BY date Limit 5");
			//$query3    = $this->db->query("SELECT count(*) as amount , date from expenditures GROUP BY date Limit 5");
            $result3   = $query3->result_array();
		
			
			$query4    = $this->db->query("select sum(net_amount) as sum_amount ,count(*) as count from invoices GROUP BY month Limit 5");
            $result4   = $query4->result_array();
			//print_r($result2);
			$students_num=array();
			$students_session=array();
              foreach ($result2 as $row2) {
				  array_push($students_num,$row2['net_amount']);
				  array_push($students_session,$row2['month']);
           
            }
			$students_num1=array();
			//$students_session1=array();
              foreach ($result3 as $row2) {
				  array_push($students_num1,$row2['amount']);
			 
            }
			$students_num2=array();
			//$students_session2=array();
              foreach ($result4 as $row2) {
				  array_push($students_num2,$row2['sum_amount']);
		 
            }
	?>
<?php 
      $var=json_encode($students_num);
			$var1=json_encode($students_session);
			$var_male=json_encode($students_num1);
			$var_female=json_encode($students_num2);
?>
<script>
    var speed = 250;



    new Chart(document.getElementById("bar-chart"), {
      type: 'line',
        data: {
          labels: <?php echo $var1;?>,
          datasets: [
            {
              label: "Income",
              borderColor: "#14838F",
              data: <?php echo $var_female;?>,
              fill: true
            },

            {
              label: "Expense",
              borderColor: "#7FC5AB",
              data: <?php echo $var_male;?>,
              fill: true
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
            text: 'Income Vs Expense ( Last 5 Months)',
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
