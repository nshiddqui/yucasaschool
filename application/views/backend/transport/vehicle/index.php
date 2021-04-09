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
                <h3 class="head-title"><i class="fa fa-bus"></i><small> <?php echo $this->lang->line('manage_vehicle'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_vehicle_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('vehicle'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'transport', 'vehicle')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_vehicle"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('vehicle'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_vehicle"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('vehicle'); ?></a> </li>                          
                        <?php } ?>                
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_vehicle"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('vehicle'); ?></a> </li>                          
                        <?php } ?>                
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_vehicle_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th ><?php echo $this->lang->line('vehicle'); ?><?php echo $this->lang->line('id'); ?></th>
                                        <th><?php echo $this->lang->line('vehicle'); ?> <?php echo $this->lang->line('number'); ?></th>
                                        
                                        <th><?php echo $this->lang->line('vehicle_model'); ?></th>
                                        <th><?php echo $this->lang->line('driver'); ?></th>
                                        <th><?php echo $this->lang->line('vehicle_license'); ?></th>
                                        <th><?php echo $this->lang->line('vehicle_contact'); ?></th>
                                        <th>Bus Owner Type</th>
                                        <th>Owner Details</th>
                                        <th  width="25%"><?php echo $this->lang->line('note'); ?></th>
                                        
                                        <th  width="25%"><?php echo get_phrase('route_status'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($vehicles) && !empty($vehicles)){ ?>
                                        <?php
                                        //    echo "<pre>";
                                        //      print_r($vehicles);
                                        //      echo "</pre>";
                                           foreach($vehicles as $obj){ 
                                            $routedetails =  @$this->db->get_where('routes',array('vehicle_ids'=>$obj->id))->row();
                                            ?>
                                        <tr>

                    
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->id;?></td>
                                            <td><?php echo $obj->number; ?></td>
                                            <td><?php echo $obj->model; ?></td>
                                            <td><?php echo  $this->db->get_where('employees',array('user_id'=>$obj->driver))->row()->name; ?></td>
                                            <td><?php echo $obj->license; ?></td>
                                            <td><?php echo $obj->contact; ?></td>
                                            <td><?php echo $obj->vehicle_owned; ?></td>
                                            <td><?php echo $obj->owner_name.'<br>'.$obj->owner_mobile.'<br>'.$obj->owner_address; ?></td>
                                            <td><?php echo $obj->note; ?></td>
                                            <td>

                                              <?php if( $routedetails != ""){ 
                                              

                                                $md = json_decode($routedetails -> stop_details);
                                                $ms = array();

                                                //print_r($md); 
                                                for($i = 0; $i < sizeof($md) - 1; $i++) {
                                                    $ms[$i] = json_decode($md[$i]); 

                                                    $ms[$i] -> lat = $ms[$i] -> lat .'';
                                                    $ms[$i] -> lng = $ms[$i] -> lng .'';
                                                    $ms[$i] -> distance = $ms[$i] -> distance .'';
                                                }
                                               // $md = json_decode($md[0]);
                                                 $ms;
                                                 /*echo "<pre>";
                                                      print_r($ms);
                                                 echo "</pre>";*/

                                                 $arr = array();
                                                 $arr2=array();
                                                 $k=1;
                                                 $arr2[$k] = $routedetails->source_lat.','.$routedetails->source_long;
                                                 foreach ($ms as $key => $dt) {
                                                    $k++;
                                                    $arr[] = $dt->lat.'%2C'.$dt->lng;
                                                    if($k<=count($ms)+1){
                                                    $arr2[$k] = $dt->lat.','.$dt->lng;
                                                }
                                                 }
                                                  $waypointss = implode('%7C',$arr);


                                                   $arr2[$k+1] = $routedetails->dest_lat.','.$routedetails->dest_long;

                                              // echo "<br>";
                                                $origin  = $routedetails->source_lat.'%2C'.$routedetails->source_long.'&destination='.$routedetails->dest_lat.'%2C'.$routedetails->dest_long.'&waypoints='.$waypointss;
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

                                                $var=$jsonData->routes[0]->overview_polyline->points;
                                                $err=json_decode(json_encode($arr2,false));
                                                

                                                ?>
                                               <p>Available</p>
                                               <?php }else{ ?>
                                                <p>Not Available</p>
                                               <?php } ?>
                                            </td>
                                            <td>
                                              <!--<?php if(has_permission(EDIT, 'transport', 'vehicle')){ ?>
                                                    <a href="<?php echo site_url('transport/vehicle/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>                                                
                                                <?php if(has_permission(DELETE, 'transport', 'vehicle')){ ?>
                                                    <a href="<?php echo site_url('transport/vehicle/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>-->

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                        <li>
                                                           <?php if(has_permission(EDIT, 'transport', 'vehicle')){ ?>
                                                            <a href="<?php echo site_url('transport/vehicle/edit/'.$obj->id); ?>" ><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                        <?php } ?> 
                                                        </li>
                                                        <li class="divider"></li>
                                                        <?php if( $routedetails != ""){ ?>
                                                        <li>
                                                         <a class="" id="route_list" data-driver ="<?php echo $obj->driver;?>" onclick="getliveroute(this)" data-id='<?php echo json_encode($err);?>' data-name="<?php echo $var;?>" ><i class="fa fa-map-marker"></i> <?php echo get_phrase('location'); ?> </a>
                                                      
                                                        </li>
                                                        <li class="divider"></li>
                                                        <?php } ?>
                                                        

                                                        <li>
                                                            <?php if(has_permission(DELETE, 'transport', 'vehicle')){ ?>
                                                                <a href="<?php echo site_url('transport/vehicle/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" ><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                            <?php } ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_vehicle">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('transport/vehicle/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"><?php echo $this->lang->line('vehicle'); ?> <?php echo $this->lang->line('number'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="number"  id="number" value="<?php echo isset($post['number']) ?  $post['number'] : ''; ?>" placeholder="<?php echo $this->lang->line('vehicle'); ?> <?php echo $this->lang->line('number'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('number'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="model"><?php echo $this->lang->line('vehicle_model'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="model"  id="model" value="<?php echo isset($post['model']) ?  $post['model'] : ''; ?>" placeholder="<?php echo $this->lang->line('vehicle_model'); ?>" type="text">
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
                                                   <option value="<?php echo $dt->designation_users_id;?>" <?php echo isset($post['driver']) ?  'selected' : ''; ?>><?php echo $dt->name;?>
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
                                        <input  class="form-control col-md-7 col-xs-12"  name="license"  id="driver" value="<?php echo isset($post['license']) ?  $post['license'] : ''; ?>" placeholder="<?php echo $this->lang->line('vehicle_license'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('license'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact"><?php echo $this->lang->line('vehicle_contact'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="contact"  id="contact" value="<?php echo isset($post['contact']) ?  $post['contact'] : ''; ?>" placeholder="<?php echo $this->lang->line('vehicle_contact'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('contact'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Alternate Contact <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="alternate_contact"  id="contact" value="<?php echo isset($post['alternate_contact']) ?  $post['alternate_contact'] : ''; ?>" placeholder="Alternate Contact" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('alternate_contact'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Bus owner type <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="col-md-7 col-xs-12"  name="vehicle_owned"  id="vehicle_owned" value="School" required="required" type="radio">School<br>
                                        <input  class="col-md-7 col-xs-12"  name="vehicle_owned"  id="vehicle_owned1" value="Other Owner" required="required" type="radio">Owner Name
                                       <input type="text" name="owner_name" placeholder="Owner Name" id="owner_name" style="display:none;">
                                       <input type="text" name="owner_mobile" placeholder="Owner Mobile" id="owner_mobile" style="display:none;">
                                       <input type="text" name="owner_address" placeholder="Owner Addres" id="owner_address" style="display:none;">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Alternate Contact <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="alternate_contact"  id="contact" value="<?php echo isset($vehicle->alternate_contact) ?  $vehicle->alternate_contact : ''; ?>" placeholder="Alternate Contact" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('alternate_contact'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Bus owner type <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="col-md-7 col-xs-12"  name="vehicle_owned"  id="vehicle_owned" value="School" required="required" type="radio" <?php if($vehicle->vehicle_owned=='School'){ echo "Checked='checked'";}?>>School<br>
                                        <input  class="col-md-7 col-xs-12"  name="vehicle_owned"  id="vehicle_owned2" value="Other Owner" required="required" <?php if($vehicle->vehicle_owned=='Other Owner'){ echo "Checked='checked'";}?> type="radio">Owner Name
                                       <input type="text" name="owner_name" placeholder="Owner name" id="owner_name" value='<?php echo isset($vehicle->owner_name) ?  $vehicle->owner_name :''; ?>' >
                                        <input type="text" name="owner_mobile" placeholder="Owner Mobile" id="owner_mobile" value='<?php echo isset($vehicle->owner_mobile) ?  $vehicle->owner_mobile :''; ?>'>
                                       <input type="text" name="owner_address" placeholder="Owner Addres" id="owner_address" value='<?php echo isset($vehicle->owner_address) ?  $vehicle->owner_address :''; ?>'>
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
$(document).ready(function() {
    $("#vehicle_owned1,#vehicle_owned").click(function() {
        var test = $(this).val();
        if($('#vehicle_owned1').is(':checked')){
            $("#owner_name").show();
             $("#owner_mobile").show();
              $("#owner_address").show();
        }else{
             $("#owner_name").hide();
             $("#owner_mobile").hide();
             $("#owner_address").hide();
        }
       
       // $("#Cars" + test).show();
    });
     $("#vehicle_owned2,#vehicle_owned").click(function() {
        var test = $(this).val();
        if($('#vehicle_owned2').is(':checked')){
            $("#owner_name").show();
             $("#owner_mobile").show();
              $("#owner_address").show();
        }else{
             $("#owner_name").hide();
             $("#owner_mobile").hide();
             $("#owner_address").hide();
        }
       
       // $("#Cars" + test).show();
    });
});
</script>
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
<!-- https://maps.googleapis.com/maps/api/directions/json?origin=28.667899981213115%2C77.22796290957035&destination=28.646208704837782%2C77.11638301455082&waypoints=28.658862494805%2C77.203243671289%7C28.651933227536%2C77.178867755762%7C28.655247282061%2C77.152088580957%7C28.65072809083%2C77.124279437891&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4 -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&libraries=places&callback=initAutocomplete"
       async defer></script> -->
 <script async defer 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&callback=initMap">
		</script>
