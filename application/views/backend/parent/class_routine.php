<?php

 $activeTab = "class_routine"; 
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
<style>
    .timetable { }
body table tbody td.timetable-class { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; font-family: 'Oswald', sans-serif; }
/*.timetable-class,.timetable.table>tbody>tr>td { color: #fff; }*/
/*.timetable,.table>tbody>tr>th { font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; font-family: 'Oswald', sans-serif; }*/
/*.timetable,.table>thead>tr>th { font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; font-family: 'Oswald', sans-serif; }*/
.table { width: 100%; max-width: 100%; margin-bottom: 1rem; }
.box-table { padding: 16px 30px; margin: 0 -15px 15px; border-color:; border: 1px solid #eee; }
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th { border-top: transparent; color: #26282c; border-bottom: 1px solid #eee; }
.table thead th { vertical-align: bottom; border-bottom: 2px solid #eee; }
.table-striped tbody tr:nth-of-type(odd) { background-color: hsl(224, 100%, 99%); }
caption { padding-top: .75rem; padding-bottom: .75rem; color: #26282c; text-align: left; caption-side: bottom; }
.mb30{margin-bottom:30px;}

.timetable.table thead tr th {
  background: #2e3e65;
  padding: 2%;
  margin: 2%;
  font-size: 12px;
  text-align: center;
  color: #fff;
  border-right: 1px solid #162750;
  width: 14.166%;
  font-weight: 900;
}
.timetable.table thead tr th:nth-child(1){
    /*background: transparent;*/
}
.timetable.table tbody tr:nth-child(2n+1) th,.timetable.table tbody tr:nth-child(2n+1) td {
  background:#FEF1EB;
  padding: 2% 1%;
  margin: 2%;
  /*border: 5px solid #f5f5f5;*/
  font-size: 12px;
  text-align: center;
  color: #333;
  border: 1px solid #f3d9d9;
   /*vertical-align: middle;*/
}



.timetable.table tbody tr:nth-child(2n) th,.timetable.table tbody tr:nth-child(2n) td {
  background:#FDE2DB;
  padding: 2% 1%;
  margin: 2%;
  /*border: 5px solid #f5f5f5;*/
  font-size: 12px;
  text-align: center;
  color: #333;
  border: 1px solid #f3d9d9;
   /*vertical-align: middle;*/
}
.timetable.table tbody tr th{
    font-weight: 900;
    text-align: left !important;
    width: 12%;
    color: #e54c2d !important;
    vertical-align: middle;
    display: none;
}
.tt_subject{
  font-weight: 900;
  line-height: 1;
}
.tt_teacher{
  font-size: 10px;
  line-height: 1;
}
.tt_note{
  font-size: 10px;
  letter-spacing: 0;
}
.tt_time{
  font-size: 10px;
  letter-spacing: 0;
  margin-bottom: 5px;
  font-weight: 900;
  letter-spacing: 0.5px;
  color: #333;
}

.tt_date{
  font-size: 10px;
  letter-spacing: 0;
  margin-bottom: 5px;
  font-weight: 700;
  letter-spacing: 0.5px;
  color: #fff;
}
.timetable.table tbody tr.trmiddle td{
    vertical-align: middle;
}

</style>

<?php $activeTab = "academic_dashboard"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li><a href="#">Academic</a></li>
        <li class="active">Time Table</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>
<!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/student/academic_nav_tab.php'; ?> 
<!-- Including Navigation Tab -->
</div>

<!-- time-table -->
<div class="content">
    <div class="container-fluid">
        <div class="row timetable">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mb30">
            <!-- <h4 style="margin-bottom: 20px;">TIMETABLE</h4> -->
            </div>
            <div class="table-responsive col-sm-12 p0 time_table_view">
                <?php
                       if($template_data_result != ""){  ?>
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

                                        $endTime         = strtotime($minutes_, strtotime($selectedTime));
                                        $endtime_without = date('h:i',$endTime);
                                        $endtime_        = date('H:i A',$endTime);

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
                                              $day_      = $daywise[$k];

                                    ?>

                                        <td id = "id<?php echo $k; ?>"  data-day="<?=$j;?>">
                                            <div class="tt_time">[ <?php echo $timetable_time;?> - <?php echo $endtime_;?> ]</div>
                                            
                                            

                                           <?php 
                                             $class_routine_value =  @$this->db->get_where('class_routine',array('period'=>$i+1,'class_id'=>$class_id,'section_id'=>$section_id,'template_id'=>$template_idd,'day'=>$day_))->row();
                                              //print_r($class_routine_value);
                                           if($universal_name_val == "Empty"){  
                                             

                                           // print_r($class_routine_value);
                                            ?>
                                            <div class="tt_subject">
                                                
                                                
                                                <select name="subject_id[<?php echo $i;?>][<?php echo $k;?>]" id="subject<?php echo $i;?><?php echo $k;?>" class="form-control" onchange = "get_teachers_by_subject(this.value,'<?php echo $i;?><?php echo $k;?>',$timetable_time,$endtime_,$i+1,$day_);" disabled>
                                                    <!-- disabled="" -->
                                                  <option value="" >Select Subject</option>
                                                    <?php $subjectsdata = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC")->result(); ?>
                                                     <?php foreach ($subjectsdata as $key => $dt) {
                                                        if($class_routine_value->subject_id == $dt->subject_id){ $selected = 'selected'; }else{ $selected = ''; }
                                                          echo '<option value="'.$dt->subject_id.'" '.$selected.' >' .$dt->name. '</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="tt_teacher">
                                                <select name="teacher[<?php echo $i;?>][<?php echo $k;?>]" id="teacher_<?php echo $i;?><?php echo $k;?>" class="form-control" disabled>
                                                    <option value="" >Select Subject</option>
                                                    <?php if($class_routine_value != ""){ 
                                                            $this->db->select('T.*');
                                                            $this->db->from('assign_subject AS S');
                                                            $this->db->join('teacher AS T', 'T.teacher_id = S.teacher_id','left');
                                                            $this->db->where('S.subject_id',$class_routine_value->subject_id );
                                                            $teacherdata = $this->db->get()->result();

                                                            if (!empty($teacherdata)) {
                                                                foreach ($teacherdata as $obj) {
                                                                if($class_routine_value->teacher_id == $obj->teacher_id){ $selected = 'selected'; }else{ $selected = ''; }
                                                                   echo  $str = '<option value="' . $obj->teacher_id . '"'. $selected  .' >'. $obj->name . '</option>';
                                                                }
                                                            }
                                                        } 
                                                    ?>
                                                   
                                                </select>
                                            </div>
                                         <?php }else{ ?>
                                            <span class="tt_subject">&nbsp;<?php echo $universal_name_val; ?></span><br>
                                            <span class="tt_teacher">&nbsp;&nbsp;<?php echo $minutes_;?> </span> <br>
                                         <?php  } ?>
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
</div>
</div>
<!-- /.time-table -->