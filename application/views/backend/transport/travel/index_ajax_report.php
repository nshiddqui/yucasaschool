<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="display:none;">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th ><?php echo $this->lang->line('vehicle'); ?> No</th>
                                        <th><?php echo $this->lang->line('vehicle'); ?> Driver Id</th>
                                        
                                        <th>Start Km</th>
                                        <th>End km</th>
                                        <th>Total distance covered</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody id="add_data">   
                                     
                                    <?php $count = 1; if(isset($vehicles) && !empty($vehicles)){ ?>
                                        <?php
                                        $total_km=0;
                                        $total_diesel=0;
                                        $total_cash=0;
                                        $total_damage=0;
                                           foreach($vehicles as $obj){ 
                                            $routedetails =  @$this->db->get_where('routes',array('vehicle_ids'=>$obj->id))->row();
                                            ?>
                                        <tr>

                    
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->vehicle_no;?></td>
                                            <td><?php echo $obj->vehicle_id; ?></td>
                                            <td><?php echo $obj->start_km; ?></td>
                                            <td><?php echo $obj->end_km; ?></td>
                                            <td><?php
                                            $kms_total=$obj->end_km-$obj->start_km;
                                            $total_km +=$kms_total;
                                            $total_diesel +=$obj->diesel;
                                            $total_cash +=$obj->cash;
                                            $total_damage +=$obj->vehicle_repairing;
                                            echo $kms_total; ?></td>
                                            <!--<td><?php echo $obj->note; ?></td>
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
                                            </td>-->
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
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Total Kilometers 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php echo $total_km;?> kms
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Total Diesel 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php echo $total_diesel;?> ltr
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Total cash given 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        Rs. <?php echo $total_cash;?> 
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Total damage cost given 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        Rs. <?php echo $total_damage;?>
                                    </div>
                                </div>
                                </div>
                                    </div>
                                
                                </div>