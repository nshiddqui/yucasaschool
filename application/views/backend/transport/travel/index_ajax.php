  
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
                                            <td><?php echo $obj->vehicle_no;?></td>
                                            <td><?php echo $obj->vehicle_id; ?></td>
                                            <td><?php echo $obj->start_km; ?></td>
                                            <td><?php echo $obj->end_km; ?></td>
                                            <td><?php echo $obj->cash; ?></td>
                                            <td><?php echo $obj->diesel; ?></td>
                                            <td><?php echo $obj->vehicle_damage; ?></td>
                                            <td><?php echo $obj->vehicle_repairing; ?></td>
                                            <td><?php echo $obj->end_km-$obj->start_km; ?></td>
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
                              