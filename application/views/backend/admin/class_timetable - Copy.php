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
<style>
    .timetable { }
/*body table tbody td.timetable-class { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; font-family: 'Oswald', sans-serif; }*/
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
  border-right: 1px solid #6f6f6f;
  width: 14.166%;
  font-weight: 900;
  text-transform:uppercase;
}

.timetable.table tbody tr:nth-child(2n+1) th,.timetable.table tbody tr:nth-child(2n+1) td {
  background:#bed1ff;
  padding: 2% 1%;
  margin: 2%;
  font-size: 12px;
  text-align: center;
  color: #333;
  border: 1px solid #333;
}



.timetable.table tbody tr:nth-child(2n) th,.timetable.table tbody tr:nth-child(2n) td {
  background:#8ec8f7;
  padding: 2% 1%;
  margin: 2%;
  font-size: 12px;
  text-align: center;
  color: #333;
  border: 1px solid #333;
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

.tt_period_hidden{
    display: none;
}
</style>


<?php $activeTab = "class_routine"; ?>
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

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
        <select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)"  id = "class_selection">
            <option value=""><?php echo get_phrase('select_class'); ?></option>
            <?php
            $classes = $this->db->get('class')->result_array();
            foreach ($classes as $row):
                ?>
              <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $class_id){echo 'selected';} ?>><?php echo $row['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>


<div id="section_holder">
    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
            <select name="section_id" id="section_id" class="form-control selectboxit"  onchange="get_template_(this.value)">
                <?php
                $sections = $this->db->get_where('section', array(
                            'class_id' => $class_id
                        ))->result_array();
                foreach ($sections as $row):
                    ?>
                    <option <?php if($row['section_id'] == $section_id){echo 'selected';} ?> value="<?php echo $row['section_id']; ?>"
                          >
                            <?php echo $row['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>
</div>


<div id="section_holder">
    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('template'); ?></label>
            <select name="template_id" id="template_id" class="form-control selectboxit" required>
               <option value=""> -- select --</option>
                <?php
                $template = $this->db->get('class_routine_template')->result_array();

                foreach ($template as $tem_row):
                    ?>

                    <option <?php if($tem_row['id'] == $template_id){echo 'selected';} ?> value="<?php echo $tem_row['id']; ?>"
                          >
                            <?php echo $tem_row['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>
</div>

  <div class="col-md-2" style="margin-top: 20px;">
    <button onclick="reload_url(); return false;" class="btn btn-info"><?php echo get_phrase('manage_timetable'); ?></button>
  </div>
  
</div>


<div class="table-responsive col-sm-12 p0 time_table_view">
<form action="<?php echo site_url('admin/addclass_routine_data/');?>" method = "POST" >  
         <?php
         // echo "<pre>";
         //  print_r($template_data_result);
         // echo "</pre>";

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
                                                    <h6 style="color: #fff">Period Interval :<span><?php echo $interval_;?> Min</span></h6>
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
                                                    <h6 style="color: #fff">Period Interval :<span><?php echo $interval_;?> Min</span></h6>
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
                                                    <h6 style="color: #fff">Period Interval :<span><?php echo $interval_;?> Min</span></h6>
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
                                                    <h6 style="color: #fff">Period Interval :<span><?php echo $interval_;?> Min</span></h6>
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
                                                    <h6 style="color: #fff">Period Interval :<span><?php echo $interval_;?> Min</span></h6>
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
                                                    <h6 style="color: #fff">Period Interval :<span><?php echo $interval_;?> Min</span></h6>
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

                                        $endTime        = strtotime($minutes_, strtotime($selectedTime));
                                        $endtime_without= date('h:i',$endTime);
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
                                              $day_      = $daywise[$k];



                                    ?>

                                        <td id = "id<?php echo $k; ?>"  data-day="<?=$j;?>">
                                            <div class="tt_time">[ <?php echo $timetable_time;?> - <?php echo $endtime_;?> ]</div>
                                            <input type="hidden" name="class_id"    value="<?php echo $class_id;?>">
                                            <input type="hidden" name="section_id"  value="<?php echo $section_id;?>">
                                            <input type="hidden" name="template_id" value="<?php echo $template_id;?>">
                                            

                                           <?php 
                                             $class_routine_value =  @$this->db->get_where('class_routine',array('period'=>$i+1,'class_id'=>$class_id,'section_id'=>$section_id,'template_id'=>$template_id,'day'=>$day_))->row();

                                           if($universal_name_val == "Empty"){  
                                             

                                           // print_r($class_routine_value);
                                            ?>
                                            <div class="tt_subject">
                                                <input type="hidden" name="period[<?php echo $i;?>][<?php echo $k;?>]" value="<?php echo $i+1 ;?>">
                                                <input type="hidden" name="day[<?php echo $i;?>][<?php echo $k;?>]"  value="<?php echo $day_ ;?>">
                                                <input type = "hidden" name="time_start[<?php echo $i;?>][<?php echo $k;?>]" id= "time_start" value="<?php echo $timetable_time;?>" class="form-control ">

                                                <input  type = "hidden" name="endtime[<?php echo $i;?>][<?php echo $k;?>]" id= "endtime" value="<?php echo $endtime_;?>" class="form-control ">

                                                <input  type = "hidden" name="editvalue[<?php echo $i;?>][<?php echo $k;?>]" id= "editvalue" value="<?php echo $class_routine_value->class_routine_id;?>" class="form-control ">
                                                
                                                <select name="subject_id[<?php echo $i;?>][<?php echo $k;?>]" id="subject<?php echo $i;?><?php echo $k;?>" class="form-control" onchange = "get_teachers_by_subject(this.value,'<?php echo $i;?><?php echo $k;?>','<?php echo $day_;?>','<?php echo $i+1;?>','<?php echo $timetable_time;?>','<?php echo $endtime_;?>');">
                                                    <!-- disabled="" -->
                                                  <option value="" >Select Subject</option>
                                                    <?php $subjectsdata = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC")->result(); ?>
                                                     <?php foreach ($subjectsdata as $key => $dt) {
                                                      if($class_routine_value->subject_id == $dt->subject_id){ $selected = 'selected'; }else{ $selected = ''; }
                                                        echo    '<option value="'.$dt->subject_id.'" '.$selected.' >' .$dt->name. '</option>';
                                                     }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="tt_teacher">
                                                <select name="teacher[<?php echo $i;?>][<?php echo $k;?>]" id="teacher_<?php echo $i;?><?php echo $k;?>" class="form-control">
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
                                            <input type="hidden" name="period[<?php echo $i;?>][<?php echo $k;?>]" value="<?php echo $i+1;?>">
                                            <input type="hidden" name="day[<?php echo $i;?>][<?php echo $k;?>]"  value="<?php echo $day_ ;?>">
                                            <input type = "hidden" name="time_start[<?php echo $i;?>][<?php echo $k;?>]" id= "time_start" value="<?php echo $timetable_time;?>" class="form-control ">
                                            <input  type = "hidden" name="endtime[<?php echo $i;?>][<?php echo $k;?>]" id= "endtime" value="<?php echo $endtime_;?>" class="form-control ">
                                            <input  type = "hidden" name="editvalue[<?php echo $i;?>][<?php echo $k;?>]" id= "editvalue" value="<?php echo $class_routine_value->class_routine_id;?>" class="form-control ">

                                            <span class="tt_subject">&nbsp;<?php echo $universal_name_val; ?></span><br>
                                            <span class="tt_teacher">&nbsp;&nbsp; </span> <br>
                                         <?php  } ?>
                                        </td> 
                                    
                                    <?php } ?>

                                 </tr>
                            <?php $timetable_time      = $endtime_; }  ?>  
                        </tbody>
                    </table>
                        <div class="col-md-12 text-right p0" style="margin-top: 20px;">
                          <button type="submit"  class="btn btn-info"><?php echo get_phrase('save_data'); ?></button>
                        </div>
                <?php } ?>

            </form>
 </div>




<style>
    .tt_timetable_details{
        /*display: none;*/
    }
    .tt_timetable_details.container-fluid{
        background: #fff;
        padding: 3%;
    }


.tt_detail_close{
    position: absolute;
      right: -7px;
      font-size: 20px;
      color: #000;
      top: -14px;
      background: #fff;
      width: 35px;
      height: 35px;
      text-align: center;
      border-radius: 50%;
      line-height: 35px;
      cursor: pointer;
    }
.error{
    color:red;
}


</style>

<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> -->
<script>

     

//jsondata='{"all_data":{"class_id":"1","section_id":"1","subject_id":"5","is_temporary":"no","event_type":"","tem_date":"","time_start":3,"time_end":4,"time_start_min":"30","time_end_min":"20","com_start_min":"3.30","com_end_min":"4.20","day":"tuesday","year":"2018-2019"},"msg":""}';

    $(document).ready(function(){
    //  $("#formTimeTable").validate({
    //     rules :{
    //     is_temporary : "required",
    //    ///type :"required",
    //    // teacher :"required",
    //    // subject :"required"
    //    }, submitHandler: function(form) {
    //      // do other things for a valid form
    //       var data;
    //       data =  $("#formTimeTable").serialize();
    //        // data.append( 'file', $( '#file' )[0].files[0] );
    //       console.log(data);
    //       //alert("Submitted! " + $('#is_temporary').val());
          
    //        $.ajax({
    //             url: "<?php echo site_url('admin/addclass_routine_data'); ?>",
    //             data: data,
    //             type: 'POST',
    //             success: function (data) {
    //                 //alert(data);
    //                 console.log(data);
    //                 $('#id1').attr('jsondata',data);
    //                 var obj = JSON.parse(data);
    //                 //alert(obj.msgval);
    //                 $('#msg').html(obj.msgval);
    //                 if(obj.msg == 'success'){
    //                   location.reload();
    //                 }
    //             }
    //         });
    //     //form.preventDefault();
    //    }
    // });

      
  
   // function get_period_class_routine(period){
   //      $('#mon_1').html(' ');
   // }

});
   
   function get_teachers_by_subject(value,rowcol,day_,period,timetable_time,endtime_){
    $.ajax({       
       type   : "POST",
       url    : "<?php echo site_url('ajax/get_classroutine_subjectid_by_teacher'); ?>",
       data   : {'subject_id' : value,'day_' : day_,'period' : period,'timetable_time' : timetable_time,'endtime_' : endtime_},               
       success: function(response){  
        $('#teacher_'+rowcol).html(response);
       }
     });
   }

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
    template_id = $('#template_id').val();
    if(class_selection != "" && section_id != ""){
      window.location.href = "<?php echo site_url();?>/admin/class_timetable/"+class_selection+"/" + section_id+"/"+template_id;
    }
}


function addItem(){
    var period = $('.timetable tbody>tr.period_tr:last').attr('period');
    period = parseInt(period);
    var item = $('.tt_period_clone').clone(true);
    item.removeClass('tt_period_clone tt_period_hidden');
    item.addClass('period_tr');
    item.insertAfter('.timetable tbody>tr.period_tr:last');
    $('.timetable tbody>tr.period_tr:last').attr('period',period + 1);
    return false;
}

function addRecess(){
    var period = $('.timetable tbody>tr.period_tr:last').attr('period');
    period = parseInt(period);
    var item = $('.tt_recess_clone').clone(true);
    item.removeClass('tt_recess_clone tt_period_hidden');
    item.addClass('period_tr');
    item.insertBefore('.timetable tbody>tr:last');
    $('.timetable tbody>tr.period_tr:last').attr('period',period + 1);
    $('.add-recess').hide();
}

$('.item-delete').click(function(){
    $(this).parent('tr').remove();
    return false;

});

function save_time_routine(day_){
  //ssaturday_interval
 var  start_    = $('.'+day_+'_start').val();
 var  interval_ = $('.'+day_+'_interval').val();

   $.ajax({       
      type   : "POST",
      url    : "<?php echo site_url('admin/settime_for_classroutine'); ?>",
      data   : {'starttime' : start_,'intervaltime':interval_,'day':day_},               
      success: function(response){  
        alert(response);     
        console.log(response);                                        
      }
     });
}

function get_template_(this_val){
  var section_ = this_val;
  var class_id = $("#class_selection").val();
  //alert(class_id);
}

</script>
