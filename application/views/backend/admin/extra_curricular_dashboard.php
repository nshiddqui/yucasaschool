<?php $activeTab = "extra_curricular_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Extra Curricular Dashboard</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/extra_curricular_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<div class="container-fluid">
<!-- WIDGET SECTION STARTS HERE -->
  <!--<div class="row">
      <div class="">
      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

          <div class="indicator-item-value">
            <span class="indicator-value-counter" data-toggle="counter" data-end="<?php echo $student_avrage;?>">21</span>
          </div>

           <div class="indicator-value-title">Asset Categories</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="157">165</span>
          </div>
           <div class="indicator-value-title">Total Assets</div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17.9">19</span>
            
          </div>
          <div class="indicator-value-title">Assets </div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="78,450" data-prefix="$">54</span>
           
          </div>
           <div class="indicator-value-title">Assets Added( Last 1 Month)</div>

        </div>



      </div>
    </div>
  </div>-->
  
  <!-- WIDGET SECTION ENDS HERE -->

    <!-- CHART SECTION BEGINS HERE -->
    <div class="row">
    <div class="col-sm-12 p0">
      <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?> " id="hostel-info" >
        <div class="panel-group ">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Events Albums <span class="open-close pull-right in"><i class="fa fa-chevron-down"></i></span></a> </h4>

            </div>
            <div id="hostel_info_chart" class="panel-collapse collapse in" style="height:610px" data-expanded="true">
              <div class="facebook_album_gallery">

    <div class="row ">
       <?php/*
           	 $system_name =$this->db->get_where('facebook_settings')->row()->access_token;
	$access_token=$system_name;
$url = "https://graph.facebook.com/v3.2/139476747068972/albums?access_token=$access_token";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
	$parsed_json = json_decode($contents);
	foreach($parsed_json->data as $mydata)

    {
        $album_id=$mydata->id;
		 $name=$mydata->name;
 
$url2 = "https://graph.facebook.com/v3.2/$album_id/photos?access_token=$access_token&fields=url,source,message,description";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url2);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents22 = curl_exec($ch);
$contents22 = json_decode($contents22);
$source=$contents22->data[0]->source;
		
		echo '<div class="facebook_album col-sm-4">
            <div class="img">
                <img src="'.$source.'" alt="'.$name.'" style="
    height: 150px;
">
            </div>
        </div>';
}*/
?>
 
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook&tabs=timeline&width=1200&height=600&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" style="border:none;overflow:hidden;width:100%;height:700px;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

    

    </div>

</div>
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
          labels: ['May','June','July','August','October'],
          datasets: [
            {
              label: "Events",
              borderColor: "#14838F",
              data: [12,5,11,21,18],
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
            text: 'Number Of Events( Last 5 Months)',
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
