<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&libraries=places"></script>
<style>
       
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      .route-container{
        /*z-index: 99999;*/
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      #map{
        height:58vh;
        width: 100%;
      }


        #section_holder {
          position: relative;
          z-index: 55;
        }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .map-close {
      background: #333;
      width: 20%;
      margin: 2% 0;
      text-align: center;
    }

      #target {
        width: 345px;
      }

      .route-container {
          position: relative;
          width: 100%;
          background: #fff;
          padding: 1%;
          border: 0px solid #eee;
          box-shadow:none;
          /*display: none;*/
        }

        body .widget-indicators{
          margin-top: 15px;
        }
    </style>

<?php $activeTab = "transport_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Transport Dashboard</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
</div>

<?php 


?>

<div class="container-fluid">
<!-- WIDGET SECTION STARTS HERE -->
  <div class="row">
      <div class="">
        <?php 
       $total_active =  $this->db->get_where('routes',array('status'=>1))->result();
       $total_member =  $this->db->get_where('student',array('transport_id'=>1))->result();
       $member_avg   =  "";
       if(count($total_member) != ""){
         $member_avg = count($total_member)/count($total_active);
         $member_avg =round($member_avg ,2);
       }
       $total_route_stops = array();
       foreach ($total_active as $key => $stops) {
        $route_stops =  $this->db->get_where('route_stops',array('route_id'=>$stops->id))->result();
        $total_route_stops[] = count($route_stops);
      }   
      
     
       
     ?>


      <div class="widget-indicators">
        <div class="indicator-item">

          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/list.png" style="max-height:40px;"></div>
          </div>

         <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="1646"><?php echo count($total_active);?></span>
            
          </div>
          <div class="indicator-value-title">Total NO. of routes</div>
        </div>


        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/stopwatch.png" style="max-height:40px;"></div>
          </div>
           <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-end="857"><?php   echo max($total_route_stops);  ?></span>
            
          </div>
          <div class="indicator-value-title">Highest route capacity  :  </div>
        </div>



        <div class="indicator-item">
          <div class="indicator-item-icon">
            <div class="icon"><img src="<?php echo base_url();?>assets/images/essay.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="1" data-end="17"><?php echo $member_avg;?></span>
           
          </div>
           <div class="indicator-value-title">AVG. No of members per route </div>
        </div>


        
        <div class="indicator-item">
          <div class="indicator-item-icon">
             <div class="icon"><img src="<?php echo base_url();?>assets/images/checklist.png" style="max-height:40px;"></div>
          </div>
          <div class="indicator-item-value"><span class="indicator-value-counter" data-toggle="counter" data-decimals="2" data-end="540" data-prefix="$"><?php echo count($total_active);?></span>
            
          </div>
          <div class="indicator-value-title">Currently Active Routes</div>

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
              <h4 class="panel-title"> <a data-toggle="collapse" data-expanded="true" aria-expanded="true" href="#hostel_info_chart" >Transport Route<span class="open-close pull-right in"><i class="fas fa-chevron-down"></i></span></a> </h4>
            </div>
            <div id="hostel_info_chart" class="panel-collapse collapse in" data-expanded="true">
              <div id="section_holder">
                <div class="col-md-6">

                    <div class="form-group">
                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('route_list'); ?></label>
                        <select name="route_id" id="route_id" class="form-control">
                            <option value="">Select Route</option>
                            <?php 
                              foreach($routelist as $route){   
                                ?>
                                <option value="<?php echo $route->vehicle_number; ?>" data-start_lng="<?= $route->source_long ?>" data-start_lat="<?= $route->source_lat ?>" data-end_lat="<?= $route->dest_lat ?>" data-end_lng="<?= $route->dest_long ?>" data-driver ="<?php echo $route->driver;?>"><?php echo $route->title;?> </option>
                                <?php
                              }
                            ?>
                        </select>
                    </div>

                </div>
            </div>

            <div class="route-container">
               <div id="map"></div>

               <div class="close">
                 close
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

<script>
    var selectedMode = 'DRIVING';
    var DriverMarker = false;
    var markers = [];
    var intervalId;
    
    function initialize() {
        var directionsRenderer = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 37.77, lng: -122.447}
        });
        directionsRenderer.setMap(map);
        
        directionsRenderer.setOptions({
            polylineOptions: {
                        strokeWeight: 4,
                        strokeOpacity: 1,
                        strokeColor:  'black' 
                    },
            suppressMarkers: true
        });
    
        document.getElementById('route_id').addEventListener('change', function(event) {
            var reLocation = true;
            if (intervalId) {
                clearInterval(intervalId);
                intervalId = false;
            }
            for (var i = 0; i < markers.length; i++) {
              markers[i].setMap(null);
            }
            if(DriverMarker){
                DriverMarker.setMap(null);
            }
            var option = event.target.options[event.target.selectedIndex].dataset;
            var start_lat = Number(option.start_lat);
            var start_lng = Number(option.start_lng);
            var end_lat = Number(option.end_lat);
            var end_lng = Number(option.end_lng);
            var vehicle_number = this.value;
            
            $.get("<?= base_url('transport/route/get_route_data/')?>"+vehicle_number, function(data, status){
                console.log(data);
                var obj = JSON.parse(JSON.stringify(data));
                if(obj.on_duty == '1'){
                    $.get("<?= base_url('transport/route/get_live_location/')?>"+obj.driver_id, function(live_location, status){
                            var live_location_obj = JSON.parse(JSON.stringify(live_location));
                            try {
                                if(live_location_obj.on_duty == '1'){
                                    var myLatLngForDriver = {lat: Number(live_location_obj.latitude), lng: Number(live_location_obj.longitude)};
                                    DriverMarker = new google.maps.Marker({
                                        position: myLatLngForDriver,
                                        map: map,
                                        icon: {
                                            scaledSize: new google.maps.Size(50, 50),
                                            url: "<?= base_url('/assets/images/icon/bus.webp') ?>"
                                        }
                                     });
                                     if ((!map.getBounds().contains(DriverMarker.getPosition())) && reLocation) {  
                                        map.setCenter(DriverMarker.getPosition());  
                                        reLocation = false;
                                    }
                                } else {
                                    if (intervalId) {
                                        clearInterval(intervalId);
                                        intervalId = false;
                                    }
                                }
                            } catch(err) {
                                console.log(err);
                                if (intervalId) {
                                    clearInterval(intervalId);
                                    intervalId = false;
                                }
                            }
                    });
                    intervalId = setInterval( function() {
                        $.get("<?= base_url('transport/route/get_live_location/')?>"+obj.driver_id, function(live_location, status){
                            var live_location_obj = JSON.parse(JSON.stringify(live_location));
                            try {
                                if(live_location_obj.on_duty == '1'){
                                    var myLatLngForDriver = {lat: Number(live_location_obj.latitude), lng: Number(live_location_obj.longitude)};
                                    DriverMarker = new google.maps.Marker({
                                        position: myLatLngForDriver,
                                        map: map,
                                        icon: {
                                            scaledSize: new google.maps.Size(50, 50),
                                            url: "<?= base_url('/assets/images/icon/bus.webp') ?>"
                                        }
                                     });
                                     if ((!map.getBounds().contains(DriverMarker.getPosition())) && reLocation) {  
                                        map.setCenter(DriverMarker.getPosition());  
                                        reLocation = false;
                                    }
                                } else {
                                    if (intervalId) {
                                        clearInterval(intervalId);
                                        intervalId = false;
                                    }
                                }
                            } catch(err) {
                                console.log(err);
                                if (intervalId) {
                                    clearInterval(intervalId);
                                    intervalId = false;
                                }
                            }
                        });
                    }, 10000 );
                } else {
                    if (intervalId) {
                        clearInterval(intervalId);
                        intervalId = false;
                    }
                }
            });
            
            directionsService.route({
              origin: {lat: start_lat, lng: start_lng},  // Haight.
              destination: {lat: end_lat, lng: end_lng},  // Ocean Beach.
              travelMode: google.maps.TravelMode[selectedMode]
            }, function(response, status) {
              if (status == 'OK') {
                directionsRenderer.setDirections(response);
                var leg = response.routes[ 0 ].legs[ 0 ];
                markers.push(new google.maps.Marker({
                    position: leg.start_location,
                    map: map,
                    icon: {
                        scaledSize: new google.maps.Size(50, 50),
                        url: "<?= base_url('/assets/images/icon/source_icon.webp') ?>"
                    }
                 }));
                 markers.push(new google.maps.Marker({
                    position: leg.end_location,
                    map: map,
                    icon: {
                        scaledSize: new google.maps.Size(50, 50),
                        url: "<?= base_url('/assets/images/icon/dest_icon.webp') ?>"
                    }
                 }));
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
        });
    }
  
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
