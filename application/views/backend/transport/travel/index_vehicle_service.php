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
          left: 25%;
          top: 5%;
          background: #fff;
          padding: 1%;
          border: 1px solid #eee;
          box-shadow: 0 7px 15px rgba(0,0,0,.15);
          display: none;
        }
    </style>

<?php $activeTab = "vehicle"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Transport</a></li>
        <li class="active">Vehicle</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php //include base_path().'application/views/backend/navigation_tab/transport_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>	
	
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bus"></i><small> Add Vehicle Service</small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_vehicle_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> Add Vehicle Service</a> </li>
                                       
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_vehicle_list" >
                            <div class="x_content">
                            <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Choose Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-5 col-xs-10"  name="date_at"  id="created_at_on" value="<?php echo isset($post['created_at']) ?  $post['created_at'] : ''; ?>" placeholder="Created at" required="required" type="date">
                                        <button class="btn btn-success" type="button" id="button_vehicle" onclick="get_date_changer();" style="margin-top:2%;">Find</button>
                                        <div class="help-block"><?php echo form_error('created_at'); ?></div>
                                    </div>
                                </div>    
                                
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th ><?php echo $this->lang->line('vehicle'); ?> No</th>
                                        <th><?php echo $this->lang->line('vehicle'); ?> Driver Id</th>
                                        
                                        <th>Start Km</th>
                                        <th>End km</th>
                                        <th>Cash</th>
                                        <th>Quantity</th>
                                        <th>Repair</th>
                                        <th>Repair Cost</th>
                                        <th>Total distance covered</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody id="add_data">   
                                   
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_vehicle">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('transport/travel/add_vehicle_service'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="driver">Select Vehicle
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="vehicle_no" class="form-control col-md-7 col-xs-12" >
                                            <option value="">--select--</option>
                                            <?php
                                                if(!empty($vehicles)){
                                                 foreach ($vehicles as $dt) {
                                                  ?>
                                                   <option value="<?php echo $dt->id;?>"><?php echo $dt->number;?>
                                                   </option>
                                                <?php }} ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('vehicle_no'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Total Expenditure <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="total_cost"  id="total_cost" value="<?php echo isset($post['start_km']) ?  $post['start_km'] : ''; ?>" placeholder="Total Expenditure" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('start_km'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Service Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="service_date"  id="service_date" value="<?php echo isset($post['service_date']) ?  $post['service_date'] : ''; ?>" required="required" type="date">
                                        <div class="help-block"><?php echo form_error('end_km'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Next Service Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="next_service_date"  id="next_service_date" value="<?php echo isset($post['next_service_date']) ?  $post['next_service_date'] : ''; ?>" required="required" type="date">
                                        <div class="help-block"><?php echo form_error('next_service_date'); ?></div>
                                    </div>
                                </div>
                                
                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Vehicle Fitness <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input type="radio" name="fitness" value="Fit"> Fit<br>
                                       <input type="radio" name="fitness" value="Not-Fit"> Not Fit<br>
                                       <div class="help-block"><?php echo form_error('fitness'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Vehicle damage description <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control col-md-7 col-xs-12"  name="remark"><?php echo isset($post['remark']) ?  $post['remark'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('remark'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('transport/vehicle'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_vehicle">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('transport/vehicle/edit/'.$vehicle->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"><?php echo $this->lang->line('vehicle'); ?> <?php echo $this->lang->line('number'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="number"  id="number" value="<?php echo isset($vehicle->number) ?  $vehicle->number : $post['number']; ?>" placeholder="<?php echo $this->lang->line('vehicle'); ?> <?php echo $this->lang->line('number'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('number'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="model"><?php echo $this->lang->line('vehicle_model'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="model"  id="model" value="<?php echo isset($vehicle->model) ?  $vehicle->model : $post['model']; ?>" placeholder="<?php echo $this->lang->line('vehicle_model'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('model'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="driver"><?php echo $this->lang->line('driver'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       
                                        <select name="driver" class="form-control col-md-7 col-xs-12" >
                                            <option value="">--select--</option>
                                            <?php 
                                            $this->db->select("DS.*,E.name");
                                            $this->db->from('designation_users AS DS');
                                            $this->db->join('employees AS E', 'E.user_id = DS.designation_users_id');
                                            $this->db->where('DS.role_id', DRIVER);
                                            $driver_data = $this->db->get()->result();
                                                if($driver_data != ""){
                                                 foreach ($driver_data as $key => $dt) {
                                                  ?>
                                                   <option value="<?php echo $dt->designation_users_id;?>" <?php echo isset($vehicle->driver) ?  "selected" :''; ?> >
                                                    <?php echo $dt->name;?>
                                                   </option>
                                                <?php }} ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('driver'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="license"><?php echo $this->lang->line('vehicle_license'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="license"  id="license" value="<?php echo isset($vehicle->license) ?  $vehicle->license : $post['license']; ?>" placeholder="<?php echo $this->lang->line('vehicle_license'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('license'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact"><?php echo $this->lang->line('vehicle_contact'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="contact"  id="contact" value="<?php echo isset($vehicle->contact) ?  $vehicle->contact : $post['contact']; ?>" placeholder="<?php echo $this->lang->line('vehicle_contact'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('contact'); ?></div>
                                    </div>
                                </div>                          
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($vehicle->note) ?  $vehicle->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($vehicle) ? $vehicle->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('transport/vehicle'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>

                        
                    </div>
                </div>
            </div>
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
       
        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        var styledMapType = new google.maps.StyledMapType(
           [
  {
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ddf7f4"
      }
    ]
  },
  {
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4294f9"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#5cb4de"
      }
    ]
  }
]
,
            {name: 'Styled Map'});

        // Create a map object, and include the MapTypeId to add
        // to the map type control.
       map = new google.maps.Map(document.getElementById('map'), {
          //center: {lat: 55.647, lng: 37.581},
          zoom: 11,
          mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
          },
	 center: {lat: 28.668502452598734, lng: 77.2193798407227} 
        });

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
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
        console.log(i +'=='+ array.length);
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
                  console.log(markersvalue);
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
                           url: "<?php echo base_url('assets/images/busss.png');?>",scaledSize: new google.maps.Size(60, 60)
                       } ,
                       map: map
                      });  

                  }else{
                       markersvalue = new google.maps.Marker({
                       position: new google.maps.LatLng(parseFloat(jsonval.latitude), parseFloat(jsonval.longitude)),
                       title: '#' + path.getLength(),
                       icon: {
                           url: "<?php echo base_url('assets/images/busss.png');?>",scaledSize: new google.maps.Size(60, 60)
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
<script type="text/javascript">
	function get_date_changer()
	{
	    var val=$('#created_at_on').val();
	    //alert(val);
		$.ajax({
            url: '<?php echo base_url();?>transport/travel/get_date_data',
            data : { dated : val},
            type: 'POST',
            success: function(response)
            {
                jQuery('#add_data').html(response);
            }
        });
	}
</script>
<!-- https://maps.googleapis.com/maps/api/directions/json?origin=28.667899981213115%2C77.22796290957035&destination=28.646208704837782%2C77.11638301455082&waypoints=28.658862494805%2C77.203243671289%7C28.651933227536%2C77.178867755762%7C28.655247282061%2C77.152088580957%7C28.65072809083%2C77.124279437891&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4 -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&libraries=places&callback=initAutocomplete"
       async defer></script> -->
 <script async defer 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&callback=initMap">
		</script>
