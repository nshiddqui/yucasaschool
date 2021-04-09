<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&libraries=places"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_route_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> Vehicle Route <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'transport', 'route')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> Vehicle Route</a> </li>                          
                        <?php } ?>  
                        <li class=""><a href="#tab_assign_vehicle"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> Assign Vehicle</a> </li>
                        <li class=""><a href="#tab_assign_route_to_student"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> Assign Route to Student</a> </li>
                        <li class=""><a href="#tab_unassign_route_to_student"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> Un-Assign Student from transport</a> </li>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> Vehicle Route</a> </li>                          
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
										    <td><?php $query = $this->db->query("SELECT * FROM student where is_transport_member = 1 AND transport_id='$id'");echo $query->num_rows();?></td>
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
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_end"  id="route_end" value="<?php echo isset($post['route_end']) ?  $post['route_end'] : ''; ?>" placeholder="<?php echo $this->lang->line('route_end'); ?>" required="required" type="text" readonly onclick="mapOpen();">
                                        <div class="help-block"><?php echo form_error('route_end'); ?></div>
                                        <input type="hidden" class="route_end" id="route_end_lat" name="route_end_lat" value="<?php echo isset($post['route_end_lat']) ?  $post['route_end_lat'] : ''; ?>" >
                                        <input type="hidden" class="route_end" id="route_end_lng" name="route_end_lng" value="<?php echo isset($post['route_end_lng']) ?  $post['route_end_lng'] : ''; ?>">
                                     
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
                        
                        <div  class="tab-pane fade in" id="tab_assign_vehicle">
                            <div class="x_content" id="route_stop_form"> 
                               <?php echo form_open(site_url('transport/route/assign_vehicle'), array('class'=>'form-horizontal form-label-left'), ''); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Choose Route<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="route" class="form-control col-md-7 col-xs-12" required>
                                            <option value="">Choose Route</option>
                                            <?php
                                                $routes = $this->db->get_where('routes')->result();
                                                foreach($routes as $route){ 
                                                    echo "<option value='{$route->id}'>$route->title</option>";
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Choose Vehicle <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="vehicle" class="form-control col-md-7 col-xs-12" required>
                                            <option value="">Choose Vehicle</option>
                                            <?php
                                                $vehicles = $this->db->get_where('vehicles')->result();
                                                foreach($vehicles as $vehicle){ 
                                                    echo "<option value='{$vehicle->id}'>$vehicle->number</option>";
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <div  class="tab-pane fade in" id="tab_assign_route_to_student">
                            <div class="x_content" id="route_stop_form"> 
                               <?php echo form_open(site_url('transport/route/assign_route_to_student'), array('class'=>'form-horizontal form-label-left'), ''); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php $classes = $this->db->get_where('class')->result(); ?>
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="add_class_id" required="required" onchange="return get_class_sections(this.value)" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->class_id; ?>" ><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_selector_holder"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="section_selector_holder" onchange="return get_student_by_class_sections(this.value)" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="add_student_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Choose Route<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="route" class="form-control col-md-7 col-xs-12" required>
                                            <option value="">Choose Route</option>
                                            <?php
                                                $routes = $this->db->get_where('routes')->result();
                                                foreach($routes as $route){ 
                                                    echo "<option value='{$route->id}'>$route->title</option>";
                                                }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <div  class="tab-pane fade in" id="tab_unassign_route_to_student">
                            <div class="x_content" id="route_stop_form"> 
                               <?php echo form_open(site_url('transport/route/un_assign_route_to_student'), array('class'=>'form-horizontal form-label-left'), ''); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php $classes = $this->db->get_where('class')->result(); ?>
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="unadd_class_id" required="required" onchange="return get_class_sections(this.value,'un')" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->class_id; ?>" ><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_selector_holder"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="unsection_selector_holder" onchange="return get_student_by_class_sections(this.value,'un')" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="unadd_student_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
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
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_end"  id="route_end_edit" value="<?php echo isset($route->route_end) ?  $route->route_end : $post['route_end']; ?>" placeholder="<?php echo $this->lang->line('route_end'); ?>" required="required" type="text" readonly onclick="mapOpen(true);">
                                        <div class="help-block"><?php echo form_error('route_end'); ?></div>
                                        <input type="hidden" class="route_end_edit" id="route_end_lat_edit" name="route_end_lat" value="<?php echo isset($route->dest_lat) ?  $route->dest_lat : $post['route_end_lat']; ?>" >
                                        <input type="hidden" class="route_end_edit" id="route_end_lng_edit" name="route_end_lng" value="<?php echo isset($route->dest_long) ?  $route->dest_long : $post['route_end_lng']; ?>">

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
<div class="modal fade bs-route-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
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
   <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="info" class="controls" ></div>
    <div id="map"></div>
    <div class="col-sm-12">
        <div class="map-close btn btn-success pull-right" onclick="add_location()">Add Location</div>
        <div class="map-close btn btn-success pull-right" onclick="clear_location()">Close</div>
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
    
    function get_student_by_class(class_id, student_id, type){       
        
        $("select#"+type+"_student_id").prop('selectedIndex', 0);
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_class'); ?>",
            data   : { class_id : class_id , student_id : student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                    $('#'+type+'_student_id').html(response);
               }
            }
        });                  
        
   }
   function get_class_sections(class_id,type = '') {
        
    	$.ajax({
            url: '<?php echo site_url('admin/get_class_section/');?>' + class_id ,
            success: function(response)
            {
                jQuery('#'+type+'section_selector_holder').html(response);
            }
        });

    }
    
    function get_student_by_class_sections(section_id , type = '') {
        var class_id = $('#'+type+'add_class_id').val();
        if(class_id=='' || section_id==''){
            jQuery('#'+type+'add_student_id').html('<option value="">Select</option>');
        }
    	$.ajax({
            url: '<?php echo site_url('admin/get_students_for_ssph/');?>' + class_id+'/'+section_id ,
            success: function(response)
            {
                jQuery('#'+type+'add_student_id').html(response);
            }
        });

    }
   
</script>



<script type="text/javascript">
    var currentLat = false;
    var currentLng = false;
    var currentAddrs = false;
    var latitute = $('#lat').val();
    var longitude=$('#lng').val();
            
    var map;
	var marker;
	var myLatlng = new google.maps.LatLng(latitute,longitude);
	var geocoder = new google.maps.Geocoder();
	var infowindow = new google.maps.InfoWindow();
	function initialize(){
	var mapOptions = {
    	zoom: 18,
    	center: myLatlng,
    	mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("map"), mapOptions);

	marker = new google.maps.Marker({
    	map: map,
    	position: myLatlng,
    	draggable: true 
	}); 
	
	// Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
    searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          if (places.length == 0) {
            return;
          }
          places.forEach(function(place) {
              var pos = {
                  lat: place.geometry.location.lat(),
                  lng: place.geometry.location.lng()
                };
                console.log(pos);
                geocoder.geocode({'latLng': pos }, function(results, status) {
                	if (status == google.maps.GeocoderStatus.OK) {
                    	if (results[0]) {
                    	    marker.setPosition(pos);
                        	currentAddrs = results[0].formatted_address;
                        	currentLat = marker.getPosition().lat();
                        	currentLng = marker.getPosition().lng();
                        	infowindow.setContent(results[0].formatted_address);
                        	infowindow.open(map, marker);
                    	}
                	}
            	});
              
          });
    });

	geocoder.geocode({'latLng': myLatlng }, function(results, status) {
    	if (status == google.maps.GeocoderStatus.OK) {
        	if (results[0]) {
            	infowindow.setContent('Here is your school.');
            	infowindow.open(map, marker);
        	}
    	}
	});

	google.maps.event.addListener(marker, 'dragend', function() {

    	geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        	if (status == google.maps.GeocoderStatus.OK) {
            	if (results[0]) {
        	    	currentAddrs = results[0].formatted_address;
                	currentLat = marker.getPosition().lat();
                	currentLng = marker.getPosition().lng();
                	infowindow.setContent(results[0].formatted_address);
                	infowindow.open(map, marker);
            	}
        	}
    	});
	});
	
	google.maps.event.addListener(map, 'click', function(event) {                
        //Get the location that the user clicked.
        var clickedLocation = event.latLng;
        //Marker has already been added, so just change its location.
        marker.setPosition(clickedLocation);
    	geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        	if (status == google.maps.GeocoderStatus.OK) {
            	if (results[0]) {
        	    	currentAddrs = results[0].formatted_address;
                	currentLat = marker.getPosition().lat();
                	currentLng = marker.getPosition().lng();
                	infowindow.setContent(results[0].formatted_address);
                	infowindow.open(map, marker);
            	}
        	}
    	});
    });

	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
    var selectLat = false;
    var selectLng = false;
    var selectAddr = false;
    function mapOpen(update = false){
         if(update){
            selectAddr = '#route_end_edit';
            selectLat = '#route_end_lat_edit';
            selectLng = '#route_end_lng_edit';
            var pos = {
              lat: Number($(selectLat).val()),
              lng: Number($(selectLng).val())
            };
            marker.setPosition(pos);
            infowindow.setContent($(selectAddr).val());
        	infowindow.open(map, marker);
         } else {
             selectAddr = '#route_end';
             selectLat = '#route_end_lat';
             selectLng = '#route_end_lng';
         }
        $('.map-container').css('display', 'block');
    }
    
    function add_location(){
        if(currentAddrs && currentLat && currentLng){
            $(selectAddr).val(currentAddrs);
        	$(selectLat).val(currentLat);
        	$(selectLng).val(currentLng);
            $('.map-container').css('display', 'none');
        } else {
            alert('Please select address.');
        }
    }
    
    function clear_location(){
        $('.map-container').css('display', 'none');
    }
    
</script>

 