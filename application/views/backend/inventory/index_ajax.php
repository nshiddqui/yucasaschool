<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th >Asset name</th>
                                        <th>Quantity</th>
                                        
                                        
                                        <!--<th>Total distance covered</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>  -->                                          
                                    </tr>
                                </thead>
                                <tbody id="add_data">   
                                     
                                    <?php $count = 1; if(isset($sections) && !empty($sections)){ ?>
                                        <?php
                                        $total_km=0;
                                        $total_diesel=0;
                                        $total_cash=0;
                                        $total_damage=0;
                                           foreach($sections as $obj){ 
                                            //$routedetails =  @$this->db->get_where('routes',array('vehicle_ids'=>$obj->id))->row();
                                            ?>
                                        <tr>

                    
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->asset_name;?></td>
                                            <td><?php echo $obj->quantity; ?></td>
                                            
                                          
                                            <td style="display:none;">
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
                            
                          