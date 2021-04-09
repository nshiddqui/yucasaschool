<style>
       
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
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
        height: 70vh;
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

      /*#title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }*/
      #target {
        width: 345px;
      }

      .map-container {
          position: fixed;
          width: 70%;
          left: 15%;
          top: 5%;
          background: #fff;
          padding: 1%;
          border: 1px solid #eee;
          box-shadow: 0 7px 15px rgba(0,0,0,.15);
          display: none;
        }
    </style>

<?php $activeTab = "transport"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Facilities</a></li>
        <li class="active">Transport</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/parent/facilities_nav_tab.php'; ?>
<!-- Including Navigation Tab -->
</div>

<div class="student_select_filter">
    <div class="row">
        <div class="col-sm-4  ">
            <div class="form-group">
                <label>Select Student : </label>
                <select class="select2 student_select">
                    <option value="">Select Student</option>
                     <?php
                    $class_id= $this->uri->segment(3);
                   //$children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                  $parent_id= $this->session->userdata('parent_id');
                   $children_of_parent= $this->db->query("SELECT * FROM student LEFT JOIN enroll ON student.student_id=enroll.student_id where student.parent_id=$parent_id AND year='$running_year'")->result_array();
                    ;
                      foreach ($children_of_parent as $row):
                   ?>
                              <option value="<?php echo $row['class_id'];?>"<?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name'];?></option>
                        <?php endforeach;?>  
                   
                   
                </select>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
	<div class="col-md-12">
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" >
                	<thead>
                		<tr>
                            <th><div><?php echo get_phrase('student_name');?></div></th>
                    		<th><div><?php echo get_phrase('route_name');?></div></th>
                    		<th><div><?php echo get_phrase('number_of_vehicle');?></div></th>
                    		<th><div><?php echo get_phrase('location');?></div></th>
                            <th><div><?php echo get_phrase('action');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
                       /* echo "<pre>";
                          print_r($transports);
                        echo "</pre>";*/
                         $count = 1;foreach($transports as $row):
                         $vehicles_details_ = $this->db->get_where('vehicles',array('id' => $row->vehicle_ids))->row();
                         ?>
                         <tr>
                            <td><?php echo $row->name;?></td>
              							<td><?php echo $row->title;?></td>
              							<td><?php echo $vehicles_details_->number;?></td>
              							<td>
                            <?php if($row -> stop_details != ""){ 
                                $md = json_decode($row -> stop_details);
                                $ms = array();
                                 //print_r($md); 
                                    for($i = 0; $i < sizeof($md) - 1; $i++) {
                                        $ms[$i] = json_decode($md[$i]); 
                                        $ms[$i] -> lat = $ms[$i] -> lat .'';
                                        $ms[$i] -> lng = $ms[$i] -> lng .'';
                                        $ms[$i] -> distance = $ms[$i] -> distance .'';
                                    }
                                    //$md = json_decode($md[0]);
                                    $ms;
                                    /*echo "<pre>";
                                        print_r($ms);
                                    echo "</pre>";*/

                                    $arr = array();
                                    $arr2=array();
                                    $k=1;
                                    $arr2[$k] = $row->source_lat.','.$row->source_long;
                                      foreach ($ms as $key => $dt) {
                                        $k++;
                                        $arr[] = $dt->lat.'%2C'.$dt->lng;
                                        if($k<=count($ms)+1){
                                        $arr2[$k] = $dt->lat.','.$dt->lng;
                                      }
                                    }
                                    $waypointss = implode('%7C',$arr);
                                    $arr2[$k+1] = $row->dest_lat.','.$row->dest_long;
                                    // echo "<br>";
                                    $origin  = $row->source_lat.'%2C'.$row->source_long.'&destination='.$row->dest_lat.'%2C'.$row->dest_long.'&waypoints='.$waypointss;
                                    ?>
                                    <?php

                                     $url = "https://maps.googleapis.com/maps/api/directions/json?origin=".$origin."&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4";
                                                $ch = curl_init();
                                                curl_setopt ($ch, CURLOPT_URL, $url);
                                                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
                                                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                                                $contents = curl_exec($ch);
                                                if (curl_errno($ch)) {
                                                  echo curl_error($ch);
                                                  echo "\n<br />";
                                                  $contents = '';
                                                } else {
                                                  curl_close($ch);
                                                }

                                                if (!is_string($contents) || !strlen($contents)) {
                                                echo "Failed to get contents.";
                                                $contents = '';
                                                }

                                                //echo $contents;


                                               // $jsonData = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin='.$origin.'&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4'));
                                                $jsonData = json_decode($contents);

                                    //$jsonData = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin='.$origin.'&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4'));
                                    $var=$jsonData->routes[0]->overview_polyline->points;
                                    $err=json_decode(json_encode($arr2,false));
                                    ?>
                                     <a class="" > </a>
                                     <button type="button" style="color:#000" class="btn btn-warning" id="route_list" data-driver ="<?php echo $vehicles_details_->driver;?>" onclick="getliveroute(this)" data-id='<?php echo json_encode($err);?>' data-name="<?php echo $var;?>" ><i class="fa fa-map-marker"></i> <?php echo get_phrase('location'); ?></button>
                                    <?php }else{ ?>
                                        <p>Not Available</p>
                                    <?php } ?>
                            </td>
                            <td>
                                <a href="#"  onclick="showAjaxModal('<?php echo site_url('modal/popup/get-single-route/'.$row->id.'/'.$row->transport_stop);?>');"  class="btn btn-success" > View Route List</a>
                            </td>
						 </tr>

                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS-->
            
            
			
            
		</div>
	</div>
</div>

<div class="map-container">
   <div id="map"></div>
    <div class="col-sm-12">
        <div class="map-close btn btn-success pull-right">close</div>
    </div>
</div>


 <script>
    // This example creates an interactive map which constructs a polyline based on
    // user clicks. Note that the polyline only appears once its path property
    // contains two LatLng coordinates.
    var poly;
    var map;
    markers_val_ =  [ ];
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 28.668502452598734, lng: 77.2193798407227}  // Center the map on Chicago, USA.
        });
        //28.668502452598734, 77.2193798407227
       
        // Add a listener for the click event
       // map.addListener('click', addLatLng);
     }



      // Handles click events on a map, and adds a new point to the Polyline.
      function addLatLng(event,markers_arr) {
        if(event != ""){
         poly = new google.maps.Polyline({
          strokeColor: '#000',
          strokeOpacity: 1.0,
          strokeWeight: 3
          });
       
        poly.setMap(map);
        path = poly.getPath();
        var decodedPath = event;
        decode(decodedPath,markers_arr);
         }else{
             poly.setMap(null);
             path = poly.getPath();
             for (var i = 0; i < markers_val_.length; i++) {
                markers_val_[i].setMap(null);
             }
             markers_val_ = [];
           } 
         
       }

    function decode(encoded,markers_arr){
         //path.push({latitude:( lat / 1E5),longitude:( lng / 1E5)});
         //console.log(encoded);
      if(markers_arr != "")
        var object_markers = JSON.parse(markers_arr);
        
           

        var array = $.map(object_markers, function(value, index) {
            return [value];
         });

        var pointss=[];
        var i=0;
        var t ="";
      for(i=0;i<array.length;i++){
        var t=array[i].split(',');
        if(i == 0)
          icon   = new google.maps.MarkerImage('https://mts.googleapis.com/vt/icon/name=icons/spotlight/spotlight-waypoint-a.png&text=A&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1');
        else if(i == (array.length)-1)
          icon   = new google.maps.MarkerImage('https://mts.googleapis.com/vt/icon/name=icons/spotlight/spotlight-waypoint-a.png&text=B&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1');
        else
          icon = "";

         marker = new google.maps.Marker({
          position: new google.maps.LatLng(parseFloat(t[0]), parseFloat(t[1])),
          title: '#' + path.getLength(),
          icon :icon,
          map: map
         });

         markers_val_.push(marker);
   }
    // array that holds the points
    // alert(encoded);
    var points=[ ]
    var index = 0, len = encoded.length;
    var lat = 0, lng = 0;
    while (index < len) {
        var b, shift = 0, result = 0;
        do {
            b = encoded.charAt(index++).charCodeAt(0) - 63;
              result |= (b & 0x1f) << shift;
              shift += 5;
           } while (b >= 0x20);


       var dlat = ((result & 1) != 0 ? ~(result >> 1) : (result >> 1));
       lat += dlat;
       shift  = 0;
       result = 0;
       do {
         b = encoded.charAt(index++).charCodeAt(0) - 63;
         result |= (b & 0x1f) << shift;
         shift += 5;
         } while (b >= 0x20);
      var dlng = ((result & 1) != 0 ? ~(result >> 1) : (result >> 1));
      lng += dlng;

      path.push(new google.maps.LatLng(lat / 1E5, lng / 1E5));         /////create polyline and route
      points.push({latitude:( lat / 1E5),longitude:( lng / 1E5)})  ;
    }
  }
 </script>

 <script>
    driver_id = "";  var counter = 0;markersvalue="";
    function getliveroute(ths){
    
    var mar=$(ths).attr("data-id");
    var mari=$(ths).attr("data-name");
    addLatLng(mari,mar);
   
    var driver_id = $(ths).attr("data-driver");
    $(ths).addClass("active_driver");

    getlivepoints();
    $('.map-container').css('display', 'block');
    
 }

    $(".map-close").click(function(){  
     $('.map-container').css('display', 'none');
     addLatLng("","");
    });

    function getlivepoints(){
        jsonval = "";
        driver_id = $(".active_driver").attr("data-driver");
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('transport/vehicle/getLocationOfDriver'); ?>",
            data   : {driver_id:driver_id},               
            async  : false,
            success: function(response){                                                   
               if(response != 0)
                { 
                  //alert(interval);
                  //console.log(markersvalue);
                  var jsonval = JSON.parse(response);
                  counter = counter+interval;
                  if(counter > 6000){
                     markersvalue.setMap(null);
                     if(markersvalue != "")
                        markersvalue.setMap(null);
                        
                        interval = 0;

                       markersvalue = new google.maps.Marker({
                       position: new google.maps.LatLng(parseFloat(jsonval.latitude), parseFloat(jsonval.longitude)),
                       title: '#' + path.getLength(),
                       icon: {
                           url: "<?php echo base_url('assets/images/bus.png');?>",scaledSize: new google.maps.Size(60, 60)
                       } ,
                       map: map
                      });  

                  }else{
                       markersvalue = new google.maps.Marker({
                       position: new google.maps.LatLng(parseFloat(jsonval.latitude), parseFloat(jsonval.longitude)),
                       title: '#' + path.getLength(),
                       icon: {
                           url: "<?php echo base_url('assets/images/bus.png');?>",scaledSize: new google.maps.Size(60, 60)
                       } ,
                       map: map
                      });
                  }
              }
            }
        });
    }
  interval = 1000 * 6; // where X is your every X minutes
  window.setInterval(getlivepoints, interval);

               

</script>
<!-- https://maps.googleapis.com/maps/api/directions/json?origin=28.667899981213115%2C77.22796290957035&destination=28.646208704837782%2C77.11638301455082&waypoints=28.658862494805%2C77.203243671289%7C28.651933227536%2C77.178867755762%7C28.655247282061%2C77.152088580957%7C28.65072809083%2C77.124279437891&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4 -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&libraries=places&callback=initAutocomplete"
       async defer></script> -->
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&callback=initMap"></script>
