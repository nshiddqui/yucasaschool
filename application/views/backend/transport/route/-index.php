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

        .map-wrapper{
          position: fixed;
          width: 100vw;
          height: 100vh;
          top: 0;
          left: 0;
          /*display: none;*/
        }
    </style>


<?php $activeTab = "route"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Transport</a></li>
        <li class="active">Route</li>
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
                <h3 class="head-title"><i class="fa fa-bus"></i><small> <?php echo $this->lang->line('manage_route'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_route_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'transport', 'route')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('transport_route'); ?></a> </li>                          
                        <?php } ?>  
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('transport_route'); ?></a> </li>                          
                        <?php } ?>                
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('transport_route'); ?></a> </li>                          
                        <?php } ?>                
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_route_list" >
                            <div class="x_content">
							<div class="table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th >Route <?php echo $this->lang->line('id'); ?></th>
                                        <th><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?></th>
                                        <th>Total Member</th>                                       
									   <th><?php echo $this->lang->line('route_start'); ?></th>
                                      
                                        <th><?php echo $this->lang->line('route_end'); ?></th>
                                        <th><?php echo $this->lang->line('vehicle_for_route'); ?></th>

                                        <th class="action"><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($routes) && !empty($routes)){ ?>
                                        <?php foreach($routes as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $id=$obj->id; ?></td>
                                            <td><?php echo $obj->title; ?></td>
											    <td><?php $query = $this->db->query("SELECT * FROM transport_members where route_id='$id'");echo $query->num_rows();?></td>
                                            <td><?php echo $obj->route_start; ?></td>
                                        
                                            <td><?php echo $obj->route_end; ?></td>
                                            <td><?php echo get_vehicle_by_ids($obj->vehicle_ids); ?></td>
                                            <td>
                                               <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                        <li>
                                                           <?php if(has_permission(EDIT, 'transport', 'route')){ ?>
                                                                <a href="<?php echo site_url('transport/route/edit/'.$obj->id); ?>" class=""><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                            <?php } ?>
                                                        </li>

                                                        <li>
                                                              <?php if(has_permission(VIEW, 'transport', 'route')){ ?>
                                                                    <a href="<?php echo site_url('modal/popup/get-single-route/'.$obj->id);?>"  data-toggle="modal" data-target=".bs-route-modal-lg" class=""><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                                <?php } ?>
                                                        </li>
                                                        <li class="divider"></li>

                                                        <li>
                                                            <?php if(has_permission(DELETE, 'transport', 'route')){ ?>
                                                            <a href="<?php echo site_url('transport/route/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
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
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_route">
                            <div class="x_content" id="route_stop_form"> 
                               <?php echo form_open(site_url('transport/route/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>" placeholder="<?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_start"><?php echo $this->lang->line('route_start'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_start" id="route_start" value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>" placeholder="<?php echo $this->lang->line('route_start'); ?>" required="required" type="text" readonly >
                                        <div class="help-block"><?php echo form_error('route_start'); ?></div>

                                        <input type="hidden" class="route_start" id="lat" name="route_start_lat" value="<?php echo $this->db->get_where('settings' , array('type' =>'latitude'))->row()->description;?>" >
                                        <input type="hidden" class="route_start" id="lng" name="route_start_lng" value="<?php echo $this->db->get_where('settings' , array('type' =>'longitude'))->row()->description;?>">
                                        <input type="hidden" name="row_"  id="row_" value="1"  value="<?php echo isset($post['row_']) ?  $post['row_'] : ''; ?>">
                                        
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_end"><?php echo $this->lang->line('route_end'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_end"  id="route_end" value="<?php echo isset($post['route_end']) ?  $post['route_end'] : ''; ?>" placeholder="<?php echo $this->lang->line('route_end'); ?>" required="required" type="text" readonly onclick="mapOpen(this.id);">
                                        <div class="help-block"><?php echo form_error('route_end'); ?></div>
                                        <input type="hidden" class="route_end" id="lat" name="route_end_lat" value="<?php echo isset($post['route_end_lat']) ?  $post['route_end_lat'] : ''; ?>" >
                                        <input type="hidden" class="route_end" id="lng" name="route_end_lng" value="<?php echo isset($post['route_end_lng']) ?  $post['route_end_lng'] : ''; ?>">
                                     
                                    </div>
                                </div>                               
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vehicle_ids"><?php echo $this->lang->line('vehicle_for_route'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php foreach($add_vehicles as $obj){ ?> 
                                            <input  class=""  name="vehicle_ids[]" id="vehicle_ids[]" value="<?php echo $obj->id; ?>" type="checkbox" > <?php echo $obj->number; ?> <br/>
                                        <?php } ?>
                                        <label id="vehicle_ids[]-error" class="error" for="vehicle_ids[]" style="display: inline-block;"></label>
                                        <div class="help-block"><?php echo form_error('vehicle_ids'); ?></div>
                                    </div>
                                </div>                                                               
                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('route_stop_fare'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <table style="width:100%;" class="fn_add_stop_container responsive"> 
                                             <tr>               
                                                 <td><?php echo $this->lang->line('stop_name'); ?></td>
                                                 <td><?php echo $this->lang->line('stop_km'); ?></td>
                                                 <!-- <td><?php echo $this->lang->line('stop_fare'); ?></td> -->
                                             </tr>
                                            <tr>               
                                              <td>
                                                  <input  class="form-control col-md-12 col-xs-12 stop_name" id="stop_point_1" style="width:auto;" type="text" name="stop_name[]" placeholder="<?php echo $this->lang->line('stop_name'); ?>" onclick="mapOpen(this.id);" readonly/>
                                                  <input type="hidden" class="stop_point_1" id="stop_point_1_details" name="stop_point_lat[]" >
                                                 
                                              </td>
                                              <td>
                                                <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type='text' name="stop_km[]" value="" placeholder="<?php echo $this->lang->line('stop_km'); ?>" id="stop_point_1_stop_km"/>
                                              </td>
                                              <!-- <td>
                                                  <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type='text' name="stop_fare[]" value="" placeholder="<?php echo $this->lang->line('stop_fare'); ?>"/>
                                              </td> -->
                                              <td>
                                              </td>
                                            </tr>                                           
                                          </table>
                                        <div class="help-block">
                                            <?php echo form_error('answer'); ?>
                                            <a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="add_more('fn_add_stop_container');"><?php echo $this->lang->line('add_more'); ?></a>
                                        </div>
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
                                        <a href="<?php echo site_url('transport/route'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_route">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('transport/route/edit/'.$route->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($route->title) ?  $route->title : $post['title']; ?>" placeholder="<?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text" >
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_start"><?php echo $this->lang->line('route_start'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_start"  id="route_start_edit" value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>" placeholder="<?php echo $this->lang->line('route_start'); ?>" required="required" type="text"  readonly >
                                        <div class="help-block"><?php echo form_error('route_start'); ?></div>
                                        <input type="hidden" class="route_start_edit" id="lat" name="route_start_lat" value="<?php echo $this->db->get_where('settings' , array('type' =>'latitude'))->row()->description;?>" >
                                        <input type="hidden" class="route_start_edit" id="lng" name="route_start_lng" value="<?php echo $this->db->get_where('settings' , array('type' =>'longitude'))->row()->description;?>">
                                        <input type="hidden" name="row_"  id="row_edit"  value="<?php echo isset($route_stops) ?  count($route_stops) : $post['row_']; ?>">
                                    </div>

                                    
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_end"><?php echo $this->lang->line('route_end'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_end"  id="route_end_edit" value="<?php echo isset($route->route_end) ?  $route->route_end : $post['route_end']; ?>" placeholder="<?php echo $this->lang->line('route_end'); ?>" required="required" type="text" readonly onclick="mapOpen(this.id);">
                                        <div class="help-block"><?php echo form_error('route_end'); ?></div>
                                        <input type="hidden" class="route_end_edit" id="lat" name="route_end_lat" value="<?php echo isset($route->dest_lat) ?  $route->dest_lat : $post['route_end_lat']; ?>" >
                                        <input type="hidden" class="route_end_edit" id="lng" name="route_end_lng" value="<?php echo isset($route->dest_long) ?  $route->dest_long : $post['route_end_lng']; ?>">

                                    </div>
                                </div>                          
                                                         
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vehicle_ids">
                                      <?php echo $this->lang->line('assign_vehicle');?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php $ids = explode(',', $route->vehicle_ids); ?>
                                        <?php foreach($edit_vehicles as $obj){ ?>
                                            <input  class=""  name="vehicle_ids[]" id="vehicle_ids[]"  value="<?php echo $obj->id; ?>" <?php if(in_array($obj->id, $ids)){ echo 'checked="checked"';} ?>  type="checkbox" > <?php echo $obj->number; ?> <br/>
                                        <?php } ?> 
                                        <label id="vehicle_ids[]-error" class="error" for="vehicle_ids[]" style="display: inline-block;">
                                        </label>
                                        <div class="help-block"><?php echo form_error('vehicle_ids'); ?></div>
                                    </div>
                                </div>    
                                
                                   <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('route_stop_fare'); ?></label>

                                    

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <table style="width:100%;" class="fn_edit_stop_container responsive"> 
                                             <tr>               
                                                 <td><?php echo $this->lang->line('stop_name'); ?></td>
                                                 <td><?php echo $this->lang->line('stop_km'); ?></td>
                                                 <!-- <td><?php echo $this->lang->line('stop_fare'); ?></td> -->
                                             </tr>
                                            <?php 
                                            /*echo "<pre>";
                                              print_r(json_decode($route->stop_details));
                                              echo "</pre>";
                                            */
                                            $jsondetail = json_decode($route->stop_details);
                                            
                                            $k = 0;
                                            $couter = 1; 
                                            
                                            $md = json_decode($route -> stop_details);
                                              $ms = array();
                                            
                                              //print_r($md); 
                                              for($i = 0; $i < sizeof($md) - 1; $i++) {
                                                  $ms[$i] = json_decode($md[$i]); 
                                                  $ms[$i] -> lat = $ms[$i] -> lat .'';
                                                  $ms[$i] -> lng = $ms[$i] -> lng .'';
                                                  $ms[$i] -> distance = $ms[$i] -> distance .'';
                                              }
                                            
                                               $arr = array();
                                               $arr2=array();
                                               $km=1;
                                              
                                              $arr2[$km] = $route->source_lat.','.$route->source_long;
                                               foreach ($ms as $key => $dt) {
                                                  $km++;
                                                  $arr[] = $dt->lat.'%2C'.$dt->lng;
                                                  if($km<=count($ms)+1){
                                                  $arr2[$km] = $dt->lat.','.$dt->lng;
                                              }
                                               }
                                                $waypointss = implode('%7C',$arr);
                                                $arr2[$km+1] = $route->dest_lat.','.$route->dest_long;
                                            
                                            // echo "<br>";
                                              $origin  = $route->source_lat.'%2C'.$route->source_long.'&destination='.$route->dest_lat.'%2C'.$route->dest_long.'&waypoints='.$waypointss;
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
                                            
                                              $var = $jsonData->routes[0]->overview_polyline->points;
                                              $err=json_decode(json_encode($arr2,false));
                                            
                                            
                                            
                                            
                                            foreach($route_stops as  $obj){ 
                                            
                                            ?> 
                                            
                                            
                                            <tr>               
                                              <td>                                                  
                                                  <input type="hidden" name="stop_id[]" value="<?php echo $obj->id; ?>" />
                                                  <input  class="form-control col-md-12 col-xs-12 stop_name" style="width:auto;" type="text" name="stop_name[]" value="<?php echo $obj->stop_name; ?>" id="stop_point_edit_<?=$k;?>" placeholder="<?php echo $this->lang->line('stop_name'); ?>" onclick="mapOpen(this.id);" readonly />
                                                  <input type="hidden" class="stop_point_edit_<?=$k;?>" id="stop_point_edit_<?=$k;?>_details" value='<?php echo $jsondetail[$k];?>' name="stop_point_lat[]" >
                                              </td>
                                              <td>
                                                  <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type='text' name="stop_km[]" value="<?php echo $obj->stop_km; ?>" placeholder="<?php echo $this->lang->line('stop_km'); ?>" id="stop_point_edit_<?=$k;?>_stop_km" />
                                              </td>
                                              <td>
                                                  <!-- <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type='text' name="stop_fare[]" value="<?php echo $obj->stop_fare; ?>" placeholder="<?php echo $this->lang->line('stop_fare'); ?>"/> -->
                                              </td>
                                              <td>
                                                  <?php if($couter > 1){ ?>
                                                  <a  class="btn btn-danger btn-md " onclick="remove(this, <?php echo $obj->id; ?>);" style="margin-bottom: -0px;" > - </a>
                                                  <?php } ?>
                                              </td>
                                            </tr> 
                                            <?php $couter++; $k++;} ?>
                                            
                                          </table>
                                        <div class="help-block">
                                            <?php echo form_error('answer'); ?>
                                            <a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="add_more_edit('fn_edit_stop_container');"><?php echo $this->lang->line('add_more'); ?></a>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($route->note) ?  $route->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($route) ? $route->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('transport/route'); ?>"  class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
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
    <input  hidden id="lstlangin" data-id='<?php echo json_encode($err);?>' data-name="<?php echo $var;?>" >   
    
</div>
<script type="text/javascript">
     function add_more(fn_stop_container){
         var a = $('#row_').val();
         let i=parseInt(a)+1;
         
         var data = '<tr>'                
                    +'<td style="width:50%;">'                   
                    +'<input  class="form-control col-md-12 col-xs-12 stop_name" style="width:auto;" type="text" id="stop_point_'+i+'" name="stop_name[]" class="answer" placeholder="<?php echo $this->lang->line('stop_name'); ?>" onclick="mapOpen(this.id);" readonly/> <input type="hidden" class="stop_point_'+i+'" name="stop_point_lat[]" id="stop_point_'+i+'_details" >' 
                    +'</td>'
                    +'<td>'  
                    +'<input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_km[]" id="stop_point_'+i+'_stop_km" value="" placeholder="<?php echo $this->lang->line('stop_km'); ?>"/>'
                    +'</td>'
                    +'<td>'  
                    +'<input  style="display:none;" class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_fare[]" value="" placeholder="<?php echo $this->lang->line('stop_fare'); ?>"/>'
                    +'</td>'
                    +'<td>'  
                    +'<a  class="btn btn-danger btn-md " onclick="remove(this);" style="margin-bottom: -0px;" > - </a>'
                    +'</td>'
                    +'</tr>';
            $('.'+fn_stop_container).append(data);
            $('#row_').val(i);
     }

       function add_more_edit(fn_stop_container){
         var a = $('#row_edit').val();
        
         let i=parseInt(a)+1;
        
         var data = '<tr>'                
                    +'<td style="width:50%;">'                   
                    +'<input  class="form-control col-md-12 col-xs-12 stop_name" style="width:auto;" type="text" id="stop_point_edit_'+i+'" name="stop_name[]" class="answer" placeholder="<?php echo $this->lang->line('stop_name'); ?>" onclick="mapOpen(this.id);" readonly/><input type="hidden" class="stop_point_edit_'+i+'" name="stop_point_lat[]" id="stop_point_edit_'+i+'_details" >' 
                    +'</td>'
                    +'<td>'  
                    +'<input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_km[]" id="stop_point_edit_'+i+'_stop_km" value="" placeholder="<?php echo $this->lang->line('stop_km'); ?>"/>'
                    +'</td>'
                    +'<td>'  
                    +'<input  style="display:none;" class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_fare[]" value="" placeholder="<?php echo $this->lang->line('stop_fare'); ?>"/>'
                    +'</td>'
                    +'<td>'  
                    +'<a  class="btn btn-danger btn-md " onclick="remove(this);" style="margin-bottom: -0px;" > - </a>'
                    +'</td>'
                    +'</tr>';
            $('.'+fn_stop_container).append(data);
            $('#row_edit').val(i);
     }
     
     
     function remove(obj, stop_id){ 
        
        // remove stop from database
        if(stop_id)
        {
            if(confirm('<?php echo $this->lang->line('confirm_alert'); ?>')){
                $.ajax({       
                    type   : "POST",
                    url    : "<?php echo site_url('transport/route/remove_stop'); ?>",
                    data   : { stop_id : stop_id},               
                    async  : false,
                    success: function(response){                                                   
                       if(response)
                       {
                          $(obj).parent().parent('tr').remove();   
                       }
                    }
                });   
            }            
        }else{
            
            $(obj).parent().parent('tr').remove(); 
        }
     }
     
    
    
</script>
<div class="modal fade bs-route-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_route_data">            
        </div>       
      </div>
    </div>
</div>


  <div class="map-container">
   
    <div id="info" class="controls" ></div>
   
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div>
    <div class="col-sm-12">
        <div class="map-close btn btn-success pull-right" onclick="search_clear()">Add Location</div>
        &nbsp;
        <div class="map-close btn btn-danger ml-4 pull-right">Close</div>
    </div>
</div>




<script type="text/javascript">
         
    function get_route_modal(route_id){
         
        $('.fn_route_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('transport/route/get_single_route'); ?>",
          data   : {route_id : route_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_route_data').html(response);
             }
          }
       });
    }
</script>
    
<script>


 // This example creates an interactive map which constructs a polyline based on
    // user clicks. Note that the polyline only appears once its path property
    // contains two LatLng coordinates.
    var poly;
    var map;
    var markers_val_ =  [ ];
    var markers_arr = [];
    var attr;
    dataObjVal = [];

        
            function initAutocomplete() {
        
        
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
        
        
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
            mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
          },
          center: {lat: 28.668502452598734, lng: 77.2193798407227}  // Center the map on Chicago, USA.
        });
        //28.668502452598734, 77.2193798407227
       
        // Add a listener for the click event
       // map.addListener('click', addLatLng);
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
        
        
        
       
    
        setTimeout(function(){},2000)
      // Create the search box and link it to the UI element.
      var input = document.getElementById('pac-input');
      
      var searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      // Bias the SearchBox results towards current map's viewport.
      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });
      
      var markers = [];
      // Listen for the event fired when the user selects a prediction and retrieve
      // more details for that place.
      searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        //console.log(places);
        if (places.length == 0) {
          return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
          marker.setMap(null);
        });

          /*marker = new google.maps.Marker({
          position: latLng,
          title: 'Point A',
          map: map,
          draggable: true
        });*/
        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function(place) {
          if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
          }
          var icon = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
          };

          // Create a marker for each place.
          markers.push(new google.maps.Marker({
            map: map,
            icon: icon,
            title: place.name,
            position: place.geometry.location,
            //draggable: true
          }));

          var marker = new google.maps.Marker({
          position: place.geometry.location,
          title: 'Point A',
          map: map,
          draggable: true
          });



  // Update current position info.
  updateMarkerPosition(place.geometry.location);
  geocodePosition(place.geometry.location);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
   });

   google.maps.event.addListener(marker, 'dragend', function() {
     updateMarkerStatus('Drag ended');
     geocodePosition(marker.getPosition());
   });
       /* marker = new google.maps.Marker({
          position: latLng,
          title: 'Point A',
          map: map,
          draggable: true
        });
      */
          //console.log(place.geometry.location.lat());

          if (place.geometry.viewport) {
            // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
          } else {
            bounds.extend(place.geometry.location);
          }
          //console.log(place.geometry.location);
         // alert();
        });
        map.fitBounds(bounds);
        
      });
      
      
     }

     
     
     
function mapOpen(ths){
      
       // alert("working");
        //attr = class_val;
       // alert(attr);
    dataObjVal = [];
    $('.map-container').css('display', 'block');
    
    
    driver_id = "";  var counter = 0;markersvalue="";
    

    var currentOption = $("#lstlangin");
    console.log(currentOption);
    var mar = currentOption.attr("data-id");
    var mari=currentOption.attr("data-name");
    //console.log(markers_val_);
    markers_val_ = [];
    
    console.log(mar);
    console.log(mari);
     addLatLng("","");
 
     addLatLng(mari,mar);
   var geocoder = new google.maps.Geocoder();
        
        google.maps.event.addListener(map, 'click', function(event) {
          geocoder.geocode({
            'latLng': event.latLng
          }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                alert(results[0].formatted_address);
              }
            }
          });
        });

   
    var driver_id = currentOption.attr("data-driver");
    $(ths).addClass("active_driver");
    // getlivepoints();
    $('.route-container').css('display', 'block');
    
    }
    
    
        function updateMarkerStatus(str) {
//document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
document.getElementById('info').innerHTML = [
  latLng.lat(),
  latLng.lng()
].join(', ');
//geocodePosition(latLng);

}

function updateMarkerAddress(str) {
 //document.getElementById('address').innerHTML = str;
}

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      $('#'+attr).val(responses[0].formatted_address);
      var addr = responses[0].formatted_address;
       document.getElementById('info').innerHTML=addr;
       //alert($('#'+attr).hasClass("stop_name"));
      if($('#'+attr).hasClass("stop_name") === true){
       // alert(($('#'+attr).hasClass("stop_name")));
       var lat_val =  pos.lat();
       var lng_val = pos.lng();
       
       

        var startroutelat = $('.route_start#lat').val();
        var startroutelng = $('.route_start#lng').val();
        var pos1 = new google.maps.LatLng(startroutelat, startroutelng);
        console.log("startroutelng" + startroutelng);
        console.log("POS" + pos);
        console.log("POS1" + pos1);
        distance =  google.maps.geometry.spherical.computeDistanceBetween(pos1,pos);
        console.log(distance);
        m = distance;
        var km = Math.round(m / 100) / 10;
        arrayVal = {'lat':lat_val,'lng':lng_val,'address':addr,'distance':km};

        $('#'+attr+'_details').val(JSON.stringify(arrayVal));
        $('#'+attr+'_stop_km').val(km);
        
      }else{
        $("input[name='"+attr+"_lat']").val(pos.lat());
        $("input[name='"+attr+"_lng']").val(pos.lng());
      } 
       
       // input[name='first_name']
      // $('.route_start, .lat').val(pos.lat());

    } else {
      return 'Cannot determine address at this location.';
    }
  });
}


    
    $(".map-close").click(function(){  
     $('.map-container').css('display', 'none');
    });
    
    
    



      var vari = 0;
      // Handles click events on a map, and adds a new point to the Polyline.
      function addLatLng(event,markers_arr) {

            // poly.setMap(null);
            //  path = poly.getPath();
            //  for (var i = 0; i < markers_val_.length; i++) {
            //     markers_val_[i].setMap(null);
            //  }
          

            //  markers_val_ = [];
          console.log("Value of i is" + vari);
          
          vari++;
          //console.log("Event VAlue is" + event);
          //console.log("Markers Array Value is " + markers_arr);
          
          console.log('Markers array lenth is: ' + markers_arr.length);

           if(event == "" && markers_arr.length == 0){
            //alert('value');
            poly = new google.maps.Polyline({
              strokeColor: '#fff',
              strokeOpacity: 1.0,
              strokeWeight: 0
            });  
             poly.setMap(null);
             path = poly.getPath();
             for (var i = 0; i < markers_val_.length; i++) {
                markers_val_[i].setMap(null);
             }
             markers_val_ = [];
           }else if(event != ""){
            poly = new google.maps.Polyline({
              strokeColor: '#000',
              strokeOpacity: 1.0,
              strokeWeight: 3
            });  
            poly.setMap(map);
            path = poly.getPath();
            var decodedPath = event;
            decode(decodedPath,markers_arr);
         } 
       }


    function decode(encoded,markers_arr){
         //path.push({latitude:( lat / 1E5),longitude:( lng / 1E5)});
         //console.log(encoded);
         if(markers_arr != "")
          var routeect_markers = JSON.parse(markers_arr);
          var array = $.map(routeect_markers, function(value, index) {
            return [value];
         });

          var pointss=[];
          var i=0;
          var t ="";
       for(i=0;i<array.length;i++){
        var t=array[i].split(',');
       // console.log(i +'=='+ array.length);
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


    var currentOption = $('#route_id>option:selected');
    var mar= currentOption.attr("data-id");
    var mari=currentOption.attr("data-name");
    //console.log(markers_val_);
    markers_val_ = [];
    
    console.log(mar);
    
     addLatLng("","");
 
     addLatLng(mari,mar);
   
    
   
    var driver_id = currentOption.attr("data-driver");
    $(ths).addClass("active_driver");
    getlivepoints();
    $('.route-container').css('display', 'block');
    
 }

    $(".close").click(function(){  
     // $('.route-container').css('display', 'none');
     addLatLng("","");
    });

    
  interval = 1000 * 6; 

       function search_clear(){
        $('#pac-input').val('');
        $('#info').html('');

    }        

</script>
<!-- https://maps.googleapis.com/maps/api/directions/json?origin=28.667899981213115%2C77.22796290957035&destination=28.646208704837782%2C77.11638301455082&waypoints=28.658862494805%2C77.203243671289%7C28.651933227536%2C77.178867755762%7C28.655247282061%2C77.152088580957%7C28.65072809083%2C77.124279437891&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4 -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&libraries=places&callback=initAutocomplete"
       async defer></script> -->
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&libraries=places,geometry&callback=initAutocomplete"
       async defer></script>