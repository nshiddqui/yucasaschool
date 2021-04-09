<?php $activeTab = "class_routine"; 
$timetable_name = "";
 $timetable_time = "";$interval_      = "";$class_id       = "";
 $section_id     = "";$numberofperiod = "";$template_idd   = "";
if($template_data_result != ""){
 $timetable_name = $template_data_result->name;
 $timetable_time = $template_data_result->start_time;
 $interval_      = $template_data_result->time_interval;
 $class_id       = $template_data_result->class_id;
 $section_id     = $template_data_result->section_id;
 $numberofperiod = $template_data_result->numberofperiod;
 $template_idd   = $template_data_result->id;
}


?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Time Table</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

  <!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>
<!-- time-table -->
<div class="content">
    <div class="container-fluid">


<div class="row">
	<div class="col-md-12">

    	<!---CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#addTemplate" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('add_template');?>
                </a>
            </li>
			<li class="">
            	<a href="#templateList" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('template_list');?>
                </a>
            </li>
        </ul>
      <br>
      <br>


    	<!---CONTROL TABS END------>
		<div class="tab-content">
            <!---TABLE LISTING STARTS-->
            <div class="tab-pane box active " id="addTemplate">
           
               <!-- FORM TO ADD TEMPLATE -->
               <form action="<?php echo site_url('admin/timetable_template/create');?>" method="post" class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('template_name'); ?></label>
                        <input id="template_name" name="template_name" value="<?php echo $timetable_name;?>" class="form-control template_name" type="text">
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('start_time'); ?></label>
                        <input id="start_time" name="class_start_time" value="<?php echo $template_time;?>" class="form-control start_time" type="text">
                    </div>
                </div>



                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_interval'); ?></label>
                        <select name="period_interval" id="period_interval" class="form-control period_interval  tuesday_interval selectboxit">
                            <option value="5">5 Min</option>
                            <option value="10" <?php if($interval_ == 10){ echo "selected";}?> >10 Min</option>
                            <option value="15" <?php if($interval_ == 15){ echo "selected";}?> >15 Min</option>
                            <option value="20" <?php if($interval_ == 20){ echo "selected";}?> >20 Min</option>
                            <option value="25" <?php if($interval_ == 25){ echo "selected";}?> >25 Min</option>
                            <option value="30" <?php if($interval_ == 30){ echo "selected";}?> >30 Min</option>
                            <option value="35" <?php if($interval_ == 35){ echo "selected";}?> >35 Min</option>
                            <option value="40" <?php if($interval_ == 40){ echo "selected";}?> >40 Min</option>
                            <option value="45" <?php if($interval_ == 45){ echo "selected";}?> >45 Min</option>
                            <option value="50" <?php if($interval_ == 50){ echo "selected";}?> >50 Min</option>
                            <option value="55" <?php if($interval_ == 55){ echo "selected";}?> >55 Min</option>
                            <option value="60" <?php if($interval_ == 60){ echo "selected";}?> >60 Min</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('number_of_periods'); ?></label>
                        <input id="number_of_periods" name="number_of_periods" value="<?php echo $numberofperiod;?>" class="form-control number_of_periods" type="number" min="1">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                        <select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)"  id = "class_selection">
                            <option value=""><?php echo get_phrase('select_class'); ?></option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row): ?>
                              <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <div id="section_holder">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                            <select name="section_id" id="section_id" class="form-control selectboxit" >
                                <?php
                                $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
                                foreach ($sections as $row): ?>
                                    <option <?php if($row['section_id'] == $section_id){echo 'selected';} ?> value="<?php echo $row['section_id']; ?>"  >
                                            <?php echo $row['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <button type="submit"  class="btn btn-info"><?php echo get_phrase('generate_template'); ?></button>
                </div>
                </form>



                    <!-- ////////////////////////////////TEMPLATE UNIVERSAL OPTIONS//////////////////////////////////////// -->

            <?php if($template_data_result != ""){  
                //echo $template_idd;
                $universal_col   =  $this->db->get_where('universal_periods',array('template_id'=>$template_idd))->result();
                //print_r($universal_col);

                ?>
                <div class="template_options container-fluid p0">
                    <div class="heading">
                        <h2>Universal Periods</h2>
                    </div>
                    <form action="<?php echo site_url('admin/universal_periods/create');?>" method="post" class="">
                        
                        <!-- UNIVERSAL PERIOD BLOCK -->
                    <?php    if(sizeof($universal_col) > 0){
                     foreach ($universal_col as $key => $dt_universal) {
                    ?> 
                        <div class="uni_period row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_name'); ?></label>
                                    <input id="uni_period_name" name="period_name[]" value="<?php echo $dt_universal->name;?>" class="form-control period_name" type="text">
                                    <input  name="template_id" value="<?php echo $template_idd;?>" class="form-control period_name" type="hidden">
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_interval'); ?></label>
                                    <select name="uni_period_interval[]" id="uni_period_interval" class="form-control  uni_period_interval selectboxit">
                                        <option value="5"  <?php if($dt_universal->interval_time  == 5){ echo "selected";} ?>  >5 Min</option>
                                        <option value="10" <?php if($dt_universal->interval_time == 10){ echo "selected";} ?> >10 Min</option>
                                        <option value="15" <?php if($dt_universal->interval_time == 15){ echo "selected";} ?> >15 Min</option>
                                        <option value="20" <?php if($dt_universal->interval_time == 20){ echo "selected";} ?> >20 Min</option>
                                        <option value="25" <?php if($dt_universal->interval_time  == 25){ echo "selected";} ?> >25 Min</option>
                                        <option value="30" <?php if($dt_universal->interval_time == 30){ echo "selected";} ?> >30 Min</option>
                                        <option value="35" <?php if($dt_universal->interval_time == 35){ echo "selected";} ?> >35 Min</option>
                                        <option value="40" <?php if($dt_universal->interval_time == 40){ echo "selected";} ?> >40 Min</option>
                                        <option value="45" <?php if($dt_universal->interval_time == 45){ echo "selected";} ?> >45 Min</option>
                                        <option value="50" <?php if($dt_universal->interval_time == 50){ echo "selected";} ?> >50 Min</option>
                                        <option value="55" <?php if($dt_universal->interval_time == 55){ echo "selected";} ?> >55 Min</option>
                                        <option value="60" <?php if($dt_universal->interval_time == 60){  echo "selected";} ?> >60 Min</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_placement'); ?></label>
                                    <select name="uni_period_placement[]" id="uni_period_placement" class="form-control uni_period_placement  selectboxit">
                                        <?php 
                                            for($i = 1;$i <= $numberofperiod;$i++){
                                                $selected="";
                                                if('b_'.$i == $dt_universal->assign_period){ $selected = 'selected';}
                                               echo  '<option value="b_'.$i.'" '.$selected.'>Before '.$i.' Period</option>';
                                            }
                                        ?>
                                        <option value="a_<?php echo $i-1;?>" <?php if('a_'.$i-1 == $dt_universal->assign_period){ echo 'selected';} ?> >After <?php echo $i-1;?> Period</option>
                                    </select>
                                </div>
                            </div>
                                <!-- <div class="col-md-3" style="margin-top: 20px;">
                                    <button type="submit"  class="btn btn-info"><?php echo get_phrase('add_period'); ?></button>
                                </div>-->                     
                            </div>
                            <!-- UNIVSRAL BLOCK ENDS HERE -->
                       <?php } }else{ ?>
                        <div class="uni_period row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_name'); ?></label>
                                    <input id="uni_period_name" name="period_name[]" value="" class="form-control period_name" type="text">
                                    <input  name="template_id" value="<?php echo $template_idd;?>" class="form-control period_name" type="hidden">
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_interval'); ?></label>
                                    <select name="uni_period_interval[]" id="uni_period_interval" class="form-control  uni_period_interval selectboxit">
                                        <option value="5">5 Min</option>
                                        <option value="10">10 Min</option>
                                        <option value="15">15 Min</option>
                                        <option value="20">20 Min</option>
                                        <option value="25">25 Min</option>
                                        <option value="30" selected="">30 Min</option>
                                        <option value="35">35 Min</option>
                                        <option value="40">40 Min</option>
                                        <option value="45">45 Min</option>
                                        <option value="50">50 Min</option>
                                        <option value="55">55 Min</option>
                                        <option value="60">60 Min</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_placement'); ?></label>
                                    <select name="uni_period_placement[]" id="uni_period_placement" class="form-control uni_period_placement  selectboxit">
                                        <?php 
                                            for($i = 1;$i <= $numberofperiod;$i++){
                                               echo  '<option value="b_'.$i.'">Before '.$i.' Period</option>';
                                            }
                                        ?>
                                        <option value="a_<?php echo $i-1;?>">After <?php echo $i-1;?> Period</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                       <?php  } ?>

                        <!-- UNIVERSAL BLOCK CLONE -->
                            <div class="uni_period uni_period_clone hidden row">
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_name'); ?></label>
                                        <input id="uni_period_name" name="period_name[]" value="" class="form-control period_name" type="text">
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_interval'); ?></label>
                                        <select name="uni_period_interval[]" id="uni_period_interval" class="form-control  uni_period_interval ">
                                            <option value="5">5 Min</option>
                                            <option value="10">10 Min</option>
                                            <option value="15">15 Min</option>
                                            <option value="20">20 Min</option>
                                            <option value="25">25 Min</option>
                                            <option value="30" selected="">30 Min</option>
                                            <option value="35">35 Min</option>
                                            <option value="40">40 Min</option>
                                            <option value="45">45 Min</option>
                                            <option value="50">50 Min</option>
                                            <option value="55">55 Min</option>
                                            <option value="60">60 Min</option>
                                        </select>
                                    </div>
                                </div>

                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_placement'); ?></label>
                                    <select name="uni_period_placement[]" id="uni_period_placement" class="form-control uni_period_placement  ">
                                        <?php 
                                            for($i = 1;$i <= $numberofperiod;$i++){
                                               echo  '<option value="b_'.$i.'">Before '.$i.' Period</option>';
                                            }
                                        ?>
                                        <option value="a_<?php echo $i-1;?>">After <?php echo $i-1;?> Period</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-top: 20px;">
                                <div class="remove_uni">
                                    <a href="" class="btn btn-danger">Remove Period</a>
                                </div>
                            </div>
                        </div>

                        <!-- UNIVERSAL BLOCK CLONE ENDS HERE-->
                        
                        <!-- UNIVERSAL BLOCK ADD MORE BUTTON -->
                        <div id="clone_uni_block" class="col-12 text-left">
                            <button class="btn btn-info" type="submit" >Save Universal Periods </button>
                            <a href="" class="btn btn-info" >Add New Universal Period</a>
                        </div>
                        <!-- UNIVERSAL BLOCK ADD MORE BUTTON ENDS HERE-->

                    </form>



                    <div class="template_preview container-fluid p0">
                        <div class="table-responsive col-sm-12 p0">
                            <div class="heading">
                                <h2>Time Table Template Preview</h2>
                            </div>
                              <?php if($template_data_result != ""){  ?>
                    
                            <table class="timetable table table-striped col-sm-12">
                                <thead>
                                  <tr class="text-center">
                                        <th scope="col" day="mon">monday                        
                                            <div class="tt_date"></div>
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff">Start Time :<span><?php echo $timetable_time;?></span></h6>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff"> Interval :<span><?php echo $interval_;?> Min</span></h6>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" day="mon">Tuesday                        
                                            <div class="tt_date"></div>
                                            <div class="row">
                                               <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff">Start Time :<span><?php echo $timetable_time;?></span></h6>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff"> Interval :<span><?php echo $interval_;?> Min</span></h6>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" day="mon">wednesday                        
                                            <div class="tt_date"></div>
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff">Start Time :<span><?php echo $timetable_time;?></span></h6>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff"> Interval :<span><?php echo $interval_;?> Min</span></h6>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" day="mon">thruesday                        
                                            <div class="tt_date"></div>
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff">Start Time :<span><?php echo $timetable_time;?></span></h6>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff"> Interval :<span><?php echo $interval_;?> Min</span></h6>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" day="mon">friday                        
                                            <div class="tt_date"></div>
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff">Start Time :<span><?php echo $timetable_time;?></span></h6>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff"> Interval :<span><?php echo $interval_;?> Min</span></h6>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" day="mon">saturday                        
                                            <div class="tt_date"></div>
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff">Start Time :<span><?php echo $timetable_time;?></span></h6>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <h6 style="color: #fff"> Interval :<span><?php echo $interval_;?> Min</span></h6>
                                                </div>
                                            </div>
                                        </th>                                      
                                    </tr>
                              
                                </thead>

                                <tbody>
                                <?php 
                                    $universal_periods_ = $this->db->get_where('universal_periods',array('template_id'=>$template_idd))->result();
                                        //$timetable_time;
                                        $numberofperiod_ = $numberofperiod;$k=0;$mt=array();
                                        foreach($universal_periods_ as  $universal_dt){
                                            $placement_period = $universal_dt->assign_period;
                                            $place_explode  = explode('_', $placement_period);
                                            if($place_explode[0] == 'b'){

                                              if($place_explode[1] == 1){
                                                 $place_explode[1] =  0;
                                                 $numberofperiod_  =  $numberofperiod_+1; 
                                               }

                                              $mt[$k]['assign_period']   =  $place_explode[1];
                                              $mt[$k]['interval_time']   =  $universal_dt->interval_time;
                                              $mt[$k]['name']            =  $universal_dt->name; 

                                            }else{

                                             $numberofperiod_++; 
                                             $mt[$k]['assign_period']   =  $numberofperiod_;
                                             $mt[$k]['interval_time']   =  $universal_dt->interval_time;
                                             $mt[$k]['name']            =  $universal_dt->name; 

                                            }

                                            $k++;
                                        }

                                         $numberofperiod_sum = $numberofperiod_;
                                      // echo "<pre>";
                                      //   print_r($mt); 
                                      // echo "<pre>"; 
                                    $numberofperiod_sum;
                                  for($i = 0;$i < $numberofperiod_sum;$i++){ 

                                         $universal_name_val = "Empty";
                                         $selectedTime       = $timetable_time;
                                         $minutes_           = '+'.$interval_." minutes";

                                         foreach($mt  as $universal_dt){
                                            $placement_period = $universal_dt['assign_period'];
                                           
                                            //$mt['period']   =  $place_explode[1];
                                            if($i == $placement_period){
                                                $minutes_       = '+'.$universal_dt['interval_time']." minutes";
                                                $universal_name_val = $universal_dt['name'];
                                            }
                                         }

                                         $endTime        = strtotime($minutes_, strtotime($selectedTime));
                                         $endtime_       = date('H:i A',$endTime);

                                    ?>
                                    <tr period="1" class="period_tr">
                                    <?php
                                       ////////////////create horizontal line ///////////////
                                        $daywise = array('monday','tuesday','wednesday','thursday','friday','saturday'); 
                                            for($k=0;$k<6; $k++) {
                                              $j = $k+1; $day_ = ""; 
                                              
                                              $date      = date("Y-m-d");
                                              $temp_date = "";
                                              $date_time = strtotime(date("H:i:s"));
                                              $day_      = $daywise[$i];
                                        ?>
                                        <td id = "id<?php echo $k; ?>"  data-day="<?=$j;?>">
                                            <div class="tt_time">[ <?php echo $timetable_time;?> - <?php echo $endtime_;?> ]</div>
                                            <span class="tt_subject">&nbsp;<?php echo $universal_name_val; ?></span><br>
                                            <span class="tt_teacher">&nbsp;&nbsp;</span> <br>
                                            <span class="tt_note">&nbsp;&nbsp;</span>
                                        </td> 
                                    
                                    <?php } ?>

                                 </tr>
                            <?php $timetable_time      = $endtime_; }  ?>  
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
  <?php } ?>
</div>

            <!-- ADD TEMPLATE TAB ENDS HERE -->
            
            <!-- TEMPLATE LIST TAB BEGINS HERE -->
            <div class="tab-pane box row" id="templateList">
                <table id="template_list" class="table datatable table-stripped" >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Template Name</th>
                            <th>Start Time</th>
                            <th>Interval</th>
                            <th>Class Name</th>
                            <th>Section Name</th>
                            <th>Staus</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        //print_r($template_data);
                         foreach ($template_data as $key => $dt) { ?>
                          <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $dt->name;?></td>
                            <td><?php echo $dt->start_time;?></td>
                            <td><?php echo $dt->time_interval;?></td>
                            <td><?php echo @$this->db->get_where('class',array('class_id'=>$dt->class_id))->row()->name; ?></td>
                            <td><?php echo @$this->db->get_where('section',array('section_id'=>$dt->section_id))->row()->name; ?></td>
                            <td ><span style="color:#000;" class="<?php if($dt->status == 1){echo 'bg-success';}else{ echo 'bg-warning';}?>" onclick="ajax_active_timetable_template('<?php echo $dt->id;?>','<?php echo $dt->class_id;?>','<?php echo $dt->section_id;?>')" >Active</span></td>
                             <td><a href="<?php echo site_url('admin/timetable_template/'.$dt->id);?>"><i class="entypo-eye"></i> view</a></td>
                         </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>


        <div class="tab-pane box <?php if($list == 'edit'){ echo 'active row';}?>" id="edit">
           <form action="<?php echo site_url('admin/timetable_template/update_to/'.$edit_);?>" method="post">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('template_name'); ?></label>
                    <input id="template_name" name="template_name" value="<?php echo $edit_data->name;?>" class="form-control template_name" type="text">
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('start_time'); ?></label>
                    <input id="start_time" name="class_start_time" value="<?php echo $edit_data->start_time;?>" class="form-control start_time" type="text">
                </div>
            </div>
            <?php 
                   $intervaltime = $edit_data->time_interval;
            ?>
            <div class="col-md-3 ">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('period_interval'); ?></label>
                        <select name="period_interval" id="period_interval" class="form-control period_interval  tuesday_interval selectboxit">
                        <option value="5" <?php if($intervaltime == 5){ echo "selected";}?> >5 Min</option>
                        <option value="10" <?php if($intervaltime == 10){ echo "selected";}?>>10 Min</option>
                        <option value="15" <?php if($intervaltime == 15){ echo "selected";}?>>15 Min</option>
                        <option value="20" <?php if($intervaltime == 20){ echo "selected";}?>>20 Min</option>
                        <option value="25" <?php if($intervaltime == 25){ echo "selected";}?>>25 Min</option>
                        <option value="30" <?php if($intervaltime == 30){ echo "selected";}?>>30 Min</option>
                        <option value="35" <?php if($intervaltime == 35){ echo "selected";}?>>35 Min</option>
                        <option value="40" <?php if($intervaltime == 40){ echo "selected";}?>>40 Min</option>
                        <option value="45" <?php if($intervaltime == 45){ echo "selected";}?>>45 Min</option>
                        <option value="50" <?php if($intervaltime == 50){ echo "selected";}?>>50 Min</option>
                        <option value="55" <?php if($intervaltime == 55){ echo "selected";}?>>55 Min</option>
                        <option value="60" <?php if($intervaltime == 60){ echo "selected";}?>>60 Min</option>

                        </select>
                    </div>
            </div>
            <div class="col-md-2" style="margin-top: 20px;">
              <button type="submit"  class="btn btn-info"><?php echo get_phrase('add_template'); ?></button>
            </div>
        </form>
    </div>
  </div>
 </div>
</div>






<script>

    
var c_id, s_id;

function select_section(class_id) {
    if (class_id !== '') {
    c_id = class_id;
    $.ajax({
        url: '<?php echo site_url('admin/get_section/'); ?>' + class_id,
        success:function (response)
        {
            jQuery('#section_holder').html(response);
        }
    });
    }
}


function reload_url() {
    class_selection = $('#class_selection').val();
    section_id = $('#section_id').val();
    if(class_selection != "" && section_id != ""){
      window.location.href = "<?php echo site_url();?>/admin/timetable_template/"+class_selection+"/" + section_id;
    }
}


function ajax_active_timetable_template(tem_id,class_id,section_id){
   var confirm_val =  confirm("Are You Sure Active This Template");
   if(confirm_val == 'false')
      return false;

  
    $.ajax({
        url: '<?php echo site_url('ajax/ajax_active_timetable_template/');?>'+tem_id+'/'+class_id+'/'+section_id,
        success:function (response)
        {
           location.reload();
        }
    });
}


// FUNCTIN TO CLONE UNIVERSAL PERIOD BLOCK
$('#clone_uni_block a').click(()=>{
    let cloneUni = $('.uni_period_clone').clone(true);
    cloneUni.removeClass('uni_period_clone hidden');
    cloneUni.insertAfter('.uni_period:last');
    return false;
});

// FUNCTION TO REMOVE UNIVERSAL PERIOD BLOCK
$('.remove_uni a').click(function(){
    console.log($(this).parent().parent().parent('.uni_period'));
    $(this).parent().parent().parent('.uni_period').remove();
    return false;
});

</script>