<?php $activeTab = "assets_management_dashboard"; ?>

<?php 
   $assignment_issue = $this->db->get_where('asset_category',array('status'=>1))->result();
  $assets = $this->db->get_where('asset',array('status'=>1))->result();
  
    $assets_last_month = $this->db->query('SELECT * FROM asset  WHERE YEAR(defult_date) = YEAR(defult_date - INTERVAL 1 MONTH)')->result();
  

    $counts = $this->db->query('SELECT SUM(number_asset)as total FROM  asset')->result();
 

?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Assets Management</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/assets_management_nav_tab.php'; ?> 
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

          <div class="indicator-item-value">
            <span class="indicator-value-counter" data-toggle="counter" data-end="<?php  echo count($assignment_issue);?>"><?php echo count($assignment_issue);?></span>
          </div>

           <div class="indicator-value-title">Asset Categories</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="157"><?php echo $counts[0]->total; ?></span>
          </div>
           <div class="indicator-value-title">Total Assets</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17.9"><?php echo count($assets);?></span>
            
          </div>
          <div class="indicator-value-title">Assets </div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="78,450" data-prefix="$"><?php echo count($assets_last_month); ?></span>
           
          </div>
           <div class="indicator-value-title">Assets Added( Last 1 Month)</div>

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
      $query2    = $this->db->query("SELECT * from asset_category");
      $result2   = $query2->result_array();
      
      $query3    = $this->db->query("SELECT sum(number_asset) as total  from asset left join asset_category on asset_category.asset_category_id=asset.category GROUP BY asset.category");
      $result3   = $query3->result_array();
      
    
        $students_num=array();
        $students_session=array();
        foreach ($result2 as $row2) {
        array_push($students_session,$row2['category']);
            }
        $students_num1=array();
        foreach ($result3 as $row2) {
        array_push($students_num1,$row2['total']);
            }
    
      $var1=json_encode($students_session);
      $var_male=json_encode($students_num1);
 
  ?>

<!-- CHART JS FILES --> 
<script src="<?php echo base_url('assets/js/moment.js');?>"></script> 
<script src="<?php echo base_url('assets/js/Chart.bundle.min.js');?>"></script> 
<script>
    var speed = 250;

    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
          labels: <?php echo $var1;?>,
          datasets: [
            {
              label: "Assets Number",
              backgroundColor: ["#2D7D86", "#7FC5AB","#2D7D86", "#7FC5AB","#2D7D86", "#7FC5AB" ],
              data: <?php echo $var_male;?>
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
            text: 'Number Of Assets per Category - Top 7',
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