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

        .map-wrapper{
          position: fixed;
          width: 100vw;
          height: 100vh;
          top: 0;
          left: 0;
          /*display: none;*/
        }
    </style>

<?php $activeTab = "system_setting"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Sysytem Setting</a></li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/setting_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

    <div class="row">
    <?php echo form_open(site_url('admin/system_settings/do_update') ,
      array('class' => 'form-horizontal form-groups-bordered','target'=>'_top'));?>
        <div class="col-md-6">

            <div class="panel panel-primary" >

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('system_settings');?>
                    </div>
                </div>

                <div class="panel-body">

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('system_name');?></label>
                      <div class="col-sm-9">
                          <input type="text" required="true" class="form-control" name="system_name"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('system_title');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_title"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?>" required>
                      </div>
                  </div>

               <!--    <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="address"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>" required>
                      </div>
                  </div> -->

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="phone"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?>" required>
                      </div>
                  </div>

                  <!-- <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('paypal_email');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="paypal_email"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'paypal_email'))->row()->description;?>">
                      </div>
                  </div> -->

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('currency');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="currency"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?>" required>
                      </div>
                  </div>
                   <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('student_perifix_code');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="code"
                              value="<?php echo @$this->db->get_where('settings' , array('type' =>'perifix_code'))->row()->description;?>" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('system_email');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_email"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('school_location');?></label>
                      <div class="col-sm-9">
                          <!-- <input type="text" class="form-control" name="school_location" value="<?php echo $this->db->get_where('settings' , array('type' =>'school_location'))->row()->description;?>" onclick="mapOpen(this.id);" name="route_start" id="route_start" required  readonly>
                          <input type="hidden" class="route_start" id="lat" name="route_start_lat" value="" >
                          <input type="hidden" class="route_start" id="lng" name="route_start_lng" value=""> -->

                          <input  class="form-control col-md-7 col-xs-12"  name="route_start" id="route_start" value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>" required="required" type="text" readonly onclick="mapOpen(this.id);">
                          <!-- <div class="help-block"><?php echo form_error('route_start'); ?></div>
 -->
                          <input type="hidden" class="route_start" id="lat" name="route_start_lat" value="<?php echo $this->db->get_where('settings' , array('type' =>'latitude'))->row()->description;?>" >
                          <input type="hidden" class="route_start" id="lng" name="route_start_lng" value="<?php echo $this->db->get_where('settings' , array('type' =>'longitude'))->row()->description;?>">
                      </div>
                  </div>


                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('running_session');?></label>
                      <div class="col-sm-9">
                          <select name="running_year" class="form-control selectboxit">
                          <?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;?>
                          <option value="" disabled="true"><?php echo get_phrase('select_running_session');?></option>
                          <?php for($i = 0; $i < 10; $i++):?>
                              <option value="<?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>"
                                <?php if($running_year == (2016+$i).'-'.(2016+$i+1)) echo 'selected';?>>
                                  <?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>
                              </option>
                          <?php endfor;?>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('language');?></label>
                      <div class="col-sm-9">
                          <select name="language" class="form-control selectboxit">
                                <?php
									$fields = $this->db->list_fields('language');
									foreach ($fields as $field)
									{
										if ($field == 'phrase_id' || $field == 'phrase')continue;

										$current_default_language	=	$this->db->get_where('settings' , array('type'=>'language'))->row()->description;
										?>
                                		<option value="<?php echo $field;?>"
                                        	<?php if ($current_default_language == $field)echo 'selected';?>> <?php echo $field;?> </option>
                                        <?php
									}
									?>
                           </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('text_align');?></label>
                      <div class="col-sm-9">
                          <select name="text_align" class="form-control selectboxit">
                          	  <?php $text_align	=	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;?>
                              <option value="left-to-right" <?php if ($text_align == 'left-to-right')echo 'selected';?>> left-to-right</option>
                              <option value="right-to-left" <?php if ($text_align == 'right-to-left')echo 'selected';?>> right-to-left</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('marks_setting');?></label>
                      <div class="col-sm-9">
                          <select name="marks_setting" class="form-control selectboxit">
                              <?php $text_align = $this->db->get_where('settings' , array('type'=>'marks_setting'))->row()->description;?>
                              <option value="only_marks" <?php if ($text_align == 'only_marks')echo 'selected';?> > Only marks</option>
                              <option value="only_grade" <?php if ($text_align == 'only_grade')echo 'selected';?> > Only grade</option>
                              <option value="marks_and_grade" <?php if ($text_align == 'marks_and_grade')echo 'selected';?> > marks and grade</option>
                          </select>
                      </div>
                  </div>

				  
				  
				  
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('disable_frontend');?></label>
                      <div class="col-sm-9">
                        <div class="container">
                          <label class="control control--checkbox">
                            <input type="checkbox" name="disable_frontend" <?php if ($this->db->get_where('settings' , array('type' =>'disable_frontend'))->row()->description == 1) echo 'checked'; ?> />
                            <div class="control__indicator"></div>
                          </label>
                        </div>
                      </div>
                  </div>


                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('purchase_code');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="purchase_code"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'purchase_code'))->row()->description;?>" required>
                      </div>
                  </div>
                  
                   <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('select_board');?></label>
                      <div class="col-sm-9">
                          <select name="board_setting" class="form-control selectboxit">
                              <?php $board_setting = $this->db->get_where('settings' , array('type'=>'board_setting'))->row()->description;?>
                              <option value="1" <?php if ($board_setting == '1')echo 'selected';?> >CBSC</option>
                              
                          </select>
                      </div>
                  </div>

                  
                      <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('school_start_time');?></label>
                      <div class="col-sm-9">
                          <input type="time" class="form-control" name="school_start_time"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'school_start_time'))->row()->description;?>" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('registration_fees');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="registration_fees"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'registration_fees'))->row()->description;?>" required>
                      </div>
                  </div>
  
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('subject_wise_attendence');?></label>
                      <div class="col-sm-9">
                        <div class="container">
                          <label class="control control--checkbox">
                            <input type="checkbox" name="subject_wise_attendence" <?php if ($this->db->get_where('settings' , array('type' =>'subject_wise_attendence'))->row()->description == 1) echo 'checked'; ?> />
                            <div class="control__indicator"></div>
                          </label>
                        </div>
                      </div>
                  </div>
				  
				     <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('school_end_time');?></label>
                      <div class="col-sm-9">
                          <input type="time" class="form-control" name="school_end_time"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'school_end_time'))->row()->description;?>" required>
                      </div>
                  </div>
				  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('event/notification_alert_active');?></label>
                      <div class="col-sm-9">
                        <div class="container">
                          <label class="control control--checkbox">
                            <input type="checkbox" name="notifications_alert" <?php if ($this->db->get_where('settings' , array('type' =>'notifications_alert'))->row()->description == 1) echo 'checked'; ?> />
                            <div class="control__indicator"></div>
                          </label>
                        </div>
                      </div>
                  </div>
                  
                  	<div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('school_session_end_date');?></label>
                      <div class="col-sm-9">
                          <input type="date" class="form-control" name="school_session_end_date"
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'school_session_end_date'))->row()->description;?>" required>
                      </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('save');?></button>
                    </div>
                  </div>
                    <?php echo form_close();?>

                </div>

            </div>

			<div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('update_product');?>
                </div>
            </div>


            <div class="panel-body form-horizontal form-groups-bordered">
                <?php echo form_open(site_url('updater/update') , array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>

                        <div class="col-sm-5">

                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <input type="submit" class="btn btn-info" value="<?php echo get_phrase('install_update'); ?>" />
                        </div>
                    </div>

                <?php echo form_close(); ?>
            </div>

        </div>

       <!-- <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                   Update Teacher Registration Form Fields 
                </div>
               
            </div>


            <div class="panel-body form-horizontal form-groups-bordered">
                
                <?php 
                  $fieldsetting = $this->db->get('registration_form_setting_teacher')->result();  
                  foreach ($fieldsetting as $key => $dt) {
                ?>    
                  <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $dt->description; ?></label>
                          <div class="col-sm-3">
                            <div class="container">
                            <label class="control control--checkbox">
                              <input type="checkbox" name="disable_frontend" <?php if ($dt->status == 1) echo 'checked'; ?>  onclick = 'field_status_teacher("<?php echo $dt->id;?>")'/>
                              <div class="control__indicator">
                                
                              </div>
                            </label>


                          </div>
                          <?php if($dt->status == 1 && $dt->created_html == 0){ ?>
                           <button title="permanently delete this field !" class="btn" style="float: right;position: relative;top: -16px;" onclick='delete_field_teacher("<?php echo $dt->id;?>");'><i class="fa fa-close"></i></button>
                            <?php } ?>
                        </div>
                        <div class="col-sm-4">
                          <span style="color:red" id="msg_t<?=$dt->id;?>" class="msg"></span>
                        </div>
                    </div>
                  <?php } ?>
                  

                <?php echo form_close(); ?>
            </div>

        </div>
 -->

        </div>

           

              <div class="col-md-6">
                <div class="panel panel-primary" >

                  <div class="panel-heading">
                      <div class="panel-title">
                          <?php echo get_phrase('upload_logo');?>
                      </div>
                  </div>
         <?php echo form_open(site_url('admin/system_settings/upload_logo') , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
                  <div class="panel-body">
                      <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/logo.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new">Select image</span>
                                          <span class="fileinput-exists">Change</span>
                                          <input type="file" name="userfile" accept="image/*" required="required">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                  </div>
                              </div>
                          </div>
                      </div>


                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('upload');?></button>
                      </div>
                    </div>

                  </div>
                   <?php echo form_close();?>
              </div>

			  
			  

			  
			  
<!--               <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                   Update Registration Form Fields 
                </div>
               
            </div>


            <div class="panel-body form-horizontal form-groups-bordered">
                
                <?php 
                  $fieldsetting = $this->db->get('registration_form_setting')->result();  
                  foreach ($fieldsetting as $key => $dt) {
                ?>    
                  <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $dt->description; ?></label>
                          <div class="col-sm-3">
                            <div class="container">
                            <label class="control control--checkbox">
                              <input type="checkbox" name="disable_frontend" <?php if ($dt->status == 1) echo 'checked'; ?>  onclick = 'field_status("<?php echo $dt->id;?>")'/>
                              <div class="control__indicator">
                                
                              </div>
                            </label>


                          </div>
                          <?php if($dt->status == 1 && $dt->created_html == 0){ ?>
                           <button title="permanently delete this field !" class="btn" style="float: right;position: relative;top: -16px;" onclick='delete_field("<?php echo $dt->id;?>");'><i class="fa fa-close"></i></button>
                            <?php } ?>
                        </div>
                        <div class="col-sm-4">
                          <span style="color:red" id="msg<?=$dt->id;?>" class="msg"></span>
                        </div>
                    </div>
                  <?php } ?>
                  
              <?php echo form_close(); ?>
            </div>

        </div> -->
      </div>
    </div>
    <div class="map-container">
    <div id="info" class="controls" ></div>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div>
    <div class="col-sm-12">
        <div class="map-close btn btn-success pull-right">Add Location</div>
    </div>
   </div>




<style media="screen">
.container {

}

.control-group {
display: inline-block;
vertical-align: top;
background: #fff;
text-align: left;
box-shadow: 0 1px 2px rgba(0,0,0,0.1);
padding: 30px;
width: 200px;
height: 210px;
margin: 10px;
}
.control {
display: block;
position: relative;
padding-left: 40px;
margin-bottom: 15px;
cursor: pointer;
font-size: 18px;
}
.control input {
position: absolute;
z-index: -1;
opacity: 0;
}
.control__indicator {
position: absolute;
top: 2px;
left: -11px;
height: 20px;
width: 20px;
background: #e6e6e6;
}
.control--radio .control__indicator {
border-radius: 50%;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
background: #ccc;
}
.control input:checked ~ .control__indicator {
background: #2aa1c0;
}
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
background: #0e647d;
}
.control input:disabled ~ .control__indicator {
background: #e6e6e6;
opacity: 0.6;
pointer-events: none;
}
.control__indicator:after {
content: '';
position: absolute;
display: none;
}
.control input:checked ~ .control__indicator:after {
display: block;
}
.control--checkbox .control__indicator:after {
      left: 8px;
      top: 5px;
      width: 4px;
      height: 9px;
      border: 3px solid #fff;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
}
.control--checkbox input:disabled ~ .control__indicator:after {
border-color: #7b7b7b;
}


</style>

<!-- <script type="text/javascript">
  function field_status(field_id){
    //alert(field_id);
      $('.msg').text("")
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/update_field_status'); ?>",
          data   : { field_id : field_id},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              //alert(data);
              $('#msg'+field_id).text(data);
              $("#msg"+field_id).show().delay(3000).fadeOut();
              //$('#msg'+field_id).text("");
             }
          }
      }); 
   }

   function delete_field(del_val){

    
    $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/detele_fields_'); ?>",
          data   : { 'del_val' : del_val},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              alert('Field delete successfully !');
              location.reload();
             }
          }
      }); 
   }

   function field_status_teacher(field_id){
    //alert(field_id);
      $('.msg').text("")
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/update_field_status_teacher'); ?>",
          data   : { field_id : field_id},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              //alert(data);
              $('#msg_t'+field_id).text(data);
              $("#msg_t"+field_id).show().delay(3000).fadeOut();
              //$('#msg'+field_id).text("");
             }
          }
      }); 
   }

  function delete_field_teacher(del_val){
      $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ajax/detele_fields_teacher'); ?>",
          data   : { 'del_val' : del_val},               
          async  : false,
          success: function(data){                                                   
             if(data)
             {
              alert('Field delete successfully !');
              location.reload();
             }
          }
      }); 
   }
</script> -->

<script>
  var attr;
   dataObjVal = [];
    function initAutocomplete() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 28.668502452598734, lng: 77.2193798407227},
        zoom: 13,
        mapTypeId: 'roadmap'
      });

      geocoder = new google.maps.Geocoder();

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
      alert(responses[0].formatted_address);
      $('#'+attr).val(responses[0].formatted_address);
       var addr = responses[0].formatted_address;
       document.getElementById('info').innerHTML=addr;
      
        $("input[name='"+attr+"_lat']").val(pos.lat());
        $("input[name='"+attr+"_lng']").val(pos.lng());
      
       
       // input[name='first_name']
      // $('.route_start, .lat').val(pos.lat());

    } else {
      return 'Cannot determine address at this location.';
    }
  });
}
</script>
<script>
   function mapOpen(class_val){
       // alert("working");
        attr = class_val;
       // alert(attr);
     
        dataObjVal = [];
        $('.map-container').css('display', 'block');
          alert(class_val);
    }
    $(".map-close").click(function(){  
     $('.map-container').css('display', 'none');
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA3wtFPAIvJyfy5Q1JaW_fP3fuRTX3frD4&libraries=places,geometry&callback=initAutocomplete"
       async defer></script>
